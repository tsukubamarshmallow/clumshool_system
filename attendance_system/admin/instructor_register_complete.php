<?php
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL ); 
require_once("../db_connect_pdo.php");
//$_POSTが接続されていればDBに値を送信する
if(!empty($_POST)){
    try{
        $sql = "INSERT INTO teachers(name,roll,age,email,phone,address,password) VALUES(:name,:roll,:age,:email,:phone,:address,:password)";
        $stmt = $pdo -> prepare($sql);
        $stmt ->bindValue(':name',$_POST['instructor_name'],PDO::PARAM_STR);
        $stmt ->bindValue(':roll',$_POST['roll'],PDO::PARAM_STR);
        $stmt ->bindValue(':age',$_POST['age'],PDO::PARAM_INT);
        $stmt ->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
        $stmt ->bindValue(':phone',$_POST['tel'],PDO::PARAM_STR);
        $stmt ->bindValue(':address',$_POST['address'],PDO::PARAM_STR);
        $stmt ->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT),PDO::PARAM_STR);
        $stmt ->execute();
        header('Location:instructor.php');
    }catch(PDOExeption $e){
        echo 'データベースにアクセスできません'.$e->getMessage();
    }
}
