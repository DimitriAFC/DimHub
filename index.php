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
            <h2 class="bouton_accueil">Connexion</h2>
         </div>
         <div class="container">
            <div class="form">
               <form>
                  <label for="username">Username :</label>
                  <input type="text" id="username"  required>
                  <label for="motdepasse">Mot de passe : </label>
                  <input type="password" id="motdepasse"  required>
                  <p>
                     <input class="bouton_envoyer" type="submit" value="Envoyer">
                  </p>
               </form>
            </div>
         </div>
         <div class="container">
            <div class="informations">
               <a href="inscriptions.php">S'inscrire </a>
               <a href="mdpforget.php">Mot de passe oublié </a>
            </div>
         </div>
      </main>
      <?php require('include/footer.php')?>
   </body>
</html>