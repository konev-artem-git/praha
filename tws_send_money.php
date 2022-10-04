<!DOCTYPE html>
<html>
<head>
   <title>денежный перевод</title>
</head>

<body>

<form action='tws_send_money_exec.php' method='POST' >
   <?php
      foreach ($_GET as $key=>$val){
         echo "<input type='hidden' name='$key' value='$val'>";
         $$key = $val;
      }
   ?>
   <h3>TODO: денежный перевод:</h3> <br>
<b>Z účtu:</b> <input type="text" name="our_acc" readonly value='<?=$our_acc?>'><br><br>

<b>Na účet:</b><br>
<table><tr>
   <th>Předčíslí</th> 
   <th>Číslo účtu</th> 
   <th>Kód banky</th> 
</tr><tr>
   <td><input type="text" name="to_pred" value='<?=$to_pred?>'></td>
   <td><input type="text" name="to_acc" value='<?=$to_acc?>'></td>
   <td><input type="text" name="to_bank" value='<?=$to_bank?>'></td>
</tr>
</table><br><br>

<b>Částka:</b> <input type="text" name="acc_sum" readonly value='<?=$amount?>'> CZK<br><br>

<table>
<tr>
   <th>Variabilní symbol:</th>
   <td><input type="text" name="acc_var"></td></tr>
<tr>
   <th>Konstantní symbol:</th>
   <td><input type="text" name="acc_const"></td></tr>
<tr>
   <th>Specifický symbol:</th>
   <td><input type="text" name="acc_spec"></td></tr>
<tr>
   <th>Zpráva pro příjemce:</th>
   <td><input type="text" name="acc_mymsg"></td></tr>
<tr>
   <th>Zpráva pro mne:</th>
   <td><input type="text" name="acc_hismsg"></td></tr>
</table><br><br>

   <input type='submit' value='Подтвердить'>
</form>

</body>
</html>
