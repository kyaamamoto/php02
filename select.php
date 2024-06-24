<?php
require_once('funcs.php');

//1. DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=zouuu_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//2. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM member_table");
$status = $stmt->execute();

// 追加.テーブルの開始タグとヘッダー行
$view = "<table border='1' style='border-collapse: collapse' class='responsive-table'>";
$view .= "<tr>
            <th>id</th>
            <th>name</th>         
            <th>birthDay</th>
            <th>tel</th>
            <th>email</th>
            <th>address1</th>
            <th>address2</th>         
            <th>Birthplace1</th>
            <th>Birthplace2</th>
            <th>addressInterest</th>
            <th>birthplaceInterest</th>
            <th>mytownInterest</th>         
            <th>food</th>
            <th>travel</th>
            <th>hobby</th>
            <th>action</th>
            <th>datetime</th>
         </tr>";

//3. データ表示
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= "<tr>";
        $view .= "<td>". h($result['id']). "</td>";
        $view .= "<td>". h($result['name']). "</td>";
        $view .= "<td>". h($result['birthDay']). "</td>";
        $view .= "<td>". h($result['tel']). "</td>";
        $view .= "<td>". h($result['email']). "</td>";
        $view .= "<td>". h($result['jusho1']). "</td>";
        $view .= "<td>". h($result['jusho2']). "</td>";
        $view .= "<td>". h($result['jusho3']). "</td>";
        $view .= "<td>". h($result['jusho4']). "</td>";
        $view .= "<td>". h($result['kanshin1']). "</td>";
        $view .= "<td>". h($result['kanshin2']). "</td>";
        $view .= "<td>". h($result['kanshin3']). "</td>";
        $view .= "<td>". h($result['food']). "</td>";
        $view .= "<td>". h($result['travel']). "</td>";
        $view .= "<td>". h($result['shumi']). "</td>";
        $view .= "<td>". h($result['action']). "</td>";
        $view .= "<td>". h($result['datetime']). "</td>";
        $view .= "</tr>";
    }
    $view .= "</table>"; // テーブルの終了タグを追加
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>会員情報一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="./css/style2.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
<img src="./img/ZOUUUbanner.jpg" alt="zouuu" class="img">
</header>
<!-- Head[End] -->
<h1>会員情報一覧</h1>

<!-- Main[Start] -->
<div id="btnGroup">
    <button><a class="btn" href="cms.php">戻る</a></button>
    <button><a class="btn" href="analysis.php">会員情報分析</a></button>
    <button><a class="btn" href="download.php">ダウンロード</a></button> <!-- ダウンロードボタンのリンクを追加 -->
</div>

<div class="container table-responsive">
    <div class="jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>