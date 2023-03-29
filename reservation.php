<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:login.php');
    exit;
}
?>

<?php
// Démarrer la session
setlocale(LC_TIME, 'fr_FR.utf8'); // définit la locale en français
$ajd=date('l j F');


// Vérifier si le formulaire a été soumis
if(isset($_POST['submit'])) {
  // Connexion à la base de données
  $host = "localhost";
  $username = "root";
  $password = "Parking852!";
  $dbname = "parking";
  $conn = mysqli_connect($host, $username, $password, $dbname);
  
  if (!$conn) {
    die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
  }

  $rfid = $_SESSION['rfid'];
  // Requête SQL à exécuter
    $today = date("y-m-d");
    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','08:00:00','10:00:00')";
  if (mysqli_query($conn, $sql)) {
    echo 'Donnée insérée avec succès';
  } else {
    echo 'Erreur lors de l\'insertion de la donnée : ' . mysqli_error($conn);
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Réservation Parking</title>
</head>
<body>
<header>
        <a href="index.html">
            <img src="assets/img/parking.png" alt="Logo" width="50px" ; height="50px" >
        </a>            <h2>Réservation Parking</h2>
            <a href="index.html"  class="sedeconnecter">Se deconnecter</a>
    </header>
    <div class="titre">
    <p id="message"></p>

<script>
  window.onload = function() {
    updateTime();
  };

  function updateTime() {
    // Récupère la date actuelle
    var date = new Date();

    // Formate la date en chaîne de caractères
    var dateString = date.toLocaleDateString();

    // Récupère l'heure actuelle
    var time = date.toLocaleTimeString();

    // Affiche le message dans le paragraphe
    document.getElementById("message").innerHTML = "Bonjour <?php echo $_SESSION['username'] ?>, nous sommes le " + dateString + " et il est actuellement " + time + ".";
  }

  // Appelle la fonction updateTime toutes les 1000 milliseconds (1 seconde)
  setInterval(updateTime, 1000);
</script>

</div>
    </div>

    <table class="bjr">
        <tr>
            <th><?php echo $ajd;?></th>
            <th></th>
            <th>Mercredi 15 mars</th>
            <th>Jeudi 16 mars</th>
            <th>Vendredi 17 mars</th>
            <th>Samedi 18 mars</th>
            <th>Dimanche 19 mars</th>
        </tr>
        <tr>
            <td><form method="post">
  <button class="reservation"name="submit" type="submit" value="submit">
    08:00
  </button>
</form></td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
        </tr>
        <tr>            
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
        </tr>
        <tr>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
        </tr>
        <tr>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
        </tr>
        <tr>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
        </tr>
        <tr>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
        </tr>
        <tr>         
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
        </tr>
    </table>

</body>
</html>