<?php 

require 'functions.php';

$movies= query('SELECT * FROM movies');

// apakah tombol search sudah diklik atau belum
if( isset($_POST['search']) ){
  $movies= search($_POST['keyword']);
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MovieW</title>

    <!-- icon -->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />

    <!-- fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;300;400;700&family=Poppins:wght@200;400;900&display=swap"
      rel="stylesheet"
    />

    <!-- css -->
    <link rel="stylesheet" href="css/style_home.css" />

  </head>
  <body>
    <!-- navbar -->
    <header>
      <div class="brand">
        <a href="#">Free<span>MOVIE</span>W</a>
      </div>

      <div class="navbar">
        <ul>
          <li><a href="#" class="nav-link active">Home</a></li>
          <li><a href="index.php" class="nav-link">Admin</a></li>
        </ul>
      </div>

      <div class="main">
        <i class="bx bx-menu menu"></i>
      </div>
    </header>

    <!-- slider -->
    <section class="carousell">
      <div class="title-carousell">
        <h1>Movie Trending</h1>
      </div>
      <div class="slider">
        <div class="slide-track">
          <?php foreach( $movies as $movie ) : ?>
            <?php if( $movie['trending'] == 'Ya' ) : ?>
              <!-- 9 slide img -->
              <div class="slide">
                <img src="img/<?php echo $movie['poster'] ?>" alt="" />
              </div>
            <?php endif ?>
          <?php endforeach ?>

          <!-- same 9 slide(DOUBLE) -->
          <?php foreach( $movies as $movie ) : ?>
            <?php if( $movie['trending'] == 'Ya' ) : ?>
              <!-- 9 slide img -->
              <div class="slide">
                <img src="img/<?php echo $movie['poster'] ?>" alt="" />
              </div>
            <?php endif ?>
          <?php endforeach ?>

        </div>
      </div>
    </section>

    <!-- items movies -->
    <section class="items">
      <div class="head-items">
        <div class="title-head">
          <h1>Movie Featured</h1>
        </div>
      </div>
      <div class="main-items">
        <?php foreach( $movies as $movie ) : ?>
          <div class="cover-item">
            <div class="item">
              <a href="">
                <div class="content-item">
                  <img src="img/<?php echo $movie['poster'] ?>" alt="" />
                  <div class="description-item">
                    <i class="ri-play-circle-line play"></i>
                    <span class="rating"><i class="ri-star-fill"></i><?php echo $movie['rating'] ?></span>
                  </div>
                  <span class="feature"><?php echo $movie['kategori'] ?></span>
                </div>
              </a>
            </div>
            <div class="movie-title">
              <a href=""><?php echo $movie['judul_film'] ?></a>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </section>

    <!-- footer -->
    <footer>
      <div class="description-footer">
        <h1>Free<span>MOVIE</span>W</h1>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus
          adipisci facere commodi! Explicabo aliquid repellat temporibus cum
          similique blanditiis sed libero sapiente id ipsum aut, fuga vitae
          laboriosam dignissimos in molestiae veritatis totam amet aperiam
          consequuntur at quasi? Provident maxime aspernatur quia dolore
          voluptatibus facere rem tempora optio voluptatem quis.
        </p>
      </div>
      <div class="category-movie">
        <div class="ori-ser">
          <span>Original Series</span>
          <a href="">Apple TV+</a>
          <a href="">Amazon</a>
          <a href="">Disney+</a>
          <a href="">HBO</a>
          <a href="">Netflix</a>
          <a href="">The CW</a>
        </div>
        <div class="category">
          <span>Category</span>
          <a href="">Action</a>
          <a href="">ADventure</a>
          <a href="">Anime</a>
          <a href="">Animation</a>
          <a href="">Comedy</a>
          <a href="">Drama</a>
          <a href="">Horror</a>
          <a href="">Sci-Fi</a>
        </div>
        <div class="free-mov">
          <span>IDLIX</span>
          <a href="">DCEU Movie</a>
          <a href="">MCU Movie</a>
          <a href="">Disney+ Movie and Series</a>
          <a href="">Netflix Movie and Series</a>
          <a href="">Marvel Studio Series</a>
          <a href="">Coming Soon</a>
          <a href="">LK21</a>
          <a href="">Rebahin</a>
        </div>
      </div>
    </footer>

    <script src="js/script.js"></script>
  </body>
</html>