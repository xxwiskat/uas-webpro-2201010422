<?php
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_NAME = 'movie';
    $mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS);

    if($mysqli->connect_error){
        die("Koneksi Gagal: " . $mysqli->connect_error);
    };

    // Membuat DATABASE
    $sql = "CREATE DATABASE IF NOT EXISTS movie";
    if(mysqli_query($mysqli, $sql)){
        echo "<h3>Database Berhasil Dibuat!</h3>";
    } 
    else{
        echo "<h3>Database Gagal Dibuat!</h3>".mysqli_error($mysqli);
    };


    // Mengkoneksikan Database Yang Berhasil Dibuat!
    mysqli_select_db($mysqli, "movie");

    // Membuat Tabel
    $sql = "CREATE TABLE IF NOT EXISTS movies(
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        poster VARCHAR(255),
        judul_film VARCHAR(255),
        kategori ENUM('Old', 'New'),
        trending ENUM('Ya', 'Tidak'),
        rating int(11)
    )";
    $sql2 = "CREATE TABLE IF NOT EXISTS user(
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        username VARCHAR(255),
        password VARCHAR(255)
    )";

    if (mysqli_query($mysqli, $sql) AND mysqli_query($mysqli, $sql2)) {
        echo "<h3>Tabel Berhasil Dibuat!</h3>";
    }
    else{
        echo "<h3>Tabel Gagal Dibuat!</h3>" . mysqli_error($mysqli);
    };
    
    $add= "INSERT INTO movies( poster, judul_film, kategori, trending, rating )
    VALUES
        ('dotn.jpg', 'Death On The Nile', 'Old', 'Ya', 8),
        ('rata.jpg', 'Ratatouille', 'Old', 'Ya', 9),
        ('f9.jpg', 'F9', 'New', 'Ya', 8),
        ('hunger.jpg', 'Hunger Games', 'Old', 'Ya', 8),
        ('home.jpg', 'Home Alone', 'Old', 'Ya', 9),
        ('aqua.jpg', 'Aquaman', 'New', 'Ya', 8),
        ('avatar.jpg', 'Avatar', 'New', 'Ya', 9),
        ('jumanji.jpg', 'Jumanji', 'New', 'Ya', 8),
        ('dead.jpg', 'Deadpool', 'Old', 'Ya', 8)
    ";

    if(mysqli_query($mysqli, $add)){
        echo "<h3>Data Berhasil Dibuat!</h3>";
    }
    else{
        echo "<h3>Tabel Gagal Dibuat!</h3>" . mysqli_error($mysqli);
    };


    // Menutup Koneksi Ke MYSQL
    mysqli_close($mysqli);
?>