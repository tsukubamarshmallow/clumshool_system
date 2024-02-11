<?php
// display_errorsをONに設定
ini_set('display_errors', 1);
require_once('../db_connect_pdo.php');
$sql = "INSERT INTO courses(name,school_year,subject,day,teacher_id) values(:name,:school_year,:subject,:day,:teacher_id)";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':name',$_POST['course_name'],PDO::PARAM_STR);
$stmt ->bindValue(':school_year',$_POST['year'],PDO::PARAM_STR);
$stmt ->bindValue(':subject',$_POST['subject'],PDO::PARAM_STR);
$stmt ->bindValue(':day',$_POST['day'],PDO::PARAM_STR);
$stmt ->bindValue(':teacher_id',$_POST['teacher_id'],PDO::PARAM_INT);
$res = $stmt ->execute();
if($res == true){
    header('Location:course.php');
}else{
    echo 'DB挿入に失敗しています';
}