<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Detail</title>
    <link type="image/x-icon" rel="shortcut icon" href="images/fevicon.png"/>
    <link type="text/css" rel="stylesheet" href="css/main.css" />
     <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/responsive.css" />
    <script type="text/javascript" src="js/custom.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: {
       sans: ['Lato', 'sans-serif'],
        serif: ['Roboto Slab', 'Georgia', 'serif'],
      },
      colors: {
        brand: {
          50: '#f0f7ff', 100: '#e0effe', 200: '#baddfd', 300: '#7dc3fc',
          400: '#38a5f8', 500: '#c0813a', 600: '#026ac8', 700: '#0355a2',
          800: '#074885', 900: '#0c3d6f', 950: '#082648',
        },
      }
    }
  }
}
</script>

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

<style>
  :root {
    --brand: #c0813a;
    --brand-dark: #0355a2;
    --gold: #5c3d2ec7;
    --dark: #25213B;
    --dark2: #0f2040;
    --dark3: #775042;
    --dark4: #1E1208;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body { font-family: 'Lato', sans-serif; background: #fff; color: #1a2332; overflow-x: hidden; }
  .max-w-screen-xl { max-width: 1500px !important; }

  /* SCROLL PROGRESS */
  #progress { position: fixed; top: 0; left: 0; height: 3px; z-index: 9999; background: linear-gradient(90deg, #c0813a, #5c3d2ec7); width: 0; transition: width .1s; pointer-events: none; }

  /* NAVBAR */
  .navbar { position: static; top: 0; left: 0; right: 0; z-index: 900; transition: all .3s; }
  .navbar.scrolled { background: rgba(10, 22, 40, 0.97); backdrop-filter: blur(20px); box-shadow: 0 4px 30px rgba(0,0,0,.3); }

  /* ANNOUNCEMENT BAR */
  .ann-bar { background: linear-gradient(90deg, var(--brand), #0e5bbf, var(--brand)); background-size: 200%; animation: gradShift 4s linear infinite; }
  @keyframes gradShift { 0% { background-position: 0%; } 100% { background-position: 200%; } }

  /* HERO */
  .profile-hero {
    background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?w=1600&q=80&fit=crop');
    background-size: cover; background-position: center; background-repeat: no-repeat;
    position: relative;
  }
  .profile-hero::before {
    content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.75);
  }
.breadcrumb a {
    color: #fff;
    font-size: 14px;
}
.breadcrumb span {
    color: #fff;
    font-size: 14px;
    margin: 0 6px;
}
.breadcrumb a:hover {
    color: var(--brand);
}
  /* BADGES */
.nirf-chip {
    background: rgba(192,129,58,0.15);
    border: 1px solid rgb(255 255 255 / 40%);
    color: #ffffff;
    font-family: 'Lato', monospace;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 100px;
}
  .naac-chip { background: #775042; color: #fff; font-size: 11px; padding: 4px 12px; border-radius: 100px; font-weight: 600; }
.approved-chip {
    background: rgba(34,197,94,0.15);
    border: 1px solid rgb(255 255 255 / 40%);
    color: #ffffff;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 100px;
}  
.institute-chip {
    background: rgba(99,102,241,0.15);
    border: 1px solid rgb(255 255 255 / 40%);
    color: #ffffff;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 100px;
}
  /* STAT STRIP */
  .stat-item { text-align: center; padding: 14px 18px; }
  .stat-item + .stat-item { border-left: 1px solid rgba(255,255,255,0.1); }
.stat-strip.flex.flex-wrap {
    gap: 10px;
}
  /* STICKY NAV */
  .sticky-nav { position: sticky; top: 0; z-index: 100; background: #fff; border-bottom: 1.5px solid #e8edf5; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
  .sticky-nav a { font-size: 13px; font-weight: 600; color: #666; padding: 14px 16px; display: block; border-bottom: 2.5px solid transparent; transition: all .2s; white-space: nowrap; }
  .sticky-nav a:hover, .sticky-nav a.active { color: var(--brand); border-bottom-color: var(--brand); }

  /* SECTION HEADER */
  .sec-eye { font-family: 'Lato', monospace; font-size: 11px; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; color: var(--brand); display: inline-flex; align-items: center; gap: 8px; margin-bottom: 6px; }
  .sec-eye::before { content: ''; width: 20px; height: 2px; background: linear-gradient(90deg, var(--brand), var(--gold)); border-radius: 2px; display: inline-block; }
  .sec-h { font-family: 'Roboto Slab', Georgia, serif; font-size: clamp(22px, 2.5vw, 32px); color: #25213B; line-height: 1.15; letter-spacing: -.3px; }
  .sec-h em { font-style: italic; color: var(--brand); }

  /* CARDS */
  .info-card { background: #fff; border: 1.5px solid #e8edf5; border-radius: 16px; padding: 20px; }
  .highlight-card { background: linear-gradient(145deg, #3e2518, #5c3d2e, #7a5244); border-radius: 16px; padding: 22px; color: #fff; }

  /* TABLE */
  .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
  .data-table th { background: #775042; color: #fff; padding: 16px 16px; text-align: left; font-weight: 700; font-size: 14px; font-family: 'Lato', monospace; letter-spacing: .5px; }
  .data-table td { padding: 11px 16px; border-bottom: 1px solid #f0f4f8; color: #444; }
  .data-table tr:last-child td { border-bottom: none; }
  .data-table tr:hover td { background: #fdf8f6; }


  /* TAB PILLS */
  .tab-pill { padding: 7px 16px; border-radius: 100px; font-size: 12px; font-weight: 700; cursor: pointer; border: 1.5px solid #e8edf5; background: #fff; color: #666; transition: all .2s; font-family: 'JetBrains Mono', monospace; }
  .tab-pill.active, .tab-pill:hover { background: var(--brand); color: #fff; border-color: var(--brand); }

  /* SIDEBAR CARD */
  .sidebar-card { background: #fff; border: 1.5px solid #e8edf5; border-radius: 18px; overflow: hidden; }
  .fee-box { background: linear-gradient(145deg, #3e2518, #5c3d2e, #7a5244); border-radius: 14px; padding: 22px; text-align: center; }

  /* RECRUITER ROW */
  .recruiter-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 14px; background: #f9fafb; border-radius: 12px; margin-bottom: 8px; transition: all .2s; }
  .recruiter-row:hover { background: #fdf8f6; }

  /* RANK FLOATING CHIP */
  .rank-chip { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 12px 16px; text-align: center; backdrop-filter: blur(10px); }

  /* COURSE TAGS */
  .course-tag { background: rgba(192,129,58,0.1); color: #c0813a; font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 100px; border: 1px solid rgba(192,129,58,0.25); }
  .tag-core { background: #FFE9B7; color: #D16900; }
  .tag-spec { background: #FFE9B7; color: #D16900; }
  .tag-skill { background: #FFE9B7; color: #D16900; }
  .tag-elec { background: #FFE9B7; color: #D16900; }

  /* MOBILE MENU */
  #mobileMenu { display: none; }
  #mobileMenu.open { display: block; }

  /* CTA BAND */
  .cta-band { background: linear-gradient(135deg, #211609 0%, #25190d 40%, #251910 70%, #201508 100%); position: relative; overflow: hidden; }
  .cta-band::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(14,135,234,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(14,135,234,.06) 1px, transparent 1px); background-size: 36px 36px; }

  /* FOOTER */
  .footer { background: #000; }

  /* ANIMATIONS */
  @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-8px); } }
  .animate-float { animation: float 5s ease-in-out infinite; }
  .rv {  transform: translateY(20px); transition: opacity .55s ease, transform .55s ease; }
  .rv.in { opacity: 1; transform: none; }
  .d1 { transition-delay: .08s; } .d2 { transition-delay: .16s; } .d3 { transition-delay: .24s; } .d4 { transition-delay: .32s; }

  /* Scrollbar */
  ::-webkit-scrollbar { width: 6px; } ::-webkit-scrollbar-track { background: #f0f4f8; } ::-webkit-scrollbar-thumb { background: var(--brand); border-radius: 3px; }

  /* ENQUIRY MODAL */
  .modal-overlay { position: fixed; inset: 0; z-index: 1000; display: flex; align-items: center; justify-content: center; padding: 20px; background: rgba(10,22,40,.88); backdrop-filter: blur(8px); }

  @media (max-width: 768px) {
    .hide-mobile { display: none !important; }
  }
</style>
</head>
<body class="property-detail-page">

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



<!-- MAIN CONTENT -->
<div class="max-w-screen-xl mx-auto px-5 py-10">
  <div class="flex flex-col lg:flex-row gap-8">

    <!-- LEFT MAIN -->
    <div class="flex-1 min-w-0">

      <!-- OVERVIEW -->
      <section id="overview" class="mb-12 rv">
        <div class="flex items-center gap-3 mb-4">
          <span class="naac-chip">NAAC Accredited</span>
          <span class="naac-chip">Undergraduate</span>
        </div>
        <h2 class="font-serif text-3xl font-bold text-[#25213B] mb-1">BE Computer Science &amp; Engineering</h2>
        <p class="text-gray-500  leading-relaxed mb-6">A globally recognized program focusing on ai, cloud computing, and software engineering with industry-aligned curriculum.</p>

        <!-- COURSE OVERVIEW CARD -->
        <div class="info-card mb-6">
          <div class="flex items-center gap-2 mb-4">
            <div class="w-1 h-5 rounded-full" style="background: var(--brand);"></div>
            <h3 class="font-bold text-3xl text-[#25213B]">Course Overview</h3>
          </div>
          <p class="">The Bachelor Of Engineering In Computer Science &amp; Engineering At Chandigarh University Offers A Unique Fusion Of Fundamental Concepts And Specialized Specializations. Students Can Hands-On Experience In High-Tech Labs And Work On Real-World Projects Mentored By Industry Experts From Google, Microsoft, And IITs.</p>

          <div class="grid grid-cols-2 md:grid-cols-3 gap-3" style="margin-top: 30px;">
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
              <div class="text-xs text-gray-400 font-mono uppercase tracking-wider mb-1">Duration</div>
              <div class="font-bold  text-[#25213B]">4 Years (8 Semesters)</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
              <div class="text-xs text-gray-400 font-mono uppercase tracking-wider mb-1">Eligibility</div>
              <div class="font-bold  text-[#25213B]">10+2 with 60% (PCM)</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
              <div class="text-xs text-gray-400 font-mono uppercase tracking-wider mb-1">Avg. Package</div>
              <div class="font-bold  text-[#c0813a]">₹7.35L</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
              <div class="text-xs text-gray-400 font-mono uppercase tracking-wider mb-1">Intake</div>
              <div class="font-bold  text-[#25213B]">July 2026</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
              <div class="text-xs text-gray-400 font-mono uppercase tracking-wider mb-1">JEAS Group/CAP</div>
              <div class="font-bold  text-[#25213B]">62</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
              <div class="text-xs text-gray-400 font-mono uppercase tracking-wider mb-1">Mode of Course</div>
              <div class="font-bold  text-[#25213B]">Full Time</div>
            </div>
          </div>
        </div>

        <!-- CURRICULUM HIGHLIGHTS -->
        <div class="info-card">
          <div class="flex items-center gap-2 mb-4">
            <div class="w-1 h-5 rounded-full" style="background: var(--brand);"></div>
            <h3 class="font-bold text-3xl text-[#25213B]">Curriculum Highlights</h3>
          </div>
          <div class="flex flex-col gap-2">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
              <span class="">Data Structure &amp; Algorithms</span>
              <span class="text-xs font-700 px-3 py-1 rounded-full tag-core">Core</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
              <span class="">Artificial Intelligence &amp; Machine Learning</span>
              <span class="text-xs font-700 px-3 py-1 rounded-full tag-spec">Specialization</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
              <span class="">Full Stack Web Development</span>
              <span class="text-xs font-700 px-3 py-1 rounded-full tag-skill">Skill Based</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
              <span class="">Cyber Security &amp; Forensics</span>
              <span class="text-xs font-700 px-3 py-1 rounded-full tag-elec">Elective</span>
            </div>
          </div>
        </div>
      </section>

      <!-- ADMISSION PROCESS -->
      <section id="admission" class="mb-12 rv d1 adminisson-detailing">
        <div class="flex items-center gap-2 mb-5">
          <div class="w-1 h-6 rounded-full" style="background: var(--brand);"></div>
          <h2 class="font-serif text-3xl font-bold text-[#25213B]">Admission Process</h2>
        </div>

        <!-- Counselling -->
        <div class="info-card mb-5">
          <h3 class="font-bold text-base text-[#25213B] mb-1">Counselling</h3>
          <p class=" text-gray-500 mb-4">Admission Is Through JoSAA Counselling Based On The Rank Obtained In JEE Advanced.</p>

          <!-- Tab Pills -->
          <div class="inline-flex gap-2 bg-gray-50 border border-gray-200 rounded-full p-1 mb-5">
            <span class="tab-pill active" onclick="switchDateTab(this,'all')">All</span>
            <span class="tab-pill" onclick="switchDateTab(this,'jeeadv')">JEE ADVANCED</span>
            <span class="tab-pill" onclick="switchDateTab(this,'jeemain')">JEE MAIN</span>
          </div>

          <div class="flex flex-col gap-2" id="datesList">
            <div class="flex gap-4 p-3 bg-gray-50 rounded-xl ">
              <span class="text-[#c0813a] font-700 font-mono flex-shrink-0 w-36">April 2 – 15, 2026</span>
              <span class="text-gray-600">JEE Main 2026 Exam Date Session 2</span>
            </div>
            <div class="flex gap-4 p-3 bg-gray-50 rounded-xl ">
              <span class="text-[#c0813a] font-700 font-mono flex-shrink-0 w-36">April 6 – May 2, 2026</span>
              <span class="text-gray-600">JEE Advanced 2026 Practice Test For Paper 1 And Paper 2 Release Date</span>
            </div>
            <div class="flex gap-4 p-3 bg-gray-50 rounded-xl ">
              <span class="text-[#c0813a] font-700 font-mono flex-shrink-0 w-36">April 21 – May 2, 2026</span>
              <span class="text-gray-600">JEE Advanced 2026 Registrations For Indian Nationals</span>
            </div>
          </div>
        </div>

        <!-- Cutoffs -->
        <div class="info-card mb-5">
          <h3 class="font-bold text-3xl text-[#25213B] mb-1">Cutoffs</h3>
          <p class=" text-gray-400 mb-4">B.Tech in computer science and engineering at IIT delhi</p>
          <p class=" text-gray-500 mb-3 font-600">JEE Advanced round-wise cutoff Rank: (General All India)</p>
          <div class="overflow-x-auto rounded-xl border border-gray-100">
            <table class="data-table">
              <thead>
                <tr>
                  <th>ROUND</th>
                  <th>2024</th>
                  <th>2025</th>
                  <th>2026</th>
                </tr>
              </thead>
              <tbody>
                <tr><td class="font-700">1</td><td>66</td><td>68</td><td>66</td></tr>
                <tr><td class="font-700">2</td><td>67</td><td>68</td><td>66</td></tr>
                <tr><td class="font-700">3</td><td>67</td><td>60</td><td>65</td></tr>
                <tr><td class="font-700">4</td><td>67</td><td>68</td><td>66</td></tr>
                <tr><td class="font-700">5</td><td>67</td><td>68</td><td>66</td></tr>
                <tr><td class="font-700">6</td><td>67</td><td>68</td><td>66</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Seats -->
        <div class="info-card">
          <h3 class="font-bold text-3xl text-[#25213B] mb-1">Seats</h3>
          <p class=" text-gray-400 mb-4">B.Tech in computer science and engineering at IIT delhi</p>
          <div class="overflow-x-auto rounded-xl border border-gray-100">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Break-Up by category</th>
                  <th>SEATS</th>
                </tr>
              </thead>
              <tbody>
                <tr><td class="font-600">OBC</td><td class="font-serif font-bold text-[#c0813a]">51</td></tr>
                <tr><td class="font-600">SC</td><td class="font-serif font-bold text-[#c0813a]">39</td></tr>
                <tr><td class="font-600">ST</td><td class="font-serif font-bold text-[#c0813a]">14</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- FAQ -->
      <section id="faq" class="mb-12 rv d2">
        <div class="flex items-center gap-2 mb-5">
          <div class="w-1 h-6 rounded-full" style="background: var(--brand);"></div>
          <h2 class="font-serif text-3xl font-bold text-[#25213B]">Frequently Asked Questions</h2>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>Q. What is the JEE Advanced cut off for B.Tech. In Computer Science and Engineering in IIT Bombay - Indian Institute of Technology?</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-a">For 2025, JEE Advanced cut off for General category candidates in All India quota for B.Tech. in Computer Science and Engineering in IIT Bombay - Indian Institute of Technology. For female candidates in general category under All India quota, 365 was the closing rank. B.Tech out of varies depending on the category, see full data above in the admission section.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>Q. Which is the best college for a B.Tech in Civil Engineering at IIT delhi or IIT Bombay?</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-a">IIT Delhi and IIT Bombay are both top-tier institutes for Civil Engineering. IIT Delhi ranks #3 in NIRF Engineering, while IIT Bombay ranks #2. Both have excellent faculty, research opportunities, and placement records. Your choice should depend on your JEE Advanced rank, preferred campus culture, and specialization interests.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>Q. Who is the top recruiting company during IIT Bombay B.Tech placement?</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-a">Top recruiters at IIT Bombay include Microsoft, Google, Goldman Sachs, McKinsey, and various international companies. Microsoft offered the highest package of ₹170 LPA in recent placements. Other prominent recruiters include Amazon, Flipkart, Uber, Boston Consulting Group, and Bain & Company.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>Q. What is the JEE Advanced cut off for B.Tech in Mechanical Engineering in IIT Bombay?</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-a">The JEE Advanced cutoff for B.Tech Mechanical Engineering at IIT Bombay typically falls around rank 1,200–1,800 (General category). Female candidates get additional relaxation under the supernumerary quota. Cutoffs vary year-to-year based on seat availability and number of applicants.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="toggleFaq(this)">
            <span>Q. What is the cutoff for B.Tech IIT Bombay - Indian Institute of Technology for other than general categories?</span>
            <span class="faq-icon">+</span>
          </div>
          <div class="faq-a">For OBC-NCL candidates, the cutoff is typically around 1.5x the general cutoff rank. SC category closing ranks are approximately 3-4x general ranks, while ST category closing ranks are around 5-6x general ranks. EWS category follows similar patterns to general category with slight relaxation.</div>
        </div>
      </section>

    </div>

    <!-- RIGHT SIDEBAR -->
    <div class="w-full lg:w-80 flex-shrink-0">

      <!-- FEE BOX -->
      <div class="sidebar-card mb-5 rv">
        <div class="fee-box mb-0">
          <div class="text-white/60 text-xs font-mono uppercase tracking-widest mb-2">Annual Tuition Fee Planned</div>
          <div class="font-serif text-4xl font-bold text-white mb-1">₹2,10,000</div>
          <div class="text-white/50 text-xs mt-1">Per Year · B.Tech CSE</div>
        </div>
        <div class="p-5 flex flex-col gap-3">
          <button onclick="openSignupModal()" class="w-full text-white font-700 py-3 rounded-xl  transition-all hover:brightness-110" style="background: var(--dark3);">
            📩 Enquire Now
          </button>
          <button class="w-full font-700 py-3 rounded-xl  border-2 border-[#775042] text-[#775042] hover:bg-[#775042] hover:text-white transition-all">
            📥 Download Brochure
          </button>
        </div>
      </div>

      <!-- TOP RECRUITERS -->
      <div class="sidebar-card mb-5 rv d1">
        <div class="px-5 pt-5 pb-3">
          <div class="font-bold  text-[#25213B] mb-4">Top Recruiters</div>
          <div class="recruiter-row">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xs font-black">G</span>
              <span class=" font-600">Google</span>
            </div>
            <span class="font-serif font-bold text-[#775042] ">₹40 LPA</span>
          </div>
          <div class="recruiter-row">
            <div class="flex items-center gap-3">
              <span class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center text-white text-xs font-black">A</span>
              <span class=" font-600">Amazon</span>
            </div>
            <span class="font-serif font-bold text-[#775042] ">₹40 LPA</span>
          </div>
        </div>
      </div>

      <!-- QUICK FACTS -->
      <div class="sidebar-card rv d2">
        <div class="px-5 py-5">
          <div class="font-bold  text-[#25213B] mb-4">Quick Facts</div>
          <div class="flex flex-col gap-3 ">
            <div class="flex justify-between"><span class="text-gray-400">Founded</span><span class="font-600 text-[#25213B]">1961</span></div>
            <div class="flex justify-between"><span class="text-gray-400">Type</span><span class="font-600 text-[#25213B]">Public (IIT)</span></div>
            <div class="flex justify-between"><span class="text-gray-400">Location</span><span class="font-600 text-[#25213B]">New Delhi</span></div>
            <div class="flex justify-between"><span class="text-gray-400">Affiliation</span><span class="font-600 text-[#25213B]">Autonomous (UGC)</span></div>
            <div class="flex justify-between"><span class="text-gray-400">Campus Area</span><span class="font-600 text-[#25213B]">320 Acres</span></div>
            <div class="flex justify-between"><span class="text-gray-400">Total Faculty</span><span class="font-600 text-[#25213B]">300+</span></div>
          </div>
        </div>
      </div>

                <div class="banner-add" style="margin-top: 40px;">
            <img src="images/manipal.png" alt="View All Universities">
        </div>
 <!-- End Addon section -->

    </div>
  </div>
</div>

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




<!-- TOAST -->
<div id="toast" class="fixed bottom-6 right-6 z-50 bg-green-600 text-white px-5 py-3.5 rounded-xl shadow-xl  font-600 flex items-center gap-2" style="display:none;">
  ✅ Enquiry submitted! We'll connect you shortly.
</div>

<!-- FLOATING CTA -->
<button onclick="openEnquiry('IIT Delhi')" class="fixed bottom-6 right-6 z-40 text-white  font-700 px-5 py-3.5 rounded-full shadow-2xl flex items-center gap-2 transition-all hover:brightness-110 hover:-translate-y-1" style="background: var(--dark3);">
  <span class="w-2 h-2 rounded-full bg-green-400" style="animation:pulseGlow 1.8s infinite"></span>
  Free Counselling
</button>

<script>
// SCROLL
window.addEventListener('scroll', () => {
  const pct = window.scrollY / (document.body.scrollHeight - innerHeight) * 100;
  document.getElementById('progress').style.width = pct + '%';
  const nav = document.getElementById('navbar');
  nav.classList.toggle('scrolled', window.scrollY > 60);
});

// MOBILE MENU
function toggleMenu() {
  document.getElementById('mobileMenu').classList.toggle('open');
}

// STICKY NAV ACTIVE
function setActive(el) {
  document.querySelectorAll('.sticky-nav a').forEach(a => a.classList.remove('active'));
  el.classList.add('active');
}

// DATE TABS
function switchDateTab(btn, id) {
  document.querySelectorAll('.tab-pill').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}

// ENQUIRY MODAL
function openEnquiry(uniName) {
  document.getElementById('enquiryUniName').textContent = '→ ' + uniName;
  document.getElementById('enquiryModal').style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeEnquiry() {
  document.getElementById('enquiryModal').style.display = 'none';
  document.body.style.overflow = '';
}
function submitEnquiry(e) {
  e.preventDefault();
  closeEnquiry();
  const toast = document.getElementById('toast');
  toast.style.display = 'flex';
  setTimeout(() => { toast.style.display = 'none'; }, 4000);
}

// REVEAL ON SCROLL
const rvObs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); rvObs.unobserve(e.target); }});
}, { threshold: .08 });
document.querySelectorAll('.rv').forEach(el => rvObs.observe(el));

// SCROLL SPY
const sections = document.querySelectorAll('section[id], div[id]');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(s => { if (window.scrollY >= s.offsetTop - 120) current = s.id; });
  document.querySelectorAll('.sticky-nav a').forEach(a => {
    a.classList.toggle('active', a.getAttribute('href') === '#' + current);
  });
});
</script>
</body>
</html>