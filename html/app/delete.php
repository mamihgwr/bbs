<?php
//削除ボタンのキー入力ページ
$id =isset($_POST["id"]) ? $_POST["id"] : "";
$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";

date_default_timezone_set('Asia/Tokyo');
$postdate = date("Y-m-d H:i:s");

// バリデーションエラーのメッセージ保管用
$errors = array();

//DB接続
$link = mysqli_connect('db', 'root', 'pass', 'boards');
mysqli_set_charset($link,'utf8');
/* 接続状況をチェックします
 if (mysqli_connect_errno()) {
        die("データベースに接続できません:" . mysqli_connect_error() . "\n");
    } else {
        echo "データベースの接続に成功しました。\n";
    }
*/

   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // データベースから対応する行を取得
    $result = mysqli_query($link, "SELECT * FROM boards WHERE id = $id");
    $row = mysqli_fetch_assoc($result);


//データベースから消すやつ・DELETE FROM テーブル名 WHERE 条件;WHERE id = $id AND delete_key = '$delete_key';
?>

<html>
    <div align="center">
        <header><h3>課題掲示板sample</h3></header>
        <body>
            <hr width=200 size=1>
            <a href="http://localhost:8000/top.php">一覧(新規投稿)</a>
            <hr width=200 size=1>
        
            <form action='delete.php' method='post'>
                <p>編集/削除キーを入力し、[送信]をしてください。</p>
                <label for="delete_key">編集/削除キー：</label>
                <input type="password"  maxlength="8" name="delete_key" >

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type='submit' name="delete_b" value='送信' />
            </form>

            <?php

                // もし行が見つかり、submitを押して削除キーが一致していれば削除
                if ($row && $row['delete_key'] == $delete_key) {

                    if (isset($_POST["delete_b"])) {
                        $delete_result = mysqli_query($link, "DELETE FROM boards WHERE id = $id");
                        if ($delete_result) {
                            echo '<meta http-equiv="refresh" content="0;url=top.php">';
                        } else {
                            echo "この投稿は返信があるため削除できません。 ";
                        }
                    }

                } else {
                    echo "削除キーが一致しないため、削除できません。";
                }
            }
            ?>
       </body>
    </div>
</html>