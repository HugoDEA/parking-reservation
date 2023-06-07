const mqtt = require('mqtt');
const mysql = require('mysql');

// Connexion à la base de données
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Parking852!',
    database: 'parking'
});

// Connexion au serveur MQTT
const client = mqtt.connect('mqtt://192.168.137.246', {
    username: 'admin',
    password: '1234'
});

// Abonnement aux sujets MQTT souhaités
const topic1 = 'etage1';
const topic2 = 'etage2';
const validationTopic = 'validation';

// Variable pour vérifier si le numéro a déjà été traité
let isProcessed = false;

setInterval(() => {
    isProcessed = false;
    console.log("La variable isProcessed est maintenant false.");
}, 10000);

client.on('connect', () => {
    client.subscribe(topic1);
    client.subscribe(topic2);
    client.subscribe(validationTopic);
    console.log('Connecté au broker MQTT et abonné aux sujets', topic1, ',', topic2, 'et', validationTopic);
});

client.on('message', (topic, message) => {
    if (topic === validationTopic) {
        try {
            const rfid = message.toString().trim(); // Supprimer les espaces inutiles

            // Vérifier si le numéro a déjà été traité
            if (isProcessed) {
                console.log('Numéro déjà traité :', rfid);
                return;
            }

            const currentTime = new Date();

            // Requête SQL pour vérifier si le RFID est valide
            const sql = `SELECT COUNT(*) AS count FROM reservation WHERE rfid = '${rfid}' AND date = '${currentTime.toISOString().split('T')[0]}' AND starting_hour <= '${currentTime.getHours()}:${currentTime.getMinutes()}:${currentTime.getSeconds()}' AND finishing_hour >= '${currentTime.getHours()}:${currentTime.getMinutes()}:${currentTime.getSeconds()}'`;

            connection.query(sql, (error, results) => {
                if (error) {
                    console.error('Erreur lors de la recherche dans la base de données :', error);
                } else {
                    const count = results[0].count;
                    const response = count > 0 ? 'oui' : 'non';
                    client.publish(validationTopic, response, { qos: 0 }); // Publier la réponse dans le topic de validation avec une qualité de service de 0
                    console.log('Message envoyé :', response);

                    // Définir la variable isProcessed à true pour indiquer que le numéro a été traité
                    isProcessed = true;
                }
            });
        } catch (error) {
            console.error('Erreur lors du traitement du message MQTT :', error);
        }
    } else {
        let sql;
        if (topic === topic1) {
            sql = `UPDATE status SET floor1_available = '${message}'`;
        } else if (topic === topic2) {
            sql = `UPDATE status SET floor2_available = '${message}'`;
        } else {
            console.log('Sujet MQTT inconnu :', topic);
            return;
        }

        connection.query(sql, (error, results) => {
            if (error) {
                console.error('Erreur lors de la mise à jour de la valeur dans la base de données :', error);
            } else {
                console.log('Valeur mise à jour avec succès dans la base de données.');
            }
        });
    }
});

connection.on('error', (error) => {
    console.error('Erreur de connexion à la base de données :', error);
});

client.on('close', () => {
    if (connection && connection.state !== 'disconnected') {
        connection.end();
    }
    console.log('Déconnecté du broker MQTT.');
});

process.on('SIGINT', () => {
    client.end();
    if (connection && connection.state !== 'disconnected') {
        connection.end();
    }
    console.log('Arrêt du script.');
});
