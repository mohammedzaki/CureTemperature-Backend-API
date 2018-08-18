<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Cure-Temp App Home</title>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico"/>
        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Slick slider -->
        <link href="assets/css/slick.css" rel="stylesheet">
        <!-- Theme color -->
        <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">


        <!-- Main Style -->
        <link href="style.css" rel="stylesheet">

        <!-- Fonts -->

        <!-- Open Sans for body and title font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700,800" rel="stylesheet">



        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>



        <!-- Start Header -->
        <header id="mu-header" class="" role="banner">
            <div class="mu-header-overlay">
                <div class="container">
                    <div class="mu-header-area">

                        <!-- Start Logo -->
                        <div class="mu-logo-area">
                            <!-- text based logo -->
                            <a class="mu-logo" href="#">Cure-Temp App</a>
                            <!-- image based logo -->
                            <!-- <a class="mu-logo" href="#"><img src="assets/images/logo.png" alt="logo img"></a> -->
                        </div>
                        <!-- End Logo -->

                        <!-- Start header featured area -->
                        <div class="mu-header-featured-area">
                            <div class="mu-header-featured-img">
                                <img src="assets/images/iphone.png" alt="iphone image">
                            </div>

                            <div class="mu-header-featured-content">
                                <h1>Welcome To <span>Cure-Temp App</span></h1>

                                <div class="mu-app-download-area">
                                    <h4>Download The App</h4>
                                    <a class="mu-apple-btn" href="itms-services://?action=download-manifest&url=https://cure-temperature.herokuapp.com//mobileapp/manifest.plist"><i class="fa fa-apple"></i><span>iPhone</span></a>
                                    <a class="mu-google-btn" href="{{ url('mobileapp/android-debug.apk') }}"><i class="fa fa-android"></i><span>Android</span></a>
                                    <!-- <a class="mu-windows-btn" href="#"><i class="fa fa-windows"></i><span>windows store</span></a> -->
                                </div>

                            </div>
                        </div>
                        <!-- End header featured area -->

                    </div>
                </div>
            </div>
        </header>
        <!-- End Header -->

        <!-- Start Menu -->
        <button class="mu-menu-btn">
            <i class="fa fa-bars"></i>
        </button>
        <div class="mu-menu-full-overlay">
            <div class="mu-menu-full-overlay-inner">
                <a class="mu-menu-close-btn" href="#"><span class="mu-line"></span></a>
                <nav class="mu-menu" role="navigation">
                    <ul>
                        <li><a href="#mu-header">Header</a></li>
                        <li><a href="#mu-feature">App Feature</a></li>
                        <li><a href="#mu-apps-screenshot">Apps Screenshot</a></li>
                        <li><a href="#mu-download">Download</a></li>
                        <li><a href="#mu-contact">Get In Touch</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End Menu -->



        <!-- Start main content -->

        <main role="main">

            <!-- Start Feature -->
            <section id="mu-feature">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-feature-area">

                                <div class="mu-title-area">
                                    <h2 class="mu-title">OUR APP FEATURES</h2>
                                    <span class="mu-title-dot"></span>
                                </div>

                                <!-- Start Feature Content -->
                                <div class="mu-feature-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mu-feature-content-left">
                                                <img class="mu-profile-img" src="assets/images/iphone-group.png" alt="iphone Image">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mu-feature-content-right">

                                                <!-- Start single feature item -->
                                                <div class="media">
                                                    <div class="media-left">
                                                        <button class="btn mu-feature-btn" type="button">
                                                            <i class="fa fa-tablet" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-body">
                                                        <h3 class="media-heading">Responsive Design</h3>
                                                    </div>
                                                </div>
                                                <!-- End single feature item -->

                                                <!-- Start single feature item -->
                                                <div class="media">
                                                    <div class="media-left">
                                                        <button class="btn mu-feature-btn" type="button">
                                                            <i class="fa fa-sliders" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-body">
                                                        <h3 class="media-heading">Easy To Customize</h3>
                                                    </div>
                                                </div>
                                                <!-- End single feature item -->

                                                <!-- Start single feature item -->
                                                <div class="media">
                                                    <div class="media-left">
                                                        <button class="btn mu-feature-btn" type="button">
                                                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-body">
                                                        <h3 class="media-heading">Excellent Performance</h3>
                                                    </div>
                                                </div>
                                                <!-- End single feature item -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Feature Content -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Feature -->

            <!-- Start Apps Screenshot -->
            <section id="mu-apps-screenshot">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-apps-screenshot-area">

                                <div class="mu-title-area">
                                    <h2 class="mu-title">APPS SCREENSHOT</h2>
                                    <span class="mu-title-dot"></span>
                                </div>


                                <!-- Start Apps Screenshot Content -->
                                <div class="mu-apps-screenshot-content">

                                    <div class="mu-apps-screenshot-slider">

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/01.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/02.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/03.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/04.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/05.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/01.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/02.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/03.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/04.jpg" alt="App screenshot img">
                                        </div>

                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/05.jpg" alt="App screenshot img">
                                        </div>
                                        
                                        <div class="mu-single-screeshot">
                                            <img src="assets/images/screenshot/06.jpg" alt="App screenshot img">
                                        </div>

                                    </div>

                                </div>
                                <!-- End Apps Screenshot Content -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Apps Screenshot -->

            <!-- Start Download -->
            <section id="mu-download">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-download-area">

                                <div class="mu-title-area">
                                    <h2 class="mu-title">GET THE APP</h2>
                                    <span class="mu-title-dot"></span>
                                </div>


                                <div class="mu-download-content">
                                    <a class="mu-apple-btn" href="itms-services://?action=download-manifest&url=https://cure-temperature.herokuapp.com//mobileapp/manifest.plist"><i class="fa fa-apple"></i><span>iPhone</span></a>
                                    <a class="mu-google-btn" href="{{ url('mobileapp/android-debug.apk') }}"><i class="fa fa-android"></i><span>Android</span></a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Download -->


            <!-- Start Contact -->
            <section id="mu-contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mu-contact-area">

                                <div class="mu-title-area">
                                    <h2 class="mu-heading-title">GET IN TOUCH</h2>
                                    <span class="mu-title-dot"></span>
                                </div>



                                <!-- Start Contact Content -->
                                <div class="mu-contact-content">
                                    <div class="row">

                                        <div class="col-md-7">
                                            <div class="mu-contact-left">
                                                <div id="form-messages"></div>
                                                <form id="ajax-contact" method="post" action="mailer.php" class="mu-contact-form">
                                                    <div class="form-group">                
                                                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
                                                    </div>
                                                    <div class="form-group">                
                                                        <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
                                                    </div>              
                                                    <div class="form-group">
                                                        <textarea class="form-control" placeholder="Message" id="message" name="message" required></textarea>
                                                    </div>
                                                    <button type="submit" class="mu-send-msg-btn"><span>SUBMIT</span></button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="mu-contact-right">
                                                <div class="mu-contact-right-single">
                                                    <div class="mu-icon"><i class="fa fa-map-marker"></i></div>
                                                    <p><strong>Office Location</strong></p>
                                                    <p>10, Al-Tahrir St., Sheraton Buildings, Heliopolis, Cairo, Egypt.</p>
                                                </div>

                                                <div class="mu-contact-right-single">
                                                    <div class="mu-icon"><i class="fa fa-phone"></i></div>
                                                    <p><strong>Phone Number</strong></p>
                                                    <p>Tel: +20 22 690 835</p>
                                                    <p>Fax: +20 22 690 834</p>
                                                    <p>Mob: +20 012 2 99 444 51</p>
                                                </div>

                                                <div class="mu-contact-right-single">
                                                    <div class="mu-icon"><i class="fa fa-envelope"></i></div>
                                                    <p><strong>Email Address</strong></p>
                                                    <p>info@curegroup.net</p>
                                                    <p>osama.ibrahim@curegroup.net</p>
                                                </div>

                                                <!--<div class="mu-contact-right-single">
                                                    <div class="mu-social-media">
                                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                                        <a href="#"><i class="fa fa-youtube"></i></a>
                                                    </div>
                                                </div>-->

                                            </div>
                                        </div>		

                                    </div>
                                </div>
                                <!-- End Contact Content -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Contact -->

        </main>

        <!-- End main content -->	


        <!-- Start footer -->
        <footer id="mu-footer" role="contentinfo">
            <div class="container">
                <div class="mu-footer-area">
                    <p class="mu-copy-right">&copy; Copyright <a rel="nofollow" href="http://www.curegroup.net">curegroup.net</a>. All right reserved.</p>
                </div>
            </div>

        </footer>
        <!-- End footer -->



        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!-- Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Slick slider -->
        <script type="text/javascript" src="assets/js/slick.min.js"></script>
        <!-- Ajax contact form  -->
        <script type="text/javascript" src="assets/js/app.js"></script>



        <!-- Custom js -->
        <script type="text/javascript" src="assets/js/custom.js"></script>

    </body>
</html>