<?php 

session_start();
require_once('../db_connect_pdo.php');
if($_POST["course_name"] != NULL && $_POST["course_id"] != NULL){
$_SESSION["course_name"] = $_POST["course_name"];
$_SESSION["course_id"] = $_POST["course_id"];
}
$course_id = $_SESSION["course_id"];
$student_id = $_SESSION["student_id"];

//質問取得
$sql = "SELECT * FROM questions WHERE course_id = :course_id and student_id = :student_id";
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':course_id',$course_id,PDO::PARAM_INT);
$stmt -> bindValue(':student_id',$student_id,PDO::PARAM_INT);
$stmt -> execute();
$res  = $stmt;





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="course.css">
    <link rel="stylesheet" href="calendar.css">
    <style>
        .header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            
        }
        /* 折り畳み可能なセクションのスタイル */
        .collapsible {
            cursor: pointer;
            border: none;
            outline: none;
            background-color: transparent;
            padding: 0;
            margin: 10px;
            display: flex;
            align-items: center;
        }

        .collapsible-text {
            margin-right: 1em;
        }

        .arrow {
            width: 0.8em;
            height: 0.8em;
            border-left: 0.15em solid #555;
            border-bottom: 0.15em solid #555;
            transform: rotate(-45deg);
            transition: transform 0.3s ease;
            margin-right: 0.5em;
            margin-left: 1em;
            display: inline-block;
            vertical-align: middle;
        }

        .arrow.down {
            transform: rotate(45deg);
        }

        .content {
            display: none;
            overflow: hidden;
        }
    </style>
    <script>
        // クリックイベントの処理
        function toggleSection(sectionId) {
            const content = document.getElementById(sectionId);
            const arrow = document.getElementById(sectionId + "-arrow");
            
            if (content.style.display === "block") {
                content.style.display = "none";
                arrow.classList.remove("down");
            } else {
                content.style.display = "block";
                arrow.classList.add("down");
            }
        }
    </script>
    <title>Document</title>
