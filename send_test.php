<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pre pre_resister</title>
    <link rel="stylesheet" href="site.css">
</head>
<body>


<?php
session_start();

$dsn='データベース名';
$user='ユーザ名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//仮登録のデータベース
$sql="CREATE TABLE IF NOT EXISTS pre_resister"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"//重複しないためprimary
."name char(32),"//名前３２字
."address VARCHAR(255),"
."urltoken VARCHAR(255)"//パス３２文字
.");";
$stmt = $pdo->query($sql);

//本登録のデータベース
$sql="CREATE TABLE IF NOT EXISTS resister"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"//重複しないためprimary
."name char(32),"//名前３２字
."address VARCHAR(255),"
."date TEXT,"//date関数で取得してるからテキストで行けそう
."pass char(32)"//パス３２文字
.");";
$stmt = $pdo->query($sql);

 
//token
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];


?>


<?php
//他ファイルとの接続
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'setting.php';

//フォーム送信されたとき
if (!empty($_POST)) {
    if (!empty($_POST["address"])&& $_POST["name"]) {
        $address=$_POST["address"];
        $name=$_POST["name"];
        $urltoken = hash('sha256', uniqid(rand(), 1));
        $url = "https://tb-220039.tech-base.net/web/resister.php"."?urltoken=".$urltoken;//urlを本登録のurl+tokenで
        $sql='SELECT address FROM resister';
        $stmt = $pdo->prepare($sql);  //ここもめんどい書き方してると思う
        $stmt->execute();
        $results = $stmt->fetchAll();
            foreach ($results as $row) {//もし一致するアドレスあれば、変数を作る
                if ($_POST["address"]==$row['address']) {//パスと入力されたパス一致する時
                    $existrow=$row["address"];
                }
            }
        if (isset($existrow)) {//変数が存在したらエラー
            $address_error= "このアドレスは登録済みです";
        } else {//情報登録
            $sql = $pdo -> prepare("INSERT INTO pre_resister (name, address, urltoken) VALUES (:name, :address, :urltoken)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);//それぞれを入力された＄〜で再度書き込み
            $sql -> bindParam(':address', $address, PDO::PARAM_STR);
            $sql -> bindParam(':urltoken', $urltoken, PDO::PARAM_STR);
            $sql -> execute();//query実行
    
            // PHPMailerのインスタンス生成
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
            $mail->SMTPAuth = true;
            $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
            $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
            $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
            $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
            $mail->Port = SMTP_PORT; // 接続するTCPポート

            // メール内容設定
                $mail->CharSet = "UTF-8";
                $mail->Encoding = "base64";
                $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
                $mail->addAddress($address, $name."さん"); //受信者（送信先）を追加する
            //$mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
            //$mail->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
            //$mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
                $mail->Subject = MAIL_SUBJECT; // メールタイトル
                $mail->isHTML(true);    // HTMLフォーマットの場合はこれを設定
                $body = $name.'様<br>この度はEnglish Learnerに興味を持っていただきありがとうございます。<br>以下のURLから本登録をお願いいたします。<br>'.$url;

                $mail->Body  = $body; // メール本文
            // メール送信の実行
                if (!$mail->send()) {
                    $mail_error= 'メッセージは送られませんでした！';
                    $mail_error2= 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                    $successed= '送信完了！<br>メールに記載されているリンクから本登録を行ってください。<br>メールが届かない場合は再度この画面からメールアドレス、ニックネームの送信をお願いいたします。';
                    }
                }
    } else {
        $error="全項目入力必須です。";
    }
}
?>
<div class="header">
    <h1 class="resister_str">English Learner<h1>
</div>
<div class="main wrapper login_main">
    <h1 class="main_str">仮登録情報を入力してください</h1>
    <form action="" method=post>
        <input type="text" name="address" placeholder="メールアドレス">
        <input type="text" name="name" placeholder="ニックネーム">
        <input type="submit" value="送信">
        <input type="hidden" name="token" value="<?=$token?>"><br>

<p class="resister_error">
    
            <?php

    //エラーメッセージ
    
    if (!empty($error)) {
        echo  $error;//全項目入力
    }
    if (!empty($address_error)) {
        echo  $address_error;//アドレス登録済み
    }
    if (!empty($mail_error)) {
        echo $mail_error;
        echo $mail_error2;//メール送信失敗
    }
    if (!empty($successed)) {
        echo $successed;//送信成功
    }
    ?>
</p>

        <p><a href="login.php" class="login_icon"><br>  ログインはこちら</a></p>

    </form>
</div>

<div class="footer">

</div>
</body>

</html>