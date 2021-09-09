<?php
session_start();

// セッション変数のユーザー名に何か格納されていたら、認証OKとする。
// 認証NGの場合はログイン画面に戻る。
if(!isset($_SESSION["username"])) {
    header("Location: /index.php");
    exit;
}

// DBに接続する。
$pdo = new PDO('mysql:dbname=todo;host=mariadb;', 'root', 'password');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 「投稿」ボタンをクリックした場合の処理を記述する。
    if($_POST['action'] == 'post'){
        $body = $_POST['body'];
        $sql = 'insert into todos(body) values (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($body));
    }

    // 「削除」ボタンをクリックした場合の処理を記述する。
    if($_POST['action'] == 'del'){
        $id = $_POST['id'];
        $sql = 'delete from todos where id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($id));
    }

    header('Location: '.$_SERVER['SCRIPT_NAME']);
    exit;
}

// ToDoリスト全件を取得する。
$stmt = $pdo->query('SELECT * FROM todos');

unset($pdo);

?>

<!DOCTYPE html>
<html lang= "ja">
<body>
<h1>脆弱性のあるヤバいアプリ</h1>
<hr>
<table>
<?php foreach($stmt as $row): ?>
<tr>
    <td><?php echo $row['body']; ?></td>
    <td>
    <form action="" method= "post">
        <input type="hidden" name="action" value="del">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="submit" value="削除">
    </form> 
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>
<form action="" method= "post">
    <input type="text" name= "body">
    <input type="submit" value= "投稿">
    <input type="hidden" name="action" value="post">
</form>    

</body>
</html>