</head>
<body>
    <div class="header">
        <h1>数理予備校E'Z</h1>
    </div>
    <p>このページでは授業予定の確認,クラスニュース,年間予定,月間予定,課題進捗状況,成績,質問可能なページになっています。</p>
    <div class="classname">    
        <h1><?php echo $_SESSION["course_name"]."クラス";?></h1>
    </div>
    <!-- 授業予定セクション -->
    <h2 class="collapsible" onclick="toggleSection('schedule')">授業予定<span id="schedule-arrow" class="arrow"></span></h2>
    <div id="schedule" class="content">
        <div class="container-calendar">
            <h4 id="monthAndYear"></h4>
            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">‹</button>
                <button id="next" onclick="next()">›</button>
            </div>
            
            <table class="table-calendar" id="calendar" data-lang="ja">
                <thead id="thead-month"></thead>
                <tbody id="calendar-body"></tbody>
            </table>
            
            <div class="footer-container-calendar">
                <label for="month">日付指定：</label>
                <select id="month" onchange="jump()">
                    <option value=0>1月</option>
                    <option value=1>2月</option>
                    <option value=2>3月</option>
                    <option value=3>4月</option>
                    <option value=4>5月</option>
                    <option value=5>6月</option>
                    <option value=6>7月</option>
                    <option value=7>8月</option>
                    <option value=8>9月</option>
                    <option value=9>10月</option>
                    <option value=10>11月</option>
                    <option value=11>12月</option>
                </select>
                <select id="year" onchange="jump()"></select>
            </div>
        </div>
    </div>
    <script src="calendar.js" type="text/javascript"></script>
    <!-- 新着ニュースセクション -->
    <h2 class="collapsible" onclick="toggleSection('news')">新着ニュース<span id="news-arrow" class="arrow"></span></h2>
    <div id="news" class="content">
        <table class="section">
            <tr>
                <th>日付</th>
                <th>タイトル</th>
                <th>概要</th>
            </tr>
            <tr>
                <td>2023年6月11日</td>
                <td>記事タイトル1</td>
                <td>記事の概要や詳細など、ここに表示されます。</td>
            </tr>
            <tr>
                <td>2023年6月10日</td>
                <td>記事タイトル2</td>
                <td>記事の概要や詳細など、ここに表示されます。</td>
            </tr>
            <tr>
                <td>2023年6月9日</td>
                <td>記事タイトル3</td>
                <td>記事の概要や詳細など、ここに表示されます。</td>
            </tr>
        </table>
    </div>
    
    <!-- 年間目標セクション -->
    <h2 class="collapsible" onclick="toggleSection('yearly-goals')">年間目標<span id="yearly-goals-arrow" class="arrow"></span></h2>
    <div id="yearly-goals" class="content">
        <table class="section" >
            <tr>
                <td>2023年度</td>
                <td>数3終了</td>
            </tr>
            <tr>
                <td>2024年度</td>
                <td>東京大学合格</td>
            </tr>
        </table>
    </div>
    
    <!-- 月間目標セクション -->
    <h2 class="collapsible" onclick="toggleSection('monthly-goals')">月間目標<span id="monthly-goals-arrow" class="arrow"></span></h2>
    <div id="monthly-goals" class="content">
        <table class="section">
            <tr>
                <td>5月</td>
                <td>ハッと目覚める確率p50まで</td>
            </tr>
            <tr>
                <td>6月</td>
                <td>青チャート微分積分</td>
            </tr>
        </table>
    </div>
    <!-- 月間目標セクション -->
    <h2 class="collapsible" onclick="toggleSection('monthly-goals')">進直状況<span id="monthly-goals-arrow" class="arrow"></span></h2>
    <div id="monthly-goals" class="content">
        <table class="section">
            <tr>
                <th>課題番号</th>
                <th>課題名</th>
                <th>課題内容</th>
                <th>締切日時</th>
                <th>進捗</th>
                <th>提出ファイル選択</th>
            </tr>
            <tr>
                <th>1</th>
                <th>primetext p10~</th>
                <th>三角関数関係式</th>
                <th>2023/07/09</th>
                <th>80%</th>
                <th>提出ファイル選択</th>
            </tr>
        </table>
    </div>
    

    <!-- 提出課題一覧セクション -->
    <h2 class="collapsible" onclick="toggleSection('assignments')">提出課題一覧<span id="assignments-arrow" class="arrow"></span></h2>
    <div id="assignments" class="content">
        <table class="section">
            <tr>
                <th>課題名</th>
                <th>添付ファイル</th>
                <th>締切日時</th>
                <th>成績</th>
                <th>成績内訳</th>
                <th>提出ファイル選択</th>
            </tr>
            <tr>
                <td>ハッと目覚める確率 p51~52</td>
                <td>微分積分1.pdf</td>
                <td>5/26</td>
                <td>A</td>
                <td>コンビネーション記号と順列の記号を使わずに解いてみましょう。違いがわからない状態で使用するのは危険です！</td>
                <td><form action="file_up.php" enctype="multipart/form-data" method="post"><input name="file_upload" type="file"> <input type="submit" value="アップロード"></form></td>
            </tr>
        </table>
    </div>

    <!-- 成績セクション -->
    <h2 class="collapsible" onclick="toggleSection('grades')">成績<span id="grades-arrow" class="arrow"></span></h2>
    <div id="grades" class="content">
        <table class="section" >
            <h3>定期考査</h3>
                <tr>
                    <th>定期考査名</th>
                    <th>成績</th>
                    <th>ファイル選択</th>
                    <th>振り返りコメント</th>
                </tr>
                <tr>
                    <td>2023/6定期考査</td>
                    <td>47点</td>
                    <td>ファイル選択</th>
                    <td>基礎問題を落としてしまった。次回は確実に基礎問題で満点をとれるようにする。</th>
                </tr>
            <h3>模試</h3>
                <tr>
                    <th>定期考査名</th>
                    <th>成績</th>
                    <th>ファイル選択</th>
                    <th>振り返りコメント</th>
                </tr>
                <tr>
                    <td>2023/6定期考査</td>
                    <td>47点</td>
                    <td>ファイル選択</th>
                    <td>基礎問題を落としてしまった。次回は確実に基礎問題で満点をとれるようにする。</th>
                </tr>
            
        </table>
    </div>

    <!-- 質問セクション -->
    <h2 class="collapsible" onclick="toggleSection('q')">質問<span id="q-arrow" class="arrow"></span></h2>
    <div id="q" class="content">
        <form action="question_complete.php" id="question-form" method="post">
            <div id="question-box">
                <h2>質問を作成する</h2>
                <input type="text" id="question-title" name="title" placeholder="タイトルを入力してください">
                <textarea id="question-input" name="comment" rows="4" placeholder="ここに質問を入力してください"></textarea>
                <input type="number" class="hidden" name="course_id" value="<?php echo $course_id;?>">
                <input type="number" class="hidden" name="student_id" value="<?php echo $student_id;?>">
                <button type="submit">質問を送信</button>
            </div>
        </form>
        <div class="comments">
            <?php while($row = $res -> fetch()):?>
                <div class="comment">
                    <div class="header">
                       <?php echo $row['title'];?>
                    </div>
                    <div class="row">
                        <img src="../images/students.png" alt="表示されていないよ">
                        <div class="name">
                            tesuto子
                        </div>
                        <div class="date">
                            <?php echo $row['created_at'];?>
                        </div>
                    </div>
                    <div class="comment-content">
                        <?php echo $row['comment'];?>
                    </div>
                    
                </div>
            <?php endwhile;?>    
        </div>
    </div>    
<!---------javascriptセクション------------>
    <script>
        // ページ読み込み時に全てのコンテンツを非表示にする
        document.addEventListener("DOMContentLoaded", function() {
            const collapsibleSections = document.getElementsByClassName("collapsible");
            for (let i = 0; i < collapsibleSections.length; i++) {
                const sectionId = collapsibleSections[i].getAttribute("onclick").split("'")[1];
                const content = document.getElementById(sectionId);
                const arrow = document.getElementById(sectionId + "-arrow");
                content.style.display = "none";
                arrow.classList.remove("down");
            }
        });
    </script>
    <script src="script.js"></script>
</body>
</html>