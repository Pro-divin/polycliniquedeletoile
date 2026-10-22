<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Centre — Polyclinique de l'Etoile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1565C0;
            --primary-dark: #0D47A1;
            --primary-light: #E3F2FD;
            --primary-mid: #1976D2;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f0f4f8;
            min-height: 100vh;
            margin: 0;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            background: #0a0a0a;
            color: #ccc;
            font-size: 12.5px;
            padding: 8px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar a { color: #ccc; text-decoration: none; }
        .topbar .topbar-brand { font-family: 'Playfair Display', serif; color: #fff; font-size: 13px; font-weight: 600; }

        /* ─── HEADER ─── */
        .support-header {
            background: var(--primary);
            color: #fff;
            padding: 28px 28px 22px;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.18);
        }
        .support-header .logo-wrap {
            background: rgba(255,255,255,0.12);
            border-radius: 10px;
            width: 56px; height: 56px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .support-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            font-weight: 700;
            margin: 0 0 3px;
        }
        .support-header p { margin: 0; opacity: 0.85; font-size: 13.5px; }

        /* ─── MAIN LAYOUT ─── */
        .page-wrap {
            max-width: 900px;
            margin: 36px auto 60px;
            padding: 0 16px;
        }

        /* ─── CARD ─── */
        .card-support {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 28px rgba(0,0,0,0.09);
            padding: 36px 40px;
        }
        @media(max-width:600px){ .card-support { padding: 24px 18px; } }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--primary);
            margin-bottom: 6px;
        }
        .card-support h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 6px;
        }
        .card-support .subtitle {
            color: #666;
            font-size: 14px;
            margin: 0 0 30px;
        }

        /* ─── FORM ELEMENTS ─── */
        label.form-label {
            font-weight: 600;
            font-size: 13.5px;
            color: #2c2c2c;
            margin-bottom: 6px;
        }
        label.form-label .req { color: var(--primary); margin-left: 2px; }
        .form-control, .form-select {
            border: 1.5px solid #d4dae3;
            border-radius: 7px;
            font-size: 14px;
            padding: 10px 14px;
            color: #2c2c2c;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(21,101,192,0.12);
            outline: none;
        }
        textarea.form-control { resize: vertical; min-height: 100px; }

        /* ─── URGENCY BUTTONS ─── */
        .urgency-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        @media(max-width:520px){ .urgency-grid { grid-template-columns: 1fr; } }
        .urgency-option { display: none; }
        .urgency-label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1.5px solid #d4dae3;
            border-radius: 9px;
            padding: 12px 14px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            background: #fff;
        }
        .urgency-label:hover { border-color: var(--primary); background: var(--primary-light); }
        .urgency-option:checked + .urgency-label {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(21,101,192,0.1);
        }
        .urgency-dot {
            width: 16px; height: 16px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .dot-low    { background: #43a047; }
        .dot-normal { background: #fb8c00; }
        .dot-high   { background: #e53935; }
        .dot-critical { background: #6a1a1a; }
        .urgency-text strong { font-size: 13px; color: #1a1a2e; display: block; margin-bottom: 2px; }
        .urgency-text span { font-size: 12px; color: #666; }

        /* ─── PROBLEM CATEGORIES ─── */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        @media(max-width:520px){ .category-grid { grid-template-columns: repeat(2, 1fr); } }
        .cat-option { display: none; }
        .cat-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 8px;
            border: 1.5px solid #d4dae3;
            border-radius: 9px;
            padding: 14px 10px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
            font-size: 12.5px;
            font-weight: 600;
            color: #333;
            background: #fff;
        }
        .cat-label i { font-size: 22px; color: var(--primary); }
        .cat-label:hover { border-color: var(--primary); background: var(--primary-light); }
        .cat-option:checked + .cat-label {
            border-color: var(--primary);
            background: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(21,101,192,0.1);
            color: var(--primary-dark);
        }
        .cat-option:checked + .cat-label i { color: var(--primary-dark); }

        /* ─── SUBMIT BUTTON ─── */
        .btn-submit {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px 36px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-submit:hover { background: var(--primary-dark); transform: translateY(-1px); }
        .btn-submit:active { transform: translateY(0); }

        /* ─── DIVIDER ─── */
        .form-divider {
            border: none;
            border-top: 1px solid #eaeef4;
            margin: 28px 0;
        }

        /* ─── SUCCESS STATE ─── */
        #successPanel {
            display: none;
            text-align: center;
            padding: 40px 20px;
        }
        #successPanel .check-circle {
            width: 72px; height: 72px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
        }
        #successPanel .check-circle i { font-size: 34px; color: var(--primary); }
        #successPanel h3 { font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #1a1a2e; margin: 0 0 10px; }
        #successPanel p { color: #666; font-size: 14px; max-width: 420px; margin: 0 auto 22px; }
        #successPanel .ticket-badge {
            display: inline-block;
            background: var(--primary);
            color: #fff;
            border-radius: 6px;
            padding: 8px 22px;
            font-size: 18px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
            margin-bottom: 24px;
        }

        /* ─── HOW IT WORKS SIDEBAR ─── */
        .steps-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 28px rgba(0,0,0,0.09);
            padding: 28px 24px;
        }
        .steps-card h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1a1a2e;
            margin: 0 0 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--primary-light);
        }
        .step-item {
            display: flex;
            gap: 14px;
            margin-bottom: 18px;
        }
        .step-num {
            width: 28px; height: 28px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .step-text strong { display: block; font-size: 13px; color: #1a1a2e; margin-bottom: 3px; }
        .step-text span { font-size: 12px; color: #666; line-height: 1.6; }

        .contact-box {
            background: var(--primary-light);
            border-radius: 8px;
            padding: 16px;
            margin-top: 20px;
            border-left: 4px solid var(--primary);
        }
        .contact-box p { margin: 0; font-size: 13px; color: #1a1a2e; }
        .contact-box strong { display: block; margin-bottom: 4px; color: var(--primary-dark); font-size: 13px; }

        /* ─── FOOTER ─── */
        .support-footer {
            background: #0a0a0a;
            color: #888;
            text-align: center;
            padding: 18px;
            font-size: 12px;
        }
        .support-footer a { color: var(--primary); text-decoration: none; }
    </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <span class="topbar-brand">
        <i class="fa fa-hospital-o me-2" style="color:var(--primary);"></i>
        Polyclinique de l'Etoile
    </span>
    <span>
        <i class="fa fa-map-marker me-1" style="color:var(--primary);"></i>
        Gasabo, Remera, Rukiri I, Kigali &nbsp;|&nbsp;
        <i class="fa fa-phone me-1" style="color:var(--primary);"></i>
        Free Call 1301
    </span>
</div>

<!-- Header -->
<div class="support-header">
    <div class="logo-wrap">
        <i class="fa fa-headphones" style="font-size:26px; color:#fff;"></i>
    </div>
    <div>
        <h1>IT Support Centre</h1>
        <p>Polyclinique de l'Etoile &mdash; Internal Staff Portal</p>
    </div>
</div>

<!-- Page Body -->
<div class="page-wrap">
    <div class="row g-4">

        <!-- Form Column -->
        <div class="col-lg-8">
            <div class="card-support">

                <!-- Form state -->
                <div id="formPanel">
                    <div class="section-label">New Ticket</div>
                    <h2>How can we help you?</h2>
                    <p class="subtitle">Report a technical issue and our IT team will follow up promptly.</p>

                    <form id="supportForm" novalidate>

                        <!-- Department -->
                        <div class="mb-4">
                            <label class="form-label" for="dept">Department <span class="req">*</span></label>
                            <select class="form-select" id="dept" required>
                                <option value="" disabled selected>Select your department</option>
                                <option>Reception</option>
                                <option>Consultation</option>
                                <option>Laboratory</option>
                                <option>Pharmacy</option>
                                <option>Radiology / Imaging</option>
                                <option>Nursing</option>
                                <option>Inpatient Ward</option>
                                <option>Paediatrics</option>
                                <option>Gynaecology</option>
                                <option>Endoscopy</option>
                                <option>Minor Surgery</option>
                                <option>Administration / Finance</option>
                                <option>IT Department</option>
                                <option>Management</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <!-- Problem Category -->
                        <div class="mb-4">
                            <label class="form-label">What is the problem? <span class="req">*</span></label>
                            <div class="category-grid" id="catGrid">
                                <div>
                                    <input type="radio" name="category" id="cat1" value="Computer / Laptop" class="cat-option" required>
                                    <label class="cat-label" for="cat1">
                                        <i class="fa fa-laptop"></i>
                                        Computer / Laptop
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="category" id="cat2" value="Internet / Wi-Fi" class="cat-option">
                                    <label class="cat-label" for="cat2">
                                        <i class="fa fa-wifi"></i>
                                        Internet / Wi-Fi
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="category" id="cat3" value="Printer / Scanner" class="cat-option">
                                    <label class="cat-label" for="cat3">
                                        <i class="fa fa-print"></i>
                                        Printer / Scanner
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="category" id="cat4" value="Email / Account" class="cat-option">
                                    <label class="cat-label" for="cat4">
                                        <i class="fa fa-envelope"></i>
                                        Email / Account
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="category" id="cat5" value="Hospital Software" class="cat-option">
                                    <label class="cat-label" for="cat5">
                                        <i class="fa fa-database"></i>
                                        Hospital Software
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="category" id="cat6" value="Phone / Other" class="cat-option">
                                    <label class="cat-label" for="cat6">
                                        <i class="fa fa-phone"></i>
                                        Phone / Other
                                    </label>
                                </div>
                            </div>
                            <div id="catError" style="color:#e53935; font-size:12.5px; margin-top:6px; display:none;">
                                <i class="fa fa-exclamation-circle me-1"></i>Please select a problem category.
                            </div>
                        </div>

                        <!-- Urgency -->
                        <div class="mb-4">
                            <label class="form-label">Urgency <span class="req">*</span></label>
                            <div class="urgency-grid">
                                <div>
                                    <input type="radio" name="urgency" id="urg1" value="Low" class="urgency-option" required>
                                    <label class="urgency-label" for="urg1">
                                        <span class="urgency-dot dot-low"></span>
                                        <span class="urgency-text">
                                            <strong>Low</strong>
                                            <span>Minor issue, work can continue</span>
                                        </span>
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="urgency" id="urg2" value="Normal" class="urgency-option">
                                    <label class="urgency-label" for="urg2">
                                        <span class="urgency-dot dot-normal"></span>
                                        <span class="urgency-text">
                                            <strong>Normal</strong>
                                            <span>Some work is affected</span>
                                        </span>
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="urgency" id="urg3" value="High" class="urgency-option">
                                    <label class="urgency-label" for="urg3">
                                        <span class="urgency-dot dot-high"></span>
                                        <span class="urgency-text">
                                            <strong>High</strong>
                                            <span>A department's work is blocked</span>
                                        </span>
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="urgency" id="urg4" value="Critical" class="urgency-option">
                                    <label class="urgency-label" for="urg4">
                                        <span class="urgency-dot dot-critical"></span>
                                        <span class="urgency-text">
                                            <strong>Critical</strong>
                                            <span>Major outage or patient-care impact</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div id="urgError" style="color:#e53935; font-size:12.5px; margin-top:6px; display:none;">
                                <i class="fa fa-exclamation-circle me-1"></i>Please select an urgency level.
                            </div>
                        </div>

                        <hr class="form-divider">

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label" for="desc">Describe the problem <span class="req">*</span></label>
                            <textarea class="form-control" id="desc" rows="4" placeholder="Explain what happened, what you were doing, and any error messages you saw…" required></textarea>
                        </div>

                        <!-- Contact extension -->
                        <div class="mb-4">
                            <label class="form-label" for="ext">Your name &amp; contact extension or phone <span style="color:#999; font-weight:400;">(optional)</span></label>
                            <input type="text" class="form-control" id="ext" placeholder="e.g. Marie — Ext. 205 or 0788 123 456">
                        </div>

                        <!-- Screenshot -->
                        <div class="mb-4">
                            <label class="form-label" for="screenshot">Attach a screenshot <span style="color:#999; font-weight:400;">(optional)</span></label>
                            <input type="file" class="form-control" id="screenshot" accept="image/*,.pdf">
                            <div style="font-size:12px; color:#888; margin-top:5px;">Accepted: JPG, PNG, PDF — max 5 MB</div>
                        </div>

                        <div id="formError" style="background:#fff3f3; border:1px solid #e53935; border-radius:7px; padding:10px 14px; font-size:13px; color:#c62828; margin-bottom:18px; display:none;">
                            <i class="fa fa-exclamation-triangle me-2"></i>Please fill in all required fields before submitting.
                        </div>

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <button type="submit" class="btn-submit">
                                <i class="fa fa-paper-plane"></i>
                                Submit Ticket
                            </button>
                            <span style="font-size:12px; color:#999;">
                                <i class="fa fa-lock me-1"></i>Internal staff use only
                            </span>
                        </div>
                    </form>
                </div>

                <!-- Success state -->
                <div id="successPanel">
                    <div class="check-circle">
                        <i class="fa fa-check"></i>
                    </div>
                    <h3>Ticket Submitted Successfully</h3>
                    <p>Your IT issue has been logged. The IT team has been notified and will follow up shortly.</p>
                    <div class="ticket-badge" id="ticketNumber">IT-0000</div>
                    <br>
                    <p style="font-size:13px; color:#888;">Keep this ticket number for reference.</p>
                    <button onclick="resetForm()" style="background:none; border:1.5px solid var(--primary); color:var(--primary); border-radius:7px; padding:10px 24px; font-weight:600; cursor:pointer; font-size:14px; margin-top:8px;">
                        <i class="fa fa-plus me-1"></i> Report Another Issue
                    </button>
                </div>

            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="steps-card">
                <h5><i class="fa fa-info-circle me-2" style="color:var(--primary);"></i>How it works</h5>

                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-text">
                        <strong>You submit a ticket</strong>
                        <span>Select your department, problem type, urgency, and describe the issue in 30–60 seconds.</span>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-text">
                        <strong>IT receives an instant alert</strong>
                        <span>The IT officer is notified by email and WhatsApp with your ticket number, department, and priority.</span>
                    </div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-text">
                        <strong>IT investigates &amp; updates</strong>
                        <span>Status updates: Acknowledged → In Progress → Resolved. You can check progress at any time.</span>
                    </div>
                </div>
                <div class="step-item" style="margin-bottom:0;">
                    <div class="step-num">4</div>
                    <div class="step-text">
                        <strong>Resolution is recorded</strong>
                        <span>The solution and response time are recorded for management review.</span>
                    </div>
                </div>

                <div class="contact-box">
                    <strong><i class="fa fa-phone me-1"></i>Urgent? Call IT directly</strong>
                    <p>Internal extension: <strong>Ext. 100</strong><br>
                    WhatsApp: <strong>+(250) 790 008 754</strong><br>
                    Email: <strong>it@polycliniquedeletoile.com</strong></p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Check Ticket Status Section -->
<div style="background:#fff; border-top:3px solid var(--primary); padding:40px 16px;">
    <div style="max-width:600px; margin:0 auto;">
        <div style="text-align:center; margin-bottom:24px;">
            <div style="width:52px; height:52px; background:var(--primary-light); border-radius:50%;
                        display:inline-flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <i class="fa fa-search" style="font-size:20px; color:var(--primary);"></i>
            </div>
            <h3 style="font-family:'Playfair Display',serif; font-size:1.3rem; color:#1a1a2e; margin:0 0 6px;">Check Your Ticket Status</h3>
            <p style="color:#777; font-size:13.5px; margin:0;">Enter your ticket number to see the latest update from IT.</p>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <input type="text" id="checkTicketId" placeholder="e.g. IT-1001"
                   style="flex:1; border:1.5px solid #d4dae3; border-radius:7px; padding:11px 14px;
                          font-size:14px; font-family:'Open Sans',sans-serif; min-width:180px;"
                   onkeydown="if(event.key==='Enter')checkTicket()">
            <button onclick="checkTicket()"
                    style="background:var(--primary); color:#fff; border:none; border-radius:7px;
                           padding:11px 24px; font-size:14px; font-weight:700; cursor:pointer;
                           font-family:'Playfair Display',serif; white-space:nowrap;">
                <i class="fa fa-search me-1"></i> Check Status
            </button>
        </div>
        <div id="ticketStatusResult" style="margin-top:18px; display:none;"></div>
    </div>
</div>

<!-- Footer -->
<div class="support-footer">
    &copy; 2026 <a href="https://www.polycliniquedeletoile.com">Polyclinique de l'Etoile</a> &mdash; IT Support Centre &mdash; Internal Staff Portal
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <a href="it-dashboard.php" style="color:#aaa; font-size:11px;">IT Staff Dashboard</a>
</div>

<script>
var API = 'ticket-action.php';

document.getElementById('supportForm').addEventListener('submit', function(e) {
    e.preventDefault();

    var dept = document.getElementById('dept').value;
    var cat  = document.querySelector('input[name="category"]:checked');
    var urg  = document.querySelector('input[name="urgency"]:checked');
    var desc = document.getElementById('desc').value.trim();
    var ext  = document.getElementById('ext').value.trim();
    var valid = true;

    document.getElementById('catError').style.display = cat  ? 'none' : 'block';
    document.getElementById('urgError').style.display = urg  ? 'none' : 'block';
    if (!cat) valid = false;
    if (!urg) valid = false;

    if (!dept || !desc) {
        document.getElementById('formError').style.display = 'block';
        valid = false;
    } else {
        document.getElementById('formError').style.display = 'none';
    }

    if (!valid) return;

    var btn = document.querySelector('.btn-submit');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Submitting…';

    var fd = new FormData();
    fd.append('action',      'submit');
    fd.append('department',  dept);
    fd.append('category',    cat.value);
    fd.append('urgency',     urg.value);
    fd.append('description', desc);
    fd.append('contact',     ext);

    fetch(API, { method:'POST', body:fd })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-paper-plane"></i> Submit Ticket';
            if (data.success) {
                document.getElementById('ticketNumber').textContent = data.ticket_id;
                document.getElementById('formPanel').style.display = 'none';
                document.getElementById('successPanel').style.display = 'block';
            } else {
                document.getElementById('formError').textContent = data.error || 'Submission failed. Please try again.';
                document.getElementById('formError').style.display = 'block';
            }
        })
        .catch(function() {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-paper-plane"></i> Submit Ticket';
            document.getElementById('formError').textContent = 'Network error. Please try again.';
            document.getElementById('formError').style.display = 'block';
        });
});

function resetForm() {
    document.getElementById('supportForm').reset();
    document.querySelectorAll('.cat-option, .urgency-option').forEach(function(r) { r.checked = false; });
    document.getElementById('catError').style.display = 'none';
    document.getElementById('urgError').style.display = 'none';
    document.getElementById('formError').style.display = 'none';
    document.getElementById('formPanel').style.display = 'block';
    document.getElementById('successPanel').style.display = 'none';
}

function checkTicket() {
    var input = document.getElementById('checkTicketId').value.trim().toUpperCase();
    var result = document.getElementById('ticketStatusResult');
    if (!input) {
        result.style.display = 'block';
        result.innerHTML = '<div style="background:#fff3f3; border:1px solid #e53935; border-radius:8px; padding:14px 16px; color:#c62828; font-size:13.5px;"><i class="fa fa-exclamation-circle me-2"></i>Please enter a ticket number.</div>';
        return;
    }
    result.style.display = 'block';
    result.innerHTML = '<div style="text-align:center; padding:16px; color:#555;"><i class="fa fa-spinner fa-spin me-2"></i>Checking ticket…</div>';

    fetch(API + '?action=check&id=' + encodeURIComponent(input))
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (!data.success) {
                result.innerHTML = '<div style="background:#fff3f3; border:1px solid #e53935; border-radius:8px; padding:14px 16px; color:#c62828; font-size:13.5px;"><i class="fa fa-times-circle me-2"></i>Ticket <strong>' + input + '</strong> not found. Please check the number and try again.</div>';
                return;
            }
            var t = data.ticket;

    var statusColors = {
        'New':                  { bg:'#E8F5E9', color:'#2E7D32', icon:'fa-clock-o' },
        'Acknowledged':         { bg:'#FFF8E1', color:'#F57F17', icon:'fa-eye' },
        'In Progress':          { bg:'#E8F5E9', color:'#2E7D32', icon:'fa-cog' },
        'Waiting for Employee': { bg:'#F3E5F5', color:'#6A1B9A', icon:'fa-hourglass-half' },
        'Resolved':             { bg:'#EFEBE9', color:'#4E342E', icon:'fa-check-circle' }
    };
    var sc = statusColors[t.status] || { bg:'#f5f5f5', color:'#333', icon:'fa-info-circle' };
    var dt = new Date(t.submitted);
    var dateStr = dt.toLocaleDateString('en-GB',{day:'2-digit',month:'long',year:'numeric'})
                + ' at ' + dt.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});
    var updatedStr = t.updatedAt ? 'Last updated: ' + new Date(t.updatedAt).toLocaleString('en-GB') : '';

    result.style.display = 'block';
    result.innerHTML =
        '<div style="border:1.5px solid ' + sc.color + '; border-radius:10px; overflow:hidden;">' +
            '<div style="background:' + sc.bg + '; padding:14px 18px; display:flex; align-items:center; gap:12px;">' +
                '<i class="fa ' + sc.icon + '" style="font-size:22px; color:' + sc.color + ';"></i>' +
                '<div>' +
                    '<div style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:' + sc.color + ';">Current Status</div>' +
                    '<div style="font-size:1.2rem; font-weight:700; color:' + sc.color + '; font-family:\'Playfair Display\',serif;">' + t.status + '</div>' +
                '</div>' +
            '</div>' +
            '<div style="padding:16px 18px; background:#fff;">' +
                '<div style="display:flex; flex-wrap:wrap; gap:16px; font-size:13px; color:#555; margin-bottom:' + (t.notes ? '14px' : '0') + ';">' +
                    '<div><strong style="color:#1a1a2e;">Ticket #</strong><br>' + t.id + '</div>' +
                    '<div><strong style="color:#1a1a2e;">Department</strong><br>' + t.department + '</div>' +
                    '<div><strong style="color:#1a1a2e;">Category</strong><br>' + t.category + '</div>' +
                    '<div><strong style="color:#1a1a2e;">Submitted</strong><br>' + dateStr + '</div>' +
                    (updatedStr ? '<div><strong style="color:#1a1a2e;">Updated</strong><br>' + updatedStr + '</div>' : '') +
                '</div>' +
                (t.notes ? '<div style="background:#f8f9ff; border-left:4px solid var(--primary); border-radius:0 6px 6px 0; padding:12px 14px; margin-top:4px;"><strong style="font-size:12px; text-transform:uppercase; letter-spacing:.7px; color:var(--primary);">IT Notes</strong><p style="margin:6px 0 0; font-size:13.5px; color:#1a1a2e;">' + t.notes + '</p></div>' : '') +
            '</div>' +
        '</div>';
        })
        .catch(function() {
            result.innerHTML = '<div style="background:#fff3f3; border:1px solid #e53935; border-radius:8px; padding:14px 16px; color:#c62828; font-size:13.5px;"><i class="fa fa-exclamation-triangle me-2"></i>Network error. Please try again.</div>';
        });
}
</script>
</body>
</html>
