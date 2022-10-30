<form method="post" action="log.php" name="userForm">
  <h3>Login:</h3>
  <label for="username">Username:</label><br>
  <input type="text" id="username" name="username" required><br>
   <label for="password">Password:</label><br>
  <input type="password" id="password" name="password" required><br>
  <form>
  <input type="submit" value="Submit">
</form>

<script type="text/javascript">
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
document.getElementById('username').value = params.username;
</script>