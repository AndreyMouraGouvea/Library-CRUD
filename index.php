<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- https://www.youtube.com/watch?v=3xRMUDC74Cw -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- update -->
  <!-- Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <!-- ICON -->
  <link rel="shortcut icon" href="files/library.png">

  <title>Livraria</title>
</head>
<body>
  <!-- Pedido para acessar o arquivo do PHP -->
  <?php require_once 'process.php'; ?>

  <?php

  if(isset($_SESSION['message'])): ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">


      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
  </div>
  <?php endif ?>

  <div class="container">

  <?php
  $mysqli = new mysqli('localhost', 'root', 'usbw','test') or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
  // pre_r($result);
  ?>

  <div class="row justify-center">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Location</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>

      <!-- ********************** -->
      <?php
      while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['localizacao']; ?></td>
        <td>
          <a href="index.php?edit=<?php echo $row['cd']; ?>" class="btn btn-info">Edit</a>
          <a href="process.php?delete=<?php echo $row['cd']; ?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
      <!-- ********************** -->
        <?php endwhile; ?>
    </table>
  </div>

  <?php
  // pre_r($result->fetch_assoc());
  // pre_r($result->fetch_assoc());

  function pre_r( $array ){
      echo '<pre>';
      print_r($array);
      echo '</pre>';
  }
  ?>
  <!-- Criando Parte do Formulário -->
  <div class="row justify-content-center">
    <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id?>">
      <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name"
        >
      </div>
      <div class="form-group">
        <label>Location</label>
        <input type="text" name="location" value="<?php echo $location; ?>" class="form-control" placeholder="Enter your location" >
      </div>
      <div class="form-group">
        <?php
          if ($update == true);
        ?>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <!-- elseif: -->
        <button type="submit" class="btn btn-primary" name="save">Save</button>
        <!-- endif; -->
      </div>
    </form>
  </div>
</div>


</body>
</html>