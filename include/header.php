<header id="monheader">
   <div class="container">
      <a href="partenaires.php"><img class="logo" src="images/logo_gbaf.png" alt="logo_gbaf"></a>
      <p class="header_title">Le groupement banques et assurances Française</p>
      <div class="utilisateur">
      <div class="espace_mbr">
      <img class="user" src="images/user.png" alt="user_img">  
      <p class="bonjour"><?php echo '   Bonjour ' .$_SESSION['nom']. ' '.$_SESSION['prenom']. '' ?></p>
      <a class="user_settings" href="profil.php?id=<?= $_SESSION['id'] ?>">Paramètres du compte</a>
      <a class="end_session" href="deconnexion.php">Se déconnecter</a>
      </div>
    </div>
   </div>
</header>




