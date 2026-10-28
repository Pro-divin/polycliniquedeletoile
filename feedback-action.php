<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$action = $_POST["action"] ?? $_GET["action"] ?? "";

require_once __DIR__ . "/config/connect.php";

if (!isset($conn) || $conn === null) {
    echo json_encode(["success" => false, "error" => "Database connection failed."]);
    exit;
}

// Create feedback table if it doesn't exist
$conn->exec("CREATE TABLE IF NOT EXISTS patient_feedback (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    submitted    DATETIME NOT NULL,
    department   VARCHAR(100),
    visit_date   DATE NULL,
    visit_time   VARCHAR(50),
    rating_overall TINYINT,
    rating_staff   TINYINT,
    rating_clean   TINYINT,
    rating_wait    TINYINT,
    went_well    TEXT,
    improve      TEXT,
    recommend    VARCHAR(10),
    patient_name VARCHAR(150),
    patient_contact VARCHAR(200)
)");

if ($action === "submit_feedback") {
    $dept    = trim($_POST["department"]      ?? "");
    $well    = trim($_POST["went_well"]       ?? "");
    $overall = intval($_POST["rating_overall"] ?? 0);

    if (!$well || !$overall) {
        echo json_encode(["success" => false, "error" => "Missing required fields."]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO patient_feedback
        (submitted, department, visit_date, visit_time, rating_overall, rating_staff, rating_clean, rating_wait, went_well, improve, recommend, patient_name, patient_contact)
        VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $visitDate = $_POST["visit_date"] ?? null;
    if (empty($visitDate)) $visitDate = null;

    $stmt->execute([
        $dept,
        $visitDate,
        trim($_POST["visit_time"]       ?? ""),
        $overall,
        intval($_POST["rating_staff"]   ?? 0) ?: null,
        intval($_POST["rating_clean"]   ?? 0) ?: null,
        intval($_POST["rating_wait"]    ?? 0) ?: null,
        $well,
        trim($_POST["improve"]          ?? ""),
        trim($_POST["recommend"]        ?? ""),
        trim($_POST["patient_name"]     ?? ""),
        trim($_POST["patient_contact"]  ?? ""),
    ]);

    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["success" => false, "error" => "Unknown action."]);
