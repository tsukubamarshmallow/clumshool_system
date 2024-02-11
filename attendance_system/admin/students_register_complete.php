<?php
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL ); 
require_once("../db_connect_pdo.php");
//$_POSTが接続されていればDBに値を送信する
if(!empty($_POST)){
    try{
        $sql = "INSERT INTO students(name,school_name,school_year,birth_day,age,tel,email,address,password) VALUES(:name,:school_name,:school_year,:birth_day,:age,:tel,:email,:address,:password)";
        $stmt = $pdo -> prepare($sql);
        $stmt ->bindValue(':name',$_POST['student_name'],PDO::PARAM_STR);
        $stmt ->bindValue(':school_name',$_POST['school_name'],PDO::PARAM_STR);
        $stmt ->bindValue(':school_year',$_POST['school_year'],PDO::PARAM_INT);
        $stmt ->bindValue(':birth_day',$_POST['birth_day'],PDO::PARAM_STR);
        $stmt ->bindValue(':age',$_POST['age'],PDO::PARAM_INT);
        $stmt ->bindValue(':tel',$_POST['tel'],PDO::PARAM_STR);
        $stmt ->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
        $stmt ->bindValue(':address',$_POST['address'],PDO::PARAM_STR);
        $stmt ->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT),PDO::PARAM_STR);
        if($stmt ->execute()){
        foreach($_POST as $key=>$value){
            echo $key.$value ;
            echo "\n";
        }
        echo 'DBに値を挿入しました。';
        }else{
            echo 'DBに値を挿入できませんでした。';
        }
    
    }catch(PDOExeption $e){
        echo 'データベースにアクセスできません'.$e->getMessage();
    }
}