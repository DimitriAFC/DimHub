<header id="monheader">
   <div class="container">
      <a href="partenaires.php"><img class="logo" src="images/logo_gbaf.png" alt="logo_gbaf"></a>
      <p class="header_title">Le groupement banques et assurances Française</p>
      <div class="utilisateur">
      <div class="espace_mbr">
      <img class="user" src="images/user.png" alt="user_img">  
      <p class="bonjour"><?php echo '   Bonjour ' .$_SESSION['nom']. ' '.$_SESSION['prenom']. '' ?></p>
      <a class="user_settings" href="profil.php?id=<?= $_SESSION['id'] ?>">  Paramètres du compte</a>
      <a class="end_session" href="deconnexion.php"> Se déconnecter</a>
      </div>
      <div class="mobile_icon">
      <a class="user_settings_mobile" href="profil.php?id=<?= $_SESSION['id'] ?>"> <img class="settings" src="images/settings.png" alt="user_img"></a>
      <a class="end_session_mobile" href="deconnexion.php"> <img class="logout" src="images/close.png" alt="user_img"></a>
      
      </div>
    </div>
   </div>
</header>




