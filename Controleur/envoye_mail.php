<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendEmail($email_dest, $nom_utilisateur, $type, $code): bool {
    if ($type == "mdp_oblie_code") {
        $sujet = "Réinitialisation de votre mot de passe VROOM";
        $contenu = "<p>Bonjour {$nom_utilisateur}</p>,
                <p>Voici votre mot de passe provisoire :</p>
                <h2>$code<h2>
                <p>⏱️ Valide 2 minutes</p>
                <p>Connectez-vous puis définissez immédiatement un nouveau mot de passe.</p>
                <p>À bientôt,</p>
                <p>VROOM 🚗</p>";
    }else if ($type == "mdp_oblie_link") {
        $subject = "Réinitialisation du mot de passe";
        $body = "<p>Bonjour {$nom_utilisateur},</p>
             <p>Cliquez sur le lien suivant pour réinitialiser votre mot de passe :</p>
             <a href='$code'>$code</a>";
        
    } else if ($type == "auth_code") {
        $sujet = "Code de vérification Vroom";
        $contenu = "<p>Bonjour {$nom_utilisateur},</p>
                 <p>Votre code de vérification est :</p>
                 <h2>$code</h2>
                 <p>⏱️ Valide 2 minutes</p>";

    } else if ($type == "auth_code_again") {
        $sujet = "Nouveau code de vérification Vroom";
        $contenu = "<p>Bonjour {$nom_utilisateur},</p>
                     <p>Voici votre <strong>nouveau code</strong> :</p>
                     <h2>$code</h2>
                     <p>⏱️ Valide 2 minutes</p>";
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '4038c6cc664fff';     ////// À remplacer par vos identifiants Mailtrap
        $mail->Password = '0bc3ae9a13f440'; /////////// À remplacer par vos mdp Mailtrap
        $mail->Port = 2525;

        $mail->setFrom('no-reply@vroom.test', 'Vroom Service');
        $mail->addAddress($email_dest);
        $mail->isHTML(true);
        $mail->Subject = $sujet;
        $mail->Body = $contenu;

        $mail->send();
        echo "Email sent successfully";
        return true;
    } catch (Exception $e) {
        echo "Mail error: " . $mail->ErrorInfo;
        return false;
    }
}



