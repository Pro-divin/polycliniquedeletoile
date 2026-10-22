<?php
session_name('PCE_DEPT');
session_set_cookie_params(['path' => '/', 'httponly' => true, 'samesite' => 'Lax']);
session_start();
if (empty($_SESSION['dept'])) { header('Location: dept-login.php'); exit; }

$dept = $_SESSION['dept'];

// Per-department colours and icons
$deptMeta = [
    'IT'       => ['color'=>'#1565C0','dark'=>'#0D47A1','light'=>'#E3F2FD','icon'=>'fa-laptop',        'label'=>'IT Department'],
    'Finance'  => ['color'=>'#2E7D32','dark'=>'#1B5E20','light'=>'#E8F5E9','icon'=>'fa-money',          'label'=>'Finance Department'],
    'HR'       => ['color'=>'#E65100','dark'=>'#BF360C','light'=>'#FFF3E0','icon'=>'fa-users',           'label'=>'Human Resources'],
    'Logistics'=> ['color'=>'#6A1B9A','dark'=>'#4A148C','light'=>'#F3E5F5','icon'=>'fa-truck',          'label'=>'Logistics Department'],
];
$m = $deptMeta[$dept] ?? ['color'=>'#198754','dark'=>'#146c43','light'=>'#d1e7dd','icon'=>'fa-inbox','label'=>$dept.' Department'];

