<?php 

  session_start();
  require 'functions.php';

  // cek cookie 2
  if( isset($_COOKIE['id']) && isset($_COOKIE['username']) ){

    $id= $_COOKIE['id'];
    $username= $_COOKIE['username'];


    // ambil username berdasarkan id
    $result= mysqli_query($db, "SELECT username FROM user WHERE id = '$id'");
    $row= mysqli_fetch_assoc($result);


    // cek username cookie dengan username database
    if( $username === hash('sha256', $row['username']) ){
      $_SESSION['lolos']= true;
    }

  }

  if( isset($_SESSION['lolos']) ){
    header('Location: index.php');
    exit;
  }


  if( isset($_POST['login']) ){
    
    // masukkan data inputan user kedalam variable
    $username= $_POST['username'];
    $password= $_POST['password'];

    
    
    // cek apakah username yang diinput sama dengan yang ada di database
    $result= mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
    
    if( mysqli_num_rows($result) === 1 ){
      
      // cek password
      $row= mysqli_fetch_assoc($result);
      if( password_verify($password, $row['password']) ){

        // set session
        $_SESSION['lolos']= true;

        header('Location: index.php');
        exit;
      }else{
        $error_pass= true;
      }
    }else{
      $error_user= true;
    }

  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <link rel="stylesheet" href="css/style_login.css" />
  </head>
  <body>
    <div class="box">
      <span class="borderLine"></span>
      <form action="" method="post" autocomplete="off">
        <h2>LOGIN</h2>
        <?php if( isset($error_user) ) : ?>
          <script>alert('Username Anda Salah!');</script>
        <?php elseif( isset($error_pass) ) : ?>
          <script>alert('Password Anda Salah!');</script>
        <?php endif; ?>

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
        <div class="links">
          <a href="signup.php">SignUp</a>
        </div>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
  </body>
</html>
