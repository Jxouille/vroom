$template = './views/pages/home.php';

// Récupération des 3 derniers articles du blog en BDD via PDO et la méthode fetchAll()
$articles = ...;

require_once './models/articleManager.php';

$template = './views/pages/home.php';
$articles = getLastArticles(3);