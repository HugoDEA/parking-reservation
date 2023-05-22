<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:login.php');
    exit;
}
?>
<?php
require('vendor/autoload.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$server   = '172.16.12.70';
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

?>

<?php
// Démarrer la session
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
  $class = ""; if (isset($_POST['submit'])) {
    $valeur = $_POST['submit'];
    switch($valeur) {
        case 'bouton1':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','08:00:00','10:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                $topic = 'bdd';
                $message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                $mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
            }
            break;
        case 'bouton2':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','10:00:00','12:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
            }
            break;
        case 'bouton3':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','12:00:00','14:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
            }
            break;
        case 'bouton4':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','14:00:00','16:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
            }
            break;
        case 'bouton5':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','16:00:00','18:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
            }
            break;
        case 'bouton6':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','18:00:00','20:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
            }
            break;
        case 'bouton7':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','20:00:00','22:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
            }
            break;
        case 'bouton8':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','08:00:00','10:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
            }
            break;
        case 'bouton9':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','10:00:00','12:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
            }
            break;
        case 'bouton10':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','12:00:00','14:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
            }
            break;
        case 'bouton11':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','14:00:00','16:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
            }
            break;
        case 'bouton12':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','16:00:00','18:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
            }
            break;
        case 'bouton13':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','18:00:00','20:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
            }
            break;
        case 'bouton14':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','20:00:00','22:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
            }
            break;
        case 'bouton15':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','08:00:00','10:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
            }
            break;
        case 'bouton16':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','10:00:00','12:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
            }
            break;
        case 'bouton17':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','12:00:00','14:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
            }
            break;
        case 'bouton18':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','14:00:00','16:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
            }
            break;
        case 'bouton19':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','16:00:00','18:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
            }
            break;
        case 'bouton20':
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];
            
            if ($num_reservations > 0) {
                // Déjà reserver
                echo "<script>alert(\"Vous avez déjà une réservation.\");</script>";
            } else {
                // Insere la reservation dans la BDD
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','18:00:00','20:00:00')";
                mysqli_query($conn, $sql);
                
                // Publish the reservation message using MQTT
                //$topic = 'bdd';
                //$message = "2023-04-17, 08:00:00 à 10:00:00, 156LEF56";
                //$mqtt->publish($topic, $message, 0);
                
                // Display the success message in the browser
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
            }
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
    <link rel="icon" type="image/png" href="assets\img\parking.png">
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
        <?php
        $count_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' ";
        $result = mysqli_query($conn, $count_sql);
        $row = mysqli_fetch_assoc($result);
        $num_reservations = $row['num_reservations'];


        // Vérifier si l'utilisateur a déjà effectué sept réservations
                 if ($num_reservations >= 7) {
                     $class1 = "boutonrouge";
                 } else {
                     // Insérer la réservation dans la base de données
                     $class1 = "boutonnormal";}
                ; ?>
        <tr>                <form method="post">
            <td>
          
                <button name="submit" type="submit" value="bouton1" class="<?php echo $class; ?>">
                    08:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton8" >
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
                <button name="submit" type="submit" value="bouton2" class="<?php echo /*(date('H:i') > '10:00') ? 'boutonrouge' :*/ $class; ?>">
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
                <button name="submit" type="submit" value="bouton3" class="<?php echo /*(date('H:i') > '10:00') ? 'boutonrouge' :*/ $class; ?>">
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
                <button name="submit" type="submit" value="bouton4"class="<?php echo /*(date('H:i') > '10:00') ? 'boutonrouge' :*/ $class; ?>">
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
                <button name="submit" type="submit" value="bouton2" class="<?php echo (date('H:i') > '18:00') ? 'boutonrouge' : $class; ?>">
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
                <button name="submit" type="submit" value="bouton2" class="<?php echo (date('H:i') > '20:00') ? 'boutonrouge' : $class; ?>">
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