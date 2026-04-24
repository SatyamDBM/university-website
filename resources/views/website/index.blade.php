@extends('layouts.website')

@section('title', 'Top Universities in India - Find Your Dream University')

@section('body-class', 'home-page')

@section('content')

    {{-- ========== BANNER / HERO SECTION ========== --}}
    <section class="hero">
        <div class="hero-banner">
            <img src="{{ asset('images/banner.png') }}" alt="Background Image" class="bg-image">
        </div>

        <div class="middleware">
            <div class="hero-content">

                {{-- Left Content --}}
                <div class="left portion">
                    <p class="hero-subtitle">
                        <img src="{{ asset('images/unversity.png') }}" alt="university">
                        India's #1 University Discovery Platform
                    </p>
                    <h1 class="hero-title">Find Your Dream<br>University</h1>
                    <p class="hero-description">
                        Explore 5,000+ universities and colleges across India.
                        Compare courses, fees, and placements — all in one place.
                    </p>

                    {{-- Stats --}}
                   <div class="stats">
                    <div class="stat-item">
                        <img src="{{ asset('images/Universities.png') }}" alt="Universities">
                        <div>
                            <h3>
                                {{ $universityCount > 100 ? number_format($universityCount).'+' : $universityCount }}
                            </h3>
                            <p>Universities</p>
                        </div>
                    </div>

                    <div class="stat-item">
                        <img src="{{ asset('images/Courses.png') }}" alt="Courses">
                        <div>
                            <h3>
                                {{ $courseCount > 100 ? number_format($courseCount).'+' : $courseCount }}
                            </h3>
                            <p>Courses</p>
                        </div>
                    </div>

                    <div class="stat-item">
                        <img src="{{ asset('images/Students Helped.png') }}" alt="Students Helped">
                        <div>
                            <h3>
                                {{ $student_helped > 100 ? number_format($student_helped).'+' : $student_helped }}
                            </h3>
                            <p>Students Helped</p>
                        </div>
                    </div>
                </div>
                </div>

                {{-- Search Box --}}
                <div class="search-box">
                    <div class="search-content">
                        <h2 class="search-title">Search Universities</h2>
                        <form action="{{ url('/search') }}" method="GET">
                            <div class="search-field">
                                <label>Select Course</label>
                                <div class="input-wrapper">
                                    <i class="icon-cap">
                                        <img src="{{ asset('images/cap.png') }}" alt="Cap Icon">
                                    </i>
                                    <select name="course">
                                        <option value="">Choose a course</option>
                                        <option value="engineering">Engineering</option>
                                        <option value="medical">Medical</option>
                                        <option value="management">Management</option>
                                    </select>
                                </div>
                            </div>

                            <div class="search-field">
                                <label>Preferred Location</label>
                                <div class="input-wrapper">
                                    <i class="icon-cap">
                                        <img src="{{ asset('images/location.png') }}" alt="Location Icon">
                                    </i>
                                    <select name="location">
                                        <option value="">Select location</option>
                                        <option value="delhi">Delhi-NCR</option>
                                        <option value="mumbai">Mumbai</option>
                                        <option value="bangalore">Bangalore</option>
                                    </select>
                                </div>
                            </div>

                            <div class="search-field range-field">
                                <div class="range-header clearfix">
                                    <label class="left">
                                        <i class="icon-wallet">
                                            <img src="{{ asset('images/wallet.png') }}" alt="Wallet Icon">
                                        </i>
                                        Budget (per year)
                                    </label>
                                    <span class="right budget-value">₹5.0L</span>
                                </div>
                                <input type="range" min="50000" max="2000000" step="50000" value="500000" class="budget-slider">
                                <div class="range-labels clearfix">
                                    <span class="left">₹50K</span>
                                    <span class="right">₹20L</span>
                                </div>
                            </div>

                            <button type="submit" class="btn-search">
                                <i class="icon-search"></i> Search Universities
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- ========== END BANNER SECTION ========== --}}


    {{-- ========== POPULAR STREAMS ========== --}}
    {{-- <section class="popular-streams">
        <div class="container">
            <p class="section-btn">Browse By Category</p>
            <h2 class="section-title">Explore Popular Streams</h2>
            <p class="section-subtitle">Discover the right stream for your future - from engineering to arts and beyond</p>

            <div class="streams-grid">
                <div class="stream-card">
                    <h3>Engineering</h3>
                    <p>325+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Medical</h3>
                    <p>180+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Management</h3>
                    <p>450+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Law</h3>
                    <p>120+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Arts & Design</h3>
                    <p>280+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Science</h3>
                    <p>340+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Commerce</h3>
                    <p>390+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="stream-card">
                    <h3>Pharmacy</h3>
                    <p>150+ Universities</p>
                    <a href="{{ url('course-detail') }}" class="stream-link">Explore <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section> --}}
        <section class="popular-streams">
        <div class="container">
            <p class="section-btn">Browse By Category</p>
            <h2 class="section-title">Explore Popular Streams</h2>
            <p class="section-subtitle">
                Discover the right stream for your future - from engineering to arts and beyond
            </p>

            <div class="streams-grid">

                @foreach($categories as $category)
                    <div class="stream-card">
                        <h3>{{ $category->name }}</h3>

                        <p>
                            {{ $category->university_count > 100 
                                ? number_format($category->university_count).'+' 
                                : $category->university_count }}
                            Universities
                        </p>

                        <a href="{{ url('course-detail/'.$category->id) }}" class="stream-link">
                            Explore <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    {{-- ========== END POPULAR STREAMS ========== --}}


    {{-- ========== FEATURED UNIVERSITIES ========== --}}
    <section class="featured-universities">
        <div class="container">
            <div class="section-header">
                <div class="sec-header">
                    <p class="section-btn">Top Universities</p>
                    <h2 class="section-title">Featured Universities</h2>
                    <p class="section-subtitle">Hand-picked top universities trusted by millions of students</p>
                </div>
                <a href="{{ url('universities') }}" class="btn-view-all">View All Universities</a>
            </div>

            <div class="universities-grid">
                {{-- University Card 1 --}}

                {{-- <div class="university-card">
                    <div class="card-badge">NIRF #1</div>
                    <img src="{{ asset('images/featue1.png') }}" alt="IIT Delhi" class="university-image">
                    <div class="university-info">
                        <h3>Indian Institute of Technology, Delhi</h3>
                        <p><i class="fas fa-map-marker-alt"></i> New Delhi, India</p>
                        <div class="equal">
                            <p><i class="fas fa-star"></i> 4.8 (122)</p>
                            <p>
                                <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.70833 9.51109L14.25 9.47388V1.58334L10.1571 1.58888L8.721 3.02496L8.70833 9.51109ZM7.125 3.02496L5.68337 1.61975L1.58333 1.59204V9.47388L7.125 9.51109V3.02496ZM6.33333 0.0403769L7.91667 1.58967L9.5 0.00633504L14.2476 1.78409e-06C14.4556 -0.000310339 14.6615 0.0403346 14.8537 0.119616C15.0459 0.198898 15.2207 0.315264 15.3679 0.462069C15.5152 0.608875 15.632 0.783246 15.7119 0.975225C15.7918 1.1672 15.833 1.37303 15.8333 1.58096V9.47388C15.8333 9.89189 15.6681 10.2929 15.3735 10.5896C15.079 10.8862 14.6791 11.0543 14.2611 11.0572L9.5 11.0897L7.91983 12.673L6.33333 11.0897L1.57225 11.0572C1.15425 11.0543 0.754362 10.8862 0.459822 10.5896C0.165282 10.2929 -1.0241e-05 9.89189 4.75887e-10 9.47388V1.59204C4.75887e-10 1.17212 0.166815 0.76939 0.463748 0.472458C0.76068 0.175525 1.16341 0.00870986 1.58333 0.00870986L6.33333 0.0403769Z" fill="#3E4095"/></svg>
                                30 Courses
                            </p>
                        </div>
                        <div class="card-actions">
                            <button class="btn-explore" onclick="openEnquiryModal()">Enquire Now</button>
                            <a href="{{ url('university-details') }}" class="btn-apply">View</a>
                        </div>
                    </div>
                </div> --}}

                    @foreach($featuredUniversities as $item)
                        @php $uni = $item->university; @endphp

                        <div class="university-card">
                            <div class="card-badge">
                                Featured
                            </div>

                            <img 
                                src="{{ $uni->image ? asset('storage/'.$uni->image) : asset('images/featue1.png') }}" 
                                class="university-image"
                            >

                            <div class="university-info">
                                <h3>{{ $uni->name  ?? 'Indian Institute of Technology, Delhi' }}</h3>

                                <p>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $uni->city ?? 'New Delhi, India' }}, {{ $uni->state ?? 'National Capital Territory of Delhi' }}
                                </p>

                                <div class="equal">
                                    <p>
                                        <i class="fas fa-star"></i> 
                                        {{ $uni->rating ?? '4.5' }}
                                    </p>

                                    <p>
                                        {{ $uni->courses_count ?? '0' }} Courses
                                    </p>
                                </div>

                                <div class="card-actions">
                                    <button class="btn-explore" onclick="openEnquiryModal()">
                                        Enquire Now
                                    </button>

                                    <a href="{{ url('university-details/'.$uni->id) }}" class="btn-apply">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            
        </div>
    </section>
    {{-- ========== END FEATURED UNIVERSITIES ========== --}}


    {{-- ========== ADDON SECTION ========== --}}
    <section class="Addsection">
        <div class="container">
            <img src="{{ asset('images/addon.png') }}" alt="View All Universities">
        </div>
    </section>
    {{-- ========== END ADDON SECTION ========== --}}


    {{-- ========== POPULAR COURSES ========== --}}
    <section class="popular-courses">
        <div class="container">
            <p class="section-btn">Top Courses</p>
            <h2 class="section-title">Popular Courses</h2>
            <p class="section-subtitle">Hand-picked top courses trusted by millions of students</p>

            <div class="course-filters">
            <button class="filter-btn active" onclick="filterCourses('')">All</button>
            <button class="filter-btn" onclick="filterCourses('Bachelors')">Bachelors</button>
            <button class="filter-btn" onclick="filterCourses('Masters')">Masters</button>
            <button class="filter-btn" onclick="filterCourses('Doctorate')">Doctorate</button>
            <button class="filter-btn" onclick="filterCourses('Certification')">Certification</button>
            </div>

            <div class="courses-grid" id="coursesGrid">
                {{-- <div class="course-card">
                    <p class="Timer">Full Time</p>
                    <h4>B.Com General</h4>
                    <div class="course-stats">
                        <p>Duration</p><p class="right">3 YEARS</p>
                    </div>
                    <div class="course-stats">
                        <p>Total Avg. Fees</p><p class="right">80.00 k</p>
                    </div>
                    <div class="course-stats">
                        <p>Universities</p><p class="right">500+</p>
                    </div>
                    <a href="{{ url('course-detail') }}" class="course-link">Course Overview <i class="fas fa-arrow-right"></i></a>
                </div> --}}
                @foreach($courseData as $course)

                <div class="course-card">
                    <p class="Timer">{{ $course->type ?? 'Full Time' }}</p>

                    <h4>{{ $course->course_name }}</h4>

                    <div class="course-stats">
                        <p>Duration</p>
                        <p class="right">{{ $course->duration }}</p>
                    </div>

                    <div class="course-stats">
                        <p>Total Avg. Fees</p>
                        <p class="right">{{ $course->fees }}</p>
                    </div>

                    <div class="course-stats">
                        <p>Universities</p>
                        <p class="right">
                            {{ $course->university_count > 100 
                                ? $course->university_count.'+' 
                                : $course->university_count }}
                        </p>
                    </div>

                    <a href="{{ url('courses-details/'.$course->course_name) }}" class="course-link">
                        Course Overview →
                    </a>
                </div>
             @endforeach
            </div>
        </div>
    </section>
    {{-- ========== END POPULAR COURSES ========== --}}


    {{-- ========== UNIVERSITY RANKING ========== --}}
    <section class="university-ranking">
        <div class="container">
            <p class="section-btn">Ranking</p>
            <h2 class="section-title">University Ranking</h2>
            <p class="section-subtitle">Ranking Details Of Universities</p>

            <div class="ranking-filters">
                <button class="filter-btn active">Ranking: 2026</button>
                <button class="filter-btn">Indiatoday</button>
                <button class="filter-btn">NIRF</button>
                <button class="filter-btn">IIRF</button>
            </div>

            <div class="ranking-table">
                <table>
                    <thead>
                        <tr>
                            <th>UNIVERSITIES</th>
                            <th>RANKING</th>
                            <th>STREAMS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SRM Institute Of Science And Technology - Chennai</td>
                            <td>1 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                        <tr>
                            <td>Netaji Subhas University Of Technology</td>
                            <td>2 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                        <tr>
                            <td>Manipal Institute Of Technology - [MIT], Manipal</td>
                            <td>3 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                        <tr>
                            <td>Babu Banarasi Das Technical University [BBD] Lucknow</td>
                            <td>4 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                        <tr>
                            <td>Integral University [IUL], Lucknow</td>
                            <td>5 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                        <tr>
                            <td>Amity University, Lucknow</td>
                            <td>6 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                        <tr>
                            <td>Ramswaroop University, Lucknow</td>
                            <td>7 out of 200</td>
                            <td>Engineering</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- ========== END UNIVERSITY RANKING ========== --}}


    {{-- ========== TOP STUDY PLACES ========== --}}
    <section class="top-study-places">
        <div class="container">
            <p class="section-btn">Places</p>
            <h2 class="section-title">Top Study Places</h2>
            <p class="section-subtitle">Choose Your Study Destination</p>

            <div class="places-grid">
                <div class="place-card">
                    <h3>Lucknow</h3>
                    <p>150+ Universities</p>
                </div>
                <div class="place-card">
                    <h3>Delhi-NCR</h3>
                    <p>150+ Universities</p>
                </div>
                <div class="place-card">
                    <h3>Mumbai</h3>
                    <p>150+ Universities</p>
                </div>
                <div class="place-card">
                    <h3>Pune</h3>
                    <p>150+ Universities</p>
                </div>
            </div>
        </div>
    </section>
    {{-- ========== END TOP STUDY PLACES ========== --}}
@endsection
