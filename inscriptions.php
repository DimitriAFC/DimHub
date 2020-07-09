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
      <?php require('include/header.php');?>
      <main id="connexion">
         <div class="container">
            <h2 class="bouton_page"><a href="index.php">Revenir à l'accueil</a></h2>
         </div>
         <div class="container">
            <div class="form">
               <?php require('include/database.php');?>
               <form  method="post">
                  <label for="nom">Nom :</label>
                  <input type="text" id="nom" name="nom"  required>
                  <label for="Premon">Prenom :</label>
                  <input type="text" id="Prenom" name="prenom"  required>
                  <label for="username">Username :</label>
                  <input type="text" id="username" name="username"  required>
                  <label for="mdp">Mot de passe : </label>
                  <input type="password" id="mdp" name="mdp" required>
                  <label for="mdp2">Comfirmer le Mot de passe : </label>
                  <input type="password" id="mdp2" name="mdp2" required>
                  <label for="choix_question">Choisissez une question secrète:</label>
                  <input type="text" id="question" name="questionSelect"  required>
                  <label for="reponse">Votre réponse : </label>
                  <input type="text" id="reponse"  name="reponse"required>
                  <p>
                  </p>
                  <p>
                     <input class="bouton_enregistrer" type="submit" value="Enregistrer" name="valideForm">
                  </p>
               </form>
            </div>
         </div>
      </main>
      <?php require('include/footer.php');?>
   </body>
</html>