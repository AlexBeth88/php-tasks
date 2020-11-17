<?php
session_start();

$text = $_POST['text'];

$pdo = new PDO("mysql:hots=localhost;dbname=10tasks", "root", "");

$sql = "SELECT * FROM sometext WHERE text=:text";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if (!empty($task) && $text != '') {
    $message = "Введённая запись уже присутствует в таблице.";
    $_SESSION['danger'] = $message;

    header("Location: /task_10.php");
    exit;
} else if ($text == '') {
    $message = "Вы не заполнили поле.";
    $_SESSION['danger'] = $message;
    header("Location: /task_10.php");
} else {
    $sql = "INSERT INTO sometext(text) VALUES (:text)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['text' => $text]);

    $message = "Запись сохранена в таблицу.";
    $_SESSION['success'] = $message;


    header("Location: /task_10.php");
}
