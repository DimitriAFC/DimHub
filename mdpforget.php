<?php require('include/database.php');?>
	<?php
         // 1 On teste les variables du formulaire 
         if (isset($_POST['valideRecup'], $_POST['recupUsername']))
         {
         // 2 On verifie que le champs n'est pas vide
            if (!empty($_POST['recupUsername']))
            {
         // 3 On cherche dans la BDD que l'username existe       
                  $user = htmlspecialchars($_POST['recupUsername']);

                  $requser = $bdd -> prepare('SELECT * FROM utilisateurs WHERE username = ?');
                  $requser -> execute (array($user));
                  $userExiste = $requser -> fetch();
          
         //4 Si l'username existe , on redirige vers la question secrète

                  if($userExiste)
                  {
                  
                           header("location:answer.php?id=".$userExiste['id_user']);
                           exit;
                  }
         // 3 Sinon message d'erreur
                  else {
                     $msgErreur ='<p style="color:red; font-weight:bold;">L\'username n\'existe pas !</p>';
                  }
            }
         // 2 Sinon on envoie l'erreur
            else 
            {
                     $msgErreur ='<p style="color:red; font-weight:bold;">Veuillez saisir un Username</p>';
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
								<label for="recupUsername">Renseigner votre Username :</label>
								<input type="text" id="recupUsername" name="recupUsername" placeholder="Username" value="">
								<p>
									<?php if(isset($msgErreur)) { echo  $msgErreur; }  else { echo "";}?>
								</p>
								<p>
									<input class="bouton_renvoyer" type="submit" value="Valider" name="valideRecup">
								</p>
							</form>
						</div>
					</div>
				</main>
				<div class="espace_blanc"></div>
				<?php require('include/footer.php')?>
		</body>

		</html>