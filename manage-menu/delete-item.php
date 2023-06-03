<?php

require_once './../config/database.php';

$id = $_POST['id'] ?? null;

if (!$id) {
  header('Location: main-menu.php');
}

$sql = 'DELETE FROM menu WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();

header("Location: main-menu.php");
