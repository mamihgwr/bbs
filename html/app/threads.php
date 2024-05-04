<?php
//スレッドを表示するページ（投稿:返信も）
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$email  = isset($_POST["email"]) ? $_POST["email"] : "";
$url  = isset($_POST["url"]) ? $_POST["url"] : "";

$text_color = isset($_POST["text_color"]) ? $_POST["text_color"] : "black";
$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";
$checkbox =isset($_POST["checkbox"]) ? $_POST["checkbox"] : "";
$uploaded_path = isset($_POST["uploaded_path"]) ? $_POST["uploaded_path"] : "";

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
}*/
?>


<html>
    <body><div align="center" class="main">
      <?php 
             //親投稿をくりかえし取得する
            $result = mysqli_query($link,"SELECT * FROM boards order by time desc;");
            //mysqli_fetch_assoc でーたべーすから取得した結果をphpで処理する関数
            while ($comment = mysqli_fetch_assoc($result))
            {
            
            echo "<table border='3'>";
            echo "<tr>";
            echo "<td>ID {$comment['id']}</td>";
            echo "<tr>";
            echo  "<td>名前 {$comment['name']}</td>";
            echo "<tr>";
            echo  "<td>件名 {$comment['subject']}</td>";
            //返信ボタン
            echo "<td rowspan='3'><form action='replise.php' method='post'>
                    <input type='hidden' name='id' value='{$comment['id']}'>
                    <input type='hidden' name='name' value='{$comment['name']}'>
                    <input type='hidden' name='subject' value='{$comment['subject']}'>
                    <input type='hidden' name='message' value='{$comment['message']}'>
                    <input type='hidden' name='email' value='{$comment['email']}'>
                    <input type='hidden' name='url' value='{$comment['url']}'>
                    <input type='hidden' name='text_color' value='{$comment['text_color']}'>
                    <input type='hidden' name='delete_key' value='{$comment['delete_key']}'>
                    <inpt type='text'><input type='submit' name='rep_button'  value='返信' /></form>";
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
                    <inpt type='text'><input type='submit' name='edit_button'   value='編集' /></form>";
            //削除ボタン
            echo "<form action='delete.php' method='post'>
                    <input type='hidden' name='id' value='{$comment['id']}'>
                    <input type='hidden' name='delete_key' value='{$comment['delete_key']}'>
                    <inpt type='text'><input type='submit' name='delete_button' value='削除' />
                </form></td>"; 
                echo "</tr>";

                echo "<tr>";
                $databaseTime = $comment['time'];
                $timestamp = strtotime($databaseTime);
                $Time = date('Y年n月j日 G時i分s秒', $timestamp);
                echo "<td><time>{$Time}</time></td>";
                echo "</tr>";

                echo "<tr>";
                $message_breaks = nl2br($comment['message']);
                echo "<td>コメント
                        <br><span style = 'color:{$comment['text_color']}'> {$message_breaks}</span></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>メール <a href='mailto:{$comment['email']}'>{$comment['email']}</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>URL <a href='{$comment['url']}' target='_blank'>{$comment['url']}</a></td>";
                echo "</tr>";

                echo "<tr>";
                if(!empty($comment['image_path'])){
                    echo "<td>画像：<img src='{$comment['image_path']}' alt='画像'></td>";
                    }else{
                    echo '<td>画像添付なし</td>';}
                echo "</tr>";
                echo "</table>";
                  

                echo" <div align='center' class='reply'>";

                //返信SQL
                $result_rep = mysqli_query($link,"SELECT * FROM replies where board_id = {$comment['id']};");
                //返信投稿表示
                while ($comment_rep = mysqli_fetch_assoc($result_rep))
                {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<td>ID {$comment_rep['id']}</td>";
                echo "<tr>";
                echo  "<td>名前 {$comment_rep['name']}</td>";
                echo "<tr>";
                echo  "<td>件名 {$comment_rep['subject']}</td>";
                //返信
                echo "<td rowspan='2'><form action='edit_rep.php' method='post'> 
                    <input type='hidden' name='id' value='{$comment_rep['id']}'>
                    <input type='hidden' name='name' value='{$comment_rep['name']}'>
                    <input type='hidden' name='subject' value='{$comment_rep['subject']}'>
                    <input type='hidden' name='message' value='{$comment_rep['message']}'>
                    <input type='hidden' name='email' value='{$comment_rep['email']}'>
                    <input type='hidden' name='url' value='{$comment_rep['url']}'>
                    <input type='hidden' name='text_color' value='{$comment_rep['text_color']}'>
                    <input type='hidden' name='delete_key' value='{$comment_rep['delete_key']}'>
                    <inpt type='text'><input type='submit' name='edit_button'   value='編集' /></form>";
                //削除
                echo "<form action='delete_rep.php' method='post'>
                    <input type='hidden' name='id' value='{$comment_rep['id']}'>
                    <input type='hidden' name='delete_key' value='{$comment_rep['delete_key']}'>
                    <input type='submit' name='delete_button' value='削除' />
                    </form>";
                echo "</tr>";
                // echo "<tr>";
                //echo "<td><time>{$comment_rep['time']}</time></td>";
                //echo "</tr>";
                echo "<tr>";

                $message_breaks = nl2br($comment_rep['message']);

                echo "<td>コメント
                      <br><span style = 'color:{$comment_rep['text_color']}'>{$message_breaks}</span></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>メール||<a href='mailto:{$comment_rep['email']}'>{$comment_rep['email']}</a></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>URL||<a href='{$comment_rep['url']}' target='_blank'>{$comment_rep['url']}</a></td>";
                echo "</tr>";
                echo "<tr>";
                    if(!empty($comment_rep['image_path'])){
                        echo "<td>画像：<img src='{$comment_rep['image_path']}' alt='画像'></td>";
                        }else{
                        echo '<td>画像添付なし</td>';}
                echo "</tr>";
                echo "</table>";
                
                } 
                echo "<br>"; } 

        ?>
             </div>
    </body></div>
</html>



