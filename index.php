<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cimade - Français</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

  <body>
    <h3 class="text">Cimade Lyon</h3>
    <h4>Rendez-vous d'inscriptions pour les cours de français 2020-2021</h4>
    <?php
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
       return isset($hours_count[$hour]) && ($hours_count[$hour] > 1);
     }

     $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
     $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
     $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
     $email = isset($_POST['email']) ? $_POST['email'] : "";
     $horaire = isset($_POST['horaire']) ? $_POST['horaire'] : "";
     $error = '';

     function display_td($hour) {
       global $horaire;
       $display = explode("_", $hour)[1];
       $complet = complet($hour);
       echo '          <td class="' . ($complet ? 'complet' : 'libre') . '">'."\n";
       echo '          <input type="radio" name="horaire" id="' . $hour . '" value="' . $hour . '"' . ($complet ? ' disabled' : '') . (($horaire == $hour) ? ' checked' : '') . '>'."\n";
       echo '          <label for="' . $hour . '"' . ($complet ? ' disabled' : '') . '>' . $display . '</label>'."\n";
       echo '          ' . ($complet ? '<p>Complet</p>' : '<p>Disponible</p>')."\n";
       echo '          </td>'."\n";
     }


     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (empty($prenom) || empty($nom) || (strlen($prenom) < 2) || (strlen($nom) < 2)) {
          $error .= "<p>Entrez votre nom et prénom.</p>\n";
       }

       $num = preg_replace("/[^0-9]/", "", "$telephone");
       if ((strlen($num) < 6) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
          $error .= "<p>Entrer un numéro de téléphone ou un email valide.</p>\n";
       }
       if (!$horaire) {
          $error .= "<p>Choisissez un créneau pour le rendez-vous.</p>\n";
        }

       if (complet($horaire)) {
          $error .= "<p>Le creneau choisi est complet, choisissez un autre creneau.</p>\n";
       }

       if (!$error) {
         $fp = fopen($csv_file, 'aw');
         fputcsv($fp, array($prenom, $nom, $telephone, $email, $horaire));
         fclose($fp);

         echo "Votre rendez vous a été pris pour " . explode("_", $horaire)[0] . " à " . explode("_", $horaire)[1] . ".";

        }
     } // ... "POST"

     if (!($_SERVER["REQUEST_METHOD"] == "POST") || $error) {
     ?>

    <p>Remplissez les informations ci-dessous pour venir vous inscrire aux cours de Français de la Cimade Lyon. Donnez votre nom et votre prénom, et, soit un numéro de téléphone, soit une adresse email où vous pouvez être joint.</p><p>Venez au 33 Rue Imbert-Colomès (Lyon) le jour et l'heure de votre rendez-vous. Merci !</p>
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
      <input type="text" name="telephone" id="telephone" value="<?php echo htmlentities($telephone) ?>">
      <p style="display:inline; margin-left: 1em;">et/ou</p>
      <label style="margin-left:1em" for="email">Email:</label>
      <input type="text" name="email" id="email" value="<?php echo htmlentities($email) ?>">
      <br/>
      <table class="horaire" border="3" cellspacing="4" align="left">
        <caption><input class="submit" style="" type="submit" value="Réserver le créneau"></caption>
        <tr>
          <th>Mercredi</th>
          <th>Jeudi</th>
          <th>Vendredi</th>
          <th>Samedi</th>
        </tr>
        <tr>
          <?php
           display_td("Mercredi_15h");
           display_td("Jeudi_15h");
           display_td("Vendredi_15h");
           display_td("Samedi_15h");
           ?>
        </tr>
        <tr>
          <?php
           display_td("Mercredi_15h30");
           display_td("Jeudi_15h30");
           display_td("Vendredi_15h30");
           display_td("Samedi_15h30");
           ?>
        </tr>
        <tr>
          <?php
           display_td("Mercredi_16h");
           display_td("Jeudi_16h");
           display_td("Vendredi_16h");
           display_td("Samedi_16h");
           ?>
        </tr>
        <tr>
          <?php
           display_td("Mercredi_16h30");
           display_td("Jeudi_16h30");
           display_td("Vendredi_16h30");
           display_td("Samedi_16h30");
           ?>
        </tr>
        <tr>
          <?php
           display_td("Mercredi_17h");
           display_td("Jeudi_17h");
           display_td("Vendredi_17h");
           display_td("Samedi_17h");
           ?>
        </tr>
        <tr>
          <?php
           display_td("Mercredi_17h30");
           display_td("Jeudi_17h30");
           display_td("Vendredi_17h30");
           display_td("Samedi_17h30");
           ?>
        </tr>
      </table>

    </form>
    <?php  } ?>
  </body>

</html>
