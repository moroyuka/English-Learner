
<?php

//ログインしていない場合ログイン画面に戻る
session_start();
if (!isset($_SESSION["user"])){
    header('location: login.php');
    exit();
}

    //データベース接続
    $dsn='データベース名';
    $user='ユーザー名';
    $password='パスワード';
    $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //掲示板テーブル作成
    $sql="CREATE TABLE IF NOT EXISTS bord"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"//重複しないためprimary
    ."name char(32),"//名前３２字
    ."comment TEXT,"//コメントはテキスト
    ."detail TEXT,"
    ."date TEXT,"//date関数で取得してるからテキストで行けそう
    ."pass char(32)"//パス３２文字
    .");";
    $stmt = $pdo->query($sql);

    
    //address元にユーザの登録情報を取得
    $address=$_SESSION["user"]["address"];
    $sql='SELECT * FROM resister WHERE address=:address';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':address', $address, PDO::PARAM_INT);
    $stmt->execute();                         
    $results = $stmt->fetchAll();
        foreach ($results as $row) {
            if ($address==$row["address"]) {
                $name= $row["name"];
                $pass=$row["pass"];
            }
        }


    //書き込み用のコード
    if (!empty($_POST)) {
        if (!empty($_POST["name"]&& $_POST["comment"] && $_POST["detail"] && $_POST["pass"])) {
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $detail=$_POST["detail"];
            $date=date("Y/m/d H:i:s");
            $pass=$_POST["pass"];
            $sql = $pdo -> prepare("INSERT INTO bord (name, comment, detail, pass, date) VALUES (:name, :comment, :detail, :pass, :date)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':detail', $detail, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
            $sql -> execute();
        } else {
            $error= "全項目を入力してください。";
        }
    }

    //削除用のコード
    if (!empty($_GET)) {
        if (!empty($_GET["delete"] &&!empty($_GET["pass2"]))) {
            $id = $_GET["delete"];
            $sql='SELECT * FROM bord WHERE id=:id';//id番目のもの全て
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $row) {
                if ($_GET["pass2"]==$row['pass']) {//パスが一致する時
                    $sql = 'delete from bord where id=:id';//id番目を削除
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                } else {
                    $pass_differ ="あなたの投稿ではありません。";
                }
            }
        }
    }



?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz</title>
    <link rel="stylesheet" href="site.css">
</head>

<body>



    <div class="header">
        <nav>
            <ul class="main_nav">
                <li><a href="main.php">main</a></li>
                <li><a href="site.php">Quiz</a></li>
                <li><a href="bord.php">Bulletin board</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
        <h1 class="header-str">English Learner<h1>
    </div>



    <div class="bord_contents wrapper">

        <div class="article">
            <h2>投稿</h2>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>おすすめアプリ or 勉強法</td>
                        <td><input type="text" name="comment"></td>
                    </tr>

                    <tr>
                        <td>アプリ内容 or 勉強法の詳細</td>
                        <td><textarea name="detail" id="" cols="30" rows="10"></textarea></td>
                    </tr>

                </table>

                <!--投稿フォーム-->
                <input type="hidden" name="name" value="<?php echo $name;?>">
                <input type="hidden" name="pass" value="<?php echo $pass;?>">
                <input type="submit" class="submit" value="投稿">

                <?php


if (isset($error)) {
    echo $error;//全項目入力してくださいのエラー
}

    //投稿表示
$sql = 'SELECT * FROM bord';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
    foreach ($results as $row) {
        //$rowの中にはテーブルのカラム名が入る
        echo '<br>'.$row['id'].',';
        echo $row['name'].'<br>';
        echo 'おすすめアプリ or 勉強法'.'<br>';
        echo $row['comment'].'<br>';
        echo '詳細'.'<br>';
        echo $row['detail'].'<br>';
        echo $row['date'].'<br>';
        echo '<hr>';
    }
?>

            </form>
        </div><!--article-->

        <!--削除フォーム-->
        <div class="aside">
            <h2>削除</h2>
            <p>あなたの投稿が削除可能です。</p>
            <form action="" method="get" class="delete">
                <input type="text" name="delete" placeholder="削除対象番号">
                <input type="hidden" name="pass2" value="<?php echo $pass;?>"><br>
                <input type="submit" value="削除" class="submit_delete">
            </form>
              <p>
                <?php
                    if(isset($pass_differ)){
                        echo $pass_differ;//パスワード違う
                    }
                ?>
              </p>

        </div>
    </div>



    <div class="footer">
        <nav>
            <ul class="main_nav">
                <li><a href="main.php">main</a></li>
                <li><a href="site.php">Quiz</a></li>
                <li><a href="bord.php">Bulletin board</a></li>
                <li><a href="#">Page Top</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </div>



</body>

</html>