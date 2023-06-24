<?php

  require'functions.php';

  // cek apakah tombol submit sudah diklik atau belum
  if( isset($_POST['regist']) ){
    
    if( registration($_POST) > 0 ){
      echo "<script>
              alert('Username berhasil ditambahkan');
              window.location.href= 'login.php';
            </script>";
    }else{
      echo "<script>
              alert('Username gagal ditambahkan');
            </script>";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup Admin</title>
    <link rel="stylesheet" href="css/style_signup.css" />
  </head>
  <body>
    <div class="box">
      <span class="borderLine"></span>
      <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <h2>SIGNUP</h2>
        <div class="inputBox">
          <input type="text" name="username" id="username" required />
          <span>Username</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="password" name="password" id="password" required />
          <span>Password</span>
          <i></i>
        </div>
        <div class="inputBox">
          <input type="password" name="con_password" id="con_password" required />
          <span>Konfirmasi Password</span>
          <i></i>
        </div>
        <div class="links">
          <a href="login.php">Login</a>
        </div>
        <button type="submit" name="regist">Signup</button>
      </form>
    </div>
  </body>
</html>
