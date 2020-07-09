<?php 

    // Connexion à la base de donnée 
    $host       = "localhost";
    $dbname     = "test";
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