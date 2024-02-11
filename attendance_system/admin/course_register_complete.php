<?php
require_once('../db_connect_pdo.php');
$course_id = $_POST["courseEnrollment"];
$student_id = $_POST["studentEnrollment"];
$sql = "INSERT INTO course_lists(course_id, student_id) VALUES(:course_id, :student_id)";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':course_id',$course_id,PDO::PARAM_STR);
$stmt ->bindValue(':student_id',$student_id,PDO::PARAM_STR);
$res = $stmt -> execute();
if($res == true){
    echo "DB挿入に成功しました";
}else{
    echo "DB挿入に失敗しました";
}

