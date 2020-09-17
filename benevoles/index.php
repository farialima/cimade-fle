<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cimade Lyon - Inscriptions pour les « portes ouvertes » 2020-2021</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../style.css">
    </head>

  <body>
    <h3 class="text">Cimade Lyon</h3>
    <h4>Inscriptions pour les « portes ouvertes »2020-2021</h4>
    <?php
   include '../functions.php';
   date_default_timezone_set('Europe/Paris');
   $current_date = new DateTime(date("Y-m-d H:i:s", time()));
   $days = array();
   if ($current_date < new DateTime('2020-09-19 10:00:00')) {
     $days['Samedi 19 septembre'] = array("10h30", "14h30");
   }
   elseif ($current_date < new DateTime('2020-09-19 13:30:00')) {
     $days['Samedi 19 septembre'] = array("14h30");
   }

   if ($current_date < new DateTime('2020-09-26 10:00:00')) {
     $days['Samedi 26 septembre'] = array("10h30", "14h30");
   }
   elseif ($current_date < new DateTime('2020-09-26 13:30:00')) {
     $days['Samedi 19 septembre'] = array("14h30");
   }

   $csv_file = dirname(__FILE__).DIRECTORY_SEPARATOR.'rendezvous.csv';

   do_page($csv_file, $days,
           "<p>Pour participer à une séance d’information en vue bénévolat, il faut vous inscrire pour une des séances proposées. Chaque séance dure 1h30. Merci d’écrire votre nom, prénom,  votre téléphone et  votre email,  et cliquer sur la séance choisie. Vous aurez une confirmation.</p>\n      <p>Venez au 33 Rue Imbert-Colomès (Lyon) le jour et l’heure de la séance confirmée. N’oubliez pas votre masque !</p><p>Si vous n’avez pas pu vous inscrire (séances complètes, ou pas disponibles pour les séances  proposées), vous pouvez écrire à <a href=\"mailto:devenirbenevole.lyon.lacimade@gmail.com\">devenirbenevole.lyon.lacimade@gmail.com</a>, d’autres séances pourront vous être proposées ultérieurement.</p>\n      <p>Pour plus d'information sur les possibilités de bénévolat, voyez <a href=\"https://www.lacimade.org/offre_benevole/benevolat-a-lyon-2019-2020-accompagnement-juridique-organisation-devenements/\">cette page<a>.",
           '<p>Venez à l’heure au 33 Rue Imbert-Colomès (Lyon 2eme). Au plaisir de vous rencontrer et de vous présenter les opportunités de bénévolat à la Cimade Lyon !</p>',
           10);
   ?>

  </body>

</html>
