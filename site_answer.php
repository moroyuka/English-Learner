<?php
    session_start();
    
    //sessionなかったら戻る
    if (!isset($_SESSION["user"])){
        header('location: login.php');
        exit();
    }

        $number=array();//配列作る。送られた答えが正解なら、配列に追加していく

        if (!empty($_POST["q1"])) {
            if ($_POST["q1"]==2) {//正解なら
                $q1= "○";
                array_push($number, "q1");//array_pusyする
            }else {
                $q1= "×";//回答してて×
            }
        } else {
            $q1= "×";//未回答で×
        }
        

        if (!empty($_POST["q2"])) {
            if ($_POST["q2"]==3) {
                $q2= "○";
                array_push($number, "q2");
            }else {
                $q2= "×";
            }
        } else {
            $q2= "×";
        }
        

        if (!empty($_POST["q3"])) {
            if ($_POST["q3"]==2) {
                $q3= "○";
                array_push($number, "q3");
            }else {
                $q3= "×";
            }
        } else {
            $q3= "×";
        }
        

        if (!empty($_POST["q4"])) {
            if ($_POST["q4"]==3) {
                $q4= "○";
                array_push($number, "q4");
            }else {
                $q4= "×";
            }
        } else {
            $q4= "×";
        }
        

        if (!empty($_POST["q5"])) {
            if ($_POST["q5"]==2) {
                $q5= "○";
                array_push($number, "q5");
            }else {
                $q5= "×";
            }
        } else {
            $q5= "×";
        }
        

        if (!empty($_POST["q6"])) {
            if ($_POST["q6"]==1) {
                array_push($number, "q6");
                $q6= "○";
            }else {
                $q6= "×";
            }
        } else {
            $q6= "×";
        }
        

        if (!empty($_POST["q7"])) {
            if ($_POST["q7"]==2) {
                array_push($number, "q7");
                $q7= "○";
            }else {
                $q7= "×";
            }
        } else {
            $q7= "×";
        }
        

        if (!empty($_POST["q8"])) {
            if ($_POST["q8"]==1) {
                array_push($number, "q8");
                $q8= "○";
            }else {
                $q8= "×";
            }
        } else {
            $q8= "×";
        }
        

        if (!empty($_POST["q9"])) {
            if ($_POST["q9"]==1) {
                $q9= "○";
                array_push($number, "q9");
            }else {
                $q9= "×";
            }
        } else {
            $q9= "×";
        }
        

        if (!empty($_POST["q10"])) {
            if ($_POST["q10"]=="with") {
                array_push($number, "q10");
                $q10= "○";
            }else {
                $q10= "×";
            }
        } else {
            $q10= "×";
        }
        

        if (!empty($_POST["q11"])) {
            if ($_POST["q11"]=="over") {
                $q11= "○";
                array_push($number, "q11");
            }else {
                $q11= "×";
            }
        } else {
            $q11= "×";
        }
        

        if (empty($_POST)) {
            header('location: site.php');
            exit();
        }


    //結果コメント
    $results=count($number);//配列の中身数える（正答数）
    if ($results>=8) {//8問以上
        $message="すごい！";
    } elseif ($results>=6) {//6問以上
        $message="もう一歩！";
    } else {
        $message="頑張ろう！";
    }
    ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz answer</title>
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

