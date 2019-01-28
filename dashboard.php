<?php 

require_once("header.php");

?>

<?php

// combien de livres dans book?

$objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
$prepare = $objectPdo->prepare('SELECT COUNT(*) FROM book');

$prepare->execute();

$count_books = $prepare->fetch();

// combien d'auteurs dans writters?

$objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
        
$prepare = $objectPdo->prepare('SELECT COUNT(*) FROM writter');
    
$prepare->execute();
    
$count_writters = $prepare->fetch();

// tous les livres du genres romans

$objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
        
$prepare = $objectPdo->prepare('SELECT title FROM book WHERE kind = "roman"');
    
$prepare->execute();
    
$romans = $prepare->fetchAll();

// tous les livres ecrit avant 1990

$objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
            
$prepare = $objectPdo->prepare(' SELECT title FROM book WHERE published_at <= "1990-01-01" ');
        
$prepare->execute();
        
$before90 = $prepare->fetchAll();

// tous les livres ecrit par J.K Rowling

$objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
// On récupère tous les résultats en tableau associatif
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

$prepare = $objectPdo->prepare('SELECT title
FROM book
INNER JOIN writer_write_book ON book.id = writer_write_book.book_id WHERE writer_write_book.writter_id = 2' );


$prepare->execute();
$jk_books = $prepare->fetchAll();





?>

<p> La table des livres contient <?= $count_books['COUNT(*)'] ?> livres </p>

<p> La table des auteurs contient <?= $count_writters['COUNT(*)'] ?> auteurs </p>

<h5>TOUS LES ROMANS</h5>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">titre</th>
    </tr>
  </thead>
  <tbody>
<?php

    

    foreach ($romans as $roman) {  ?>
    <tr>
      <td><?= $roman['title'] ?></td>
    </tr>
      <?php    
    }
?>
  </tbody>
</table>

<h5>TOUS LES ROMANS ECRIT AVANT 1990 </h5>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">titre</th>
    </tr>
  </thead>
  <tbody>
<?php

    

    foreach ($before90 as $roman) {  ?>
    <tr>
      <td><?= $roman['title'] ?></td>
    </tr>
      <?php    
    }
?>
  </tbody>
</table>

<h5>TOUS LES LIVRES ECRIT PAR J.K ROWLINGS </h5>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">titre</th>
    </tr>
  </thead>
  <tbody>
<?php

    

    foreach ($jk_books as $jk_book) {  ?>
    <tr>
      <td><?= $jk_book['title'] ?></td>
    </tr>
      <?php    
    }
?>
  </tbody>
</table>

<?php 

require_once("footer.php");

?>