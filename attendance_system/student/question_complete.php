<?php
require_once('../db_connect_pdo.php');
$sql = "INSERT INTO questions (title,comment,course_id,student_id) values(:title,:comment,:course_id,:student_id)";
$stmt = $pdo -> prepare($sql);
$stmt -> bindValue(':title',$_POST["title"],PDO::PARAM_STR);
$stmt -> bindValue(':comment',$_POST["comment"],PDO::PARAM_STR);
$stmt -> bindValue(':course_id',$_POST["course_id"],PDO::PARAM_INT);
$stmt -> bindValue(':student_id',$_POST["student_id"],PDO::PARAM_INT);
$res = $stmt -> execute();
if($res = true){
    echo "成功";
    header('Location:course.php');
}else{
    echo "失敗";
}

