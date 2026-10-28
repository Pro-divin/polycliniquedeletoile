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
            width: 100%; max-width: 520px;
            max-height: 92vh; overflow-y: auto;
            box-shadow: 0 32px 80px rgba(0,0,0,.35);
            animation: slideUp .28s cubic-bezier(.22,.68,0,1.2);
        }
        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .modal-head {
            background: linear-gradient(135deg, #146c43, #198754);
            border-radius: 20px 20px 0 0;
            padding: 22px 26px 18px;
            color: #fff;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        .modal-head-sub { font-size: 11px; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; font-weight: 600; }
        .modal-head h3 { font-family: 'Playfair Display', serif; font-size: 1.2rem; margin: 0; line-height: 1.3; }
        .modal-close {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,.15); border: none; color: #fff;
            cursor: pointer; font-size: 16px; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: background .2s; margin-left: 12px;
        }
        .modal-close:hover { background: rgba(255,255,255,.3); }

        /* Step body */
        .modal-body { padding: 26px 26px 6px; }
        .step-panel { display: none; }
        .step-panel.active { display: block; animation: fadeSlide .22s ease; }
        @keyframes fadeSlide { from { opacity: 0; transform: translateX(16px); } to { opacity: 1; transform: none; } }

        /* Field styles */
        .field-label { font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 7px; display: block; }
        .field-label .req { color: #e53935; }
        .field-input {
            width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
            padding: 12px 14px; font-size: 14px; font-family: 'Inter', sans-serif;
            color: var(--text); outline: none; transition: border-color .2s, box-shadow .2s;
        }
        .field-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(25,135,84,.1); }
        textarea.field-input { resize: vertical; min-height: 100px; }

        /* From dept grid */
        .dept-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 7px; }
        @media(max-width:400px){ .dept-grid { grid-template-columns: repeat(2,1fr); } }
        .dept-btn {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: 9px 6px; font-size: 11.5px; font-weight: 500;
            color: var(--text); background: #fff; cursor: pointer;
            transition: all .18s; text-align: center; line-height: 1.4;
        }
        .dept-btn:hover    { border-color: var(--primary); background: var(--primary-light); }
        .dept-btn.selected { border-color: var(--primary); background: var(--primary-light); color: var(--primary); font-weight: 700; }
        .dept-btn i { display: block; font-size: 17px; margin-bottom: 4px; color: var(--primary); }

        /* Target dept cards */
        .target-grid { display: flex; flex-direction: column; gap: 10px; }
        .target-card {
            display: flex; align-items: center; gap: 14px;
            border: 2px solid var(--border); border-radius: 12px;
            padding: 14px 16px; background: #fff; cursor: pointer;
            text-align: left; transition: all .18s; width: 100%;
        }
        .target-card:hover    { border-color: var(--primary); background: var(--primary-light); }
        .target-card.selected { border-color: var(--primary); background: var(--primary-light); }
        .target-icon { width: 44px; height: 44px; border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .target-info strong { font-size: 14px; font-weight: 700; color: var(--text); display: block; }
        .target-info span   { font-size: 11.5px; color: var(--muted); margin-top: 2px; display: block; }

        /* Category grid */
        .cat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        @media(max-width:400px){ .cat-grid { grid-template-columns: repeat(2,1fr); } }
        .cat-card {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: 14px 8px; cursor: pointer; text-align: center;
            transition: all .18s; background: #fff;
        }
        .cat-card i    { font-size: 22px; color: var(--primary); display: block; margin-bottom: 7px; }
        .cat-card span { font-size: 11px; font-weight: 600; color: var(--text); line-height: 1.35; display: block; }
        .cat-card:hover    { border-color: var(--primary); background: var(--primary-light); transform: translateY(-2px); }
        .cat-card.selected { border-color: var(--primary); background: var(--primary-light); box-shadow: 0 0 0 3px rgba(25,135,84,.15); }

        /* Urgency */
        .urg-list { display: flex; flex-direction: column; gap: 8px; }
        .urg-card {
            border: 1.5px solid var(--border); border-radius: 10px;
            padding: 12px 14px; cursor: pointer;
            display: flex; align-items: center; gap: 12px;
            transition: all .18s; background: #fff;
        }
        .urg-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; }
        .urg-card h5 { font-size: 13px; font-weight: 600; color: var(--text); margin: 0 0 1px; }
        .urg-card p  { font-size: 11.5px; color: var(--muted); margin: 0; }
        .urg-card:hover    { border-color: var(--primary); background: var(--primary-light); }
        .urg-card.selected { border-color: var(--primary); background: var(--primary-light); box-shadow: 0 0 0 3px rgba(25,135,84,.12); }
        .urg-check { margin-left: auto; color: var(--primary); display: none; font-size: 16px; }
        .urg-card.selected .urg-check { display: block; }

        /* Modal footer */
        .modal-foot { padding: 16px 26px 24px; display: flex; justify-content: space-between; align-items: center; }

        .btn-back {
            background: none; border: 1.5px solid var(--border); border-radius: 10px;
            padding: 11px 22px; font-size: 13px; font-weight: 600;
            color: var(--muted); cursor: pointer; transition: all .2s;
            font-family: 'Inter', sans-serif;
        }
        .btn-back:hover { border-color: var(--primary); color: var(--primary); }
        .btn-back.hidden { visibility: hidden; }

        /* Next / Submit — hidden until screen is valid */
        .btn-next {
            background: var(--primary); color: #fff;
            border: none; border-radius: 10px;
            padding: 12px 28px; font-size: 13.5px; font-weight: 700;
            cursor: pointer; display: flex; align-items: center; gap: 8px;
            font-family: 'Inter', sans-serif;
            opacity: 0; transform: translateY(8px);
            transition: opacity .25s, transform .25s, background .2s;
            pointer-events: none;
        }
        .btn-next.visible { opacity: 1; transform: translateY(0); pointer-events: auto; }
        .btn-next:hover { background: var(--primary-dark); }

        /* Success screen */
        .success-screen { padding: 40px 26px 32px; text-align: center; display: none; }
        .success-screen.active { display: block; }
        .success-ring {
            width: 78px; height: 78px; border-radius: 50%;
            background: linear-gradient(135deg, #E8F5E9, #C8E6C9);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px; font-size: 34px; color: #2E7D32;
            animation: popIn .4s cubic-bezier(.68,-.55,.27,1.55);
        }
        @keyframes popIn { from { transform: scale(0); } to { transform: scale(1); } }
        .success-screen h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--text); margin-bottom: 8px; }
        .success-screen p  { font-size: 13.5px; color: var(--muted); max-width: 340px; margin: 0 auto 20px; line-height: 1.7; }
        .ticket-pill {
            display: inline-block; background: var(--primary); color: #fff;
            border-radius: 100px; padding: 10px 32px;
            font-size: 1.3rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 6px;
        }
        .success-note { font-size: 12px; color: var(--muted); margin-bottom: 20px; }
        .btn-another {
            background: none; border: 1.5px solid var(--primary); color: var(--primary);
            border-radius: 10px; padding: 11px 28px; font-size: 14px; font-weight: 600;
            cursor: pointer; font-family: 'Inter', sans-serif; transition: all .2s;
        }
        .btn-another:hover { background: var(--primary); color: #fff; }

        .err-msg { font-size: 12px; color: #e53935; margin-top: 6px; display: none; }
        .err-msg.show { display: block; }
        .section-gap { margin-bottom: 18px; }
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
     MODAL WIZARD — 3 screens, no step dots
════════════════════════════════════ -->
<div class="modal-overlay" id="modalOverlay" onclick="closeOnBackdrop(event)">
<div class="modal-box" id="modalBox">

    <!-- Dynamic header -->
    <div class="modal-head" id="modalHead">
        <div>
            <div class="modal-head-sub" id="headSub">Step 1 of 3</div>
            <h3 id="headTitle">Who are you?</h3>
        </div>
        <button class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
    </div>

    <!-- SCREEN 1: Name & Your Department -->
    <div class="modal-body">
    <div class="step-panel active" id="step1">
        <div class="section-gap">
            <label class="field-label">Your name &amp; extension <span class="req">*</span></label>
            <input type="text" class="field-input" id="ext" placeholder="e.g. Marie — Ext. 205"
                   oninput="checkStep1()">
        </div>
        <div>
            <label class="field-label">Your department <span class="req">*</span></label>
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
            <div id="otherFromWrap" style="display:none;margin-top:10px;">
                <input type="text" class="field-input" id="otherFromInput" placeholder="Specify your department…" oninput="selFrom=this.value.trim();checkStep1()">
            </div>
        </div>
    </div>

    <!-- SCREEN 2: Which department to submit to -->
    <div class="step-panel" id="step2">
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
    </div>

    <!-- SCREEN 3: Issue details -->
    <div class="step-panel" id="step3">
        <div class="section-gap">
            <label class="field-label">Issue type <span class="req">*</span></label>
            <div class="cat-grid" id="catGrid"></div>
        </div>
        <div class="section-gap">
            <label class="field-label">Urgency <span class="req">*</span></label>
            <div class="urg-list">
                <div class="urg-card" onclick="selectUrg(this,'Low')">
                    <div class="urg-dot" style="background:#4CAF50;"></div>
                    <div><h5>Low</h5><p>Minor — work can continue normally</p></div>
                    <i class="fa fa-check-circle urg-check"></i>
                </div>
                <div class="urg-card" onclick="selectUrg(this,'Normal')">
                    <div class="urg-dot" style="background:#2196F3;"></div>
                    <div><h5>Normal</h5><p>Some work is affected but manageable</p></div>
                    <i class="fa fa-check-circle urg-check"></i>
                </div>
                <div class="urg-card" onclick="selectUrg(this,'High')">
                    <div class="urg-dot" style="background:#FF9800;"></div>
                    <div><h5>High</h5><p>Department work is significantly blocked</p></div>
                    <i class="fa fa-check-circle urg-check"></i>
                </div>
                <div class="urg-card" onclick="selectUrg(this,'Critical')">
                    <div class="urg-dot" style="background:#F44336;"></div>
                    <div><h5>Critical</h5><p>Major outage — patient care is impacted</p></div>
                    <i class="fa fa-check-circle urg-check"></i>
                </div>
            </div>
        </div>
        <div>
            <label class="field-label">Describe your issue <span class="req">*</span></label>
            <textarea class="field-input" id="desc" placeholder="Explain what happened, what you were doing, and any error messages…" oninput="checkStep3()"></textarea>
        </div>
    </div>
    </div><!-- /modal-body -->

    <!-- Success screen -->
    <div class="success-screen" id="successScreen">
        <div class="success-ring"><i class="fa fa-check"></i></div>
        <h3>Request Submitted!</h3>
        <p>Your issue has been logged and the relevant department has been notified. They will follow up with you shortly.</p>
        <div class="ticket-pill" id="ticketNumber">…</div>
        <p class="success-note">Keep this number to track your ticket status below.</p>
        <button class="btn-another" onclick="resetWizard()"><i class="fa fa-plus me-1"></i>Report Another Issue</button>
    </div>

    <!-- Footer -->
    <div class="modal-foot" id="modalFoot">
        <button class="btn-back" id="btnBack" onclick="prevStep()">
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
var step = 1;
var selDept = '', selFrom = '', selCat = '', selUrg = '';

var HEADS = [
    { sub: 'Step 1 of 3', title: 'Who are you?' },
    { sub: 'Step 2 of 3', title: 'Who do you want to contact?' },
    { sub: 'Step 3 of 3', title: 'What is your issue?' }
];

var DEPT_CATS = {
    'IT': [
        { icon:'fa-laptop',        label:'Computer / Laptop' },
        { icon:'fa-wifi',          label:'Internet / Wi-Fi' },
        { icon:'fa-print',         label:'Printer / Scanner' },
        { icon:'fa-envelope',      label:'Email / Account' },
        { icon:'fa-database',      label:'Hospital Software' },
        { icon:'fa-phone',         label:'Phone / Other' }
    ],
    'Finance': [
        { icon:'fa-money',         label:'Salary / Payroll' },
        { icon:'fa-file-text',     label:'Expense Claim' },
        { icon:'fa-bar-chart',     label:'Budget Request' },
        { icon:'fa-credit-card',   label:'Invoice / Payment' },
        { icon:'fa-shopping-cart', label:'Purchase Order' },
        { icon:'fa-line-chart',    label:'Financial Report' }
    ],
    'HR': [
        { icon:'fa-calendar',      label:'Leave Request' },
        { icon:'fa-file-text-o',   label:'Staff Contract' },
        { icon:'fa-user-plus',     label:'Recruitment' },
        { icon:'fa-graduation-cap',label:'Training / Development' },
        { icon:'fa-clock-o',       label:'Work Schedule' },
        { icon:'fa-gavel',         label:'Disciplinary / Grievance' }
    ],
    'Logistics': [
        { icon:'fa-medkit',        label:'Medical Supplies' },
        { icon:'fa-wrench',        label:'Equipment Request' },
        { icon:'fa-cubes',         label:'Stock / Inventory' },
        { icon:'fa-shopping-cart', label:'Purchase Order' },
        { icon:'fa-truck',         label:'Transport / Delivery' },
        { icon:'fa-archive',       label:'Storage' }
    ]
};

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
}

// ── SELECTOR HELPERS ──
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
    checkStep1();
}
function selectDept(el, val) {
    document.querySelectorAll('.target-card').forEach(function(b){ b.classList.remove('selected'); });
    el.classList.add('selected');
    selDept = val;
    selCat  = '';
    // Build category grid for step 3
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
    showNext(true, 'Next <i class="fa fa-arrow-right ms-1"></i>');
}
function selectCat(el, val) {
    document.querySelectorAll('.cat-card').forEach(function(c){ c.classList.remove('selected'); });
    el.classList.add('selected');
    selCat = val;
    checkStep3();
}
function selectUrg(el, val) {
    document.querySelectorAll('.urg-card').forEach(function(c){ c.classList.remove('selected'); });
    el.classList.add('selected');
    selUrg = val;
    checkStep3();
}

