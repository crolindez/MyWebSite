<?php

session_start();
if(!isset($_SESSION['login_user'])){
  header("location: index.php");
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
  // last request was more than 10 minutes ago
  session_unset();
  session_destroy();
  header("Location: index.php");
  setcookie('root_folder','./data/',-1);

}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if(!isset($_COOKIE['root_folder'])) {
    setcookie('root_folder','./data/');
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("Location: index.php");
  setcookie('root_folder','./data/',-1);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delfile'])) {

  $filesToDelete = explode(":", $_POST['fname']);
  foreach($filesToDelete as $file) {
    if (substr($file,0,6)=="./data") {
      if (substr($file, -1)=='/') {
          rmdir(substr($file, 0, -1));
      } else {
          unlink($file);
      }
    }
  }
  header("Location: manager.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Carlos Rolindez's Storehouse">
  <meta name="keywords" content="Carlos Rolindez, Storehouse">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" >
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="../js/manager.js"></script>
  <title>Carlos Rolindez's Storehouse </title>


</head>


<?php
function developeFolder($folder) { // folder should end with '/'

  foreach (glob($folder."*") as $filename) {
//      $name=utf8_encode($filename);
      $name=$filename;
    $size= filesize($filename);
    $date= date("d/m/Y H:i:s",filemtime($filename));
    $isfolder= is_dir($filename);

    $new_size="";
    if ($size>=1024) {
      if ($size>=(1024*1024)) {
        if ($size>=(1024*1024*1024)) {
          $new_size = round($size/(1024*1024*1024),3)." Gb";
        } else {
          $new_size = round($size/(1024*1024),3)." Mb";
        }
      } else {
        $new_size = round($size/(1024),3)." Kb";
      }
    } else {
      $new_size = $size." b";
    }
//      $short_name=utf8_encode(str_replace($folder,"",$filename));
      $short_name=str_replace($folder,"",$filename);


    if ($isfolder) {
      echo "<tr class='folder' data-folder='".$folder."' data-file='".$filename."'><td class='firstcol' align='center'><img src='../images/folder.png' height='100%'></td><td class='secondcol'><a onclick='return showfolder(\"".$filename."/\")'>".$short_name."</a></td><td class='thirdcol'>".$new_size."</td><td class='fourthcol'>".$date."</td></tr>";
      developeFolder($filename.'/');
    } else {
      echo "<tr class='file' data-folder='".$folder."' data-file='".$filename."'><td class='firstcol' align='center'><img src='../images/file.png' height='100%'></td><td class='secondcol'><a href='".$name."'>".$short_name."</a></td><td class='thirdcol'>".$new_size."</td><td class='fourthcol'>".$date."</td></tr>";
    }


  }
}


?>


<body>

  <h1> Carlos Rolindez's Storehouse </h1>

  <table class="files">
    <thead>
      <tr>
        <th class="firstcol">Type</th>
        <th class="secondcol">Name</th>
        <th class="thirdcol">Size</th>
        <th class="fourthcol">Date</th>
      </tr>
    </thead>

    <tbody>
      <?php

      echo "<tr data-folder='.' ><td class='firstcol' align='center'><img src='../images/folder.png' height='100%'></td><td class='secondcol'><a onclick='return upfolder()'>..</a></td><td class='thirdcol'> </td><td class='fourthcol'> </td></tr>";
      developeFolder('./data/');
      echo "<script>showfolder('".$_COOKIE['root_folder']."');</script>";
      ?>

    </tbody>
  </table>


  <!-- <button>Delete selected</button> -->

  <form action="manager.php" method="post">
    <input id="listoffiles" type="hidden" value="" name="fname"><br>
    <input type="submit" class="delete" name="delfile" value="delete selected" />
  </form>

  <form action="manager.php" method="post">
    <input type="submit" class="logout" name="logout" value="logout" />
  </form>


</body>
</html>
