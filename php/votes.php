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

//1 On verifie que les variables existents et si elles ne sont pas vides
if(isset($_GET['type'], $_GET['id']) AND !empty($_GET['type']) AND !empty($_GET['id']))
{
        $idact = (int) $_GET['id'];
        $type = (int) $_GET['type'];
        $user = $_SESSION['username'];
        $id_u = $_SESSION['id'];
        // On check voir si l'acteur existe dans la BDD
        $checkart = $bdd -> prepare("SELECT * FROM acteurs WHERE id_acteur =?");
        $checkart -> execute(array($idact));

        //2 Si l'acteur existe (==1)
        if($checkart -> rowCount() == 1)
        {
            //3 Si le type == 1 pour like (valeur envoyer en GET)
            if($type == 1)
            {
                $checkVotes = $bdd->prepare("SELECT * FROM votes WHERE id_acteur = ? AND id_user = ? AND vote = ?");
                $checkVotes -> execute(array($idact, $id_u, $type));

                // 4 On verifie que le vote n'existe pas encore
                if($checkVotes-> rowCount() == 1)
                {
                    header("Location:http://localhost/projet3/acteurs.php?succes=Vous avez déjà voter pour ce partenaire&id=$idact");
                    exit;
                }
                else
                {

                    $delDis = $bdd->prepare("DELETE FROM votes WHERE id_acteur=? AND id_user =?");
                    $delDis-> execute(array($idact, $id_u));

                    $insertl = $bdd -> prepare("INSERT INTO votes (id_user, id_acteur, vote) VALUES (?,?,?)");
                    $insertl -> execute(array(
                    $id_u,
                    $idact,
                    $type));
                    header("Location:http://localhost/projet3/acteurs.php?succes=Votre vote à été pris en compte&id=$idact");
                    exit;
                }
            }
           
            //3 Si le type == 2 pour dislike (valeur envoyer en GET)
            elseif($type == 2)
            {
                $checkVotes = $bdd->prepare("SELECT * FROM votes WHERE id_acteur = ? AND id_user = ? AND vote =?");
                $checkVotes -> execute(array($idact, $id_u, $type));

                // 4 On verifie que le vote n'existe pas encore
                if($checkVotes -> rowCount() == 1)
                {
                    header("Location:http://localhost/projet3/acteurs.php?succes=Vous avez déjà voter pour ce partenaire&id=$idact");
                    exit;
                }
                else
                {

                    $delDis = $bdd->prepare("DELETE FROM votes WHERE id_acteur=? AND id_user =?");
                    $delDis-> execute(array($idact, $id_u));

                    $insertl = $bdd -> prepare("INSERT INTO votes (id_user, id_acteur, vote) VALUES (?,?,?)");
                    $insertl -> execute(array(
                    $id_u,
                    $idact,
                    $type));
                    header("Location:http://localhost/projet3/acteurs.php?succes=Votre vote à été pris en compte&id=$idact");
                    exit;
                }
            }
        }
}





?>