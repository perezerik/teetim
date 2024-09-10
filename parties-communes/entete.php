<?php
  //Énumérer ke contenu d'un dossier
  //$contenu = scandir('i18n');
  //print_r($contenu);

  //Créeer un tableau des codes de langues disponibles
  $langueDispo = [];
  //Remplir le tableau avec les codes obtenus des noms des fichiers JSON
  //présents dans ke dossier i18n
  $contenuI18n = scandir('i18n');
  
  for($i=0; $i<count($contenuI18n); $i++){
    $fichier = $contenuI18n[$i];
    //Si le fichier n'est pas '.' et n'est pas '..'
    if($fichier != '.' && $fichier != '..'){
      $langueDispo[]= substr($fichier , 0, 2). "<br>";
    }
  }

  //1. Langue par défaut
  $langue = "fr";

  //2. Langue mémorisée dans un témoi HTTMP (s'il existe !!!)
  if(isset($_COOKIE['choixLangue'])){
    $langue = $_COOKIE['choixLangue'];
  }

  //3. Langue spécifiéé dans l'url (ca veut dire que l'utilisateur a cliquer un
  //des boutons de choix de langue)
  if(isset($_GET['lan'])){
    $langue = $_GET['lan'];
    
    //Mémoriser ce choix de langue 
    //DONC: stocker la valeur du code de langue dans un témoin HTTP (cookies)
    setcookie('choixLangue', $langue, time()+30*24*3600);
  }

  // A) Lire le fichier JSOON contenant les textes
  // Étape 1 : lire le fichif "i18n/fr.json"
  // et affecter son conteunu a une varaible PHP
  $textesJSON = file_get_contents("i18n/" . $langue . ".json");

  // Étape 2 : convertir le contenu du fichier en variables PHP
  // pour remettre les textes dans la page Web aux bons endroits
  $textes = json_decode($textesJSON);

  //Raccourcis pour les parties communes
  $_ent = $textes->entete;
  $_pp = $textes->pp;

  //Raccourcis pour les pages spécifiques
  $_ = $textes->$page;
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
        <!-- Générer un 'bouton (lien HTML) pour chaque code de langue dans 
         le tableau linguistique  -->
         <!-- Début boucle -->
        <a 
          class="<?php  if($langue=='fr'){echo 'actif';} ?>" 
          href="?lan=fr">
          fr
        </a>

        <!-- Fin boucle -->
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