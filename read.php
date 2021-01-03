<?php
include('functions.php');
$pdo = connect_to_db();

//データ参照SQL作成
// $teamname = ['サニックス', 'ヤマハ', 'コベルコ', 'トヨタ', 'パナソニック', 'サントリー', 'クボタ', 'グリーン', '東芝', 'ブラック', 'NTT', '重工', 'ホンダ', '日野', 'キャノン', ''];

// for ($i = 0; $i < count($teamname); $i++) {
//   echo $teamname[$i];
// }


$sql = 'SELECT * FROM rugby_table  order by team desc';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
  $error = $stmt->errorInfo(); //失敗時はエラー出力
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
  // var_dump($result);
  // exit();
  // var_dump($result);
  // exit();

  $output = "";
  foreach ($result as $record) {
    // $output .= "<tr><td>{$record["team"]}</td><td>{$record["name"]}</td></tr>";
    // $output .= "<tr>";
    $output .= "<tr><td><img src=\"" . $record['image'] . "\"></td></tr>";
    // $output .= "</tr>";
    // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
    // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
    // $output .= "</tr>";
  }
  unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="read.css">
  <title>選手一覧</title>
</head>

<body>

  <header>
    <div class="player">
      <div>選手一覧ページ</div>
      <div><button onclick="location.href='input.php'">選手登録ページ</button></div>
    </div>
    <div>
      <a href="index.html">
        <h1>TOPへ</h1>
      </a>
    </div>
  </header>
  <main>
    <?= $output ?>
  </main>

</body>

</html>