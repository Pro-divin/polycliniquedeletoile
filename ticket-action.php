<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Only start session for actions that need auth — avoids session-lock delay on submit
$action = $_POST["action"] ?? $_GET["action"] ?? "";
if (in_array($action, ["dept_login","dept_logout","dept_list"])) {
    session_name('PCE_DEPT');
    session_set_cookie_params(['path' => '/', 'httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

require_once __DIR__ . "/config/connect.php";

if (!isset($conn) || $conn === null) {
    echo json_encode(["success" => false, "error" => "Database connection failed."]);
    exit;
}

$conn->exec("CREATE TABLE IF NOT EXISTS it_tickets (
    id VARCHAR(20) PRIMARY KEY,
    submitted DATETIME NOT NULL,
    department VARCHAR(100),
    from_dept VARCHAR(100),
    category VARCHAR(100),
    urgency VARCHAR(20),
    description TEXT,
    contact VARCHAR(200),
    status VARCHAR(50) DEFAULT 'New',
    notes TEXT,
    updated_at DATETIME NULL
)");
// Add from_dept column if upgrading from older schema
try { $conn->exec("ALTER TABLE it_tickets ADD COLUMN from_dept VARCHAR(100) AFTER department"); } catch(PDOException $e) {}

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
    $from = trim($_POST["from_dept"] ?? "");
    $stmt = $conn->prepare("INSERT INTO it_tickets (id,submitted,department,from_dept,category,urgency,description,contact,status) VALUES (?,NOW(),?,?,?,?,?,?,'New')");
    $stmt->execute([$id, $dept, $from, $cat, $urg, $desc, $cont]);
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

// ── DEPARTMENT LOGIN ──
$DEPT_ACCOUNTS = [
    'it@polycliniquedeletoile.com'        => ['password' => 'IT123',        'dept' => 'IT'],
    'finance@polycliniquedeletoile.com'   => ['password' => 'Finance123',   'dept' => 'Finance'],
    'hr@polycliniquedeletoile.com'        => ['password' => 'HR123',        'dept' => 'HR'],
    'logistics@polycliniquedeletoile.com' => ['password' => 'Logistics123', 'dept' => 'Logistics'],
];

if ($action === "dept_login") {
    $email = strtolower(trim($_POST["email"] ?? ""));
    $pass  = trim($_POST["password"] ?? "");
    if (isset($DEPT_ACCOUNTS[$email]) && $DEPT_ACCOUNTS[$email]['password'] === $pass) {
        $_SESSION['dept'] = $DEPT_ACCOUNTS[$email]['dept'];
        echo json_encode(["success" => true, "dept" => $_SESSION['dept']]);
    } else {
        echo json_encode(["success" => false, "error" => "Invalid email or password."]);
    }
    exit;
}

if ($action === "dept_logout") {
    session_destroy();
    echo json_encode(["success" => true]);
    exit;
}

if ($action === "dept_list") {
    if (empty($_SESSION['dept'])) {
        echo json_encode(["success" => false, "error" => "Unauthorized."]); exit;
    }
    $dept = $_SESSION['dept'];
    $stmt = $conn->prepare("SELECT * FROM it_tickets WHERE department = ? ORDER BY submitted DESC");
    $stmt->execute([$dept]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["success" => true, "dept" => $dept, "tickets" => $tickets]);
    exit;
}

// Key-based dept ticket fetch — no session needed, same pattern as IT 'list' action
if ($action === "dept_tickets") {
    if (($_GET["key"] ?? $_POST["key"] ?? "") !== "PCE_DEPT_2026") {
        echo json_encode(["success" => false, "error" => "Unauthorized."]); exit;
    }
    $validDepts = ['IT','Finance','HR','Logistics'];
    $dept = trim($_GET["dept"] ?? $_POST["dept"] ?? "");
    if (!in_array($dept, $validDepts)) {
        echo json_encode(["success" => false, "error" => "Invalid department."]); exit;
    }
    $stmt = $conn->prepare("SELECT * FROM it_tickets WHERE department = ? ORDER BY submitted DESC");
    $stmt->execute([$dept]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["success" => true, "tickets" => $tickets]);
    exit;
}

if ($action === "dept_update") {
    $validDepts = ['IT','Finance','HR','Logistics'];
    $dept = trim($_POST["dept"] ?? $_SESSION['dept'] ?? "");
    if (!in_array($dept, $validDepts)) {
        echo json_encode(["success" => false, "error" => "Unauthorized."]); exit;
    }
    $allowed = ["New","Acknowledged","In Progress","Waiting for Employee","Resolved"];
    $status  = trim($_POST["status"] ?? "");
    $notes   = trim($_POST["notes"]  ?? "");
    $id      = strtoupper(trim($_POST["id"] ?? ""));
    if (!in_array($status, $allowed)) {
        echo json_encode(["success" => false, "error" => "Invalid status."]); exit;
    }
    $stmt = $conn->prepare("UPDATE it_tickets SET status=?, notes=?, updated_at=NOW() WHERE id=? AND department=?");
    $stmt->execute([$status, $notes, $id, $dept]);
    echo json_encode(["success" => true]);
    exit;
}

echo json_encode(["success" => false, "error" => "Unknown action."]);
