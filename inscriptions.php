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

      <?php require ('include/header.php'); ?>

      <main id="connexion">
         <div class="container">
            <h2 class="bouton_page"><a href="index.php">Revenir à l'accueil</a></h2>
         </div>
         <div class="container">
            <div class="form">

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
        $reponse = htmlspecialchars($_POST['reponse']);

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
            if ($userexiste == 0)
            {
                //5 On vérifie le mot de passe
                if ($mdp == $mdp2)
                {
                    // 6 On verifie que les mots de passe ne sont pas identique !
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
                    $succes = "Votre compte à bien été créer !";
                    header('location:index.php');
                }
                //5
                else
                {
                    $erreur = " Mot de passe non indentique !";
                }
            }
            //4
            else
            {
                $erreur = " Votre username est déjà utilisé !";
            }
        }
        //3
        else
        {
            $erreur = " Votre username est trop long !";
        }
    }

    //2
    else
    {
        $erreur = " Complêter le formulaire!";
    }
}

//1
else
{
    echo '';
}

?>


             <form  method="post">
                  <label for="nom">Nom :</label>
                  <input type="text" id="nom" name="nom" value ='<?php if (isset($nom))
{
    echo $nom;
} ?>' required>
                  <label for="Premon">Prenom :</label>
                  <input type="text" id="Prenom" name="prenom" value ='<?php if (isset($prenom))
{
    echo $prenom;
} ?>' required>
                  <label for="username">Username :</label>
                  <input type="text" id="username" name="username" value ='<?php if (isset($username))
{
    echo $username;
} ?>' required>
                  <label for="mdp">Mot de passe : </label>
                  <input type="password" id="mdp" name="mdp" required>
                  <label for="mdp2">Comfirmer le Mot de passe : </label>
                  <input type="password" id="mdp2" name="mdp2" required>
                  <label for="choix_question">Choisissez une question secrète:</label>
                  <input type="text" id="question" name="questionSelect" value ='<?php if (isset($questionSelect))
{
    echo $questionSelect;
} ?>' required>
                  <label for="reponse">Votre réponse : </label>
                  <input type="text" id="reponse"  name="reponse" value ='<?php if (isset($reponse))
{
    echo $reponse;
} ?>'required>
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