<style>
/* Services flyout menu */
.svc-nav-wrap { position:relative; }
.svc-nav-trigger { cursor:pointer; }
.svc-flyout-root {
    position:absolute; top:100%; left:0;
    min-width:240px;
    background:#fff;
    border-top:3px solid var(--bs-primary);
    border-radius:0 0 6px 6px;
    box-shadow:0 12px 40px rgba(0,0,0,0.14);
    opacity:0; visibility:hidden;
    transform:translateY(6px);
    transition:opacity 0.22s ease, visibility 0.22s ease, transform 0.22s ease;
    transition-delay:0.08s;
    z-index:9999;
    pointer-events:none;
}
.svc-nav-wrap:hover .svc-flyout-root {
    opacity:1; visibility:visible;
    transform:translateY(0);
    pointer-events:all;
    transition-delay:0s;
}
.svc-main-list { list-style:none; margin:0; padding:8px 0; }
.svc-main-item {
    position:relative;
    display:flex; align-items:center; justify-content:space-between;
    padding:10px 18px;
    font-size:13.5px; color:#333; font-weight:500;
    cursor:pointer;
    transition:background 0.18s, color 0.18s;
    gap:8px;
}
.svc-main-item a { color:inherit; text-decoration:none; display:flex; align-items:center; gap:8px; flex:1; }
.svc-main-item span { display:flex; align-items:center; gap:8px; flex:1; }
.svc-main-item:hover { background:var(--bs-primary); color:#fff; }
.svc-main-item:hover a, .svc-main-item:hover span { color:#fff; }
.svc-main-item:hover i { color:#fff !important; }
.svc-arrow { font-size:10px; color:#aaa; flex-shrink:0; }
.svc-main-item:hover .svc-arrow { color:#fff; }
.svc-sub-list {
    position:absolute; top:-8px; left:calc(100% - 2px);
    min-width:230px;
    background:#fff;
    border-left:3px solid var(--bs-primary);
    border-radius:0 6px 6px 0;
    box-shadow:6px 8px 32px rgba(0,0,0,0.13);
    list-style:none; margin:0; padding:8px 0;
    opacity:0; visibility:hidden;
    transform:translateX(0);
    transition:opacity 0.22s ease, visibility 0.22s ease;
    transition-delay:0.08s;
    pointer-events:none;
    z-index:99999;
}
/* invisible bridge so cursor can travel from item to sub-list without gap */
.svc-sub-list::before {
    content:''; position:absolute;
    top:0; left:-10px;
    width:10px; height:100%;
}
.svc-main-item:hover .svc-sub-list {
    opacity:1; visibility:visible;
    pointer-events:all;
    transition-delay:0s;
}
.svc-sub-list li a {
    display:block; padding:9px 18px;
    font-size:13px; color:#333 !important;
    text-decoration:none;
    transition:background 0.18s, color 0.18s, padding 0.18s;
    border-left:2px solid transparent;
    background:#fff !important;
}
.svc-sub-list li a:hover {
    background:#f4f7ff !important;
    color:var(--bs-primary) !important;
    border-left-color:var(--bs-primary);
    padding-left:24px;
}
/* Third-level: Gastroscopy sub-sub flyout */
.svc-sub-item-has-sub {
    position:relative;
    cursor:pointer;
}
.svc-sub-trigger {
    display:block; padding:9px 18px;
    font-size:14px; font-weight:500; font-style:normal; color:#333 !important;
    transition:background 0.18s, color 0.18s;
    border-left:2px solid transparent;
    background:#fff !important;
    user-select:none;
}
.svc-sub-item-has-sub:hover .svc-sub-trigger {
    background:#f4f7ff !important;
    color:var(--bs-primary) !important;
    border-left-color:var(--bs-primary);
}
.svc-sub-sub-list {
    position:absolute; top:-8px; right:calc(100% - 2px); left:auto;
    min-width:180px;
    background:#fff;
    border-right:3px solid var(--bs-primary);
    border-radius:6px 0 0 6px;
    box-shadow:-6px 8px 32px rgba(0,0,0,0.13);
    list-style:none; margin:0; padding:8px 0;
    opacity:0; visibility:hidden;
    transform:translateX(0);
    transition:opacity 0.22s ease, visibility 0.22s ease;
    transition-delay:0.08s;
    pointer-events:none;
    z-index:999999;
    /* invisible bridge so cursor can travel across the gap */
    padding-right:6px;
}
.svc-sub-sub-list::before {
    content:'';
    position:absolute;
    top:0; right:-8px;
    width:8px; height:100%;
}
.svc-sub-item-has-sub:hover .svc-sub-sub-list {
    opacity:1; visibility:visible;
    pointer-events:all;
    transition-delay:0s;
}
.svc-sub-sub-list li a {
    display:block; padding:9px 16px;
    font-size:14px; font-weight:500; font-style:normal; color:#333 !important;
    text-decoration:none;
    transition:background 0.15s, color 0.15s, padding 0.15s;
    border-left:2px solid transparent;
    background:#fff !important;
}
.svc-sub-sub-list li a:hover {
    background:#f4f7ff !important;
    color:var(--bs-primary) !important;
    border-left-color:var(--bs-primary);
    padding-left:22px;
}
</style>

        <!-- Topbar Start -->
        <div class="container-fluid bg-dark px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-light me-4" style="position: relative;font-family:Playfair Display;"><i class="fas fa-map-marker-alt text-primary me-2"></i> Gasabo, Remera, Rukiri I</a>
                        <a href="#" class="text-light me-4" style="position: relative;font-family:Playfair Display;"><i class="fas fa-phone-alt text-primary me-2"></i> Free Call 1301</a>||
                        <a href="#" class="text-light me-4" style="position: relative;font-family:Playfair Display;"><i class="fa fa-whatsapp me-2 text-primary me-2" style="position: relative;font-size:22px!important;top:3px!important;"></i> Customer Call &amp; Whatsapp +(250)790008754</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="https://www.facebook.com/PolycliniquedeLetoile1?_rdc=1&_rdr" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/polydeletoile" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/polycliniquedeletoile/" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCWMShUjUxoVuByeEve3VXrw" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-youtube"></i></a>
                        <a href="https://support.polycliniquedeletoile.com" target="_blank" class="btn btn-primary text-white py-1 px-3 ms-2" style="font-size:12px; font-weight:600; border-radius:4px; letter-spacing:0.5px; white-space:nowrap;"><i class="fa fa-headphones me-1"></i> IT Support</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar Start -->
        <div class="container-fluid position-relative p-0" style="font-family:Playfair Display!important;">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="index" class="navbar-brand p-0">
                    <img src="img/etoile.png" alt="Logo" style="height:70px!important;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index" class="nav-item nav-link">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About Us</a>
                            <div class="dropdown-menu m-0">
                                <a href="clinicinfo" class="dropdown-item">Clinic Information</a>
                                <a href="https://www.flickr.com/photos/189884140@N04/with/51930575082" class="dropdown-item">Gallery</a>
                                <a href="https://www.youtube.com/channel/UCWMShUjUxoVuByeEve3VXrw" class="dropdown-item">Videos</a>
                            </div>
                        </div>

                        <!-- Our Services Flyout Menu -->
                        <div class="nav-item svc-nav-wrap">
                            <a href="#" class="nav-link svc-nav-trigger">Our Services <i class="fa fa-chevron-down" style="font-size:10px;"></i></a>
                            <div class="svc-flyout-root">
                                <ul class="svc-main-list">
                                    <li class="svc-main-item has-sub">
                                        <span>Consultations</span>
                                        <i class="fa fa-chevron-right svc-arrow"></i>
                                        <ul class="svc-sub-list">
                                            <li><a href="general">General Medicine</a></li>
                                            <li><a href="internal">Internal Medicine &amp; Hepato-Gastro-Enterology</a></li>
                                            <li class="svc-sub-item-has-sub">
                                                <span class="svc-sub-trigger">&#8249; Endoscopy</span>
                                                <ul class="svc-sub-sub-list">
                                                    <li><a href="endoscopy">OGD</a></li>
                                                    <li><a href="endoscopy">Colonoscopy</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="gynecology">Gynecology &amp; Obstetrics</a></li>
                                            <li><a href="pediatrics">Pediatrics</a></li>
                                            <li><a href="dentist">Dentistry</a></li>
                                        </ul>
                                    </li>
                                    <li class="svc-main-item has-sub">
                                        <span>Laboratory</span>
                                        <i class="fa fa-chevron-right svc-arrow"></i>
                                        <ul class="svc-sub-list">
                                            <li><a href="laboratory">Hematology</a></li>
                                            <li><a href="laboratory">Biochemistry</a></li>
                                            <li><a href="laboratory">Bacteriology</a></li>
                                            <li><a href="laboratory">Immunology</a></li>
                                            <li><a href="laboratory">Serology</a></li>
                                            <li><a href="laboratory">Parasitology</a></li>
                                            <li><a href="laboratory">Endocrinology</a></li>
                                            <li><a href="laboratory">Cancer Screening</a></li>
                                        </ul>
                                    </li>
                                    <li class="svc-main-item has-sub">
                                        <span>Imagery</span>
                                        <i class="fa fa-chevron-right svc-arrow"></i>
                                        <ul class="svc-sub-list">
                                            <li><a href="#">CT Scan</a></li>
                                            <li><a href="x-ray">X-Ray (Radiography)</a></li>
                                            <li><a href="mammography">Mammography</a></li>
                                            <li><a href="opg">OPG (2D &amp; 3D CBCT)</a></li>
                                            <li><a href="#">4D Ultrasound</a></li>
                                            <li><a href="#">Electrocardiography (ECG)</a></li>
                                        </ul>
                                    </li>
                                    <li class="svc-main-item"><span>Physiotherapy</span></li>
                                    <li class="svc-main-item has-sub">
                                        <span>Minor Surgery</span>
                                        <i class="fa fa-chevron-right svc-arrow"></i>
                                        <ul class="svc-sub-list">
                                            <li><a href="minor">Circumcision</a></li>
                                            <li><a href="minor">Ingrowing Nail Treatment</a></li>
                                            <li><a href="minor">Wound Dressing</a></li>
                                            <li><a href="minor">Plasters Placement</a></li>
                                            <li><a href="minor">Reduction</a></li>
                                            <li><a href="minor">Abscess Incision &amp; Drainage</a></li>
                                            <li><a href="minor">Skin Lesions &amp; Masses</a></li>
                                            <li><a href="minor">Sutures</a></li>
                                            <li><a href="minor">Foreign Body Removal</a></li>
                                            <li><a href="minor">Joint Injections</a></li>
                                        </ul>
                                    </li>
                                    <li class="svc-main-item"><span>Nursing Care</span></li>
                                    <li class="svc-main-item"><span>Emergency Care</span></li>
                                    <li class="svc-main-item"><span>Hospitalization</span></li>
                                    <li class="svc-main-item"><span>ARV Services</span></li>
                                    <li class="svc-main-item"><a href="family">Family Planning</a></li>
                                    <li class="svc-main-item"><span>Vaccination</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Our Services -->

                        <a href="doctor" class="nav-item nav-link">Doctors</a>
                        <a href="contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <button onclick="document.getElementById('apptModal').classList.add('active')" class="btn btn-primary text-white py-2 px-4 flex-wrap flex-sm-shrink-0" style="font-family:'Playfair Display',serif;">Book Appointment</button>
                </div>
            </nav>
        <!-- Navbar End (hero section continues in page) -->

<!-- Appointment Modal -->
<div id="apptModal"
     onclick="if(event.target===this)this.classList.remove('active')"
     style="display:none;position:fixed;inset:0;z-index:99998;
            background:rgba(0,0,0,0.55);backdrop-filter:blur(4px);
            align-items:center;justify-content:center;padding:20px;">
    <div style="background:#fff;border-radius:10px;max-width:560px;width:100%;
                max-height:92vh;overflow-y:auto;position:relative;
                box-shadow:0 24px 80px rgba(0,0,0,0.35);">

        <!-- Modal header -->
        <div style="background:var(--bs-primary);padding:28px 36px 22px;border-radius:10px 10px 0 0;position:relative;">
            <button onclick="document.getElementById('apptModal').classList.remove('active')"
                    style="position:absolute;top:14px;right:16px;background:rgba(255,255,255,0.18);
                           border:none;color:#fff;width:32px;height:32px;border-radius:50%;
                           font-size:20px;cursor:pointer;display:flex;align-items:center;
                           justify-content:center;line-height:1;">&times;</button>
            <p style="font-family:'Playfair Display',serif;color:rgba(255,255,255,0.8);
                      font-size:0.78rem;font-weight:700;letter-spacing:3px;
                      text-transform:uppercase;margin:0 0 6px 0;">Get In Touch</p>
            <h3 style="font-family:'Playfair Display',serif;color:#fff;
                       font-size:1.6rem;font-weight:700;margin:0;">Get Appointment</h3>
        </div>

        <!-- Modal body / form -->
        <div style="padding:32px 36px;">
            <form id="apptModalForm" method="POST" action="appointment">
                <div class="row gy-3 gx-3">
                    <div class="col-12 col-sm-6">
                        <input type="text" name="name" required
                               class="appt-input" placeholder="First Name">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="email" name="email" required
                               class="appt-input" placeholder="Email">
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="tel" name="phone" required
                               class="appt-input" placeholder="Phone">
                    </div>
                    <div class="col-12 col-sm-6">
                        <select name="gender" required class="appt-input appt-select">
                            <option selected disabled value="">Your Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="date" id="apptDateValue">
                        <div class="appt-input" id="apptDateDisplay" onclick="apptCalOpen()"
                             style="cursor:pointer;display:flex;align-items:center;justify-content:space-between;user-select:none;">
                            <span id="apptDateLabel" style="color:#aaa;">Select Date</span>
                            <i class="fa fa-calendar" style="color:var(--bs-primary);font-size:15px;"></i>
                        </div>
                    </div>
                    <div class="col-12">
                        <textarea name="message" rows="4"
                                  class="appt-input" placeholder="Write Comments"
                                  style="resize:vertical;"></textarea>
                    </div>
                    <div class="col-12" style="margin-top:4px;">
                        <button type="submit" name="submit"
                                style="width:100%;padding:14px;background:var(--bs-primary);
                                       color:#fff;border:none;border-radius:6px;
                                       font-family:'Playfair Display',serif;font-size:0.95rem;
                                       font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
                                       cursor:pointer;transition:opacity 0.2s;">
                            Submit Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Calendar overlay — lives on body level, outside all modals -->
<div id="apptCalOverlay" onclick="if(event.target===this)apptCalClose()"
     style="display:none;position:fixed;inset:0;z-index:9999999;
            background:rgba(0,0,0,0.5);backdrop-filter:blur(2px);
            align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:14px;width:320px;
                box-shadow:0 24px 70px rgba(0,0,0,0.3);overflow:hidden;">

        <!-- Header -->
        <div style="background:var(--bs-primary);padding:18px 16px 14px;">
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <button type="button" onclick="apptCalNav(-1)" class="appt-cal-arr">&#8249;</button>
                <div style="display:flex;gap:6px;">
                    <button type="button" id="apptCalMonthBtn" onclick="apptCalShowMonths()"
                            class="appt-cal-hbtn"></button>
                    <button type="button" id="apptCalYearBtn" onclick="apptCalShowYears()"
                            class="appt-cal-hbtn"></button>
                </div>
                <button type="button" onclick="apptCalNav(1)" class="appt-cal-arr">&#8250;</button>
            </div>
        </div>

        <!-- Day names -->
        <div id="apptCalDayNames"
             style="display:grid;grid-template-columns:repeat(7,1fr);background:#f4f6ff;padding:8px 12px 4px;">
            <span class="appt-cal-dn">Su</span><span class="appt-cal-dn">Mo</span>
            <span class="appt-cal-dn">Tu</span><span class="appt-cal-dn">We</span>
            <span class="appt-cal-dn">Th</span><span class="appt-cal-dn">Fr</span>
            <span class="appt-cal-dn">Sa</span>
        </div>

        <!-- Grid (days / months / years) -->
        <div id="apptCalGrid" style="padding:6px 12px 14px;"></div>

    </div>
</div>

<style>
#apptModal { display:none !important; }
#apptModal.active { display:flex !important; }
.appt-input {
    width:100%; padding:11px 14px;
    border:1.5px solid var(--bs-primary);
    border-radius:6px; background:#fff;
    font-family:'Playfair Display',serif;
    font-size:0.93rem; color:#333;
    outline:none; transition:border-color 0.2s, box-shadow 0.2s;
    box-sizing:border-box;
}
.appt-input:focus {
    border-color:var(--bs-primary);
    box-shadow:0 0 0 3px rgba(var(--bs-primary-rgb),0.12);
}
.appt-input::placeholder { color:#aaa; }
.appt-select { appearance:none; -webkit-appearance:none; cursor:pointer; }
/* calendar */
.appt-cal-dn { text-align:center;font-size:11px;font-weight:700;color:#999;padding:4px 0;font-family:'Playfair Display',serif; }
.appt-cal-arr {
    background:rgba(255,255,255,0.18);border:none;color:#fff;
    width:32px;height:32px;border-radius:50%;cursor:pointer;
    font-size:18px;display:flex;align-items:center;justify-content:center;
    transition:background 0.15s;
}
.appt-cal-arr:hover { background:rgba(255,255,255,0.32); }
.appt-cal-hbtn {
    background:rgba(255,255,255,0.18);border:none;color:#fff;
    font-family:'Playfair Display',serif;font-weight:700;font-size:0.95rem;
    padding:5px 12px;border-radius:20px;cursor:pointer;
    transition:background 0.15s;
}
.appt-cal-hbtn:hover { background:rgba(255,255,255,0.32); }
/* day grid */
.appt-cal-day {
    text-align:center;padding:8px 2px;border-radius:8px;
    font-size:13px;font-family:'Playfair Display',serif;
    cursor:pointer;color:#333;border:none;background:transparent;width:100%;
    transition:background 0.15s,color 0.15s;
}
.appt-cal-day:hover:not(.past):not(.empty) { background:rgba(var(--bs-primary-rgb),0.12);color:var(--bs-primary); }
.appt-cal-day.today { font-weight:700;color:var(--bs-primary); }
.appt-cal-day.selected { background:var(--bs-primary)!important;color:#fff!important; }
.appt-cal-day.past { color:#ddd;cursor:not-allowed;pointer-events:none; }
.appt-cal-day.empty { pointer-events:none; }
/* month/year grid */
.appt-cal-cell {
    text-align:center;padding:10px 4px;border-radius:8px;border:none;background:#f4f6ff;
    font-size:13px;font-family:'Playfair Display',serif;font-weight:600;color:#333;
    cursor:pointer;transition:background 0.15s,color 0.15s;
}
.appt-cal-cell:hover:not(.cell-past) { background:rgba(var(--bs-primary-rgb),0.15);color:var(--bs-primary); }
.appt-cal-cell.active { background:var(--bs-primary)!important;color:#fff!important; }
.appt-cal-cell.cell-past { color:#ccc;cursor:not-allowed;pointer-events:none; }
#apptCalOverlay.cal-open { display:flex !important; }
</style>

<script>
(function(){
    var cal={y:0,m:0,view:'days'};
    var MONTHS=['January','February','March','April','May','June','July','August','September','October','November','December'];

    function pad(n){return n<10?'0'+n:n;}

    function fmtDisplay(y,m,d){
        var dt=new Date(y,m,d);
        var days=['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        return days[dt.getDay()]+', '+MONTHS[m]+' '+d+', '+y;
    }
    function updateHeader(){
        document.getElementById('apptCalMonthBtn').textContent=MONTHS[cal.m].slice(0,3);
        document.getElementById('apptCalYearBtn').textContent=cal.y;
    }
    function showDayNames(v){
        document.getElementById('apptCalDayNames').style.display=v?'grid':'none';
    }

    function renderDays(){
        cal.view='days';
        showDayNames(true);
        var grid=document.getElementById('apptCalGrid');
        grid.style.display='grid';
        grid.style.gridTemplateColumns='repeat(7,1fr)';
        grid.style.gap='2px';

        /* today as plain numbers — timezone-safe */
        var now=new Date();
        var tY=now.getFullYear(),tM=now.getMonth(),tD=now.getDate();

        /* selected date as plain numbers */
        var selVal=document.getElementById('apptDateValue').value;
        var sY=null,sM=null,sD=null;
        if(selVal){var p=selVal.split('-');sY=+p[0];sM=+p[1]-1;sD=+p[2];}

        var startDay=new Date(cal.y,cal.m,1).getDay();
        var lastDay=new Date(cal.y,cal.m+1,0).getDate();

        grid.innerHTML='';
        for(var i=0;i<startDay;i++){
            var e=document.createElement('span');e.className='appt-cal-day empty';grid.appendChild(e);
        }
        for(var d=1;d<=lastDay;d++){
            var btn=document.createElement('button');
            btn.type='button';btn.textContent=d;
            var cls='appt-cal-day';
            var isPast=(cal.y<tY)||(cal.y===tY&&cal.m<tM)||(cal.y===tY&&cal.m===tM&&d<tD);
            var isToday=(cal.y===tY&&cal.m===tM&&d===tD);
            var isSel=(sY!==null&&cal.y===sY&&cal.m===sM&&d===sD);
            if(isPast)cls+=' past';
            if(isToday)cls+=' today';
            if(isSel)cls+=' selected';
            btn.className=cls;
            (function(dd){
                btn.onclick=function(){
                    document.getElementById('apptDateValue').value=cal.y+'-'+pad(cal.m+1)+'-'+pad(dd);
                    document.getElementById('apptDateLabel').textContent=fmtDisplay(cal.y,cal.m,dd);
                    document.getElementById('apptDateLabel').style.color='#333';
                    apptCalClose();
                };
            })(d);
            grid.appendChild(btn);
        }
        updateHeader();
    }

    window.apptCalShowMonths=function(){
        cal.view='months';
        showDayNames(false);
        var grid=document.getElementById('apptCalGrid');
        grid.style.display='grid';
        grid.style.gridTemplateColumns='repeat(3,1fr)';
        grid.style.gap='6px';
        grid.innerHTML='';
        var now=new Date();
        var tY=now.getFullYear(),tM=now.getMonth();
        MONTHS.forEach(function(name,i){
            var btn=document.createElement('button');
            btn.type='button';btn.textContent=name.slice(0,3);
            var isPastMonth=(cal.y<tY)||(cal.y===tY&&i<tM);
            btn.className='appt-cal-cell'+(i===cal.m?' active':'')+(isPastMonth?' cell-past':'');
            (function(mi){btn.onclick=function(){cal.m=mi;renderDays();};})(i);
            grid.appendChild(btn);
        });
        updateHeader();
    };

    window.apptCalShowYears=function(){
        cal.view='years';
        showDayNames(false);
        var grid=document.getElementById('apptCalGrid');
        grid.style.display='grid';
        grid.style.gridTemplateColumns='repeat(3,1fr)';
        grid.style.gap='6px';
        grid.innerHTML='';
        var tY=new Date().getFullYear();
        var base=cal.y-4;
        for(var y=base;y<base+12;y++){
            var btn=document.createElement('button');
            btn.type='button';btn.textContent=y;
            var isPastYear=(y<tY);
            btn.className='appt-cal-cell'+(y===cal.y?' active':'')+(isPastYear?' cell-past':'');
            (function(yr){btn.onclick=function(){cal.y=yr;apptCalShowMonths();};})(y);
            grid.appendChild(btn);
        }
        updateHeader();
    };

    window.apptCalNav=function(dir){
        if(cal.view==='days'){
            cal.m+=dir;
            if(cal.m>11){cal.m=0;cal.y++;}
            if(cal.m<0){cal.m=11;cal.y--;}
            renderDays();
        } else if(cal.view==='years'){
            cal.y+=dir*12;
            apptCalShowYears();
        } else {
            cal.y+=dir;
            apptCalShowMonths();
        }
    };

    window.apptCalOpen=function(){
        var now=new Date();
        cal.y=now.getFullYear();cal.m=now.getMonth();
        renderDays();
        document.getElementById('apptCalOverlay').classList.add('cal-open');
    };
    window.apptCalClose=function(){
        document.getElementById('apptCalOverlay').classList.remove('cal-open');
    };
})();
</script>
