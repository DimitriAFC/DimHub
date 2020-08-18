<?php require('include/database.php');?>
<?php require ('include/horsconnexion.php') ?>
	<?php

// 1 On verifie si les champs existent !
if(isset($_POST['valideMdp']) && isset($_POST['motdepass']) && isset($_POST['motdepasscomfirm']) && isset($_GET['id']))
{

       $mdp = htmlspecialchars($_POST['motdepass']);
        $mdpm = htmlspecialchars($_POST['motdepasscomfirm']);

//2 On verfie que les champs ne sont pas vides
   if(!empty($_POST['motdepass']) && !empty($_POST['motdepasscomfirm']))
   {
      //3 on verifie que les mots de passe sont identique 
      if ($mdp == $mdpm)
      {
            $mdp = password_hash($_POST['motdepass'], PASSWORD_DEFAULT);
            
       

             $modify = $bdd -> prepare("UPDATE utilisateurs SET password ='$mdp' WHERE id_user = ?");
             $modify -> execute(array($_GET['id']));
             $modify -> closeCursor();

           header('Location: index.php?success=1&message=Votre mot de passe à été mise à jour');
           exit;
      }
      //3
      else 
      {
         $msgErreur = "<span style='color:red; font-weight:bold;'>Les mots de passe doivent être identique !</span> " ;
      }

   }
//2
else
{
  $msgErreur = "<span style='color:red; font-weight:bold;'>Certains champs sont vide !</span> " ;
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
								<label for="motdepasse">Nouveau mot de passe :</label>
								<input type="password" id="motdepasse" name="motdepass" placeholder="Sécurisez votre mot de passe !" required>
								<label for="motdepasscomfirm">Comfirmer mot de passe :</label>
								<input type="password" id="motdepasscomfirm" name="motdepasscomfirm" placeholder="Les mots de passe doivent être identique" required>
								<br/>
								<p>
									<?php if(isset($msgErreur)) { echo  $msgErreur; }  else { echo "";}?>
								</p>
								<input class="bouton_renvoyer" type="submit" value="Valider" name="valideMdp"> </form>
						</div>
					</div>
				</main>
				<?php require('include/footer.php')?>
		</body>

		</html>