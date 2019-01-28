<?php

    require_once("header.php")

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

    $objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
    $prepare = $objectPdo->prepare('SELECT * FROM writter' );
        
    $prepare->execute();
    
    $writers = $prepare->fetchAll();


    if(isset($_POST) && !empty($_POST)){
        
        var_dump($_POST);

        $objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
        // On récupère tous les résultats en tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
            
        $prepare = $objectPdo->prepare('INSERT INTO writer_write_book VALUES(:book_id, :writer_id)');
        
        $prepare->bindvalue(":book_id", $_POST["book"], PDO::PARAM_INT);
        $prepare->bindvalue(":writer_id", $_POST["writer"], PDO::PARAM_INT);
            
        $execute = $prepare->execute();

        if($execute){
            $message = "livre relié à l'auteur";
        }else{ 
            $message= "erreur";
        }
    }
?>
    <form action="" method="POST">

    <select name="book" class="form-control w-25">

        <option value="default">livres</option>
     <?php

        foreach ($books as $book) { ?>

            <option value=<?= $book["id"] ?>><?= $book["title"] ?></option>

        <?php
        }

     ?>
    </select>

    <select name="writer" class="form-control w-25">

        <option value="default">auteurs</option>
     <?php

        foreach ($writers as $writer) { ?>

            <option value=<?= $writer["id"] ?>><?= $writer["firstname"]." ".$writer["lastname"] ?></option>

        <?php
        }

     ?>
    </select>

    <div class="container bg-primary">
        <?php
            if(isset($message)){
                echo $message;
            }
        ?>
    </div>

    <button class="btn-primary">valider</button>

</form>
    

<?php

    require_once("header.php")

?>