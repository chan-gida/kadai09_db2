<?php

//1. ID取得・DB接続
$user_id = $_GET['user_id'];
var_dump($user_id);

require_once('funcs.php'); //funcs.phpを読み込む
$pdo = db_conn(); //db_conn()を実行&$pdoに格納

if ($pdo) {
    echo 'DB接続成功';
} else {
    echo 'DB接続失敗';
    exit();
}

//２．データ登録SQL作成 from select.php
$stmt = $pdo->prepare('SELECT * FROM user_data_03 WHERE user_id = :user_id;');
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); //フォームから送られてきたらbindValue
$status = $stmt->execute(); //成功したらTRUES, 失敗したらFALSE

//３．データ表示 
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
}

// var_dump($result);


?>

<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!-- method, action, 各inputのnameを確認してください。  -->
<form method="POST" action="update.php">
    <div class="jumbotron">
        <fieldset>
            <legend>ユーザー情報登録</legend>
            <label>名前:<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
            <label>Email:<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
            <label>PassWord:<input type="text" name="password_hash" value="<?= $result['password_hash'] ?>"></label><br>
            <label>年齢:<input type="text" name="address" value="<?= $result['address'] ?>"></label><br>
            <label>家の向き:<select name="balcony_orientation">
                    <option value="N" <?= $result['balcony_orientation'] == 'N' ? 'selected' : '' ?>>北</option>
                    <option value="S" <?= $result['balcony_orientation'] == 'S' ? 'selected' : '' ?>>南</option>
                    <option value="E" <?= $result['balcony_orientation'] == 'E' ? 'selected' : '' ?>>東</option>
                    <option value="W" <?= $result['balcony_orientation'] == 'W' ? 'selected' : '' ?>>西</option>
                </select>
            </label><br>
            <!-- idを送るインプットを加える -->
            <!-- type="hidden" に書き換えてブラウザから見えないようにする -->
            <input type="hidden" name="user_id" value="<?= $result['user_id'] ?>">
            <input type="submit" value="更新">
        </fieldset>
    </div>
</form>