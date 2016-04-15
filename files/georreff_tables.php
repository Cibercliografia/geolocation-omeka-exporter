<?php
$servername = "xxxxx";
$username = "xxxxx";
$password = "xxxxx";
$dbname = "xxxxx";

echo "<table style='border: solid 1px black;'>";
  echo "<tr><th></th><th></th><th>Latitud</th><th>Longitud</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Título</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
     function __construct($it) { 
         parent::__construct($it, self::LEAVES_ONLY); 
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() { 
         echo "<tr>"; 
     } 

     function endChildren() { 
         echo "</tr>" . "\n";
     } 
}

try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare("SELECT * FROM `omeka_locations`, `omeka_element_texts` WHERE omeka_element_texts.record_type = \"item\" AND omeka_element_texts.element_id = 50 AND omeka_locations.item_id = omeka_element_texts.record_id"); 
     $stmt->execute();

     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

     
     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
         echo $v;
     }
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

?>
