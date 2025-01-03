<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ユーザー情報登録</legend>
                <label>名前:<input type="text" name="name"></label><br>
                <label>Email:<input type="text" name="email"></label><br>
                <label>PassWord:<input type="text" name="password_hash"></label><br>
                <label>住所:<input type="text" name="address"></label><br>
                <label>家の向き:<select name="balcony_orientation">
                        <option value="">選択してください</option>
                        <option value="N">北</option>
                        <option value="S">南</option>
                        <option value="E">東</option>
                        <option value="W">西</option><br>
                </label><br>
                <!-- <label>備考:<textarea name="content" rows="4" cols="40"></textarea></label><br> -->
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>