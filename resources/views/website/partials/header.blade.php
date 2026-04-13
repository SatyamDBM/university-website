 <header class="header">
        <marquee class="top-bar">
            <span class="welcome-text">  <img src="images/unversity.png" alt="unversity"> Welcome to Topuniversitiesinindia.Com</span>
        </marquee>    
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                   <a href="{{route('home')}}"><img src="{{ asset('images/logo.png') }}" alt="TUI Logo"></a>
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
            <a href="{{route('home')}}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
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
            <a href="{{route('blog')}}" class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
        </nav>
                <div class="auth-buttons">
                    <button class="btn-login" onclick="openLoginModal()">Universiy Login</button>
                    <button class="btn-signup" onclick="openEnquiryModal()">Enquire Now</button>
                </div>
            </div>
    </header>