<!DOCTYPE html>
<html>
<head>
   <title>Title of the document</title>
</head>
<body>

   <h1>Вы соглашаетесь получить приз</h1>
<br>
   <input type='button' value='Получить приз' onclick="location.href='tws_get_prize_exec.php?user_id=<?=$_GET['user_id']?>&token=<?=$_GET['token']?>'">

</body>
</html>
