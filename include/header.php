<header id="monheader">
   <div class="container">
      <img class="logo" src="images/logo_gbaf.png" alt="logo_gbaf">
      <p class="header_title">Le groupement banques et assurances Française</p>
      <div class="utilisateur">
      <img class="user" src="images/user.png" alt="user_img">
      <img class="close_session" src="images/close.png" alt="close_img">
      <img class="settings" src="images/settings.png" alt="settings_img">
      <p class="bonjour"><?php echo 'Bonjour ' .$_SESSION['nom']. ' '.$_SESSION['prenom']. '' ?></p>
      <a class="user_settings" href="#">Paramètres du compte</a>
      <a class="end_session" href="deconnexion.php">Se déconnecter</a>
    </div>
   </div>
</header>




