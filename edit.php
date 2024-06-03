<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $tytul = $_POST['tytul'];
        $content = $_POST['content'];

        $con = new mysqli("localhost", "root", "", "baza_bip");
        $sql = "UPDATE dane SET tytul=?, content=? WHERE ID=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssi", $tytul, $content, $id);
        $stmt->execute();
        $stmt->close();
        $con->close();

        header("Location: cms.php");
        exit;
    }

    $id = $_GET['id'];
    $con = new mysqli("localhost", "root", "", "baza_bip");
    $sql = "SELECT tytul, content FROM dane WHERE ID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($tytul, $content);
    $stmt->fetch();
    $stmt->close();
    $con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj</title>
    <script src="https://cdn.tiny.cloud/1/pv7c59iu4d5kidp8tompmzznga9iwdhg8k289ad69hnzjsvj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>
</head>
<body>
    <h1>Edytuj wpis</h1>
    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="tytul">Tytuł:</label>
        <input type="text" name="tytul" id="tytul" value="<?php echo htmlspecialchars($tytul); ?>" required>
        <label for="content">Treść:</label>
        <textarea id="content" name="content"><?php echo htmlspecialchars($content); ?></textarea>
        <button type="submit">Zapisz zmiany</button>
    </form>
</body>
</html>