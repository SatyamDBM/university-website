<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
    <title>Course list</title>
    <link type="image/x-icon" rel="shortcut icon" href="images/fevicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/main.css" />
    <link type="text/css" rel="stylesheet" href="css/responsive.css" />
    <script type="text/javascript" src="js/custom.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

<script type="text/javascript">

	$(document).ready(function(){
		$('.menu').click(function(){
			$('html').toggleClass('show-menu');
		});
		$('.close-button').click(function(){
			$('html').removeClass('show-menu');
		});
		$(".nav-menu a").each(function(){
	    var pathname1 = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
		var pathname = pathname1.replace("#/", "");
		if ( $(this).attr('href') == pathname) { 
			$(this).parent().addClass('active');
		 } 
	   });

	  $(".nav-menu a").each(function(){
		var pathname1 = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
	 // alert(pathname1);
		var pathname = pathname1.replace("#/", "");
		if ( $(this).attr('href').indexOf(pathname1) > -1) { 
		$(this).parent().addClass('active');
		$(this).parent().parent().parent().addClass('active');
	 } 
  });
});

</script>

</head>

<body class="course-list">

    <!-- Header -->
    <header class="header">
        <marquee class="top-bar">
            <span class="welcome-text">  <img src="images/unversity.png" alt="unversity"> Welcome to Topuniversitiesinindia.Com</span>
        </marquee>    
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                   <a href="index.html"><img src="images/logo.png" alt="TUI Logo"></a>
            </div>

        <div class="menu">
				<div class="menu-trigger">
					<div class="line"></div>
				    <div class="line"></div>
					<div class="line"></div>
				</div>
		</div>

        <nav class="nav-menu">
            <div class="close-button">
			<i class="fa fa-times"></i>
			</div>
            <a href="index.html" class="nav-link active">Home</a>
            <!-- Universities List -->
            <div class="nav-item has-dropdown">
                <a href="university-listing.html" class="nav-link">Universities <i class="fas fa-chevron-down"></i></a>
                <div class="submenu">
                <a href="#">St. Stephen’s College</a>
                <a href="#">Loyola College</a>
                <a href="#">Presidency College</a>
                <a href="#">SRCC Delhi</a>
                <a href="#">Hansraj College</a>
                <a href="#">Christ University</a>
                <a href="#">Lady Shri Ram College</a>
                <a href="#">Miranda House</a>
                <a href="#">Hindu College</a>
                <a href="#">NLU Delhi</a>
                <a href="#">NALSAR Hyderabad</a>
                <a href="#">NLU Bangalore</a>
                <a href="#">Jamia Hamdard</a>
                <a href="#">NIPER Mohali</a>
                <a href="#">BITS Pilani</a>
                <a href="#">AIIMS Delhi</a>
                <a href="#">CMC Vellore</a>
                </div>
            </div>

                <!-- Courses Dropdown -->
            <div class="nav-item has-dropdown">
                <a href="Course-listing.html" class="nav-link active">
                    Courses <i class="fas fa-chevron-down"></i>
                </a>
                <div class="submenu">
                <a href="#">Engineering</a>
                <a href="#">Management</a>
                <a href="#">Medical</a>
                <a href="#">Science</a>
                <a href="#">Commerce</a>
                <a href="#">Arts</a>
                <a href="#">Law</a>
                <a href="#">Pharmacy</a>
                <a href="#">Paramedical</a>
                <a href="#">Education</a>
                <a href="#">Design</a>
                <a href="#">Hotel Management</a>
                <a href="#">Mass Communication</a>
                <a href="#">Computer Applications</a>
                <a href="#">Vocational Courses</a>
                <a href="#">Agriculture</a>
                <a href="#">Architecture</a>
                <a href="#">Dental</a>
                </div>
            </div>
            <a href="blog.html" class="nav-link">Blog </a>
        </nav>
                <div class="auth-buttons">
                    <button class="btn-login" onclick="openLoginModal()">Universiy Login</button>
                    <button class="btn-signup" onclick="openEnquiryModal()">Enquire Now</button>
                </div>
            </div>
    </header>
     <!-- End of Header -->


         <!-- Banner section -->
    <section class="hero common-hero">

        <div class="hero-banner">
        <img src="images/banner.png" alt="Background Image" class="bg-image">
        </div>

        <div class="middleware">
            <div class="hero-content">
                <div class="left portion">
                <p class="hero-subtitle"><img src="images/unversity.png" alt="unversity"> india’s #1 University Discovery Platform</p>
                <h2 class="hero-title">Courses List</h2>
                <p class="hero-description">Welcome to your trusted platform for discovering the best educational opportunities across India.</p>
                </div>
            </div>
        </div>
    </section>
    <!--End of Banner section -->


    <!--courses list -->
      <section class="sec" id="sec-courses">
        <div class="W">
          <div class="sh rv">
            <p class="section-btn">Courses &amp; Fee Structure</p>
            <div class="sh-h">200+ Programs at <em>Every Level</em></div>
            <div class="sh-sub">UG, PG and PhD across Engineering, Management, Law, Medical Sciences, Architecture and more</div>
          </div>
          <div class="course-grid">
            <div class="cc rv d1">
              <div class="cc-head"><div class="cc-name">⚙️ B.E. / B.Tech Engineering</div><span class="cc-dur">4 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">CSE (General)</span><span class="fee-amt">₹5.97 – 9.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">CSE with AI / ML / Cloud</span><span class="fee-amt">₹10.5 – 14.84L total</span></div>
                <div class="fee-row"><span class="fee-spec">ECE / Electrical / Mech</span><span class="fee-amt">₹5.97 – 8.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">Aerospace / Robotics</span><span class="fee-amt">₹9.0 – 12.8L total</span></div>
                <div class="fee-row"><span class="fee-spec">Civil / Chemical / Food Tech</span><span class="fee-amt">₹5.97 – 7.5L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">JEE Main</span><span class="cc-exam">CUCET</span><span class="cc-exam">Board Merit</span></div>
              </div>
            </div>
            <div class="cc rv d2">
              <div class="cc-head"><div class="cc-name">📊 MBA / Management</div><span class="cc-dur">2 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">MBA General</span><span class="fee-amt">₹3.84 – 5.04L total</span></div>
                <div class="fee-row"><span class="fee-spec">MBA Business Analytics</span><span class="fee-amt">₹6.0 – 7.57L total</span></div>
                <div class="fee-row"><span class="fee-spec">MBA Digital Marketing</span><span class="fee-amt">₹5.5 – 7.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">MBA Finance / HR / Ops</span><span class="fee-amt">₹3.84 – 5.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">BBA (3 Years)</span><span class="fee-amt">₹2.2 – 3.5L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">CAT</span><span class="cc-exam">MAT</span><span class="cc-exam">XAT</span><span class="cc-exam">CUCET</span></div>
              </div>
            </div>
            <div class="cc rv d3">
              <div class="cc-head"><div class="cc-name">⚕️ Pharmacy &amp; Health Sciences</div><span class="cc-dur">2–6 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">B.Pharm (4 Years)</span><span class="fee-amt">₹4.8 – 6.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">M.Pharm (2 Years)</span><span class="fee-amt">₹3.2 – 4.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">Pharm D (6 Years)</span><span class="fee-amt">₹8.5 – 10.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">BPT / B.Optom</span><span class="fee-amt">₹3.5 – 5.0L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">NEET</span><span class="cc-exam">CUCET</span></div>
              </div>
            </div>
            <div class="cc rv d4">
              <div class="cc-head"><div class="cc-name">⚖️ Law / Architecture / Sciences</div><span class="cc-dur">3–5 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">LLB (3 Years)</span><span class="fee-amt">₹3.0 – 4.2L total</span></div>
                <div class="fee-row"><span class="fee-spec">BA LLB / BBA LLB (5 Yrs)</span><span class="fee-amt">₹5.5 – 8.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">B.Arch (5 Years)</span><span class="fee-amt">₹7.5 – 10.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">BCA / MCA / B.Sc / M.Sc</span><span class="fee-amt">₹1.35 – 4.8L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">CLAT</span><span class="cc-exam">NATA</span><span class="cc-exam">CUCET</span><span class="cc-exam">GATE</span></div>
              </div>
            </div>
            <div class="cc rv d5">
              <div class="cc-head"><div class="cc-name">⚖️ Law / Architecture / Sciences</div><span class="cc-dur">3–5 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">LLB (3 Years)</span><span class="fee-amt">₹3.0 – 4.2L total</span></div>
                <div class="fee-row"><span class="fee-spec">BA LLB / BBA LLB (5 Yrs)</span><span class="fee-amt">₹5.5 – 8.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">B.Arch (5 Years)</span><span class="fee-amt">₹7.5 – 10.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">BCA / MCA / B.Sc / M.Sc</span><span class="fee-amt">₹1.35 – 4.8L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">CLAT</span><span class="cc-exam">NATA</span><span class="cc-exam">CUCET</span><span class="cc-exam">GATE</span></div>
              </div>
            </div>
            <div class="cc rv d6">
              <div class="cc-head"><div class="cc-name">⚖️ Law / Architecture / Sciences</div><span class="cc-dur">3–5 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">LLB (3 Years)</span><span class="fee-amt">₹3.0 – 4.2L total</span></div>
                <div class="fee-row"><span class="fee-spec">BA LLB / BBA LLB (5 Yrs)</span><span class="fee-amt">₹5.5 – 8.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">B.Arch (5 Years)</span><span class="fee-amt">₹7.5 – 10.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">BCA / MCA / B.Sc / M.Sc</span><span class="fee-amt">₹1.35 – 4.8L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">CLAT</span><span class="cc-exam">NATA</span><span class="cc-exam">CUCET</span><span class="cc-exam">GATE</span></div>
              </div>
            </div>

            <div class="cc rv d7">
              <div class="cc-head"><div class="cc-name">⚖️ Law / Architecture / Sciences</div><span class="cc-dur">3–5 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">LLB (3 Years)</span><span class="fee-amt">₹3.0 – 4.2L total</span></div>
                <div class="fee-row"><span class="fee-spec">BA LLB / BBA LLB (5 Yrs)</span><span class="fee-amt">₹5.5 – 8.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">B.Arch (5 Years)</span><span class="fee-amt">₹7.5 – 10.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">BCA / MCA / B.Sc / M.Sc</span><span class="fee-amt">₹1.35 – 4.8L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">CLAT</span><span class="cc-exam">NATA</span><span class="cc-exam">CUCET</span><span class="cc-exam">GATE</span></div>
              </div>
            </div>
            <div class="cc rv d8">
              <div class="cc-head"><div class="cc-name">⚖️ Law / Architecture / Sciences</div><span class="cc-dur">3–5 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">LLB (3 Years)</span><span class="fee-amt">₹3.0 – 4.2L total</span></div>
                <div class="fee-row"><span class="fee-spec">BA LLB / BBA LLB (5 Yrs)</span><span class="fee-amt">₹5.5 – 8.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">B.Arch (5 Years)</span><span class="fee-amt">₹7.5 – 10.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">BCA / MCA / B.Sc / M.Sc</span><span class="fee-amt">₹1.35 – 4.8L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">CLAT</span><span class="cc-exam">NATA</span><span class="cc-exam">CUCET</span><span class="cc-exam">GATE</span></div>
              </div>
            </div>
          </div>
        </div>
      </section>

