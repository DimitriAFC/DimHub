<?php session_start(); ?>
<?php require ('include/database.php') ?>
<?php require ('include/redirection.php') ?>



<?php
//1 Si les variables existent dans l'url
if (isset($_GET['id']) and !empty($_GET['id']))
{
    $userId = $_SESSION['id'];

    //2 Vérifie que le bouton submit est fonctionnel
    if (isset($_POST['formmbr']))
    {
        // Si oui je nomme les variables pour chaques input
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $mdp2 = htmlspecialchars($_POST['mdp2']);
        $username = htmlspecialchars($_POST['username']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);

    //3 Vérification des champs vides
    if (!empty($nom) and !empty($prenom))
    {
        $insertUser = $bdd->prepare("UPDATE utilisateurs SET nom = '$nom', prenom = '$prenom'  WHERE id_user ='$userId'");
        $insertUser->execute(array(
            $nom,
            $prenom,

        ));

        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;

        $insertUser->CloseCursor();

        $msgErreur = "Informations mise à jour.";

        //4 On verifie que l'username n'est pas vide et on le compare
        if (!empty($username))
        {
        // Je vérfie en cas de modification si l'user existe pas dans la bdd
        $modifu = $bdd->prepare("SELECT * FROM utilisateurs WHERE username= ?");
        $modifu->execute(array(
            $username
        ));
        $newUser = $modifu->rowCount();
        $modifu->CloseCursor();


         //5 Si l'username est celui de la session actuel rien ne change, on continue
         if( $_SESSION['username'] === $username)
         {
             //6 Si la question est rempli et que la réponse est vide on contine
            if(!empty($question) and empty($reponse))
            {
                // 7 Si les champs mot de passe ne sont pas vides
                if (!empty($mdp) and !empty($mdp2))
                {
                    // 8 Si les 2 champs sont identiques
                    if ($mdp == $mdp2)
                    {
                        $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                       $mdp2 = password_hash($_POST['mdp2'], PASSWORD_DEFAULT);

                          $pass = $bdd->prepare("UPDATE utilisateurs SET password ='$mdp' WHERE id_user ='$userId'");
                          $pass->execute(array(
                              $mdp
                            ));
                          $pass->CloseCursor();

                          $msgErreur = "Mot de passe MISE A JOUR.";
                    }
                    else
                    {
                        $msgErreur = "Mot de passe non identique.";
                    }
                }
            }
            //6 Si l'utilisateur rempli la question et la réponse, on update
            elseif(!empty($question) and !empty($reponse))
            {
                $reponse = password_hash($_POST['reponse'], PASSWORD_DEFAULT);

                $answer = $bdd->prepare("UPDATE utilisateurs SET question ='$question', reponse = '$reponse' WHERE id_user ='$userId'");
                $answer->execute(array(
                    $question,
                    $reponse
                ));
                $answer->CloseCursor();
                $_SESSION['question'] = $question;
                $msgErreur = "Informations mises à jour.";
            }
            //6
            else
            {
                $msgErreur = "Veuillez saisir une question et une réponse !";
            }

         }
         // Si il n'existe pas, on le met à jour
         elseif($newUser == 0)
          {
             // Modification du pseudo si il n'est pas déjà enregistrer
             $insertUser = $bdd->prepare("UPDATE utilisateurs SET username ='$username' WHERE id_user ='$userId'");
             $insertUser->execute(array(
                 $username
             ));
             $insertUser->CloseCursor();
 
             $msgErreur = "Username mise à jour.";
 
             $_SESSION['username'] = $username;
          }
         //5 Si il existe, message d'erreur !
         else
         {
             $msgErreur = "Username déjà utilisé, veuillez en choisir un autre.";
         }
        }
        else
        {
            $msgErreur = "Veuillez renseigner un Username";
        }
    }
    //3
    else
    {
        $msgErreur = "Veuillez renseigner un nom et prénom.";
    }
    }
}
?>




<!doctype html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <link type="text/css" rel="stylesheet" href="css/cstyles.css" />
      <link type="text/css" rel="stylesheet" href="css/cstylesmobiles.css" />
      <link type="text/css" rel="stylesheet" href="css/ctablettestyle.css" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <title>Projet 3</title>
   </head>
   <body>
      <?php require('include/header.php')?>
      <div class="container">
         <p class="messageErreur"><?php if(isset($msgErreur)) { echo  $msgErreur; }  else { echo "";}?></p>
      </div>
      <div class="container">
         <h2 class="bouton_infos">Vos informations</h2>
      </div>
      <div class="container">
         <div class="infos_membres">
            <form class="formulaire_modification" method="post" action="#">
               <div class="informations_membres">
                  <label for="nom">Nom  </label><br/>
                  <input type="text" id="nom" maxlength="20" value="<?= $_SESSION['nom'] ?>" name="nom"  ><br>
                  <label for="prenom">Prénom </label><br/>
                  <input type="text" id="prenom" maxlength="20" value="<?= $_SESSION['prenom'] ?>" name="prenom"  ><br>
                  <label for="username">Username  </label><br/>
                  <input type="text" id="username" maxlength="20"  minlength="4" value="<?= $_SESSION['username'] ?>" name="username"  ><br>
                  <label for="question">Question secrête  </label><br/>
                  <input type="text" id="question" value="<?= $_SESSION['question'] ?>" name="question"  ><br>
                  <label for="reponse">Votre réponse </label><br/>
                  <input type="text" id="reponse"  placeholder="Exemple : Paris" name="reponse"  ><br>
                  <label for="mdp">Changer le mot de passe  </label><br/>
                  <input type="password" id="mdp" placeholder="Merci de sécuriser le mot de passe" name="mdp"  ><br>
                  <label for="mdp2">Comfirmer le mot de passe </label><br/>
                  <input type="password" id="mdp2" placeholder="Merci de sécuriser le mot de passe"  name="mdp2"  ><br>
                  <input class="bouton_modifs" type="submit" name="formmbr" value="Modifier mes informations" >
               </div>
            </form>
         </div>
      </div>
      <?php require('include/footer.php')?>
   </body>
</html>