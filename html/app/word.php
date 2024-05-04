<!-- 検索だけ -->
<html>
    <div align="center">
        <header><h3>課題掲示板sample</h3></header>
            <body>
                <hr width=200 size=1>
                <a href="./top.php">一覧(新規投稿)</a>|<a href="./word.php">ワード検索</a>
                <hr width=200 size=1>

                <form action="./word2.php" method="post">
                        <td><label for="word">検索ワードを入力してください</label></td>
                        <td><input id="word" type="text" name="word" /></td>
                        <input type="hidden" name="kensakuword" value="word">
                        <button type="submit" name="kensaku">検索</button>
                </form>
    </div>
</html>

