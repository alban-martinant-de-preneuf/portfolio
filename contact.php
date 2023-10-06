<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// set of variables to store the data sent by the user
$name = $_POST['name'];
$mailFrom = $_POST['email'];
$message = $_POST['message'];
$ip = isset($_SERVER['HTTP_CLIENT_IP'])
    ? $_SERVER['HTTP_CLIENT_IP']
    : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
        ? $_SERVER['HTTP_X_FORWARDED_FOR']
        : $_SERVER['REMOTE_ADDR']);

$mailConf = parse_ini_file('config' . DIRECTORY_SEPARATOR . 'mailconf.ini');

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $mailConf['host'];                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $mailConf['username'];                     //SMTP username
    $mail->Password   = $mailConf['password'];                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($mailFrom, 'Portfolio');
    $mail->addAddress('alban.martinant-de-preneuf@laplateforme.io');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Message du Portfolio';

    ob_start(); ?>

    <h2>Message de <?= $name; ?></h2>
    <h4><?= $mailFrom; ?></h4>
    <p><?= $message; ?></p>
    <p>ip: <?= $ip; ?></p>
    
    <?php 

    $mail->Body = ob_get_clean();
    $mail->AltBody = 'Message de ' . $name . ' (' . $mailFrom . ') : ' . $message . ' (ip: ' . $ip . ')';

    $mail->send();
    echo json_encode([
        'success' => true,
        'message' => 'Votre message a bien été envoyé'
    ]);
} catch (Exception $e) {
    echo json_encode(
        [
            'success' => false,
            'message' => 'Une erreur est survenue, veuillez réessayer plus tard',
            'debug' => '$e->getMessage: ' . $e->getMessage() . ', $mail->ErrorInfo: ' . $mail->ErrorInfo
        ]
    );
}

// /**
//  * Connect to database
//  *
//  * @return PDO|false
//  */
// function connectToDatabase(): PDO|false
// {
//     try {
//         // get database infos from ini file in config folder
//         $db_config = parse_ini_file('config' . DIRECTORY_SEPARATOR . 'db.ini');
//         // define PDO dsn with retrieved data
//         $db = new PDO($db_config['type'] . ':dbname=' . $db_config['name']
//             . ';host=' . $db_config['host']
//             . ';charset=' . $db_config['charset'], $db_config['user'], $db_config['password']);
//         // prevent emulation of prepared requests
//         $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//         return $db;
//     } catch (\PDOException $e) {
//         echo $e->getMessage();
//         return false;
//     }
// }

// /**
//  * Check if the user has already sent 5 messages in the last 24 hours
//  *
//  * @return boolean
//  */
// function checkIp(): bool
// {
//     try {
//         $ip = isset($_SERVER['HTTP_CLIENT_IP'])
//             ? $_SERVER['HTTP_CLIENT_IP']
//             : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
//                 ? $_SERVER['HTTP_X_FORWARDED_FOR']
//                 : $_SERVER['REMOTE_ADDR']);

//         $db = connectToDatabase();
//         $query = $db->prepare('SELECT COUNT(*) FROM message WHERE ip = :ip AND date > DATE_SUB(NOW(), INTERVAL 1 DAY)');
//         $query->bindParam(':ip', $ip);
//         $query->execute();
//         $result = $query->fetch(PDO::FETCH_ASSOC);
//         return $result['COUNT(*)'] < 5;
//     } catch (\PDOException $e) {
//         echo $e->getMessage();
//         return false;
//     }
// }

// if (isset($_POST['message'])) {
//     if (!checkIp()) {
//         echo json_encode(
//             [
//                 'success' => false,
//                 'message' => 'Vous avez déjà envoyé 5 messages aujourd\'hui, réessayez dans 24h'
//             ]
//         );
//         return;
//     }
//     try {
//         $ip = isset($_SERVER['HTTP_CLIENT_IP'])
//             ? $_SERVER['HTTP_CLIENT_IP']
//             : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
//                 ? $_SERVER['HTTP_X_FORWARDED_FOR']
//                 : $_SERVER['REMOTE_ADDR']);

//         // $date = date('Y-m-d H:i:s');
//         $name = $_POST['name'];
//         $mailFrom = $_POST['email'];
//         $message = $_POST['message'];

//         $db = connectToDatabase();
//         $query = $db->prepare('INSERT INTO message (name, mail, content, ip, date) VALUES (:name, :mail, :message, :ip, NOW())');
//         $query->bindParam(':name', $name);
//         $query->bindParam(':mail', $mailFrom);
//         $query->bindParam(':message', $message);
//         $query->bindParam(':ip', $ip);
//         // $query->bindParam(':date', $date);
//         $query->execute();
//         echo json_encode([
//             'success' => true,
//             'message' => 'Votre message a bien été envoyé'
//         ]);
//     } catch (\PDOException $e) {
//         echo json_encode(
//             [
//                 'success' => false,
//                 'message' => 'Une erreur est survenue, veuillez réessayer plus tard',
//                 'debug' => $e->getMessage()
//             ]
//         );
//     }
// }
