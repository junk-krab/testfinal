
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Каталог</title>
    <link type = "text/css" rel = "stylesheet" href = "frameworks/bootstrap.css">
    <script type="text/javascript" src="frameworks/jquery311.js"></script>


</head>
<body>

    <?php
    try { // подключение к бд
        $dbh = new PDO('mysql:dbname=proto;charset=UTF8;host=localhost', 'root', '');
    } catch (PDOException $e) {
        die($e->getMessage());
    }

    $stmt = $dbh->query('SELECT * from goods'); ///вывод услуг из буд
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<div id='services' class='row' >";
    while($row = $stmt->fetch())
    {

        echo "<div class='card-body'><p>" . $row['name'] . "</p>";
        echo "<p>Арт: " . $row['sku'] . "</p>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p  id=price". $row['id'] .">Цена: " . $row['price'] . " руб.</p>";
        echo " <p hidden class='saleday'  >". $row['saleday'] ."</p>";
        echo "<label class='checkbox'><input type='checkbox' id=" . $row['id'] . " value=". $row['price'] . ">"; ?>
        <?php
        echo "</div>";
    }
        echo "</div>";
    ?>
    <div class="container-fluid">
        <p id="sum">Сумма: <span>0</span></p>
        <p id="salefinal">Скидка: <span>0</span></p>
        <p id="finalprice">Цена со скидкой: <span>0</span></p>
        <br />
        <form method="post" action="basket.php" method="get">
            <input id="finalpriceget" name="finalpricegetname" value="" hidden>
            <input id="salefinalget" name="salefinalgetname" value="" hidden>
            <input id="arrIdPost" name="arrIdPostname" value="" hidden>
            <input type="submit" value="В корзину" id="busketButton">
        </form>
    </div>
</body>
<script type="text/javascript" src="scripts.js"></script>
</html>
