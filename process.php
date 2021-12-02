<?php

session_start();


$mysqli =  new mysqli('localhost', 'root', 'usbw', 'test') or die(mysql_error($mysqli));
// $mysqli =  new mysqli('localhost', 'yovcyore_bibli', '@senhaforte', 'yovcyore_bibli') or die(mysql_error($mysqli));
$id = 0;
$update = false;
$name = '';
$location = '';

if(isset($_POST['save'])){
  $name = $_POST['name'];
  $location = $_POST['location'];

    $_SESSION['message'] = "Alterado com sucesso!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

  $mysqli->query("INSERT INTO data (nome, localizacao) VALUES('$name', '$location')") or
  die($mysqli->error);


}
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM data WHERE cd=$id") or die($mysqli->error());
  $_SESSION['message'] = "Deletado com sucesso!";
  $_SESSION['msg_type'] = "danger";

  header("location: index.php");

}

if(isset($_GET['edit'])){
  $id = $_GET['edit'];
  $update = true;
  $result = $mysqli->query("SELECT * FROM data WHERE cd=$id") or die($mysqli->error());
  if (count($result)==1){
    $row = $result->fetch_array();
    $name = $row['nome'];
    $location = $row['localizacao'];
  }


}
if(isset($_POST['update'])){
   $id = $_POST['id'];
   $name = $_POST['name'];
   $location = $_POST['location'];

   $mysqli->query("UPDATE data SET nome='$name', localizacao='$location' WHERE cd=$id") or die($mysqli->error);

   $_SESSION['message'] = "Atualizado com sucesso!";
   $_SESSION['msg_type'] = "warning";

   header('location: index.php');
}

?>