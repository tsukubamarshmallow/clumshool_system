<?php
session_start();
require_once('../db_connect_pdo.php');
$sql = "SELECT courses.name ,courses.id from courses, course_lists where course_lists.student_id = :id and course_lists.course_id = courses.id";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':id',$_SESSION['student_id'],PDO::PARAM_INT);
$stmt -> execute();
$res = $stmt;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <div class="header">
        <h1>数理予備校E'Z</h1>
    </div>
    <h1>マイページ</h1>
    <table>
        <tr>
            <th>生徒名</th>
            <th>学校名</th>
            <th>学年</th>
        </tr>
        <tr>
            
            <td><?php echo $_SESSION['student_name'];?></td>
            <td><?php echo $_SESSION['school_name'];?></td>
            <td><?php echo $_SESSION['school_year'];?></td>

        </tr>
    </table>
    <p>受講コース一覧</p>
    <table>
        <tr>
            <th>講座名</th>
            <th>選択</th>
        </tr>
        <?php while($row = $res -> fetch()):?>
            <form action="course.php" method="POST">
                <tr>
                    <td><?php echo $row[0];?></th>
                    <td><input type="submit" value="選択"></td>
                    <input class="hidden" type="number" name="course_id" id="course_id" value=<?php echo $row[1]?>>
                    <input class="hidden" type="text" name="course_name" id="course_name" value=<?php echo $row[0]?>>
                </tr>
            </form>
        <?php endwhile;?>
    </table>
</body>
</html>