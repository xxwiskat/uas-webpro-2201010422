<?php 

  session_start();

  if( !isset($_SESSION['lolos']) ) {
    header('Location: login.php');
    exit;
  }

  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'tambah') {
    echo "<div></div>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script><link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'><script>Swal.fire('Tambah Data!','Data Movie Berhasil Di Tambahkan!','success')</script>";
  }

  if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'hapus') {
    echo "<div></div>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script><link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'><script>Swal.fire('Delete!','Data Berhasil Di Delete!','info')</script>";    
}

if(isset($_SESSION['alert']) && $_SESSION['alert'] == 'update') {
    echo "<div></div>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js'></script><link href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css' rel='stylesheet'><script>Swal.fire('Update!','Data Berhasil Di Update!','success')</script>";
}


  // VERSION RINGKAS

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
    <link rel="stylesheet" href="css/style_index.css" />

    <!-- link jQuery -->
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/scriptJQ.js"></script>
  </head>
  <body>
    <!-- navbar -->
    <header>
      <div class="brand">
        <a href="#">Free<span>MOVIE</span>W</a>
      </div>

      <div class="navbar">
        <ul>
          <li><a href="#" class="nav-link active">Kelola Film</a></li>
          <li><a href="home.php" class="nav-link">Home</a></li>
          <li><a href="logout.php" class="nav-link">Logout</a></li>
        </ul>
      </div>

      <div class="hamburger_menu">
        <i class="bx bx-menu menu"></i>
      </div>
    </header>

    <!-- main -->
    <main>
      <div class="title-main">
        <span>DATA KELOLA FILM</span>
      </div>
      <div class="body-main">
        <a href="add.php">
          <div class="main">
            <i class="ri-user-add-fill"></i>
            <span class="add-data">ADD DATA</span>
          </div>
        </a>
        <div class="main">
          <form action="" method="">
            <input
              type="text"
              name="keyword"
              placeholder="search..."
              autocomplete="off"
              id="keyword"
            />
            <button type="button" name="search" id="but-search">
              <i class="ri-search-2-line"></i>
            </button>
          </form>
        </div>
      </div>
      <div class="table-main">
        <table id="container">
          <thead>
            <tr>
              <th>No</th>
              <th>Poster</th>
              <th>Judul Film</th>
              <th>Kategori</th>
              <th>Trending</th>
              <th>Rating</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i= 1; ?>
            <?php foreach( $movies as $movie ) : ?>
              <tr class="content-table">
                <td><?= $i ?></td> 
                <td class="for-poster">
                  <div class="poster">
                    <img
                      src="img/<?php echo $movie['poster'] ?>"
                      alt=""
                    />
                  </div>
                </td>
                <td><?php echo $movie['judul_film'] ?></td>
                <td><?php echo $movie['kategori'] ?></td>
                <td><?php echo $movie['trending'] ?></td>
                <td><?php echo $movie['rating'] ?></td>
                <td class="for_action">
                  <a
                    href="edit.php?id=<?= $movie['id']; ?>"
                    class="btn btn-edit"
                    ><i class="ri-pencil-fill"></i
                  ></a>
                  <a
                    href="delete.php?id=<?= $movie['id']; ?>"
                    class="btn btn-del"
                    ><i class="ri-delete-bin-5-fill"></i
                  ></a>
                </td>
              </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>
  </body>
</html>
<?php 
    $_SESSION['alert'] = ' '; 
?>