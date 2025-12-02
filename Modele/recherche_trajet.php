<?php
require_once 'bd_connection.php';


// ===== Exemple ===== //

// Retourne la liste des articles
function getLastArticles(int $limit): array {
  $sql = "SELECT * FROM articles ORDER BY created_at DESC LIMIT :limit";
  $query = dbConnect()->prepare($sql);
  $query->bindParam(':limit', $limit, PDO::PARAM_INT);
  $query->execute();
  $articles = $query->fetchAll();
  return $articles;
}

// Retourne un article spécifique
function getArticle(int $id): array {
  $sql = "SELECT * FROM articles WHERE id = :id";
  $query = dbConnect()->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
  $article = $query->fetch();
  return $article;
}

// ===== ECRITURE ===== //

// Ajoute un nouvel article en BDD
function addArticle(array $fields): void {
  $title = $fields['title'];
  $content = $fields['content'];
  $created_at = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
  $sql = "INSERT INTO articles (title, content, created_at) VALUES (:title, :content, :created_at)";
  $query = dbConnect()->prepare($sql);
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->bindParam(':content', $content, PDO::PARAM_STR);
  $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
  $query->execute();
}

// Supprime un article en BDD
function deleteArticle(int $id): void {
  $sql = "DELETE FROM articles WHERE id = :id";
  $query = dbConnect()->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
}

// Edite un article en BDD
function editArticle(int $id, array $fields): void {
  $title = $fields['title'];
  $content = $fields['content'];
  $updated_at = date_format(new DateTime('NOW'), 'Y-m-d H:i:s');
  $sql = "UPDATE articles SET title = :title, content = :content, updated_at = :updated_at WHERE id = :id";
  $query = dbConnect()->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->bindParam(':content', $content, PDO::PARAM_STR);
  $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
  $query->execute();
}
?>