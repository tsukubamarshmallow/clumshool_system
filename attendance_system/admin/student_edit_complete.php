<?php
session_start();
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL ); 
require_once("../db_connect_pdo.php");
//$_POSTが接続されていればDBに値を送信する
if(!empty($_POST)){
    try{
        $sql = "UPDATE students SET name = :name,school_name = :school_name,school_year = :school_year,age = :age,email = :email,tel = :tel,address = :address WHERE id = :id";
        $stmt = $pdo -> prepare($sql);
        $stmt ->bindValue(':id',$_SESSION['student_id'],PDO::PARAM_STR);
        $stmt ->bindValue(':name',$_POST['student_name'],PDO::PARAM_STR);
        $stmt ->bindValue(':school_name',$_POST['school_name'],PDO::PARAM_STR);
        $stmt ->bindValue(':school_year',$_POST['school_year'],PDO::PARAM_STR);
        $stmt ->bindValue(':age',$_POST['age'],PDO::PARAM_INT);
        $stmt ->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
        $stmt ->bindValue(':tel',$_POST['tel'],PDO::PARAM_STR);
        $stmt ->bindValue(':address',$_POST['address'],PDO::PARAM_STR);
        $stmt ->execute();
        echo 'DBに値を挿入しました。';
        header("Location:students.php");
        
    }catch(PDOExeption $e){
        echo 'データベースにアクセスできません'.$e->getMessage();
    }
}