<?php require ('include/database.php'); ?>
<?php
  // 1 Vérification du formulaire
 if (isset($_POST['valideForm']) and $_POST['valideForm'])
 {
      // 2 Si formulaire vérifier on vérifie que les champs ne sont pas vides
 if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['username']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']) and !empty($_POST['questionSelect']) and !empty($_POST['reponse']))
   {
          // 3 Si les champs ne sont pas vide, on nomme les variables
          $nom = htmlspecialchars($_POST['nom']);
          $prenom = htmlspecialchars($_POST['prenom']);
          $username = htmlspecialchars($_POST['username']);
          $mdp = htmlspecialchars($_POST['mdp']);
          $mdp2 = htmlspecialchars($_POST['mdp2']);
          $questionSelect = htmlspecialchars($_POST['questionSelect']);
          $reponse = password_hash($_POST['reponse'], PASSWORD_DEFAULT);
  
          // 3 Puis on vérifie la longueur de l'username
          $pseudolength = strlen($username);
          if ($pseudolength <= 255)
          {
              
              // 4 On verifie que l'username n'est pas déjà utilisé dans la base de données
              $requser = $bdd->prepare('SELECT * FROM utilisateurs WHERE username = ?');
              $requser->execute(array(
                  $username
              ));
              $userexiste = $requser->RowCount();
              $requser->CloseCursor();

            if ($userexiste == 0)
              {
                  //5 On vérifie le mot de passe
                  if ($mdp == $mdp2)
                  {
                      // 6 On verifie que les mots de passe ne sont identique !
                      $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                      // 7 On insert les données dans la base de données !
                      $insertUtl = $bdd->prepare('INSERT INTO utilisateurs (nom, prenom, username, password, question, reponse) VALUES (?, ?, ?, ?, ?, ?) ');
                      $insertUtl->execute(array(
                          $nom,
                          $prenom,
                          $username,
                          $mdp,
                          $questionSelect,
                          $reponse
                      ));
                       $insertUtl->CloseCursor();
                   
                      header('Location: index.php?success=1&message=Votre inscription à été prise en compte');
                     exit;
                  }
  
                  //5
                  else
                  {
                      $erreur = "<span style='color:red; font-weight:bold;'>Les mots de passes ne sont pas identique !</span> " ;
                  }
              }
              //4
              else
              {
                  $erreur = "<span style='color:red; font-weight:bold;'>Username déjà utilisé !</span> " ;
              }
          }
          //3
          else
          {
              $erreur = "<span style='color:red; font-weight:bold;'>Username trop long !</span> " ;
          }
    }
  
      //2
      else
      {
          $erreur = "<span style='color:red; font-weight:bold;'>Merci de complêter le formulaire !</span> " ;
      }
}
  ?>



<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="css/hcstyles.css" />
    <link type="text/css" rel="stylesheet" href="css/hcstylesmobiles.css" />
    <link type="text/css" rel="stylesheet" href="css/hctablettestyle.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Projet 3</title>
  </head>
  <body>
    <?php require('include/headerindex.php')?>
    <main id="connexion">
      <div class="container">
        <h2 class="bouton_page"><a href="index.php">Revenir à l'accueil</a></h2>
      </div>
      <div class="container">
        <div class="form">
          <form method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Ex: Dupont" value='<?php if (isset($nom))
              {
                  echo $nom;
              } ?>' required>
            <label for="Prenom">Prenom :</label>
            <input type="text" id="Prenom" name="prenom" placeholder="Ex: Martin" value='<?php if (isset($prenom))
              {
                  echo $prenom;
              } ?>' required>
            <label for="username">Username (4 à 20 caractère) :</label>
            <input type="text" id="username" name="username" placeholder="Ex: Cookie" minlength="4" maxlength="20" value='<?php if (isset($username))
              {
                  echo $username;
              } ?>' required>
            <label for="mdp">Mot de passe (4 à 30 caractère): </label>
            <input type="password" id="mdp" name="mdp" placeholder="Pensez à sécuriser le mot de passe" minlength="4" maxlength="30" required>
            <label for="mdp2">Comfirmer le Mot de passe : </label>
            <input type="password" id="mdp2" name="mdp2" placeholder="Verifiez que vos mot de passe soient identique" minlength="4" maxlength="30" required>
            <label for="choix_question">Choisissez une question secrète: </label>
            <input type="text" id="choix_question" name="questionSelect" placeholder="Ex: Mon lieu de naissance" minlength="8" value='<?php if (isset($questionSelect))
              {
                  echo $questionSelect;
              } ?>' required>
            <label for="reponse">Votre réponse : <span style="color:red; font-weight:bold;">| A RETENIR |</span> </label>
            <input type="text" id="reponse" name="reponse" placeholder="Ex: Paris" minlength="4" required>
            <p>
              <?php if (isset($erreur))
                {
                    echo '<p><font color="red">' . $erreur . '</font></p>';
                } ?> 
            </p>
            <p>
              <input class="bouton_enregistrer" type="submit" value="Enregistrer" name="valideForm"> 
            </p>
          </form>
        </div>
      </div>
    </main>
    <?php require ('include/footer.php'); ?>
  </body>
</html>