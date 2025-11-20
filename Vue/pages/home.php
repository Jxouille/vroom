<div class="home">
	<section id="about">
		<h1>Blog dev</h1>
		<p>...</p>
	</section>
	<section id="last-articles">
	<?php foreach ($articles as $article) { ?>
		<article>
			<h2><?= $article['title']; ?></h2>
			<a href="<?= 'index.php?page=show_article&id=' . $article['id']; ?>">Lire l'article</a>
		</article>
	<?php } ?>
	</section>
</div>