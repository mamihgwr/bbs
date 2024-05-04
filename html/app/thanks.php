<?php
 //投稿のthanxページ
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";
    $email  = isset($_POST["email"]) ? $_POST["email"] : "";
    $url  = isset($_POST["url"]) ? $_POST["url"] : "";
  
    $text_color = isset($_POST['color']) ? $_POST['color'] : "black";
    $delete_key = isset($_POST["delete_key"]) ? $_POST["delete_key"] : "";

    $file_name = isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"] : "";
    $file_tmp = isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"] : "";
    $uploaded_path = isset($_POST["uploaded_path"]) ? $_POST["uploaded_path"] : "";

    date_default_timezone_set('Asia/Tokyo');
    $postdate = date("Y-m-d H:i:s");

    if(!empty($_FILES["image"]["tmp_name"])) {
        move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $file_name);
        $uploaded_path = './images/' . $file_name;
      //  echo "<img src='{$uploaded_path}' alt='アップロードされた画像'>";
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){

    //データベースに接続する
    $link = mysqli_connect('db', 'root', 'pass', 'boards');
    mysqli_select_db($link,"boards");
    mysqli_set_charset($link,'utf8');

  
    //データベースへコメントデータを追加する
    $sql = ("INSERT INTO boards(name,subject,message,image_path ,email,url,text_color,delete_key,time)
    VALUES('{$name}','{$subject}','{$message}','{$uploaded_path}','{$email}','{$url}','{$text_color}','{$delete_key}','{$postdate}')");

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