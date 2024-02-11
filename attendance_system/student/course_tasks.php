<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="course_tasks.css">
</head>
<body>
    <div class="header">
        <h1>数理予備校E'Z</h1>
    </div>
    <div class="content-main">
        <h3 class="title">課題の追加</h3>
        <p>このページでは課題の追加をすることが出来ます。下記入力項目にデータを入力して,追加ボタンをクリックして下さい。</p>
        <form action="" method="post">
            <div class="ticket-flow-actions">
                <ul class="button-lists">
                    <li><input type="submit" value="送信"></li>
                    <li><input type="submit" value="編集"></li>
                </ul>
            </div>
            <div class="ticket">
                <div class="task_title"><label for="title">課題名</label><input type="text" name="title" value="件名"></div>
                <div class="subject">
                    <label for="subject">科目</label>
                    <select name="subject">
                         <option value="math">数学</option>
                                   <option value="default">科目を選択してください</option>
            <option value="japanes">国語</option>
                        <option value="science">理科</option>
                        <option value="english">英語</option>
                    </select>
                </div>
                <div class="content"><label for="content">課題内容</label><textarea name="content" value="課題詳細"></textarea></div>
                <div class="situation">
                    <label for="subject">進捗状況</label>
                    <select name="subject">
                        <option value="default">状況を選択してください</option>
                        <option value="math">未着手</option>
                        <option value="japanes">処理中</option>
                        <option value="science">完了</option>
                        <option value="english">問題発生</option>
                    </select>
                </div>
                <div class="deadline"><label for="deadline">締め切り日</label><input type="date" name="deadline" value="締め切り日"></div>
            </div>
        </form>
    </div>
</body>
</html>