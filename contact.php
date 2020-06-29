<?php include('includes/header.php'); ?>



<!-- End Sidebar -->



<!-- content 

        ================================================== -->

<div id="content">



    <!-- banner section 

            ================================================== -->

    <div class="box-section banner-section triggerAnimation animated" data-animate="rollIn">

        <div class="banner">

            <img src="upload/banners/2.jpg" alt="">

            <h1><span>Get in Touch With US</span></h1>

        </div>



    </div>

    <!-- End banner section -->



    <!-- map section 

            ================================================== -->

    <div class="box-section map-section triggerAnimation animated" data-animate="flipInX">

        <h2>Our Location</h2>

        <!--<div class="map"></div>-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18045.995262171997!2d12.96986445512166!3d55.571561686105426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4653a12e2f50429b%3A0x951d106c6c9efd6a!2sSn%C3%B6droppsgatan%2014%2C%20215%2027%20Malm%C3%B6%2C%20Sweden!5e0!3m2!1sen!2sbd!4v1586824192205!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    </div>

    <!-- End map section -->



    <!-- contact section 

            ================================================== -->

    <div class="box-section contact-section triggerAnimation animated" data-animate="flipInY">

        <h2>Say Hello to our CEO</h2>

        <form name="contact-form" id="contact-form" action="includes/send-mail.php" method="post">

            <div class="text-fields">

                <div class="float-input">

                    <input name="name" id="name" type="text" placeholder="Name">

                    <span><i class="fa fa-user"></i></span>

                </div>

                <div class="float-input">

                    <input name="mail" id="mail" type="text" placeholder="e-mail">

                    <span><i class="fa fa-envelope-o"></i></span>

                </div>

                <div class="float-input">

                    <input name="subject" id="subject" type="text" placeholder="subject">

                    <span><i class="fa fa-book"></i></span>

                </div>

            </div>

            <div class="comment-area">

                <textarea name="comment" id="comment" placeholder="Message"></textarea>

            </div>

            <div class="submit-area">

                <button name="contact-submit" id="contact-submit" type="submit">

                    <i class="fa fa-envelope-o"></i>

                    Send Message

                </button>

            </div>

        </form>

        <center><div id="msg" class="message text-center"></div></center>

    </div>

    <!-- End map section -->



    <!-- footer section

            ================================================== -->

    <?php include('includes/footer.php'); ?>			