<!DOCTYPE html>
<html>

<head>
   <title>Show Result</title>
</head>

<body>

<h1> Поздравляем! </h1>

Вы выиграли <?=$_GET['type_name']?>: <?=$_GET['amount']?><br>
<br>
<br>
<input type='button' value='Продолжить' onclick="location.href='tws_send_<?=$_GET['url']?>.php?<?=$_SERVER['QUERY_STRING']?>'"><br><br>

<?php
if($_GET['url'] == 'good'){ ?>
   Вы можете отказаться от приза:<br>
   <input type='button' value='Отказаться' onclick="location.href='tws_reject_good.php?<?=$_SERVER['QUERY_STRING']?>'"><br>
<?php } ?>

<?php
if($_GET['url'] == 'money'){ ?>
   Вы можете перевести эти деньги в баллы:<br>
   <input type='button' value='Перевести' onclick="location.href='tws_reject_money.php?<?=$_SERVER['QUERY_STRING']?>'"><br>
<?php } ?>
   
</body>
</html>
