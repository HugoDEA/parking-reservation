<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:login.php');
    exit;
}
?>
<?php 
/*require('vendor/autoload.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$server   = '172.16.12.75';
$port     = 1883;
$clientId = rand(5, 15);
$username = 'admin';
$password = '1234';
$clean_session = false;
$mqtt_version = MqttClient::MQTT_3_1_1;

$connectionSettings = (new ConnectionSettings)
  ->setUsername($username)
  ->setPassword($password)
  ->setKeepAliveInterval(60)
  ->setLastWillTopic('emqx/test/last-will')
  ->setLastWillMessage('client disconnect')
  ->setLastWillQualityOfService(1);

$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
*/
?>

<?php
// Démarrer la session
//mettre apres avoir cliquer bouton "vous avez reserver de 8h a 10h
setlocale(LC_TIME, 'fra_FRa');

$ajd=strftime('%A %e %B');
$ajd = ucfirst($ajd); // met la première lettre en majuscule
$ajdplusun = strftime('%A %e %B', strtotime('+1 day'));
$ajdplusun = ucfirst($ajdplusun); 
$ajdplusdeux = strftime('%A %e %B', strtotime('+2 day'));
$ajdplusdeux = ucfirst($ajdplusdeux); 
$ajdplustrois = strftime('%A %e %B', strtotime('+3 day'));
$ajdplustrois = ucfirst($ajdplustrois); 
$ajdplusquatre = strftime('%A %e %B', strtotime('+4 day'));
$ajdplusquatre = ucfirst($ajdplusquatre); 
$ajdpluscinq = strftime('%A %e %B', strtotime('+5 day'));
$ajdpluscinq = ucfirst($ajdpluscinq); 
$ajdplussix = strftime('%A %e %B', strtotime('+6 day'));
$ajdplussix = ucfirst($ajdplussix); 
$rfid = $_SESSION['rfid'];
$today = date("Y-m-d");
$todayplusun = date("Y-m-d", strtotime('+1 day'));
$todayplusdeux = date("Y-m-d", strtotime('+2 day'));
$todayplustrois = date("Y-m-d", strtotime('+3 day'));
$todayplusquatre = date("Y-m-d", strtotime('+4 day'));
$todaypluscinq = date("Y-m-d", strtotime('+5 day'));
$todayplussix = date("Y-m-d", strtotime('+6 day'));
$todayplussept= date("Y-m-d", strtotime('+7 day'));
// Vérifier si le formulaire a été soumis
  // Connexion à la base de données
  $host = "localhost";
  $username = "root";
  $password = "Parking852!";
  $dbname = "parking";
  $conn = mysqli_connect($host, $username, $password, $dbname);
  
  if (!$conn) {
    die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
  }
  $class = ""; 
