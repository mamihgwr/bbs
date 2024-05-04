<?php
//削除ボタンのキー入力ページ
$id =isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$email  = isset($_POST["email"]) ? $_POST["email"] : "";
$url  = isset($_POST["url"]) ? $_POST["url"] : "";

$file_name = isset($_POST["file_name"]) ? $_POST["file_name"] : "";
$file_tmp = isset($_POST["file_tmp"]) ? $_POST["file_tmp"] : "";
$text_color = isset($_POST["text_color"]) ? $_POST["text_color"] : "";
$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";
$checkbox =isset($_POST["checkbox"]) ? $_POST["checkbox"] : "";

date_default_timezone_set('Asia/Tokyo');
$postdate = date("Y年m月d日 H時i分s秒");

// バリデーションエラーのメッセージ保管用
$errors = array();

//DB接続
$link = mysqli_connect('db', 'root', 'pass', 'boards');

/* 接続状況をチェックします
 if (mysqli_connect_errno()) {
        die("データベースに接続できません:" . mysqli_connect_error() . "\n");
    } else {
        echo "データベースの接続に成功しました。\n";
    }
*/

mysqli_select_db($link,"boards");
mysqli_set_charset($link,'utf8');



   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // データベースから対応する行を取得
    $result = mysqli_query($link, "SELECT * FROM boards WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

?>

<html>
    <div align="center">
        <header><h3>課題掲示板sample</h3></header>
        <body>
            <hr width=200 size=1>
            <a href="http://localhost:8000/top.php">一覧(新規投稿)</a>
            <hr width=200 size=1>
           
           <?php
                // もし行が見つかり、submitを押して削除キーが一致していれば削除
                if ($row && $row['delete_key'] == $delete_key) {
                    if (isset($_POST["delete_b"])) {
                         require 'change.php';
                         exit;
                    }
                } else {
                    $errors = "編集キーが一致しないため、編集できません。";
                }
            }
            ?>
        
            <form action='edit.php' method='post'>
                <p>編集/削除キーを入力し、[送信]をしてください。</p>
                <label for="delete_key">編集/削除キー：</label>
                <input type="password"  maxlength="8" name="delete_key" >

                
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                <input type="hidden" name="message" value="<?php echo $message; ?>">

                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="url" value="<?php echo $url; ?>">

                <input type="hidden" name="file_name" value="<?php echo $file_name; ?>">
                <input type="hidden" name="file_tmp" value="<?php echo $file_tmp; ?>">
                <input type="hidden" name="text_color" value="<?php echo $text_color; ?>">
                <input type="hidden" name="edit_key" value="<?php echo $delete_key; ?>">
                <input type='submit' name="delete_b" value='送信' />
            </form>

            <?php
                 if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // エラーメッセージ表示
                if ($row && $row['delete_key'] !== $delete_key) {
                    if (isset($_POST["delete_b"])) {
                        echo $errors;
                    }
                } 
            }
            ?>

            
       </body>
    </div>
</html>