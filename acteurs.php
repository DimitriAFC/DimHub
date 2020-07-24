<?php session_start(); ?>
<?php require('include/database.php') ?>
<?php

//1
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
      <meta name=viewport content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
      <title>Projet 3</title>
   </head>
   <body>
      <?php require('include/header.php')?>
      <div class="container"><?php if(isset($_GET['message'])) { echo "<span style=color:green;font-weight:bold;>" .$_GET['message']. "</span>"; } ?></div>
      <div class="container">
         <section class="act_presentation">
            <img class="act_img" src=<?php echo 'images/' .$image; ?> alt="image_acteur">
            <h2><?php echo $name; ?></h2>
            <p><?php echo $desc; ?></p>
            
            <a href="partenaires.php"> Retour </a>
           
         </section> </div>





    
      <div class="container">


         <section class="commentaires">

            <div class="espacelike">

            <div class="like"><a href="#"></a></div>

            <img class="img_like" src="images/like.png">

            <div class="dislike"><a href="#"></a></div>
            <img class="img_dislike" src="images/dislike.png">

      </div>
            <div class="coms">
               <div class="commentaires_coms">
               </div>


               
               <?php



               $reqCom = $bdd ->prepare("SELECT * FROM commentaires WHERE id_acteurs=? ");
               $reqCom -> execute(array($_GET['id']));

               $com = $reqCom ->fetch();

               {?>

                <b><span style="color:red;"> Postée le :</b></span>  <?php echo $com['date']; ?>  <br/>
                 <b><span style="color:red;"> Pseudo :</b></span>  <?php echo $com['username'];?>  <br/>
                 <b><span style="color:red;"> Message :</b></span>  <?php echo $com['commentaire'];?>  <br/>

               <?php }?>
               

            </div>
           

            <a class="ajout_coms" href="formulaire.php?id=<?php echo $id; ?>" target="blank">Nouveau commentaire</a>
         </section></div>
   
      <?php require('include/footer.php')?>
   </body>
</html>