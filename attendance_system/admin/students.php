<?php
//DB接続
require_once("../db_connect_pdo.php");
$sql = "SELECT * FROM students";
$stmt = $pdo->prepare($sql);
$stmt -> execute();
$res = $stmt;
$condition = "";
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
    <h1>生徒管理画面</h1>
    <h2>検索</h2>
    <form action="students.php" method="POST">
        <label for="student_search">生徒名</label>
        <input type="search" name="student_search" plaholder="講師名">
        <input type="submit" name="submit" value="検索" >
    </form>
    <?php 
    //検索フォームに入力された値を元にsql文を発行
    if(isset($_POST["student_search"])&&($_POST["student_search"] != "")){
        $condition = "name = "."\"".$_POST["student_search"]."\"";
    } 
    if((isset($_POST["student_search"])&&($_POST["student_search"] != ""))){
        $sql1 = "SELECT * FROM students WHERE ".$condition;
        $stmt = $pdo->prepare($sql1);
        $stmt->execute();
        $res1 = $stmt;
        echo $sql1;
    }
    ?>    
    
    <?php if((isset($_POST["student_search"])&&($_POST["student_search"] != ""))):?>   
    <h2>検索一覧</h2>
    <table>
        <tr>
            <th>生徒名</th>
            <th>高校名</th>
            <th>学年</th>
            <th>tel</th>
            <th>address</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        <?php while($row = $res1 -> fetch()):?>
        <tr>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["school_name"];?></td>
            <td><?php echo $row["school_year"];?></td>
            <td><?php echo $row["tel"];?></td>
            <td><?php echo $row["address"];?></td>
        </tr>   
        <?php endwhile;?>
    </table>
    <?php endif;?>
    <h2>生徒一覧</h2>
    <table>
        <tr>
            <th>生徒名</th>
            <th>高校名</th>
            <th>学年</th>
            <th>tel</th>
            <th>address</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        <?php while($row = $res -> fetch()):?>
        <tr>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["school_name"];?></td>
            <td><?php echo $row["school_year"];?></td>
            <td><?php echo $row["tel"];?></td>
            <td><?php echo $row["address"];?></td>
            <form action="student_edit.php" method="POST">
            <td><input type="submit" value="編集"></td>
            <input class="hidden" type="text" name="student_id" value="<?php echo $row["id"];?>">
            <input class="hidden" type="text" name="student_name" value="<?php echo $row["name"];?>">
            <input class="hidden" type="text" name="student_school_name" value="<?php echo $row["school_name"];?>">
            <input class="hidden" type="text" name="student_school_year" value="<?php echo $row["school_year"];?>">
            <input class="hidden" type="text" name="tel" value="<?php echo $row["tel"];?>">
            <input class="hidden" type="text" name="address" value="<?php echo $row["address"];?>">
            </form>
            <form action="student_delete_complete.php" method="POST">
                <td><input type="submit" value="削除"></td>
                <input class="hidden" type="text" name="student_id" value="<?php echo $row["id"];?>">
            </form>
        </tr>   
        <?php endwhile;?>
    </table>
    <h2>生徒登録</h2>
    <form action="students_register_complete.php" method="POST">
        <label for="student_name">生徒名</label>
        <input type="text" id = "student_name" name= "student_name" required><br><br>
        
        <label for="school_name">学校名</label>
        <input type="text" id="school_name" name="school_name"required><br><br>

        <label for="school_year">学年</label>
        <input type="text" id="school_year" name="school_year"required><br><br>

        <label for="birth_day">生年月日</label>
        <input type="date" id="birth_day" name="birth_day" required><br><br>

        <label for="age">年齢</label>
        <input type="text" id="age" name="age" required><br><br>

        <label for="tel">tel</label>
        <input type="text" id="tel" name="tel" required><br><br>

        <label for="email">email</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="address">address</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="password">password</label>
        <input type="text" id="password" name="password" required><br><br>

        <input type="submit" value = "登録">
    </form>
</body>
</html>