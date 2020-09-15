<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz resister</title>
    <link rel="stylesheet" href="site.css">
</head>
<body>

<?php
session_start();

//DB
  $dsn='データベース名';
  $user='ユーザー名';
  $password='パスワード';
  $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

  $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
  $token = $_SESSION['token'];

  $urltoken =$_GET["urltoken"];

//tokenなかったら仮登録の画面に戻る
  if (!isset($urltoken)) {
      header('location: send_test.php');
      exit();
  }

  $sql='SELECT * FROM pre_resister WHERE urltoken=:urltoken';//同じトークンのモノ
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':urltoken', $urltoken, PDO::PARAM_INT);
  $stmt->execute();
  $results = $stmt->fetchAll();
  foreach ($results as $row) {
      if ($urltoken==$row["urltoken"]) {//トークン一致したら
          $name= $row['name'];
          $address= $row['address'];
      }
  }
if (!isset($name)) {//もし上記の処理がうまくいかなかったら
    $replay="登録中にエラーが発生しました。恐れ入りますが、仮登録から再度行ってください。";
}


if (empty($_POST["pass"])) {
    $input_error="パスワードを入力してください";
}

?>




<?php

if (!empty($_POST) && !empty($_POST["pass"]) && !empty($name)) {
    $date=date("Y/m/d H:i:s");
    $pass=$_POST["pass"];
    $sql='SELECT address FROM resister WHERE address=:address';//address一致するものを取得
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        if ($address==$row['address']) {//アドレスと入力されたアドレス一致する時
            $existrow=$row["address"];//変数作る
        }
    }
    if (isset($existrow)) {//上記の処理でアドレス登録済みで変数作成された時
        $exist_error= "このアドレスは登録済みです";
    } else {//未登録のアドレス
        $sql = $pdo -> prepare("INSERT INTO resister (name, address, pass, date) VALUES (:name, :address, :pass, :date)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);//それぞれを入力された＄〜で再度書き込み
        $sql -> bindParam(':address', $address, PDO::PARAM_STR);
        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
        $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
        $sql -> execute();//query実行
        $finished= "登録完了！";
    }
} elseif(!empty($_POST) && empty($name)) {
    $replay2="登録中にエラーが発生しました。恐れ入りますが、仮登録から再度行ってください。";
}

    ;?>
<section class="header">
     <h1 class="resister_str">English Learner<h1>
</section>

<section class="main wrapper login_main">
    <h1 class="main_str">本登録</h1>
    <h4> パスワードを入力して本登録を完了してください。</h4>
    <?php
    if (!empty($replay)) {
        echo $replay."<br>";
    };?>
    <form action="" method=post><!--送信フォーム-->
        <input type="text" name="pass" placeholder="パスワード">
        <input type="submit" value="送信">
    </form>

    <div class="resister_error">
        <p>
            <?php
                if (!empty($replay2)) {
                    echo $replay2."<br>";
                };
                if (!empty($input_error) && !empty($_POST)) {
                    echo $input_error."<br>";
                }
                if (!empty($exist_error)) {
                    echo $exist_error."<br>";
                }
                if (!empty($finished)) {
                    echo $finished."<br>";
                }
            ?>
        </p>
    </div>

    <a href="login.php" class="login_icon">ログインはこちら</a>
 </section><!--main wrapper login_main-->


<div class="footer">
 
</div>
</body>
</html>