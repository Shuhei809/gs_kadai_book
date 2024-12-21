<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">過去に読んだ本</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="/gs_kadai_book/insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>本のブックマーク</legend>
                <label>名前：<input type="text" name="name"></label><br>
                <label>URL:<input type="text" name="url"></label><br>
                <label>コメント：<textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

  <!-- DBデータの表示 -->
    <div>
        <h2>登録されたデータ</h2>
        <div class="container jumbotron">
            <?php
            // DB接続
            try {
            $pdo = new PDO('mysql:dbname=goldwolf38_gs_kadai;charset=utf8;host=mysql3104.db.sakura.ne.jp', 'goldwolf38_gs_kadai', 'random1234');
            } catch (PDOException $e) {
                exit('DBConnectError:' . $e->getMessage());
            }

            // データ取得
            $stmt = $pdo->prepare('SELECT * FROM gs_book_table');
            $status = $stmt->execute();

            // データ表示
            if ($status === false) {
                $error = $stmt->errorInfo();
                exit('ErrorQuery:' . $error[2]);
            } else {
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<p>';
                    echo htmlspecialchars($result['date'], ENT_QUOTES) . ': ' .
                        htmlspecialchars($result['name'], ENT_QUOTES) . ' ' .
                        htmlspecialchars($result['url'], ENT_QUOTES) . ' ' .
                        htmlspecialchars($result['comment'], ENT_QUOTES);
                    echo '</p>';
                }
            }
            ?>
        </div>
    </div>

</body>

</html>
