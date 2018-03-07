<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
  header("location: manager.php");
}
// $_SESSION['path']="./data/"
?>
<!DOCTYPE html>
<html>
<head>
  <title>Carlos Rolindez's Storehouse</title>
  <meta charset="UTF-8">
  <meta name="description" content="Carlos Rolindez's Storehouse">
  <meta name="keywords" content="Carlos Rolindez, Storehouse">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" >
  <link href="style.css" rel="stylesheet" type="text/css" />


</head>
<body>
  <div id="main">
    <h1>Login:</h1>
    <div id="login">
      <form action="" method="post">
        <label>UserName :</label>
        <input id="name" name="username" placeholder="username" type="text">
        <label>Password :</label>
        <input id="password" name="password" placeholder="**********" type="password">
        <input class="login" name="submit" type="submit" value=" Login ">
        <span><?php echo $error; ?></span>
      </form>
    </div>
  </div>
</body>
</html>
