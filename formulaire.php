<?php session_start(); ?>
	<?php require('include/database.php') ?>
		<?php require('include/redirection.php') ?>
			<?php
//1 On verifie que le GET passe
if(isset($_GET['id']) AND !empty($_GET['id']))
{
   //2 On verifie que le champs est rempli
   if(!empty($_POST['message']))
   {

      $userS = $_SESSION['id'];

      $select = $bdd ->prepare("SELECT * FROM utilisateurs WHERE id_user = ? ");
      $select -> execute(array($userS));
      $reqU = $select -> fetch();


      $message = htmlspecialchars($_POST['message']);
      $id =  $reqU['id_user'];
      $user =  $reqU['username'];
      $idact = $_GET['id'];

         $msglength = strlen($message);
         // 3 On verifie que le message ne dépasse pas les 255 caractères
        if ($msglength <= 255)
        {
              

                  $count = $bdd->prepare("SELECT * FROM commentaires WHERE id_user =? AND id_acteurs = ?");
                  $count -> execute(array($id, $idact));
                  //4
                  if($count -> rowCount() == 0)
                  {


                     $commentaires = $bdd -> prepare('INSERT INTO commentaires (commentaire, id_acteurs, id_user) VALUES(?, ?, ?) ');
                     $commentaires->execute(array(
                        $message,
                        $idact,
                        $id
                        ));
                        $commentaires->CloseCursor();  
                        header("Location:acteurs.php?id=".$_GET['id']. "&message=Commentaire ajouté avec succées !");
                        exit;  
                  }
                  //4
                  else
                  {
                     header("Location:acteurs.php?id=".$_GET['id']. "&erreur=Vous avez déjà commenter ce partenaire !");
                     exit;
                  }
             
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
   
}
?>
				<!doctype html>
				<html lang="fr">

				<head>
					<meta charset="utf-8">
					<link type="text/css" rel="stylesheet" href="css/cstyles.css" />
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
					<title>Projet 3</title>
				</head>

				<body>
					<?php require('include/header.php')?>
						<div class="container">
							<form class="formcoms" method="post">
								<?php if(isset($erreur)) { echo "<span style='font-weight:bold;'> "  .$erreur. " </span>"; } ?></br>
									<label class="titreCommentaires" for="message">Ajoutez un commentaire </label>
									<br/>
									<textarea class="inputcoms" type="text" placeholder="Votre commentaire (Max 255 caractères)" maxlength="285" name="message"></textarea>
									<br/>
									<input class="btnCommentaires" type="submit" value="Envoyer" name="comfirm">
									<br/>
									<br/> </form>
						</div>
						<?php require('include/footer.php')?>
				</body>

				</html>