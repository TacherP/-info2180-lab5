<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = $_GET['country'];
$stmt = $conn->query("SELECT * FROM countries");

if (isset($country) && !empty($country)) {
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Use a prepared statement to avoid SQL injection
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo '<ul>';
        foreach ($results as $row) {
            echo '<li>' . htmlspecialchars($row['name']) . ' is ruled by ' . htmlspecialchars($row['head_of_state']) . '</li>';
        }
        echo '</ul>';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

