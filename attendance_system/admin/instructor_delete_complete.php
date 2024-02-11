<?php
session_start();
//DB接続
require_once("../db_connect_pdo.php");
$id = $_POST["instructor_id"];
$sql = "DELETE FROM teachers where id = :id";
$stmt = $pdo->prepare($sql);
$stmt ->bindValue(':id',$id,PDO::PARAM_STR);
$stmt -> execute();
header("Location:instructor.php");
?>