<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>トップページ</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
    }

    .link-list {
      list-style-type: none;
      padding: 0;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }

    .link-list li {
      background-color: #f2f2f2;
      border-radius: 4px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      transition: background-color 0.3s ease;
    }

    .link-list li:hover {
      background-color: #e1eaf6;
    }

    .link-list li a {
      text-decoration: none;
      color: #333;
    }

    .logo {
      max-width: 100px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>管理者top</h1>
    <ul class="link-list">
      <li>
        <a href="instructor.php">
          <img src="../images/instructors.png" alt="指導者管理画面" class="logo">
        </a>
        <p>指導者管理画面</p>
      </li>
      <li>
        <a href="students.php">
          <img src="../images/students.png" alt="生徒管理画面" class="logo">
        </a>
        <p>生徒管理画面</p>
      </li>
      <li>
        <a href="course.php">
          <img src="../images/class.png" alt="講座管理画面" class="logo">
        </a>
        <p>講座管理画面</p>
      </li>
      <li>
        <a href="course_register.php">
          <img src="../images/register.png" alt="生徒受講登録画面" class="logo">
        </a>
        <p>講座管理画面</p>
      </li>
    </ul>

    <h1>生徒トップ</h1>
    <ul class="link-list">
      <li>
        <a href="../login_form.php">
          <img src="../images/login.png" alt="指導者管理画面" class="logo">
        </a>
        <p>ログイン画面</p>
      </li>
    </ul>
  </div>
</body>
</html>
