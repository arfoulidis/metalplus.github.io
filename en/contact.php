<?php
session_start();

require_once('../php/simple-php-captcha/simple-php-captcha.php');
require_once('../php/php-mailer/PHPMailerAutoload.php');

// Step 1 - Enter your email address below.
$email = 'metalpluscon@yahoo.gr';

// If the e-mail is not working, change the debug option to 2 | $debug = 2;
$debug = 0;

if(isset($_POST['emailSent'])) {

	$subject = $_POST['subject'];

	// Step 2 - If you don't want a "captcha" verification, remove that IF.
	if (strtolower($_POST['captcha']) == strtolower($_SESSION['captcha']['code'])) {

		// Step 3 - Configure the fields list that you want to receive on the email.
		$fields = array(
			0 => array(
				'text' => 'Name',
				'val' => $_POST['name']
			),
			1 => array(
				'text' => 'Email address',
				'val' => $_POST['email']
			),
			2 => array(
				'text' => 'Message',
				'val' => $_POST['message']
			),
			3 => array(
				'text' => 'Checkboxes',
				'val' => implode($_POST['checkboxes'], ", ")
			)/*,
			4 => array(
				'text' => 'Radios',
				'val' => $_POST['radios']
			)*/
		);

		$message = '';

		foreach($fields as $field) {
			$message .= $field['text'].": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
		}

		$mail = new PHPMailer(true);

		try {

			$mail->SMTPDebug = $debug;                            // Debug Mode

			// Step 3 (Optional) - If you don't receive the email, try to configure the parameters below:

			//$mail->IsSMTP();                                         // Set mailer to use SMTP
			//$mail->Host = 'mail.yourserver.com';				       // Specify main and backup server
			//$mail->SMTPAuth = true;                                  // Enable SMTP authentication
			//$mail->Username = 'user@example.com';                    // SMTP username
			//$mail->Password = 'secret';                              // SMTP password
			//$mail->SMTPSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
			//$mail->Port = 587;   								       // TCP port to connect to

			$mail->AddAddress($email);	 						       // Add a recipient

			//$mail->AddAddress('person2@domain.com', 'Person 2');     // Add another recipient
			//$mail->AddCC('person3@domain.com', 'Person 3');          // Add a "Cc" address. 
			//$mail->AddBCC('person4@domain.com', 'Person 4');         // Add a "Bcc" address. 

			$mail->SetFrom($email, $_POST['name']);
			$mail->AddReplyTo($_POST['email'], $_POST['name']);

			$mail->IsHTML(true);                                  // Set email format to HTML

			$mail->CharSet = 'UTF-8';

			$mail->Subject = $subject;
			$mail->Body    = $message;

			// Step 4 - If you don't want to attach any files, remove that code below
			if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
				$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
			}

			$mail->Send();

			$arrResult = array ('response'=>'success');

		} catch (phpmailerException $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
		} catch (Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
		}

	} else {

		$arrResult = array ('response'=>'captchaError');

	}

}
?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>METAL PLUS - Contact</title>	

		
		<meta name="keywords" content="doors, frames, aluminum, pvc, exclusive, armored, sliding, retractable, opening, overlapping,shutters,curtain walls, shading systems, shutter system, rolls, industrial rolls, garage doors, special constructions,railings,luxury estates, metal+, konstantinidis,dimitris konstantinidis, metal plus" />
		<meta name="description" content="METAL PLUS is #1 construction company in aluminum and PVC frames located in Neochori-Serres with a big network of parteners in Greece and abroad.">
		<meta name="author" content="METAL PLUS KONSTANTINIDIS">


		<!-- Favicon -->
		<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="../img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Roboto:300" rel="stylesheet">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="../vendor/animate/animate.min.css">
		<link rel="stylesheet" href="../vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="../vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="../vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="../vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="../css/theme.css">
		<link rel="stylesheet" href="../css/theme-elements.css">

        <!-- Skin CSS -->
		<link rel="stylesheet" href="../css/skins/skin-light-red.css"> 

		<!-- Style CSS -->
		<link rel="stylesheet" href="../css/main.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="../css/custom.css">

		<!-- Head Libs -->
		<script src="../vendor/modernizr/modernizr.min.js"></script>

	</head>
	<body>

		<div class="body">
			<header id="header" class="header-narrow" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 1, "stickySetTop": "-1px"}'>
					<div class="header-top header-top header-top-style-3 header-top-custom  m-none">
                    <div class="container">
							<nav class="header-nav-top pull-left">
								<ul class="nav nav-pills">
									<li class="hidden-xs">
										<span class="ws-nowrap"><i class="icon-location-pin icons"></i> 2nd Km Serres-Neochori</span>
									</li>
									<li>
										<span class="ws-nowrap"><i class="icon-call-out icons"></i> 23210-76140</span>
									</li>
									<li class="hidden-xs">
										<span class="ws-nowrap"><i class="icon-envelope-open icons"></i> <a class="text-decoration-none" href="mailto:info@metalplus.gr">info@metalplus.gr</a></span>
									</li>
								</ul>
							</nav>
							
                        
                        
                        <nav class="header-nav-top langs pull-right mr-none">
								<ul class="nav nav-pills">
									<li>
										<a href="#" class="dropdown-menu-toggle" id="dropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
											English
											<i class="fa fa-sort-down"></i>
										</a>
										<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLanguage">
											<li>
												<a href="../contact.php"><img src="../img/blank.gif" class="flag flag-gr" alt="Greek"> Ελληνικά</a>
											</li>
                                            <li>
												<a href="#"><img src="../img/blank.gif" class="flag flag-us" alt="English"> English</a>
											</li>
										</ul>
									</li>
								</ul>
							</nav>
                        
						</div>
					</div>
                <div class="header-body">
					<div class="header-container container custom-position-initial"> 
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<img class="logo-default" alt="Metal Plus" width="324" height="212" src="../img/logo/logo-big.png">
									<a href="index.html">
										<img class="logo-small" alt="Metal Plus" width="151" height="40" src="../img/logo/logo-red.jpg">
									</a>
								</div>
							</div>
							<div class="header-column">
								<div class="header-row">
									<div class="header-nav header-nav-stripe">
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
											<i class="fa fa-bars"></i>
										</button>
										<!--ul class="header-social-icons social-icons visible-lg">
											<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
											<!--li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
										</ul-->
										<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1 collapse">
											
                                            <nav>
												<ul class="nav nav-pills" id="mainNav">
													<li>
														<a href="index.html">
															Home
														</a>
													</li>
													
													<li class="dropdown">
														<a class="dropdown-toggle" href="products.html">
															Products
														</a>
                                                    <ul class="dropdown-menu">    
                                                        <li class="dropdown-submenu">
																<a href="doors-exclusive.html">Doors</a>
																<ul class="dropdown-menu">
																	<li><a href="doors-exclusive.html">Exclusive New Generation</a></li>
                                                                    <li><a href="doors-alouminium.html">Aluminum</a></li>
																	<li><a href="doors-pvc.html">PVC</a></li>
                                                                    <li><a href="doors-armored.html">Armored Doors</a></li>
																</ul>
												        </li>
                                                        <li class="dropdown-submenu">
																<a href="opening-aluminum-frames.html">Frames</a>
																<ul class="dropdown-menu">
																	<li><a href="opening-aluminum-frames.html">Aluminum Opening</a></li>
                                                                    <li><a href="frames-aluminum-sliding-retractable.html">Aluminum Sliding-Retractable</a></li>
                                                                    <li><a href="opening-pvc-frames.html">PVC  Opening</a></li>
																	<li><a href="frames-pvc-sliding-overlapping.html">PVC Overlapping-Sliding</a></li>
																</ul>
												        </li>
                                                        <li class="dropdown-submenu">
																<a href="shutters.html">Shading Systems</a>
																<ul class="dropdown-menu">
																	<li><a href="shutters.html">Shutters</a></li>
                                                                    <li><a href="rolls.html">Rolls</a></li>
																</ul>
												        </li>
                                                        <li><a href="curtain-wall.html">Curtain Walls</a></li>
                                                        <li><a href="garage-doors.html">Industrial Rolls &amp; Garage Doors</a></li>
                                                        </ul>
                                                    </li>
													<li>
														<a href="projects.html">
															Our Projects
														</a>
													</li>
                                                    <li>
                                                    <a href="company.html">
															The company
														</a>
													</li>
                                                    <li class="active">
														<a href="contact.php">
															Contact us
														</a>
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">

				<section class="section section-tertiary section-no-border pb-md mt-none">
					<div class="container">
						<div class="row mt-xl1">
							<div class="col-md-10 col-md-offset-2 pt-xlg mt-xlg1 align-right">
								<h1 class="text-uppercase font-weight-light mt-xl text-color-primary"> Contact</h1>
							</div>
						</div>
					</div>
				</section>

                <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<!--div id="googlemaps" class="google-map"></div-->	
                

				<div class="container">
                    
                    <div class="row">
                        <div class="col-md-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2753.912899141319!2d23.574974898126268!3d41.05714128180217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDAzJzI0LjMiTiAyM8KwMzQnMzIuNiJF!5e1!3m2!1sel!2sgr!4v1536387423323" width="1200" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                </div>
                    
					<div class="row">
						<div class="col-md-6">

							<div class="offset-anchor" id="contact-sent"></div>

							<?php
							if (isset($arrResult)) {
								if($arrResult['response'] == 'success') {
								?>
								<div class="alert alert-success" id="contactSuccess">
									<strong>Thank you!</strong> Message Send.
								</div>
								<?php
								} else if($arrResult['response'] == 'error') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Oops!</strong> Sending Error.
									<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"><?php echo $arrResult['errorMessage'];?></span>
								</div>
								<?php
								} else if($arrResult['response'] == 'captchaError') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Ουπς!</strong>Verification Error.
								</div>
								<?php
								}
							}
							?>

							<h2 class="heading-primary mb-sm mt-sm">Communication <strong>Form </strong></h2>
							<form id="contactFormAdvanced" action="<?php echo basename($_SERVER['PHP_SELF']); ?>#contact-sent" method="POST" enctype="multipart/form-data">
								<input type="hidden" value="true" name="emailSent" id="emailSent">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Your Name *</label>
											<input type="text" value="" data-msg-required="Please,write your name." maxlength="100" class="form-control" name="name" id="name" required>
										</div>
										<div class="col-md-6">
											<label>E-mail *</label>
											<input type="email" value="" data-msg-required="Please,write your e-mail." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Subject</label>
											<select data-msg-required="Choose Subject." class="form-control" name="subject" id="subject" required>
												<option value="">...</option>
												<option value="Informations">Informations</option>
												<option value="Search a Partner">Search a Partner</option>
												<option value="My order">My order</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<!--div class="row">
												<div class="col-md-12">
													<label>Choose:</label>
												</div>
											</div-->
											<div class="row">
												<div class="col-md-12">
													<div class="checkbox-group" data-msg-required="Please, choose one of the below.">
														<label class="checkbox-inline">
															<input type="checkbox" name="checkboxes[]" id="inlineCheckbox1" value="Private"> Private
														</label>
														<label class="checkbox-inline">
															<input type="checkbox" name="checkboxes[]" id="inlineCheckbox2" value="Business"> Business
														</label>
													</div>
												</div>
											</div>
										</div>
										<!--div class="col-md-6">
											<div class="row">
												<div class="col-md-12">
													<label>Radios</label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="radio-group" data-msg-required="Please select one option.">
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio1" value="option1"> 1
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio2" value="option2"> 2
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio3" value="option3"> 3
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio4" value="option4"> 4
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio5" value="option5"> 5
														</label>
													</div>
												</div>
											</div>
										</div-->
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>File attachment</label>
											<input type="file" name="attachment" id="attachment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Your message*</label>
											<textarea maxlength="5000" data-msg-required="Please,write your message." rows="6" class="form-control" name="message" id="message" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label>Verify *</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-4">
											<div class="captcha form-control">
												<div class="captcha-image">
													<?php
													$_SESSION['captcha'] = simple_php_captcha(array(
														'min_length' => 6,
														'max_length' => 6,
														'min_font_size' => 22,
														'max_font_size' => 22,
														'angle_max' => 3
													));

													$_SESSION['captchaCode'] = $_SESSION['captcha']['code'];

													echo '<img id="captcha-image" src="' . "../php/simple-php-captcha/simple-php-captcha.php/" . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
													?>
												</div>
												<div class="captcha-refresh">
													<a href="#" id="refreshCaptcha"><i class="fa fa-refresh"></i></a>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<input type="text" value="" maxlength="6" data-msg-captcha="Wrong verification code." data-msg-required="Please, write verification code." placeholder="Write verification code." class="form-control input-lg captcha-input" name="captcha" id="captcha" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" id="contactFormSubmit" value="Send" class="btn btn-primary btn-lg pull-left" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6">

                            <h4 class="heading-primary mt-lg"><strong>Contact </strong>us</h4>
                            
                            <p>Fill in the contact form and we will contact you directly to give you the information you need or to suggest the closest partner to you.</p>

							<p>We will be happy to discuss with you and find together the most effective solution to your needs and desires.</p>

							<hr>

							<h4 class="heading-primary">Communication <strong>Details</strong></h4>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
                                <li><i class="fa fa-map-marker"></i> <strong>Exhibition Place &amp; Production Unit:</strong> 2nd km Serres-Neochori</li>
								<li><i class="fa fa-phone"></i> <strong>Phone No:</strong> +30 23210-76140</li>
                                <li><i class="fa fa-fax"></i> <strong>Fax No:</strong> +30 23211-11461</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:info@metalplus.gr">info@metalplus.gr</a></li>
							</ul>

							<hr>

							<h4 class="heading-primary"> <strong>Opening</strong> Hours</h4>
							<ul class="list list-icons list-dark mt-xlg">
								<li><i class="fa fa-clock-o"></i> Monday-Saturday: 8.30am - 4.30pm</li>
							</ul>
                             
						</div>
					</div>
