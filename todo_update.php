<?php
// var_dump()($_POST);
// exit();

$todo = $_POST['todo'];
$deadline = $_POST['deadline'];
$id = $_POST['id'];

include('functions.php');
$pdo = connect_to_db();


$sql = "UPDATE todo_table SET todo=:todo, deadline=:deadline, updated_at=sysdate() WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':todo', $todo, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {

    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{error[2]}"]);
    exit();
} else {

    header("Location:todo_read.php");
}
