<?php
include("wp.php");
include("config/connect.php");

$Year = date('Y');


$Time = date('Y').'-'.date('m').'-'.date('d');

    if (isset($_POST['submit'])) {
    
    // echo "<script>alert('welcome Again');</script>";
    
    $name =$_POST['name'];
    $email =$_POST['email'];
    $phone =$_POST['phone'];
    $gender =$_POST['gender'];
    $date =$_POST['date'];
    $subject =$_POST['subject'];
   

    
    // $sendMessage=$conn->prepare("INSERT INTO feedback(fullNames,s_email,subject,message) VALUES(?,?,?,?)");
    // $sendMessage->execute([$name,$email,$subject,$message]);

    // if($sendMessage){
    //     echo "<script>alert('Thank you for your feedback');</script>";
    // }
    // else{
    //     echo "<script>alert('something went wrong');</script>"; ;
    // }


//start email  
function sendemail($to,$email_body,$email_subject)
{
    
 require("phpmailer/src/PHPMailer.php");
 require("phpmailer/src/SMTP.php");
 require("phpmailer//src/Exception.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP
    
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mwewe.afriregister.com";
    // $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "clinicdeletoile@polycliniquedeletoile.com";
    $mail->Password = "mrsnake!OG#";
    $mail->SetFrom("clinicdeletoile@polycliniquedeletoile.com","Polyclinique de l'Etoile");
    $mail->Subject = "$email_subject";
    $mail->Body = "$email_body";
    $mail->AddAddress("$to");

     if(!$mail->Send()) {
        return "failure";
     } else {
        return "success";
     }

    
}
        
$htmlContent=
'<html>
<head>
<title></title>
</head>
<body style="background-color:#e7e7e7">
<center>
&nbsp;
<table style="border:1px solid transparent; border-radius:14px; background-color:white; margin-top:50px; color:#333; width:50%; height:200px"><tr height="5%"><td colspan="5">&nbsp;</td></tr>
<tr><td rowspan="2">&nbsp;</td>
<td width="600">
Personal Names : '.$name.' <br /><br /> 

Personal Email :  ' .$email.' <br /><br /> 

<br /><br />

Message :  '.$message.'
<hr />
    Confirmation date: '.$Time.'
<br />

</td><td rowspan="2">&nbsp;</td></tr></table>
<p style="color:gray; font-size:13px; text-align:center;"> Personal Comment Message!
<a href="#">polycliniquedeletoile.com</a><br /><br />
<a href="#">polycliniquedeletoile.com</a> All rights reserved. '.date("Y").'</p>
&nbsp;
</center>
</body>
</html>
';

$to = "polycliniquedeletoile2020@gmail.com";
$subject = "Patient Request";


$email_subject = $subject;
$email_body = $htmlContent ;
$to = "polycliniquedeletoile2020@gmail.com";

//echo $to."<br><br>".$email_subject."<br><br>".$email_body;

$emailres=sendemail($to,$email_body,$email_subject); 
//end mail

 header('location:index');


}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Home || Polyclinique de l'Etoile</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link href="img/logos.jpg" rel="icon">

        <style type="text/css">
            
    .header-carousel .header-carousel-item .carousel-caption {
    width: 100%;
    height: 40%;
    position: absolute;
    top: 0;
    left: 0;
    padding: 100px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, .40);
      }
 </style>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68cad503be1b951927475fc3/1j5c506au';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</head>
    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Topbar Start -->
        <div class="container-fluid bg-dark px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center" style="height: 45px;">
                <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-light me-4" style="position: relative;font-family:Playfair Display;"><i class="fas fa-map-marker-alt text-primary me-2" ></i> Gasabo,  Remera, Rukiri I </a>
                        <a href="#" class="text-light me-4" style="position: relative;font-family:Playfair Display;"><i class="fas fa-phone-alt text-primary me-2"></i>  Free Call  1301 </a>|| 
                        <a href="#" class="text-light me-4" style="position: relative;font-family:Playfair Display;"><i class="fa fa-whatsapp  me-2 text-primary me-2" style="position: relative;font-size:22px!important;top:3px!important;"></i> Customer Call & Whatsapp  +(250)790008754 </a>
                        <!-- <a href="#" class="text-light me-0" style="position: relative;font-family:Playfair Display;"><i class="fas fa-envelope text-primary me-2"></i>polycliniquedeletoile2020@gmail.com</a> -->
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="https://www.facebook.com/PolycliniquedeLetoile1?_rdc=1&_rdr" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/polydeletoile" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/polycliniquedeletoile/" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/channel/UCWMShUjUxoVuByeEve3VXrw" class="btn btn-light btn-square border rounded-circle nav-fill me-0"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0" style="position: relative;font-family:Playfair Display!important;">
            <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="index" class="navbar-brand p-0"> </a>
                <img src="img/etoile.png" alt="Logo" style="height: 70px!important;">
               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index" class="nav-item nav-link active">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About Us</a>
                            <div class="dropdown-menu m-0">
                                <a href="clinicinfo" class="dropdown-item">Clinic Information</a>
                                <a href="https://www.flickr.com/photos/189884140@N04/with/51930575082" class="dropdown-item">Gallery</a>
                                <a href="https://www.youtube.com/channel/UCWMShUjUxoVuByeEve3VXrw" class="dropdown-item">Videos</a>
                            </div>
                        </div>
                       <!--  <a href="department" class="nav-item nav-link">Departments</a> -->
                         <a href="doctor" class="nav-item nav-link">Doctors</a>
                        <a href="contact" class="nav-item nav-link">Contact </a>
                    </div>
                    <a href="appointment" class="btn btn-primary  text-white py-2 px-4 flex-wrap flex-sm-shrink-0" style="position: relative;font-family:Playfair Display;">Book Appointment</a>
                </div>
            </nav>


            <!-- Carousel Start -->
            <div class="header-carousel owl-carousel">
                <div class="header-carousel-item">
                    <img src="img/dents.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <!-- <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;top: -20px!important;font-size: 20px!important;">Physiotherapy Center</h5> -->
                            <h1 class="display-1 text-capitalize text-white mb-4" style="letter-spacing:3px;margin-top:130px!important;font-family: Playfair Display sans serif;">Dental</h1>
                            <p class="mb-5 fs-5" style="position: relative;margin-top:50px!important;font-family:Playfair Display;">The Dental and Maxillofacial unit at Polyclinique de l'Etoile, provides a comprehensive range of services including study, prevention, diagnosis, treatment, and rehabilitation of congenital or acquired diseases of the entire facial structure 
                            </p>
                            <a class="btn btn-primary  text-white py-3 px-5" href="#" style="position: relative;font-family:Playfair Display;">Book Appointment</a>
                        </div>
                    </div>
                </div>
                <div class="header-carousel-item">
                    <img src="img/laborat.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                           <!--  <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;top: -20px!important;font-size: 20px!important;">Physiotherapy Center</h5> -->
                             <h1 class="display-1 text-capitalize text-white mb-4" style="letter-spacing: 3px;margin-top:100px!important;font-family: Playfair Display sans serif;">Laboratory</h1>
                            <p class="mb-5 fs-5 animated slideInDown" style="position: relative;margin-top:50px!important;font-family:Playfair Display;">Polyclinique de l'Etoile Pathology Department is equipped with world-class laboratory equipment to perform a wide range of pathology tests. 
                            </p>
                            <a class="btn btn-primary  text-white py-3 px-5" href="#" style="position: relative;font-family:Playfair Display;">Book Appointment</a>
                        </div>
                    </div>
                </div>

                <div class="header-carousel-item">
                    <img src="img/background.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                            <!-- <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;top: -30px!important;font-size: 20px!important;">Physiotherapy Center</h5> -->
                            <h1 class="display-1 text-capitalize text-white mb-4" style="letter-spacing: 3px;margin-top:100px!important;font-family: Playfair Display sans serif;">Customer Care</h1>
                            <p class="mb-5 fs-5 animated slideInDown" style="position: relative;margin-top:50px!important;font-family:Playfair Display;">At the Polyclinique de l'Etoile customercare service is at the top level,
                                where our customers get the service in a short time.
                            </p>
                            <a class="btn btn-primary  text-white py-3 px-5" href="#" style="position: relative;font-family:Playfair Display;">Book Appointment</a>
                        </div>
                    </div>
                </div>

                <div class="header-carousel-item">
                    <img src="img/endoscopy.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="carousel-caption-content p-3">
                           <!--  <h5 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;top: -20px!important;font-size: 20px!important;">Physiotherapy Center</h5> -->
                             <h1 class="display-1 text-capitalize text-white mb-4" style="letter-spacing: 3px;margin-top:130px!important;font-family: Playfair Display sans serif;">Endoscopy</h1>
                            <p class="mb-5 fs-5 animated slideInDown" style="position: relative;margin-top:50px!important;font-family:Playfair Display;">Polyclinique de l'Etoile performs a wide range of endoscopic procedures that allow both diagnosis and treatment of gastrointestinal disorders, such as peptic ulcers, polyps, cancers, and blockages of the bile ducts due to stones, inflammation and tumors.  
                            </p>
                            <a class="btn btn-primary  text-white py-3 px-5" href="#" style="position: relative;font-family:Playfair Display;">Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel End -->
        </div>
        <!-- Navbar & Hero End -->



                <!-- Services Start -->
        <div class="container-fluid service py-5" style="position: relative;top:0px!important;text-align: initial;">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Our Services</h4>
                    </div>
                    <!-- <h1 class="display-3 mb-4">Our Service Given Physio Therapy By Expert.</h1>
                    <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p> -->
                </div>
                <div class="row g-4 justify-content-center">




                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                        <a href="internal">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/internal.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Internal Medicine</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="internal" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>



                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                        <a href="gynecology">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/echography.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Gynecology & Obstetrics </h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="gynecology" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>




                   
                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                        <a href="pediatrics">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/pedi.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Pediatrics</h5>
                                    <p class="mb-4"></p>
                                   <!--  <a href="pediatrics" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="dentist">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/dent.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Dentistry</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="dentist" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                        <a href="general">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/Medicine (2).jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">General Medice</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="general" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <a href="laboratory">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/labo.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Laboratory</h5>
                                    <p class="mb-4"></p>
                                   <!--   <a href="laboratory" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                       <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                        <a href="endoscopy">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/endoscopy.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Endoscopy & Colonoscopy</h5>
                                    <p class="mb-4"></p>
                                   <!--  <a href="endoscopy" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
            
                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                        <a href="mammography">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/mammography.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Mammography</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="mammography" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                        <a href="family">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/familyplanning.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4"> Family Planning</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="family" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                     <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                        <a href="x-ray">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/x-rays.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">X-Ray</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="family" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                     <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                        <a href="opg">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/opg.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4"> OPG X-Ray</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="family" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>

                     <div class="col-md-6 col-lg-4 col-xl-4 wow fadeInUp" data-wow-delay="0.7s">
                      <a href="minor">
                        <div class="service-item rounded">
                           <div class="service-img rounded-top">
                                <img src="img/surgery.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height: 250px!important;">
                           </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <h5 class="mb-4">Minor Surgery</h5>
                                    <p class="mb-4"></p>
                                    <!-- <a href="family" class="btn btn-primary text-white py-2 px-4 mb-2" style="position: relative;font-family:Playfair Display;">More</a> -->
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="#">Services More</a>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Services End -->


            <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Insurance</h4><br><br>
                    </div>
                        <p style="position: relative;font-weight: bold;font-size: 25px!important;color: black!important;font-family:Playfair Display;">Our Partners</p><br>
                    <div class="col-md-12 col-lg-12 col-xl-12">
                  <div class="service-img rounded-top">
                    <img src="img/partners.jpg" class="img-fluid rounded-top w-100" alt="" style="position: relative;height:550px!important;border-top: 2px solid #2DC2DF!important;">
               </div>
                </div>
            </div>
      
        </div>
    </div>


        <!-- Book Appointment Start -->
       <!--  <div class="container-fluid appointment py-5" style="position: relative;top: -100px!important;">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2">
                        <div class="section-title text-start"> -->
                            <!-- <h4 class="sub-title pe-3 mb-0"></h4> -->
                         <!--    <h4 class="sub-title pe-3 mb-0" style="position: relative;font-size:17px!important;">Best Quality Services With Minimal Time Rate</h4><br><br>
                            <p class="mb-4">Polyclinique de l'Etoile, established in Kigali in 2014 and, is a private clinic offering high-quality outpatient care to local and international patients.</p>
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100">
                                        <div class="mb-4">
                                            <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i>Mission</h5>
                                            <p class="mb-0">To provide patient-centered healthcare with excellence in quality, service, and access.</p>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i>Vision</h5>
                                            <p class="mb-0">Transforming medicine to connect and cure as the global authority in the care of serious or complex disease.</p>
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i>Values</h5>
                                            <p class="mb-0">❏ Quality Services<br>
                                            ❏ The patient always comes first<br>
                                            ❏ We treat each person with respect and dignity<br>
                                            ❏ Time Management<br>
                                            ❏ Innovation<br>
                                            ❏ Integrity
                                            </p>
                                        </div>
                                        
                                    </div>
                                </div> -->

                                <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/_FHEy9LU1jI?si=iQI8XgXFUSXqlkg7" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
                         <!--        <div class="col-sm-6">

                                    <div class="video h-100">
                                        <img src="img/background.jpg" class="img-fluid rounded w-100 h-100" style="object-fit: cover;" alt="">
                                        <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/_FHEy9LU1jI?si=iQI8XgXFUSXqlkg7" title="YouTube video player"title="YouTube video player" frameborder="0"allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen data-bs-target="#videoModal">
                                            <span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                        <div class="appointment-form rounded p-5">
                            <p class="fs-4 text-uppercase text-primary">Get In Touch</p>
                            <h1 class="display-5 mb-4">Get Appointment</h1>
                            <form method="POST">
                                <div class="row gy-3 gx-4">
                                    <div class="col-xl-6">
                                        <input type="text" name="names" class="form-control py-3 border-primary bg-transparent text-white" placeholder="First Name">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="email"   name="email" class="form-control py-3 border-primary bg-transparent text-white" placeholder="Email">
                                    </div>
                                    <div class="col-xl-6">
                                        <input type="phone" name="phone" class="form-control py-3 border-primary bg-transparent" placeholder="Phone">
                                    </div>
                                    <div class="col-xl-6">
                                        <select class="form-select py-3 border-primary bg-transparent" aria-label="Default select example" name="gender">
                                            <option selected>Your Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">FeMale</option>
                                            <option value="3">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="date" name="date" class="form-control py-3 border-primary bg-transparent">
                                    </div> -->
                                   <!--  <div class="col-xl-6">
                                        <select class="form-select py-3 border-primary bg-transparent" aria-label="Default select example">
                                            <option selected>Department</option>
                                            <option value="1">Physiotherapy</option>
                                            <option value="2">Physical Helth</option>
                                            <option value="2">Treatments</option>
                                        </select>
                                    </div> -->
                                   <!--  <div class="col-12">
                                        <textarea class="form-control border-primary bg-transparent text-white" name="subject" id="area-text" cols="30" rows="5" placeholder="Write Comments"></textarea>
                                    </div>
                                    <div class="col-12"> -->
                                        <!-- <button type="button" class="btn btn-primary text-white w-100 py-3 px-5" style="position: relative;font-family: Playfair Display!important;">SUBMIT NOW</button> -->
                 <!--                        <button type="submit" class="serv_bottom btn btn-border btn-lg w-100 btn_large" name="submit" style=" position: relative;background: #15b9d9!important;color: white!important;font-family:Playfair Display;">SUBMIT NOW</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        
        <!-- Modal Video -->
        <!-- <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body"> -->
                        <!-- 16:9 aspect ratio -->
             <!--            <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Book Appointment End -->


        <!-- Team Start -->


        <div class="container-fluid team py-5" style="position: relative;top: -100px!important;">
        <div class="sub-style">
        <h4 class="paragraph" style="position: relative;text-align: center;color:#0f96bf!important">Doctor's Schedule</h4><br><br>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="tables">
        <table class="table table-bordered">
        <tr style="position: relative;background:#0f96bf!important;font-family:Playfair Display!important;color:white!important;">
        <th>Speciality</th>
        <th>Doctor Name</th>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        <th>Saturday</th>
        <th>Sunday</th>
        </tr>
        <?php
        if ($conn) {
            $SelectDepartment=$conn->query("SELECT*FROM schedules");
            $SelectDepartment->setFetchMode(PDO::FETCH_OBJ);
            while ($GetSchedule=$SelectDepartment->fetch()) {?>
        <tr>
        <td style="position: relative;font-family:josephine;color:white!important;background:#0c0539!important;font-weight:bold; "><?php echo $GetSchedule->DepartmentName;?></td>
        <td style="position: relative;font-family:josephine;color:white!important;font-size:13px!important;background:#0c0539!important;font-weight:bold; "><?php echo $GetSchedule->DoctorName;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Monday;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Tuesday;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Wednesday;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Thursday;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Friday;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Saturday;?></td>
        <td style="position: relative;font-family:josephine;color:black!important;font-size:13px!important;"><?php echo $GetSchedule->Sunday;?></td>
        </tr>
        <?php }
        } else {
            echo "<tr><td colspan='9' style='text-align:center; padding: 20px;'>Database not available. Please set up MySQL to view doctor schedules.</td></tr>";
        }
        ?>
        </table>
        </div>
        </div>
        </div>
        </div>

        <!-- <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Doctor's Schedule</h4>
                    </div>


                  
                </div>
                <div class="row g-4 justify-content-center">
                    
                </div>
        </div>
    </div> -->


        <!-- Team End -->


        <!-- Testimonial Start -->
        <!-- <div class="container-fluid testimonial py-5 wow zoomInDown" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="section-title mb-5">
                    <div class="sub-style">
                        <h4 class="sub-title text-white px-3 mb-0">Testimonial</h4>
                    </div>
                    <h1 class="display-3 mb-4">What Clients are Say</h1>
                </div>
                <div class="testimonial-carousel owl-carousel">
                    <div class="testimonial-item">
                        <div class="testimonial-inner p-5">
                            <div class="testimonial-inner-img mb-4">
                                <img src="img/testimonial-img.jpg" class="img-fluid rounded-circle" alt="">
                            </div>
                            <p class="text-white fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                            </p>
                            <div class="text-center">
                                <h5 class="mb-2">John Abraham</h5>
                                <p class="mb-2 text-white-50">New York, USA</p>
                                <div class="d-flex justify-content-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-inner p-5">
                            <div class="testimonial-inner-img mb-4">
                                <img src="img/testimonial-img.jpg" class="img-fluid rounded-circle" alt="">
                            </div>
                            <p class="text-white fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                            </p>
                            <div class="text-center">
                                <h5 class="mb-2">John Abraham</h5>
                                <p class="mb-2 text-white-50">New York, USA</p>
                                <div class="d-flex justify-content-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item">
                        <div class="testimonial-inner p-5">
                            <div class="testimonial-inner-img mb-4">
                                <img src="img/testimonial-img.jpg" class="img-fluid rounded-circle" alt="">
                            </div>
                            <p class="text-white fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                            </p>
                            <div class="text-center">
                                <h5 class="mb-2">John Abraham</h5>
                                <p class="mb-2 text-white-50">New York, USA</p>
                                <div class="d-flex justify-content-center">
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                    <i class="fas fa-star text-secondary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Testimonial End -->


        <!-- Blog Start -->
        <div class="container-fluid blog py-5" style="position: relative;top: -100px!important;">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Our Blog</h4>
                    </div>
                    
                </div>
                <div class="row g-4 justify-content-center ">
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="blog-item rounded">
                            <div class="blog-img">
                                <img src="img/hepatitis.jpg" class="img-fluid w-100" alt="Image" style="position: relative;height:250px!important;">
                            </div>
                            <div class="blog-centent p-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted"><i class="fa fa-calendar-alt text-primary"></i> 17 June 2025</p>
                                    <!-- <a href="#" class="text-muted"><span class="fa fa-comments text-primary"></span> 3 Comments</a> -->
                                </div>
                                <a href="#" class="h4">Hepatitis C</a>
                                <p class="my-4">Hepatitis C is a viral infection that causes liver swelling, called inflammation. Hepatitis C can lead to serious liver damage. The hepatitis C virus (HCV) spreads through contact with blood that has the virus in it.</p>
                                <a href="https://www.mayoclinic.org/diseases-conditions/hepatitis-c/symptoms-causes/syc-20354278" class="btn btn-primary  text-white py-2 px-4 mb-1" style="position: relative;font-family: Playfair Display!important;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="blog-item rounded">
                            <div class="blog-img">
                                <img src="img/kidney.jpeg" class="img-fluid w-100" alt="Image" style="position: relative;height:250px!important;">
                            </div>
                            <div class="blog-centent p-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted"><i class="fa fa-calendar-alt text-primary"></i> 23 Juln 2025</p>
                                    <!-- <a href="#" class="text-muted"><span class="fa fa-comments text-primary"></span> 3 Comments</a> -->
                                </div>
                                <a href="#" class="h4">Kidney Disease</a>
                                <p class="my-4">Chronic kidney disease, also called chronic kidney failure, involves a gradual loss of kidney function. Your kidneys filter wastes and excess fluids from your blood, which are then removed in your urine. Advanced chronic kidney disease.</p>
                                <a href="https://www.mayoclinic.org/diseases-conditions/chronic-kidney-disease/symptoms-causes/syc-20354521" class="btn btn-primary  text-white py-2 px-4 mb-1" style="position: relative;font-family: Playfair Display!important;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="blog-item rounded">
                            <div class="blog-img">
                                <img src="img/dentaldisease.jpg" class="img-fluid w-100" alt="Image" style="position: relative;height:250px!important;">
                            </div>
                            <div class="blog-centent p-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted"><i class="fa fa-calendar-alt text-primary"></i> 12 Aug 2025</p>
                                    <!-- <a href="#" class="text-muted"><span class="fa fa-comments text-primary"></span> 3 Comments</a> -->
                                </div>
                                <a href="#" class="h4">Dental</a>
                                <p class="my-4">This is a guide to the main treatments carried out by dentists. Some are readily available on the NHS, while some may only be available on the NHS in certain circumstances,As with glasses and prescription costs.</p>
                                <a href="https://www.nhs.uk/live-well/healthy-teeth-and-gums/dental-treatments/" class="btn btn-primary  text-white py-2 px-4 mb-1" style="position: relative;font-family: Playfair Display!important;">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog End -->


        <!-- Footer Start -->
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s" style="position: relative;font-family:Playfair Display;color: white!important;">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <!-- <h4 class="text-white mb-4"><i class="fas fa-star-of-life me-3"></i>Polyclinique de l'Etoile</h4> -->
                            <p>Polyclinique de l'Etoile, established in Kigali in 2014 and, is a private clinic offering high-quality outpatient care to local and international patients."
                            </p>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="https://www.facebook.com/PolycliniquedeLetoile1?_rdc=1&_rdr"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="https://x.com/polydeletoile"><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="https://www.instagram.com/polycliniquedeletoile/"><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary text-white rounded-circle mx-1" href="https://www.youtube.com/channel/UCWMShUjUxoVuByeEve3VXrw"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Quick Links</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> About Us</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Contact Us</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Our Blog & News</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Our Team</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Clinic Services</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Pediatrics</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Gynecolgy & Obstetrics </a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Internal Medicine</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Dental</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> General Medicine</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Laboratory</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Contact Info</h4>
                            <a href=""><i class="fas fa-map-marker-alt me-2"></i>  KG 1 Ave, Kigali, Gasabo, Remera, Rukiri I, Ubumwe Rwanda.</a>
                            <a href=""><i class="fas fa-envelope me-2"></i>polycliniquedeletoile2020@gmail.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i>Free Call : 1301</a>
                            <a href="" class="mb-3"><i class="fa fa-whatsapp me-2"></i>Reception Call And Whatsapp : 0790008754</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        
    </body>

</html>
