<?php
if (isset($_GET['del'])) {
    $del = $_GET['del'];
    unlink($del);
}

require_once('controllers/connect.php');
$query = "SELECT * FROM catalogg WHERE id=" . $_GET['id'];
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$data = mysqli_fetch_assoc($result);

$dir = 'templates/img/photos/' . $data['id'] . '-' . $data['nazvan']; // Укажите путь к папке с
$files = scandir($dir); // Получаем список файлов в папке

foreach ($files as $file) {
    $file_path = $dir . '/' . $file;

    if (is_file($file_path) && in_array(pathinfo($file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
        echo '<img src="' . $file_path . '" ;>';
        echo '<a href="?id='.$_GET['id'].'&del=' . $file_path . '">Удалить фото</a>';
    }
}

$uploadDir = 'templates/img/photos/' . $data['id'] . '-' . $data['nazvan'] . '/';

if ($_FILES) {
    $files = array_filter($_FILES['upload']['name']);
    $total = count($_FILES['upload']['name']);

    for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

        if ($tmpFilePath != "") {
            $newFilePath = $uploadDir . $_FILES['upload']['name'][$i];

            if (!file_exists($newFilePath)) {
                move_uploaded_file($tmpFilePath, $newFilePath);
                echo $_FILES['upload']['name'][$i] . ' успешно загружен в папку ' . $uploadDir . '<br>';
            } else {
                echo 'Файл ' . $_FILES['upload']['name'][$i] . ' уже существует!';
            }
        }
    }
}
?>

<form enctype="multipart/form-data" method="post">
    <input name="upload[]" type="file" multiple="multiple">
    <input type="submit" value="нажми на меня">
</form>