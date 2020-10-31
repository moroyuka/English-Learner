<?php
session_start();
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    
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

//sessionなければログインに戻る
if (!isset($_SESSION["user"])) {
    header('location: login.php');
    exit();
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



    <section class="header">
        <nav>
            <ul class="main_nav">
                <li><a href="main.php">main</a></li>
                <li><a href="site.php">Quiz</a></li>
                <li><a href="bord.php">Bulletin board</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
        <h1 class="header-str">English Learner<h1>
    </section>


    <section class="main">
        <nav class="quiz_nav">
                <h2><a href="part1.php">Part1にチャレンジ</a></h2>
                <p class="past_result">過去の成績 <br>

                <?php
                    $sql = 'SELECT * FROM result1';
                    $stmt = $pdo->query($sql);
                    $results = $stmt->fetchAll();
                    $counter = 1;
                        foreach ($results as $row) {
                            if ($address == $row["address"]) {
                                echo $counter."回目"." ".$row["score"]."点"."<br>";
                                $counter++;
                            }
                        }
                ?>
                </p>

                <h2><a href="part2.php">Part2にチャレンジ</a></h2>
                <p class="past_result">過去の成績<br>
                
                <?php
                    $sql = 'SELECT * FROM result2';
                    $stmt = $pdo->query($sql);
                    $results = $stmt->fetchAll();
                    $counter = 1;
                        foreach ($results as $row) {
                            if ($address == $row["address"]) {
                                echo $counter."回目"." ".$row["score"]."点"."<br>";
                                $counter++;
                            }
                        }
                ?>
                </p>
        </nav>
    </section>


    <section class="footer">
        <nav>
            <ul class="main_nav">
                <li><a href="main.php">main</a></li>
                <li><a href="site.php">Quiz</a></li>
                <li><a href="bord.php">Bulletin board</a></li>
                <li><a href="#">Page Top</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </section>
</body>
</html>