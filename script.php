<?php require('vendor/autoload.php');

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
printf("client connected\n");

$topic = 'bdd';
$message = 'Bonjour hugo!';

$mqtt->publish($topic, $message, 0);

$mqtt->disconnect();
printf("client disconnected\n");
?>