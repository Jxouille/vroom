<?php
// ...existing code...
<?php
// inclut automatiquement tous les fichiers .php de Vue/pages (triés)
$pages = glob(__DIR__ . '/Vue/pages/*.php');
sort($pages);
foreach ($pages as $page) {
    include $page;
}
?>
// ...existing code...