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
               <p> A：The book he is reading is very ____ .<br></p>

            <form action="answer2.php" method="post">
            <input type="radio" name="q1" value="1" id="1-1"> <label for="1-1">bored</label><br>
            <input type="radio" name="q1" value="2" id="1-2"> <label for="1-2">boring</label>

         </div>

        <div class="question">
            <h4 class="Q">Q2 空所に当てはまるものを選択肢から選んでください</h4>
            <p>Mary is ____ is called a genius.</p>

                <input type="radio" name="q2" value="1" id="2-1"> <label for="2-1">which</label><br>
                <input type="radio" name="q2" value="2" id="2-2"> <label for="2-2">what</label><br>
                <input type="radio" name="q2" value="3" id="2-3"> <label for="2-3">that</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q3 空所に当てはまるものを選択肢から選んでください</h4>
            <p>公園にはかつてタワーがあった。</p>
            <p>There ____ a tower in the park.</p>
                <input type="radio" name="q3" value="1" id="3-1"> <label for="3-1">is uset to being</label><br>
                <input type="radio" name="q3" value="2" id="3-2"> <label for="3-2">used to be</label><br>
                <input type="radio" name="q3" value="3" id="3-3"> <label for="3-3">would</label><br>
        </div>

        <div class="question">
            <h4 class="Q">Q4 空所に当てはまるものを選択肢から選んでください</h4>
            <p>Rich ___ he is, he isn't sutisfied with his life.</p>
                <input type="radio" name="q4" value="1" id="4-1"> <label for="4-1">despite</label><br>
                <input type="radio" name="q4" value="2" id="4-2"> <label for="4-2">when</label><br>
                <input type="radio" name="q4" value="3" id="4-3"> <label for="4-3">as</label><br>
        </div>

        <div class="question">
            <h4 class="Q">Q5 空所に当てはまるものを選択肢から選んでください</h4>
            <p> The airplane ______ at Nrita Station by tomorrow.</p>
                <input type="radio" name="q5" value="1" id="5-1"> <label for="5-1">will arrive</label><br>
                <input type="radio" name="q5" value="2" id="5-2"> <label for="5-2">has arrived</label><br>
                <input type="radio" name="q5" value="3" id="5-3"> <label for="5-3">will have arrived</label><br>
        </div>

        <div class="question">
            <h4 class="Q">Q6 空所に当てはまるものを選択肢から選んでください</h4>
            <p>You ______ go out late at night.</p>

                <input type="radio" name="q6" value="1" id="6-1"> <label for="6-1">had better not</label><br>
                <input type="radio" name="q6" value="2" id="6-2"> <label for="6-2">had not better</label><br>
                <input type="radio" name="q6" value="3" id="6-3"> <label for="6-3">not had better</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q7 空所に当てはまるものを選択肢から選んでください</h4>
            <p>I prefer playing sports ____ watching TV.</p>

                <input type="radio" name="q7" value="1" id="7-1"> <label for="7-1">to</label><br>
                <input type="radio" name="q7" value="2" id="7-2"> <label for="7-2">but</label><br>
                <input type="radio" name="q7" value="3" id="7-3"> <label for="7-3">for</label><br>

        </div>

        <div class="question">
            <h4 class="Q">Q8 空所に当てはまるものを選択肢から選んでください</h4>
            <p>John is a kind man, _____?</p>

                <input type="radio" name="q8" value="1" id="8-1"> <label for="8-1">doesn't he</label><br>
                <input type="radio" name="q8" value="2" id="8-2"> <label for="8-2">isn't he</label><br>
                <input type="radio" name="q8" value="3" id="8-3"> <label for="8-3">is he?</label><br>

        </div>


        <div class="question">
            <h4 class="Q">Q9 空所に当てはまるものを選択肢から選んでください</h4>
            <p>I cannot believe ____ fast he can run!</p>

                <input type="radio" name="q9" value="1" id="9-1"> <label for="9-1">so</label><br>
                <input type="radio" name="q9" value="2" id="9-2"> <label for="9-2">how</label><br>
                <input type="radio" name="q9" value="3" id="9-3"> <label for="9-3">such</label><br>
        </div>

        <div class="question">
            <h4 class="Q">Q10空所に当てはまる前置詞を入力してください</h4>
            <p> She was almost run ___ by a car.</p>

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
</html>