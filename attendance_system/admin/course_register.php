<?php
require_once("../db_connect_pdo.php");
//講座情報取得
$sql1 = "SELECT courses.id, courses.name,courses.school_year,courses.day,courses.subject,teachers.name FROM courses,teachers WHERE courses.teacher_id = teachers.id";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();
$res1 = $stmt1;
//生徒情報取得
$sql2 = "SELECT * FROM students";
$stmt2 = $pdo->prepare($sql2);
$stmt2 -> execute();
$res2 = $stmt2;
//講座名簿取得
$sql3 = "SELECT courses.name, teachers.name, students.name, students.age FROM course_lists,courses,students,teachers WHERE course_lists.course_id = courses.id AND course_lists.student_id = students.id AND courses.teacher_id = teachers.id";
$stmt3 = $pdo->prepare($sql3);
$stmt3 -> execute();
$res3 = $stmt3;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>講座と生徒の管理</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      text-align: center;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>講座と生徒の関連付け</h2>
    <form action="course_register_complete.php"id="enrollmentForm" method="POST" >
      <div class="form-group">
        <label for="courseEnrollment">講座</label>
        <select id="courseEnrollment" name="courseEnrollment" required>
          <option value="">選択してください</option>
          <!-- 登録されている講座を動的に表示するためのオプション要素 -->
          <?php while($row1 = $res1->fetch()):?>
          <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
          <?php endwhile;?>
        </select>
      </div>
      <div class="form-group">
        <label for="studentEnrollment">生徒</label>
        <select id="studentEnrollment" name="studentEnrollment" required>
          <option value="">選択してください</option>
          <!-- 登録されている生徒を動的に表示するためのオプション要素 -->
          <?php while($row2 = $res2->fetch()):?>
          <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>
          <?php endwhile;?>
        </select>
      </div>
      <input type="submit" value="登録">
    </form>

    <h2>講座と生徒の一覧</h2>
    <table id="enrollmentTable">
      <tr>
        <th>講座名</th>
        <th>講師名</th>
        <th>生徒名</th>
        <th>年齢</th>
      </tr>
      <!-- 登録されている講座と生徒の一覧を動的に表示するためのテーブル行 -->
      <?php while($row = $res3 -> fetch()):?>
      <tr>
        <td><?php echo $row[0];?></td>
        <td><?php echo $row[1];?></td>
        <td><?php echo $row[2];?></td>
        <td><?php echo $row[3];?></td>      
      </tr>
      <?php endwhile;?>
    </table>
  </div>
</body>
</html>