// Load tickets directly from DB
require_once __DIR__ . '/config/connect.php';
$tickets = [];
if (!empty($conn)) {
    $stmt = $conn->prepare("SELECT * FROM it_tickets WHERE department = ? ORDER BY submitted DESC");
    $stmt->execute([$dept]);
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($m['label']) ?> Dashboard — Polyclinique de l'Etoile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: <?= $m['color'] ?>;
            --primary-dark: <?= $m['dark'] ?>;
            --primary-light: <?= $m['light'] ?>;
        }
        body { font-family:'Open Sans',sans-serif; background:#f0f4f8; margin:0; }

        .topbar {
            background:#0a0a0a; color:#ccc; font-size:12.5px;
            padding:8px 28px; display:flex; justify-content:space-between; align-items:center;
        }
        .topbar-brand { font-family:'Playfair Display',serif; color:#fff; font-size:13px; font-weight:600; }

        .dash-header {
            background:var(--primary); color:#fff;
            padding:20px 32px; display:flex; align-items:center;
            justify-content:space-between; flex-wrap:wrap; gap:14px;
            box-shadow:0 4px 20px rgba(0,0,0,0.18);
        }
        .dash-header-left { display:flex; align-items:center; gap:16px; }
        .header-icon {
            background:rgba(255,255,255,0.15); border-radius:10px;
            width:48px; height:48px; display:flex; align-items:center; justify-content:center;
        }
        .dash-header h1 { font-family:'Playfair Display',serif; font-size:1.35rem; font-weight:700; margin:0 0 2px; }
        .dash-header p  { margin:0; font-size:12.5px; opacity:.8; }
        .logout-btn {
            background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.3);
            color:#fff; border-radius:6px; padding:7px 18px; font-size:13px;
            cursor:pointer; font-weight:600; transition:background .2s;
        }
        .logout-btn:hover { background:rgba(255,255,255,0.25); }

        .page-wrap { max-width:1200px; margin:28px auto 60px; padding:0 16px; }

        .stat-tile {
            background:#fff; border-radius:10px; padding:20px 22px;
            box-shadow:0 3px 18px rgba(0,0,0,0.07);
            display:flex; align-items:center; gap:16px;
            cursor:pointer; transition:transform .15s, box-shadow .15s;
        }
        .stat-tile:hover { transform:translateY(-2px); box-shadow:0 6px 24px rgba(0,0,0,0.13); }
        .stat-icon { width:46px; height:46px; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .stat-icon i { font-size:20px; color:#fff; }
        .stat-tile h3 { font-family:'Playfair Display',serif; font-size:1.7rem; font-weight:700; margin:0; color:#1a1a2e; }
        .stat-tile p  { margin:0; font-size:11.5px; color:#777; text-transform:uppercase; letter-spacing:.8px; }

        .filter-bar {
            background:#fff; border-radius:10px; padding:16px 20px;
            box-shadow:0 3px 18px rgba(0,0,0,0.07);
            display:flex; flex-wrap:wrap; gap:12px; align-items:center;
        }
        .filter-bar select, .filter-bar input {
            border:1.5px solid #d4dae3; border-radius:6px;
            padding:7px 12px; font-size:13px; color:#333; transition:border-color .2s;
        }
        .filter-bar select:focus, .filter-bar input:focus { border-color:var(--primary); outline:none; }
        .filter-bar label { font-size:12px; font-weight:600; color:#555; margin-bottom:0; }
        .btn-refresh {
            background:var(--primary); color:#fff; border:none; border-radius:6px;
            padding:8px 16px; font-size:13px; font-weight:600; cursor:pointer;
            display:flex; align-items:center; gap:6px; transition:background .2s;
        }
        .btn-refresh:hover { background:var(--primary-dark); }

        .tickets-card { background:#fff; border-radius:10px; box-shadow:0 3px 18px rgba(0,0,0,0.07); overflow:hidden; }
        .tickets-card-header {
            padding:18px 22px; border-bottom:1px solid #eaeef4;
            display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;
        }
        .tickets-card-header h5 { font-family:'Playfair Display',serif; font-size:1.05rem; font-weight:700; color:#1a1a2e; margin:0; }
        table { width:100%; border-collapse:collapse; }
        thead th {
            background:#f8f9ff; padding:11px 14px; font-size:11.5px;
            font-weight:700; color:#555; text-transform:uppercase; letter-spacing:.8px;
            border-bottom:1.5px solid #eaeef4; white-space:nowrap;
        }
        tbody tr { border-bottom:1px solid #f0f4f8; transition:background .15s; }
        tbody tr:hover { background:#fafbff; }
        tbody td { padding:12px 14px; font-size:13px; color:#333; vertical-align:middle; }
        .ticket-id { font-weight:700; color:var(--primary); font-size:12.5px; }

        .badge-status, .badge-urgency {
            display:inline-block; border-radius:5px;
            padding:3px 10px; font-size:11.5px; font-weight:700; white-space:nowrap;
        }
        .s-new          { background:#E3F2FD; color:#1565C0; }
        .s-acknowledged { background:#FFF8E1; color:#F57F17; }
        .s-inprogress   { background:#E8F5E9; color:#2E7D32; }
        .s-waiting      { background:#F3E5F5; color:#6A1B9A; }
        .s-resolved     { background:#EFEBE9; color:#4E342E; }
        .u-low      { background:#E8F5E9; color:#2E7D32; }
        .u-normal   { background:#FFF3E0; color:#E65100; }
        .u-high     { background:#FFEBEE; color:#C62828; }
        .u-critical { background:#4a0000; color:#fff; }

        .status-select {
            border:1.5px solid #d4dae3; border-radius:6px;
            padding:5px 8px; font-size:12.5px; font-weight:600;
            cursor:pointer; background:#fff; transition:border-color .2s; min-width:155px;
        }
        .status-select:focus { border-color:var(--primary); outline:none; }

        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:9998; align-items:center; justify-content:center; }
        .modal-overlay.open { display:flex; }
        .modal-card { background:#fff; border-radius:12px; max-width:540px; width:100%; margin:16px; box-shadow:0 20px 60px rgba(0,0,0,0.25); overflow:hidden; }
        .modal-top { background:var(--primary); color:#fff; padding:18px 22px; display:flex; align-items:center; justify-content:space-between; }
        .modal-top h5 { font-family:'Playfair Display',serif; margin:0; font-size:1.1rem; }
        .modal-close { background:none; border:none; color:#fff; font-size:22px; cursor:pointer; line-height:1; }
        .modal-body { padding:24px 22px; }
        .detail-row { display:flex; gap:10px; margin-bottom:14px; }
        .detail-key { font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:.7px; min-width:120px; flex-shrink:0; padding-top:2px; }
        .detail-val { font-size:13.5px; color:#1a1a2e; }
        .modal-body textarea { width:100%; border:1.5px solid #d4dae3; border-radius:7px; padding:10px 12px; font-size:13px; resize:vertical; min-height:80px; font-family:'Open Sans',sans-serif; margin-top:4px; }
        .modal-body textarea:focus { border-color:var(--primary); outline:none; }
        .modal-footer-btns { display:flex; gap:10px; justify-content:flex-end; padding:0 22px 20px; }
        .btn-save { background:var(--primary); color:#fff; border:none; border-radius:7px; padding:10px 24px; font-size:14px; font-weight:700; font-family:'Playfair Display',serif; cursor:pointer; transition:background .2s; }
        .btn-save:hover { background:var(--primary-dark); }
        .btn-cancel { background:#fff; color:#555; border:1.5px solid #d4dae3; border-radius:7px; padding:10px 20px; font-size:14px; font-weight:600; cursor:pointer; transition:border-color .2s; }
        .btn-cancel:hover { border-color:var(--primary); color:var(--primary); }

        .empty-state { text-align:center; padding:48px 20px; color:#aaa; }
        .empty-state i { font-size:42px; margin-bottom:14px; display:block; color:#ccd; }
        .empty-state p { font-size:14px; }

        #toast {
            position:fixed; bottom:28px; right:28px; z-index:99999;
            background:var(--primary); color:#fff; border-radius:8px;
            padding:12px 22px; font-size:13.5px; font-weight:600;
            box-shadow:0 8px 30px rgba(0,0,0,0.2);
            transform:translateY(80px); opacity:0;
            transition:transform .3s, opacity .3s;
            display:flex; align-items:center; gap:10px;
        }
        #toast.show { transform:translateY(0); opacity:1; }

        @media(max-width:768px){
            thead { display:none; }
            tbody tr { display:block; border:1px solid #eaeef4; border-radius:8px; margin-bottom:10px; }
            tbody td { display:flex; justify-content:space-between; align-items:center; padding:8px 12px; border:none; font-size:12.5px; }
            tbody td::before { content:attr(data-label); font-weight:700; color:#888; font-size:11px; text-transform:uppercase; }
        }
    </style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar">
    <span class="topbar-brand"><i class="fa fa-hospital-o me-2" style="color:var(--primary);"></i>Polyclinique de l'Etoile</span>
    <span><i class="fa fa-map-marker me-1" style="color:var(--primary);"></i> Gasabo, Remera, Rukiri I &nbsp;|&nbsp; <i class="fa fa-phone me-1" style="color:var(--primary);"></i> Free Call 1301</span>
</div>

<!-- HEADER -->
<div class="dash-header">
    <div class="dash-header-left">
        <div class="header-icon"><i class="fa <?= $m['icon'] ?>" style="font-size:22px;"></i></div>
        <div>
            <h1><?= htmlspecialchars($m['label']) ?> Dashboard</h1>
            <p>Polyclinique de l'Etoile &mdash; <?= htmlspecialchars($m['label']) ?> Ticket Management</p>
        </div>
    </div>
    <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
        <a href="index.php" style="color:rgba(255,255,255,0.8); font-size:13px; text-decoration:none;">
            <i class="fa fa-external-link me-1"></i>Employee Form
        </a>
        <a href="dept-login.php?logout=1" class="logout-btn" style="text-decoration:none;">
            <i class="fa fa-sign-out me-1"></i>Sign Out
        </a>
    </div>
</div>

<!-- PAGE BODY -->
<div class="page-wrap">

    <!-- STAT TILES -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('all')" title="Show all tickets">
                <div class="stat-icon" style="background:var(--primary);"><i class="fa fa-ticket"></i></div>
                <div><h3 id="st-total">0</h3><p>Total Tickets</p></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('open')" title="Show open tickets">
                <div class="stat-icon" style="background:#E65100;"><i class="fa fa-exclamation-circle"></i></div>
                <div><h3 id="st-open">0</h3><p>Open</p></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('resolved')" title="Show resolved tickets">
                <div class="stat-icon" style="background:#2E7D32;"><i class="fa fa-check-circle"></i></div>
                <div><h3 id="st-resolved">0</h3><p>Resolved</p></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('critical')" title="Show critical tickets">
                <div class="stat-icon" style="background:#4a0000;"><i class="fa fa-warning"></i></div>
                <div><h3 id="st-critical">0</h3><p>Critical</p></div>
            </div>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar mb-4">
        <div>
            <label>Status</label><br>
            <select id="filterStatus" onchange="renderTable()">
                <option value="">All Statuses</option>
                <option>New</option><option>Acknowledged</option>
                <option>In Progress</option><option>Waiting for Employee</option><option>Resolved</option>
            </select>
        </div>
        <div>
            <label>Urgency</label><br>
            <select id="filterUrgency" onchange="renderTable()">
                <option value="">All Urgencies</option>
                <option>Critical</option><option>High</option><option>Normal</option><option>Low</option>
            </select>
        </div>
        <div>
            <label>From Department</label><br>
            <select id="filterFrom" onchange="renderTable()">
                <option value="">All</option>
            </select>
        </div>
        <div>
            <label>Search</label><br>
            <input type="text" id="filterSearch" placeholder="Ticket # or keyword…" oninput="renderTable()" style="width:180px;">
        </div>
        <div style="margin-top:auto;">
            <button class="btn-refresh" onclick="window.location.reload()">
                <i class="fa fa-refresh"></i> Refresh
            </button>
        </div>
    </div>

    <!-- TICKET TABLE -->
    <div class="tickets-card">
        <div class="tickets-card-header">
            <h5><i class="fa fa-list me-2" style="color:var(--primary);"></i>Support Tickets</h5>
            <span id="ticketCount" style="font-size:12.5px; color:#888;"></span>
        </div>
        <div style="overflow-x:auto;">
            <table id="ticketTable">
                <thead>
                    <tr>
                        <th>Ticket #</th>
                        <th>Date &amp; Time</th>
                        <th>From Dept</th>
                        <th>Issue Type</th>
                        <th>Urgency</th>
                        <th>Status</th>
                        <th>Update Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody id="ticketBody"></tbody>
            </table>
        </div>
    </div>

</div>

<!-- DETAIL MODAL -->
<div class="modal-overlay" id="detailModal">
    <div class="modal-card">
        <div class="modal-top">
            <h5 id="modalTitle">Ticket Details</h5>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="modalContent"></div>
            <div style="margin-top:16px;">
                <label style="font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:.7px;">Notes / Response</label>
                <textarea id="modalNotes" placeholder="Add notes or a response for the employee…"></textarea>
            </div>
            <div style="margin-top:14px;">
                <label style="font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:.7px; display:block; margin-bottom:6px;">Update Status</label>
                <select id="modalStatus" class="status-select" style="width:100%;">
                    <option>New</option><option>Acknowledged</option>
                    <option>In Progress</option><option>Waiting for Employee</option><option>Resolved</option>
                </select>
            </div>
        </div>
        <div class="modal-footer-btns">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-save" onclick="saveModal()"><i class="fa fa-save me-1"></i>Save Changes</button>
        </div>
    </div>
</div>

<!-- TOAST -->
<div id="toast"><i class="fa fa-check-circle"></i><span id="toastMsg"></span></div>

<script>
var allTickets  = <?= json_encode(array_values($tickets)) ?>;
var DEPT        = <?= json_encode($dept) ?>;
var currentModal = null;
var cardFilter   = null;

// ── INIT ──
populateFromFilter();
updateStats();
renderTable();
setInterval(function(){ window.location.reload(); }, 60000);

// ── STATS ──
function updateStats() {
    document.getElementById('st-total').textContent    = allTickets.length;
    document.getElementById('st-open').textContent     = allTickets.filter(function(t){ return t.status !== 'Resolved'; }).length;
    document.getElementById('st-resolved').textContent = allTickets.filter(function(t){ return t.status === 'Resolved'; }).length;
    document.getElementById('st-critical').textContent = allTickets.filter(function(t){ return t.urgency === 'Critical'; }).length;
}

function populateFromFilter() {
    var sel = document.getElementById('filterFrom');
    var depts = [];
    allTickets.forEach(function(t){ if (t.from_dept && depts.indexOf(t.from_dept) === -1) depts.push(t.from_dept); });
    depts.sort().forEach(function(d){
        var o = document.createElement('option'); o.value = d; o.textContent = d; sel.appendChild(o);
    });
}

function filterByCard(type) {
    cardFilter = type === 'all' ? null : type;
    document.getElementById('filterStatus').value  = '';
    document.getElementById('filterUrgency').value = type === 'critical' ? 'Critical' : '';
    document.getElementById('filterFrom').value    = '';
    document.getElementById('filterSearch').value  = '';
    renderTable();
}

// ── STATUS HELPERS ──
function statusClass(s) {
    if (s === 'New')                  return 's-new';
    if (s === 'Acknowledged')         return 's-acknowledged';
    if (s === 'In Progress')          return 's-inprogress';
    if (s === 'Waiting for Employee') return 's-waiting';
    if (s === 'Resolved')             return 's-resolved';
    return '';
}
function urgencyClass(u) {
    if (u === 'Low')      return 'u-low';
    if (u === 'Normal')   return 'u-normal';
    if (u === 'High')     return 'u-high';
    if (u === 'Critical') return 'u-critical';
    return '';
}

// ── RENDER TABLE ──
function renderTable() {
    var fStatus  = document.getElementById('filterStatus').value;
    var fUrgency = document.getElementById('filterUrgency').value;
    var fFrom    = document.getElementById('filterFrom').value;
    var fSearch  = document.getElementById('filterSearch').value.toLowerCase();

    var filtered = allTickets.filter(function(t) {
        if (cardFilter === 'open'     && t.status === 'Resolved')  return false;
        if (cardFilter === 'resolved' && t.status !== 'Resolved')  return false;
        if (fStatus  && t.status    !== fStatus)   return false;
        if (fUrgency && t.urgency   !== fUrgency)  return false;
        if (fFrom    && t.from_dept !== fFrom)      return false;
        if (fSearch  && !(
            (t.id||'').toLowerCase().includes(fSearch) ||
            (t.description||'').toLowerCase().includes(fSearch) ||
            (t.from_dept||'').toLowerCase().includes(fSearch) ||
            (t.category||'').toLowerCase().includes(fSearch)
        )) return false;
        return true;
    });

    filtered.sort(function(a,b){ return new Date(b.submitted) - new Date(a.submitted); });

    document.getElementById('ticketCount').textContent = filtered.length + ' ticket' + (filtered.length !== 1 ? 's' : '') + ' shown';

    var tbody = document.getElementById('ticketBody');
    if (!filtered.length) {
        tbody.innerHTML = '<tr><td colspan="8"><div class="empty-state"><i class="fa fa-inbox"></i><p>No tickets match the current filters.</p></div></td></tr>';
        return;
    }

    tbody.innerHTML = filtered.map(function(t) {
        var dt = new Date(t.submitted);
        var dateStr = dt.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})
                    + ' ' + dt.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});
        var opts = ['New','Acknowledged','In Progress','Waiting for Employee','Resolved'].map(function(s){
            return '<option value="'+s+'"'+(t.status===s?' selected':'')+'>'+s+'</option>';
        }).join('');
        return '<tr>' +
            '<td data-label="Ticket"><span class="ticket-id">'+esc(t.id)+'</span></td>' +
            '<td data-label="Date">'+dateStr+'</td>' +
            '<td data-label="From">'+esc(t.from_dept||'—')+'</td>' +
            '<td data-label="Issue">'+esc(t.category||'—')+'</td>' +
            '<td data-label="Urgency"><span class="badge-urgency '+urgencyClass(t.urgency)+'">'+esc(t.urgency)+'</span></td>' +
            '<td data-label="Status"><span class="badge-status '+statusClass(t.status)+'">'+esc(t.status)+'</span></td>' +
            '<td data-label="Update"><select class="status-select" onchange="quickStatus(\''+esc(t.id)+'\',this.value)">'+opts+'</select></td>' +
            '<td data-label="Details"><button onclick="openModal(\''+esc(t.id)+'\')" style="background:var(--primary-light);color:var(--primary);border:none;border-radius:5px;padding:5px 12px;font-size:12px;font-weight:700;cursor:pointer;"><i class="fa fa-eye me-1"></i>View</button></td>' +
        '</tr>';
    }).join('');
}

function esc(s) {
    return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ── QUICK STATUS ──
function quickStatus(id, newStatus) {
    var t = allTickets.find(function(x){ return x.id === id; });
    if (!t) return;
    var fd = new FormData();
    fd.append('action', 'dept_update');
    fd.append('dept',   DEPT);
    fd.append('id',     id);
    fd.append('status', newStatus);
    fd.append('notes',  t.notes || '');
    fetch('ticket-action.php', { method:'POST', body:fd, credentials:'same-origin' })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) {
                t.status = newStatus;
                updateStats();
                renderTable();
                showToast('Status updated to "' + newStatus + '"');
            }
        });
}

// ── MODAL ──
function openModal(id) {
    currentModal = allTickets.find(function(x){ return x.id === id; });
    if (!currentModal) return;
    var t = currentModal;
    document.getElementById('modalTitle').textContent  = t.id + ' — ' + (t.category||'');
    document.getElementById('modalNotes').value        = t.notes || '';
    document.getElementById('modalStatus').value       = t.status;

    var dt = new Date(t.submitted);
    var dateStr = dt.toLocaleDateString('en-GB',{weekday:'long',day:'2-digit',month:'long',year:'numeric'}) + ', ' + dt.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});

    document.getElementById('modalContent').innerHTML =
        row('Ticket #',     t.id) +
        row('Submitted',    dateStr) +
        row('From Dept',    t.from_dept || '—') +
        row('Issue Type',   t.category  || '—') +
        row('Urgency',      '<span class="badge-urgency '+urgencyClass(t.urgency)+'">'+esc(t.urgency)+'</span>') +
        row('Status',       '<span class="badge-status '+statusClass(t.status)+'">'+esc(t.status)+'</span>') +
        row('Contact',      t.contact || '<em style="color:#aaa">Not provided</em>') +
        row('Description',  '<span style="white-space:pre-wrap">'+esc(t.description)+'</span>') +
        (t.updated_at ? row('Last Updated', new Date(t.updated_at).toLocaleString('en-GB')) : '');

    document.getElementById('detailModal').classList.add('open');
}
function row(key, val) {
    return '<div class="detail-row"><span class="detail-key">'+key+'</span><span class="detail-val">'+val+'</span></div>';
}
function closeModal() { document.getElementById('detailModal').classList.remove('open'); currentModal = null; }

function saveModal() {
    if (!currentModal) return;
    var fd = new FormData();
    fd.append('action', 'dept_update');
    fd.append('dept',   DEPT);
    fd.append('id',     currentModal.id);
    fd.append('status', document.getElementById('modalStatus').value);
    fd.append('notes',  document.getElementById('modalNotes').value.trim());
    fetch('ticket-action.php', { method:'POST', body:fd, credentials:'same-origin' })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) {
                currentModal.status = document.getElementById('modalStatus').value;
                currentModal.notes  = document.getElementById('modalNotes').value.trim();
                updateStats(); renderTable();
                showToast('Ticket updated successfully');
            }
        });
    closeModal();
}

// ── TOAST ──
function showToast(msg) {
    var t = document.getElementById('toast');
    document.getElementById('toastMsg').textContent = msg;
    t.classList.add('show');
    setTimeout(function(){ t.classList.remove('show'); }, 3000);
}
</script>
</body>
</html>