<br>
       <hr class="tall">
                	
						<div class="row">
                            
                            <h4 class="heading-primary"> Network <strong>Partners</strong></h4>
                            <div class="col-md-6">
                                <br>
								
                                <p>Throughout Greece and abroad, we have partners who are ready to serve you in the fastest and most efficient way.</p>
                                <p>We package, transport and install your products methodically and highly professionally, so as the result will leave you completely satisfied.</p>
                                <p>Our partners are located in the following cities, islands and countries: </p>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <p>ATHENS - THESSALONIKI - XANTHI - SPARTA - PELA - PATRA -GYTHEIO- KALAMATA - IOANNINA - AMALIADA - XALKIDA - VOIOTIA</p>
                                <br>
                                <p>CORFU - ZAKYNTHOS - SAMOS - LESVOS - SANTORINI - CRETE - LEROS - KOS</p>
                                <br>
                                <p>GERMANY - FRANCE - CYPRUS - USA - BELGIUM</p>
							</div>
						</div>
					
				
                    
                    <hr class="tall">
                    
                <div class="row">
				    <div class="col-md-12 center">
                        <div class="owl-carousel owl-theme" data-plugin-options='{"items": 5, "autoplay": true, "autoplayTimeout": 9000}'>
						        <div>
									<img class="img-responsive" src="../img/store/transport5.jpg" alt="">
								</div>		
                                <div>
									<img class="img-responsive" src="../img/store/transport1.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport2.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport3.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport4.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport6.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport7.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport8.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport9.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport10.jpg" alt="">
								</div>
								<div>
									<img class="img-responsive" src="../img/store/transport11.jpg" alt="">
								</div>
								
							</div>
                    </div>
                </div>
				</div>                
			</div>
            <br>
            
            <footer id="footer">
				<div class="container">
					<div class="row">
						
						
						
						<div class="col-md-9">
							<div class="contact-details">
								<h4>Contact</h4>
								<ul class="contact">
                                    <li><p><i class="fa fa-map-marker"></i> <strong>Exhibition Place &amp; Production Unit:</strong> 2nd Km Serres-Neochori</p></li>
									<li><p><i class="fa fa-phone"></i> <strong>Phone no:</strong> 23210-76140</p></li>
                                    <li><p><i class="fa fa-fax"></i> <strong>Fax no:</strong> 23211-11461</p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:info@metalplus.gr">info@metalplus.gr</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3">
							<br>
                            <iframe src="https://www.facebook.com/plugins/follow.php?href=https%3A%2F%2Fwww.facebook.com%2FMETAL-PLUS-155777194907207%2F&width=450&height=80&layout=standard&size=small&show_faces=true&appId" width="250" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe><br>
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fwww.facebook.com%2FMETAL-PLUS-155777194907207%2F&layout=button_count&size=small&mobile_iframe=true&width=122&height=20&appId" width="250" height="50" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
                    <div class="container">
						<div class="row">
                            <div class="col-md-5">
                                <nav id="sub-menu">
									<ul>
										<li><a href="sitemap.html">Sitemap</a></li>
										<li><a href="contact.php">Contact</a></li>
									</ul>
								</nav>
                            </div>
							<div class="col-md-7">
								<p>© Copyright 2018 METAL+. All Rights Reserved.</p>
							</div>
						</div>
                    </div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="../vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="../vendor/jquery-cookie/jquery-cookie.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../vendor/common/common.min.js"></script>
		<script src="../vendor/jquery.validation/jquery.validation.min.js"></script>
		<script src="../vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="../vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="../vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="../vendor/isotope/jquery.isotope.min.js"></script>
		<script src="../vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="../vendor/vide/vide.min.js"></script>
        <script src="../js/examples/examples.gallery.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="../js/theme.js"></script>

		<!-- Current Page Vendor and Views -->
		<script src="../js/views/view.contact.js"></script>
		
		<!-- Theme Custom -->
		<script src="../js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="../js/theme.init.js"></script>

        <script>
        $('.google-map')
	.click(function(){
			$(this).find('iframe').addClass('clicked')})
	.mouseleave(function(){
			$(this).find('iframe').removeClass('clicked')});
        </script>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7IAu2I-Xm2txeszp1QNAyzhISJqH0viE"></script>
		<script>

			// Map Markers
			var mapMarkers = [{
				address: "2ο χλμ Σερρών-Νεοχωρίου",
				html: "<strong>Έκθεση & Μονάδα Παραγωγής</strong><br>2ο χλμ Σερρών-Νεοχωρίου<br><a href='#' onclick='mapCenterAt({latitude: 41.056750, longitude: 23.575722, zoom: 14}, event)'>[+] zoom here</a>",
				/*icon: {
					image: "img/orange-pin.png",
					iconsize: [86, 72],
					iconanchor: [-14, -38]
                }*/
			}];

			// Map Initial Location
			var initLatitude = 41.056750;
			var initLongitude = 23.575722;

			// Map Extended Settings
			var mapSettings = {
				controls: {
					draggable: (($.browser.mobile) ? false : true),
					panControl: true,
					zoomControl: true,
					mapTypeControl: true,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: true
				},
				scrollwheel: false,
				markers: mapMarkers,
				latitude: initLatitude,
				longitude: initLongitude,
				zoom: 12
			};

            var map = $('#googlemaps').gMap(mapSettings),
				mapRef = $('#googlemaps').data('gMap.reference');

			// Map Center At
			var mapCenterAt = function(options, e) {
				e.preventDefault();
				$('#googlemaps').gMap("centerAt", options);
			}

            // Styles from https://snazzymaps.com/
            
            var styles = [{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"labels.text","stylers":[{"visibility":"on"},{"saturation":"-3"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#fd901b"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"poi.school","elementType":"geometry.fill","stylers":[{"color":"#f39247"},{"saturation":"0"},{"visibility":"on"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#ff6f00"},{"saturation":"100"},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#f39247"},{"saturation":"0"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#008eff"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fd901b"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#f3dbc8"},{"saturation":"0"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#e9e9e9"}]}];

			var styledMap = new google.maps.StyledMapType(styles, {
				name: 'Styled Map'
			});

			mapRef.mapTypes.set('map_style', styledMap);
			mapRef.setMapTypeId('map_style');

		</script>
        
        
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92172578-1', 'auto');
  ga('send', 'pageview');

</script>

	</body>
</html>
