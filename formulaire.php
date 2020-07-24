<?php session_start(); ?>
<?php require('include/database.php') ?>
<?php

//1 On verifie que le GET passe
if(isset($_GET['id']) AND !empty($_GET['id']))
{
   //2 On verifie que le champs est rempli
   if(!empty($_POST['message']))
   {
      $message = htmlspecialchars($_POST['message']);
      $id =  $_SESSION['id'];
      $user =  $_SESSION['username'];
      $idact = $_GET['id'];

         $msglength = strlen($message);
         // 3 On verifie que le message ne dépasse pas les 255 caractères
        if ($msglength <= 255)
        {

         $commentaires = $bdd -> prepare('INSERT INTO commentaires (username, commentaire, id_acteurs) VALUES(?, ?, ?) ');
         $commentaires->execute(array(
            $user,
            $message,
            $idact
            ));
            $commentaires->CloseCursor();  
            header("Location:acteurs.php?id=".$_GET['id']. "&message=Commentaire ajouté avec succées !");
            exit;  

        }
        //3
        else
        {
            $erreur = "Votre commentaire est trop long";
        }
   }
   //2
   else
   {
      $erreur = "Merci de taper un commentaire";
   }
}
//1
else
{
   echo 'non';
}





?>


<!doctype html>
<html lang="fr">
   <head>
      <meta charset="utf-8">
      <link type="text/css" rel="stylesheet" href="css/cstyles.css" />
      <meta name=viewport content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <title>Projet 3</title>
   </head>
   <body>
      <?php require('include/header.php')?>
      <div class="container">
      <form class="formcoms" method="post">
            <label class="titreCommentaires" for="message">Ajoutez un commentaire </label><br/>
           <textarea class="inputcoms" type="text" placeholder="Votre commentaire (Max 255 caractères)" maxlength="255" name="message"></textarea><br/>
            
            <input class="btnCommentaires" type ="submit" value ="Envoyer" name ="comfirm"><br/><br/>



            <?php if(isset($erreur)) { echo "<span style='font-weight:bold;'> "  .$erreur. " </span>"; } ?>
         </form>

    </div>
      <?php require('include/footer.php')?>
   </body>
</html>