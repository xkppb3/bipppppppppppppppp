<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj nowy element</title>
    <link rel="stylesheet" href="addstyle.css">
    <script src="https://cdn.tiny.cloud/1/pv7c59iu4d5kidp8tompmzznga9iwdhg8k289ad69hnzjsvj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#content'
      });
    </script>
</head>
<body>
    <main>
        <form method="post">
            <label for="tytul">Tytuł:</label><br>
            <input type="text" id="tytul" name="tytul"><br>
            <label for="content">Treść:</label><br>
            <textarea id="content" name="content"></textarea><br><br>
            <input type="submit" value="Dodaj">
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $tytul = $_POST['tytul'];
                $content = $_POST['content'];
                $parent = $_GET['parent'];

                $con = new mysqli("localhost", "root", "", "baza_bip");
                $sql = "INSERT INTO dane (tytul, content, rodzic) VALUES (?, ?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssi", $tytul, $content, $parent);
                $stmt->execute();
                $stmt->close();
                $con->close();

                header("Location: index.php"); // Przekierowanie do pliku index.php po dodaniu nowego elementu
                exit;
            }
        ?>
        
    </main>
</body>
</html>