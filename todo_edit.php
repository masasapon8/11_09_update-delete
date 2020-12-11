<?php

include('functions.php');

$id = $_GET['id'];

$pdo = connect_to_db();
$sql = 'SELECT * FROM todo_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  // var_dump($result);

  $output = "";
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$result["deadline"]}</td>";
    $output .= "<td>{$result["todo"]}</td>";
    $output .= "</tr>";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="todo_update.php" method="POST">
    <input type="hidden" name="id" value="<?= $result['id'] ?>">
    <fieldset>
      <legend>DB連携型todoリスト（編集画面）</legend>
      <a href="todo_read.php">一覧画面</a>
      <div>
        todo: <input type="text" name="todo">
      </div>
      <div>
        deadline: <input type="date" name="deadline">
      </div>
      <div>
        <button>submit</button>
      </div>

    </fieldset>
  </form>

</body>

</html>