<?php 
    // koneksikan ke databasenya -> mysqli_connect('hostName', 'username', 'password', 'nameDatabase');

    $db= mysqli_connect("localhost", "root", '', "movie");


    // buat function query

    function query($synq){

      global $db;

      $result= mysqli_query($db, $synq);
      
      $movies= [];
      while( $movie= mysqli_fetch_assoc($result) ){
        array_push($movies, $movie);
      }
      return $movies;
    }


    function add_movie_list($data){

      global $db;

      $judul_film= htmlspecialchars($data['judul_film']);
      $kategori= htmlspecialchars($data['kategori']);
      $trending= htmlspecialchars($data['trending']);
      $rating= htmlspecialchars($data['rating']);
      
      // upload image
      $poster= upload();

      if( !$poster ){
        return false;
      }

      $query = "INSERT INTO movies(
        poster, 
        judul_film, 
        kategori, 
        trending, 
        rating
        )
        VALUES(
        '$poster', 
        '$judul_film', 
        '$kategori', 
        '$trending', 
        '$rating'
        )";

      mysqli_query($db, $query);

      return mysqli_affected_rows($db);
    }


    function upload(){
      
      // ambil data dalam poster masukkan kedalam variable

      $pic_name= $_FILES['poster']['name'];
      $size_pic= $_FILES['poster']['size'];
      $error_pic= $_FILES['poster']['error'];
      $tmp_pic= $_FILES['poster']['tmp_name'];

      // cek apakah gambar sudah diupload atau belum
      if( $error_pic === 4 ){
        echo "<script>
                alert('Masukkan gambar terlebih dahulu');
              </script>";

        return false;
      }


      // cek apakah yang diupload file gambar atau file yang lain
      $ekstension_pic_valid= ['jpg', 'jpeg', 'png'];
      $ekstension_pic_user= explode('.', $pic_name);

      $ekstension_pic_user= strtolower(end($ekstension_pic_user));

      if( !in_array($ekstension_pic_user, $ekstension_pic_valid) ){
        echo "<script>
                alert('yang anda masukkan bukan gambar!');
              </script>";
      }


      // cek jika gambar yang diupload terlalu besar
      if( $size_pic > 2000000 ){
        echo "<script>
                alert('size gambar terlalu besar!')
              </script>";
      }


      // membuat nama picture baru, agar menghindari nama picture yang sama antar user
      $pic_name_new= uniqid();
      $pic_name_new .= '.';
      $pic_name_new .= $ekstension_pic_user;


      // pindahkan gambar ke folder yang sudah disiapkan / tempat yang dituju
      move_uploaded_file( $tmp_pic, 'img/' . $pic_name_new );

      return $pic_name_new;

    }

    function delete($data){

      global $db;

      mysqli_query($db, "DELETE FROM movies WHERE id= $data");

      return mysqli_affected_rows($db);

    }


    function change($data){
      global $db;

      $id= $data['id'];
      $judul_film= htmlspecialchars($data['judul_film']);
      $kategori= htmlspecialchars($data['kategori']);
      $trending= htmlspecialchars($data['trending']);
      $rating= htmlspecialchars($data['rating']);
      $poster_lama= htmlspecialchars($data['poster_lama']);


      // jika user tidak mengganti gambar / menggunakan gambar lama
      if( $_FILES['poster']['error'] === 4 ){
        $poster= $poster_lama;
      }else{
        $poster= upload();
      }

      $query= "UPDATE movies SET
                judul_film= '$judul_film',
                kategori= '$kategori',
                trending= '$trending',
                rating= '$rating',
                poster= '$poster'
              WHERE id= $id
              ";

      mysqli_query($db, $query);

      return mysqli_affected_rows($db);
    }


    function search($key){

      $new_query= "SELECT * FROM movies WHERE
                    judul_film LIKE '%$key%'
                  ";

      return query($new_query);

    }


    function registration($data){

      global $db;

      // masukkan value dari form kedalam variable
      $username= strtolower(stripslashes($data['username']));
      $password= mysqli_real_escape_string($db, $data['password']);
      $con_password= mysqli_real_escape_string($db, $data['con_password']);

      if( $password !== $con_password ){
        echo "<script>
                alert('konfirmasi password anda salah!');
              </script>";
        return false;
      }


      // cek apakah username sudah pernah dibuat atau belum
      $result= mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");

      if( mysqli_fetch_assoc($result) ){
        echo "<script>
                alert('username sudah pernah dibuat');
              </script>";
        return false;
      }


      // enkripsi password
      $password= password_hash($password, PASSWORD_DEFAULT);

      // masukkan ke dalam database
      mysqli_query($db, "INSERT INTO user VALUES ('', '$username', '$password')");

      return mysqli_affected_rows($db);
    }

?>