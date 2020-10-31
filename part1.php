<?php
session_start();

//sessionなければログインに戻る
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


    <section class="main wrapper quiz">
        <h1 class="main_str">問題に答えてね</h1>
        <div class="question">
            <h4 class="Q">Q1. 空所に当てはまるものを選択肢から選んでください</h4>
               <p> A：Do you know a girl who came to here yesterday?<br>
                B：Yes, I know ___ girl.<br></p>

            <form action="answer1.php" method="post">
            <input type="radio" name="q1" value="1" id="1-1"> <label for="1-1">a</label><br>
            <input type="radio" name="q1" value="2" id="1-2"> <label for="1-2">the</label>

         </div>

        <div class="question">
            <h4 class="Q">Q2 空所に当てはまるものを選択肢から選んでください</h4>
            <p>It  ___  three years since I graduated from high school.</p>

                <input type="radio" name="q2" value="1" id="2-1"> <label for="2-1">has passed</label><br>
                <input type="radio" name="q2" value="2" id="2-2"> <label for="2-2">passed</label><br>
                <input type="radio" name="q2" value="3" id="2-3"> <label for="2-3">has been</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q3 空所に当てはまるものを選択肢から選んでください</h4>
            <p>He is accustomed to ___ around here.</p>

                <input type="radio" name="q3" value="1" id="3-1"> <label for="3-1">run</label><br>
                <input type="radio" name="q3" value="2" id="3-2"> <label for="3-2">running</label><br>
                <input type="radio" name="q3" value="3" id="3-3"> <label for="3-3">runs</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q4 空所に当てはまるものを選択肢から選んでください</h4>
            <p>___this city for the first time, she is very excited.</p>

                <input type="radio" name="q4" value="1" id="4-1"> <label for="4-1">visited</label><br>
                <input type="radio" name="q4" value="2" id="4-2"> <label for="4-2">visits</label><br>
                <input type="radio" name="q4" value="3" id="4-3"> <label for="4-3">visiting</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q5 空所に当てはまるものを選択肢から選んでください</h4>
            <p>Chiba is the city ___ I grow up in.</p>

                <input type="radio" name="q5" value="1" id="5-1"> <label for="5-1">where</label><br>
                <input type="radio" name="q5" value="2" id="5-2"> <label for="5-2">which</label><br>
                <input type="radio" name="q5" value="3" id="5-3"> <label for="5-3">what</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q6 空所に当てはまるものを選択肢から選んでください</h4>
            <p>I don’t know if Tom ___ here tomorrow.</p>

                <input type="radio" name="q6" value="1" id="6-1"> <label for="6-1">will come</label><br>
                <input type="radio" name="q6" value="2" id="6-2"> <label for="6-2">comes</label><br>
                <input type="radio" name="q6" value="3" id="6-3"> <label for="6-3">is</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q7 空所に当てはまるものを選択肢から選んでください</h4>
            <p>I’ll never forget ____ a good time with you.</p>

                <input type="radio" name="q7" value="1" id="7-1"> <label for="7-1">to have</label><br>
                <input type="radio" name="q7" value="2" id="7-2"> <label for="7-2">having</label><br>
                <input type="radio" name="q7" value="3" id="7-3"> <label for="7-3">had</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q8 空所に当てはまるものを選択肢から選んでください</h4>
            <p>The number of students in the school ____ more than 200.</p>

                <input type="radio" name="q8" value="1" id="8-1"> <label for="8-1">is</label><br>
                <input type="radio" name="q8" value="2" id="8-2"> <label for="8-2">are</label><br>
                <input type="radio" name="q8" value="3" id="8-3"> <label for="8-3">has</label><br>

        </div>


        <div class="question">
            <h4 class="Q">Q9 空所に当てはまるものを選択肢から選んでください</h4>
            <p>There’s no one as ____ as we can see.</p>

                <input type="radio" name="q9" value="1" id="9-1"> <label for="9-1">far</label><br>
                <input type="radio" name="q9" value="2" id="9-2"> <label for="9-2">long</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q10 空所に当てはまる前置詞を入力してください</h4>
            <p> I cannot deal ____ this problem.</p>

                <input type="text" name="q10" placeholder="答えを入力してください">
  
        </div>

        <div class="submit">

                <input type="hidden" name="judge" value="判定">
        </div>
        <input type="submit" value="答え合わせ">
        </form>
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
<script src="menu.js"></script>
</html>