<!-- End courses list -->
  
<!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter-form">
            <h2>Join Our Newsletter</h2>
            <p>Subscribe to get updates on your inbox. Latest updates & news</p>
            </div>
            <div class="newsletter-form">
                <input type="email" placeholder="Enter your email" id="newsletterEmail">
                <button onclick="subscribeNewsletter()">Subscribe Now</button>
            </div>
        </div>
    </section>

      <!-- End Newsletter -->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col first">
                    <div class="footer-logo">
                       
                   <a href="#"><img src="images/logo.png" alt="TUI Logo"></a>
               
                    </div>
                    <p>Begonia & Clover, Embassy Tech Village, Outer Ring Road, Devarabeesanahalli Village, Bengaluru – 560103, Karnataka, India.</p>
                  
                </div>
                
                <div class="footer-col">
                    <h3>Top Universities</h3>
                    <ul>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Engineering</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Management</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Medical</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Law</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="course-detail.html">Science</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Quick links</h3>
                    <ul>
                        <li><i class="fa-solid fa-angle-right"></i><a href="about.html">About</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="blog.html">Blog and article</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="Faq.html">Faq</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="contact.html">Contact us</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="terms-conditions.html">Terms & conditions</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="privacy policy.html">Privacy & policy</a></li>
                    </ul>
                </div>
            </div>

        </div>
                    <div class="footer-bottom">
                <p>Copyright © 2026 <a href="index.html" target="_blank">topuniversitiesindia.com</a> | All Rights Reserved</p>
            </div>
    </footer>
    <!-- End Footer -->

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLoginModal()">&times;</span>
            <h2>Login to get started</h2>
            <form onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-submit">Login</button>
                <p class="form-footer">Don't have an account? <a href="#" onclick="openSignupModal()">Sign up</a></p>
            </form>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeSignupModal()">&times;</span>
            <h2>Institute Sign Up</h2>
            <form onsubmit="handleSignup(event)">
                <div class="form-group">
                    <label>Institute Name</label>
                    <input type="text" placeholder="Enter institute name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-submit">Sign Up</button>
                <p class="form-footer">Already have an account? <a href="#" onclick="openLoginModal()">Login</a></p>
            </form>
        </div>
    </div>

        <!-- Enquiry Modal -->
    <div id="enquiryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEnquiryModal()">&times;</span>
            <h2>Enquire Now</h2>
            <form onsubmit="handleEnquiry(event)">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="tel" placeholder="Mobile Number" required>
                </div>
                <div class="form-group">
                    <label>Course Interested In</label>
                    <input type="text" placeholder="Course Interested In" required>
                </div>
                <div class="form-group">
                    <label>Write message here...</label>
                    <textarea type="text" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="btn-submit">Enquire Now</button>
            </form>
        </div>
    </div>

</body>
</html>