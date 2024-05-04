<?php
//topページ：投稿フォームの結果を戻す：プレビュー遷移に利用する
//スレは全てthreadsページで作成
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$email  = isset($_POST["email"]) ? $_POST["email"] : "";
$url  = isset($_POST["url"]) ? $_POST["url"] : "";

$file_name = isset($_POST["file_name"]) ? $_POST["file_name"] : "";
$file_tmp = isset($_POST["file_tmp"]) ? $_POST["file_tmp"] : "";
$text_color = isset($_POST["color"]) ? $_POST["color"] : "black";
$checkbox= isset($_POST["checkbox"]) ? $_POST["checkbox"] : "";

$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";

date_default_timezone_set('Asia/Tokyo');
$postdate = date("Y-m-d H:i:s");

// バリデーションエラーのメッセージ保管用

$errors = array();

// フォームから送信されたデータを取得
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //フォームから取得した文字色をselectedcolorに代入する
    $selectedColor = $_POST["color"];

    //条件ならテキストカラーに代入する
    if ($selectedColor === "red") {
        $text_color = "red";
    } elseif ($selectedColor === "blue") {
        $text_color = "blue";
    } elseif ($selectedColor === "green") {
        $text_color = "green";
    } elseif ($selectedColor === "magenta") {
        $text_color = "magenta";
    } elseif ($selectedColor === "orange") {
        $text_color = "orange";
    } elseif ($selectedColor === "yellow") {
        $text_color = "yellow";
    } elseif ($selectedColor === "navy") {
        $text_color = "navy";
    } elseif ($selectedColor === "black") {
        $text_color = "black";
    } else {
        $text_color = "black"; // デフォルトの色
    }
} else {
    // POSTリクエストが送信されていない場合のデフォルトの色
    $text_color = "black";
}
?>
<html>
    <?php   //checkboxの有無の画面遷移
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if ($checkbox === "1" ) {
                //入っていたプレビュー画面へ遷移
                require 'preview.php';
                exit;
            } else {
                //入っていなかった投稿完了thanks.phpへ遷移
                require 'thanks.php';
                exit;
            }
        }
    ?>

    <div align="center">
     <header><h3>課題掲示板sample</h3></header>
        <body>
            <hr width=200 size=1>
            <a href="./top.php">一覧(新規投稿)</a>|<a href="./word.php">ワード検索</a>
            <hr width=200 size=1>

            <form  action="form.php" method="POST" enctype="multipart/form-data">
                <table border="1"><!---表示確認したらboeder消  --->
                    <tr>
                        <td><label for="name">名前</label></td>
                        <td><input id="name" type="text" name="name" /></td>
                    </tr>
                    <tr>
                        <td><label for="subject">件名</label></td>
                        <td><input id="subject" type="text" name="subject" /></td>
                    </tr>
                    <tr>
                        <td><label for="message">メッセージ</label></td>
                        <td><textarea name="message"  rows="5" cols="40"></textarea></td>
                    
                    </tr>
                    <tr>
                        <td><label for="image">画像</label></td>
                        <td><input type="file" name="image" id="image1" accept="images/*"></td>
                    </tr>
                    <tr>
                        <td><label for="email">メールアドレス</label></td>
                        <td><input type="email" name="email" /></td>
                    </tr>
                    <tr>
                        <td><label for="url">URL</label></td>
                        <td><input type="text" name="url" value="http://" /></td>
                        <!---type url valueでhttpをデフォ設定　patterm=”^[0-9A-Za-z]+$”で英数字設定 --->
                    </tr>
                    <tr>
                        <td><label for="text_color">文字色</label>
                        <td><input type="radio" name="color" value="black" 
                                <?php if ($text_color === "black") echo "checked"; ?> checked/> 
                            <span style="color:black">◼︎</span>
                            <input type="radio" name="color" value="red" 
                                <?php if ($text_color === "red") echo "checked"; ?>/> 
                            <span style="color:red">◼︎</span>
                            <input type="radio" name="color" value="blue" /> 
                                <?php if ($text_color === "blue") echo "checked"; ?>
                            <span style="color:blue">◼︎</span>
                            <input type="radio" name="color" value="green" 
                                <?php if ($text_color === "green") echo "checked"; ?> /> 
                            <span style="color:green">◼︎</span>
                            <input type="radio" name="color" value="magenta" 
                                <?php if ($text_color === "magenta") echo "checked"; ?>/> 
                            <span style="color:magenta">◼︎</span>
                            <input type="radio" name="color" value="orange" 
                                <?php if ($text_color === "orange") echo "checked"; ?>/> 
                            <span style="color:orange">◼︎</span>
                            <input type="radio" name="color" value="yellow" /> 
                                <?php if ($text_color === "yellow") echo "checked"; ?>
                            <span style="color:yellow">◼︎</span>
                            <input type="radio" name="color" value="navy" /> 
                                <?php if ($text_color === "navy") echo "checked"; ?>
                            <span style="color:navy">◼︎</span>
                        </td>
                    </tr>
                    <tr>
                    <td><label for="delete_key">編集/削除キー：</label></td>
                    <td><input type="password" minlength="4" maxlength="8" name="delete_key">
                            (半角英数字のみで4~8文字)</td>             
                    </tr>
                </table>

                <input type="hidden" name="checkbox" valure="0" />
                <input type="checkbox" name="checkbox" value="1"/>プレビューする(投稿前に、内容をプレビューして確認)
               
                <input type="hidden" name="name_f" valure="name" />
                <input type="hidden" name="subject_f" valure="subject" />
                <input type="hidden" name="message_f" valure="message" />
                <input type="hidden" name="image_f" valure="image" />
                <input type="hidden" name="email_f" valure="email" />
                <input type="hidden" name="url_f" valure="url" />
                <input type="hidden" name="color_f" valure="color" />
                <input type="hidden" name="delete_key_f" valure="delete_key" />

                <br>
                <input type="submit" value="投稿" name="submitbutton" />
                <input type="reset" value="リセット" />
            </form>



            <?php //スレッドは全てthereadsで表示           
                require 'threads.php';
            ?>

        </body>
    </div>
</html>