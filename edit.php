<?php
// var_dump($_GET);
// exit();
include("functions.php");
$id = $_GET['id'];

$pdo = connect_to_db();

$sql = 'SELECT * FROM rugby_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // $output = "";
    // foreach ($result as $record) {
    //     $output .= "<td><img src=\"" . $record['image'] . "\"></td>";
    // }
}

?>

<!DOCTYPE html>
<html lang="ja">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>選手情報（編集画面）</title>
</head>

<body>
    <form action="update.php" method="POST">
        <fieldset>
            <legend>選手情報（編集画面）</legend>
            <a href="read.php">一覧画面</a>
            <div>
                <select name="team">
                    <option value="宗像サニックスブルース">宗像サニックスブルース </option>
                    <option value="コベルコスティーラーズ">コベルコスティーラーズ</option>
                    <option value="トヨタベルブリッツ">トヨタベルブリッツ</option>
                    <option value="パナソニックワイルドナイツ">パナソニックワイルドナイツ</option>
                    <option value="サントリーサンゴリアス">サントリーサンゴリアス</option>
                    <option value="クボタスピアーズ">クボタスピアーズ</option>
                    <option value="ヤマハジュビロ磐田">ヤマハジュビロ磐田</option>
                    <option value="NECグリーンロケッツ">NECグリーンロケッツ</option>
                    <option value="東芝ブレイブルーパス">東芝ブレイブルーパス</option>
                    <option value="RICHOブラックラムズ">RICHOブラックラムズ</option>
                    <option value="n-NTTコミュニケーションズ">NTTコミュニケーションズ</option>
                    <option value="三菱重工ダイナボアーズ">三菱重工ダイナボアーズ</option>
                    <option value="ホンダヒート">ホンダヒート</option>
                    <option value="日野レッドドルフィンズ">日野レッドドルフィンズ</option>
                    <option value="ドコモレッドスパークす">ドコモレッドスパークす</option>
                    <option value="キャノンイーグルス">キャノンイーグルス</option>
                </select>
            </div>
            <div><input class="input" type="text" name="name" placeholder="name" value="<?= $record["name"] ?>"></div>
            <div><input class="input" type="text" name="tall" placeholder="身長" value="<?= $record["tall"] ?>">cm</div>
            <div><input class="input" type="text" name="weight" placeholder="体重" value="<?= $record["weight"] ?>">kg</div>
            <div><input class="input" type="date" name="born" placeholder="誕生日" value="<?= $record["born"] ?>"></div>
            <div><input class="input" type="text" name="comefrom" placeholder="出身" value="<?= $record["comefrom"] ?>"></div>
            <div><input class="input" type="url" name="image" placeholder="写真url" value="<?= $record["image"] ?>"></div>
            <div>
                <input type="hidden" name="id" value="<?= $record['id'] ?>">
            </div>
            <div>
                <button>確定</button>
            </div>

        </fieldset>
        <?= "<img src=\"" . $record['image'] . "\">"  ?>


    </form>

</body>

</html>