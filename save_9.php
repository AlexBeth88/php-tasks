<?php
$text = $_POST['text'];

$pdo = new PDO("mysql:hots=localhost;dbname=10tasks", "root", "");
$sql = "INSERT INTO sometext(text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);

header("Location: /task_9.php");
