<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VROOM - <?= htmlspecialchars($title ?? 'Accueil') ?></title>

    <!-- CSS commun -->
    <link rel="stylesheet" href="Ressources/Css/commun.css">
    <!-- CSS header (menu profil) -->
    <link rel="stylesheet" href="Ressources/Css/header.css">

    <!-- CSS spécifique à la page -->
    <?php if (!empty($css)): ?>
        <link rel="stylesheet" href="Ressources/Css/<?= htmlspecialchars($css) ?>">
    <?php endif; ?>
    <?php if (!empty($js)): ?>
        <script src="Ressources/JVS/<?= htmlspecialchars($js) ?>" defer></script>
    <?php endif; ?>
    <script src="Ressources/JVS/commun.js" defer></script>
</head>
