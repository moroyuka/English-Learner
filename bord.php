
<?php



//ログインしていない場合ログイン画面に戻る
session_start();
if (!isset($_SESSION["user"])) {
    header('location: login.php');
    exit();
}

    //データベース接続
    $dsn='データベース名';
    $user='ユーザー名';
    $password='パスワード';
    $pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

     //pre_likesのテーブル作成
     $sql = "CREATE TABLE IF NOT EXISTS pre_likes"
     ." ("
     . "id INT,"
     . "address VARCHAR(200)"
     .");";
    $stmt = $pdo->query($sql);

    //likesのテーブル作成
    $sql = "CREATE TABLE IF NOT EXISTS likes"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"//投稿番号
    . "num int"//いいね数
    .");";
     $stmt = $pdo->query($sql);

    //掲示板テーブル作成
    $sql="CREATE TABLE IF NOT EXISTS bord"
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"//重複しないためprimary
    ."name char(32),"//名前３２字
    ."comment TEXT,"//コメントはテキスト
    ."detail TEXT,"
    ."date TEXT,"//date関数で取得してるからテキストで行けそう
    ."address VARCHAR(200)"
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
            }
        }


    //書き込み用のコード

    //編集時の書き込み
    if (!empty($_POST{"post"})) {
        if (!empty($_POST["comment"] && $_POST["detail"] && $_POST["edit_num"])) {
            $date=date("Y/m/d H:i:s");
            $comment = $_POST["comment"];
            $detail=$_POST["detail"];
            $id = $_POST['edit_num'];
            $sql = 'UPDATE bord SET comment=:comment, detail=:detail, date=:date WHERE id=:id';
            $stmt = $pdo -> prepare($sql);
            $stmt ->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt ->bindParam(':detail', $detail, PDO::PARAM_STR);
            $stmt ->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt ->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt -> execute();
        //通常の書き込み
        } elseif (!empty($_POST["comment"] && $_POST["detail"])) {
            $comment = $_POST["comment"];
            $detail=$_POST["detail"];
            $date=date("Y/m/d H:i:s");
            $sql = $pdo -> prepare("INSERT INTO bord (name, comment, detail, address, date) VALUES (:name, :comment, :detail, :address, :date)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':detail', $detail, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $sql -> bindParam(':address', $address, PDO::PARAM_STR);
            $sql -> execute();
            $sql = $pdo -> prepare("INSERT INTO likes (num) VALUES (0)");
            $sql -> execute();
        } else {
            $error= "全項目を入力してください。";
        }
    }
    

    //削除用のコード
    if (!empty($_POST["delete_id"])) {
        $id = $_POST["delete"];
        $sql='DELETE FROM bord WHERE id=:id';//id番目のもの全て
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //編集情報をテキストボックスに表示するためコード
    if (!empty($_POST["edit_id"])) {
        $id=$_POST["edit"];
        $sql = "SELECT * FROM bord";
        $stmt = $pdo -> query($sql);
        $results = $stmt->fetchAll();
        foreach ($results as $row) {
            if ($row['id']==$id) {
                $edit_num = $row['id'];
                $edit_comment=$row['comment'];
                $edit_detail=$row['detail'];
            }
        }
    }


     //いいね機能
        $sql = 'SELECT * FROM pre_likes';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        if (!empty($_POST["submit_likes"])) {
            if (!empty($_POST["address_likes"])) {
                foreach ($results as $row) {
                    //一致するアドレスある時→いいねの取り消し
                    if ($_POST["address_likes"]==$row["address"]&&$_POST["id"]==$row["id"]) {
                        $confirm="確認";//この変数があるかないかですでにいいねしてるか確認
                    }
                }
            }
                
            if (!empty($confirm)) {
                $address = $_POST["address_likes"];
                $sql = 'DELETE FROM pre_likes WHERE address=:address';//いいねの取り消し
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':address', $address, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                //いいねする
                $sql = $pdo -> prepare("INSERT INTO pre_likes (id, address) VALUES (:id, :address)");
                $address = $_POST["address_likes"];
                $id = $_POST["id"];
                $sql -> bindParam(':address', $address, PDO::PARAM_STR);
                $sql -> bindParam(':id', $id, PDO::PARAM_INT);
                $sql -> execute();
            }
        }
        
    

            //いいね数のカウント
            if (!empty($_POST["id"])) {
                //前のカウント数一回消す
                $id = $_POST["id"];
                $sql = 'DELETE FROM likes WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                //pre_likesのidの数を数える
                $stmt = $pdo -> prepare("SELECT COUNT(id) FROM pre_likes WHERE id=:id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt -> execute();
                $num = (int)$stmt->fetchColumn();
                //カウント結果書き込み
                $sql = $pdo -> prepare("INSERT INTO likes (id,num) VALUES (:id,:num)");
                $sql -> bindParam(':id', $id, PDO::PARAM_INT);
                $sql -> bindParam(':num', $num, PDO::PARAM_INT);
                $sql -> execute();
            }
        



?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
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



    <div class="wrapper bord">
            <h2>Bulletin Bord</h2>
            <form action="" class="post" method="post">
                <table>
                    <tr>
                        <td>おすすめアプリ or 勉強法</td>
                        <td><input type="text" name="comment" value = "<?php if (!empty($edit_comment)) {
    echo $edit_comment;
}?>"></td>
                    </tr>

                    <tr>
                        <td>アプリ内容 or 勉強法の詳細</td>
                        <td><textarea name="detail" id="" cols="30" rows="10"><?php if (!empty($edit_detail)) {
    echo $edit_detail;
}?></textarea></td>
                    </tr>

                </table>
                <input type="hidden" name="edit_num" value="<?php if (!empty($edit_num)) {
    echo $edit_num;
}?>">

                <input type="submit" name="post" value="投稿" class="main_post">
                <h2>投稿</h2>

<?php


if (isset($error)) {
    echo $error;//全項目入力してくださいのエラー
}

    //投稿表示
$sql = 'SELECT * FROM bord';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
    foreach ($results as $row) {
        //内容の表示
        $row_id=$row['id'];
        echo '<br>'.$row_id.',';
        echo $row['name'].'<br>';
        echo 'おすすめアプリ or 勉強法'.'<br>';
        echo $row['comment'].'<br>';
        echo '詳細'.'<br>';
        echo $row['detail'].'<br>';
        echo $row['date'].'<br>';
        if ($row["address"]==$address) {
            echo "<div class='delete_edit'><form action='' method='post'><input type='hidden' name='edit' value='$row_id'><input type='submit' name='edit_id' class='submit' value='編集'><input type='hidden' name='delete' value='$row_id'><input type='submit' name='delete_id'  value='削除'></form></div>";
        }

        //いいねの表示
        $sql = 'SELECT * FROM likes';
        $stmt = $pdo->query($sql);
        $likes_results = $stmt->fetchAll();
        foreach ($likes_results as $likes_row) {
            $Clikes=$likes_row["num"];
            if ($row['id']==$likes_row['id']) {
                echo "<form method='post' ><input type='hidden' name='id' value='$row_id'><input type='hidden' name='address_likes' value='$address'><input type='submit' class='far good_css' name='submit_likes' value='&#xf164; いいね$Clikes'> </form><br>";
            }
        }

        echo '<hr>';
    }
?>

            </form>
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