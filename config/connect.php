<?php

$dsn = "mysql:host=localhost;dbname=jkvxncuh_clinic_dbase;charset=utf8";
$username = "jkvxncuh_etoileclinic";
$password = "Clinic@2025!#";

try {
	$conn = new PDO($dsn, $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	// Gracefully handle connection failure
	$conn = null;
	// Uncomment to see the error
	// echo "<div style='padding: 20px; background: #fee; color: #933; border: 1px solid #fcc;'>";
	// echo "Database Connection Error: " . $e->getMessage();
	// echo "</div>";
}

?>


<!-- Clinic@1995!# -->