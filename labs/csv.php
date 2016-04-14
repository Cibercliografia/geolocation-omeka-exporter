<?php
$servername = "xxxxx";
$username = "xxxxx";
$password = "xxxxx";
$dbname = "xxxxx";

// connect with db
$conn = new mysqli($servername, $username, $password, $dbname);
// check connection
if ($conn->connect_error) {
     die(":\ Falló la conexión: " . $conn->connect_error);
} 

$sql = "SELECT omeka_element_texts.text, omeka_locations.address, omeka_locations.latitude, omeka_locations.longitude FROM `omeka_locations`, `omeka_element_texts` WHERE omeka_element_texts.record_type = \"item\" AND omeka_element_texts.element_id = 50 AND omeka_locations.item_id = omeka_element_texts.record_id";
    $result = $conn->query($sql);
    
// convert mysql to csv
    
 $fp = fopen('export.csv', 'w');

    while($row = $result->fetch_assoc())
    {
        fputcsv($fp, $row);
    }

    fclose($fp);

?>
