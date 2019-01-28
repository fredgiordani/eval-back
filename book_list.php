<?php 

require_once("header.php");

?>

<?php

    $objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('SELECT * FROM book' );
    
    $prepare->execute();

    $books = $prepare->fetchAll();

    // var_dump($books);
?>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">titre</th>
      <th scope="col">genre</th>
      <th scope="col">publication</th>
      <th scope="col">actions</th>
    </tr>
  </thead>
  <tbody>
<?php

    

    foreach ($books as $book) {  ?>
    <tr>
      <th scope="row"><?= $book["id"] ?></th>
      <td><?= $book['title'] ?></td>
      <td><?= $book['kind'] ?></td>
      <td><?= $book['published_at'] ?></td>
      <td>
        <div>
          <a href="modify_book.php?book_id=<?= $book['id'] ?>">modifier livre</a>
        </div>
        <div>
        <a href="delete_book.php?book_id=<?= $book['id'] ?>">supprimer livre</a>
        </div>
      </td>
      

    </tr>
      <?php    
    }
?>
  </tbody>
</table>



<?php 

require_once("header.php");

?>