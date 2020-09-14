<?php
function complet($hour, $hours_count, $max) {
  return isset($hours_count[$hour]) && ($hours_count[$hour] >= $max);
}

function do_page($csv_file, $days, $info_html, $success_html, $max) {
  if (!(is_writable($csv_file) && is_readable($csv_file))) {
    echo "<div class='error'>\n";
    echo "<p>Le fichier des rendez-vous n'est pas accessible !!</p>";
    echo "</div>\n";
  }
  $noms = array();
  $telephones = array();
  $emails = array();
  $hours = array();
  if (($handle = fopen($csv_file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
      $noms[] = $data[0]." ".$data[1];
      $telephones[] = preg_replace("/[^0-9]/", "", $data[2]);
      $emails[] = $data[3];
      $hours[] = $data[4];
    }
    fclose($handle);
  }
  
  $hours_count = array_count_values($hours);
  
  $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
  $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
  $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
  $email = isset($_POST['email']) ? $_POST['email'] : "";
  $horaire = isset($_POST['horaire']) ? $_POST['horaire'] : "";
  $error = '';
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($prenom) || empty($nom) || (strlen($prenom) < 2) || (strlen($nom) < 2)) {
       $error .= "<p>Entrez votre nom et prénom.</p>\n";
    }
  
    $num = preg_replace("/[^0-9]/", "", $telephone);
    if ((strlen($num) < 6) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
       $error .= "<p>Entrez un numéro de téléphone ou un email valide.</p>\n";
    }
    if (!$horaire) {
       $error .= "<p>Choisissez un jour et une heure pour le rendez-vous.</p>\n";
     }
  
    if (complet($horaire, $hours_count, $max)) {
       $error .= "<p>Ce jour et heure (".$horaire.") est complet. Choisissez un autre jour et heure pour le rendez-vous.</p>\n";
    }
  
    if (in_array($prenom . " ". $nom, $noms)) {
       $error .= "<p>Un rendez-vous a déjà été pris pour ce prénom et nom. Vous ne pouvez pas vous inscrire une deuxième fois. Si c’est une erreur, contactez-nous à <a href=\"mailto:lyon@lacimade.org\">lyon@lacimade.org</a>.</p>\n";
    }
    /* Allow reusing email and phones: sometimes people do that (e.g. Armee du Salut, for other people)
    if ((strlen($num) > 1) && in_array($num, $telephones)) {
       $error .= "<p>Un rendez-vous a déjà été pris avec ce numéro de téléphone. Vous ne pouvez pas vous inscrire une deuxième fois. Si c’est une erreur, contactez-nous à <a href=\"mailto:lyon@lacimade.org\">lyon@lacimade.org</a>.</p>\n";
    }
    elseif ((strlen($email) > 1) && in_array($email, $emails)) {
       $error .= "<p>Un rendez-vous a déjà été pris avec cet email. Vous ne pouvez pas vous inscrire une deuxième fois. Si c’est une erreur, contactez-nous à <a href=\"mailto:lyon@lacimade.org\">lyon@lacimade.org</a>.</p>\n";
    }
    */

    if (!$error) {
      $fp = fopen($csv_file, 'aw');
      fputcsv($fp, array($prenom, $nom, $telephone, $email, $horaire));
      fclose($fp);
  
      echo "<p/>";
      echo "<h3>Votre rendez-vous est confirmé</h3>";
      echo "<p/>";
      echo "<p>Votre rendez-vous a été pris pour le <b>" . $horaire . "</b>, pour " . $prenom . " " . $nom . " (" . $email . (($email && $telephone) ? ", " : "") . $telephone . ").</p>";
      echo $success_html;
    }
  } // ... "POST"
  
  if (!($_SERVER["REQUEST_METHOD"] == "POST") || $error) {
    echo $info_html;
    echo "<p><p>\n";
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
     <tbody>
       <?php
       foreach ($days as $day => $hour_slots) {
         echo '<tr><td class="th">' . $day . '</td>';
         foreach ($hour_slots as $hour_slot) {
           $slot = $day  . ' à ' . $hour_slot;
           $complet = complet($slot, $hours_count, $max);
           echo '       <td class="' . ($complet ? 'complet' : 'libre') . '">'."\n";
           echo '          <input type="radio" name="horaire" id="' . $slot . '" value="' . $slot . '"' . ($complet ? ' disabled' : '') . (($horaire == $slot) ? ' checked' : '') . '>'."\n";
           echo '          <label style="margin-bottom: 0" for="' . $slot . '"' . ($complet ? ' disabled' : '') . '>' . $hour_slot . '</label>'."\n";
           echo '       <br/>' . ($complet ? 'Complet' : 'Disponible')."\n";
           echo '       </td>'."\n";
         }
         echo '    </tr>'."\n";
      }
     ?>
     </tbody>
   </table>
 </form>
 <?php  } // if (!($_SERVER["REQUEST_METHOD"] == "POST") || $error)
} // function do_page($csv_file, $days, $hour_slots, $info_html, $success_html)

