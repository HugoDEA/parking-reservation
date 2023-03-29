<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:loginadmin.php');
    exit;
}
?>

<?php
// Démarrer la session

// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "Parking852!";
$dbname = "parking";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
}

$reserved = "SELECT * FROM status";
$result = mysqli_query($conn, $reserved); // Exécution de la requête SQL

// Stockage des résultats de la requête dans un tableau
$reserved_data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $reserved_data[] = $row;
}
// Fermer la connexion à la base de données
mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réservation Parking</title>
    <script src="assets/js/script.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="test">
    <header>
        <a href="index.html">
            <img src="assets/img/parking.png" alt="Logo" width="50px" ; height="50px" >
        </a>
        <h2>Réservation Parking</h2>
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
<table>
  <div class="policetdb">Etage 1 :</div>
    <td class="policetd"> Places disponibles : <div class="red">
    <?php foreach ($reserved_data as $reserved_rows) { 
    echo $reserved_rows['floor1_available']; 
         } ?>
    </div>
    </td>
</table>
<br>
<br>
<table>
  <tr>
    <div class="policetdb">Etage 2 :</div>
  </tr>
  <td class="policetd"> Places disponibles : <div class="red">
  <?php foreach ($reserved_data as $reserved_rows) { 
    echo $reserved_rows['floor2_available']; 
         } ?>
  </div>
  </td>

  <td class="policetd"> Places reservées : <div class="red">
  <?php foreach ($reserved_data as $reserved_rows) { 
    echo $reserved_rows['floor2_reserved']; 
         } ?>
  </div>
    </td>
</table>
</body>
</html>