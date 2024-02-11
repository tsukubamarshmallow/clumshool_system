<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
  <div class="container">
    <h1>生徒ログインページ</h1>
    <h2>mail:test1@test.com</h2>
    <h2>pass:test1</h2>
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="mail">メールアドレス：</label>
        <input type="text" id="mail" name="mail" required>
      </div>
      <div class="form-group">
        <label for="password">パスワード：</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <input type="submit" value="ログイン">
      </div>
    </form>
  </div>
</body>
</html>
