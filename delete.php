<?php

//1. POSTデータ取得
$user_id    = $_GET['user_id']; //idを取得（POSTでなくGET）

//2. DB接続
require_once('funcs.php'); //funcs.phpを読み込む
$pdo = db_conn(); //db_conn()を実行&$pdoに格納

//３．データ登録SQL作成 
$stmt = $pdo->prepare('DELETE FROM user_data_03 WHERE user_id = :user_id;');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); //ID分を記載
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: select.php');
    exit();
}
