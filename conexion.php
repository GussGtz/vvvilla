<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'sm52_arduino';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT temperatura, humedad FROM RegistroAmbiente ORDER BY id DESC LIMIT 100";
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['sensorDHT' => $data]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Could not connect. " . $e->getMessage()]);
}
?>
