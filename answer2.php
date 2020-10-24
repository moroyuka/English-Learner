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
            if ($_POST["q2"]==2) {
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
            if ($_POST["q5"]==3) {
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
            if ($_POST["q7"]==1) {
                array_push($number, "q7");
                $q7= "○";
            }else {
                $q7= "×";
            }
        } else {
            $q7= "×";
        }
        

        if (!empty($_POST["q8"])) {
            if ($_POST["q8"]==2) {
                array_push($number, "q8");
                $q8= "○";
            }else {
                $q8= "×";
            }
        } else {
            $q8= "×";
        }
        

        if (!empty($_POST["q9"])) {
            if ($_POST["q9"]==2) {
                $q9= "○";
                array_push($number, "q9");
            }else {
                $q9= "×";
            }
        } else {
            $q9= "×";
        }
        

        if (!empty($_POST["q10"])) {
            if ($_POST["q10"]=="over") {
                array_push($number, "q10");
                $q10= "○";
            }else {
                $q10= "×";
            }
        } else {
            $q10= "×";
        }
        

        

        if (empty($_POST)) {
            header('location: part2.php');
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

        <h2 class="results_number">10問中<span><?php echo $results;?></span>問正解！<?php echo $message;?></h2>

        <div class="answer">
            <h2 class="result"> Q1 <span><?php echo $q1?></span></h2>
            <p class="question">                   
                    [問題]<br>
                    A：The book he is reading is very ____ .<br><br>
                    ・bored<br>
                    ・boring
            </p><!--question-->

            <!--クリックの機能-->
            <div
                onclick="obj=document.getElementById('open1').style; obj.display=(obj.display=='none')?'block':'none';">
                <a class="open">▼ 解答解説を見る</a>
            </div>
            <!--クリックの中身-->
            <div id="open1" style="display:none;clear:both;">
                <p class="contents">
                    <span>A. boring</span><br>
                    [解説]<br>
                    分詞形容詞の問題です。現在分詞boringは「飽きさせるような」<br>
                    過去分詞boredは「退屈させられた」という意味を持ちます。<br>
                    この問題ではboringはbookを修飾しており、本が彼を退屈させているため<br>
                    boringが答えです。大抵の問題は、現在分詞は物を修飾し、<br>
                    過去分詞は人を修飾と抑えておけば解くことができます。
                </p>             
            </div>
         </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q2 <span><?php echo $q2?> </h2>
                <p class="question">                   
                    [問題]<br>
                    Mary is what is called a genius.<br><br>
                    ・which<br>
                    ・what<br>
                    ・that
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open2').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open2" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. what</span><br>
                        [解説]<br>
                        "What is called" で「いわゆる〜」という意味。<br>
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q3 <span><?php echo $q3?> </h2>
                <p class="question">                   
                    [問題]<br>
                    There ____ a tower in the park.<br><br>
                    ・is used to being<br>
                    ・used to be<br>
                    ・would
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open3').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open3" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. used to be </span><br>
                        [解説]<br>
                        ”would”と”be used to”は共に過去の習慣を表すが、<br>
                        wouldの後に続くのは動作動詞のみなので、問のように状態同士を後に取れません。<br>
                        また、"be used to ~ing"は、「〜することに慣れている」という意味なので、不適です。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q4 <span><?php echo $q4?> </h2>
                <p class="question">                   
                    [問題]<br>
                    Rich ___ he is, he isn't sutisfied with his life.<br><br>
                    ・despite<br>
                    ・when<br>
                    ・as
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open4').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open4" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. as</span><br>
                        [解説]<br>
                        "形容詞 as S V" で譲歩を表し、「S
                        〜だけれども」という意味です<br>
                        <br>
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q5 <span><?php echo $q5?> </h2>
                <p class="question">                   
                    [問題]<br>
                    The airplane ______ at Nrita Station by tomorrow.<br><br>
                    ・will arrive<br>
                    ・has arrived<br>
                    ・will have arrived
                </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open5').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open5" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. will have arrived</span><br>
                        [解説]<br>
                        "by tomorrow"という未来のある時の１点があることに注目します。<br>
                        未来のある一点までにかけて完了する動作なので、未来完了形を用います。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q6 <span><?php echo $q6?> </h2>
                <p class="question">                   
                    [問題]<br>
                    You ______ go out late at night.<br><br>
                    ・had better not<br>
                    ・had not better<br>
                    ・not had better
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open6').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open6" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. had better not</span><br>
                        [解説]<br>
                        "had better"１つの助動詞であるため、否定系は"had better not"です。
                    </p>
                </div>
            </div><!--answer-->


            <div class="answer">
                <h2 class="result"> Q7 <span><?php echo $q7?> </h2>
                <p class="question">                   
                    [問題]<br>
                    I prefer playing sports ____ watching TV.<br><br>
                    ・to<br>
                    ・but<br>
                    ・for
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open7').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open7" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. to</span><br>
                        [解説]<br>
                        比較に用いられる前置詞toの問題です。<br>
                        "prefer A to B"で「BよりAを好む」という意味です。<br>
                        類似した問題でtoの後の活用を問う問題も出ますが、<br>
                        ここで使われるtoは前置詞のtoなので、動詞の形は~ingです。<br>
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q8 <span><?php echo $q8?> </h2>
                <p class="question">                   
                    [問題]<br>
                    John is a kind man, _____?<br><br>
                    ・doesn't he<br>
                    ・isn't he<br>
                    ・is he
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open8').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open8" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. isn't he</span><br>
                        [解説]<br>
                        付加疑問文の問題です。「〜ですよね？」と確認するために使われます。<br>
                        付加疑問文の作り方は、肯定文なら否定文、否定文なら肯定文で付加疑問を続けます。<br>
                        動詞の種類は変えません。また、付加疑問の後に、主語の代名詞をもってきます。<br>
                        この問題では主語の種類がbe動詞、肯定文、主語がJohnなので、"isn't he"が正解です。
                    </p>
                </div>
            </div><!--answer-->


            <div class="answer">
                <h2 class="result"> Q9 <span><?php echo $q9?> </h2>
                <p class="question">                   
                    [問題]<br>
                    I cannot believe ____ fast he can run!<br><br>
                    ・so<br>
                    ・how<br>
                    ・what
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open9').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open9" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. how</span><br>
                        [解説]<br>
                        文末の"!"で感嘆文だと判断します。感嘆文にはwhatかhowを用います。<br>
                        それぞれ「what (a/an) 形容詞　名詞　SV」、「how 形容詞/副詞　SV」<br>
                        の形をとります。問題文には空所の直後が形容詞で、名詞も入っていないためhowを選択します。
                    </p>
                </div>
            </div><!--answer-->

            <div class="answer">
                <h2 class="result"> Q10 <span><?php echo $q10?> </h2>
                <p class="question">                   
                    [問題]<br>
                    She was almost run ___ by a car.<br>
            　   </p><!--question-->
                <div
                    onclick="obj=document.getElementById('open10').style; obj.display=(obj.display=='none')?'block':'none';">
                    <a  class="open">▼ 解答解説を見る</a>
                </div>
                <!--クリックの中身-->
                <div id="open10" style="display:none;clear:both;">
                    <p class="contents">
                        <span>A. over</span><br>
                        [解説]<br>
                        run overで「〜をひく」という意味になります。
                    </p>
                </div>
            </div><!--answer-->

        <p　class="again"><a href="part2.php" class="again">もう一度挑戦する</a></p>

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