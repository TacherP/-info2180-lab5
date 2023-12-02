<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Check if country parameter is set
    if (isset($_GET['country']) && !empty($_GET['country'])) {
        $country = $_GET['country'];

        // Check if lookup parameter is set to 'cities'
        if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
            // City lookup using SQL join
            $stmt = $conn->prepare("SELECT cities.name AS City, countries.name AS Country
                                    FROM countries
                                    INNER JOIN cities ON countries.code = cities.countrycode
                                    WHERE countries.name LIKE :country");
        } else {
            // Country lookup using the original SQL query
            $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        }
        
try {
        $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Output the HTML table
        if (!empty($results)) {
            echo '<table border="1">';

            if ($_GET['lookup'] === 'cities') {
                echo '<tr><th>City</th><th>Country</th></tr>';
                foreach ($results as $row) {
                    // Adjust column names based on the lookup type
                    echo '<tr>';
                    echo '<td>' . (isset($row['City']) ? htmlspecialchars($row['City']) : '') . '</td>';
                    echo '<td>' . (isset($row['Country']) ? htmlspecialchars($row['Country']) : '') . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>';
                foreach ($results as $row) {
                    // Adjust column names based on the lookup type
                    echo '<tr>';
                    echo '<td>' . (isset($row['name']) ? htmlspecialchars($row['name']) : '') . '</td>';
                    echo '<td>' . (isset($row['continent']) ? htmlspecialchars($row['continent']) : '') . '</td>';
                    echo '<td>' . (isset($row['indepyear']) ? htmlspecialchars($row['indepyear']) : '') . '</td>';
                    echo '<td>' . (isset($row['headofstate']) ? htmlspecialchars($row['headofstate']) : '') . '</td>';
                    echo '</tr>';
                }
            }

            echo '</table>';
        } else {
            echo 'No matching ' . ($_GET['lookup'] === 'cities' ? 'cities' : 'countries') . ' found.';
        }
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