// ── CONDITIONAL NEXT BUTTON ──
function showNext(visible, html) {
    var btn = document.getElementById('btnNext');
    if (html) btn.innerHTML = html;
    if (visible) btn.classList.add('visible');
    else         btn.classList.remove('visible');
}
function checkStep1() {
    var name = document.getElementById('ext').value.trim();
    if (selFrom === 'Other') selFrom = document.getElementById('otherFromInput').value.trim();
    showNext(name.length > 0 && selFrom.length > 0, 'Next <i class="fa fa-arrow-right ms-1"></i>');
}
function checkStep3() {
    var desc = document.getElementById('desc').value.trim();
    showNext(selCat && selUrg && desc.length > 0, '<i class="fa fa-paper-plane me-1"></i> Submit');
}

// ── NAVIGATION ──
function nextStep() {
    if (step === 3) { submitTicket(); return; }
    goStep(step + 1);
}
function prevStep() {
    if (step > 1) goStep(step - 1);
}
function goStep(n) {
    document.getElementById('step' + step).classList.remove('active');
    step = n;
    document.getElementById('step' + step).classList.add('active');
    // Update header
    document.getElementById('headSub').textContent   = HEADS[step-1].sub;
    document.getElementById('headTitle').textContent = HEADS[step-1].title;
    // Back button
    var back = document.getElementById('btnBack');
    back.classList.toggle('hidden', step === 1);
    // Next button state for new screen
    if (step === 1) { showNext(false); checkStep1(); }
    if (step === 2) { showNext(selDept.length > 0, 'Next <i class="fa fa-arrow-right ms-1"></i>'); }
    if (step === 3) { showNext(false); checkStep3(); }
    document.getElementById('modalBox').scrollTop = 0;
}

