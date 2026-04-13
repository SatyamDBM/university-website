<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
    <title>University Detail</title>
    <link type="image/x-icon" rel="shortcut icon" href="images/fevicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/main.css" />
       <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/responsive.css" />
    <script type="text/javascript" src="js/custom.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

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
<body class="property-detail-page">
<div id="pgb"></div>

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
            <a href="index.html" class="nav-link">Home</a>
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
                <a href="Course-listing.html" class="nav-link">
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

    <section class="hero detail-hero">

        <div class="hero-banner">
        <img src="images/detail.png" alt="Background Image" class="bg-image">
        </div>

        <div class="middleware">
            <div class="hero-content">
                <div class="left portion">
                <h1 class="hero-title">Indian institute of technology,<br> Delhi</h1>
                <p class="hero-subtitle"><img src="images/unversity.png" alt="unversity">India’s premier engineering & technology institute - NAAC A+, NIRF #2 (Engineering)</p>
                  <div class="left-allign">
                    <p class="first">NIRF #2 ENGINEERING 2026</p>
                    <p class="second">NAAC A+ | 3.28 CGPA</p>
                    <p class="third">NBA ACCREDITED</p>
                    <p class="fourth">Institute Of Eminence - Awarded</p>

                  </div>

                 <div class="botton-design">
                <!-- Stats -->
                <div class="stats">
                    <div class="stat-item">
                        <div>
                            <h3>90%</h3>
                            <p>Placement Rate</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <h3>170 LPA</h3>
                            <p>Highest Package</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <h3>200+</h3>
                            <p>Courses Offered</p>
                        </div>
                    </div>
                        <div class="stat-item">
                        <div>
                            <h3>1000+</h3>
                            <p>Recruiters (2026)</p>
                        </div>
                    </div>
                </div>
          <!-- right portion -->
                <div class="left-part">
                    <div class="stat-item-part">
                            <span>10,000+</span>
                            <span>Students Placed</span>
                    </div>
                    <div class="stat-item-part">
                            <span>19.35 lpa</span>
                            <span>CSE Average Package</span>
                    </div>
                    <div class="stat-item-part">
                            <span>300+</span>
                            <span>UG / PG Courses</span>
                    </div>
                    <div class="stat-item-part">
                            <span>2.25</span>
                            <span>Naac Cgpa Score</span>
                    </div>

                </div>
                </div>

              <div class="midified">
                    <div class="stat-item">
                        <div>
                            <h3>#91</h3>
                            <p>Nirf University 2026</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <h3>#1</h3>
                            <p>QS Asia-private Uni.</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div>
                            <h3>A+</h3>
                            <p>NAAC Grade</p>
                        </div>
                    </div>
                </div>


                </div>

            </div>
        </div>
    </section>

     <!--End of Banner section -->

      <!--  PROFILE SECTION NAV  -->
      <nav class="pnav">
        <div class="pnav-in">
          <button class="pnb on" onclick="navTo(this,'sec-overview')"><img src="images/overview.png" alt="Overview"> Overview</button>
          <button class="pnb" onclick="navTo(this,'sec-rankings')"><img src="images/rankings.png" alt="Rankings">Rankings</button>
          <button class="pnb" onclick="navTo(this,'sec-placements')"><img src="images/placements.png" alt="Placements">Placements</button>
          <button class="pnb" onclick="navTo(this,'sec-courses')"><img src="images/courses.png" alt="Courses">Courses & Fees</button>
          <button class="pnb" onclick="navTo(this,'sec-campus')"><img src="images/campus.png" alt="Campus">Campus</button>
          <button class="pnb" onclick="navTo(this,'sec-hostel')"><img src="images/hostel.png" alt="Hostel">Hostel & Food</button>
          <button class="pnb" onclick="navTo(this,'sec-admission')"><img src="images/admission.png" alt="Admission">Admission</button>
          <button class="pnb" onclick="navTo(this,'sec-scholarships')"><img src="images/scholarship.png" alt="Scholarships">Scholarships</button>
          <button class="pnb" onclick="navTo(this,'sec-loan-partners')"><img src="images/scholarship.png" alt="Loan Partners">Loan Partners</button>
        </div>
      </nav>


      <!--  OVERVIEW  -->
      <section class="sec alt">
        <div class="W">
          <div class="ov-grid">
            <div>
              <div class="card about-card rv">
                <div class="sh" style="margin-bottom:0px">
                  <p class="section-btn">About University</p>
                  <div class="sh-h">Indian Institute Of Technology, Delhi</div>
                </div>
                <p class="about-p">IIT, Delhi (Cu), Established On 10 July 2012, Is A Private University Located In Gharuan Village, Mohali, Punjab — Approximately 10 Km From Chandigarh. In Just 12 Years, Cu Has Become India's Youngest And Fastest-rising Private University To Receive Naac A+ Accreditation, A Feat No Other State Private University In Punjab Has Achieved In Its First Assessment Cycle.
                Recognized By The University Grants Commission (Ugc) Under Section 2(f) And Approved By Aicte, Bci, Pci, Nba, Coa, Ncte, And Icar Among Others, The University Comprises 14+ Institutes Offering 200+ Programs Across Engineering, Management, Law, Pharmacy, Architecture, Sciences, Commerce, And More. Cu Is The Only Private University In The Tricity Region To Earn Full Naac A+ Accreditation.
                Cu Has Forged Over 515 Global Academic Collaborations With Universities Across Usa, Uk, Canada, Europe And Asia. These Enable Student & Faculty Exchange, Dual Degrees, And Joint Research. Ranked #109 In Qs Asia 2026 And #1 Among India's Private Universities In Qs Asia For 3 Consecutive Years, Cu's Global Standing Continues To Rise Sharply.</p>
              </div>

              <div class="card facts-wrap rv d1">
                <p class="section-btn">Key facts</p>
                <div class="fact-row"><span class="fact-k">Established</span><span class="fact-v">15 June 2016</span></div>
                <div class="fact-row"><span class="fact-k">Type</span><span class="fact-v">Government University (State Act, Delhi)</span></div>
                <div class="fact-row"><span class="fact-k">Location</span><span class="fact-v">NH-5, Ludhiana Highway, Mohali, Punjab 140413</span></div>
                <div class="fact-row"><span class="fact-k">Chancellor</span><span class="fact-v">Satnam Singh Sandhu (MP, Rajya Sabha)</span></div>
                <div class="fact-row"><span class="fact-k">Campus Area</span><span class="fact-v">200 Acres (Mohali)</span></div>
                <div class="fact-row"><span class="fact-k">Total Students</span><span class="fact-v">30,000+</span></div>
                <div class="fact-row"><span class="fact-k">ACADEMIC STAFF</span><span class="fact-v">687</span></div>
                <div class="fact-row"><span class="fact-k">Admission Exam</span><span class="fact-v">CUCET / JEE Main / CAT / NEET / GATE / CLAT</span></div>
                <div class="fact-row"><span class="fact-k">Application Fee</span><span class="fact-v">₹1,000</span></div>
                <div class="fact-row"><span class="fact-k">Official Website</span><span class="fact-v">https://home.iitd.ac.in/</span></div>
              </div>


                    <!--  RANKINGS  -->
      <section class="sec" id="sec-rankings">
        <div class="bg-colr">
          <div class="sh rv">
            <p class="section-btn">Rankings 2026</p>
            <div class="sh-h">National Rankings 2026</div>
            <div class="sh-sub">IIt Delhi Has Improved Its Rank Every Single Year Since 2018 - Across NIRF, QS And The Week</div>
          </div>
          <div class="rank-cards">
            <div class="rc rc-nirf rv d1">
              <div class="rc-agency">NIRF 2026 - University</div>
              <div class="rc-rank">#91</div>
              <div class="rc-yr">Ministry Of Education, India</div>
              <div class="rc-cat">Among All Govt. + Private Universities</div>
              <div class="rc-trend">Was #100 In 2024, #99 In 2025</div>
            </div>
            <div class="rc rc-qs rv d2">
              <div class="rc-agency">QS Asia 2026</div>
              <div class="rc-rank">#109</div>
              <div class="rc-yr">Quacquarelli Symonds · Asia</div>
              <div class="rc-cat">#1 Private University in India</div>
              <div class="rc-trend">3 consecutive years at #1</div>
            </div>
            <div class="rc rc-asia rv d3">
              <div class="rc-agency">QS World 2026</div>
              <div class="rc-rank">#575</div>
              <div class="rc-yr">QS World University Rankings</div>
              <div class="rc-cat">16th in India · 2nd among Private</div>
              <div class="rc-trend">Was 701–710 band previously</div>
            </div>
            <div class="rc rc-out rv d4">
              <div class="rc-agency">The Week · India</div>
              <div class="rc-rank">#1</div>
              <div class="rc-yr">Best Emerging University</div>
              <div class="rc-cat">3 consecutive years</div>
              <div class="rc-trend">Consistent Category Winner</div>
            </div>
          </div>

          <div class="rank-table-wrap rv">
            <table class="rt">
              <thead>
                <tr><th>Ranking Body</th><th>Category</th><th>2025 Rank</th><th>2024 Rank</th><th>Change</th><th>Score</th></tr>
              </thead>
              <tbody>
                <tr><td>NIRF 2025</td><td>Engineering</td><td class="rt-v">#2</td><td>#2</td><td class="rt-up">↑ +1</td><td>61.27</td></tr>
                <tr><td>NIRF 2025</td><td>Overall (All institutions)</td><td class="rt-v">#32</td><td>#32</td><td style="color:var(--muted);font-size:12px">— Same</td><td>—</td></tr>
                <tr><td>NIRF 2025</td><td>Engineering</td><td class="rt-v">#31</td><td>#32</td><td class="rt-up">↑ +1</td><td>60.46</td></tr>
                <tr><td>NIRF 2025</td><td>Management</td><td class="rt-v">#32</td><td>#36</td><td class="rt-up">↑ +4</td><td>59.40</td></tr>
                <tr><td>NIRF 2025</td><td>Pharmacy</td><td class="rt-v">#15</td><td>#20</td><td class="rt-up">↑ +5</td><td>—</td></tr>
                <tr><td>NIRF 2025</td><td>Architecture Planning</td><td class="rt-v">#14</td><td>#13</td><td class="rt-dn">↓ -1</td><td>—</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

            </div>

            <!-- SIDEBAR -->
            <div class="sidebar">
              <div class="apply-box rv">
                <div class="ab-in">
                  <div class="ab-deadline">Admission 2026-27 Open - Deadline July 2027</div>
                  <div class="ab-h">Enquiry to IIT, DELHI</div>
                  <button class="ab-btn">Enquire Now</button>
                  <button class="ab-btn2">Download Brochure</button>
                </div>
              </div>

              <div class="card facts-wrap rv d1 new-update-accelate">
                <p class="section-btn">Important Dates 2026</p>
                <div class="fact-row"><span class="fact-k">Application open</span><span class="fact-v">Jan 2026</span></div>
                <div class="fact-row"><span class="fact-k">Application Deadline</span><span class="fact-v">July 2027</span></div>
                <div class="fact-row"><span class="fact-k">CUCET Phase 1</span><span class="fact-v">March-April 2026</span></div>
                <div class="fact-row"><span class="fact-k">CUCET Phase 2</span><span class="fact-v">May-June 2026</span></div>
                <div class="fact-row"><span class="fact-k">Merit List Release</span><span class="fact-v">Within 7 days of exam</span></div>
                <div class="fact-row"><span class="fact-k">Counselling (rolling)</span><span class="fact-v">Ongoing - After each phase</span></div>
                <div class="fact-row"><span class="fact-k">Classes Begin</span><span class="fact-v">August 2026</span></div>
              </div>

                   <!--Addon section -->
          <div class="banner-add" style="margin-top: 40px;">
            <img src="images/addon-banner.jpg" alt="View All Universities">
          </div>

          <div class="banner-add" style="margin-top: 40px;">
            <img src="images/addon-feature.jpg" alt="View All Universities">
        </div>
 <!-- End Addon section -->

            </div>
          </div>
        </div>
      </section>



      <!--  PLACEMENTS  -->
      <section class="sec alt" id="sec-placements">
        <div class="W">
        <div class="bg-colr">
          <div class="sh rv">
            <p class="section-btn">Placements 2026</p>
            <div class="sh-h">10,000+ Placed - 1200+ Companies</div>
            <div class="sh-sub">Highest Domestic Package ₹180 Lpa - Highest International Package ₹60.75 Lpa 90% Placement Rate</div>
          </div>

          <div class="ptab-wrap rv">
            <div class="ptab-bar" role="tablist" aria-label="Placement data by course">
              <button class="ptb active" onclick="switchPlaceTab(this,'cse')" role="tab" aria-selected="true">B.Tech CSE</button>
              <button class="ptb" onclick="switchPlaceTab(this,'mba')" role="tab" aria-selected="false">MBA</button>
              <button class="ptb" onclick="switchPlaceTab(this,'ece')" role="tab" aria-selected="false">B.Tech ECE</button>
              <button class="ptb" onclick="switchPlaceTab(this,'law')" role="tab" aria-selected="false">Law / LLB</button>
              <button class="ptb" onclick="switchPlaceTab(this,'pharm')" role="tab" aria-selected="false">Pharmacy</button>
            </div>

            <!-- CSE Tab -->
            <div class="ptab-panel active" id="pt-cse">
              <div class="place-top">
                <div class="pkg-card rv d1">
                  <div class="pk-in">
                    <div class="pk-eye">B.Tech CSE · Highest Package · 2025</div>
                    <div class="pk-val">₹170 LPA</div>
                    <div class="pk-sub">Offered by Microsoft · Campus placement · CU Verified</div>
                    <div class="pk-minis">
                      <div class="pkm"><span class="pkm-l">Avg Package</span><span class="pkm-v">₹7.35L</span></div>
                      <div class="pkm"><span class="pkm-l">Intl. Highest</span><span class="pkm-v">₹54.75L</span></div>
                      <div class="pkm"><span class="pkm-l">Placed %</span><span class="pkm-v">92%</span></div>
                    </div>
                  </div>
                </div>
                <div class="stat-box rv d2">
                  <div><div class="sb-icon">🏢</div><div class="sb-lbl">Recruiters (CSE)</div></div>
                  <div class="sb-val">800+</div>
                  <div class="sb-sub">IT, Product, FinTech, Core · 2024–25</div>
                </div>
                <div class="stat-box rv d3">
                  <div><div class="sb-icon">👨‍💻</div><div class="sb-lbl">CSE Students Placed</div></div>
                  <div class="sb-val">4,200+</div>
                  <div class="sb-sub">Batch 2025 · Google, Amazon, TCS, Wipro</div>
                </div>
              </div>
              <div class="ptab-highlights">
                <div class="pth"><div class="pth-co">Google</div><div class="pth-role">₹40 LPA</div></div>
                <div class="pth"><div class="pth-co">Amazon</div><div class="pth-role">₹44 LPA</div></div>
                <div class="pth"><div class="pth-co">Microsoft</div><div class="pth-role">₹170 LPA</div></div>
                <div class="pth"><div class="pth-co">Infosys</div><div class="pth-role">₹4.5 LPA</div></div>
                <div class="pth"><div class="pth-co">Wipro</div><div class="pth-role">D₹3.5 LPA</div></div>
                <div class="pth"><div class="pth-co">Accenture</div><div class="pth-role">₹4.5 LPA</div></div>
              </div>
            </div>

            <!-- MBA Tab -->
            <div class="ptab-panel" id="pt-mba">
              <div class="place-top">
                <div class="pkg-card rv d1">
                  <div class="pk-in">
                    <div class="pk-eye">MBA · Highest Package · 2025</div>
                    <div class="pk-val">₹28 LPA</div>
                    <div class="pk-sub">Deloitte Consulting · Campus placement · CU Verified</div>
                    <div class="pk-minis">
                      <div class="pkm"><span class="pkm-l">Avg Package</span><span class="pkm-v">₹8.4L</span></div>
                      <div class="pkm"><span class="pkm-l">Median</span><span class="pkm-v">₹7.0L</span></div>
                      <div class="pkm"><span class="pkm-l">Placed %</span><span class="pkm-v">88%</span></div>
                    </div>
                  </div>
                </div>
                <div class="stat-box rv d2">
                  <div><div class="sb-icon">💼</div><div class="sb-lbl">MBA Recruiters</div></div>
                  <div class="sb-val">320+</div>
                  <div class="sb-sub">Finance, Consulting, FMCG, Tech</div>
                </div>
                <div class="stat-box rv d3">
                  <div><div class="sb-icon">📈</div><div class="sb-lbl">MBA Students Placed</div></div>
                  <div class="sb-val">1,800+</div>
                  <div class="sb-sub">Batch 2025 · Deloitte, KPMG, PwC</div>
                </div>
              </div>
              <div class="ptab-highlights">
                <div class="pth"><div class="pth-co">Deloitte</div><div class="pth-role">Consultant · ₹28 LPA</div></div>
                <div class="pth"><div class="pth-co">KPMG</div><div class="pth-role">Analyst · ₹12 LPA</div></div>
                <div class="pth"><div class="pth-co">PwC India</div><div class="pth-role">Associate · ₹10 LPA</div></div>
                <div class="pth"><div class="pth-co">Zomato</div><div class="pth-role">BizDev · ₹9 LPA</div></div>
                <div class="pth"><div class="pth-co">Capgemini</div><div class="pth-role">Mgmt · ₹7 LPA</div></div>
                <div class="pth"><div class="pth-co">Cognizant</div><div class="pth-role">Analyst · ₹6.5 LPA</div></div>
              </div>
            </div>

            <!-- ECE Tab -->
            <div class="ptab-panel" id="pt-ece">
              <div class="place-top">
                <div class="pkg-card rv d1">
                  <div class="pk-in">
                    <div class="pk-eye">B.Tech ECE · Highest Package · 2025</div>
                    <div class="pk-val">₹42 LPA</div>
                    <div class="pk-sub">Samsung R&amp;D · Campus placement · CU Verified</div>
                    <div class="pk-minis">
                      <div class="pkm"><span class="pkm-l">Avg Package</span><span class="pkm-v">₹5.8L</span></div>
                      <div class="pkm"><span class="pkm-l">Core Roles</span><span class="pkm-v">60%</span></div>
                      <div class="pkm"><span class="pkm-l">Placed %</span><span class="pkm-v">85%</span></div>
                    </div>
                  </div>
                </div>
                <div class="stat-box rv d2">
                  <div><div class="sb-icon">📡</div><div class="sb-lbl">ECE Recruiters</div></div>
                  <div class="sb-val">240+</div>
                  <div class="sb-sub">VLSI, Telecom, Defence, IT</div>
                </div>
                <div class="stat-box rv d3">
                  <div><div class="sb-icon">🔌</div><div class="sb-lbl">ECE Students Placed</div></div>
                  <div class="sb-val">1,400+</div>
                  <div class="sb-sub">Samsung, HCL, Qualcomm, BSNL</div>
                </div>
              </div>
              <div class="ptab-highlights">
                <div class="pth"><div class="pth-co">Samsung R&amp;D</div><div class="pth-role">Engineer · ₹42 LPA</div></div>
                <div class="pth"><div class="pth-co">HCL Tech</div><div class="pth-role">Dev · ₹12 LPA</div></div>
                <div class="pth"><div class="pth-co">Qualcomm</div><div class="pth-role">VLSI · ₹18 LPA</div></div>
                <div class="pth"><div class="pth-co">Ericsson</div><div class="pth-role">Telecom · ₹8 LPA</div></div>
                <div class="pth"><div class="pth-co">TCS</div><div class="pth-role">IT · ₹3.5 LPA</div></div>
                <div class="pth"><div class="pth-co">Wipro</div><div class="pth-role">Dev · ₹3.5 LPA</div></div>
              </div>
            </div>

            <!-- Law Tab -->
            <div class="ptab-panel" id="pt-law">
              <div class="place-top">
                <div class="pkg-card rv d1">
                  <div class="pk-in">
                    <div class="pk-eye">LLB / LLM · Highest Package · 2025</div>
                    <div class="pk-val">₹18 LPA</div>
                    <div class="pk-sub">Cyril Amarchand Mangaldas · Campus placement</div>
                    <div class="pk-minis">
                      <div class="pkm"><span class="pkm-l">Avg Package</span><span class="pkm-v">₹6.5L</span></div>
                      <div class="pkm"><span class="pkm-l">Judiciary</span><span class="pkm-v">22%</span></div>
                      <div class="pkm"><span class="pkm-l">Placed %</span><span class="pkm-v">78%</span></div>
                    </div>
                  </div>
                </div>
                <div class="stat-box rv d2">
                  <div><div class="sb-icon">⚖️</div><div class="sb-lbl">Law Firms Hiring</div></div>
                  <div class="sb-val">90+</div>
                  <div class="sb-sub">Top tier, boutique &amp; in-house</div>
                </div>
                <div class="stat-box rv d3">
                  <div><div class="sb-icon">👨‍⚖️</div><div class="sb-lbl">Law Students Placed</div></div>
                  <div class="sb-val">680+</div>
                  <div class="sb-sub">Batch 2025 · Litigation, Corp &amp; IP</div>
                </div>
              </div>
              <div class="ptab-highlights">
                <div class="pth"><div class="pth-co">Cyril Amarchand</div><div class="pth-role">Associate · ₹18 LPA</div></div>
                <div class="pth"><div class="pth-co">Khaitan &amp; Co</div><div class="pth-role">Associate · ₹14 LPA</div></div>
                <div class="pth"><div class="pth-co">AZB &amp; Partners</div><div class="pth-role">Junior · ₹12 LPA</div></div>
                <div class="pth"><div class="pth-co">Lakshmikumaran</div><div class="pth-role">Advocate · ₹8 LPA</div></div>
                <div class="pth"><div class="pth-co">Punjab &amp; Haryana HC</div><div class="pth-role">Judiciary</div></div>
                <div class="pth"><div class="pth-co">In-house Counsel</div><div class="pth-role">Legal · ₹7 LPA</div></div>
              </div>
            </div>

            <!-- Pharmacy Tab -->
            <div class="ptab-panel" id="pt-pharm">
              <div class="place-top">
                <div class="pkg-card rv d1">
                  <div class="pk-in">
                    <div class="pk-eye">B.Pharm / M.Pharm · Highest Package · 2025</div>
                    <div class="pk-val">₹14 LPA</div>
                    <div class="pk-sub">Cipla Ltd. · Campus placement · CU Verified</div>
                    <div class="pk-minis">
                      <div class="pkm"><span class="pkm-l">Avg Package</span><span class="pkm-v">₹4.8L</span></div>
                      <div class="pkm"><span class="pkm-l">NIRF Rank</span><span class="pkm-v">#15</span></div>
                      <div class="pkm"><span class="pkm-l">Placed %</span><span class="pkm-v">82%</span></div>
                    </div>
                  </div>
                </div>
                <div class="stat-box rv d2">
                  <div><div class="sb-icon">💊</div><div class="sb-lbl">Pharma Recruiters</div></div>
                  <div class="sb-val">180+</div>
                  <div class="sb-sub">Cipla, Dr. Reddy's, Zydus, Sun</div>
                </div>
                <div class="stat-box rv d3">
                  <div><div class="sb-icon">🔬</div><div class="sb-lbl">Pharma Students Placed</div></div>
                  <div class="sb-val">900+</div>
                  <div class="sb-sub">Batch 2025 · R&amp;D, QA, Sales roles</div>
                </div>
              </div>
              <div class="ptab-highlights">
                <div class="pth"><div class="pth-co">Cipla</div><div class="pth-role">R&amp;D Scientist · ₹14 LPA</div></div>
                <div class="pth"><div class="pth-co">Dr. Reddy's</div><div class="pth-role">QA Analyst · ₹8 LPA</div></div>
                <div class="pth"><div class="pth-co">Zydus Cadila</div><div class="pth-role">Formulation · ₹6 LPA</div></div>
                <div class="pth"><div class="pth-co">Sun Pharma</div><div class="pth-role">Sales · ₹5 LPA</div></div>
                <div class="pth"><div class="pth-co">Biocon</div><div class="pth-role">Research · ₹6.5 LPA</div></div>
                <div class="pth"><div class="pth-co">Abbott</div><div class="pth-role">QC · ₹5.5 LPA</div></div>
              </div>
            </div>
          </div>
        
        </div>
        </div>
      </section>

      <!--  COURSES & FEES  -->
      <section class="sec" id="sec-courses">
        <div class="W">
        <div class="bg-colr">
          <div class="sh rv">
            <p class="section-btn">Courses & Fee Structure</p>
            <div class="sh-h">Programs At Every Level</div>
            <div class="sh-sub">UG, PG and PhD Across Engineering, Management, Law, Medical Sciences, Architecture And More</div>
          </div>
          <div class="course-grid">
            <div class="cc rv d1">
              <div class="cc-head"><div class="cc-name">B.E. / B.Tech Engineering</div><span class="cc-dur">4 Years</span></div>
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
              <div class="cc-head"><div class="cc-name">MBA / Management</div><span class="cc-dur">2 Years</span></div>
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
              <div class="cc-head"><div class="cc-name">Pharmacy &amp; Health Sciences</div><span class="cc-dur">2–6 Years</span></div>
              <div class="cc-body">
                <div class="fee-row"><span class="fee-spec">B.Pharm (4 Years)</span><span class="fee-amt">₹4.8 – 6.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">M.Pharm (2 Years)</span><span class="fee-amt">₹3.2 – 4.5L total</span></div>
                <div class="fee-row"><span class="fee-spec">Pharm D (6 Years)</span><span class="fee-amt">₹8.5 – 10.0L total</span></div>
                <div class="fee-row"><span class="fee-spec">BPT / B.Optom</span><span class="fee-amt">₹3.5 – 5.0L total</span></div>
                <div class="cc-exams"><div class="cc-exam-l">Entrance Exams</div><span class="cc-exam">NEET</span><span class="cc-exam">CUCET</span></div>
              </div>
            </div>
            <div class="cc rv d4">
              <div class="cc-head"><div class="cc-name">Law / Architecture / Sciences</div><span class="cc-dur">3–5 Years</span></div>
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
      </div>
      </section>

      <!--  COURSES & FEES  -->
      <section class="sec" id="retn">
        <div class="W">

        <div class="bg-colr">
                                <p class="section-btn">Recruiters Details</p>
            <div class="sh-h">Top Recruiters - Batch 2025-2026</div>
                <div class="ptab-highlights">
                <div class="pth"><div class="pth-co">Google</div><div class="pth-role">₹40 LPA</div></div>
                <div class="pth"><div class="pth-co">Amazon</div><div class="pth-role">₹44 LPA</div></div>
                <div class="pth"><div class="pth-co">Microsoft</div><div class="pth-role">₹170 LPA</div></div>
                <div class="pth"><div class="pth-co">Infosys</div><div class="pth-role">₹4.5 LPA</div></div>
                <div class="pth"><div class="pth-co">Wipro</div><div class="pth-role">D₹3.5 LPA</div></div>
                <div class="pth"><div class="pth-co">Accenture</div><div class="pth-role">₹4.5 LPA</div></div>
              </div>
        </div>
      </div>
      </section>


                 <!--Addon section -->
    <section class="Addsection setails">
        <div class="container">
            <img src="images/add.gif" alt="View All Universities">
        </div>
    </section>
 <!-- End Addon section -->

      <!--  CAMPUS  -->
      <section class="sec alt" id="sec-campus">
        <div class="W">
          <div class="sh rv">
            <p class="section-btn">Campus &amp; Facilities</p>
            <div class="sh-h">200-Acre <em>World-Class Campus</em></div>
            <div class="sh-sub">Modern infrastructure with 50+ buildings</div>
          </div>

          <div class="gallery-wrap rv">
            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class1.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Academic campus</div><div class="ci-desc">50+ state-of-the-art buildings · Smart classrooms</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class2.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Central Library</div><div class="ci-desc">5 lakh+ books, 15,000+ e-journals, JSTOR & Springer access. Air-conditioned 24×7 reading halls.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class3.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Research Labs</div><div class="ci-desc">500+ advanced labs with IBM, Cisco & Intel certified infrastructure. AI/ML, IoT, Robotics & Biotech centres.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class4.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Auditorium</div><div class="ci-desc">5,000-seat air-conditioned auditorium hosting national tech fests, cultural events & convocations.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class5.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Sports Complex</div><div class="ci-desc">Olympic-size swimming pool, cricket stadium, football ground, basketball, badminton & 20+ other sports.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class6.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">University Hospital</div><div class="ci-desc">On-campus 200-bed hospital with 24×7 emergency, OPD, dental, physiotherapy & pharmacy services.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class7.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">GYM</div><div class="ci-desc">State-of-the-art gym, yoga hall, aerobics studio and wellness centre open 6 AM – 10 PM daily.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class8.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Multi-Cuisine Food Court</div><div class="ci-desc">20+ food outlets with North Indian, South Indian, Chinese, Continental and fast food. Open 7 AM – 11 PM.</div></div>
              </div>
            </div>

            <div class="gallery-hero">
              <div class="camp-photo">
                <img src="images/Campass-class9.png" alt="Main Campus Building" loading="lazy">
                <div class="camp-ov"></div>
                <div class="camp-info"><div class="ci-name">Smart Classrooms</div><div class="ci-desc">800+ smart classrooms with interactive panels, high-speed internet, projectors and ergonomic seating.</div></div>
              </div>
            </div>

          </div>

          <!-- Gallery lightbox -->
          <div class="gallery-lb" id="galleryLB" onclick="closeGallery()">
            <div class="lb-inner" onclick="event.stopPropagation()">
              <button class="lb-close" onclick="closeGallery()">✕</button>
              <div class="lb-title">Campus Photo Gallery</div>
              <div class="lb-grid">
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1562774053-701939374585?w=600&q=80" alt="Main Campus" loading="lazy"><span>Main Academic Block</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=600&q=80" alt="Sports" loading="lazy"><span>Sports Complex</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=600&q=80" alt="Library" loading="lazy"><span>Central Library</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1519452575417-564c1401ecc0?w=600&q=80" alt="Auditorium" loading="lazy"><span>Grand Auditorium</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=600&q=80" alt="Hospital" loading="lazy"><span>University Hospital</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&q=80" alt="Labs" loading="lazy"><span>Research Labs</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=600&q=80" alt="Cafeteria" loading="lazy"><span>Food Court</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=600&q=80" alt="Gym" loading="lazy"><span>Modern Gymnasium</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=600&q=80" alt="Lecture Hall" loading="lazy"><span>Smart Lecture Hall</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=600&q=80" alt="Plaza" loading="lazy"><span>Open Air Plaza</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1624600787006-cce97b1a7c40?w=600&q=80" alt="Cricket" loading="lazy"><span>Cricket Stadium</span></div>
                <div class="lb-item"><img src="https://images.unsplash.com/photo-1593062096033-9a26b09da705?w=600&q=80" alt="Hostel" loading="lazy"><span>Hostel Blocks</span></div>
              </div>
            </div>
          </div>

        </div>
      </section>

      <!--  HOSTEL & FOOD  -->
      <section class="sec" id="sec-hostel">
        <div class="W">
        <div class="bg-colr">
          <div class="sh rv">
            <p class="section-btn">Hostel & Campus Life</p>
            <div class="sh-h">Student Living</div>
            <div class="sh-sub">Modern Infrastructure With 50separate Boys And Girls Hostels With Ac/non-ac Options, 
                  24×7 Security, Wifi And Quality Food+ Buildings</div>
          </div>
          <div class="hostel-grid">
            <div class="hostel-photos">
              <div class="hp wide rv d1"><img src="images/student-living.png" alt="Hostel" loading="lazy"><div class="hp-lbl">Boys Hostel Block</div>
            <div class="card hi rv d1">
                <p class="section-btn">Key facts</p>
                <div class="feats">
                  <span class="feat">AC &amp; Non-AC rooms available</span>
                  <span class="feat">1 Gbps campus-wide WiFi</span>
                  <span class="feat">24×7 CCTV surveillance</span>
                  <span class="feat">In-house mess + canteen</span>
                  <span class="feat">Laundry facility available</span>
                  <span class="feat">Common room, TV &amp; indoor games</span>
                </div>
              </div>

              <div class="card hi rv d3">
                <div class="hi-t" style="margin-bottom:11px">Room Types Available</div>
                <div class="rooms">
                  <div class="room"><div class="room-icon">🛏️</div><div class="room-n">Single</div><div class="room-d">AC · Attached bath</div></div>
                  <div class="room"><div class="room-icon">🛏️🛏️</div><div class="room-n">Double</div><div class="room-d">Shared · Fan/AC</div></div>
                  <div class="room"><div class="room-icon">🏘️</div><div class="room-n">Triple</div><div class="room-d">Budget · Non-AC</div></div>
                </div>
              </div>
            
            </div>
              <div class="hp rv d2"><img src="images/student-living2.png" alt="Room" loading="lazy"><div class="hp-lbl">Single AC Room</div>
            
                          <div class="card hi rv d2">
                <p class="section-btn">Key facts</p>
                <div class="feats">
                  <span class="feat">Fully air-conditioned rooms</span>
                  <span class="feat">Lady security guards 24×7</span>
                  <span class="feat">Separate secured access gate</span>
                  <span class="feat">Warden on every floor</span>
                  <span class="feat">Emergency helpline access</span>
                </div>
              </div>
              <div class="card hi rv d3">
                <div class="hi-t" style="margin-bottom:11px">Room Types Available</div>
                <div class="rooms">
                  <div class="room"><div class="room-icon">🛏️</div><div class="room-n">Single</div><div class="room-d">AC · Attached bath</div></div>
                  <div class="room"><div class="room-icon">🛏️🛏️</div><div class="room-n">Double</div><div class="room-d">Shared · Fan/AC</div></div>
                  <div class="room"><div class="room-icon">🏘️</div><div class="room-n">Triple</div><div class="room-d">Budget · Non-AC</div></div>
                </div>
              </div>
            </div>
            </div>

          </div>
        </div></div>
      </section>



      <!--  SCHOLARSHIPS  -->
      <section class="sec" id="sec-scholarships">
        <div class="W">
        <div class="bg-colr">
          <div class="sh rv">
            <p class="section-btn">scholarships</p>
            <div class="sh-h">Don’t Let Fees Stop Your Dream</div>
            <div class="sh-sub">Merit Scholarships, Category Concessions, And Easy Education Loans From Leading Banks</div>
          </div>
          <div class="schol-grid">
            <div class="sch rv d1"><div><div class="sch-t">CUCET Merit Scholarship</div><div class="sch-d">Auto-computed based on CUCET score. 95+ percentile = 100% tuition waiver. Renewable each semester if CGPA ≥ 7.5.</div></div></div>
            <div class="sch rv d2"><div><div class="sch-t">JEE Main / NEET Score Scholarship</div><div class="sch-d">Valid JEE/NEET scorers get automatic merit scholarship. Top JEE rankers get 100% fee waiver — applicable at admission only.</div></div></div>
            <div class="sch rv d3"><div><div class="sch-t">Sports & NCC Excellence</div><div class="sch-d">National / international sports achievers get 100% tuition waiver + dedicated training infrastructure. NCC A/B/C holders also eligible.</div></div></div>
            <div class="sch rv d4"><div><div class="sch-t">SC / ST / OBC Concessions</div><div class="sch-d">Government post-matric scholarships applicable. CU additionally provides fee concessions over and above state govt schemes.</div></div></div>
          </div>

        </div></div>
      </section>

            <!--  SCHOLARSHIPS  -->
      <section class="sec" id="sec-loan-partners">
         <div class="W">
        <div class="bg-colr">

                    <div class="sh rv">
            <p class="section-btn">Funds</p>
            <div class="sh-h">Education loan Partners</div>
            <div class="sh-sub">Apply directly through CU's empanelled banks — faster processing, pre-approved limits, no collateral up to ₹7.5l</div>
          </div>

          <!-- Education Loan Partners -->
          <div class="loan-section rv" style="margin-bottom:28px">
            <div class="loan-grid">
              <a class="loan-card" href="#" onclick="return false" title="SBI Student Loan Scheme"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#22409a"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="13" font-weight="900" fill="#fff" text-anchor="middle">SBI</text></svg></div><div class="loan-info"><div class="loan-name">State Bank of India</div><div class="loan-rate">8.55% p.a. · Up to ₹30L</div><div class="loan-tag">No Collateral up to ₹7.5L</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="PNB Saraswati Loan"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#ff6600"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="12" font-weight="900" fill="#fff" text-anchor="middle">PNB</text></svg></div><div class="loan-info"><div class="loan-name">Punjab National Bank</div><div class="loan-rate">8.75% p.a. · Up to ₹20L</div><div class="loan-tag">Saraswati Education Loan</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="Canara Vidya Turant"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#006bb6"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="9.5" font-weight="900" fill="#fff" text-anchor="middle">CANARA</text></svg></div><div class="loan-info"><div class="loan-name">Canara Bank</div><div class="loan-rate">8.90% p.a. · Up to ₹25L</div><div class="loan-tag">Vidya Turant Scheme</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="HDFC Credila Education Loan"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#004C8F"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="10" font-weight="900" fill="#fff" text-anchor="middle">HDFC</text></svg></div><div class="loan-info"><div class="loan-name">HDFC Credila</div><div class="loan-rate">10.50% p.a. · Up to ₹1Cr</div><div class="loan-tag">Fastest Disbursement</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="Axis Bank Education Loan"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#820024"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="10" font-weight="900" fill="#fff" text-anchor="middle">AXIS</text></svg></div><div class="loan-info"><div class="loan-name">Axis Bank</div><div class="loan-rate">11.00% p.a. · Up to ₹75L</div><div class="loan-tag">15-Year Repayment Option</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="BoB Baroda Gyan"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#f47920"/><text x="36" y="14" font-family="Arial,sans-serif" font-size="8" font-weight="900" fill="#fff" text-anchor="middle">BANK OF</text><text x="36" y="23" font-family="Arial,sans-serif" font-size="8" font-weight="900" fill="#fff" text-anchor="middle">BARODA</text></svg></div><div class="loan-info"><div class="loan-name">Bank of Baroda</div><div class="loan-rate">8.85% p.a. · Up to ₹80L</div><div class="loan-tag">Baroda Gyan Scheme</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="IDBI Education Loan"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#003d7a"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="11" font-weight="900" fill="#fff" text-anchor="middle">IDBI</text></svg></div><div class="loan-info"><div class="loan-name">IDBI Bank</div><div class="loan-rate">9.20% p.a. · Up to ₹20L</div><div class="loan-tag">Vidya Lakshmi Portal</div></div><div class="loan-arrow">→</div></a>
              <a class="loan-card" href="#" onclick="return false" title="Avanse Financial Services"><div class="loan-logo"><svg width="72" height="28" viewBox="0 0 72 28" xmlns="http://www.w3.org/2000/svg"><rect width="72" height="28" rx="4" fill="#00a651"/><text x="36" y="19" font-family="Arial,sans-serif" font-size="9" font-weight="900" fill="#fff" text-anchor="middle">AVANSE</text></svg></div><div class="loan-info"><div class="loan-name">Avanse Financial</div><div class="loan-rate">11.5% p.a. · Up to ₹60L</div><div class="loan-tag">NBFC — Fast Approval</div></div><div class="loan-arrow">→</div></a>
            </div>
            <div class="loan-note">Note: Interest rates are indicative as of 2025 and subject to change. CU's Financial Aid cell assists with documentation, bank liaison and disbursal tracking — contact them atfinancialaid@cuchd.in</strong></div>
          </div>

        </div></div>
      </section>


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