<?php
  //編集後のthanxページ
    $id =isset($_POST["id"]) ? $_POST["id"] : "";
    $name = isset($_POST["name_c"]) ? $_POST["name_c"] : "";
    $subject = isset($_POST["subject_c"]) ? $_POST["subject_c"] : "";
    $message = isset($_POST["message_c"]) ? $_POST["message_c"] : "";
    $email  = isset($_POST["email_c"]) ? $_POST["email_c"] : "";
    $url  = isset($_POST["url_c"]) ? $_POST["url_c"] : "";
  
    $text_color = isset($_POST["text_color_c"]) ? $_POST["text_color_c"] : "";
    $delete_key = isset($_POST["delete_key_c"]) ? $_POST["delete_key_c"] : "";

    $file_name = isset($_FILES["image_c"]["name"]) ? $_FILES["image_c"]["name"] : "";
    $file_tmp = isset($_FILES["image_c"]["tmp_name"]) ? $_FILES["image_c"]["tmp_name"] : "";
    $uploaded_path = isset($_POST["uploaded_path"]) ? $_POST["uploaded_path"] : "";
    
    date_default_timezone_set('Asia/Tokyo');
    $postdate = date("Y年m月d日 H時i分s秒");

    if(!empty($_FILES["image_c"]["tmp_name"])) {
        move_uploaded_file($_FILES['image_c']['tmp_name'], './images/' . $file_name);
        $uploaded_path = './images/' . $file_name;
       //echo "<img src='{$uploaded_path}' alt='アップロードされた画像'>";
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
    //データベースに接続する
    $link = mysqli_connect('db', 'root', 'pass', 'boards');
    mysqli_set_charset($link,'utf8');

    //ボードのSQLをUPDATE
    $sql="UPDATE boards SET 
            name = '$name' , subject = '$subject' , message = '$message' , email = '$email' , url = '$url',
            image_path = '$uploaded_path' , text_color = '$text_color' , delete_key = '$delete_key'
    WHERE id = '$id' ";
     //var_dump($sql);
     ?>

 <html>
    <div align="center">
        <header><h3>課題掲示板sample</h3></header>
        <body>
            <hr width=200 size=1>
            <a href="http://localhost:8000/top.php">一覧(新規投稿)</a>
            <hr width=200 size=1>

            <?php
                $result = mysqli_query($link, $sql);

                if ($result) {
                    echo "<html><body><div align='center'>";
                    echo "<p><h3>投稿完了しました！</h3></p>";
                    echo "</div></body></html>";
                } else {
                    echo "エラー：" . mysqli_error($link);
                }
            }
            ?>
        </body>
    </div>
</html>