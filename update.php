<?php

//1. POSTデータ取得
$name   = $_POST['name'];
$email  = $_POST['email'];
$password_hash  = $_POST['password_hash'];
$address  = $_POST['address'];
$balcony_orientation = $_POST['balcony_orientation']; //hiddenで取得したidを取得
$user_id    = $_POST['user_id']; //hiddenで取得したidを取得

echo "name: $name, email: $email, password_hash: $password_hash, address: $address, balcony_orientation: $balcony_orientation<br>";

//2. DB接続
require_once('funcs.php'); //funcs.phpを読み込む
$pdo = db_conn(); //db_conn()を実行&$pdoに格納

if ($pdo) {
    echo 'DB接続成功';
} else {
    echo 'DB接続失敗';
    exit();
}


//３．データ登録SQL作成 
$stmt = $pdo->prepare('UPDATE 
                        user_data_03 
                        SET 
                        name = :name,
                        email = :email,
                        password_hash = :password_hash,
                        address = :address,
                        balcony_orientation = :balcony_orientation,
                        indate = sysdate() 
                        WHERE user_id = :user_id;
                        ');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':balcony_orientation', $balcony_orientation, PDO::PARAM_STR);
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
