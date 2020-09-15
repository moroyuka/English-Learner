<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz login</title>
    <link rel="stylesheet" href="site.css">
</head>
<body>
<?php
session_start();

//DB
$dsn='データベース名';
$user='ユーザ名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

?>

    <?php

    //ログイン処理
    if (!empty($_POST)) {
        if (!empty($_POST["address"] && !empty($_POST["pass"]))) {
            $pass=$_POST["pass"];
            $address=$_POST["address"];
            $sql='SELECT * FROM resister where address=:address';//アドレスが一致するモノを取得
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                if ($pass==$row['pass']) {//テーブルのパスと入力されたパス一致する時
                    $_SESSION["user"]=$_POST;//sessionにユーザ情報保持
                    header("Location: main.php");//メインへ
                    exit();
                } elseif ($pass!==$row['pass']) {
                    $error= "パスワードが違います";
                }
            }
        } else {
            $input_error="全項目入力必須です";
        }
    }
    ?>
    <section class="header">
        <h1 class="resister_str">English Learner<h1>
    </section>
    
    <section class="main wrapper login_main">
        <h1 class="main_str">Login</h1>

        <form action="" method=post>
        <input type="text" name="address" placeholder="メールアドレス">
        <input type="text" name="pass" placeholder="パスワード">
        <input type="submit" value="ログイン">
        </form>

        <div class="resister_error">
            <p>
                <?php
                    if (!empty($error)) {
                        echo $error."<br>";//パス違う
                    }
                    if (!empty($input_error)) {
                        echo $input_error."<br>";//入力して
                    }
                ?>
            </p>
        </div><!--resister_error-->

        <br><h3 class="resister"><a href="send_test.php">Resister</a></h3><br>

        <p>　英語のクイズ＋みんなのおすすめアプリや勉強法をシェアできる掲示板があるよ！</p>
    </section><!--main wrapper login_main-->

 


<div class="footer">
    
</div>

</body>
</html>