<?php
session_name('PCE_DEPT');
session_set_cookie_params(['path' => '/', 'httponly' => true, 'samesite' => 'Lax']);
session_start();
if (empty($_SESSION['dept'])) {
    header('Location: dept-login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Dashboard — Polyclinique de l'Etoile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #198754;
            --primary-dark: #146c43;
            --primary-light: #d1e7dd;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; color: #1a2340; }

        /* ── TOPBAR ── */
        .topbar {
            background: linear-gradient(90deg, #0d2010 0%, #1a3a22 100%);
            color: #9ab; font-size: 12px;
            padding: 8px 28px; display: flex; justify-content: space-between; align-items: center;
        }
        .topbar-brand { font-family: 'Playfair Display', serif; color: #fff; font-size: 13px; font-weight: 600; }

        /* ── HEADER ── */
        .dash-header {
            background: var(--primary); color: #fff;
            padding: 20px 32px; display: flex; align-items: center;
            justify-content: space-between; flex-wrap: wrap; gap: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,.18);
        }
        .dash-header-left { display: flex; align-items: center; gap: 16px; }
        .header-icon {
            background: rgba(255,255,255,.15); border-radius: 10px;
            width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .dash-header h1 { font-family: 'Playfair Display', serif; font-size: 1.35rem; font-weight: 700; margin: 0 0 2px; }
        .dash-header p  { margin: 0; font-size: 12.5px; opacity: .8; }
        .logout-btn {
            background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.3);
            color: #fff; border-radius: 6px; padding: 7px 18px; font-size: 13px;
            cursor: pointer; font-weight: 600; transition: background .2s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .logout-btn:hover { background: rgba(255,255,255,.25); color: #fff; }

        /* ── STATS ── */
        .stats-row {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;
            max-width: 1100px; margin: 28px auto 0; padding: 0 28px;
        }
        @media(max-width:700px){ .stats-row { grid-template-columns: repeat(2,1fr); } }
        .stat-tile {
            background: #fff; border-radius: 14px; padding: 20px 22px;
            box-shadow: 0 2px 12px rgba(0,0,0,.07); border: 1px solid #e2e8f0;
            cursor: pointer; transition: transform .15s, box-shadow .15s;
        }
        .stat-tile:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,.12); }
        .stat-tile.active { border-color: var(--primary); background: var(--primary-light); }
        .stat-num  { font-size: 2rem; font-weight: 700; line-height: 1; }
        .stat-label{ font-size: 12px; color: #64748b; margin-top: 4px; font-weight: 500; text-transform: uppercase; letter-spacing: .4px; }

        /* ── MAIN ── */
        .main-wrap { max-width: 1100px; margin: 24px auto 60px; padding: 0 28px; }

        /* ── TOOLBAR ── */
        .toolbar {
            display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
            margin-bottom: 16px;
        }
        .search-box {
            flex: 1; min-width: 180px; padding: 9px 14px 9px 36px;
            border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 13.5px; font-family: 'Inter', sans-serif; outline: none;
            position: relative;
        }
        .search-wrap { position: relative; flex: 1; min-width: 180px; }
        .search-wrap i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: #94a3b8; }
        .filter-sel {
            padding: 9px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 13px; font-family: 'Inter', sans-serif; background: #fff; outline: none; cursor: pointer;
        }
        .refresh-btn {
            background: var(--primary); color: #fff; border: none; border-radius: 8px;
            padding: 9px 16px; font-size: 13px; cursor: pointer; font-weight: 600;
            display: flex; align-items: center; gap: 6px; transition: background .2s;
        }
        .refresh-btn:hover { background: var(--primary-dark); }

        /* ── TABLE ── */
        .table-card {
            background: #fff; border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0,0,0,.07); border: 1px solid #e2e8f0; overflow: hidden;
        }
        .table-head {
            display: grid; grid-template-columns: 110px 120px 110px 90px 120px 100px 1fr;
            background: #f8fafc; border-bottom: 1px solid #e2e8f0;
            padding: 10px 18px; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .5px; color: #64748b;
        }
        .table-row {
            display: grid; grid-template-columns: 110px 120px 110px 90px 120px 100px 1fr;
            padding: 13px 18px; border-bottom: 1px solid #f1f5f9;
            font-size: 13px; align-items: center; cursor: pointer; transition: background .15s;
        }
        .table-row:hover { background: #f8fafc; }
        .table-row:last-child { border-bottom: none; }
        @media(max-width:800px){
            .table-head,.table-row { grid-template-columns: 90px 1fr 90px 80px; }
            .table-head span:nth-child(n+5),.table-row span:nth-child(n+5) { display:none; }
        }

        .badge-urg {
            display: inline-block; padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .badge-urg.Critical { background:#fde8e8; color:#b91c1c; }
        .badge-urg.High     { background:#fef3c7; color:#92400e; }
        .badge-urg.Normal   { background:#dbeafe; color:#1e40af; }
        .badge-urg.Low      { background:#d1fae5; color:#065f46; }

        .badge-status {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
        }

        .empty-state {
            text-align: center; padding: 60px 20px; color: #94a3b8;
        }
        .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; }

        /* ── DETAIL PANEL ── */
        .overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(10,10,10,.5); z-index: 999;
            align-items: center; justify-content: center; padding: 20px;
        }
        .overlay.open { display: flex; }
        .panel {
            background: #fff; border-radius: 16px; width: 100%; max-width: 540px;
            max-height: 90vh; overflow-y: auto; box-shadow: 0 24px 60px rgba(0,0,0,.3);
        }
        .panel-head {
            padding: 20px 24px; border-bottom: 1px solid #e2e8f0;
            display: flex; justify-content: space-between; align-items: center;
        }
        .panel-head h3 { font-size: 1rem; font-weight: 700; color: #1a2340; }
        .panel-close { background: none; border: none; font-size: 18px; color: #94a3b8; cursor: pointer; }
        .panel-body { padding: 20px 24px; }
        .meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 18px; }
        .meta-item label { display: block; font-size: 10.5px; text-transform: uppercase; letter-spacing: .5px; color: #94a3b8; font-weight: 700; margin-bottom: 3px; }
        .meta-item span  { font-size: 13.5px; color: #1a2340; font-weight: 500; }
        .desc-box { background: #f8fafc; border-radius: 10px; padding: 14px 16px; font-size: 13.5px; color: #374151; line-height: 1.7; margin-bottom: 18px; }
        .field-label { font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 6px; display: block; }
        .field-sel, .field-ta {
            width: 100%; padding: 9px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 13.5px; font-family: 'Inter', sans-serif; outline: none;
            transition: border-color .2s; margin-bottom: 14px;
        }
        .field-sel:focus, .field-ta:focus { border-color: var(--primary); }
        .field-ta { resize: vertical; min-height: 80px; }
        .btn-save {
            background: var(--primary); color: #fff; border: none; border-radius: 8px;
            padding: 10px 22px; font-size: 14px; font-weight: 700; cursor: pointer;
            font-family: 'Inter', sans-serif; transition: background .2s;
        }
        .btn-save:hover { background: var(--primary-dark); }
        .save-msg { font-size: 13px; color: var(--primary); margin-left: 12px; display: none; }
    </style>
</head>
<body>

<div class="topbar">
    <span class="topbar-brand">Polyclinique de l'Etoile</span>
    <span id="topbarDept"></span>
</div>

<div class="dash-header">
    <div class="dash-header-left">
        <div class="header-icon"><i class="fa fa-inbox" id="headerIcon"></i></div>
        <div>
            <h1 id="headerTitle">Department Dashboard</h1>
            <p id="headerSub">Loading tickets…</p>
        </div>
    </div>
    <button class="logout-btn" onclick="doLogout()">
        <i class="fa fa-sign-out"></i> Sign Out
    </button>
</div>

<!-- Stats -->
<div class="stats-row">
    <div class="stat-tile" onclick="filterByCard('all')">
        <div class="stat-num" id="cAll">—</div>
        <div class="stat-label">Total Tickets</div>
    </div>
    <div class="stat-tile" onclick="filterByCard('open')">
        <div class="stat-num" style="color:#e65100;" id="cOpen">—</div>
        <div class="stat-label">Open</div>
    </div>
    <div class="stat-tile" onclick="filterByCard('critical')">
        <div class="stat-num" style="color:#b91c1c;" id="cCrit">—</div>
        <div class="stat-label">Critical</div>
    </div>
    <div class="stat-tile" onclick="filterByCard('resolved')">
        <div class="stat-num" style="color:#198754;" id="cRes">—</div>
        <div class="stat-label">Resolved</div>
    </div>
</div>

<!-- Main -->
<div class="main-wrap">
    <div class="toolbar">
        <div class="search-wrap">
            <i class="fa fa-search"></i>
            <input type="text" class="search-box" id="searchBox" placeholder="Search tickets…" oninput="renderTable()">
        </div>
        <select class="filter-sel" id="urgFilter" onchange="renderTable()">
            <option value="">All Urgencies</option>
            <option>Critical</option><option>High</option><option>Normal</option><option>Low</option>
        </select>
        <select class="filter-sel" id="statusFilter" onchange="renderTable()">
            <option value="">All Statuses</option>
            <option>New</option><option>Acknowledged</option><option>In Progress</option>
            <option>Waiting for Employee</option><option>Resolved</option>
        </select>
        <button class="refresh-btn" onclick="loadTickets()">
            <i class="fa fa-refresh"></i> Refresh
        </button>
    </div>

    <div class="table-card">
        <div class="table-head">
            <span>Ticket #</span>
            <span>From</span>
            <span>Issue Type</span>
            <span>Urgency</span>
            <span>Status</span>
            <span>Date</span>
            <span>Description</span>
        </div>
        <div id="tableBody"></div>
    </div>
</div>

<!-- Detail Panel -->
<div class="overlay" id="overlay" onclick="closePanel(event)">
<div class="panel" id="panel">
    <div class="panel-head">
        <h3 id="panelTitle">Ticket Details</h3>
        <button class="panel-close" onclick="document.getElementById('overlay').classList.remove('open')">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="panel-body" id="panelBody"></div>
</div>
</div>

<script>
var allTickets = [], cardFilter = null;

var STATUS_COLORS = {
    'New':                  { bg:'#E8F5E9', color:'#2E7D32' },
    'Acknowledged':         { bg:'#E3F2FD', color:'#1565C0' },
    'In Progress':          { bg:'#FFF8E1', color:'#F57F17' },
    'Waiting for Employee': { bg:'#F3E5F5', color:'#6A1B9A' },
    'Resolved':             { bg:'#ECEFF1', color:'#455A64' }
};

var DEPT_ICONS = {
    'IT': 'fa-laptop', 'Finance': 'fa-money',
    'HR': 'fa-users',  'Logistics': 'fa-truck'
};

function loadTickets() {
    var fd = new FormData();
    fd.append('action', 'dept_list');
    fetch('ticket-action.php', { method:'POST', body:fd, credentials:'same-origin' })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (!data.success) { return; }
            var dept = data.dept;
            document.getElementById('headerTitle').textContent = dept + ' Department Dashboard';
            document.getElementById('headerSub').textContent   = 'Support tickets submitted to ' + dept;
            document.getElementById('topbarDept').textContent  = dept + ' Portal';
            var icon = DEPT_ICONS[dept] || 'fa-inbox';
            document.getElementById('headerIcon').className    = 'fa ' + icon;

            allTickets = data.tickets || [];
            updateStats();
            renderTable();
        })
        .catch(function() { /* network error — keep page, retry on next interval */ });
}

function updateStats() {
    var open = allTickets.filter(function(t){ return t.status !== 'Resolved'; }).length;
    var crit = allTickets.filter(function(t){ return t.urgency === 'Critical'; }).length;
    var res  = allTickets.filter(function(t){ return t.status === 'Resolved'; }).length;
    document.getElementById('cAll').textContent  = allTickets.length;
    document.getElementById('cOpen').textContent = open;
    document.getElementById('cCrit').textContent = crit;
    document.getElementById('cRes').textContent  = res;
}

function filterByCard(type) {
    cardFilter = type;
    document.querySelectorAll('.stat-tile').forEach(function(t){ t.classList.remove('active'); });
    var idx = {all:0,open:1,critical:2,resolved:3}[type];
    if (idx !== undefined) document.querySelectorAll('.stat-tile')[idx].classList.add('active');
    renderTable();
}

function renderTable() {
    var q   = document.getElementById('searchBox').value.toLowerCase();
    var urg = document.getElementById('urgFilter').value;
    var st  = document.getElementById('statusFilter').value;

    var filtered = allTickets.filter(function(t) {
        if (cardFilter === 'open')     return t.status !== 'Resolved';
        if (cardFilter === 'resolved') return t.status === 'Resolved';
        if (cardFilter === 'critical') return t.urgency === 'Critical';
        return true;
    }).filter(function(t) {
        if (urg && t.urgency !== urg) return false;
        if (st  && t.status  !== st)  return false;
        if (q) {
            var hay = (t.id+' '+t.from_dept+' '+t.category+' '+t.description+' '+t.contact).toLowerCase();
            if (!hay.includes(q)) return false;
        }
        return true;
    });

    filtered.sort(function(a,b){ return new Date(b.submitted) - new Date(a.submitted); });

    var body = document.getElementById('tableBody');
    if (!filtered.length) {
        body.innerHTML = '<div class="empty-state"><i class="fa fa-inbox"></i>No tickets found.</div>';
        return;
    }

    body.innerHTML = filtered.map(function(t) {
        var sc = STATUS_COLORS[t.status] || { bg:'#f1f5f9', color:'#475569' };
        var dt = t.submitted ? t.submitted.substring(0,16).replace('T',' ') : '—';
        var desc = (t.description || '').substring(0,60) + ((t.description||'').length>60?'…':'');
        return '<div class="table-row" onclick="openPanel(\'' + t.id + '\')">'
            + '<span style="font-weight:700;color:var(--primary);">' + esc(t.id) + '</span>'
            + '<span>' + esc(t.from_dept || '—') + '</span>'
            + '<span>' + esc(t.category || '—') + '</span>'
            + '<span><span class="badge-urg ' + esc(t.urgency) + '">' + esc(t.urgency) + '</span></span>'
            + '<span><span class="badge-status" style="background:' + sc.bg + ';color:' + sc.color + ';">'
            +   esc(t.status) + '</span></span>'
            + '<span style="font-size:12px;color:#64748b;">' + esc(dt) + '</span>'
            + '<span style="color:#475569;font-size:12.5px;">' + esc(desc) + '</span>'
            + '</div>';
    }).join('');
}

function esc(s) {
    return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

var panelTicket = null;
function openPanel(id) {
    var t = allTickets.find(function(x){ return x.id === id; });
    if (!t) return;
    panelTicket = t;
    document.getElementById('panelTitle').textContent = 'Ticket ' + t.id;
    var sc = STATUS_COLORS[t.status] || { bg:'#f1f5f9', color:'#475569' };
    var dt = t.submitted ? t.submitted.substring(0,16).replace('T',' ') : '—';

    var statusOpts = ['New','Acknowledged','In Progress','Waiting for Employee','Resolved']
        .map(function(s){ return '<option' + (s===t.status?' selected':'') + '>' + s + '</option>'; }).join('');

    document.getElementById('panelBody').innerHTML =
        '<div class="meta-grid">'
        + '<div class="meta-item"><label>Ticket #</label><span>' + esc(t.id) + '</span></div>'
        + '<div class="meta-item"><label>From Department</label><span>' + esc(t.from_dept||'—') + '</span></div>'
        + '<div class="meta-item"><label>Issue Type</label><span>' + esc(t.category||'—') + '</span></div>'
        + '<div class="meta-item"><label>Urgency</label><span><span class="badge-urg '+esc(t.urgency)+'">' + esc(t.urgency) + '</span></span></div>'
        + '<div class="meta-item"><label>Submitted</label><span>' + esc(dt) + '</span></div>'
        + '<div class="meta-item"><label>Contact</label><span>' + esc(t.contact||'—') + '</span></div>'
        + '</div>'
        + '<div class="desc-box">' + esc(t.description||'—') + '</div>'
        + (t.notes ? '<div class="desc-box" style="margin-bottom:18px;border-left:3px solid var(--primary);"><strong style="display:block;font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:var(--primary);margin-bottom:6px;">Previous Notes</strong>' + esc(t.notes) + '</div>' : '')
        + '<label class="field-label">Update Status</label>'
        + '<select class="field-sel" id="panelStatus">' + statusOpts + '</select>'
        + '<label class="field-label">Notes / Response</label>'
        + '<textarea class="field-ta" id="panelNotes" placeholder="Add notes or response for the employee…">' + esc(t.notes||'') + '</textarea>'
        + '<button class="btn-save" onclick="saveTicket()"><i class="fa fa-check me-1"></i> Save Changes</button>'
        + '<span class="save-msg" id="saveMsg">Saved!</span>';

    document.getElementById('overlay').classList.add('open');
}

function closePanel(e) {
    if (e.target === document.getElementById('overlay')) {
        document.getElementById('overlay').classList.remove('open');
    }
}

function saveTicket() {
    if (!panelTicket) return;
    var fd = new FormData();
    fd.append('action', 'dept_update');
    fd.append('id',     panelTicket.id);
    fd.append('status', document.getElementById('panelStatus').value);
    fd.append('notes',  document.getElementById('panelNotes').value.trim());

    fetch('ticket-action.php', { method:'POST', body:fd, credentials:'same-origin' })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) {
                panelTicket.status = document.getElementById('panelStatus').value;
                panelTicket.notes  = document.getElementById('panelNotes').value.trim();
                var msg = document.getElementById('saveMsg');
                msg.style.display = 'inline';
                setTimeout(function(){ msg.style.display = 'none'; }, 2000);
                updateStats();
                renderTable();
            }
        });
}

function doLogout() {
    var fd = new FormData();
    fd.append('action', 'dept_logout');
    fetch('ticket-action.php', { method:'POST', body:fd, credentials:'same-origin' })
        .then(function(){ window.location.href = 'dept-login.php'; });
}

// Load on page ready
loadTickets();
setInterval(loadTickets, 60000);
</script>
</body>
</html>
