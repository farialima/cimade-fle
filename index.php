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
    <h1 class="text">Cimade</h1>
    <h2>Cours de Français</h2>
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
     $ok = true;

     function display_td($hour, $display) {
       global $horaire;
       $complet = complet($hour);
       echo '          <td class="' . ($complet ? 'complet' : 'libre') . '">'."\n";
       echo '          <input type="radio" name="horaire" id="' . $hour . '" value="' . $hour . '"' . ($complet ? ' disabled' : '') . (($horaire == $hour) ? ' checked' : '') . '>'."\n";
       echo '          <label for="' . $hour . '"' . ($complet ? ' disabled' : '') . '>' . $display . '</label>'."\n";
       echo '          ' . ($complet ? '<p>Complet</p>' : '<p>Disponible</p>')."\n";
       echo '          </td>'."\n";
     }


     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       echo "<div class='error'>\n";
       if (empty($prenom) || empty($nom) || (strlen($prenom) < 2) || (strlen($nom) < 2)) {
          echo "<p>Entrez votre nom et prénom.</p>\n";
          $ok = false;
       }

       $num = preg_replace("/[^0-9]/", "", "$telephone");
       if ((strlen($num) < 6) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
          echo "<p>Eentrer un numéro de téléphone ou un email valide.</p>\n";
          $ok = false;
       }
       if (!$horaire) {
          echo "<p>Choisissez un créneau pour le rendez-vous.</p>\n";
          $ok = false;
        }

       if (complet($horaire)) {
          echo "<p>Le creneau choisi est complet, choisissez un autre creneau.</p>\n";
          $ok = false;
       }

       echo "</div>\n";

       if ($ok) {
         $fp = fopen($csv_file, 'aw');
         fputcsv($fp, array($prenom, $nom, $telephone, $email, $horaire));
         fclose($fp);

         echo "Votre rendez vous a ete pris pour " . $horaire . " ";
         // TODO display summary
       }

     } // ... "POST"


     if (!($_SERVER["REQUEST_METHOD"] == "POST") || !($ok)) {
     ?>

    <p>Rendez-vous d'inscription:</p>

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
        <caption><input class="submit" style="" type="submit" value="Finir"></caption>
        <tr>
          <th>Mercredi</th>
          <th>Jeudi</th>
          <th>Vendredi</th>
          <th>Samedi</th>
        </tr>
        <tr>
          <?php
           display_td("mer15h", "15h");
           display_td("jeu15h", "15h");
           display_td("ven15h", "15h");
           display_td("sam15h", "15h");
           ?>
        </tr>
        <tr>
          <?php
           display_td("mer15h30", "15h30");
           display_td("jeu15h30", "15h30");
           display_td("ven15h30", "15h30");
           display_td("sam15h30", "15h30");
           ?>
        </tr>
        <tr>
          <?php
           display_td("mer16h", "16h");
           display_td("jeu16h", "16h");
           display_td("ven16h", "16h");
           display_td("sam16h", "16h");
           ?>
        </tr>
        <tr>
          <?php
           display_td("mer16h30", "16h30");
           display_td("jeu16h30", "16h30");
           display_td("ven16h30", "16h30");
           display_td("sam16h30", "16h30");
           ?>
        </tr>
        <tr>
          <?php
           display_td("mer17h", "17h");
           display_td("jeu17h", "17h");
           display_td("ven17h", "17h");
           display_td("sam17h", "17h");
           ?>
        </tr>
        <tr>
          <?php
           display_td("mer17h30", "17h30");
           display_td("jeu17h30", "17h30");
           display_td("ven17h30", "17h30");
           display_td("sam17h30", "17h30");
           ?>
        </tr>
      </table>

    </form>
    <?php  } ?>
  </body>

</html>
