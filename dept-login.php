<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Portal Login — Polyclinique de l'Etoile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d2010 0%, #146c43 50%, #198754 100%);
            min-height: 100vh;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 24px;
        }
        .brand {
            text-align: center; margin-bottom: 28px;
        }
        .brand-logo {
            width: 64px; height: 64px; background: rgba(255,255,255,.15);
            border-radius: 16px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px; font-size: 28px; color: #fff;
        }
        .brand h1 {
            font-family: 'Playfair Display', serif;
            color: #fff; font-size: 1.4rem; font-weight: 700; margin-bottom: 4px;
        }
        .brand p { color: rgba(255,255,255,.65); font-size: 13px; }

        .login-card {
            background: #fff; border-radius: 18px;
            padding: 36px 40px; width: 100%; max-width: 420px;
            box-shadow: 0 24px 60px rgba(0,0,0,.3);
        }
        .login-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem; font-weight: 700; color: #1a2340;
            margin-bottom: 6px;
        }
        .login-card .sub { color: #64748b; font-size: 13px; margin-bottom: 28px; }

        .field-label { display: block; font-size: 12.5px; font-weight: 600; color: #374151; margin-bottom: 6px; }
        .field-wrap { position: relative; margin-bottom: 18px; }
        .field-wrap i {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 14px;
        }
        .field-input {
            width: 100%; padding: 11px 14px 11px 38px;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; font-family: 'Inter', sans-serif; color: #1a2340;
            outline: none; transition: border-color .2s;
        }
        .field-input:focus { border-color: #198754; }

        .btn-login {
            width: 100%; background: #198754; color: #fff;
            border: none; border-radius: 10px; padding: 13px;
            font-size: 15px; font-weight: 700; cursor: pointer;
            font-family: 'Inter', sans-serif; transition: background .2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-login:hover { background: #146c43; }

        .err-box {
            display: none; background: #fff3f3; border: 1px solid #fca5a5;
            border-radius: 8px; padding: 10px 14px; color: #b91c1c;
            font-size: 13px; margin-bottom: 16px;
        }
        .err-box.show { display: block; }

        .hint {
            margin-top: 20px; border-top: 1px solid #f1f5f9; padding-top: 16px;
            font-size: 12px; color: #94a3b8; text-align: center;
        }
        .hint strong { color: #64748b; }
    </style>
</head>
<body>
<div class="brand">
    <div class="brand-logo"><i class="fa fa-hospital-o"></i></div>
    <h1>Polyclinique de l'Etoile</h1>
    <p>Department Support Portal</p>
</div>

<div class="login-card">
    <h2>Department Sign In</h2>
    <p class="sub">Access your department's support tickets.</p>

    <div class="err-box" id="errBox"></div>

    <form id="loginForm" onsubmit="doLogin(event)">
        <label class="field-label">Department Email</label>
        <div class="field-wrap">
            <i class="fa fa-envelope"></i>
            <input type="email" class="field-input" id="email"
                   placeholder="finance@polycliniquedeletoile.com" required autocomplete="username">
        </div>

        <label class="field-label">Password</label>
        <div class="field-wrap">
            <i class="fa fa-lock"></i>
            <input type="password" class="field-input" id="password"
                   placeholder="Enter your password" required autocomplete="current-password">
        </div>

        <button type="submit" class="btn-login" id="btnLogin">
            <i class="fa fa-sign-in"></i> Sign In
        </button>
    </form>

    <div class="hint">
        <strong>Access format:</strong><br>
        Email: <em>department</em>@polycliniquedeletoile.com &nbsp;·&nbsp; Password: <em>Department</em>123
    </div>
</div>

<script>
function doLogin(e) {
    e.preventDefault();
    var btn = document.getElementById('btnLogin');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Signing in…';
    document.getElementById('errBox').classList.remove('show');

    var fd = new FormData();
    fd.append('action',   'dept_login');
    fd.append('email',    document.getElementById('email').value.trim());
    fd.append('password', document.getElementById('password').value);

    fetch('ticket-action.php', { method:'POST', body:fd })
        .then(function(r){ return r.json(); })
        .then(function(data) {
            if (data.success) {
                window.location.href = 'dept-dashboard.php';
            } else {
                document.getElementById('errBox').textContent = data.error || 'Login failed.';
                document.getElementById('errBox').classList.add('show');
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-sign-in"></i> Sign In';
            }
        })
        .catch(function() {
            document.getElementById('errBox').textContent = 'Network error. Please try again.';
            document.getElementById('errBox').classList.add('show');
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-sign-in"></i> Sign In';
        });
}
</script>
</body>
</html>
