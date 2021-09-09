<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // DBに接続する。
    $pdo = new PDO('mysql:dbname=todo;host=mariadb;', 'root', 'password');
    
    // ユーザー名とパスワードでユーザーテーブルを検索する。
    // 「'OR 'A' = 'A」をパスワードに入力するとSQLインジェクションによりログインできてしまう。
    $sql = "SELECT * FROM users where username  = '".$username."' and password = '".$password."'";
    $stmt = $pdo->query($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();

    unset($pdo);

    // ユーザー名とパスワードでユーザーテーブルを検索して、その件数が0件だったら認証NG、
    // それ以外だったら成功とする。
    if (count($result) == 0) {
        echo "ユーザー名かパスワードが間違っています。<br>";
        echo "<a href=/>ログイン画面に戻る</a>";
        exit;
    } else {
        // 認証成功したらセッション変数にユーザー名を格納する。
        $_SESSION["username"] = $username;
        header('Location: /todo.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang= "ja">
<body>
<h1>脆弱性のあるヤバいアプリ</h1>
<hr>
<table>
<form action="" method= "post">
    <tr>
        <td>ユーザー名：</td>
        <td><input type="text" name="username" value=""></td>
    </td>
    <tr>
        <td>パスワード：</td>
        <td><input type="text" name="password" value=""></td>
    </td>
    <tr>
        <td><input type="submit" name="login" value="ログイン"></td>
        <td></td>
    </td>
</tr>
</form> 
</table>

</body>
</html>