<?php

session_start();
require("./Config/db.php");
require("./Class/Hero.php");
require("./Class/Archer.php");
require("./Class/Guerrier.php");
require("./Class/Mage.php");
require_once('./Class/FightsManager.php');
require_once('./Class/Monster.php');
require_once('./Class/HeroesManager.php'); 


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Street-Fighter</title>
 
</head>

<body>




 <img class = "titre" src = "./images/streetfighter.jpeg">
 

 <div class="card">
  <div class="card-body">
    <h3 id="Heading">Crée ton héros :</h3>
    <form method="post" id="container" action="">
      <div class="form-group">
        <label for="name"></label>
        <input type="text" class="form-control" name="name" placeholder="Nom" required>
      </div>
      <div class="form-group">
        <label for="personnage"></label>
        <select class="form-control" id="personnage" name="personnage">
        <option value="" disabled selected>Choisir un personnage</option>
          <option value="Guerrier">Guerrier 🧌</option>
          <option value="Archer">Archer 🧝</option>
          <option value="Mage">Mage 🧙 </option>
        </select>
      </div>
      <button class="input-button btn btn-dark btn-lg" type="submit" name="login" value="Login">Créer</button>
    </form>
  </div>
</div>




<?php

if(isset($_POST['name']) && isset($_POST['personnage'])) {

    // récupération du nom du héros et du personnage choisi : 
     $data = [
      'name' => $_POST['name'],
      'personnage' => $_POST['personnage']
     ];

      // création d'une instance de la classe correspondant au personnage choisi
  switch ($_POST['personnage']) {
    case 'archer':
      $hero = new Archer($data);
      break;
    case 'guerrier':
      $hero = new Guerrier($data);
      break;
    case 'mage':
      $hero = new Mage($data);
      break;
  }


     // création d'une instance de hero
    $hero = new Hero($data);

    // création d'une instance de heroesManager
    $heroesManager = new HeroesManager($db);
  
    // ajout du héros en utilisant la fonction add() de heroesManager
    $heroesManager->add($hero); 

    $heroes = $heroesManager->findAllAlive();

    
foreach ($heroes as $hero) 
{
echo "

<div class='row'>
      <div class='card text-bg-dark mb-3' style='max-width: 18rem;'>
            <div class='card-body2'>
            <img src='https://api.dicebear.com/5.x/adventurer/svg?seed=". $hero->getName()." ' style='width: 100px; height: 100px;'>
            <h5 class='card-title'>". $hero->getName()." </h5>
            <br>
                <p class='card-text'> Points de vie : ".$hero->getHealthPoint()." ❤️</p>
                <p class='card-text'>Grade : ".$hero->getPersonnage()."</p>
                <br>
                <p class='card-text'>⭐ Energie :<br><progress value=".$hero->getEnergy()." max='100'style='height: 20px;'></progress></p>
                
                <form action='fight.php' method='get'>
                    <input type='hidden' name='hero_id' value='". $hero->getId()."'>
                    <button type='submit' class='btn btn-light'>Choisir</button>
                </form>
            </div>
        </div>
</div>
";
}
}



?>

</body>



</html> 










