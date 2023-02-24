
<?php
require_once('connect.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Codition Name
    if (empty($_POST['name'])) {
        $errors['name'] = 'Le champ "Nom" est obligatoire';
    }

    if (mb_strlen($_POST['name']) > 255) {
        $errors['lenght_name'] = 'La chaîne de caractère est trop longue';
    }
    //Codition Firts Name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'Le champ "Prénom" est obligatoire';
    }

    if (mb_strlen($_POST['first_name']) > 255) {
        $errors['lenght_first_name'] = 'La chaîne de caractère est trop longue';
    }

    //Codition adress
    if (empty($_POST['address'])) {
        $errors['address'] = 'Le champ "Adresse" est obligatoire';
    }

    if (mb_strlen($_POST['address']) > 255) {
        $errors['lenght_address'] = 'La chaîne de caractère est trop longue';
    }

    //Codition Code postal
    if (empty($_POST['postal_code'])) {
        $errors['postal_code'] = 'Le champ "Code postal" est obligatoire';
    }

    if (!preg_match("~^\d{5}$~", $_POST['postal_code'])) {
        $errors['lenght_postal_code'] = "Le code postal n'est pas conforme";
    }

    //Codition Ville
    if (empty($_POST['town'])) {
        $errors['town'] = 'Le champ "Ville" est obligatoire';
    }

    if (mb_strlen($_POST['town']) > 255) {
        $errors['lenght_town'] = "La chaîne de caractère est trop longue";
    }

    //Codition email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Le champ "E-mail" est obligatoire';
    }

    if (mb_strlen($_POST['email']) > 255) {
        $errors['lenght_email'] = "La chaîne de caractère est trop longue";
    }

    if (!preg_match("~^.+@.+\..+$~", $_POST['email'])) {
        $errors['preg_email'] = "l'e-mail est non conforme";
    }

    //Codition numéro de téléphone
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Le champ "Numéro de téléphone" est obligatoire';
    }

    if (!pregmatch("~^\d{5}$~", $_POST['phone'])) {
        $errors['lenght_phone'] = "Le numéro renseigner n'existe pas";
    }

    //Condition statut
    if (empty($_POST['status'])) {
        $errors['status'] = "Veuillez sélectionner un champ";
    }

    //Condition chauffage
    if (empty($_POST['heating'])) {
        $errors['heating'] = "Veuillez sélectionner un champ";
    }

    //Condition logement
    if (empty($_POST['accomodation'])) {
        $errors['accomodation'] = "Veuillez sélectionner un champ";
    }

    //condition cgu
    if ($_POST['cgu'] = false) {
        $errors['cgu'] = "Veuillez sélectionner un champ";
    }

    //condition genre
    if ((isset($_POST['male']) && isset($_POST['female']) && isset($_POST['other_sex'])) ||
        (isset($_POST['male']) && isset($_POST['female']) && !isset($_POST['other_sex'])) ||
        (!isset($_POST['male']) && isset($_POST['female']) && isset($_POST['other_sex'])) ||
        (isset($_POST['male']) && !isset($_POST['female']) && isset($_POST['other_sex'])) ||
        (!isset($_POST['male']) && !isset($_POST['female']) && !isset($_POST['other_sex']))) {
        $errors['genre'] = "Veuillez sélectionnez un seul genre";
    }

    if (empty($errors)) {

        /*$user = new pac($dbh);
        $user->create($_POST);*/

        header("location:/lpPompeChaleur/index.php");
        exit;
    }
}

?>
<form method="POST"  action="index.php">
          <div class="f2pl">
            <select id="status" name="status">
              <option value="">→ Vous êtes...</option>
              <option value="owner">Propiétaire</option>
              <option value="tenant">Locataire</option>
            </select>
            <?php echo $errors['status'] ?>

            <select id="heating" name="heating">
              <option value="">→ Votre chauffage actuel...</option>
              <option value="gas">Gaz</option>
              <option value="fuel_oil">Fioul</option>
              <option value="electric">Électrique</option>
              <option value="wood">Bois</option>
              <option value="dual">Dual(électricité + gaz)</option>
              <option value="other_heating">Autre</option>
            </select>
          </div>

          <div class="fl">
            <label for="accommodation"></label>
            <select id="accommodation" name="accommodation">
              <option value="">→ Type de logement...</option>
              <option value="house">Une maison</option>
              <option value="appartement">Un appartement</option>
              <option value="business premises">Locaux professionnels</option>
              <option value="autre">Autre</option>
            </select>
          </div>

          <div class="fl exeption">
            <input type="checkbox" id="male" name="male">
            <label for="male">Mr</label>

            <input type="checkbox" id="female" name="female">
            <label for="female">Mme</label>

            <input type="checkbox" id="other_sex" name="other_sex">
            <label for="other_sex">Autre</label>
          </div>

          <div class="f2pl">
            <input type="text" id="name" name="name" placeholder="→ Nom">

            <input type="text" id="first_name" name="first_name" placeholder="→ Prénom">
          </div>

          <div class="fl">
            <input type="text" id="address" name="address" placeholder="→ Adresse">
          </div>

          <div class="f2pl">
            <input type="text" id="town" name="town" placeholder="→ Ville">

            <input type="text" id="postal_code" name="postal_code" placeholder="→ Code Postal">
          </div>

          <div class="fl">
            <label for="email"></label>
            <input type="text" id="email" name="email" placeholder="→ Adresse e-mail">
          </div>

          <div class="fl">
            <label for="phone"></label>
            <input type="text" id="phone" name="phone" placeholder="→ Numéro de téléphone">
          </div>

          <div id="fb">
            <div class="exeption" id="acceptations">
              <input type="checkbox" id="cgu" name="cgu">
              <label for="cgu">J'accepte les CGU et que leurs partenaires me communiquent leurs devis</label>
              <br><br>

              <input type="checkbox" id="offre" name="offre">
              <label for="offre">J'accepte de recevoir des offres personnalisées email, téléphone et sms de comparer-changer.fr ainsi que de ses partenaires</label>
            </div>
              <input type="submit" value="VALIDER" id="hbutton">
          </div>
      </form>
