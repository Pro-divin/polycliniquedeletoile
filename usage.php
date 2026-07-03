<!-- Team Start -->
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="sub-style">
                        <h4 class="sub-title px-3 mb-0">Our Doctors</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                <?php
                $SelectDoctors = $conn->query("SELECT * FROM doctor");
                $SelectDoctors->setFetchMode(PDO::FETCH_OBJ);
                while ($GetDoctors = $SelectDoctors->fetch()) {?>
                        <div class="col-md-4" >
                            <a href="">
                            <div class="team-img">
                                <img src="img/<?php echo $GetDoctors->doctorImage;?>" class="img-fluid" alt=""style="position: relative;height:250px!important;">
                            </div>
                            <div class="team"><br>
                            <h5 style="position:relative;text-align:initial;"><?php echo $GetDoctors->doctorNames?></h5>
                            <div style="position:relative;background:#25596a!important;color:white;">
                            <p class="" style="position:relative;text-align:initial;left:10px!important;"><?php echo $GetDoctors->position;?></p>
                            </div>
                            
                            <!-- <a href="doctorsdetails?Department=<?php //echo$GetDoctors->doctorId;?>" style="position: relative;font-family:Playfair Display;color:darkgreen!important;text-align:center;font-weight:bold;">More Details</a> -->
                            </div></a>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->