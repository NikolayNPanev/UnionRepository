<form method="post" action="reg.php" name="userForm">
  <h3>Registration:</h3>
  <label for="fname" value="">First name:</label><br>
  <input type="text" id="fname" name="fname" ><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username" required><br>
   <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required><br>
  <h3>What bank would you like to register for:</h3>

  <input type="radio" id="BankOfKolyo" name="bankName" value="BankOfKolyo" required>
  <label for="BankOfKolyo">Bank Of Kolyo</label><br>
  <input type="radio" id="BankOfVeni" name="bankName" value="BankOfVeni">
  <label for="BankOfVeni">Bank Of Veni</label><br>
  <form>
  <input type="checkbox" id="ToS" name="ToS" required>
  <label for="ToS"> I agree to the terms of service</label><br><br>
  <input type="submit" value="Submit">
</form>

<?php

?>