<?php
require_once('funcs.php');

//1. DB接続します
try {
  $pdo = new PDO('mysql:dbname=zouuu_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//2. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM member_table");
$status = $stmt->execute();

if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    // データをCSV形式に変換
    $csv_data = "id,name,birthDay,tel,email,address1,address2,Birthplace1,Birthplace2,addressInterest,birthplaceInterest,mytownInterest,food,travel,hobby,action,datetime\n";
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $csv_data .= '"' . h($result['id']) . '","' . h($result['name']) . '","' . h($result['birthDay']) . '","' . h($result['tel']) . '","' . h($result['email']) . '","' . h($result['jusho1']) . '","' . h($result['jusho2']) . '","' . h($result['jusho3']) . '","' . h($result['jusho4']) . '","' . h($result['kanshin1']) . '","' . h($result['kanshin2']) . '","' . h($result['kanshin3']) . '","' . h($result['food']) . '","' . h($result['travel']) . '","' . h($result['shumi']) . '","' . h($result['action']) . '","' . h($result['datetime']) . '"' . "\n";
    }

    // CSVファイルのダウンロード設定
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=member_data.csv');
    echo $csv_data;
    exit();
}
?>