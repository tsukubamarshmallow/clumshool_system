<?php
require_once("../db_connect_pdo.php");
//講座情報を取得
$sql = "SELECT courses.name,courses.school_year,courses.day,courses.subject,teachers.name FROM courses,teachers WHERE courses.teacher_id = teachers.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$res = $stmt;
$condition = "";
//講座登録用にsql文を用意
$sql = "SELECT * from teachers";
$stmt = $pdo ->prepare($sql);
$stmt -> execute();
$res1 = $stmt;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>生徒管理</title>
</head>
<body>
    <div class="header">
        <h1>数理予備校E'Z</h1>
    </div>
    <h1>講座管理画面</h1>
    <h2>検索</h2>
    <form action="course.php" method="POST">
        <label for="course_search">講座名</label>
        <input type="search" name="course_search" plaholder="講座名">
        <label for="teacher_search">講師名</label>
        <input type="search" name="teacher_search" plaholder="講師名">
        <input type="submit" name="submit" value="検索" >
    </form>
    <?php 
    //検索フォームに入力された値を元にsql文を発行
    if(isset($_POST["course_search"])&&($_POST["course_search"] != "")){
        $condition = "courses.name = "."\"".$_POST["course_search"]."\"";
    }
    if(isset($_POST["teacher_search"])&&($_POST["teacher_search"] != "")){
        if($condition == ""){
            $condition = "teachers.name = "."\"".$_POST["teacher_search"]."\"";
        }else{
            $condition = $condition." and teachers.name = "."\"".$_POST["teacher_search"]."\"";
        }
    }   
    if((isset($_POST["course_search"])&&($_POST["course_search"] != ""))||(isset($_POST["teacher_search"])&&($_POST["teacher_search"] != ""))){
        $sql1 = "SELECT courses.name,courses.school_year,courses.day,courses.subject,teachers.name FROM courses,teachers WHERE courses.teacher_id = teachers.id and ".$condition;
        $stmt = $pdo->prepare($sql1);
        $stmt->execute();
        $res1 = $stmt;
        echo $sql1;
    }
    ?>    
    
    <?php if((isset($_POST["course_search"])&&($_POST["course_search"] != ""))||(isset($_POST["teacher_search"])&&($_POST["teacher_search"] != ""))):?>   
    <h2>検索一覧</h2>
    <table>
        <tr>
            <th>講座名</th>
            <th>学年</th>
            <th>科目</th>
            <th>担当講師</th>
            <th>人数</th>
            <th>曜日</th>
        </tr>
        <?php while($row = $res1->fetch()):?>
        <tr>
            
            <td><?php echo $row["0"];?></td>
            <td><?php echo $row["1"];?></td>
            <td><?php echo $row["3"];?></td>
            <td><?php echo $row["4"];?></td>
            <td>未実装</td>
            <td><?php echo $row["2"];?></td>

        </tr>
        <?php endwhile; ?>
    </table>
    <?php endif;?>
    <h2>講座一覧</h2>
    <table>
        <tr>
            <th>講座名</th>
            <th>学年</th>
            <th>科目</th>
            <th>担当講師</th>
            <th>曜日</th>
        </tr>
        <?php while($row = $res->fetch()):?>
        <tr>
            
            <td><?php echo $row["0"];?></td>
            <td><?php echo $row["1"];?></td>
            <td><?php echo $row["3"];?></td>
            <td><?php echo $row["4"];?></td>
            <td><?php echo $row["2"];?></td>

        </tr>
        <?php endwhile; ?>
    </table>
    
    <h2>講座登録</h2>
    <form action="course_complete.php" method = "post">
        <label for="course_name">講座名</label>
        <input type="text" id ="course_name" name="course_name" required><br><br>

        <label for="year">学年</label>
        <input type="text" id="year" name="year" required><br><br>

        <label for="subject">科目</label>
        <input type="text" id="subject" name="subject"required><br><br>

        <label for="teacher_id">講師名</label>
        <select id="teacher_id" name="teacher_id" required>
          <option value="">選択してください</option>
          <!-- 登録されている講座を動的に表示するためのオプション要素 -->
          <?php while($row1 = $res1->fetch()):?>
          <option value="<?php echo $row1["id"];?>"><?php echo $row1['name'];?></option>
          <?php endwhile;?>
        </select>

        <label for="day">曜日</label>
        <select id="day" name="day" required>
          <option value="">選択してください</option>
          <option value="月G">月G</option>
          <option value="月H">月H</option>
          <option value="火G">火G</option>
          <option value="火H">火H</option>
          <option value="水G">水G</option>
          <option value="水H">水H</option>
          <option value="木G">木G</option>
          <option value="木H">木H</option>
          <option value="金G">金G</option>
          <option value="金H">金H</option>

        </select>

        <input type="submit" value = "登録">
    </form>

</body>
</html>