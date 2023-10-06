<?php

/**
 * Connect to database
 *
 * @return PDO|false
 */
function connectToDatabase(): PDO|false
{
    try {
        // get database infos from ini file in config folder
        $db_config = parse_ini_file('config' . DIRECTORY_SEPARATOR . 'db.ini');
        // define PDO dsn with retrieved data
        $db = new PDO($db_config['type'] . ':dbname=' . $db_config['name']
            . ';host=' . $db_config['host']
            . ';charset=' . $db_config['charset'], $db_config['user'], $db_config['password']);
        // prevent emulation of prepared requests
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    } catch (\PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

/**
 * register visitor ip and time
 *
 * @return void
 */
function visitorRegister()
{
    $db = connectToDatabase();
    $ip = isset($_SERVER['HTTP_CLIENT_IP'])
        ? $_SERVER['HTTP_CLIENT_IP']
        : (isset($_SERVER['HTTP_X_FORWARDED_FOR'])
            ? $_SERVER['HTTP_X_FORWARDED_FOR']
            : $_SERVER['REMOTE_ADDR']);

    $query = $db->prepare('INSERT INTO visitor (ip, time) VALUES (:ip, NOW())');
    $query->bindValue(':ip', $ip, PDO::PARAM_STR);
    $query->execute();
}

visitorRegister();