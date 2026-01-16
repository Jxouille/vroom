<?php

function formatDateFr(string $date): string
{
    // Sécurité
    if (empty($date)) {
        return '';
    }

    // Méthode 1 : IntlDateFormatter (si dispo)
    if (class_exists('IntlDateFormatter')) {
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN,
            'EEEE d MMMM'
        );

        return ucfirst($formatter->format(strtotime($date)));
    }

    // Méthode 2 : fallback PHP pur
    $jours = [
        'Sunday' => 'Dimanche',
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi'
    ];

    $mois = [
        'January' => 'janvier',
        'February' => 'février',
        'March' => 'mars',
        'April' => 'avril',
        'May' => 'mai',
        'June' => 'juin',
        'July' => 'juillet',
        'August' => 'août',
        'September' => 'septembre',
        'October' => 'octobre',
        'November' => 'novembre',
        'December' => 'décembre'
    ];

    $dateObj = new DateTime($date);

    return $jours[$dateObj->format('l')]
        . ' '
        . $dateObj->format('d')
        . ' '
        . $mois[$dateObj->format('F')];
}
?>