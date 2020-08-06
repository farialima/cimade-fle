<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Cimade - Francais</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>

  <body>
    <h1 class="text">Cimade</h1>
    <h2>Cours de Francais</h2>
    <?php
     $hours = array();
     if (($handle = fopen("/tmp/file.csv", "r")) !== FALSE) {
       while (($data = fgetcsv($handle)) !== FALSE) {
         $hours[] = $data[4];
       }
     }
     fclose($handle);

     $hours_count = array_count_values($hours);

     function complet($hour) {
       global $hours_count;
       return isset($hours_count[$hour]) && ($hours_count[$hour] > 1);
     }

     function display_td($hour, $display) {
       $complet = complet($hour);
       echo '          <td class="' . ($complet ? 'complet' : 'libre') . '">'."\n";
       echo '          <input type="radio" name="horaire" id="' . $hour . '" value="' . $hour . '"' . ($complet ? ' disabled' : '') . '>'."\n";
       echo '          <label for="' . $hour . '"' . ($complet ? ' disabled' : '') . '>' . $display . '</label>'."\n";
       echo '          ' . ($complet ? '<p>Complet</p>' : '<p>Libre</p>')."\n";
       echo '          </td>'."\n";
     }

     $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
     $nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
     $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : NULL;
     $email = isset($_POST['email']) ? $_POST['email'] : NULL;
     $horaire = isset($_POST['horaire']) ? $_POST['horaire'] : NULL;
     $ok = true;
    
     echo "<div style='error'>\n";
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (empty($prenom) || empty($nom)) {
          echo "<p>Entrez votre nom et prenom.</p>\n";
          $ok = false;
       }
       // TODO: more validation
       // - first name and last name longer than 2 characters
       // - either email or phone number
       // - if email present, email format is correct
       // - if phone number present, phone number is correct
       // - maybe more :)

       if (complet($horaire)) {
          echo "<p>Le creneau choisi est complet, choisissez un autre creneau.</p>\n";
          $ok = false;
       }
       echo "</div>\n";
  
       if ($ok) {
         $fp = fopen('/tmp/file.csv', 'aw');
         fputcsv($fp, array($prenom, $nom, $telephone, $email, $horaire));
         fclose($fp);
  
         echo "votre rendez vous a ete pris pour : ";
         // TODO display summary 
       }
     } // ... "POST"

     if (!($_SERVER["REQUEST_METHOD"] == "POST") || !($ok)) {
     ?>

    <p>Rendez-vous d'inscription:</p>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <label style="margin-left:1em" for="prenom">Prenom:</label>
      <input type="text" name="prenom" id="prenom" value="<?php echo htmlentities($prenom) ?>">
      <label style="margin-left:1em" for="nom">Nom:</label>
      <input type="text" name="nom" id="nom" value="<?php echo htmlentities($nom) ?>"><br>
      <label style="" for="telephone">Telephone:</label>
      <input type="text" name="telephone" id="telephone" value="<?php echo htmlentities($telephone) ?>">
      <p style="display:inline; margin-left: 1em;">et/out</p>
      <label style="margin-left:1em" for="email">Email:</label>
      <input type="text" name="email" id="email" value="<?php echo htmlentities($email) ?>">
      <br/>
      <table class="horaire" border="3" cellspacing="4" align="left">
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
      </table> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <input style="" type="submit" value="Finir">
    </form>
    <?php  } ?>
  </body>

</html>
