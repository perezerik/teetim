<?php
  //Énumérer ke contenu d'un dossier
  //$contenu = scandir('i18n');
  //print_r($contenu)

  //Créeer un tableau des codes de langues disponibles
  $langueDispo = [];
  //Remplir le tableau avec les codes obtenus des noms des fichiers JSON
  //présents dans ke dossier i18n
  $contenuI18n = scandir('i18n');
  // Solution 1: avec une boucle standard (avec compteur)
  //donc du code dit "impératif" (moins souhaitable)
  // for($i=0; $i<count($contenuI18n); $i++){
  //   $fichier = $contenuI18n[$i];
  //   //Si le fichier n'est pas '.' et n'est pas '..'
  //   if($fichier != '.' && $fichier != '..'){
  //     $langueDispo[]= substr($fichier , 0, 2). "<br>";
  //   }
  // }

  //Solution 2: avec une boucle "itérable" (sans compteur)
  //Donc du code dit "expressif" ou "déclaratif" (plus souhaitable)
  //(En JS cette boucle est similaire a for...of)
  foreach($contenuI18n as $nomFichier) {
    //Pas une bonne stratégie : il faut filtrer 
    //Tout ce qui ne ressemble pas à 'll.json' (où 'll' sont deux lettres )
    // Une solution possible serait d'utiliser les expressions régulières (RegExp)
    if($nomFichier != '.' && $nomFichier != '..'){
      $langueDispo[] = substr($nomFichier, 0, 2);
    }
  }

  //1. Langue par défaut
  $langue = "fr";

  //2. Langue mémorisée dans un témoi HTTMP (s'il existe !!!)
  //ATTENTION : code susceptible d'injection !!!
  //Programmez défensivement !!!
  //Ne faites pas cofnaince à ce qui vient de l'utilisateur
  if(isset($_COOKIE['choixLangue']) && in_array($_COOKIE['choixLangue'], $langueDispo)){
    $langue = $_COOKIE['choixLangue'];
  }

  //3. Langue spécifiéé dans l'url (ca veut dire que l'utilisateur a cliquer un
  //des boutons de choix de langue)
  //ATTENTION: programmez défensivement !!!
  //NE JAMAIS faire confiance aux valeurs qui viennet du UI (utilisateur)
  if(isset($_GET['lan']) && in_array($_GET['lan'], $langueDispo)){
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
<html lang="<?= $langue ?>" dir="ltr">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;900&family=Noto+Serif:ital,wght@0,400;0,900;1,400&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $_->metaTitre ?></title>
  <meta name="description" content="<?= $_->metaDesc ?>">
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
        <?php  foreach($langueDispo as $codeLangue) : ?>
          <a 
            class="<?= $langue==$codeLangue ? 'actif' : '' ?>" 
            href="?lan=<?= $codeLangue ?>"
            title = "العربية"
            >
            <?= $codeLangue ?>
          </a>
        <?php  endforeach ?>
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
        <a href="teeshirts.php" class="<?= $page=='teeshirts' ? 'actif' : '' ; ?>"> <?= $_ent->menuTeeshirts; ?></a>
        <a href="casquettes.php"><?= $_ent->menuCasquettes; ?></a>
        <a href="hoodies.php" class=""> <?= $_ent->menuHoodies; ?></a>
        <span class="separateur"></span>
        <a href="aide.php"> <?= $_ent->menuAide; ?></a>
        <a href="apropos.php"> <?= $_ent->menuNous; ?></a>
      </nav>
    </header>