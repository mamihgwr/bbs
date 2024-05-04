<?php //検索するところ
require 'word.php';
?>

<?php 
//ワード検索ページ
$kensaku = isset($_POST["word"]) ? $_POST["word"] : "";
date_default_timezone_set('Asia/Tokyo');
$postdate = date("Y年m月d日 H時i分s秒");

//DB接続
$link = mysqli_connect('db', 'root', 'pass');
mysqli_select_db($link, "boards");
mysqli_set_charset($link, 'utf8');
/* 接続状況をチェックします
 if (mysqli_connect_errno()) {
        die("データベースに接続できません:" . mysqli_connect_error() . "\n");
    } else {
        echo "データベースの接続に成功しました。\n";
    }
*/
?>

<html>
<body>
<div align="center" class="main">
    <?php
    //検索が空欄ならexit;
    if (empty($kensaku)) {
        exit;
    }

    // データベースからボードの投稿と返信の投稿を取得
    //ボードテーブルはbに略、リプライはrに略・UNIONでつなげて出力
    $result = mysqli_query($link, "
        SELECT b.id, b.name, b.subject, b.time, b.message, b.email, b.url, b.text_color, b.delete_key, b.image_path
        FROM boards b
        WHERE b.message LIKE '%$kensaku%'
        UNION   
        SELECT r.id, r.name, r.subject, r.time, r.message, r.email, r.url, r.text_color, r.delete_key, r.image_path
        FROM replies r
        INNER JOIN boards b ON r.board_id = b.id
        WHERE r.message LIKE '%$kensaku%'
        ORDER BY time DESC
    ");

    if (!$result) {
        die('クエリ実行エラー: ' . mysqli_error($link));
    }

    while ($comment = mysqli_fetch_assoc($result)) {
        echo "<table border='3'>";
        echo "<tr>";
        echo "<td>ID {$comment['id']}</td>";
        echo "<tr>";
        echo "<td>名前 {$comment['name']}</td>";
        echo "<tr>";
        echo "<td>件名 {$comment['subject']}</td>";

        // 返信ボタン
        echo "<td rowspan='3'><form action='replise.php' method='post'>
                <input type='hidden' name='id' value='{$comment['id']}'>
                <input type='hidden' name='name' value='{$comment['name']}'>
                <input type='hidden' name='subject' value='{$comment['subject']}'>
                <input type='hidden' name='message' value='{$comment['message']}'>
                <input type='hidden' name='email' value='{$comment['email']}'>
                <input type='hidden' name='url' value='{$comment['url']}'>
                <input type='hidden' name='text_color' value='{$comment['text_color']}'>
                <input type='hidden' name='delete_key' value='{$comment['delete_key']}'>
                <input type='submit' name='rep_button'  value='返信' /></form>";
        //編集ボタン
        echo "<form action='edit.php' method='post'> 
                <input type='hidden' name='id' value='{$comment['id']}'>
                <input type='hidden' name='name' value='{$comment['name']}'>
                <input type='hidden' name='subject' value='{$comment['subject']}'>
                <input type='hidden' name='message' value='{$comment['message']}'>
                <input type='hidden' name='email' value='{$comment['email']}'>
                <input type='hidden' name='url' value='{$comment['url']}'>
                <input type='hidden' name='text_color' value='{$comment['text_color']}'>
                <input type='hidden' name='delete_key' value='{$comment['delete_key']}'>
                <input type='submit' name='edit_button'   value='編集' /></form>";
        //削除ボタン
        echo "<form action='delete.php' method='post'>
                <input type='hidden' name='id' value='{$comment['id']}'>
                <input type='hidden' name='delete_key' value='{$comment['delete_key']}'>
                <input type='submit' name='delete_button' value='削除' />
            </form></td>";

        echo "</tr>";

        echo "<tr>";
        // 時間の表示
        echo "<td><time>{$comment['time']}</time></td>";
        echo "</tr>";
        echo "<tr>";

        // メッセージの表示
        $message_breaks = nl2br($comment['message']);
        echo "<td>コメント<br><span style = 'color:{$comment['text_color']}'> {$message_breaks}</span></td>";
        echo "</tr>";
        echo "<tr>";

        // メールアドレスの表示
        echo "<td>メール <a href='mailto:{$comment['email']}'>{$comment['email']}</a></td>";
        echo "</tr>";
        echo "<tr>";

        // URLの表示
        echo "<td>URL <a href='{$comment['url']}' target='_blank'>{$comment['url']}</a></td>";
        echo "</tr>";
        echo "<tr>";

        // 画像の表示
        if (!empty($comment['image_path'])) {
            echo "<td>画像：<img src='{$comment['image_path']}' alt='画像'></td>";
        } else {
            echo '<td>画像添付なし</td>';
        }

        echo "</tr>";
        echo "</table>";
    }
    ?>
</div>
</body>
</html>
