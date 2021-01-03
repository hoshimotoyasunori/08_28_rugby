<?php
include('functions.php');
$pdo = connect_to_db();

//データ参照SQL作成
$sql = 'SELECT * FROM rugby_table order by id desc';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
  $error = $stmt->errorInfo(); //失敗時はエラー出力
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
  // var_dump($result);
  // exit();

  $output = "";
  foreach ($result as $record) {
    $output .= "<tr><td><img src=\"" . $record['image'] . "\"></td><td>{$record["team"]}</td><td>・{$record["name"]}</td><td>・<a href='edit.php?id={$record["id"]}'>編集</a></td><td>・<a href='delete.php?id={$record["id"]}'>消去</a></td><tr><br>";
    // $output .= "<fieldset><tr>";
    // $output .= "<td><img src=\"" . $record['image'] . "\"></td>";
    // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'><h1>編集</h1></a></td>";
    // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'><h1>消去</h1></a></td>";
    // $output .= "</tr></fieldset>";
  }
  unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="input.css">
  <title>選手登録画面</title>
</head>

<body>
  <header>
    <div class="player">
      <div>選手登録ページ</div>
      <div><button onclick="location.href='read.php'">選手一覧ページ</button></div>
    </div>
    <div class="kinyuu">
      <form action="create.php" method="POST" class="registration">
        <fieldset class="registration2">
          <div class="title">
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
            <div><input class="input" type="text" name="name" placeholder="name"></div>
            <div><input class="input" type="text" name="tall" placeholder="身長">cm</div>
            <div><input class="input" type="text" name="weight" placeholder="体重">kg</div>
            <div><input class="input" type="date" name="born" placeholder="誕生日"></div>
            <div><input class="input" type="text" name="comefrom" placeholder="出身"></div>
            <div><input class="input" type="url" name="image" placeholder="写真url"></div>
          </div>
          <div>
            <button>登録</button>
          </div>
        </fieldset>
      </form>
    </div>
    <!-- <div class="japan">
      <a href="data.php"><img src="team/japan.png" alt=""></a>
    </div> -->
  </header>
  <main>
    <div class="output_data"><?= $output ?></div>
    <!-- <table class="logo">
      <tr class="box">
        <td><button onclick="location.href='team-sanix.php'"><img src="team/sanix.jpeg" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-yamaha.php'"><img src="team/yamaha.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-toyota.php'"><img src="team/toyota.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-tousiba.php'"><img src="team/tousiba.png" alt="" class="team"></button></td>
      </tr>
      <tr class="box">
        <td><button onclick="location.href='team-suntory.php'"><img src="team/suntory.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-richo.php'"><img src="team/richo.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-pana.php'"><img src="team/pana.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-nec.php'"><img src="team/nec.jpeg" alt="" class="team"></button></td>
      </tr>
      <tr class="box">
        <td><button onclick="location.href='team-n-com.php'"><img src="team/n-com.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-kubota.php'"><img src="team/kubota.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-kobe.php'"><img src="team/kobe.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-jyuukou.php'"><img src="team/jyuukou.jpeg" alt="" class="team"></button></td>
      </tr>
      <tr class="box">
        <td><button onclick="location.href='team-honda.php'"><img src="team/honda.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-hino.php'"><img src="team/hino.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-docomo.php'"><img src="team/docomo.png" alt="" class="team"></button></td>
        <td><button onclick="location.href='team-canon.php'"><img src="team/canon.png" alt="" class="team"></button></td>
      </tr>
    </table>
  </main> -->
</body>

</html>