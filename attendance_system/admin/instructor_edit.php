<<?php
session_start();
//DB接続
require_once("../db_connect_pdo.php");
$id = $_POST["instructor_id"];
$sql = "SELECT * FROM teachers where id = :id";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':id',$id,PDO::PARAM_STR);
$stmt -> execute();
$res = $stmt;
$row = $res->fetch(PDO::FETCH_ASSOC);
$_SESSION["instructor_id"] = $id;
echo $row;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
<h1>講師編集画面です。</h1>
<h2>講師登録</h2>
    <form action="instructor_edit_complete.php" method="POST">
        <label for="instructor_name">講師名</label>
        <input type="text" id = "instructor_name" name= "instructor_name" value="<?php echo $row[name];?>" required><br><br>

        <label for="roll">区分</label>
        <input type="text" id="roll" name="roll" value="<?php echo $row[roll];?>" required><br><br>

        <label for="age">年齢</label>
        <input type="text" id="age" name="age" value="<?php echo $row[age];?>" required><br><br>

        <label for="tel">tel</label>
        <input type="text" id="tel" name="tel" value="<?php echo $row[phone];?>" required><br><br>

        <label for="email">email</label>
        <input type="text" id="email" name="email" value="<?php echo $row[email];?>" required><br><br>

        <label for="address">address</label>
        <input type="text" id="address" name="address" value="<?php echo $row[address];?>" required><br><br>

        <input type="submit" value = "登録">
    </form>
</body>
</html>
