<?php 

require_once("header.php");

?>

<?php

$errors = [];

if(isset($_POST) && !empty($_POST)){

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$birthday = $_POST['birthday'];


if( $lastname === ""){
    $errors['lastname'] = "Ce champ ne peut pas être vide";
}

if( $firstname === ""){
    $errors['firstname'] = "Ce champ ne peut pas être vide";
}

if($birthday === ""){
    $errors['birthday'] = "Ce champ ne peut pas être vide";
}



if(empty($errors)){

if(isset($_POST) && !empty($_POST)){
    var_dump($_POST);

    $objectPdo = new PDO("mysql:host=localhost;dbname=library","root","",[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
    // On récupère tous les résultats en tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,]);
    
    $prepare = $objectPdo->prepare('INSERT INTO writter VALUES(NULL, :lastname, :firstname, :birthday)');
    $prepare->bindvalue(":lastname", $lastname, PDO::PARAM_STR);
    $prepare->bindvalue(":firstname", $firstname, PDO::PARAM_STR);
    $prepare->bindvalue(":birthday", $birthday, PDO::PARAM_STR);

    $execute = $prepare->execute();

    if($execute){
        $message = "auteur ajouté en bdd";
    }else{ $message= "erreur"; }
        }
    }
}

?>

<form action="" method="POST">
  
  <div class="form-group">
    <label for="lastname">Nom</label>
    <input type="text" class="form-control" name="lastname" id="lastname" >
  </div>
  <div class="container bg-danger">
    <?php if( isset($errors['lastname'])){
        echo $errors['lastname'];
    } ?>
  </div>

  <div class="form-group">
    <label for="firstname">Prenom</label>
    <input type="text" class="form-control" name="firstname" id="firstname" >
  </div>
  <div class="container bg-danger">
    <?php if( isset($errors['firstname'])){
        echo $errors['firstname'];
    } ?>
  </div>

  <div class="form-group">
    <label for="birthday">date de naissance</label>
    <input type="text" class="form-control" name="birthday" id="birthday" >
  </div>
  <div class="container bg-danger">
    <?php if( isset($errors['birthday'])){
        echo $errors['birthday'];
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