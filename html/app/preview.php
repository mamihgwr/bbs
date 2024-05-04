<?php
//プレビューページ
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$email  = isset($_POST["email"]) ? $_POST["email"] : "";
$url  = isset($_POST["url"]) ? $_POST["url"] : "";

$file_name = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
$file_tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"] : "";
$uploaded_path = isset($_POST["uploaded_path"]) ? $_POST["uploaded_path"] : "";

$text_color = isset($_POST['color']) ? $_POST['color'] : "black";
$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";

?>


<html><div align="center">
    <header><h3>課題掲示板sample</h3></header>
        <body>
            <hr width=200 size=1>
            <a href="http://localhost:8000/top.php">一覧(新規投稿)</a>
            <hr width=200 size=1>
            <table border="1"><!---表示確認したらboeder消す  --->
                <tr>
                    <td><label for="name">名前</label></td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td><label for="subject">件名</label></td>
                    <td><?php echo $subject; ?></td>
                </tr>
                <tr>
                    <td><label for="message">メッセージ</label></td>
                    <td><?php echo nl2br ($message); ?></td>
                    
                </tr>
                <tr>
                    <td><label for="image">画像</label></td>
                    <td> <?php
                    if(!empty($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $file_name);
                        $uploaded_path = './images/' . $file_name;
                        echo "<img src='{$uploaded_path}' alt='アップロードされた画像'>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td><label for="email">メールアドレス</label></td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td><label for="url">URL</label></td>
                    <td><?php echo $url; ?></td>
                </tr>
                <tr>
                    <td><label for="color">文字色</label>
                    <td><span style="color:<?php echo $text_color; ?>">◼︎</span>
                    </td>

                </tr>
                <tr>
                  <td><label for="delete_key">編集/削除キー：</label></td>
                  <td><?php echo $delete_key; ?></td>            
                </tr>
            </table>
 
             <!---thanks.phpにhiddenで引き継ぎます 空欄  --->
        <form action="thanks.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="name" value="<?php echo $name; ?>" />
            <input type="hidden" name="subject" value="<?php echo $subject; ?>" />
            <input type="hidden" name="message" value="<?php echo nl2br ($message);?>" />
            <input type="hidden" name="uploaded_path" value="<?php echo $uploaded_path; ?>" />
            <input type="hidden" name="email" value="<?php echo $email; ?>" />
            <input type="hidden" name="url" value="<?php echo $url; ?>" />
            <input type="hidden" name="color" value="<?php echo $text_color; ?>" />
            <input type="hidden" name="delete_key" value="<?php echo $delete_key; ?>" />
            <br>
            <!--onclick="history.back();" ブラウザバック--->
            <input type="button" value="もどって修正する" onclick="history.back(-1);" />
            <input type="submit" name="submit" value="このまま投稿する" />
        </form>

    </body></div> 
</html>     