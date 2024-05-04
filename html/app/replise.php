<?php
//返信の投稿フォーム
$id = isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$email  = isset($_POST["email"]) ? $_POST["email"] : "";
$url  = isset($_POST["url"]) ? $_POST["url"] : "";

$file_name = isset($_POST["file_name"]) ? $_POST["file_name"] : "";
$file_tmp = isset($_POST["file_tmp"]) ? $_POST["file_tmp"] : "";
$uploaded_path = isset($_POST["uploaded_path"]) ? $_POST["uploaded_path"] : "";

$text_color = isset($_POST["color"]) ? $_POST["color"] : "";
$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";

?>

<html>
    <div align="center">
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
                    <td><?php echo nl2br($message);?></td>
                </tr>
                <tr>
                    <td><label for="image">画像</label></td>
                    <td><?php
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
                    <td><label for="text_color">文字色</label>
                    <td><?php echo $text_color; ?></td>
                </tr>
            </table>

            <!---thanks.phpにhiddenで引き継ぎます 空欄  --->
            <br>
            <br>
            <h3>返信ふぉーむ</h3>
                
            <form action="thanks3.php" method="POST" enctype="multipart/form-data">
                <table border="1"><!---表示確認したらborderを削除  --->
                    <tr>
                        <td><label for="name">名前</label></td>
                        <td><input type="text" name="name" required/></td>
                    </tr>
                    <tr>
                        <td><label for="subject">件名</label></td>
                        <td><input type="text" name="subject" /></td>
                    </tr>
                    <tr>
                        <td><label for="message">メッセージ</label></td>
                        <td><textarea name="message" rows="5" cols="40" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="image">画像</label></td>
                        <td><input type="file" name="image" id="image1" accept="images/*"></td>
                    <tr>
                        <td><label for="email">メールアドレス</label></td>
                        <td><input type="email" name="email" /></td>
                    </tr>
                    <tr>
                        <td><label for="url">URL</label></td>
                        <td><input type="text" name="url" value="http://" /></td>
                    </tr>
                    <tr>
                        <td><label for="text_color">文字色</label></td>
                        <td>
                        <input type="radio" name="color" value="black" 
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

                            <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                    // フォームから送信されたデータを取得
                                    $selectedColor = $text_color;

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
                                }?>

                        </td>
                    </tr>
                    <tr>
                        <td><label for="delete_key">編集/削除キー：</label></td>
                        <td><input type="text" maxlength="8" name="delete_key">
                            (半角英数字のみで4~8文字)</td>
                    </tr>
                </table>
    
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="name_c" value="name" />
                <input type="hidden" name="subject_c" value="subject" />
                <input type="hidden" name="message_c" value="message" />
                <input type="hidden" name="image_c" value="image" />
                <input type="hidden" name="uploaded_path_c" value="uploaded_path">
                <input type="hidden" name="email_c" value="email" />
                <input type="hidden" name="url_c" value="url" />
                <input type="hidden" name="text_color_c" value="color" />
                <input type="hidden" name="delete_key_c" value="delete" />
                <br>

                <input type="submit" name="submit" value="返信に投稿する" />
            </form>
        </body>
    </div> 
</html>     