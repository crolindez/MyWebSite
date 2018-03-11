<?php

session_start();
if(!isset($_COOKIE['root_folder'])) {
    setcookie('root_folder','./data/');
}

if(!isset($_SESSION['login_user'])){
  header("location: index.php");
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
  // last request was more than 10 minutes ago
  session_unset();
  session_destroy();
  setcookie('root_folder','./data/',-1);
  header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp



if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout'])) {
  echo "<script>alert('control2');</script>";
  session_unset();
  session_destroy();
  setcookie('root_folder','./data/',-1);
  header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST" /*and isset($_POST['delfile'])*/) {
  echo "<script>alert('hola');</script>";
  echo "<script>alert('".$_POST['delfile']."');</script>";
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

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['upload'])) {
  $total = count($_FILES['fileToUpload']['name']);

  // Loop through each file
  for($i=0; $i<$total; $i++) {
    //Get the temp file path
    $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];

    //Make sure we have a filepath
    if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = $_COOKIE['root_folder'] . $_FILES['fileToUpload']['name'][$i];

      //Upload the file into the temp dir
      echo "<script>alert('".$tmpFilePath." -> ".$newFilePath."');</script>";
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {

        //Handle other code here

      }
    }
  }
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
  <script type="text/javascript" src="manager.js"></script>
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

  <h2 id="headfolder"> </script></h2>

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



  <form action="manager.php" method="post" enctype="multipart/form-data">
    <input type="file" id="fileToUpload" class="inputfile" name="fileToUpload[]" data-multiple-caption="{count} files selected" multiple/>
    <label for="fileToUpload"><svg width="20" height="20 " viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/> <span> Choose a file&hellip;</span></label>
    <input type="submit" class="upload" name="upload" value="upload"/>
  </form>

  <form action="manager.php" method="post">
    <input type="text" class="createFolder" name="newfolder" />
    <input type="submit" class="createFolder" name="createFolder" value="new folder" />
  </form>

  <form action="manager.php" method="post">
    <input type="hidden" class="delete" name="fname" value=""/>
    <input type="submit" class="delete" name="delfile" value="delete selected" />
  </form>



  <form action="manager.php" method="post">
    <input type="submit" class="logout" name="logout" value="logout" ></input>
  </form>




</body>
</html>
