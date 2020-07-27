<?php session_start(); ?>
<?php

if(isset($_SESSION['username']))
{

}
else
{
    header("Location:http://localhost/projet3/index.php");
   exit;
}



?>
<?php 

    // Connexion à la base de donnée 
    $host       = "localhost";
    $dbname     = "gbaf";
    $user       = "root";
    $password   = "";


    try 
{

    $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}

		catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>







<?php

// On verifie que les variables existents et si elles ne sont pas vides
if(isset($_GET['type'], $_GET['id']) AND !empty($_GET['type']) AND !empty($_GET['id']))
{
        $idact = (int) $_GET['id'];
        $type = (int) $_GET['type'];
        $user = $_SESSION['username'];
        // On check voir si l'acteur existe dans la BDD
        $checkart = $bdd -> prepare("SELECT * FROM acteurs WHERE id=?");
        $checkart -> execute(array($idact));

        //2 Si l'acteur existe (==1)
        if($checkart -> rowCount() == 1)
        {
            // On verifie avec l'id de l'acteur et l'user si un vote n'existe pas encore
          $verif = $bdd ->prepare("SELECT * FROM likes WHERE id_acteurs= ? AND username = ?");
          $verif ->execute(array($idact, $user));
          $veriflike = $verif ->fetch();

          $verifd = $bdd ->prepare("SELECT * FROM dislikes WHERE id_acteurs= ? AND username = ?");
          $verifd ->execute(array($idact, $user));
          $verifdislike = $verifd ->fetch();

            // Si le vote == 0 donc n'existe pas on insert le vote dans la BDD 
          if($veriflike  == 0 AND $verifdislike == 0)
          {
                  // Si le type == 1 alors
            if($type == 1)
            {
                // On insért les votes
                $insertl = $bdd -> prepare("INSERT INTO likes (username, id_acteurs) VALUES (?,?)");
                $insertl -> execute(array(
                    $user,
                    $idact
                ));
                header("Location:http://localhost/projet3/acteurs.php?succes=Votre vote à été pris en compte&id=$idact");
                exit;
        
            }
            //Ou si le type == 2 alors (Le type 1 pour like et 2 pour dislike)
            elseif($type == 2)
            {
                $insertl = $bdd -> prepare("INSERT INTO dislikes (username, id_acteurs) VALUES (?,?)");
                $insertl -> execute(array(
                    $user,
                    $idact
                ));
                header("Location:http://localhost/projet3/acteurs.php?succes=Votre vote à été pris en compte&id=$idact");
                exit;

            }
            // Sinon la valeur n'est pas bonne !
            else
            {

            }
          }
          else
          { 
                header("Location:http://localhost/projet3/acteurs.php?erreur=Tu as déjà voté pour ce partenaire&id=$idact");
                  exit;
                
          }
        }
        //2
        else
        {
            echo 'non';
        }
}
//1
else
{
    echo 'non';
}




?>