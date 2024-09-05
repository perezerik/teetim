<?php
  // test
  // A) Lire le fichier JSOON contenant les textes
  // Étape 1 : lire le fichif "i18n/fr.json"
  // et affecter son conteunu a une varaible PHP
  $textesJSON = file_get_contents("i18n/fr.json");
  // Test: 
  // echo $textes;

  // Étape 2 : convertir le contenu du fichier en variables PHP
  // pour remettre les textes dans la page Web aux bons endroits
  $textes = json_decode($textesJSON);

  $_ent = $textes->entete;
  $_pp = $textes->pp;

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
        <a href="#">en</a>
        <a href="#">es</a>
        <a class="actif" href="#">fr</a>
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