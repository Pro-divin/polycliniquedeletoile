<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once __DIR__ . "/config/connect.php";

if (!isset($conn) || $conn === null) {
    echo json_encode(["success" => false, "error" => "Database connection failed."]);
    exit;
}

$conn->exec("CREATE TABLE IF NOT EXISTS it_tickets (
    id VARCHAR(20) PRIMARY KEY,
    submitted DATETIME NOT NULL,
    department VARCHAR(100),
    category VARCHAR(100),
    urgency VARCHAR(20),
    description TEXT,
    contact VARCHAR(200),
    status VARCHAR(50) DEFAULT 'New',
    notes TEXT,
    updated_at DATETIME NULL
)");

$action = $_POST["action"] ?? $_GET["action"] ?? "";

if ($action === "submit") {
    $dept = trim($_POST["department"] ?? "");
    $cat  = trim($_POST["category"]   ?? "");
    $urg  = trim($_POST["urgency"]    ?? "");
    $desc = trim($_POST["description"] ?? "");
    $cont = trim($_POST["contact"]    ?? "");
    if (!$dept || !$cat || !$urg || !$desc) {
        echo json_encode(["success" => false, "error" => "Missing required fields."]);
        exit;
    }
    $row  = $conn->query("SELECT id FROM it_tickets ORDER BY submitted DESC LIMIT 1")->fetch();
    $last = $row ? intval(substr($row["id"], 3)) : 1000;
    $id   = "IT-" . ($last + 1);
    $stmt = $conn->prepare("INSERT INTO it_tickets (id,submitted,department,category,urgency,description,contact,status) VALUES (?,NOW(),?,?,?,?,?,'New')");
    $stmt->execute([$id, $dept, $cat, $urg, $desc, $cont]);
    echo json_encode(["success" => true, "ticket_id" => $id]);
    exit;
}

if ($action === "check") {
    $id = strtoupper(trim($_GET["id"] ?? ""));
    $stmt = $conn->prepare("SELECT * FROM it_tickets WHERE id = ?");
    $stmt->execute([$id]);
    $t = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $t ? json_encode(["success" => true, "ticket" => $t]) : json_encode(["success" => false, "error" => "Ticket not found."]);
    exit;
}

if ($action === "list") {
    if (($_GET["key"] ?? "") !== "PCE_IT_2026") {
        echo json_encode(["success" => false, "error" => "Unauthorized."]); exit;
    }
    $tickets = $conn->query("SELECT * FROM it_tickets ORDER BY FIELD(urgency,'Critical','High','Normal','Low'), submitted DESC")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["success" => true, "tickets" => $tickets]);
    exit;
}

if ($action === "update") {
    if (($_POST["key"] ?? "") !== "PCE_IT_2026") {
        echo json_encode(["success" => false, "error" => "Unauthorized."]); exit;
    }
    $allowed = ["New","Acknowledged","In Progress","Waiting for Employee","Resolved"];
    $status  = trim($_POST["status"] ?? "");
    $notes   = trim($_POST["notes"]  ?? "");
    $id      = strtoupper(trim($_POST["id"] ?? ""));
    if (!in_array($status, $allowed)) {
        echo json_encode(["success" => false, "error" => "Invalid status."]); exit;
    }
    $stmt = $conn->prepare("UPDATE it_tickets SET status=?, notes=?, updated_at=NOW() WHERE id=?");
    $stmt->execute([$status, $notes, $id]);
    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["success" => false, "error" => "Unknown action."]);
