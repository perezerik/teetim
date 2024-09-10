<?php
  //Test: le "timestamp" de maintenant
  //echo time();

  //setcookie('patati', 'patata', time() +700*24*3600);
  //Test: la "jarre de cookies" envoyée par le "browser"
  //print_r($_COOKIE);

  //Déterminer le choix de langue de L'utilisateur
  //print_r($_GET);
  //1. Langue par défaut
  $langue = "fr";

  //2. Langue mémorisée dans un témoi HTTMP (s'il existe !!!)
  /*if(){
    $langue = 
  }*/

  //3. Langue spécifiéé dans l'url
  //Ca veut dire quel'utilisateur a cliquer
  //boutons de choix de langue)
  if(isset($_GET['lan'])){
    $langue = $_GET['lan'];
    
    //Mémoriser ce choix de langue 
    //DONC: stocker la valeur du code de langue dans un témoin HTTP (cookies)
    setcookie('choixLangue', $langue, time()+30*24*3600);
    //setcookie('unAutreTest','dasdsadsadsadasssssssssssssssssssss', time()+10);
    //setcookie('patati','', time()-1);
  }

  // A) Lire le fichier JSOON contenant les textes
  // Étape 1 : lire le fichif "i18n/fr.json"
  // et affecter son conteunu a une varaible PHP
  $textesJSON = file_get_contents("i18n/" . $langue . ".json");
  // Test: 
  // echo $textes;

  // Étape 2 : convertir le contenu du fichier en variables PHP
  // pour remettre les textes dans la page Web aux bons endroits
  $textes = json_decode($textesJSON);

  //Raccourcis pour les parties communes
  $_ent = $textes->entete;
  $_pp = $textes->pp;

  //Raccourcis pour les pages spécifiques
  $_ = $textes->$page;

  // Test
  // print_r($textesConvertis);
  // Imprimer la propriété altLogo de l'objet correspondant à la propriété
  // entete de cet objet: 
  // echo $textesConvertis->entete->altLogo;
  // echo $textesConvertis->entete->placeholderRecherhe;
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;900&family=Noto+Serif:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>teeTIM // fibre naturelle ... conception artificielle</title>
  <meta name="description" content="Page d'accueil du concepteur de vêtements 100% fait au Québec, conçus par les étudiants du TIM à l'aide de designs produits par intelligence artificielle, et fabriqués avec des fibres 100% naturelles et biologiques.">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="icon" type="image/png" href="images/favicon.png" />
</head>

<body>
  <div class="conteneur">
    <header>
      <nav class="barre-haut">
        <a href="?lan=en">en</a>
        <a class="actif" href="?lan=fr">fr</a>
      </nav>
      <nav class="barre-logo">
        <label for="cc-btn-responsive" class="material-icons burger">menu</label>
        <a class="logo" href="index.php"><img src="images/logo.png" alt="<?php  echo $_ent->altLogo; ?>"></a>
        <a class="material-icons panier" href="panier.php">shopping_cart</a>
        <input class="recherche" type="search" name="motscles" placeholder="<?php  echo $_ent->placeholderRecherhe; ?>">
      </nav>
      <input type="checkbox" id="cc-btn-responsive">
      <nav class="principale">
        <label for="cc-btn-responsive" class="menu-controle material-icons">close</label>
        <a href="teeshirts.php" class="<?php  if($page=='teeshirts') { echo 'actif';} ?>"> <?= $_ent->menuTeeshirts; ?></a>
        <a href="casquettes.php"><?= $_ent->menuCasquettes; ?></a>
        <a href="hoodies.php" class=""> <?= $_ent->menuHoodies; ?></a>
        <span class="separateur"></span>
        <a href="aide.php"> <?= $_ent->menuAide; ?></a>
        <a href="apropos.php"> <?= $_ent->menuNous; ?></a>
      </nav>
    </header>