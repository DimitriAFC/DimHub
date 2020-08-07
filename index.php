      <?php require('include/database.php')?>
      <?php
         // 1 On verifie que le formulaire est valide
         if(isset($_POST['connectForm']))
         {
               $usernameConnect = htmlspecialchars($_POST['usernameConnect']);
               $passwordConnect = password_hash($_POST['passwordConnect'], PASSWORD_DEFAULT);
            //2 On verifie que les champs ne sont pas vide
         if(!empty($_POST['usernameConnect']) AND !empty($_POST['passwordConnect']))
            {
               //3  On verifie que l'utilisateur et le mot de passe entré existent
         
               // On séléctionne tout dans la table utilisateur dans le champs username
               $requser = $bdd -> prepare('SELECT * FROM utilisateurs WHERE username = ?');
               // La requete va chercher l'username indiqué dans la base de donnés voir si il existe
               $requser -> execute(array($_POST['usernameConnect']));
               //On lance la recherche
               $user = $requser->fetch();
         
               //4 Si l'utilisateur existe alors on compare l'username entré avec le mot de passe enregistré dans la BDD
         if($user AND password_verify($_POST['passwordConnect'], $user['password']))
               {
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['mdp'] = $user['mdp'];
                    $_SESSION['question'] = $user['question'];
                    $_SESSION['reponse'] = $user['reponse'];
                    // A changer avec la page profil.php
                     header("Location:partenaires.php");
                     exit;
                  }
                  
         //3
         else 
         {
               $msgErreur = "<span style='color:red; font-weight:bold;'>Verifier vos identifiants !</span> " ;
            }
            }
         //2
         else
            {
               $msgErreur = "<span style='color:red; font-weight:bold;'>Merci de complêter les champs !</span> " ;
            }
         }
         // 1
         else 
         {
            echo '';
         }
         
         
         ?>
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
               <form method="post">
                  <label for="usernameConnect">Username :</label>
                  <input type="text" id="usernameConnect"  name="usernameConnect" required>
                  <label for="passwordConnect">Mot de passe : </label>
                  <input type="password" id="passwordConnect"  name="passwordConnect" required>

                    <?php if(isset($_GET['success'])){ ?>


                  <p class="msg"><?= $_GET['message']?></p>

                  <p><?php } ?></p>
                  
                  <p><?php if(isset($msgErreur)) { echo  $msgErreur; }  else { echo "";}?></p>


                  <p>
                     <input class="bouton_envoyer" type="submit" name ="connectForm" value="Envoyer">
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