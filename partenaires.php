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
      <div class="container">
         <section id="presentation_gbaf">
            <h1>Présentation du Groupement Banque et Assurance Française</h1>
            <p>Le Groupement Banque Assurance Français​ (GBAF) est une fédération  représentant les 6 grands groupes français  </p>
            <p><span>●</span> BNP Paribas ;  <span>●</span> BPCE ;  <span>●</span> Crédit Agricole ;  <span>●</span> Crédit Mutuel-CIC ;  <span>●</span> Société Générale ;   <span>●</span> La Banque Postale.</p>
            <img class="img_presentation" src="images/image_presentation.jpg" alt="GBAF">
            <p> Même s’il existe une forte concurrence entre ces entités, elles vont toutes travailler  de la même façon pour gérer près
               de 80 millions de comptes sur le territoire  national.  Le GBAF est le représentant de la profession bancaire et des assureurs sur tous
               les axes de la réglementation financière française. Sa mission est de promouvoir  l'activité
               bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des  pouvoirs publics.
            </p>
         </section>
      </div>
      <div class="container">
         <section id="presentation_partenaires">
            <h2>Présentation des acteurs</h2>
            <p>Les acteurs et partenaires de la GBAF</p>
         </section>
      </div>
      <div class="container">
         <section id="acteurs">
            <div class="presentation_acteurs">
               <img class="logo_acteurs" src="images/formation_co.png" alt="formation&co">
               <h3>Formation & Co</h3>
               <p>Formation&co est une association française présente sur tout le territoire.
                  Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement
                  professionnel et personnalisé.
               </p>
               <a class="bouton_lire" href="formationco.php">Lire la suite</a>
            </div>
            <div class="presentation_acteurs">
               <img class="logo_acteurs" src="images/protectpeople.png" alt="protectpeople">
               <h3>Protectpeople</h3>
               <p>Protectpeople finance la solidarité nationale.
                  Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.
               </p>
               <a class="bouton_lire" href="protectpeople.php">Lire la suite</a>
            </div>
            <div class="presentation_acteurs">
               <img class="logo_acteurs" src="images/Dsa_france.png" alt="DSAFrance">
               <h3>DSA France</h3>
               <p>Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.
                  Nous accompagnons les entreprises dans les étapes clés de leur évolution.
                  Notre philosophie : s’adapter à chaque entreprise.
               </p>
               <a class="bouton_lire" href="dsafrance.php">Lire la suite</a>
            </div>
            <div class="presentation_acteurs">
               <img class="logo_acteurs" src="images/CDE.png" alt="CDE">
               <h3>CDE</h3>
               <p>La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation.
                  Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.
               </p>
               <a class="bouton_lire" href="cde.php">Lire la suite</a>
            </div>
         </section>
      </div>
      <?php require('include/footer.php')?>
   </body>
</html>