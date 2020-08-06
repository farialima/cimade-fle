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
     $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
     $nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
     $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : NULL;
     $email = isset($_POST['email']) ? $_POST['email'] : NULL;
     $horaire = isset($_POST['horaire']) ? $_POST['horaire'] : NULL;
     $ok = true;
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (empty($prenom) || empty($nom)) {
        echo "Entrez votre nom et prenom";
        $ok = false;
     }
     // TODO: more validation

     if ($ok) {
       // TODO: save the data
       $fp = fopen('/tmp/file.csv', 'aw');
       fputcsv($fp, array($prenom, $nom, $telephone, $email, $horaire));
       fclose($fp);

       // TODO display summary 
       echo "votre rendez vous a ete pris pour : ";

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
          <td class="complet"><input type="radio" name="horaire" id="mer15h" value="mer15h" disabled>
            <label for="mer15h" disabled>15h</label>
            <p>Complet</p>
          </td>
          <td class="libre"><input type="radio" name="horaire" id="jeu15h" value="jeu15h" checked>
            <label for="jeu15h">15h</label>
            <p>libre</p>
          </td class="">
          <td class=""><input type="radio" name="horaire" id="ven15h" value="ven15h">
            <label for="ven15h">15h</label>
            <p></p>
          </td>
          <td class=""><input type="radio" name="horaire" id="sam15h" value="sam15h">
            <label for="sam15h">15h</label>
            <p></p>
          </td>
        </tr>
        <tr>
          <td class="libre"><input type="radio" name="horaire" id="mer15h30" value="mer15h30">
            <label for="mer15h30">15h30</label>
            <p>Libre</p>
          </td>
          <td class=""><input type="radio" name="horaire" id="jeu15h30" value="jeu15h30">
            <label for="jeu15h30">15h30</label>
            <p></p>
          </td>
          <td class=""><input type="radio" name="horaire" id="ven15h30" value="ven15h30">
            <label for="ven15h30">15h30</label>
            <p></p>
          </td>
          <td class=""><input type="radio" name="horaire" id="sam15h30" value="sam15h30">
            <label for="sam15h30">15h30</label>
            <p></p>
          </td>
        </tr>
        <tr>
          <td><input type="radio" name="horaire" id="mer16h" value="mer16h">
            <label for="mer16h">16h</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="jeu16h" value="jeu16h">
            <label for="jeu16h">16h</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="ven16h" value="ven16h">
            <label for="ven16h">16h</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="sam16h" value="sam16h">
            <label for="sam16h">16h</label>
            <p></p>
          </td>
        </tr>
        <tr>
          <td><input type="radio" name="horaire" id="mer16h30" value="mer16h30">
            <label for="mer16h30">16h30</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="jeu16h30" value="jeu16h30">
            <label for="jeu16h30">16h30</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="ven16h30" value="ven16h30">
            <label for="ven16h30">16h30</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="sam16h30" value="sam16h30">
            <label for="sam16h30">16h30</label>
            <p></p>
          </td>
        </tr>
        <tr>
          <td><input type="radio" name="horaire" id="mer17h" value="mer17h">
            <label for="mer17h">17h</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="jeu17h" value="jeu17h">
            <label for="jeu17h">17h</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="ven17h" value="ven17h">
            <label for="ven17h">17h</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="sam17h" value="sam17h">
            <label for="sam17h">17h</label>
            <p></p>
          </td>
        </tr>
        <tr>
          <td><input type="radio" name="horaire" id="mer17h30" value="mer17h30">
            <label for="mer17h30">17h30</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="jeu17h30" value="jeu17h30">
            <label for="jeu17h30">17h30</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="ven17h30" value="ven17h30">
            <label for="ven17h30">17h30</label>
            <p></p>
          </td>
          <td><input type="radio" name="horaire" id="sam17h30" value="sam17h30">
            <label for="sam17h30">17h30</label>
            <p></p>
          </td>
        </tr>
      </table> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <input style="" type="submit" value="Finir">
    </form>
    <?php  } ?>
  </body>

</html>
