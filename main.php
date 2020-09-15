<?php
session_start();

//session情報ない時ログインに戻る
if (!isset($_SESSION["user"])){
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



    <section class="header"><!--header-->
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


    <section class="main_top wrapper"><!--main-->
        <h1 class="top_str">Welcome to English Learner!</h1>       

        <div class="explain">
            <h2><a href="site.php">Quiz</a></h2>
            <p>11問のクイズに挑戦！</p>
        </div>

        <div class="explain">
            <h2><a href="bord.php">Bulletin Board</a></h2>
            <p>おすすめのアプリや勉強法をシェアしよう！</p>
        </div>
 
    </section><!--main wrapper-->

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