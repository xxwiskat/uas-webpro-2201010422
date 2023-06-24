<?php 

session_start();

if( !isset($_SESSION['lolos']) ) {
  header('Location: login.php');
  exit;
}

  require'functions.php';

  if( isset($_POST['send']) ) :

    if( add_movie_list($_POST) > 0 ){
      $_SESSION['alert'] = 'tambah';
      
      header("Location: index.php");
      exit;
    }else{
      echo "
      <script>
        alert('Data Gagal Ditambahkan');
      </script>
      ";
    }
  endif;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DASHBOARD | ADD DATA MOVIE</title>

    <!-- link font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
      rel="stylesheet"
    />

    <!-- link icon -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <!-- link css -->
    <link rel="stylesheet" href="css/style_add.css" />

  </head>
  <body>
    <!-- Navbar -->
    <nav>
      <div class="brand">
        <span
          ><a href=""
            ><span style="color: darkred">Free</span>MOVIE<span
              style="color: darkred"
              >W</span
            ></a
          ></span
        >
      </div>
      <div class="navbar">
        <ul>
          <li>
            <a href="index.php" class="selected-navbar bar-bottom"
              >Kelola Film</a
            >
          </li>
          <li><a href="home.php">Home</a></li>
        </ul>
      </div>
    </nav>

    <!-- main -->
    <main>
      <div class="title-main">
        <span>ADD DATA FILM</span>
      </div>

      <div class="body-main">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="special">
            <span>Poster Film:</span>
            <input type="file" name="poster" id="poster" required="required" />
          </div>
          <div class="form-input">
            <input type="text" name="judul_film" id="judul_film" required="required" />
            <span>Judul Film</span>
          </div>
          <div class="form-input select-input">
            <div class="testing">
              <select name="kategori" id="kategori">
                <option selected hidden>Kategori Film:</option>
                <option value="New">New</option>
                <option value="Old">Old</option>
              </select>
              <div class="icon-select">
                <i class="ri-arrow-down-s-fill"></i>
              </div>
            </div>
          </div>
          <div class="form-input select-input">
            <select name="trending" id="trending">
              <option selected hidden>Trending ?</option>
              <option value="Ya">Ya</option>
              <option value="Tidak">Tidak</option>
            </select>
            <div class="icon-select">
              <i class="ri-arrow-down-s-fill"></i>
            </div>
          </div>
          <div class="form-input">
            <input type="number" name="rating" id="rating" required="required" />
            <span>Rating Film (1 - 10)</span>
          </div>
          <div class="form-input">
            <a href="index.php">CANCEL</a>
            <button type="submit" name="send">ADD DATA</button>
          </div>
        </form>
      </div>
    </main>
  </body>
</html>
