<?php
session_start();
//DB接続
require_once("../db_connect_pdo.php");
$id = $_POST["student_id"];
$sql = "SELECT * FROM students where id = :id";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':id',$id,PDO::PARAM_STR);
$stmt -> execute();
$res = $stmt;
$row = $res->fetch(PDO::FETCH_ASSOC);
$_SESSION["student_id"] = $id;
foreach($row as $k=>$v){
    echo $k."は".$v;
}
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
<h1>生徒編集画面</h1>
<h2>生徒編集</h2>
<form action="student_edit_complete.php" method="POST">
        <label for="student_name">生徒名</label>
        <input type="text" id = "student_name" name= "student_name" value="<?php echo $row["name"];?>" required><br><br>
        
        <label for="school_name">学校名</label>
        <input type="text" id="school_name" name="school_name" value="<?php echo $row["school_name"];?>" required ><br><br>

        <label for="school_year">学年</label>
        <input type="text" id="school_year" name="school_year" value="<?php echo $row["school_year"];?>" required><br><br>

        <label for="age">年齢</label>
        <input type="text" id="age" name="age" value="<?php echo $row["age"];?>" required><br><br>

        <label for="tel">tel</label>
        <input type="text" id="tel" name="tel" value="<?php echo $row["tel"];?>" required><br><br>

        <label for="email">email</label>
        <input type="text" id="email" name="email" value="<?php echo $row["email"];?>" required><br><br>

        <label for="address">address</label>
        <input type="text" id="address" name="address" value="<?php echo $row["address"];?>" required><br><br>

        <input type="submit" value = "登録">
    </form>
</body>
</html>