if(isset($_POST['submit'])) {
    $valeur = $_POST['submit'];
    switch($valeur) {
        case 'bouton1':
            // Interroger la base de données pour compter le nombre de réservations effectuées par l'utilisateur avec l'étiquette RFID
            $count_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $result = mysqli_query($conn, $count_sql);
            $row = mysqli_fetch_assoc($result);
            $num_reservations = $row['num_reservations'];
            
            // Vérifier si l'utilisateur a déjà effectué sept réservations
            if ($num_reservations >= 7) {
                $class = "boutonrouge";
                echo "<script>alert('Désolé, il n y a plus de places.');</script>";
            } else {
                // Insérer la réservation dans la base de données
                $class = "bouton1";
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','08:00:00','10:00:00')";
                mysqli_query($conn, $sql);
                
                // Publier le message de réservation en utilisant MQTT
                //$topic = 'bdd';
                //$message = 'de 08:00 a 10:00!';
                //$mqtt->publish($topic, $message, 0);
                
                // Afficher le message de réussite dans le navigateur
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
            
            }
            break;
        case 'bouton2':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            $ajd_json = json_encode($ajd);//Convertit ajd en une chaine JSON grace à json_encore, pour convertir de PHP en javascript
            echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez bien réservé pour le ' + ajd + ' de 10:00 à 12:00.');</script>";//Affiche une alterte de le navigateur, crée une variable ajd et la met en json
            break;
        case 'bouton3':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton4':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton5':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton6':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton7':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton8':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','08:00:00','10:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton9':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton10':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton11':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton12':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton13':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton14':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton15':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','08:00:00','10:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton16':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton17':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton18':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton19':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton20':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton21':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton22':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','08:00:00','10:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton23':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton24':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton25':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton26':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton27':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton28':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton29':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','08:00:00','10:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton30':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton31':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton32':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton33':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton34':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton35':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton36':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','08:00:00','10:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton37':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton38':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton39':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton40':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton41':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton42':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
        case 'bouton43':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','08:00:00','10:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton44':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','10:00:00','12:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton45':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','12:00:00','14:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton46':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','14:00:00','16:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton47':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','16:00:00','18:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton48':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','18:00:00','20:00:00')";
            mysqli_query($conn, $sql);
            break;
        case 'bouton49':
            $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','20:00:00','22:00:00')";
            mysqli_query($conn, $sql);
            break;
        default:
            echo "Erreur : valeur inconnue.";
            break;
    }

    // Requête SQL à exécuter

}
?>
<!DOCTYPE html>
<html lang="fr">
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
            <a href="index.html"  class="sedeconnecter">Déconnexion</a>
    </header>
    <div class="titre">
    <p id="message"></p>
    <script>window.onload = function() {
  updateTime();
};

function updateTime() {
// Récupère la date actuelle
var date = new Date();

// Options pour formater la date en français
var options = { weekday: 'long', day: 'numeric', month: 'long' };

// Formate la date en chaîne de caractères en français
var dateString = date.toLocaleDateString('fr-FR', options);

// Récupère l'heure actuelle
var time = date.toLocaleTimeString();

// Affiche le message dans le paragraphe
document.getElementById("message").innerHTML = "Bonjour <?php echo $_SESSION['username'] ?>, nous sommes " + dateString + " et il est actuellement " + time + "";
}

// Appelle la fonction updateTime toutes les 1000 milliseconds (1 seconde)
setInterval(updateTime, 1000);
</script>
</div>
    </div>

    <table class="bjr">
        <tr>
            <th><?php echo $ajd;?></th>
            <th><?php echo $ajdplusun?></th>
            <th><?php echo $ajdplusdeux?></th>
            <th><?php echo $ajdplustrois?></th>
            <th><?php echo $ajdplusquatre?></th>
            <th><?php echo $ajdpluscinq?></th>
            <th><?php echo $ajdplussix?></th>
        </tr>
        <tr>                <form method="post">
            <td>
                <button name="submit" type="submit" value="bouton1" class="<?php echo $class; ?>">
                    08:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton8">
                    08:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton15">
                    08:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton22">
                    08:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton29">
                    08:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton36">
                    08:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton43">
                    08:00
                </button>
        </tr>
        <tr>            
            <td>
                <button name="submit" type="submit" value="bouton2">
                    10:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton9">
                    10:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton16">
                    10:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton23">
                    10:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton30">
                    10:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton37">
                    10:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton44">
                    10:00
                </button></td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton3">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton10">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton17">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton24">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton31">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton38">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton45">
                    12:00
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton4">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton11">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton18">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton25">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton32">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton39">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton46">
                    14:00
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton5">
                    16:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton12">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton19">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton26">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton33">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton40">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton47">
                    16:00
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton6">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton13">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton20">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton27">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton34">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton41">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton48">
                    18:00
                </button>
            </td>
        </tr>
        <tr>         
            <td>
                <button name="submit" type="submit" value="bouton7">
                    20:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton14">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton21">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton28">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton35">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton42">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton49">
                    20:00
                </button>
            </td>
            </form>
        </tr>
    </table>
</body>
<script src="assets\js\script.js"></script>
</html>