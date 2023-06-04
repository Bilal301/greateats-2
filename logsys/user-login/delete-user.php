<?php
require_once "./../../config/database.php";

$id = $_POST['id'] ?? null;

if (!$id) {
  header('Location: ./admin-login.php');
}


$sql = "DELETE FROM users_temp WHERE id= :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: ./admin-login.php');
