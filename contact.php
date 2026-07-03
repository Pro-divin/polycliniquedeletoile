

<?php


include("config/connect.php");

$Year = date('Y');

$Time = date('Y').'-'.date('m').'-'.date('d');

    if (isset($_POST['submit'])) {
    
    // echo "<script>alert('welcome Again');</script>";
    
    $name =$_POST['name'];
    $email =$_POST['email'];
    $phone =$_POST['phone'];
    $subject =$_POST['subject'];
    $message =$_POST['message'];
   

    
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

$to = "clinicdeletoile@polycliniquedeletoile.com";
$subject = "Patient Request";


$email_subject = $subject;
$email_body = $htmlContent ;
$to = "clinicdeletoile@polycliniquedeletoile.com";

//echo $to."<br><br>".$email_subject."<br><br>".$email_body;

$emailres=sendemail($to,$email_body,$email_subject); 
//end mail

 header('location:contact');


}

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Contact || Polyclinique de l'Etoile</title>
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

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link href="img/logos.jpg" rel="icon">

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
          <div class="container-fluid position-relative p-0"style="position: relative;font-family:Playfair Display!important;">
          <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 px-lg-5 py-3 py-lg-0">
                <a href="index" class="navbar-brand p-0"> </a>
                <img src="img/etoile.png" alt="Logo" style="height: 70px!important;">
               
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index" class="nav-item nav-link ">Home</a>
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
                        <a href="contact" class="nav-item nav-link active">Contact </a>
                    </div>
                    <a href="appointment" class="btn btn-primary  text-white py-2 px-4 flex-wrap flex-sm-shrink-0" style="position: relative;font-family:Playfair Display;">Book Appointment</a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">Contact</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->


        <!-- Contact Start -->
        <div class="container-fluid contact py-5" style="position: relative;background: #49aac8!important;">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style mb-4">
                        <h4 class="sub-title text-white px-3 mb-0">Contact Us</h4>
                    </div>
                </div>
                <div class="row g-4 align-items-center">
                    <div class="col-lg-5 col-xl-5 contact-form wow fadeInLeft" data-wow-delay="0.1s">
                        <h2 class="display-5 text-white mb-2">Get in Touch</h2>
                        <!-- <p class="mb-4 text-white">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. a class="text-dark fw-bold" href="https://htmlcodex.com/contact-form">Download Now</a>.</p> -->
                        <form>
                            <div class="row g-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text"  name="name" class="form-control bg-transparent border border-white" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control bg-transparent border border-white" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="form-floating">
                                        <input type="phone"  name="phone" class="form-control bg-transparent border border-white" id="phone" placeholder="Phone">
                                        <label for="phone">Your Phone</label>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control bg-transparent border border-white" id="project" placeholder="Project">
                                        <label for="project">Your Project</label>
                                    </div>
                                </div> -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="subject" class="form-control bg-transparent border border-white" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-transparent border border-white" placeholder="Leave a message here" id="message" style="height: 160px" name="message"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-light text-primary w-100 py-3">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-xl-2 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="bg-transparent rounded">
                            <div class="d-flex flex-column align-items-center text-center mb-4">
                                <div class="bg-white d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fas fa-map-marker-alt fa-2x text-primary"></i></div>
                                <h4 class="text-dark">Addresses</h4>
                                <p class="mb-0 text-white">Gasabo,Remera, Rukiri I</p>
                            </div>
                            <div class="d-flex flex-column align-items-center text-center mb-4">
                                <div class="bg-white d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-whatsapp fa-2x text-primary"></i></div>
                                <h4 class="text-dark">Mobile</h4>
                                <p class="mb-0 text-white">Free Call : 1301</p>
                                <p class="mb-0 text-white">Reception Call & Whatsapp : +(250)790008754</p>
                            </div>
                           
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="bg-white d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-envelope-open fa-2x text-primary"></i></div>
                                <h4 class="text-dark">Email</h4>
                                <p class="mb-0 text-white">polycliniquedeletoile2020@gmail.com</p>
                                <!-- <p class="mb-0 text-white">info@example.com</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-5 wow fadeInRight" data-wow-delay="0.3s">
                        <div class="d-flex justify-content-center mb-4">
                            <a class="btn btn-lg-square btn-light rounded-circle mx-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle mx-2" href=""><i class="fab fa-youtube"></i></a>
                        </div>
                        <div class="rounded h-100">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7974.952481822159!2d30.102684!3d-1.963284!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca421a9d0d43b%3A0xa38f1803be5b0071!2sPolyclinique%20De%20L&#39;Etoile!5e0!3m2!1sen!2srw!4v1755938292231!5m2!1sen!2srw" width="520" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->


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
         <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0" style="position: relative;font-family:Playfair Display;">
                        <span class="text-white"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Polyclinique de l'Etoile</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-white" style="position: relative;font-family:Playfair Display;">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">Mike Vedaste</a>
                    </div>
                </div>
            </div>
        </div>
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