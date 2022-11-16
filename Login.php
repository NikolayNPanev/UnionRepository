<?php
include("DBFunc.php");
?>
<body>
<form method="post" action="log.php" name="userForm">
  <h3>Login:</h3>
  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username" required><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required><br>
  <input type="radio" id="bankVeni" name="bank" value="BankOfVeni" required>
  <label for="bankVeni">Bank of Veni</label><br>
  <input type="radio" id="bankKolyo" name="bank" value="BankOfKolyo" required>
  <label for="bankKolyo">Bank of Kolyo</label><br>
  <form>
  <p><input type="submit" value="Submit"><in><a href="landing.php"><input type="button" value="Back"></input></p>
</form>
</body>

<script type="text/javascript">


  ////////////////////////////
  //                        //
  //   GET URL PARAMETERS   //
  //                        //
  ////////////////////////////

  function getUrlParams() {
  type:"module";
  var paramMap = {};
  if (location.search.length == 0) {
    return paramMap;
  }
  var parts = location.search.substring(1).split("&");

  for (var i = 0; i < parts.length; i ++) {
    var component = parts[i].split("=");
    paramMap [decodeURIComponent(component[0])] = decodeURIComponent(component[1]);
  }
  return paramMap;
}


var params = getUrlParams();

//////////////////////////////
//                          //
//   PASTE URL PARAMETERS   //
//                          //
//////////////////////////////


if(!(params.username == null)){
    document.getElementById('username').value = params.username;
  }

</script>