<h1>Le blog</h1>
<a href="index.php?page=add_article" role="button"><i class="fa-solid fa-plus"></i> Ajouter un article</a>
<?php foreach($articles as $article) { ?>
  <article>
    <h2><?= htmlspecialchars($article['title']) ?></h2>
    <p><?= htmlspecialchars($article['resume']) ?></p>
    <a href="index.php?page=show_article&id=<?= $article['id'] ?>" role="button" class="outline">Lire l'article</a>
  </article>
<?php } ?>