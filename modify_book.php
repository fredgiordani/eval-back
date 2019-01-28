<?php 

require_once("header.php");

?>

<?php

$errors = [];

if(isset($_POST) && !empty($_POST)){

$title = $_POST['title'];
$kind = $_POST['kind'];
$published_at = $_POST['published_at'];


if( $title === ""){
    $errors['title'] = "Ce champ ne peut pas être vide";
}

if( $kind === ""){
    $errors['kind'] = "Ce champ ne peut pas être vide";
}

if($published_at === ""){
    $errors['published_at'] = "Ce champ ne peut pas être vide";
}



if(empty($errors)){

if(isset($_POST) && !empty($_POST)){
    var_dump($_POST);

    $objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
    $prepare = $objectPdo->prepare('UPDATE book SET title = :title, kind = :kind, published_at = :published_at WHERE id = :book_id');
    $prepare->bindvalue(":title", $title, PDO::PARAM_STR);
    $prepare->bindvalue(":kind", $kind, PDO::PARAM_STR);
    $prepare->bindvalue(":published_at", $published_at, PDO::PARAM_STR);
    $prepare->bindvalue(":book_id", $_GET['book_id'], PDO::PARAM_INT);

    $execute = $prepare->execute();

    if($execute){
        $message = "livre modifié en bdd";
    }else{ $message= "erreur"; }
        }
    }
}

?>

<h3>modifier livre</h3>

<form action="" method="POST">
  
  <div class="form-group">
    <label for="title">titre du livre</label>
    <input type="text" class="form-control" name="title" id="title" >
  </div>
  <div class="container bg-danger">
    <?php if( isset($errors['title'])){
        echo $errors['title'];
    } ?>
  </div>

  <div class="form-group">
    <label for="kind">genre du livre</label>
    <input type="text" class="form-control" name="kind" id="kind" >
  </div>
  <div class="container bg-danger">
    <?php if( isset($errors['kind'])){
        echo $errors['kind'];
    } ?>
  </div>

  <div class="form-group">
    <label for="published_at">date de parution</label>
    <input type="text" class="form-control" name="published_at" id="published_at" >
  </div>
  <div class="container bg-danger">
    <?php if( isset($errors['published_at'])){
        echo $errors['published_at'];
    } ?>
  </div>


  <div class="container bg-danger">
    <?php if( isset($message)){
        echo $message;
    } ?>
  </div>
  
  <button type="submit" class="btn btn-primary">valider</button>
</form>


<?php 

require_once("footer.php");

?>