<section class="main wrapper answer_main">
        <h1 class="main_str">解答＆解説</h1>

        <h2 class="results_number">11問中<span><?php echo $results;?></span>問正解！<?php echo $message;?></h2>

        <div class="answer">
            <h2 class="result"> Q1 <span><?php echo $q1?></span></h2>
            <p class="question">                   
                    [問題]<br>
                    A：Do you know a girl who came to here yesterday?<br>
                    B：Yes, I know ___ girl.<br><br>
                    ・a<br>
                    ・the
            </p><!--question-->

            <!--クリックの機能-->
            <div
                onclick="obj=document.getElementById('open1').style; obj.display=(obj.display=='none')?'block':'none';">
                <a class="open">▼ 解答解説を見る</a>
            </div>
            <!--クリックの中身-->
            <div id="open1" style="display:none;clear:both;">
                <p class="contents">
                    <span>A. the</span><br>
                    [解説]<br>
                    名詞が特定のものである場合the、不特定の場合aです。
                    この例文の場合Bさんの発話内容はa girlという特定の人物を指しているので,<br>
                    定冠詞theを選択します。
                </p>             
            </div>
         </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q2 <span><?php echo $q2?> </h2>
                <p class="question">                   
                    [問題]<br>
                    It ___ three years since I graduated from high school.<br><br>
                    ・has passed<br>
                    ・passed<br>
                    ・has been
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open2').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open2" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. has been</span><br>
                        [解説]<br>
                        時の経過を表す表現です。It has been 年数 since S Vの形を取ります。<br>
                        また、年数　have passed since SVとの書き換えも可能です。<br>
                        主語itに対してpassedは使えません。理由は時の経過を表す時に使うpassedは自動詞であるためです。<br>
                        そのためpassedの後にthree yearsがくると文法に反します。<br>
                        また、itが主語なので訳すと「それがすぎた」になってしまいおかしな文になってしまいます。<br>

                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q3 <span><?php echo $q3?> </h2>
                <p class="question">                   
                    [問題]<br>
                    He is accustomed to ___ around here.<br><br>
                    ・run<br>
                    ・running<br>
                    ・runs
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open3').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open3" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. running</span><br>
                        [解説]<br>
                        ここで使われるtoは前置詞のtoです。そのためrunningが正解です。<br>
                        前置詞toの問題は割と定番だと思うので頻出のto + 動名詞の表現は押さえておきましょう。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q4 <span><?php echo $q4?> </h2>
                <p class="question">                   
                    [問題]<br>
                    ___this city for the first time, she is very excited.<br><br>
                    ・visited<br>
                    ・visits<br>
                    ・visiting
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open4').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open4" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. visiting</span><br>
                        [解説]<br>
                        分詞構文の基礎問題です。<br>
                        元の文は[Because she visits this city for the first time, she is excited]です。<br>
                        すこしだけ分詞構文の作り方をおさらいしましょう。<br>
                        ①接続詞の省略<br>
                        ②主節と従属節の主語が一致しているか→していれば省略<br>
                        ③動詞を現在分詞に直す。→現在形ならVing 過去形ならhaving pp<br>
                        分詞構文は口語表現ではあまり使われないですが文語表現ではよく使われます。<br>
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q5 <span><?php echo $q5?> </h2>
                <p class="question">                   
                    [問題]<br>
                    Chiba is the city ___ I grow up in.<br><br>
                    ・where<br>
                    ・which<br>
                    ・what
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open5').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open5" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. which</span><br>
                        [解説]<br>
                        元の文を考えると[Chiba is the city.]と[I grow up in the city.]となるます。<br>
                        ここで押さえておきたいのがwhere, why, whenといった関係副詞は,<br>
                        必ず前置詞＋関係代名詞で表されるということです。<br>
                        問題文を見るとinがあるのでここではwhichが選択されます。<br>
                        もしinがなかったならばこの問題の答えはwhereまたはin whichとなります。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q6 <span><?php echo $q6?> </h2>
                <p class="question">                   
                    [問題]<br>
                    I don’t know if Tom ___ here tomorrow.<br><br>
                    ・will come<br>
                    ・comes<br>
                    ・is
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open6').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open6" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. will come</span><br>
                        [解説]<br>
                        名詞節を導くifの問題です。<br>
                        時・条件を表す副詞節を導くifでは未来形を使えませんが、名詞節を導くifは未来形を使えます。<br>
                        「〜かどうか」で訳せる時は名詞節を表すifだと考えられます。<br>
                        また、文構造から考えるならif以下は動詞(know)の目的語になっています。<br>
                        目的語になれるのは名詞なのでこのif節は名詞節だとわかります。<br>
                        whenも同じような特徴を持ち、「いつ」で訳せるwhenは名詞節を導くので未来形を使えます。
                    </p>
                </div>
            </div><!--answer-->


            <div class="answer">
                <h2 class="result"> Q7 <span><?php echo $q7?> </h2>
                <p class="question">                   
                    [問題]<br>
                    I’ll never forget ____ a good time with you.<br><br>
                    ・to have<br>
                    ・having<br>
                    ・had
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open7').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open7" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. having</span><br>
                        [解説]<br>
                        続く語が動名詞か不定詞かで意味が変わる動詞の問題です。<br>
                        この手の問題は一貫してingは過去の意味を持ち、toは未来の意味を持つと理解しておけば答えられると思います。<br>
                        この文では「あなたと楽しい時間を過ごしたのを決して忘れない」という意味で過去のニュアンスがあります。<br>
                        そのためhavingが選択されます。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q8 <span><?php echo $q8?> </h2>
                <p class="question">                   
                    [問題]<br>
                    The number of students in the school ____ more than 200.<br><br>
                    ・is<br>
                    ・are<br>
                    ・has
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open8').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open8" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. is</span><br>
                        [解説]<br>
                        he number of Aは「〜の数」という意味で単数扱いとなります。<br>
                        紛らわしいものとしてa number of Aは<br>
                        「たくさんのA、多くのA」という意味になりこちらは複数扱いです。
                    </p>
                </div>
            </div><!--answer-->


            <div class="answer">
                <h2 class="result"> Q9 <span><?php echo $q9?> </h2>
                <p class="question">                   
                    [問題]<br>
                    There’s no one as ____ as we can see.<br><br>
                    ・far<br>
                    ・long
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open9').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open9" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. far</span><br>
                        [解説]<br>
                        as far as, as long as共に〜する限りという意味を持ちますが違いがあります。<br>
                        farは距離的な意味を持ち範囲を表したい時に使います。<br>
                        対してlongは時の意味を持ち時間を表したい時に使います。<br>
                        この分では「私たちの見える範囲内に人がいない」という意味なのでfarが選択されます。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q10 <span><?php echo $q10?> </h2>
                <p class="question">                   
                    [問題]<br>
                    I cannot deal ____ this problem.<br>
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open10').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open10" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. with</span><br>
                        [解説]<br>
                        deal withで「〜に対処する」という意味になります。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q11 <span><?php echo $q11?> </h2>
                <p class="question">                   
                    [問題]<br>
                    She was almost run ___ by a car.<br>
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open11').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a  class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open11" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. over</span><br>
                        [解説]<br>
                        run overで「〜をひく」という意味になります。
                    </p>
                </div>
            </div><!--answer-->

        <p　class="again"><a href="site.php" class="again">もう一度挑戦する</a></p>

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