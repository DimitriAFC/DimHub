<?php session_start(); ?>
<?php require('include/database.php') ?>
<?php

if(isset($_SESSION['username']))
{

}
else
{
   header("Location:index.php");
   exit;
}



?>
<?php


         $checkart = $bdd -> prepare("SELECT * FROM acteurs WHERE id=?");
         $checkart -> execute(array($_GET['id']));

        //2 Si l'article existe (==1)
        if($checkart -> rowCount() == 1)
        {

        
//2
if(isset($_GET['id']))
{
   // Récupération de la table acteurs
   $reqAct = $bdd ->prepare('SELECT * FROM acteurs WHERE id=?');

   $reqAct -> execute(array($_GET['id']));

   $acteurs = $reqAct -> fetch();

// Je nomme des variables
   $image =  $acteurs["image"];
   $name = $acteurs['nom'];
   $desc = $acteurs['description'];
   $id = $acteurs['id'];

}
//2
else
{

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

      $likes = $bdd->prepare("SELECT id FROM likes WHERE id_acteurs=?");
      $likes -> execute(array($id));
      $likes = $likes-> rowCount();

      $dislikes = $bdd->prepare("SELECT id FROM dislikes WHERE id_acteurs=?");
      $dislikes -> execute(array($id));
      $dislikes = $dislikes -> rowCount();

      
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
      <div class="container"><div class="msg_erreur"><?php if(isset($_GET['message'])) { echo "<span style=color:green;font-weight:bold;>" .$_GET['message']. "</span>"; } ?>
      <?php if(isset($_GET['erreur'])) { echo "<span style=color:red;font-weight:bold;>" .$_GET['erreur']. "</span>"; } ?>
      <?php if(isset($_GET['succes'])) { echo "<span style=color:red;font-weight:bold;>" .$_GET['succes']. "</span>"; } ?></div></div>
      <div class="container">
         <section class="act_presentation">
            <img class="act_img" src=<?php echo 'images/' .$image; ?> alt="image_acteur">
            <h2><?php echo $name; ?></h2>
            <p><?php echo $desc; ?></p>
            
            <a   href="partenaires.php"> Retour </a>
           
         </section> </div>





    
      <div class="container">


         <section class="commentaires">

            <div class="espacelike">


            <div class="like"><p><?= $likes ?></p></div>

            <a href="php/votes.php?type=1&id=<?= $_GET['id'] ?>"><img class="img_like" src="images/like.png"></a>

            <div class="dislike"><p><?= $dislikes ?></p></div>

            <a href="php/votes.php?type=2&id=<?= $_GET['id'] ?>"><img class="img_dislike" src="images/dislike.png"></a>
            <div class="addComs"><a class="ajout_coms" href="formulaire.php?id=<?php echo $id; ?>" target="blank">Nouveau commentaire</a></div>
               <?php

               $commentaires = $bdd -> prepare("SELECT COUNT(*) AS nb_com  FROM commentaires WHERE id_acteurs=?");
               $commentaires -> execute(array($_GET ['id']));
               $donnees = $commentaires -> fetch();
               


               ?>
      

            <div class="nbrComs"><p>   <?php echo $donnees['nb_com']; ?> <span style="color:black;">Commentaires</span></p></div>

      </div>
            <div class="coms">
               <div class="commentaires_coms"><p>Aperçu des avis sur <?php echo $name; ?></p>

               </div>

               
               <?php



               $reqCom = $bdd ->prepare("SELECT * FROM commentaires WHERE id_acteurs=? ORDER BY date DESC");
               $reqCom -> execute(array($_GET['id']));

               $com = $reqCom ->fetchAll();
               foreach($com as $index => $user)

               {?>
                  <div class="message_coms">
                <b><span style="color:red;"> Postée le :</b></span>  <?php echo $user['date']; ?>  <br/>
                 <b><span style="color:red;"> Pseudo :</b></span>  <?php echo $user['username'];?>  <br/>
                 <b><span style="color:red;"> Message :</b></span>  <?php echo $user['commentaire'];?>  <br/><br/>
                 </div>

               <?php }?>
               

            </div>
           

           
         </section></div>
   
      <?php require('include/footer.php')?>
   </body>
</html>