<?php
session_start();
require_once('db_connect_pdo.php');
$mail = $_POST['mail'];
$sql = "SELECT * FROM students WHERE email = :mail";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mail', $mail);
$stmt->execute();
$member = $stmt->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['password'], $member['password'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['student_id'] = $member['id'];
    $_SESSION['student_name'] = $member['name'];
    $_SESSION['school_name'] = $member['school_name'];
    $_SESSION['school_year'] = $member['school_year'];
    echo 'ログイン完了';
    header('Location:student/index.php');
} else {
    echo 'メールアドレスもしくはパスワードが間違っています。';
    if(isset($member)){
        echo '$memberに値が入力されています';
        echo $member['password'];
    }else{
        echo '$memberに値が入力されていません';
    }
    foreach($member as $value){
        echo $value ;
        echo "\n";
    }
}
?>

