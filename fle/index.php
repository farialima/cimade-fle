<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cimade - Français</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../style.css">
    </head>

<!--
  TODO: lien à mettre depuis https://www.lacimade.org/activite/les-ateliers-socio-linguistiques-a-s-l/

-->
  <body>
    <h3 class="text">Cimade Lyon</h3>
    <h4>Rendez-vous d'inscriptions pour les cours de français 2020-2021</h4>
    <?php
   include '../functions.php';
   date_default_timezone_set('Europe/Paris');
   $current_date = new DateTime(date("Y-m-d H:i:s", time()));
   $days = array();
   if ($current_date < new DateTime('2020-09-14 12:00:00')) {
     $days[] = 'Lundi 14 septembre';
   }
   if ($current_date < new DateTime('2020-09-15 12:00:00')) {
     $days[] = 'Mardi 15 septembre';
   }
   if ($current_date < new DateTime('2020-09-21 12:00:00')) {
     $days[] = 'Lundi 21 septembre';
   }
   if ($current_date < new DateTime('2020-09-22 12:00:00')) {
     $days[] = 'Mardi 22 septembre';
   }

   $hour_slots = array("14h", "14h30", "15h", "15h30", "16h", "16h30");

   $csv_file = dirname(__FILE__).DIRECTORY_SEPARATOR.'rendezvous.csv';

   do_page($csv_file, $days, $hour_slots, 
           "<p>Pour venir vous informer et vous inscrire, il faut prendre rendez-vous. Merci d’écrire votre nom, prénom, et votre téléphone ou email&nbsp;; et choisir un jour et une heure de rendez-vous.</p>\n      <p>Venez au 33 Rue Imbert-Colomès (Lyon) le jour et l’heure de votre rendez-vous. Merci !</p>",
           '<p>Venez à l’heure au 33 Rue Imbert-Colomès (Lyon 2eme). <b>Masque obligatoire</b> mais nous pourrons vous en fournir si vous n’en avez pas :).</p><p>Si vous ne pouvez pas venir, merci de nous envoyer un mail à <a href="mailto:fle.lyon@lacimade.org">fle.lyon@lacimade.org</a> pour annuler.</p>');
   ?>

  </body>

</html>
