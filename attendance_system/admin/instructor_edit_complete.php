<?php
session_start();
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL ); 
require_once("../db_connect_pdo.php");
//$_POSTが接続されていればDBに値を送信する
if(!empty($_POST)){
    try{
        $sql = "UPDATE teachers SET name = :name,roll = :roll,age = :age,email = :email,phone = :phone,address = :address WHERE id = :id";
        $stmt = $pdo -> prepare($sql);
        $stmt ->bindValue(':id',$_SESSION['instructor_id'],PDO::PARAM_STR);
        $stmt ->bindValue(':name',$_POST['instructor_name'],PDO::PARAM_STR);
        $stmt ->bindValue(':roll',$_POST['roll'],PDO::PARAM_STR);
        $stmt ->bindValue(':age',$_POST['age'],PDO::PARAM_INT);
        $stmt ->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
        $stmt ->bindValue(':phone',$_POST['tel'],PDO::PARAM_STR);
        $stmt ->bindValue(':address',$_POST['address'],PDO::PARAM_STR);
        $stmt ->execute();
        echo 'DBに値を挿入しました。';
        header("Location:instructor.php");
        
    }catch(PDOExeption $e){
        echo 'データベースにアクセスできません'.$e->getMessage();
    }
}
