<!doctype html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <link type="text/css" rel="stylesheet" href="css/hcstyles.css" />
      <link type="text/css" rel="stylesheet" href="css/hcstylesmobiles.css" />
      <meta name=viewport content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <title>Projet 3</title>
   </head>
   <body>
      <?php require('include/header.php')?>
      <main id="connexion">
         <div class="container">
            <h2 class="bouton_page"><a href="index.php">Revenir à l'accueil</a></h2>
         </div>
         <div class="container">
            <div class="form">
               <form>
                  <label for="username">Renseigner votre Username :</label>
                  <input type="text" id="username"  required>
               </form>
               <input class="bouton_renvoyer" type="submit" value="Valider">
            </div>
         </div>
      </main>
      <?php require('include/footer.php')?>
   </body>
</html>
