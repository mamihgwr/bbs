<?php //edit.phpからchange.phpにきてフォーム入力→送信後はthanks2.phpへ
//session_start();

$id =isset($_POST["id"]) ? $_POST["id"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
$message = isset($_POST["message"]) ? $_POST["message"] : "";
$email  = isset($_POST["email"]) ? $_POST["email"] : "";
$url  = isset($_POST["url"]) ? $_POST["url"] : "";

$file_name = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
$file_tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"] : "";
$uploaded_path = isset($_POST["uploaded_path"]) ? $_POST["uploaded_path"] : "";

$text_color = isset($_POST["color"]) ? $_POST["color"] : "black";

$delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";
$edit_key = isset($_POST["edit_key"]) ? $_POST["edit_key"] : "";
$keyz = isset($_POST["keyz"]) ? $_POST["keyz"] : "";

//echo $delete_key; 前のフォームで入力したキー
//echo $edit_key; 投稿スレで入力したキー


// エラーメッセージ
/*$err = [];
$num = [];
        
    // バリデーション
    if (empty($delete_key) || $delete_key !== $edit_key  ) {
        $err['delete_key'] = '編集キーを正しく入力してください。'; 
        $num['key'] = $edit_key;
    }
    // 未入力エラーチェック
    if (empty($delete_key)) {
        $err['delete_key'] = '編集キーを入力してください。';
        $num['key'] = $edit_key;
    }
    if (count($err) > 0 && count($num) > 0 && $delete_key !=='delete_key') {
      // 未入力返す
      $_SESSION['err']  = $err;
      $_SESSION['num']  = $num;
      header('location:edit.php');
      exit;;
        
    }else{*/
        $link = mysqli_connect('db', 'root', 'pass', 'boards');      
        
        /* 接続状況をチェックします
        if (mysqli_connect_errno()) {
            die("データベースに接続できません:" . mysqli_connect_error() . "\n");
        } else {
            echo "データベースの接続に成功しました2\n";
        }*/

        mysqli_select_db($link,"boards");
        mysqli_set_charset($link,'utf8');

   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // データベースから対応する行を取得
    $result = mysqli_query($link, "SELECT * FROM boards WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    //echo $delete_key;
    }    
    
    


?>


<html>
    <div align="center">
        <body>
            <form action="thanks2.php" method="post" enctype="multipart/form-data">
                <table border="1"><!---表示確認したらborderを削除  --->
                    <tr>
                        <td><label for="name_c">名前</label></td>
                        <td><input type="text" name="name_c" value="<?php echo $name;?>"/></td>
                    </tr>
                    <tr>
                        <td><label for="subject_c">件名</label></td>
                        <td><input type="text" name="subject_c" value="<?php echo $subject;?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="message_c">メッセージ</label></td>
                        <td><textarea name="message_c" rows="5" cols="40"><?php echo $message;?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="image_c">画像</label></td>
                        <td><input type="file" accept="image/*" name="image_c"  /></td>
                    </tr>
                    <tr>
                        <td><label for="email_c">メールアドレス</label></td>
                        <td><input type="email" name="email_c" value="<?php echo $email;?>"/></td>
                    </tr>
                    <tr>
                        <td><label for="url_c">URL</label></td>
                        <td><input type="text" name="url_c" value="<?php echo $url;?>" /></td>
                    </tr>
                    <tr>
                        <td><label for="text_color_c">文字色</label></td>
                        <td>
                            <input type="radio" name="text_color_c" value="black" 
                                <?php if ($text_color === "black") echo "checked"; ?> checked/> 
                            <span style="color:black">◼︎</span>
                            <input type="radio" name="text_color_c" value="red" 
                                <?php if ($text_color === "red") echo "checked"; ?>/> 
                            <span style="color:red">◼︎</span>
                            <input type="radio" name="text_color_c" value="blue" /> 
                                <?php if ($text_color === "blue") echo "checked"; ?>
                            <span style="color:blue">◼︎</span>
                            <input type="radio" name="text_color_c" value="green" 
                                <?php if ($text_color === "green") echo "checked"; ?> /> 
                            <span style="color:green">◼︎</span>
                            <input type="radio" name="text_color_c" value="magenta" 
                                <?php if ($text_color === "magenta") echo "checked"; ?>/> 
                            <span style="color:magenta">◼︎</span>
                            <input type="radio" name="text_color_c" value="orange" 
                                <?php if ($text_color === "orange") echo "checked"; ?>/> 
                            <span style="color:orange">◼︎</span>
                            <input type="radio" name="text_color_c" value="yellow" /> 
                                <?php if ($text_color === "yellow") echo "checked"; ?>
                            <span style="color:yellow">◼︎</span>
                            <input type="radio" name="text_color_c" value="navy" /> 
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
                        <td><label for="delete_key_c">編集/削除キー：</label></td>
                        <td><input type="text" maxlength="8" name="delete_key_c" value="<?php echo $delete_key;?>">
                            (半角英数字のみで4~8文字)</td>
                    </tr>
                </table>           
                <br>
                <input type="submit" value="変更を保存" name="submitbutton" />


                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="name" value="<?php echo $name; ?>">
                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                <input type="hidden" name="message" value="<?php echo $message; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="url" value="<?php echo $url; ?>">

                <input type="hidden" name="file_name" value="<?php echo $file_name; ?>">
                <input type="hidden" name="file_tmp" value="<?php echo $file_tmp; ?>">
                <input type="hidden" name="text_color" value="<?php echo $text_color; ?>">
                <input type="hidden" name="checkbox" value="<?php echo $checkbox; ?>">
                <input type="hidden" name="delete_key" value="<?php echo $delete_key; ?>">
            </form>
        </body>
    </div>
</html>
