<?php
    require 'controllers\head.php';
    ?>
<table>
    <tr>
        <th>id </th>
        <th>nazvan</th>
        <th>gorod</th>
        <th>categoria</th>
        <th>fullname</th>
        <th>god</th>
        <th>Dvigatel</th>
        <th>volume</th>
        <th>loshadki</th>
        <th>max</th>
        <th>mid</th>
        <th>min</th>
        <th>opisanie</th>
        <th>photos</th>
        <th>delete</th>
    </tr>


<? 
    require_once('controllers/connect.php');
    
    if (!empty($_POST)) {
        $nazvan = $_POST['nazvan'];
        $gorod = $_POST['gorod'];
        $categoria = $_POST['categoria'];
        $fullname = $_POST['fullname'];
        $god = $_POST['god'];
        $Dvigatel = $_POST['Dvigatel'];
        $loshadki = $_POST['loshadki'];
        $max = $_POST['max'];
        $mid = $_POST['mid'];
        $min = $_POST['min'];
        $opisanie = $_POST['opisanie'];
    
        $query = "INSERT INTO catalogg SET nazvan='$nazvan',
        gorod='$gorod', fullname='$fullname', god='$god', Dvigatel='$Dvigatel', loshadki='$loshadki', max='$max', mid='$mid', min='$min',opisanie ='$opisanie'";
        mysqli_query($link, $query) or die(mysqli_error($link));

        require_once('controllers/create_folders.php');
    }

   if(isset($_GET['delet'])){
    $delet = $_GET['delet'];
    $query= "INSERT INTO `deleted` SELECT * FROM `catalog` WHERE `id` = $delet";
    $query= "DELETE FROM `catalogg` WHERE `id` = $delet";
    mysqli_query($link,$query) or die (mysqli_error($link));
   }

    $query = "SELECT * FROM catalogg";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

    echo '<table>';
    foreach($data as $elem){
        $result = '';
        $result .='<tr>';
        $result .='<td>' .$elem['nazvan']. '</td>';
        $result .='<td>' . $elem['gorod']. '</td>';
        $result .='<td>' .$elem['categoria']. '</td>';
        $result .='<td>' .$elem['fullname']. '</td>';
        $result .='<td>' .$elem['god']. '</td>';
        $result .='<td>' .$elem['Dvigatel']. '</td>';
        $result .='<td>' .$elem['volume']. '</td>';
        $result .='<td>' .$elem['loshadki']. '</td>';
        $result .='<td>' .$elem['max']. '</td';
        $result .='<td>' .$elem['mid']. '</td';
        $result .='<td>' .$elem['min']. '</td';
        $result .='<td>' .$elem['opisanie']. '</td';
        $result .='<td><a href="upload-photos.php?id='.$elem['id'].'">Фотографии</a></td>';
        $result .= '<td><a href="?delet='.$elem['id'].'">удалить</a></td>';

        $result .='</tr>';
        echo $result;
    }
    echo '</table>'
?>
</table>
<form class="block" action="" method="POST">
    <input name="nazvan" placeholder="nazvanie">
    <input name="gorod" placeholder="gorod">
    <input name="categoria" placeholder="categoria">
    <input name="fullname" placeholder='fullname'>
    <input name="god" placeholder='god'>
    <input name="Dvigatel" placeholder='dvigatel'>
    <input name="volume" placeholder="volume">
    <input name="loshadki" placeholder="loshadki">
    <input name="max" placeholder="max">
    <input name="mid" placeholder='mid'>
    <input name="min" placeholder="min" >
    <input name="opisanie" placeholder='opisanie'>
    <input type="submit" value="добавить Авто">

</form>