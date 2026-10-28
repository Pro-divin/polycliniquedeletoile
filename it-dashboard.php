<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Dashboard — Polyclinique de l'Etoile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #15B9D9;
            --primary-dark: #0f8fa8;
            --primary-light: #d4f4fb;
        }
        body { font-family:'Open Sans',sans-serif; background:#f0f4f8; margin:0; }

        /* ── TOPBAR ── */
        .topbar {
            background:#0a0a0a; color:#ccc; font-size:12.5px;
            padding:8px 28px; display:flex; justify-content:space-between; align-items:center;
        }
        .topbar-brand { font-family:'Playfair Display',serif; color:#fff; font-size:13px; font-weight:600; }

        /* ── HEADER ── */
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

        /* ── LOGIN OVERLAY ── */
        #loginOverlay {
            position:fixed; inset:0; background:rgba(10,10,10,0.55);
            z-index:9999; display:flex; align-items:center; justify-content:center;
        }
        .login-card {
            background:#fff; border-radius:14px; padding:40px 36px;
            width:100%; max-width:380px;
            box-shadow:0 20px 60px rgba(0,0,0,0.25);
        }
        .login-card h2 { font-family:'Playfair Display',serif; font-size:1.4rem; color:#1a1a2e; margin:0 0 4px; }
        .login-card p  { color:#777; font-size:13px; margin:0 0 26px; }
        .login-card input {
            width:100%; border:1.5px solid #d4dae3; border-radius:7px;
            padding:10px 14px; font-size:14px; margin-bottom:14px;
            transition:border-color .2s; font-family:'Open Sans',sans-serif;
        }
        .login-card input:focus { border-color:var(--primary); outline:none; box-shadow:0 0 0 3px rgba(21,101,192,.1); }
        .login-btn {
            width:100%; background:var(--primary); color:#fff; border:none;
            border-radius:7px; padding:12px; font-size:15px; font-weight:700;
            font-family:'Playfair Display',serif; cursor:pointer; transition:background .2s;
        }
        .login-btn:hover { background:var(--primary-dark); }
        #loginError { color:#e53935; font-size:12.5px; margin-top:-6px; margin-bottom:10px; display:none; }

        /* ── LAYOUT ── */
        .page-wrap { max-width:1200px; margin:28px auto 60px; padding:0 16px; }

        /* ── STAT TILES ── */
        .stat-tile {
            background:#fff; border-radius:10px; padding:20px 22px;
            box-shadow:0 3px 18px rgba(0,0,0,0.07);
            display:flex; align-items:center; gap:16px;
            transition:transform .15s, box-shadow .15s;
        }
        .stat-tile:hover {
            transform:translateY(-2px); box-shadow:0 6px 24px rgba(0,0,0,0.13);
        }
        .stat-icon {
            width:46px; height:46px; border-radius:9px;
            display:flex; align-items:center; justify-content:center; flex-shrink:0;
        }
        .stat-icon i { font-size:20px; color:#fff; }
        .stat-tile h3 { font-family:'Playfair Display',serif; font-size:1.7rem; font-weight:700; margin:0; color:#1a1a2e; }
        .stat-tile p  { margin:0; font-size:11.5px; color:#777; text-transform:uppercase; letter-spacing:.8px; }

        /* ── FILTER BAR ── */
        .filter-bar {
            background:#fff; border-radius:10px; padding:16px 20px;
            box-shadow:0 3px 18px rgba(0,0,0,0.07);
            display:flex; flex-wrap:wrap; gap:12px; align-items:center;
        }
        .filter-bar select, .filter-bar input {
            border:1.5px solid #d4dae3; border-radius:6px;
            padding:7px 12px; font-size:13px; color:#333;
            transition:border-color .2s;
        }
        .filter-bar select:focus, .filter-bar input:focus { border-color:var(--primary); outline:none; }
        .filter-bar label { font-size:12px; font-weight:600; color:#555; margin-bottom:0; }
        .btn-refresh {
            background:var(--primary); color:#fff; border:none; border-radius:6px;
            padding:8px 16px; font-size:13px; font-weight:600; cursor:pointer;
            display:flex; align-items:center; gap:6px; transition:background .2s;
        }
        .btn-refresh:hover { background:var(--primary-dark); }

        /* ── TICKET TABLE ── */
        .tickets-card {
            background:#fff; border-radius:10px;
            box-shadow:0 3px 18px rgba(0,0,0,0.07); overflow:hidden;
        }
        .tickets-card-header {
            padding:18px 22px; border-bottom:1px solid #eaeef4;
            display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;
        }
        .tickets-card-header h5 {
            font-family:'Playfair Display',serif; font-size:1.05rem;
            font-weight:700; color:#1a1a2e; margin:0;
        }
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

        /* ── BADGES ── */
        .badge-status, .badge-urgency {
            display:inline-block; border-radius:5px;
            padding:3px 10px; font-size:11.5px; font-weight:700; white-space:nowrap;
        }
        /* Status */
        .s-new          { background:#d4f4fb; color:#15B9D9; }
        .s-acknowledged { background:#FFF8E1; color:#F57F17; }
        .s-inprogress   { background:#d1e7dd; color:#0a3622; }
        .s-waiting      { background:#fff3cd; color:#664d03; }
        .s-resolved     { background:#EFEBE9; color:#4E342E; }
        /* Urgency */
        .u-low      { background:#d1e7dd; color:#0a3622; }
        .u-normal   { background:#fff3cd; color:#664d03; }
        .u-high     { background:#FFEBEE; color:#C62828; }
        .u-critical { background:#4a0000; color:#fff; }

        /* ── STATUS SELECT IN TABLE ── */
        .status-select {
            border:1.5px solid #d4dae3; border-radius:6px;
            padding:5px 8px; font-size:12.5px; font-weight:600;
            cursor:pointer; background:#fff; transition:border-color .2s;
            min-width:155px;
        }
        .status-select:focus { border-color:var(--primary); outline:none; }

        /* ── DETAIL MODAL ── */
        .modal-overlay {
            display:none; position:fixed; inset:0;
            background:rgba(0,0,0,0.45); z-index:9998;
            align-items:center; justify-content:center;
        }
        .modal-overlay.open { display:flex; }
        .modal-card {
            background:#fff; border-radius:12px;
            max-width:540px; width:100%; margin:16px;
            box-shadow:0 20px 60px rgba(0,0,0,0.25); overflow:hidden;
        }
        .modal-top {
            background:var(--primary); color:#fff;
            padding:18px 22px; display:flex; align-items:center; justify-content:space-between;
        }
        .modal-top h5 { font-family:'Playfair Display',serif; margin:0; font-size:1.1rem; }
        .modal-close { background:none; border:none; color:#fff; font-size:22px; cursor:pointer; line-height:1; }
        .modal-body { padding:24px 22px; }
        .detail-row { display:flex; gap:10px; margin-bottom:14px; }
        .detail-key { font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:.7px; min-width:110px; flex-shrink:0; padding-top:2px; }
        .detail-val { font-size:13.5px; color:#1a1a2e; }
        .modal-body textarea {
            width:100%; border:1.5px solid #d4dae3; border-radius:7px;
            padding:10px 12px; font-size:13px; resize:vertical; min-height:80px;
            font-family:'Open Sans',sans-serif; margin-top:4px;
        }
        .modal-body textarea:focus { border-color:var(--primary); outline:none; }
        .modal-footer-btns { display:flex; gap:10px; justify-content:flex-end; padding:0 22px 20px; }
        .btn-save {
            background:var(--primary); color:#fff; border:none; border-radius:7px;
            padding:10px 24px; font-size:14px; font-weight:700;
            font-family:'Playfair Display',serif; cursor:pointer; transition:background .2s;
        }
        .btn-save:hover { background:var(--primary-dark); }
        .btn-cancel {
            background:#fff; color:#555; border:1.5px solid #d4dae3; border-radius:7px;
            padding:10px 20px; font-size:14px; font-weight:600; cursor:pointer; transition:border-color .2s;
        }
        .btn-cancel:hover { border-color:var(--primary); color:var(--primary); }

        /* ── EMPTY STATE ── */
        .empty-state { text-align:center; padding:48px 20px; color:#aaa; }
        .empty-state i { font-size:42px; margin-bottom:14px; display:block; color:#ccd; }
        .empty-state p { font-size:14px; }

        /* ── TOAST ── */
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

<!-- LOGIN OVERLAY -->
<div id="loginOverlay">
    <div class="login-card">
        <div style="text-align:center; margin-bottom:20px;">
            <div style="width:56px; height:56px; background:var(--primary-light); border-radius:50%;
                        display:inline-flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <i class="fa fa-lock" style="font-size:22px; color:var(--primary);"></i>
            </div>
            <h2>IT Staff Login</h2>
            <p>Polyclinique de l'Etoile — IT Dashboard</p>
        </div>
        <input type="text" id="loginUser" placeholder="Username" autocomplete="username">
        <input type="password" id="loginPass" placeholder="Password" autocomplete="current-password"
               onkeydown="if(event.key==='Enter')doLogin()">
        <div id="loginError"><i class="fa fa-exclamation-circle me-1"></i>Invalid username or password.</div>
        <button class="login-btn" onclick="doLogin()">
            <i class="fa fa-sign-in me-2"></i>Sign In
        </button>
        <p style="text-align:center; font-size:11.5px; color:#aaa; margin-top:16px;">
            Only authorised IT staff may access this page.
        </p>
    </div>
</div>

<!-- TOPBAR -->
<div class="topbar">
    <span class="topbar-brand"><i class="fa fa-hospital-o me-2" style="color:var(--primary);"></i>Polyclinique de l'Etoile</span>
    <span><i class="fa fa-map-marker me-1" style="color:var(--primary);"></i> Gasabo, Remera, Rukiri I &nbsp;|&nbsp; <i class="fa fa-phone me-1" style="color:var(--primary);"></i> Free Call 1301</span>
</div>

<!-- HEADER -->
<div class="dash-header">
    <div class="dash-header-left">
        <div class="header-icon"><i class="fa fa-tachometer" style="font-size:22px;"></i></div>
        <div>
            <h1>IT Support Dashboard</h1>
            <p>Polyclinique de l'Etoile &mdash; Internal IT Management</p>
        </div>
    </div>
    <div style="display:flex; align-items:center; gap:12px; flex-wrap:wrap;">
        <span id="staffName" style="font-size:13px; opacity:.85;"><i class="fa fa-user-circle me-1"></i></span>
        <a href="index.php" style="color:rgba(255,255,255,0.8); font-size:13px; text-decoration:none;">
            <i class="fa fa-external-link me-1"></i>Employee Form
        </a>
        <button class="logout-btn" onclick="doLogout()"><i class="fa fa-sign-out me-1"></i>Logout</button>
    </div>
</div>

<!-- PAGE BODY -->
<div class="page-wrap" id="dashBody" style="display:none;">

    <!-- STAT TILES -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('all')" style="cursor:pointer;" title="Show all tickets">
                <div class="stat-icon" style="background:var(--primary);"><i class="fa fa-ticket"></i></div>
                <div><h3 id="st-total">0</h3><p>Total Tickets</p></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('open')" style="cursor:pointer;" title="Show open tickets">
                <div class="stat-icon" style="background:#fd7e14;"><i class="fa fa-exclamation-circle"></i></div>
                <div><h3 id="st-open">0</h3><p>Open</p></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('resolved')" style="cursor:pointer;" title="Show resolved tickets">
                <div class="stat-icon" style="background:#198754;"><i class="fa fa-check-circle"></i></div>
                <div><h3 id="st-resolved">0</h3><p>Resolved</p></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-tile" onclick="filterByCard('critical')" style="cursor:pointer;" title="Show critical tickets">
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
                <option value="New">New</option>
                <option value="Acknowledged">Acknowledged</option>
                <option value="In Progress">In Progress</option>
                <option value="Waiting for Employee">Waiting for Employee</option>
                <option value="Resolved">Resolved</option>
            </select>
        </div>
        <div>
            <label>Urgency</label><br>
            <select id="filterUrgency" onchange="renderTable()">
                <option value="">All Urgencies</option>
                <option value="Critical">Critical</option>
                <option value="High">High</option>
                <option value="Normal">Normal</option>
                <option value="Low">Low</option>
            </select>
        </div>
        <div>
            <label>Department</label><br>
            <select id="filterDept" onchange="renderTable()">
                <option value="">All Departments</option>
            </select>
        </div>
        <div>
            <label>Search</label><br>
            <input type="text" id="filterSearch" placeholder="Ticket # or keyword…" oninput="renderTable()" style="width:180px;">
        </div>
        <div style="margin-top:auto;">
            <button class="btn-refresh" onclick="loadTickets()">
                <i class="fa fa-refresh"></i> Refresh
            </button>
        </div>
        <div style="margin-top:auto; margin-left:auto;">
            <button onclick="clearAllTickets()" style="background:#fff; color:#c62828; border:1.5px solid #c62828; border-radius:6px; padding:7px 14px; font-size:12.5px; font-weight:600; cursor:pointer;">
                <i class="fa fa-trash me-1"></i>Clear All
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
                        <th>Department</th>
                        <th>Category</th>
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
                <label style="font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:.7px;">IT Notes / Resolution</label>
                <textarea id="modalNotes" placeholder="Add investigation notes or resolution details…"></textarea>
            </div>
            <div style="margin-top:14px;">
                <label style="font-size:12px; font-weight:700; color:#888; text-transform:uppercase; letter-spacing:.7px; display:block; margin-bottom:6px;">Update Status</label>
                <select id="modalStatus" class="status-select" style="width:100%;">
                    <option value="New">New</option>
                    <option value="Acknowledged">Acknowledged</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Waiting for Employee">Waiting for Employee</option>
                    <option value="Resolved">Resolved</option>
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
// ── CREDENTIALS (change these to real credentials) ──
var IT_USERS = {
    'divin@polycliniquedeletoile.com': { pass: 'Abcde123.', name: 'IT Administrator' }
};

var API        = 'ticket-action.php';
var API_KEY    = 'PCE_IT_2026';
var SESSION_KEY = 'pce_it_session';
var currentModal = null;
var allTickets   = [];

// ── AUTH ──
function doLogin() {
    var u = document.getElementById('loginUser').value.trim();
    var p = document.getElementById('loginPass').value;
    if (IT_USERS[u] && IT_USERS[u].pass === p) {
        sessionStorage.setItem(SESSION_KEY, JSON.stringify({ user: u, name: IT_USERS[u].name }));
        showDash();
    } else {
        document.getElementById('loginError').style.display = 'block';
    }
}
function doLogout() {
    sessionStorage.removeItem(SESSION_KEY);
    document.getElementById('loginOverlay').style.display = 'flex';
    document.getElementById('dashBody').style.display = 'none';
}
function showDash() {
    var sess = JSON.parse(sessionStorage.getItem(SESSION_KEY) || 'null');
    if (!sess) return;
    document.getElementById('loginOverlay').style.display = 'none';
    document.getElementById('dashBody').style.display = 'block';
    document.getElementById('staffName').innerHTML = '<i class="fa fa-user-circle me-1"></i>' + sess.name;
    loadTickets();
    setInterval(loadTickets, 15000);
}

// ── TICKETS FROM SERVER ──
function loadTickets() {
    fetch(API + '?action=list&key=' + API_KEY)
        .then(function(r){ return r.json(); })
        .then(function(data) {
            allTickets = data.success ? data.tickets : [];
            populateDeptFilter();
            updateStats();
            renderTable();
        })
        .catch(function(){ allTickets = []; renderTable(); });
}
function saveTickets() { /* now handled server-side */ }

// ── STATS ──
function updateStats() {
    document.getElementById('st-total').textContent    = allTickets.length;
    document.getElementById('st-open').textContent     = allTickets.filter(t => t.status !== 'Resolved').length;
    document.getElementById('st-resolved').textContent = allTickets.filter(t => t.status === 'Resolved').length;
    document.getElementById('st-critical').textContent = allTickets.filter(t => t.urgency === 'Critical').length;
}

// ── CARD QUICK FILTER ──
var cardFilter = null;
function filterByCard(type) {
    cardFilter = type === 'all' ? null : type;
    document.getElementById('filterStatus').value  = '';
    document.getElementById('filterUrgency').value = type === 'critical' ? 'Critical' : '';
    document.getElementById('filterDept').value    = '';
    document.getElementById('filterSearch').value  = '';
    renderTable();
}

// ── DEPT FILTER POPULATION ──
function populateDeptFilter() {
    var sel = document.getElementById('filterDept');
    var cur = sel.value;
    var depts = [...new Set(allTickets.map(t => t.department))].sort();
    sel.innerHTML = '<option value="">All Departments</option>';
    depts.forEach(function(d) {
        var o = document.createElement('option');
        o.value = d; o.textContent = d;
        if (d === cur) o.selected = true;
        sel.appendChild(o);
    });
}

// ── STATUS CLASSES ──
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
    var fDept    = document.getElementById('filterDept').value;
    var fSearch  = document.getElementById('filterSearch').value.toLowerCase();

    var filtered = allTickets.filter(function(t) {
        if (cardFilter === 'open'     && t.status === 'Resolved') return false;
        if (cardFilter === 'resolved' && t.status !== 'Resolved') return false;
        if (fStatus  && t.status    !== fStatus)  return false;
        if (fUrgency && t.urgency   !== fUrgency) return false;
        if (fDept    && t.department!== fDept)    return false;
        if (fSearch  && !(
            t.id.toLowerCase().includes(fSearch) ||
            (t.description||'').toLowerCase().includes(fSearch) ||
            (t.department||'').toLowerCase().includes(fSearch) ||
            (t.category||'').toLowerCase().includes(fSearch)
        )) return false;
        return true;
    });

    // Sort: newest first
    filtered.sort(function(a,b) { return new Date(b.submitted) - new Date(a.submitted); });

    document.getElementById('ticketCount').textContent = filtered.length + ' ticket' + (filtered.length!==1?'s':'') + ' shown';

    var tbody = document.getElementById('ticketBody');
    if (!filtered.length) {
        tbody.innerHTML = '<tr><td colspan="8"><div class="empty-state"><i class="fa fa-inbox"></i><p>No tickets match the current filters.</p></div></td></tr>';
        return;
    }

    tbody.innerHTML = filtered.map(function(t) {
        var dt = new Date(t.submitted);
        var dateStr = dt.toLocaleDateString('en-GB',{day:'2-digit',month:'short',year:'numeric'})
                    + ' ' + dt.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});
        return '<tr>' +
            '<td data-label="Ticket"><span class="ticket-id">' + esc(t.id) + '</span></td>' +
            '<td data-label="Date">' + dateStr + '</td>' +
            '<td data-label="Department">' + esc(t.department) + '</td>' +
            '<td data-label="Category">' + esc(t.category) + '</td>' +
            '<td data-label="Urgency"><span class="badge-urgency ' + urgencyClass(t.urgency) + '">' + esc(t.urgency) + '</span></td>' +
            '<td data-label="Status"><span class="badge-status ' + statusClass(t.status) + '">' + esc(t.status) + '</span></td>' +
            '<td data-label="Update">' +
                '<select class="status-select" onchange="quickStatus(\''+t.id+'\',this.value)">' +
                    ['New','Acknowledged','In Progress','Waiting for Employee','Resolved'].map(function(s) {
                        return '<option value="'+s+'"'+(t.status===s?' selected':'')+'>'+s+'</option>';
                    }).join('') +
                '</select>' +
            '</td>' +
            '<td data-label="Details"><button onclick="openModal(\''+t.id+'\')" style="background:var(--primary-light);color:var(--primary);border:none;border-radius:5px;padding:5px 12px;font-size:12px;font-weight:700;cursor:pointer;"><i class="fa fa-eye me-1"></i>View</button></td>' +
        '</tr>';
    }).join('');
}

function esc(s) {
    return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

// ── QUICK STATUS UPDATE ──
function quickStatus(id, newStatus) {
    var fd = new FormData();
    fd.append('action', 'update');
    fd.append('key',    API_KEY);
    fd.append('id',     id);
    fd.append('status', newStatus);
    var t = allTickets.find(function(x){ return x.id === id; });
    fd.append('notes',  t ? (t.notes || '') : '');
    fetch(API, { method:'POST', body:fd })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) { loadTickets(); showToast('Status updated to "' + newStatus + '"'); }
        });
}

// ── MODAL ──
function openModal(id) {
    currentModal = allTickets.find(function(x){ return x.id === id; });
    if (!currentModal) return;
    var t = currentModal;
    document.getElementById('modalTitle').textContent = t.id + ' — ' + t.category;
    document.getElementById('modalNotes').value = t.notes || '';
    document.getElementById('modalStatus').value = t.status;

    var dt = new Date(t.submitted);
    var dateStr = dt.toLocaleDateString('en-GB',{weekday:'long',day:'2-digit',month:'long',year:'numeric'})
                + ', ' + dt.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});

    document.getElementById('modalContent').innerHTML =
        row('Ticket #',    t.id) +
        row('Submitted',   dateStr) +
        row('Department',  t.department) +
        row('Category',    t.category) +
        row('Urgency',     '<span class="badge-urgency '+urgencyClass(t.urgency)+'">'+esc(t.urgency)+'</span>') +
        row('Current Status', '<span class="badge-status '+statusClass(t.status)+'">'+esc(t.status)+'</span>') +
        row('Contact',     t.contact || '<em style="color:#aaa">Not provided</em>') +
        row('Description', '<span style="white-space:pre-wrap">'+esc(t.description)+'</span>') +
        (t.updated_at ? row('Last Updated', new Date(t.updated_at).toLocaleString('en-GB')) : '');

    document.getElementById('detailModal').classList.add('open');
}
function row(key, val) {
    return '<div class="detail-row"><span class="detail-key">'+key+'</span><span class="detail-val">'+val+'</span></div>';
}
function closeModal() {
    document.getElementById('detailModal').classList.remove('open');
    currentModal = null;
}
function saveModal() {
    if (!currentModal) return;
    var fd = new FormData();
    fd.append('action', 'update');
    fd.append('key',    API_KEY);
    fd.append('id',     currentModal.id);
    fd.append('status', document.getElementById('modalStatus').value);
    fd.append('notes',  document.getElementById('modalNotes').value.trim());
    fetch(API, { method:'POST', body:fd })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) { loadTickets(); showToast('Ticket updated successfully'); }
        });
    closeModal();
}

// ── CLEAR ALL ──
function clearAllTickets() {
    if (!confirm('Delete ALL tickets permanently? This cannot be undone.')) return;
    showToast('Clear all is disabled in server mode. Delete from database directly.');
}

// ── TOAST ──
function showToast(msg) {
    var t = document.getElementById('toast');
    document.getElementById('toastMsg').textContent = msg;
    t.classList.add('show');
    setTimeout(function(){ t.classList.remove('show'); }, 3000);
}

// ── INIT ──
window.addEventListener('load', function() {
    var sess = JSON.parse(sessionStorage.getItem(SESSION_KEY) || 'null');
    if (sess && IT_USERS[sess.user]) {
        showDash();
    }
    // listen for new tickets submitted on the employee form (same tab won't fire, cross-tab will)
    window.addEventListener('storage', function(e) {
        if (e.key === STORAGE_KEY) loadTickets();
    });
});
</script>
</body>
</html>
