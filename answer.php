<?php require('include/database.php');?>
<?php require ('include/horsconnexion.php') ?>
	<?php

//1 Je verifie le formulaire (si il existe)
if(isset($_POST['valideForm']) AND isset($_POST['reponse']) AND isset($_GET['id']))
{

   $rep = htmlspecialchars($_POST['reponse']);

//  Si le champs n'est pas vide alors
  if(!empty($_POST['reponse']))
  {
                // On lance la requête
               $reqQ = $bdd -> prepare('SELECT * FROM utilisateurs WHERE id_user = ?');
               // La requete va chercher la reponse indiqué dans la base de donnés voir si il existe
               $reqQ -> execute(array($_GET['id']));
               //On lance la recherche
               $quest = $reqQ->fetch();

         
      //4 Si la reponse existe alors on compare la reponse entré avec la reponse enregistré dans la BDD
       if($quest AND password_verify($_POST['reponse'], $quest['reponse']))
    {
      //5 mot de passe haché puis redirection vers la page de modification !
      $rep = password_hash($_POST['reponse'], PASSWORD_DEFAULT);
      header("Location:mdpmodify.php?id=".$_GET['id']);
      exit;

    }

    else
    {
      $msgErreur = "<span style='color:red; font-weight:bold;'>Mauvaise réponse !</span> " ;
    }
  }
  else
  {
   $msgErreur = "<span style='color:red; font-weight:bold;'>Merci de saisir une réponse !</span> " ;
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
						<h2 class="bouton_page"><a href="index.php">Revenir à l'accueil</a></h2> </div>
					<div class="container">
						<div class="form">
							<form method="post">
								<p class="Qsecrete">Votre question secrète est :</p>
								<?php 
                  // On lance la requête
               $answer = $bdd -> prepare('SELECT * FROM utilisateurs WHERE id_user = ?');
               // La requete va chercher la suestions indiqué dans la base de donnés voir si il existe
               $answer -> execute(array($_GET['id']));
               //On lance la recherche
               $myAnswer = $answer->fetch();

               echo "<span style='color:green; font-weight:bold; font-size:18px;'>" .$myAnswer['question']. " ?</span>";
               ?>
									<label for="reponse">Réponse à la question :</label>
									<input type="text" id="reponse" name="reponse">
									<br/>
									<p>
										<?php if(isset($msgErreur)) { echo  $msgErreur; }  else { echo "";}?>
									</p>
									<input class="bouton_renvoyer" type="submit" value="Valider" name="valideForm"> </form>
						</div>
					</div>
				</main>
				<?php require('include/footer.php')?>
		</body>

		</html>