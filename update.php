<?php
// var_dump($_POST);
// exit();

$id = $_POST['id'];
$tall = $_POST['tall'];
$weight = $_POST['weight'];

include('functions.php');
$pdo = connect_to_db();

// idを指定して更新するSQLを作成(UPDATE文)
$sql = 'UPDATE rugby_table SET tall=:tall, weight=:weight,
updated_at=sysdate() WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':tall', $tall, PDO::PARAM_STR);
$stmt->bindValue(':weight', $weight, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

// 各値をpostで受け取る
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する 
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常に実行された場合は一覧ページファイルに移動し，処理を実行する 
    header("Location:read.php");
    exit();
}
