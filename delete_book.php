<?php 

require_once("header.php");

?>

<?php

$objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);

    $prepare = $objectPdo->prepare('DELETE  FROM book
     WHERE id = :book_id' );

    $prepare->bindvalue(":book_id", $_GET["book_id"], PDO::PARAM_INT);

    $execute = $prepare->execute();

    if($execute){
        $message = "le livre a été supprimé en bdd";
    }else{
        $message = "erreur";
    }
?>

<div class="container bg-primary">
    <?php
        if(isset($message)){ 
            echo $message;
        }
    ?>
</div>

<?php 

require_once("footer.php");

?>