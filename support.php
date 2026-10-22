<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Centre — Polyclinique de l'Etoile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:       #198754;
            --primary-dark:  #146c43;
            --primary-mid:   #1daa68;
            --primary-light: #d1e7dd;
            --accent:        #20c997;
            --surface:       #F8FAFC;
            --card:          #ffffff;
            --text:          #1a2340;
            --muted:         #64748b;
            --border:        #e2e8f0;
            --radius:        14px;
            --shadow:        0 4px 24px rgba(21,101,192,.10);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: var(--surface); color: var(--text); }

        /* ── TOPBAR ── */
        .topbar {
            background: linear-gradient(90deg, #0d2010 0%, #1a3a22 100%);
            color: #9ab; font-size: 12px;
            display: flex; justify-content: space-between; align-items: center;
            padding: 8px 24px; flex-wrap: wrap; gap: 6px;
        }
        .topbar a { color: #9ab; text-decoration: none; }
        .topbar-brand { font-family: 'Playfair Display', serif; color: #fff; font-size: 13px; font-weight: 600; }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, #146c43 0%, #198754 50%, #1daa68 100%);
            padding: 60px 24px 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
            border-radius: 100px; padding: 6px 18px; font-size: 12px;
            color: #e0f2fe; letter-spacing: .5px; text-transform: uppercase; font-weight: 600;
            margin-bottom: 20px; backdrop-filter: blur(4px);
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            color: #fff; font-weight: 700;
            margin-bottom: 14px; line-height: 1.2;
        }
        .hero p { color: #bfdbfe; font-size: 16px; max-width: 480px; margin: 0 auto 32px; line-height: 1.7; }
        .btn-report {
            background: #fff; color: var(--primary);
            border: none; border-radius: 50px;
            padding: 16px 40px; font-size: 15px; font-weight: 700;
            cursor: pointer; display: inline-flex; align-items: center; gap: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,.25);
            transition: transform .2s, box-shadow .2s;
            font-family: 'Inter', sans-serif;
        }
        .btn-report:hover { transform: translateY(-2px); box-shadow: 0 12px 40px rgba(0,0,0,.3); }
        .hero-note { color: rgba(255,255,255,.55); font-size: 12px; margin-top: 14px; }

        /* ── TARGET DEPT CARDS (step 1) ── */
        .target-grid { display: flex; flex-direction: column; gap: 10px; }
        .target-card {
            display: flex; align-items: center; gap: 14px;
            border: 2px solid var(--border); border-radius: 12px;
            padding: 14px 16px; background: #fff; cursor: pointer;
            text-align: left; transition: all .2s; width: 100%;
        }
        .target-card:hover { border-color: var(--primary); background: var(--primary-light); }
        .target-card.selected { border-color: var(--primary); background: var(--primary-light); }
        .target-icon {
            width: 46px; height: 46px; border-radius: 10px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-size: 20px;
        }
        .target-info { display: flex; flex-direction: column; }
        .target-info strong { font-size: 14px; font-weight: 700; color: var(--text); }
        .target-info span { font-size: 12px; color: var(--muted); margin-top: 2px; }

        /* ── QUICK CARDS ── */
        .quick-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            max-width: 700px;
            margin: -36px auto 0;
            padding: 0 20px;
            position: relative; z-index: 10;
        }
        @media(max-width:600px){ .quick-cards { grid-template-columns: 1fr; margin-top: -20px; } }
        .qcard {
            background: var(--card);
            border-radius: var(--radius);
            padding: 20px 18px;
            text-align: center;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }
        .qcard-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px; font-size: 18px;
        }
        .qcard h4 { font-size: 13px; font-weight: 600; color: var(--text); margin: 0 0 3px; }
        .qcard p  { font-size: 11.5px; color: var(--muted); margin: 0; }

        /* ── MAIN LAYOUT ── */
        .main-wrap { max-width: 900px; margin: 48px auto 60px; padding: 0 20px; }

        /* ── STATUS CHECKER CARD ── */
        .status-card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 36px 40px;
            margin-bottom: 28px;
        }
        .status-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.35rem; color: var(--text); margin-bottom: 6px;
        }
        .status-card .sub { color: var(--muted); font-size: 13.5px; margin-bottom: 22px; }
        .status-input-row { display: flex; gap: 10px; flex-wrap: wrap; }
        .status-input-row input {
            flex: 1; border: 1.5px solid var(--border); border-radius: 10px;
            padding: 13px 16px; font-size: 14px; font-family: 'Inter', sans-serif;
            color: var(--text); min-width: 160px; transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .status-input-row input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(21,101,192,.1); }
        .btn-check {
            background: var(--primary); color: #fff;
            border: none; border-radius: 10px; padding: 13px 28px;
            font-size: 14px; font-weight: 600; cursor: pointer;
            font-family: 'Inter', sans-serif; display: flex; align-items: center; gap: 8px;
            transition: background .2s;
        }
        .btn-check:hover { background: var(--primary-dark); }
        #ticketStatusResult { margin-top: 18px; }

        /* ── HOW IT WORKS ── */
        .how-card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            padding: 36px 40px;
            margin-bottom: 28px;
        }
        .how-card h2 { font-family: 'Playfair Display', serif; font-size: 1.35rem; color: var(--text); margin-bottom: 24px; }
        .steps-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media(max-width:540px){ .steps-grid { grid-template-columns: 1fr; } }
        .step-box { display: flex; gap: 14px; }
        .step-num {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--primary); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700; flex-shrink: 0;
        }
        .step-box h5 { font-size: 13.5px; font-weight: 600; color: var(--text); margin: 0 0 4px; }
        .step-box p  { font-size: 12.5px; color: var(--muted); margin: 0; line-height: 1.6; }

        /* ── CONTACT BOX ── */
        .contact-card {
            background: linear-gradient(135deg, #146c43 0%, #198754 100%);
            border-radius: var(--radius); padding: 28px 32px;
            display: flex; flex-wrap: wrap; gap: 20px; align-items: center;
            box-shadow: var(--shadow);
        }
        .contact-card h3 { font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #fff; margin: 0 0 4px; }
        .contact-card .sub { color: #bfdbfe; font-size: 13px; }
        .contact-items { display: flex; flex-wrap: wrap; gap: 16px; margin-left: auto; }
        .contact-chip {
            background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2);
            border-radius: 10px; padding: 10px 16px;
            color: #fff; font-size: 13px; display: flex; align-items: center; gap: 8px;
        }
        .contact-chip i { color: #bfdbfe; }

        /* ── FOOTER ── */
        .support-footer {
            background: #0a0a1a; color: #555;
            text-align: center; padding: 20px;
            font-size: 12px;
        }
        .support-footer a { color: #1976D2; text-decoration: none; }

        /* ════════════════════════════════
           MODAL WIZARD
        ════════════════════════════════ */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(10,20,50,.6);
            backdrop-filter: blur(6px);
            z-index: 1000;
            display: none; align-items: center; justify-content: center;
            padding: 16px;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: #fff; border-radius: 20px;
            width: 100%; max-width: 580px;
            max-height: 92vh; overflow-y: auto;
            box-shadow: 0 32px 80px rgba(0,0,0,.3);
            animation: slideUp .3s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .modal-head {
            background: linear-gradient(135deg, #146c43, #198754);
            border-radius: 20px 20px 0 0;
            padding: 24px 28px 20px;
            color: #fff;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        .modal-head h3 { font-family: 'Playfair Display', serif; font-size: 1.25rem; margin: 0 0 4px; }
        .modal-head p  { font-size: 12.5px; color: #bfdbfe; margin: 0; }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,.15); border: none; color: #fff;
            cursor: pointer; font-size: 16px; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: background .2s;
        }
        .modal-close:hover { background: rgba(255,255,255,.25); }

        /* Progress bar */
        .progress-wrap { padding: 0 28px; background: #fff; }
        .progress-track {
            display: flex; align-items: center; gap: 0;
            padding: 20px 0 16px;
        }
        .prog-step {
            display: flex; flex-direction: column; align-items: center;
            flex: 1; position: relative; cursor: default;
        }
        .prog-dot {
            width: 30px; height: 30px; border-radius: 50%;
            background: #e2e8f0; color: #94a3b8;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700;
            transition: all .3s; z-index: 2; position: relative;
        }
        .prog-step.done .prog-dot  { background: var(--primary); color: #fff; }
        .prog-step.active .prog-dot {
            background: var(--primary); color: #fff;
            box-shadow: 0 0 0 4px rgba(21,101,192,.2);
        }
        .prog-label { font-size: 10px; color: var(--muted); margin-top: 5px; white-space: nowrap; }
        .prog-step.active .prog-label, .prog-step.done .prog-label { color: var(--primary); font-weight: 600; }
        .prog-line {
            flex: 1; height: 2px; background: #e2e8f0;
            margin: 0 -1px; position: relative; top: -12px; z-index: 1;
            transition: background .3s;
        }
        .prog-line.done { background: var(--primary); }

        /* Step body */
        .modal-body { padding: 24px 28px 8px; }
        .step-panel { display: none; animation: fadeIn .25s ease; }
        .step-panel.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateX(12px); } to { opacity: 1; transform: none; } }
        .step-title { font-size: 15px; font-weight: 600; color: var(--text); margin-bottom: 16px; }

        /* Department grid */
        .dept-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        @media(max-width:400px){ .dept-grid { grid-template-columns: repeat(2,1fr); } }
        .dept-btn {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: 10px 8px; font-size: 12px; font-weight: 500;
            color: var(--text); background: #fff; cursor: pointer;
            transition: all .2s; text-align: center; line-height: 1.4;
        }
        .dept-btn:hover   { border-color: var(--primary); background: var(--primary-light); }
        .dept-btn.selected { border-color: var(--primary); background: var(--primary-light); color: var(--primary); font-weight: 700; }
        .dept-btn i { display: block; font-size: 18px; margin-bottom: 5px; color: var(--primary); }

        /* Category grid */
        .cat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        @media(max-width:400px){ .cat-grid { grid-template-columns: repeat(2,1fr); } }
        .cat-card {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: 16px 10px; cursor: pointer; text-align: center;
            transition: all .2s; background: #fff;
        }
        .cat-card i { font-size: 24px; color: var(--primary); display: block; margin-bottom: 8px; }
        .cat-card span { font-size: 11.5px; font-weight: 600; color: var(--text); line-height: 1.4; display: block; }
        .cat-card:hover   { border-color: var(--primary); background: var(--primary-light); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(21,101,192,.15); }
        .cat-card.selected { border-color: var(--primary); background: var(--primary-light); box-shadow: 0 0 0 3px rgba(21,101,192,.15); }

        /* Urgency */
        .urg-list { display: flex; flex-direction: column; gap: 8px; }
        .urg-card {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: 14px 16px; cursor: pointer;
            display: flex; align-items: center; gap: 14px;
            transition: all .2s; background: #fff;
        }
        .urg-dot { width: 14px; height: 14px; border-radius: 50%; flex-shrink: 0; }
        .urg-card h5 { font-size: 13.5px; font-weight: 600; color: var(--text); margin: 0 0 2px; }
        .urg-card p  { font-size: 12px; color: var(--muted); margin: 0; }
        .urg-card:hover   { border-color: var(--primary); background: var(--primary-light); }
        .urg-card.selected { border-color: var(--primary); background: var(--primary-light); box-shadow: 0 0 0 3px rgba(21,101,192,.12); }
        .urg-check { margin-left: auto; color: var(--primary); display: none; }
        .urg-card.selected .urg-check { display: block; }

        /* Step 4 form */
        .field-label { font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 6px; display: block; }
        .field-label .req { color: #e53935; }
        .field-input {
            width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
            padding: 12px 14px; font-size: 14px; font-family: 'Inter', sans-serif;
            color: var(--text); outline: none; transition: border-color .2s, box-shadow .2s;
        }
        .field-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(21,101,192,.1); }
        textarea.field-input { resize: vertical; min-height: 110px; }
        .upload-zone {
            border: 2px dashed var(--border); border-radius: 10px;
            padding: 20px; text-align: center; cursor: pointer;
            transition: border-color .2s, background .2s;
            position: relative;
        }
        .upload-zone:hover { border-color: var(--primary); background: var(--primary-light); }
        .upload-zone input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
        .upload-zone i { font-size: 24px; color: var(--primary); display: block; margin-bottom: 6px; }
        .upload-zone p { font-size: 12.5px; color: var(--muted); margin: 0; }
        #uploadName { font-size: 12px; color: var(--primary); margin-top: 6px; font-weight: 600; }

        /* Summary */
        .summary-box {
            background: var(--surface); border-radius: 12px;
            padding: 18px 20px; margin-bottom: 16px;
            border: 1px solid var(--border);
        }
        .summary-row { display: flex; justify-content: space-between; gap: 12px; padding: 6px 0; font-size: 13px; border-bottom: 1px solid var(--border); }
        .summary-row:last-child { border-bottom: none; }
        .summary-row .label { color: var(--muted); font-weight: 500; }
        .summary-row .value { font-weight: 600; color: var(--text); text-align: right; }

        /* Modal footer */
        .modal-foot {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px 28px 24px;
        }
        .btn-back {
            background: none; border: 1.5px solid var(--border); border-radius: 10px;
            padding: 11px 24px; font-size: 13.5px; font-weight: 600;
            color: var(--muted); cursor: pointer; transition: all .2s;
            font-family: 'Inter', sans-serif;
        }
        .btn-back:hover { border-color: var(--primary); color: var(--primary); }
        .btn-next {
            background: var(--primary); color: #fff;
            border: none; border-radius: 10px;
            padding: 12px 28px; font-size: 13.5px; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; gap: 8px;
            transition: background .2s; font-family: 'Inter', sans-serif;
        }
        .btn-next:hover { background: var(--primary-dark); }

        /* Success screen */
        .success-screen {
            padding: 40px 28px 32px; text-align: center; display: none;
        }
        .success-screen.active { display: block; }
        .success-ring {
            width: 80px; height: 80px; border-radius: 50%;
            background: linear-gradient(135deg, #E8F5E9, #C8E6C9);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px; font-size: 36px; color: #2E7D32;
            animation: popIn .4s cubic-bezier(.68,-.55,.27,1.55);
        }
        @keyframes popIn { from { transform: scale(0); } to { transform: scale(1); } }
        .success-screen h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--text); margin-bottom: 8px; }
        .success-screen p  { font-size: 13.5px; color: var(--muted); max-width: 360px; margin: 0 auto 22px; line-height: 1.7; }
        .ticket-pill {
            display: inline-block;
            background: var(--primary); color: #fff;
            border-radius: 100px; padding: 10px 32px;
            font-size: 1.3rem; font-weight: 700; letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .success-note { font-size: 12px; color: var(--muted); margin-bottom: 20px; }
        .btn-another {
            background: none; border: 1.5px solid var(--primary);
            color: var(--primary); border-radius: 10px;
            padding: 11px 28px; font-size: 14px; font-weight: 600;
            cursor: pointer; font-family: 'Inter', sans-serif;
            transition: all .2s;
        }
        .btn-another:hover { background: var(--primary); color: #fff; }

        /* error */
        .err-msg { font-size: 12px; color: #e53935; margin-top: 6px; display: none; }
        .err-msg.show { display: block; }
    </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <span class="topbar-brand">
        <i class="fa fa-hospital-o me-2" style="color:#60a5fa;"></i>
        Polyclinique de l'Etoile
    </span>
    <span>
        <i class="fa fa-map-marker me-1" style="color:#60a5fa;"></i>
        Gasabo, Remera, Rukiri I, Kigali &nbsp;|&nbsp;
        <i class="fa fa-phone me-1" style="color:#60a5fa;"></i>
        Free Call 1301
    </span>
</div>

<!-- Hero -->
<div class="hero">
    <div class="hero-badge"><i class="fa fa-shield"></i> Internal Staff Portal</div>
    <h1>IT Support Centre</h1>
    <p>Having a technical issue? Report it in under a minute and our IT team will respond promptly.</p>
    <button class="btn-report" onclick="openModal()">
        <i class="fa fa-plus-circle"></i> Report an Issue
    </button>
    <div class="hero-note"><i class="fa fa-lock me-1"></i>Internal staff use only — all reports are confidential</div>
</div>

<!-- Quick cards -->
<div class="quick-cards">
    <div class="qcard">
        <div class="qcard-icon" style="background:#E3F2FD;">
            <i class="fa fa-bolt" style="color:#1565C0;"></i>
        </div>
        <h4>Fast Response</h4>
        <p>IT notified instantly on submission</p>
    </div>
    <div class="qcard">
        <div class="qcard-icon" style="background:#E8F5E9;">
            <i class="fa fa-eye" style="color:#2E7D32;"></i>
        </div>
        <h4>Track Status</h4>
        <p>Check updates with your ticket number</p>
    </div>
    <div class="qcard">
        <div class="qcard-icon" style="background:#FFF3E0;">
            <i class="fa fa-clock-o" style="color:#E65100;"></i>
        </div>
        <h4>24/7 Priority</h4>
        <p>Critical issues escalated immediately</p>
    </div>
</div>

<!-- Main content -->
<div class="main-wrap">

    <!-- Status Checker -->
    <div class="status-card">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:6px;">
            <div style="width:40px;height:40px;border-radius:10px;background:var(--primary-light);display:flex;align-items:center;justify-content:center;">
                <i class="fa fa-search" style="color:var(--primary);font-size:17px;"></i>
            </div>
            <h2>Check Your Ticket Status</h2>
        </div>
        <p class="sub">Enter your ticket number to see the latest update from the IT team.</p>
        <div class="status-input-row">
            <input type="text" id="checkTicketId" placeholder="e.g. IT-1001"
                   onkeydown="if(event.key==='Enter')checkTicket()">
            <button class="btn-check" onclick="checkTicket()">
                <i class="fa fa-search"></i> Check Status
            </button>
        </div>
        <div id="ticketStatusResult"></div>
    </div>

    <!-- How it works -->
    <div class="how-card">
        <h2><i class="fa fa-info-circle me-2" style="color:var(--primary);font-size:1.1rem;"></i>How it works</h2>
        <div class="steps-grid">
            <div class="step-box">
                <div class="step-num">1</div>
                <div>
                    <h5>Submit a ticket</h5>
                    <p>Select your department, problem type and urgency in a quick guided form.</p>
                </div>
            </div>
            <div class="step-box">
                <div class="step-num">2</div>
                <div>
                    <h5>IT is notified instantly</h5>
                    <p>The IT officer receives an alert with your ticket number and priority.</p>
                </div>
            </div>
            <div class="step-box">
                <div class="step-num">3</div>
                <div>
                    <h5>Status updates</h5>
                    <p>Track progress: Acknowledged → In Progress → Resolved at any time.</p>
                </div>
            </div>
            <div class="step-box">
                <div class="step-num">4</div>
                <div>
                    <h5>Resolution recorded</h5>
                    <p>The solution and response time are logged for management review.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div class="contact-card">
        <div>
            <h3>Urgent? Contact IT directly</h3>
            <p class="sub">For critical outages affecting patient care</p>
        </div>
        <div class="contact-items">
            <div class="contact-chip"><i class="fa fa-phone"></i> Ext. 100</div>
            <div class="contact-chip"><i class="fa fa-whatsapp"></i> +(250) 790 008 754</div>
            <div class="contact-chip"><i class="fa fa-envelope"></i> it@polycliniquedeletoile.com</div>
        </div>
    </div>

</div>

<!-- Footer -->
<div class="support-footer">
    &copy; 2026 <a href="https://www.polycliniquedeletoile.com">Polyclinique de l'Etoile</a>
    &mdash; IT Support Centre &mdash; Internal Staff Portal
    &nbsp;|&nbsp;
    <a href="it-dashboard.php" style="color:#555;">IT Staff Dashboard</a>
</div>

<!-- ════════════════════════════════════
     MODAL WIZARD
════════════════════════════════════ -->
<div class="modal-overlay" id="modalOverlay" onclick="closeOnBackdrop(event)">
<div class="modal-box" id="modalBox">

    <!-- Head -->
    <div class="modal-head">
        <div>
            <h3><i class="fa fa-ticket me-2"></i>Report a Technical Issue</h3>
            <p>Complete the steps below — it takes less than a minute.</p>
        </div>
        <button class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>

    <!-- Progress -->
    <div class="progress-wrap" id="progressWrap">
        <div class="progress-track">
            <div class="prog-step active" id="ps1">
                <div class="prog-dot">1</div>
                <span class="prog-label">Send To</span>
            </div>
            <div class="prog-line" id="pl1"></div>
            <div class="prog-step" id="ps2">
                <div class="prog-dot">2</div>
                <span class="prog-label">Your Dept</span>
            </div>
            <div class="prog-line" id="pl2"></div>
            <div class="prog-step" id="ps3">
                <div class="prog-dot">3</div>
                <span class="prog-label">Issue Type</span>
            </div>
            <div class="prog-line" id="pl3"></div>
            <div class="prog-step" id="ps4">
                <div class="prog-dot">4</div>
                <span class="prog-label">Urgency</span>
            </div>
            <div class="prog-line" id="pl4"></div>
            <div class="prog-step" id="ps5">
                <div class="prog-dot">5</div>
                <span class="prog-label">Details</span>
            </div>
            <div class="prog-line" id="pl5"></div>
            <div class="prog-step" id="ps6">
                <div class="prog-dot">6</div>
                <span class="prog-label">Review</span>
            </div>
        </div>
    </div>

    <!-- Step 1: Department -->
    <div class="modal-body">
    <div class="step-panel active" id="step1">
        <p class="step-title">Select the department you'd like to submit your request to.</p>
        <div class="target-grid">
            <button class="target-card" onclick="selectDept(this,'IT')">
                <div class="target-icon" style="background:#E3F2FD;"><i class="fa fa-laptop" style="color:#1565C0;"></i></div>
                <div class="target-info">
                    <strong>IT Department</strong>
                    <span>Computer, network, software &amp; device issues</span>
                </div>
            </button>
            <button class="target-card" onclick="selectDept(this,'Finance')">
                <div class="target-icon" style="background:#E8F5E9;"><i class="fa fa-money" style="color:#2E7D32;"></i></div>
                <div class="target-info">
                    <strong>Finance</strong>
                    <span>Salary, payments, budgets &amp; reimbursements</span>
                </div>
            </button>
            <button class="target-card" onclick="selectDept(this,'HR')">
                <div class="target-icon" style="background:#FFF3E0;"><i class="fa fa-users" style="color:#E65100;"></i></div>
                <div class="target-info">
                    <strong>Human Resources</strong>
                    <span>Leave, contracts, training &amp; staff matters</span>
                </div>
            </button>
            <button class="target-card" onclick="selectDept(this,'Logistics')">
                <div class="target-icon" style="background:#F3E5F5;"><i class="fa fa-truck" style="color:#6A1B9A;"></i></div>
                <div class="target-info">
                    <strong>Logistics</strong>
                    <span>Supplies, equipment, stock &amp; transport</span>
                </div>
            </button>
        </div>
        <p class="err-msg" id="errDept">Please select a department to submit to.</p>
    </div>

    <!-- Step 2: From Department -->
    <div class="step-panel" id="step2">
        <p class="step-title">Which department are you submitting this request from?</p>
        <div class="dept-grid" id="fromGrid">
            <button class="dept-btn" onclick="selectFrom(this,'Reception')"><i class="fa fa-user-md"></i>Reception</button>
            <button class="dept-btn" onclick="selectFrom(this,'Consultation')"><i class="fa fa-stethoscope"></i>Consultation</button>
            <button class="dept-btn" onclick="selectFrom(this,'Emergency')"><i class="fa fa-ambulance"></i>Emergency</button>
            <button class="dept-btn" onclick="selectFrom(this,'Laboratory')"><i class="fa fa-flask"></i>Laboratory</button>
            <button class="dept-btn" onclick="selectFrom(this,'Radiology')"><i class="fa fa-eye"></i>Radiology</button>
            <button class="dept-btn" onclick="selectFrom(this,'CT Scan')"><i class="fa fa-circle-o-notch"></i>CT Scan</button>
            <button class="dept-btn" onclick="selectFrom(this,'Gynaecology')"><i class="fa fa-venus"></i>Gynaecology</button>
            <button class="dept-btn" onclick="selectFrom(this,'Nursing Ward')"><i class="fa fa-heartbeat"></i>Nursing Ward</button>
            <button class="dept-btn" onclick="selectFrom(this,'Pediatrics')"><i class="fa fa-child"></i>Pediatrics</button>
            <button class="dept-btn" onclick="selectFrom(this,'Endoscopy')"><i class="fa fa-search-plus"></i>Endoscopy</button>
            <button class="dept-btn" onclick="selectFrom(this,'Dentistry')"><i class="fa fa-smile-o"></i>Dentistry</button>
            <button class="dept-btn" onclick="selectFrom(this,'Administration')"><i class="fa fa-building"></i>Administration</button>
            <button class="dept-btn" onclick="selectFrom(this,'Finance')"><i class="fa fa-money"></i>Finance</button>
            <button class="dept-btn" onclick="selectFrom(this,'HR')"><i class="fa fa-users"></i>HR</button>
            <button class="dept-btn" onclick="selectFrom(this,'Logistics')"><i class="fa fa-truck"></i>Logistics</button>
            <button class="dept-btn" onclick="selectFrom(this,'Other')"><i class="fa fa-ellipsis-h"></i>Other</button>
        </div>
        <div id="otherFromWrap" style="display:none;margin-top:12px;">
            <label class="field-label">Please specify your department <span class="req">*</span></label>
            <input type="text" class="field-input" id="otherFromInput" placeholder="e.g. Physiotherapy, Pharmacy…" oninput="selFrom=this.value.trim()">
        </div>
        <p class="err-msg" id="errFrom">Please select your department.</p>
    </div>

    <!-- Step 3: Category (dynamic based on target dept) -->
    <div class="step-panel" id="step3">
        <p class="step-title">What best describes your issue?</p>
        <div class="cat-grid" id="catGrid"></div>
        <p class="err-msg" id="errCat">Please select an issue type.</p>
    </div>

    <!-- Step 4: Urgency -->
    <div class="step-panel" id="step4">
        <p class="step-title">How would you rate the urgency of this issue?</p>
        <div class="urg-list">
            <div class="urg-card" onclick="selectUrg(this,'Low')">
                <div class="urg-dot" style="background:#4CAF50;"></div>
                <div>
                    <h5>Low</h5>
                    <p>Minor issue — work can continue normally</p>
                </div>
                <i class="fa fa-check-circle urg-check"></i>
            </div>
            <div class="urg-card" onclick="selectUrg(this,'Normal')">
                <div class="urg-dot" style="background:#2196F3;"></div>
                <div>
                    <h5>Normal</h5>
                    <p>Some work is affected but manageable</p>
                </div>
                <i class="fa fa-check-circle urg-check"></i>
            </div>
            <div class="urg-card" onclick="selectUrg(this,'High')">
                <div class="urg-dot" style="background:#FF9800;"></div>
                <div>
                    <h5>High</h5>
                    <p>A department's work is significantly blocked</p>
                </div>
                <i class="fa fa-check-circle urg-check"></i>
            </div>
            <div class="urg-card" onclick="selectUrg(this,'Critical')">
                <div class="urg-dot" style="background:#F44336;"></div>
                <div>
                    <h5>Critical</h5>
                    <p>Major outage — patient care is impacted</p>
                </div>
                <i class="fa fa-check-circle urg-check"></i>
            </div>
        </div>
        <p class="err-msg" id="errUrg">Please select urgency level.</p>
    </div>

    <!-- Step 5: Details -->
    <div class="step-panel" id="step5">
        <p class="step-title">Please provide details about your issue.</p>
        <div style="margin-bottom:14px;">
            <label class="field-label">What happened? <span class="req">*</span></label>
            <textarea class="field-input" id="desc" placeholder="Explain what happened, what you were doing, and any error messages you saw…"></textarea>
            <p class="err-msg" id="errDesc">Please describe the problem.</p>
        </div>
        <div style="margin-bottom:14px;">
            <label class="field-label">Your name &amp; extension (optional)</label>
            <input type="text" class="field-input" id="ext" placeholder="e.g. Marie — Ext. 205 or 0788 123 456">
        </div>
        <div>
            <label class="field-label">Attach a screenshot (optional)</label>
            <div class="upload-zone">
                <input type="file" id="screenshot" accept="image/*,.pdf" onchange="showFileName(this)">
                <i class="fa fa-cloud-upload"></i>
                <p>Click to upload — JPG, PNG, PDF &mdash; max 5 MB</p>
                <div id="uploadName"></div>
            </div>
        </div>
    </div>

    <!-- Step 6: Review -->
    <div class="step-panel" id="step6">
        <p class="step-title">Please review your request before submitting.</p>
        <div class="summary-box">
            <div class="summary-row"><span class="label">Submit To</span><span class="value" id="sum-dept">—</span></div>
            <div class="summary-row"><span class="label">From Department</span><span class="value" id="sum-from">—</span></div>
            <div class="summary-row"><span class="label">Issue Type</span><span class="value" id="sum-cat">—</span></div>
            <div class="summary-row"><span class="label">Urgency</span><span class="value" id="sum-urg">—</span></div>
            <div class="summary-row"><span class="label">Description</span><span class="value" id="sum-desc" style="max-width:60%;font-weight:400;color:var(--muted);">—</span></div>
            <div class="summary-row"><span class="label">Contact</span><span class="value" id="sum-ext">Not provided</span></div>
        </div>
        <p class="err-msg" id="errSubmit"></p>
    </div>
    </div><!-- /modal-body -->

    <!-- Success screen (replaces steps) -->
    <div class="success-screen" id="successScreen">
        <div class="success-ring"><i class="fa fa-check"></i></div>
        <h3>Ticket Submitted!</h3>
        <p>Your issue has been logged and the relevant team has been notified. They will follow up with you shortly.</p>
        <div class="ticket-pill" id="ticketNumber">IT-0000</div>
        <p class="success-note">Keep this number to check your ticket status below.</p>
        <button class="btn-another" onclick="resetWizard()"><i class="fa fa-plus me-1"></i> Report Another Issue</button>
    </div>

    <!-- Modal footer -->
    <div class="modal-foot" id="modalFoot">
        <button class="btn-back" id="btnBack" onclick="prevStep()" style="visibility:hidden;">
            <i class="fa fa-arrow-left me-1"></i> Back
        </button>
        <button class="btn-next" id="btnNext" onclick="nextStep()">
            Next <i class="fa fa-arrow-right ms-1"></i>
        </button>
    </div>

</div><!-- /modal-box -->
</div><!-- /modal-overlay -->

<script>
var API = 'ticket-action.php';
var step = 1, totalSteps = 6;
var selDept = '', selFrom = '', selCat = '', selUrg = '';

function openModal() {
    resetWizard();
    document.getElementById('modalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}
function closeOnBackdrop(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();

// Wire button via event listener as reliable fallback
(function() {
    var btn = document.querySelector('.btn-report');
    if (btn) btn.addEventListener('click', openModal);
})();
}

// ── DEPARTMENT CATEGORIES ──
var DEPT_CATS = {
    'IT': [
        { icon:'fa-laptop',   label:'Computer / Laptop' },
        { icon:'fa-wifi',     label:'Internet / Wi-Fi' },
        { icon:'fa-print',    label:'Printer / Scanner' },
        { icon:'fa-envelope', label:'Email / Account' },
        { icon:'fa-database', label:'Hospital Software' },
        { icon:'fa-phone',    label:'Phone / Other' }
    ],
    'Finance': [
        { icon:'fa-money',        label:'Salary / Payroll' },
        { icon:'fa-file-text',    label:'Expense Claim' },
        { icon:'fa-bar-chart',    label:'Budget Request' },
        { icon:'fa-credit-card',  label:'Invoice / Payment' },
        { icon:'fa-shopping-cart',label:'Purchase Order' },
        { icon:'fa-line-chart',   label:'Financial Report' }
    ],
    'HR': [
        { icon:'fa-calendar',     label:'Leave Request' },
        { icon:'fa-file-text-o',  label:'Staff Contract' },
        { icon:'fa-user-plus',    label:'Recruitment' },
        { icon:'fa-graduation-cap',label:'Training / Development' },
        { icon:'fa-clock-o',      label:'Work Schedule' },
        { icon:'fa-gavel',        label:'Disciplinary / Grievance' }
    ],
    'Logistics': [
        { icon:'fa-medkit',       label:'Medical Supplies' },
        { icon:'fa-wrench',       label:'Equipment Request' },
        { icon:'fa-cubes',        label:'Stock / Inventory' },
        { icon:'fa-shopping-cart',label:'Purchase Order' },
        { icon:'fa-truck',        label:'Transport / Delivery' },
        { icon:'fa-archive',      label:'Storage' }
    ]
};

// ── SELECTORS ──
function selectDept(el, val) {
    document.querySelectorAll('.target-card').forEach(function(b){ b.classList.remove('selected'); });
    el.classList.add('selected');
    selDept = val;
    selCat = '';
    document.getElementById('errDept').classList.remove('show');
    // Populate step 2 categories for this department
    var cats = DEPT_CATS[val] || [];
    var grid = document.getElementById('catGrid');
    grid.innerHTML = '';
    cats.forEach(function(c) {
        var d = document.createElement('div');
        d.className = 'cat-card';
        d.innerHTML = '<i class="fa ' + c.icon + '"></i><span>' + c.label + '</span>';
        d.onclick = function(){ selectCat(d, c.label); };
        grid.appendChild(d);
    });
}
function selectFrom(el, val) {
    document.querySelectorAll('#fromGrid .dept-btn').forEach(function(b){ b.classList.remove('selected'); });
    el.classList.add('selected');
    var wrap = document.getElementById('otherFromWrap');
    if (val === 'Other') {
        wrap.style.display = 'block';
        selFrom = document.getElementById('otherFromInput').value.trim();
    } else {
        wrap.style.display = 'none';
        selFrom = val;
    }
    document.getElementById('errFrom').classList.remove('show');
}
function selectCat(el, val) {
    document.querySelectorAll('.cat-card').forEach(function(c){ c.classList.remove('selected'); });
    el.classList.add('selected');
    selCat = val;
    document.getElementById('errCat').classList.remove('show');
}
function selectUrg(el, val) {
    document.querySelectorAll('.urg-card').forEach(function(c){ c.classList.remove('selected'); });
    el.classList.add('selected');
    selUrg = val;
    document.getElementById('errUrg').classList.remove('show');
}
function showFileName(input) {
    document.getElementById('uploadName').textContent = input.files[0] ? input.files[0].name : '';
}

// ── NAVIGATION ──
function nextStep() {
    if (!validateStep()) return;
    if (step === totalSteps) { submitTicket(); return; }
    goStep(step + 1);
}
function prevStep() {
    if (step > 1) goStep(step - 1);
}
function goStep(n) {
    document.getElementById('step' + step).classList.remove('active');
    document.getElementById('ps' + step).classList.remove('active');
    document.getElementById('ps' + step).classList.add('done');
    step = n;
    document.getElementById('step' + step).classList.add('active');
    document.getElementById('ps' + step).classList.add('active');
    document.getElementById('ps' + step).classList.remove('done');
    // update lines
    for (var i = 1; i <= 5; i++) {
        document.getElementById('pl' + i).classList.toggle('done', i < step);
    }
    document.getElementById('btnBack').style.visibility = step > 1 ? 'visible' : 'hidden';
    document.getElementById('btnNext').innerHTML = step === totalSteps
        ? '<i class="fa fa-paper-plane me-1"></i> Submit Ticket'
        : 'Next <i class="fa fa-arrow-right ms-1"></i>';
    if (step === totalSteps) fillSummary();
    document.getElementById('modalBox').scrollTop = 0;
}

function validateStep() {
    if (step === 1) {
        if (!selDept) { document.getElementById('errDept').classList.add('show'); return false; }
    }
    if (step === 2) {
        if (document.getElementById('otherFromWrap').style.display !== 'none') {
            selFrom = document.getElementById('otherFromInput').value.trim();
        }
        if (!selFrom) { document.getElementById('errFrom').classList.add('show'); return false; }
    }
    if (step === 3) {
        if (!selCat)  { document.getElementById('errCat').classList.add('show'); return false; }
    }
    if (step === 4) {
        if (!selUrg)  { document.getElementById('errUrg').classList.add('show'); return false; }
    }
    if (step === 5) {
        var desc = document.getElementById('desc').value.trim();
        if (!desc) { document.getElementById('errDesc').classList.add('show'); return false; }
        document.getElementById('errDesc').classList.remove('show');
    }
    return true;
}

function fillSummary() {
    document.getElementById('sum-dept').textContent = selDept;
    document.getElementById('sum-from').textContent = selFrom;
    document.getElementById('sum-cat').textContent  = selCat;
    document.getElementById('sum-urg').textContent  = selUrg;
    document.getElementById('sum-desc').textContent = document.getElementById('desc').value.trim();
    var ext = document.getElementById('ext').value.trim();
    document.getElementById('sum-ext').textContent  = ext || 'Not provided';
}

// ── SUBMIT (optimistic — show success instantly, confirm in background) ──
function submitTicket() {
    var fd = new FormData();
    fd.append('action',      'submit');
    fd.append('department',  selDept);
    fd.append('from_dept',   selFrom);
    fd.append('category',    selCat);
    fd.append('urgency',     selUrg);
    fd.append('description', document.getElementById('desc').value.trim());
    fd.append('contact',     document.getElementById('ext').value.trim());

    // Show success immediately — don't make the user wait
    document.getElementById('ticketNumber').textContent = '…';
    showSuccess();

    fetch(API, { method:'POST', body:fd })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) {
                document.getElementById('ticketNumber').textContent = data.ticket_id;
            } else {
                // Rare: server rejected — show error inside success screen
                document.getElementById('ticketNumber').textContent = 'Error';
                document.getElementById('ticketNumber').style.background = '#fee2e2';
                document.getElementById('ticketNumber').style.color = '#b91c1c';
                document.getElementById('ticketNumber').textContent = data.error || 'Submission failed — please try again.';
            }
        })
        .catch(function() {
            document.getElementById('ticketNumber').textContent = 'No connection — ticket may not have been saved.';
            document.getElementById('ticketNumber').style.background = '#fee2e2';
            document.getElementById('ticketNumber').style.color = '#b91c1c';
        });
}

function showSuccess() {
    document.getElementById('progressWrap').style.display = 'none';
    document.getElementById('modalFoot').style.display = 'none';
    document.querySelector('.modal-body').style.display = 'none';
    document.getElementById('successScreen').classList.add('active');
}

function resetWizard() {
    step = 1; selDept = ''; selFrom = ''; selCat = ''; selUrg = '';
    document.querySelectorAll('.step-panel').forEach(function(p){ p.classList.remove('active'); });
    document.getElementById('step1').classList.add('active');
    document.querySelectorAll('.prog-step').forEach(function(p){ p.classList.remove('active','done'); });
    document.getElementById('ps1').classList.add('active');
    document.querySelectorAll('.prog-line').forEach(function(l){ l.classList.remove('done'); });
    document.querySelectorAll('.target-card,.dept-btn,.cat-card,.urg-card').forEach(function(el){ el.classList.remove('selected'); });
    document.getElementById('catGrid').innerHTML = '';
    document.getElementById('otherFromWrap').style.display = 'none';
    document.getElementById('otherFromInput').value = '';
    document.getElementById('desc').value = '';
    document.getElementById('ext').value = '';
    document.getElementById('uploadName').textContent = '';
    document.querySelectorAll('.err-msg').forEach(function(e){ e.classList.remove('show'); });
    document.getElementById('progressWrap').style.display = '';
    document.getElementById('modalFoot').style.display = '';
    document.querySelector('.modal-body').style.display = '';
    document.getElementById('successScreen').classList.remove('active');
    document.getElementById('btnBack').style.visibility = 'hidden';
    document.getElementById('btnNext').innerHTML = 'Next <i class="fa fa-arrow-right ms-1"></i>';
    document.getElementById('modalBox').scrollTop = 0;
}

// ── STATUS CHECKER ──
function checkTicket() {
    var input = document.getElementById('checkTicketId').value.trim().toUpperCase();
    var result = document.getElementById('ticketStatusResult');
    if (!input) {
        result.innerHTML = '<div style="background:#fff3f3;border:1px solid #e53935;border-radius:10px;padding:14px 16px;color:#c62828;font-size:13.5px;margin-top:12px;"><i class="fa fa-exclamation-circle me-2"></i>Please enter a ticket number.</div>';
        return;
    }
    result.innerHTML = '<div style="text-align:center;padding:20px;color:#64748b;margin-top:12px;"><i class="fa fa-spinner fa-spin me-2"></i>Checking…</div>';
    fetch(API + '?action=check&id=' + encodeURIComponent(input))
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (!data.success) {
                result.innerHTML = '<div style="background:#fff3f3;border:1px solid #e53935;border-radius:10px;padding:14px 16px;color:#c62828;font-size:13.5px;margin-top:12px;"><i class="fa fa-times-circle me-2"></i>Ticket <strong>' + input + '</strong> not found.</div>';
                return;
            }
            var t = data.ticket;
            var sc = {
                'New':                  { bg:'#E8F5E9', color:'#2E7D32', icon:'fa-clock-o' },
                'Acknowledged':         { bg:'#FFF8E1', color:'#F57F17', icon:'fa-eye' },
                'In Progress':          { bg:'#E3F2FD', color:'#1565C0', icon:'fa-cog' },
                'Waiting for Employee': { bg:'#F3E5F5', color:'#6A1B9A', icon:'fa-hourglass-half' },
                'Resolved':             { bg:'#EFEBE9', color:'#4E342E', icon:'fa-check-circle' }
            }[t.status] || { bg:'#f5f5f5', color:'#333', icon:'fa-info-circle' };
            var dt = new Date(t.submitted);
            var dateStr = dt.toLocaleDateString('en-GB',{day:'2-digit',month:'long',year:'numeric'}) + ' at ' + dt.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});
            result.innerHTML =
                '<div style="margin-top:16px;border:1.5px solid ' + sc.color + ';border-radius:12px;overflow:hidden;">' +
                    '<div style="background:' + sc.bg + ';padding:16px 20px;display:flex;align-items:center;gap:12px;">' +
                        '<i class="fa ' + sc.icon + '" style="font-size:24px;color:' + sc.color + ';"></i>' +
                        '<div>' +
                            '<div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:' + sc.color + ';">Current Status</div>' +
                            '<div style="font-size:1.2rem;font-weight:700;color:' + sc.color + ';font-family:\'Playfair Display\',serif;">' + t.status + '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div style="padding:16px 20px;background:#fff;display:flex;flex-wrap:wrap;gap:16px;">' +
                        '<div style="font-size:13px;"><strong style="color:#64748b;display:block;font-size:11px;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px;">Ticket #</strong>' + t.id + '</div>' +
                        '<div style="font-size:13px;"><strong style="color:#64748b;display:block;font-size:11px;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px;">Department</strong>' + t.department + '</div>' +
                        '<div style="font-size:13px;"><strong style="color:#64748b;display:block;font-size:11px;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px;">Category</strong>' + t.category + '</div>' +
                        '<div style="font-size:13px;"><strong style="color:#64748b;display:block;font-size:11px;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px;">Submitted</strong>' + dateStr + '</div>' +
                    '</div>' +
                    (t.notes ? '<div style="padding:14px 20px;background:#f8faff;border-top:1px solid #e2e8f0;"><strong style="font-size:11px;text-transform:uppercase;letter-spacing:.7px;color:var(--primary);display:block;margin-bottom:6px;">IT Notes</strong><p style="margin:0;font-size:13.5px;color:#1a2340;">' + t.notes + '</p></div>' : '') +
                '</div>';
        })
        .catch(function() {
            result.innerHTML = '<div style="background:#fff3f3;border:1px solid #e53935;border-radius:10px;padding:14px 16px;color:#c62828;font-size:13.5px;margin-top:12px;"><i class="fa fa-times-circle me-2"></i>Network error. Please try again.</div>';
        });
}
</script>
</body>
</html>
