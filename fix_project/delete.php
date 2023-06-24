<?php 

session_start();

if( !isset($_SESSION['lolos']) ) {
  header('Location: login.php');
  exit;
}

  require 'functions.php';

  $id= $_GET['id'];

  if( delete($id) > 0 ){
    $_SESSION['alert'] = 'hapus';

    header("Location: index.php");
    exit;
  }else{
    echo "
      <script>
        alert('Data GAGAL dihapus');
      </script>
    ";
  };

?>