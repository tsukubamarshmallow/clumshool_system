<?php
//DB接続
require_once("../db_connect_pdo.php");
$sql = "SELECT * FROM teachers";
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
    <h1>講師管理画面</h1>
    <h2>検索</h2>
    <form action="instructor.php" method="POST">
        <label for="teacher_search">講師名</label>
        <input type="search" name="teacher_search" plaholder="講師名">
        <input type="submit" name="submit" value="検索" >
    </form>
    <?php 
    //検索フォームに入力された値を元にsql文を発行
    if(isset($_POST["teacher_search"])&&($_POST["teacher_search"] != "")){
        $condition = "name = "."\"".$_POST["teacher_search"]."\"";
    } 
    if((isset($_POST["teacher_search"])&&($_POST["teacher_search"] != ""))){
        $sql1 = "SELECT * FROM teachers WHERE ".$condition;
        $stmt = $pdo->prepare($sql1);
        $stmt->execute();
        $res1 = $stmt;
        echo $sql1;
    }
    ?>    
    
    <?php if((isset($_POST["teacher_search"])&&($_POST["teacher_search"] != ""))):?>   
    <h2>検索一覧</h2>
    <table>
        <tr>
            <th>講師名</th>
            <th>区分</th>
            <th>年齢</th>
            <th>tel</th>
            <th>address</th>
        </tr>
        <?php while($row = $res1->fetch()):?>
        <tr>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["roll"];?></td>
            <td><?php echo $row["age"];?></td>
            <td><?php echo $row["phone"];?></td>
            <td><?php echo $row["address"];?></td>
        </tr>    
        <?php endwhile; ?>
    </table>
    <?php endif;?>
    <h2>講師一覧</h2>
    <table class="instructor_lists">
        <tr>
            <th>講師名</th>
            <th>区分</th>
            <th>年齢</th>
            <th>tel</th>
            <th>address</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        <?php while($row = $res->fetch()):?>
        <tr>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["roll"];?></td>
            <td><?php echo $row["age"];?></td>
            <td><?php echo $row["phone"];?></td>
            <td><?php echo $row["address"];?></td>
            <form action="instructor_edit.php" method="POST">
            <td><input type="submit" value="編集"></td>
            <input class="hidden" type="text" name="instructor_id" value="<?php echo $row["id"];?>">
            <input class="hidden" type="text" name="instructor_name" value="<?php echo $row["name"];?>">
            <input class="hidden" type="text" name="instructor_roll" value="<?php echo $row["roll"];?>">
            <input class="hidden" type="text" name="instructor_age" value="<?php echo $row["age"];?>">
            <input class="hidden" type="text" name="instructor_phone" value="<?php echo $row["phone"];?>">
            <input class="hidden" type="text" name="instructor_address" value="<?php echo $row["address"];?>">
            </form>
            <form action="instructor_delete_complete.php" method="POST">
                <td><input type="submit" value="削除"></td>
                <input class="hidden" type="text" name="instructor_id" value="<?php echo $row["id"];?>">
            </form>
        </tr>    
        <?php endwhile; ?>
    </table>
    <h2>講師登録</h2>
    <form action="instructor_register_complete.php" method="POST">
        <label for="instructor_name">講師名</label>
        <input type="text" id = "instructor_name" name= "instructor_name" required><br><br>

        <label for="roll">区分</label>
        <input type="text" id="roll" name="roll" required><br><br>

        <label for="age">年齢</label>
        <input type="text" id="age" name="age"required><br><br>

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
<?php 
$res->free();
?>