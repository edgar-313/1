<!DOCTYPE html>
<html lang="en">
<?
    require_once('controllers/head.php')
?>
<body>
<main>
    <?php 
        require_once ("controllers/connect.php");
        
        $query = "SELECT * FROM catalogg WHERE id=".$_GET['id'];
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $data = mysqli_fetch_assoc($result);
        // var_dump($data);
        $dir = 'templates/img/photos/' . $data['id'] . '-' . $data['nazvan']; // Укажите путь к папке с
        $files = scandir($dir); // Получаем список файлов в папке
        // var_dump($files);
        

?>  
   <header>
        <div class="nav-menu">
          <ul class="menu">
            <div class="logo">
              <li><h1>АРЕНДАТАЧЕК.РФ</h1></li>
            </div>
            <div class="knopki no-vid" >  
              <li>Подобрать авто</li>
              <li>Условия</li>
              <li>Цены</li>
              <li>О нас</li>
              <li>Контакты</li>
            </div>
            <div class="media no-vid">
              <li><img src="templates\img/Vector (33).png" alt=""></li>
              <li><img src="templates\img/Vector (32).png" alt=""></li>
            </div>
            <div class="nomer no-vid">
              <li>7 (499) 110-20-47</li>
            </div>
            <div class="button1 no-vid">
              <li><button>Заказать звонок</button></li>
            </div>
            <div class="fotop">
              <li><img src="templates\img/Group 71 (1).png" alt=""></li>
              <li><img src="templates\img/Group 72 (1).png" alt=""></li>
            </div>
          </ul>
        </div>
      </header>

    <section class= "slid-info container">
        <div class="slider-container">
                <h1 class="page-title"><?=$data['fullname']?> <?=$data['god']?></h1>
                <div class="slider">
                
                    <?
                    foreach ($files as $file) {
                        $file_path = $dir . '/' . $file;

                        if (is_file($file_path) && in_array(pathinfo($file_path,
                        PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                            echo '<img src="' . $file_path . '" ;>';
                        }
                    
                    }
                    ?>
                </div>
            
                <button class="prev-button" aria-label="Посмотреть предыдущий слайд">&lt;</button>
                <button class="next-button" aria-label="Посмотреть следующий слайд">&gt</button>
        </div>
        <div class= "infocar">
            <p class= "ceninf"><?=$data['max']?>₽</p>

            <div class="stoim">
                <h1>Стоимость аренды</h1>
                <p class="cenaa">от 7 до 14 суток: <span><?=$data['max']?></span></p>
                <p class="cenaa">от 14 до 29 суток: <span><?=$data['mid']?></span> </p>
                <p class="cenaa">от 30 суток: <span><?=$data['min']?></span> </p>
                <div class="inf">
                    <p><?=$data['gorod'] ?></p>
                    <p><img src="templates/img/Vector (8).png" alt=""><?=$data['volume'] ?></p>
                    <p><img src="templates/img/Vector (9).png" alt=""><?=$data['loshadki'] ?></p>
                    <p><img class="benz" src="templates/img/icon-in-card-3.png" alt=""><?=$data['Dvigatel'] ?></p>
                </div>
                <button>Арендовать</button>
            </div>
            
            <p class="fullopis"><?=$data['opisanie']?></p>

        </div>
        
    </section>
</main>
  
  <script src="script.js"></script>
</body>
</html>