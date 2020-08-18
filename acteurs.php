<?php session_start(); ?>
	<?php require('include/database.php') ?>
		<?php require('include/redirection.php') ?>
			<?php


         $checkart = $bdd -> prepare("SELECT * FROM acteurs WHERE id_acteur=?");
         $checkart -> execute(array($_GET['id']));

        //2 Si l'article existe (==1)
        if($checkart -> rowCount() == 1)
        {

        
//2
if(isset($_GET['id']))
{
   // Récupération de la table acteurs
   $reqAct = $bdd ->prepare('SELECT * FROM acteurs WHERE id_acteur=?');

   $reqAct -> execute(array($_GET['id']));

   $acteurs = $reqAct -> fetch();

// Je nomme des variables
   $image =  $acteurs["image"];
   $name = $acteurs['nom'];
   $desc = $acteurs['description'];
   $id = $acteurs['id_acteur'];

}
}
//1
else
{
   header("Location:partenaires.php");
   exit;
}
?>
				<?php

      $likes = $bdd->prepare("SELECT * FROM votes WHERE vote='1' AND id_acteur = ?");
      $likes -> execute(array($id));
      $likes = $likes-> rowCount();

      $dislikes = $bdd->prepare("SELECT * FROM votes WHERE vote='2' AND id_acteur = ?");
      $dislikes -> execute(array($id));
      $dislikes = $dislikes -> rowCount();

      
?>
					<!doctype html>
					<html lang="fr">

					<head>
						<meta charset="utf-8">
						<link type="text/css" rel="stylesheet" href="css/cstyles.css" />
						<meta name="viewport" content="width=device-width, initial-scale=1">
						<link type="text/css" rel="stylesheet" href="css/cstylesmobiles.css" />
						<link type="text/css" rel="stylesheet" href="css/ctablettestyle.css" />
						<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
						<title>Projet 3</title>
					</head>

					<body>
						<?php require('include/header.php')?>
							<div class="container">
								<div class="msg_erreur">
									<?php if(isset($_GET['message'])) { echo "<span style=color:green;font-weight:bold;>" .$_GET['message']. "</span>"; } ?>
										<?php if(isset($_GET['erreur'])) { echo "<span style=color:red;font-weight:bold;>" .$_GET['erreur']. "</span>"; } ?>
											<?php if(isset($_GET['succes'])) { echo "<span style=color:red;font-weight:bold;>" .$_GET['succes']. "</span>"; } ?> </div>
							</div>
							<div class="container">
								<section class="act_presentation"> <img class="act_img" src=<?php echo 'images/' .$image; ?> alt="image_acteur">
									<h2><?php echo $name; ?></h2>
									<p>
										<?php echo $desc; ?>
									</p> <a href="partenaires.php"> Retour </a> </section>
							</div>
						



<?php
$commentaires = $bdd -> prepare("SELECT COUNT(*) AS nb_com  FROM commentaires WHERE id_acteurs=?");
$commentaires -> execute(array($_GET ['id']));
$donnees = $commentaires -> fetch();
?>

<!--C1-->							<div class="container">
<!--S1-->						<section class="commentaires">


<!--1-->								<div class="espacelike">
<!--3-->							<div class="like">
<p>
												<?= $likes ?>
											</p>
<!--3-->										</div>
										<a class="lien_like" href="php/votes.php?type=1&id=<?= $_GET['id'] ?>"><img class="img_like" src="images/like.png" alt="image_like"></a>
<!--2-->										<div class="dislike">
											<p>
												<?= $dislikes ?>
											</p>
											<a class="lien_like" href="php/votes.php?type=2&id=<?= $_GET['id'] ?>"><img class="img_dislike" src="images/dislike.png" alt="image_dislike"></a>
<!--2-->											</div>
<!--1-->							</div>

<?php
$commentaires = $bdd -> prepare("SELECT COUNT(*) AS nb_com  FROM commentaires WHERE id_acteurs=?");
$commentaires -> execute(array($_GET ['id']));
$donnees = $commentaires -> fetch();
?>




<!--4-->	<div class="addComs">
<a class="ajout_coms" href="formulaire.php?id=<?php echo $id; ?>" target="blank">Nouveau commentaire</a>
<!--4-->  </div>


<!--5--> <div class="nbrComs">
												<p>
													<?php echo $donnees['nb_com']; ?> <span style="color:black;">Commentaires</span></p>
<!--5--> 	</div>





							

									<div class="coms">
										<div class="commentaires_coms">
											<p>Aperçu des avis sur
												<?php echo $name; ?>
											</p>
										</div>
									
										<?php

										// Requête jointure
										$reqCom = $bdd ->prepare("SELECT * FROM commentaires INNER JOIN utilisateurs ON commentaires.id_user = utilisateurs.id_user WHERE commentaires.id_acteurs ORDER BY commentaires.date DESC");
										$reqCom ->execute([$id]);

										?>

										<?php while ($comm = $reqCom -> fetch()){
											if($comm['id_acteurs'] === $id) { ?>



											<div class="message_coms"> <span style="color:red;"> Postée le :</span>
												<?= $comm['date'] ?>
													<br> <span style="color:red;"> Nom :</span>
													<?= $comm['nom'] . ' ' . $comm['prenom'] ?>
														<br> <span style="color:red;"> Message :</span>
														<?= $comm['commentaire'] ?>
															<br>
															<br> 
															</div>
														
											<?php }
										}
										?>
									
										
									</div>
<!--S1-->								</section>
<!--C1-->								</div>
							<?php require('include/footer.php')?>


					</body>
					</html>