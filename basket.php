
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Каталог</title>
    <link type = "text/css" rel = "stylesheet" href = "frameworks/bootstrap.css">
    <script type="text/javascript" src="frameworks/jquery311.js"></script>
    <script type="text/javascript" src="array.js"></script>


</head>
<body>
<?php

if (!empty($_POST["finalpricegetname"])&&!empty($_POST["salefinalgetname"]))
{
    $final_Price = $_POST["finalpricegetname"];
    $sale = $_POST["salefinalgetname"];
    $id_Post = $_POST["arrIdPostname"];

}
else
{
    echo "В корзине нет товаров";
}

$id_Arr = preg_split("/[\s,]+/", $id_Post);

$id_Arr_DB = implode(',', array_fill(0, count($id_Arr), '?'));


?>
<?php ///Доступ к бд
try {
    $dbh = new PDO('mysql:dbname=proto;charset=UTF8;host=localhost', 'root', '');
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

<?php

$sth = $dbh->prepare("SELECT id, name, price FROM goods WHERE id IN ($id_Arr_DB)");
$sth->execute($id_Arr);
while($row = $sth->fetch())
{

    echo "<div class='card-body'><p>" . $row['name'] . "</p>";
    $item_Price = $row['price'] - ($row['price']/100*$sale) ;
    echo "<p>" . $item_Price . "</p>";
    echo "</div>";
}
echo "</div>";
?>
<?php
?>


    <p>Сумма со скидкой: <?php echo $final_Price ?> </p>
<?php
$mrh_login = "user";
$mrh_pass1 = "password_1";
$inv_id = 0;
$inv_desc = "Оплата заказа";
$out_summ = $final_Price;
$shp_item = count($id_Arr);
$culture = "ru";
$encoding = "utf-8";
$crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_Item=$shp_item");
print "<html><script language=JavaScript ". "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormMS.js?". "MerchantLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id". "&Description=$inv_desc&SignatureValue=$crc&shp_Item=$shp_item". "&Culture=$culture&Encoding=$encoding'></script></html>";
?>
</body>
</html>
