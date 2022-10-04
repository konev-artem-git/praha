<!DOCTYPE html>
<html>
<head>
   <title>Registration</title>
</head>

<body>

<h2>Регистрация нового пользователя</h2>
<br>

<form action='tws_registration_exec.php' method='POST'>
   Введите имя пользователя<br>
   <input type='text' name='user_name'><br><br>

   Введите емэйл<br>
   <input type='text' name='mail'><br><br>

   Введите пароль:<br>
   <input type='password' name='password'><br><br>

   <input type='submit' value='OK'>
</form>

</body>
</html>
