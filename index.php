<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cimade - Français</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

<!--
  TODO: lien à mettre depuis https://www.lacimade.org/activite/les-ateliers-socio-linguistiques-a-s-l/

-->
  <body>
    <h3 class="text">Cimade Lyon</h3>
    <h4>Rendez-vous d'inscriptions pour les cours de français 2020-2021</h4>
    <?php
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

     $hours = array();
     $csv_file = dirname(__FILE__).DIRECTORY_SEPARATOR.'rendezvous.csv';

     if (($handle = fopen($csv_file, "r")) !== FALSE) {
       while (($data = fgetcsv($handle)) !== FALSE) {
         $hours[] = $data[4];
       }
       fclose($handle);
     }

     $hours_count = array_count_values($hours);

     function complet($hour) {
       global $hours_count;
       return isset($hours_count[$hour]) && ($hours_count[$hour] >= 4);
     }

     $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
     $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
     $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
     $email = isset($_POST['email']) ? $_POST['email'] : "";
     $horaire = isset($_POST['horaire']) ? $_POST['horaire'] : "";
     $error = '';

     function display_td($day, $hour) {
       $slot = $day  . ' à ' . $hour;
       global $horaire;
       $complet = complet($slot);
       echo '          <td class="' . ($complet ? 'complet' : 'libre') . '">'."\n";
       echo '          <input type="radio" name="horaire" id="' . $slot . '" value="' . $slot . '"' . ($complet ? ' disabled' : '') . (($horaire == $slot) ? ' checked' : '') . '>'."\n";
       echo '          <label style="margin-bottom: 0" for="' . $slot . '"' . ($complet ? ' disabled' : '') . '>' . $hour . '</label>'."\n";
       echo '          ' . ($complet ? 'Complet' : 'Disponible')."\n";
       echo '          </td>'."\n";
     }


     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (empty($prenom) || empty($nom) || (strlen($prenom) < 2) || (strlen($nom) < 2)) {
          $error .= "<p>Entrez votre nom et prénom.</p>\n";
       }

       $num = preg_replace("/[^0-9]/", "", "$telephone");
       if ((strlen($num) < 6) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
          $error .= "<p>Entrez un numéro de téléphone ou un email valide.</p>\n";
       }
       if (!$horaire) {
          $error .= "<p>Choisissez un créneau pour le rendez-vous.</p>\n";
        }

       if (complet($horaire)) {
          $error .= "<p>Choisissez un jour et une heure pour le rendez-vous.</p>\n";
       }

       if (!$error) {
         $fp = fopen($csv_file, 'aw');
         fputcsv($fp, array($prenom, $nom, $telephone, $email, $horaire));
         fclose($fp);

         echo "<p/>";
         echo "<h3>Votre rendez-vous est confirmé</h3>";
         echo "<p/>";
         echo "<p>Votre rendez-vous a été pris pour le <b>" . $horaire . "</b>, pour " . $prenom . " " . $nom . " (" . $email . (($email && $telephone) ? ", " : "") . $telephone . ").</p>";
         echo "<p>Venez à l'heure au 33 Rue Imbert-Colomès (Lyon 2eme). <b>Masque obligatoire</b> mais nous pourrons vous en fournir si vous n'en avez pas :).</p>";
         echo '<p>Si vous ne pouvez pas venir, merci de nous envoyer un mail à <a href="mailto:fle.lyon@lacimade.org">fle.lyon@lacimade.org</a> pour annuler.</p>';
       }
     } // ... "POST"

     if (!($_SERVER["REQUEST_METHOD"] == "POST") || $error) {
     ?>

    <p>Pour venir vous informer et vous inscrire, il faut prendre rendez-vous. Merci d’écrire votre nom, prénom, et votre téléphone ou email&nbsp;; et choisir un jour et une heure de rendez-vous.</p>
    <p>Venez au 33 Rue Imbert-Colomès (Lyon) le jour et l'heure de votre rendez-vous. Merci !</p>
    <p><p>
    <?php
     if ($error) {
         echo "<div class='error'>\n";
         echo "<p>Veuillez corriger les erreurs et sauvez de nouveau :</p>";
         echo $error;
         echo "</div>\n";
       }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <label style="margin-left:1em" for="prenom">Prénom:</label>
      <input type="text" name="prenom" id="prenom" value="<?php echo htmlentities($prenom) ?>">
      <label style="margin-left:1em" for="nom">Nom:</label>
      <input type="text" name="nom" id="nom" value="<?php echo htmlentities($nom) ?>"><br>
      <label style="" for="telephone">Téléphone:</label>
      <input type="text" name="telephone" id="telephone" placeholder="06 xx xx xx xx" value="<?php echo htmlentities($telephone) ?>">
      <p style="display:inline; margin-left: 1em;">et/ou</p>
      <label style="margin-left:1em" for="email">Email:</label>
      <input type="text" name="email" id="email" placeholder="nom@adresse.com" value="<?php echo htmlentities($email) ?>">
      <br/>
      <table class="horaire" border="3" cellspacing="4" align="left">
        <caption><input class="submit" style="" type="submit" value="Confirmer le rendez-vous"></caption>
        <tr>
        <?php foreach ($days as $day) {
            echo '<th>' . $day . '</th>';
          } ?>
        </tr>
      <?php
      foreach ($hour_slots as $hour_slot) {
          echo '<tr>';
          foreach ($days as $day) {
            display_td($day, $hour_slot);
          }
          echo '</tr>';
        }
      ?>
      </table>

    </form>
    <?php  } ?>
  </body>

</html>