// ── SUBMIT ──
function submitTicket() {
    var fd = new FormData();
    fd.append('action',      'submit');
    fd.append('department',  selDept);
    fd.append('from_dept',   selFrom);
    fd.append('category',    selCat);
    fd.append('urgency',     selUrg);
    fd.append('description', document.getElementById('desc').value.trim());
    fd.append('contact',     document.getElementById('ext').value.trim());
    document.getElementById('ticketNumber').textContent = '…';
    showSuccess();
    fetch(API, { method:'POST', body:fd })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            var pill = document.getElementById('ticketNumber');
            if (data.success) {
                pill.textContent = data.ticket_id;
                pill.style.background = '';
                pill.style.color = '';
            } else {
                pill.textContent = data.error || 'Submission failed — please retry.';
                pill.style.background = '#fee2e2'; pill.style.color = '#b91c1c';
            }
        })
        .catch(function() {
            var pill = document.getElementById('ticketNumber');
            pill.textContent = 'No connection — please retry.';
            pill.style.background = '#fee2e2'; pill.style.color = '#b91c1c';
        });
}
function showSuccess() {
    document.getElementById('modalFoot').style.display = 'none';
    document.querySelector('.modal-body').style.display = 'none';
    document.getElementById('modalHead').style.display = 'none';
    document.getElementById('successScreen').classList.add('active');
}
function resetWizard() {
    step = 1; selDept = ''; selFrom = ''; selCat = ''; selUrg = '';
    document.querySelectorAll('.step-panel').forEach(function(p){ p.classList.remove('active'); });
    document.getElementById('step1').classList.add('active');
    document.querySelectorAll('.target-card,.dept-btn,.cat-card,.urg-card').forEach(function(el){ el.classList.remove('selected'); });
    document.getElementById('catGrid').innerHTML = '';
    document.getElementById('otherFromWrap').style.display = 'none';
    document.getElementById('otherFromInput').value = '';
    document.getElementById('ext').value = '';
    document.getElementById('desc').value = '';
    document.getElementById('modalFoot').style.display = '';
    document.querySelector('.modal-body').style.display = '';
    document.getElementById('modalHead').style.display = '';
    document.getElementById('successScreen').classList.remove('active');
    document.getElementById('ticketNumber').style.background = '';
    document.getElementById('ticketNumber').style.color = '';
    document.getElementById('headSub').textContent   = HEADS[0].sub;
    document.getElementById('headTitle').textContent = HEADS[0].title;
    document.getElementById('btnBack').classList.add('hidden');
    showNext(false, 'Next <i class="fa fa-arrow-right ms-1"></i>');
    document.getElementById('modalBox').scrollTop = 0;
}

// Wire report button
(function() {
    var btn = document.querySelector('.btn-report');
    if (btn) btn.addEventListener('click', openModal);
})();

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
