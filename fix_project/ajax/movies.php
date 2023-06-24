<?php 

require '../functions.php';

  // ambil value setiap ketikan pada input search
  $key= $_GET['keyword'];

  $movies= query("SELECT * FROM movies WHERE
                  judul_film LIKE '%$key%'
                ");

?>
<table>
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