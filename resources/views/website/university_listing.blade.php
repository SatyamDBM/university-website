@extends('layouts.website')

@section('title', 'University-listing - Top Universities in India')

@section('body-class', 'university-page')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
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
        }
      }
    }
  }
}
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
  body { font-family: 'Lato', sans-serif; overflow-x: hidden; }
  .max-w-screen-xl { max-width: 1500px !important; }

  /* ── SCROLL PROGRESS ── */
  #progress { position: fixed; top: 0; left: 0; height: 3px; z-index: 9999; background: linear-gradient(90deg, #c0813a, #5c3d2ec7); width: 0; transition: width .1s; pointer-events: none; }

  /* ── NAVBAR ── */
  .navbar { position: static; top: 0; left: 0; right: 0; z-index: 900; transition: all .3s; }
  .navbar.scrolled { background: rgba(10,22,40,0.97); backdrop-filter: blur(20px); box-shadow: 0 4px 30px rgba(0,0,0,.3); }

  /* ── HERO MINI ── */
  .hero-mini {
    background-image: url('https://images.unsplash.com/photo-1607237138185-eedd9c632b0b?w=1600&q=80&fit=crop');
    background-size: cover;
    background-position: center;
    position: relative;
  }
  .hero-mini::before {
    content: "";
    position: absolute;
    inset: 0;
    background: #000000c9;
  }
.course-portion strong {
    display: block;
    text-align: center;
    margin-top: 5px;
}

  /* ── ANNOUNCEMENT BAR ── */
  .ann-bar { background: linear-gradient(90deg, var(--brand), #0e5bbf, var(--brand)); background-size: 200%; animation: gradShift 4s linear infinite; }
  @keyframes gradShift { 0% { background-position: 0%; } 100% { background-position: 200%; } }

  /* ── SEARCH TAGS ── */
  .search-tag { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); border-radius: 100px; padding: 5px 14px; font-size: 12px; color: #fff; cursor: pointer; transition: all .2s; }
  .search-tag:hover, .search-tag.active { background: var(--brand); border-color: var(--brand); }

  /* ── BREADCRUMB ── */
  .breadcrumb a { color: #fff; font-size: 14px; }
  .breadcrumb a:hover { color: var(--brand); }
  .breadcrumb span { color: #fff; font-size: 14px; margin: 0 6px; }

  /* ── FILTER SIDEBAR ── */
  .filter-sidebar { background: #fff; border-radius: 16px; overflow: hidden; }
  .filter-section { border-bottom: 1px solid #f0f4f8; padding: 16px 18px; }
  .filter-section:last-child { border-bottom: none; }
.filter-section-title {
    font-size: 14px;
    font-weight: 700;
    color: #0E2A46;
    display: flex;
    align-items: center;
    justify-content: space-between;
    cursor: pointer;
    user-select: none;
    margin-bottom: 12px;
}
  .filter-section-title svg { transition: transform .25s; }
  .filter-section.collapsed .filter-section-title svg { transform: rotate(-90deg); }
  .filter-section.collapsed .filter-body { display: none; }
.filter-search {
    background: #fff;
    border: 1px solid #A9A9A9;
    padding: 10px;
    font-family: 'Lato', sans-serif;
    width: 100%;
    outline: none;
    color: #000;
    border-radius: 5px;
    font-size: 14px;
}
  .filter-search:focus { border-color: var(--brand); }
  .filter-checkbox { display: flex; align-items: center; gap: 8px; padding: 5px 0; cursor: pointer; }
  .filter-checkbox input[type="checkbox"] { accent-color: var(--brand); width: 14px; height: 14px; cursor: pointer; flex-shrink: 0; }
  .filter-checkbox label { font-size: 12.5px; color: #444; cursor: pointer; flex: 1; }
  .filter-range { width: 100%; accent-color: var(--brand); }
  .range-labels { display: flex; justify-content: space-between; font-size: 11px; color: #888; font-family: 'Lato', sans-serif; margin-top: 4px; }

  /* ── SORT BAR ── */
.sort-bar {
    padding: 7px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}
  .sort-select { background: #f7f9fc; border: 1.5px solid #e8edf5; border-radius: 8px; padding: 7px 12px; font-size: 13px; font-family: 'Lato', sans-serif; color: #25213B; outline: none; cursor: pointer; }
  .sort-select:focus { border-color: var(--brand); }
  .view-btn { padding: 7px 10px; border: 1.5px solid #e8edf5; border-radius: 8px; cursor: pointer; color: #666; background: #fff; transition: all .2s; }
  .view-btn.active { border-color: var(--brand); color: var(--brand); background: #fdf5ec; }

  /* ── UNIVERSITY CARD (List) ── */
.uni-list-card {
    background: #fff;
    border: 1.5px solid #775042;
    border-radius: 16px;
    overflow: hidden;
    transition: all .3s;
    cursor: pointer;
    display: flex;
}
  .uni-list-card:hover { border-color: var(--brand); box-shadow: 0 8px 32px rgba(192,129,58,.15); transform: translateY(-2px); }
  .uni-list-card .card-img { width: 220px; min-height: 200px; flex-shrink: 0; position: relative; overflow: hidden; }
  .uni-list-card .card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
  .uni-list-card:hover .card-img img { transform: scale(1.05); }
  .uni-list-card .card-body { flex: 1; padding: 25px; display: flex; flex-direction: column; gap: 10px; }

  /* ── UNIVERSITY CARD (Grid) ── */
  .uni-grid-card { background: #fff; border: 1.5px solid #e8edf5; border-radius: 18px; overflow: hidden; transition: all .3s; cursor: pointer; box-shadow: 0 2px 12px rgba(0,0,0,.05); }
  .uni-grid-card:hover { border-color: var(--brand); box-shadow: 0 12px 40px rgba(192,129,58,.15); transform: translateY(-5px); }

  /* ── BADGES ── */
  .featured-badge { background: linear-gradient(135deg, #5c3d2ec7, #d97706); color: #fff; font-size: 10px; font-weight: 700; padding: 3px 10px; border-radius: 100px; font-family: 'Lato', sans-serif; letter-spacing: .5px; }
  .naac-badge { background: #aa2523; color: #fff; font-size: 10px; font-weight: 700; padding: 3px 10px; border-radius: 100px; }
  .nirf-badge { background: #fdf5ec; color: var(--brand); border: 1px solid rgba(192,129,58,.3); font-size: 10px; font-weight: 700; padding: 3px 10px; border-radius: 100px; font-family: 'Lato', sans-serif; }
  .stream-tag { font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 100px; }

  /* ── STARS ── */
  .stars { color: #c0813a; }
.sec-sub {
    color: #000000;
    font-size: 16px;
    line-height: 1.7;
    margin-top: 8px;
}
.sec-h {
    font-family: 'Roboto Slab', Georgia, serif;
    font-size: clamp(26px, 3.5vw, 42px);
    color: #25213B;
    line-height: 1.12;
    letter-spacing: -.3px;
}
h3.sec-h {
    font-size: 28px;
    margin: 10px 0;
}
.sec-h em {
    font-style: italic;
    color: var(--brand);
}

.card-body {
    padding: 25px 15px;
}

  /* ── STAT MINI ── */
  .stat-mini { text-align: center; }
  .stat-mini .val { font-family: 'DM Serif Display', serif; font-weight: 700; font-size: 14px; color: #25213B; }
  .stat-mini .lbl { font-size: 10px; color: #999; margin-top: 2px; }

  /* ── PAGINATION ── */
  .page-btn { width: 38px; height: 38px; border-radius: 10px; border: 1.5px solid #e8edf5; background: #fff; color: #555; font-size: 13px; font-weight: 600; cursor: pointer; transition: all .2s; display: flex; align-items: center; justify-content: center; }
  .page-btn:hover { border-color: var(--brand); color: var(--brand); }
  .page-btn.active { background: var(--brand); border-color: var(--brand); color: #fff; }

  /* ── SEC HEADER ── */
  .sec-eye { font-family: 'Lato', sans-serif; font-size: 11px; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; color: var(--brand); display: inline-flex; align-items: center; gap: 8px; margin-bottom: 10px; }
  .sec-eye::before { content: ''; width: 20px; height: 2px; background: linear-gradient(90deg, var(--brand), var(--gold)); border-radius: 2px; display: inline-block; }

  /* ── FILTER PILL ── */
  .active-filter { display: inline-flex; align-items: center; gap: 6px; background: #fdf5ec; border: 1.5px solid rgba(192,129,58,.3); color: var(--brand); font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 100px; }
  .active-filter button { background: none; border: none; color: var(--brand); cursor: pointer; font-size: 14px; line-height: 1; margin-left: 2px; }

  /* ── MOBILE SIDEBAR TOGGLE ── */
  .filter-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 700; display: none; }
  .filter-overlay.open { display: block; }
  .filter-drawer { position: fixed; left: 0; top: 0; bottom: 0; width: 300px; background: #fff; z-index: 701; overflow-y: auto; transform: translateX(-100%); transition: transform .3s; }
  .filter-drawer.open { transform: translateX(0); }

  /* ── ANIMATIONS ── */
  @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
  .rv { opacity: 0; transform: translateY(20px); transition: opacity .55s ease, transform .55s ease; }
  .rv.in { opacity: 1; transform: none; }
  .d1{transition-delay:.06s} .d2{transition-delay:.12s} .d3{transition-delay:.18s}
  .d4{transition-delay:.24s} .d5{transition-delay:.30s} .d6{transition-delay:.36s}

  /* ── FOOTER ── */
  .footer { background: #000; }

  /* ── MOBILE MENU ── */
  #mobileMenu { display: none; }
  #mobileMenu.open { display: block; }

  /* Scrollbar */
  ::-webkit-scrollbar { width: 6px; } ::-webkit-scrollbar-track { background: #f0f4f8; } ::-webkit-scrollbar-thumb { background: var(--brand); border-radius: 3px; }

  /* ── CTA BAND ── */
  .cta-band { background: linear-gradient(135deg, #211609 0%, #25190d 40%, #251910 70%, #201508 100%); position: relative; overflow: hidden; }
  .cta-band::before { content: ''; position: absolute; inset: 0; background-image: linear-gradient(rgba(14,135,234,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(14,135,234,.06) 1px, transparent 1px); background-size: 36px 36px; }

  /* Mobile responsive */
  @media (max-width: 768px) {
    .uni-list-card { flex-direction: column; }
    .uni-list-card .card-img { width: 100%; min-height: 180px; }
    .desktop-sidebar { display: none; }
    .mobile-filter-btn { display: flex !important; }
  }
  @media (min-width: 769px) {
    .mobile-filter-btn { display: none !important; }

  }

   @media (max-width: 767px) {
    button#listViewBtn, button#gridViewBtn {
    display: none;
}
.card-img {
    width: 100%!important;
}

   }

  /* Info tooltip */
  .tooltip { position: relative; }
  .tooltip:hover::after { content: attr(data-tip); position: absolute; bottom: 120%; left: 50%; transform: translateX(-50%); background: #25213B; color: #fff; font-size: 11px; padding: 5px 10px; border-radius: 8px; white-space: nowrap; pointer-events: none; z-index: 999; }

  /* Loading skeleton */
  .skeleton { background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: 8px; }
  @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }
</style>
@endpush

@section('content')


    <!-- Banner section -->
    <section class="hero">

        <div class="hero-banner">
        <img src="images/banner.png" alt="Background Image" class="bg-image">
        </div>

        <div class="middleware">
            <div class="hero-content">
                <div class="left portion">
                <p class="hero-subtitle"><img src="images/unversity.png" alt="unversity"> india’s #1 University Discovery Platform</p>
                <h1 class="hero-title">Find Your Dream<br>University</h1>
                <p class="hero-description">Explore 5,000+ universities and colleges across India. Compare courses, fees, and placements — all in one place.</p>

                <!-- Stats -->
                <div class="stats">
                    <div class="stat-item">
                        <img src="images/Universities.png" alt="unversity">
                        <div>
                            <h3>5000+</h3>
                            <p>Universities</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="images/Courses.png" alt="Courses">
                        <div>
                            <h3>50,000+</h3>
                            <p>Courses</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <img src="images/Students Helped.png" alt="unversity">
                        <div>
                            <h3>6000+</h3>
                            <p>Students Helped</p>
                        </div>
                    </div>
                </div>
                </div>

                <!-- Search Box -->
                <div class="search-box">
                    <div class="search-content">
                       <h2 class="search-title">Search Universities</h2>
                        <form action="/search" method="GET">
                            <div class="search-field">
                            <label>Select Course</label>
                            <div class="input-wrapper">
                                <i class="icon-cap"><img src="images/cap.png" alt="Cap Icon"></i>
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
                                <i class="icon-cap"><img src="images/location.png" alt="Cap Icon"></i>
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
                                <label class="left"><i class="icon-wallet"><img src="images/wallet.png" alt="Wallet Icon"></i> Budget (per year)</label>
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
    <!--End of Banner section -->

<!-- ══════════ SEO INTRO STRIP ══════════ -->

<section>
  <div class="max-w-screen-xl mx-auto px-5 py-5" style="background-color: #F7F5FE;border-radius: 16px;">
<p class="section-btn">Universities in India</p>
    <h3 class="sec-h">Best B.tech universities in india</h3>
    <p class="sec-sub">
      4892 Best Btech Colleges In India 2026: Ranking, Fees, Courses, Admission, Placements, Cutoff
If Looking For A Complete List Of The Best Engineering Colleges In India, Find 4,800+ Of Them Here On Shiksha. 3,600+ Colleges Are Privately Owned, 700+ Are Owned By The Government, And 50+ Are Semi-government Institutions. For Most, Jee Main Is The National-level Exam For Iits And Nits And Most Central And State Government B.tech Colleges Across The Country. Other Xams Can Be At The State Level Or Be Held By The College Themselves. The Top Iits Are There But You Can Find A Lot Many Options In Each State Of India, With Good Ranks, Placements, And Specialisations. And These Have An Average Fee Between Inr 34,600 And Inr 3.8 Lakh Per Year Or More.
So When Choosing A Btech College In India, You Must Be Considering Accreditation, Updated Curriculum, Branch Availability, Faculty Quality, Placements, Infrastructure And Also Location.</p>
  </div>
</section>

<!-- ══════════ MAIN CONTENT ══════════ -->
<div class="max-w-screen-xl mx-auto px-5 py-8">
  <div class="flex gap-6 items-start">

    <!-- ══ FILTER SIDEBAR (Desktop) ══ -->
    <div class="desktop-sidebar" style="width: 270px; flex-shrink: 0; position: sticky; top: 20px;">
      <div class="filter-sidebar">

        <!-- Header -->
        <div style="padding: 16px 18px; display:flex; align-items:center; justify-content:space-between;border-bottom: 1px solid #ccc;">
          <span class="text-[#0E2A46] font-bold text-sm flex items-center gap-2">
            <svg width="14" stroke="#0E2A46" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 2h12M3 7h8M5 12h4" stroke="#0E2A46" stroke-width="1.5" stroke-linecap="round"/></svg>
            Filters
          </span>
          <button onclick="clearAllFilters()" class="text-[#775042] text-xs font-700 hover:underline">Clear All</button>
        </div>

        <!-- Location -->
        <div class="filter-section" id="sec-location">
          <div class="filter-section-title" onclick="toggleSection('sec-location')">
            Location
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <input class="filter-search mb-3" placeholder="Search Location" id="locationSearch" oninput="filterCheckboxes('location-list', this.value)">
            <div id="location-list" class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Hyderabad" onchange="applyFilters()"><span label="">Hyderabad</span><span class="count">(10)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Pune" onchange="applyFilters()"><span label="">Pune</span><span class="count">(03)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Delhi" onchange="applyFilters()"><span label="">Delhi</span><span class="count">(32)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Bangalore" onchange="applyFilters()"><span label="">Bangalore</span><span class="count">(12)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Nagpur" onchange="applyFilters()"><span label="">Nagpur</span><span class="count">(08)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Lucknow" onchange="applyFilters()"><span label="">Lucknow</span><span class="count">(09)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Mumbai" onchange="applyFilters()"><span label="">Mumbai</span><span class="count">(15)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Chennai" onchange="applyFilters()"><span label="">Chennai</span><span class="count">(11)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Mohali" onchange="applyFilters()"><span label="">Mohali</span><span class="count">(04)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="location" value="Vellore" onchange="applyFilters()"><span label="">Vellore</span><span class="count">(02)</span></label>
            </div>
          </div>
        </div>

        <!-- Specialization -->
        <div class="filter-section" id="sec-spec">
          <div class="filter-section-title" onclick="toggleSection('sec-spec')">
            Specialization
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <input class="filter-search mb-3" placeholder="Search Specialization" oninput="filterCheckboxes('spec-list', this.value)">
            <div id="spec-list" class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="specialization" value="Computer Science" onchange="applyFilters()"><span label="">Computer Science Eng.</span><span class="count ">(17)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="specialization" value="Civil Engineering" onchange="applyFilters()"><span label="">Civil Engineering</span><span class="count ">(02)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="specialization" value="Biotechnology" onchange="applyFilters()"><span label="">Biotechnology</span><span class="count ">(05)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="specialization" value="Electrical Engineering" onchange="applyFilters()"><span label="">Electrical Engineering</span><span class="count ">(17)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="specialization" value="Fluid Mechanics" onchange="applyFilters()"><span label="">Fluid Mechanics</span><span class="count ">(21)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="specialization" value="AI" onchange="applyFilters()"><span label="">Artificial Intelligence...</span><span class="count ">(09)</span></label>
            </div>
          </div>
        </div>

        <!-- Fees -->
        <div class="filter-section" id="sec-fees">
          <div class="filter-section-title" onclick="toggleSection('sec-fees')">
            Fees
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <div class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="fees" value="0-1" onchange="applyFilters()"><span label="">< 1 Lakh</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="fees" value="1-3" onchange="applyFilters()"><span label="">1 - 3 Lakh</span><span class="count ">(02)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="fees" value="3-5" onchange="applyFilters()"><span label="">3 - 5 Lakh</span><span class="count ">(13)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="fees" value="5-7" onchange="applyFilters()"><span label="">5 - 7 Lakh</span><span class="count ">(17)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="fees" value="7-10" onchange="applyFilters()"><span label="">7 - 10 Lakh</span><span class="count ">(31)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="fees" value="10+" onchange="applyFilters()"><span label="">10 Above</span><span class="count ">(29)</span></label>
            </div>
          </div>
        </div>

        <!-- Course -->
        <div class="filter-section" id="sec-course">
          <div class="filter-section-title" onclick="toggleSection('sec-course')">
            Course
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <input class="filter-search mb-3" placeholder="Search Course" oninput="filterCheckboxes('course-list', this.value)">
            <div id="course-list" class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="course" value="B.E/B.Tech" checked onchange="applyFilters()"><span label="">B.E / B.Tech</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="course" value="M.E/M.Tech" onchange="applyFilters()"><span label="">M.E / M.Tech</span><span class="count ">(32)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="course" value="BBA" onchange="applyFilters()"><span label="">BBA</span><span class="count ">(32)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="course" value="BCA" onchange="applyFilters()"><span label="">BCA</span><span class="count ">(4)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="course" value="MBBS" onchange="applyFilters()"><span label="">MBBS</span><span class="count ">(31)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="course" value="MCA" onchange="applyFilters()"><span label="">MCA</span><span class="count ">(109)</span></label>
            </div>
          </div>
        </div>

        <!-- Course Level -->
        <div class="filter-section" id="sec-level">
          <div class="filter-section-title" onclick="toggleSection('sec-level')">
            Course Level
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <div class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="level" value="UG" checked onchange="applyFilters()"><span label="">Under Graduate</span><span class="count ">(12)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="level" value="PG" onchange="applyFilters()"><span label="">Post Graduate</span><span class="count ">(62)</span></label>
            </div>
          </div>
        </div>

        <!-- Mode of Study -->
        <div class="filter-section" id="sec-mode">
          <div class="filter-section-title" onclick="toggleSection('sec-mode')">
            Mode Of Study
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <div class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="mode" value="Full Time" checked onchange="applyFilters()"><span label="">Full Time</span><span class="count ">(32)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="mode" value="Distance" onchange="applyFilters()"><span label="">Distance</span><span class="count ">(12)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="mode" value="Online" onchange="applyFilters()"><span label="">Online</span><span class="count ">(08)</span></label>
            </div>
          </div>
        </div>

        <!-- NAAC Grade -->
        <div class="filter-section" id="sec-naac">
          <div class="filter-section-title" onclick="toggleSection('sec-naac')">
            NAAC Grade
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="#666" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <div class="filter-body">
            <div class="flex flex-col gap-0.5">
              <label class="filter-checkbox"><input type="checkbox" data-filter="naac" value="A++" onchange="applyFilters()"><span label="">A++</span><span class="count ">(08)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="naac" value="A+" onchange="applyFilters()"><span label="">A+</span><span class="count ">(24)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="naac" value="A" onchange="applyFilters()"><span label="">A</span><span class="count ">(31)</span></label>
              <label class="filter-checkbox"><input type="checkbox" data-filter="naac" value="B++" onchange="applyFilters()"><span label="">B++</span><span class="count ">(15)</span></label>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- ══ MAIN LISTING AREA ══ -->
    <div style="flex: 1; min-width: 0;">

      <!-- Top Bar -->
      <div class="sort-bar mb-5 rv">
        <div class="flex items-center gap-4 flex-wrap">
          <!-- Mobile filter toggle -->
          <button class="mobile-filter-btn items-center gap-2 bg-[#fdf5ec] border border-[#c0813a]/30 text-[#c0813a] text-sm font-700 px-4 py-2 rounded-xl" onclick="openMobileFilter()">
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 2h12M3 7h8M5 12h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
            Filters
          </button>

          <div>
            <span class="font-bold text-[#25213B] text-sm" id="resultCount">303</span>
            <span class="text-gray-500 text-sm"> results · </span>
            <span class="text-[#c0813a] text-sm font-600">Best Engineering Universities in India</span>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <!-- Active filter chips -->
          <div id="activeFiltersBar" class="flex flex-wrap gap-2 items-center"></div>

          <!-- Sort -->
          <div class="flex items-center gap-2">
            <span class="text-xs text-gray-500 font-600 whitespace-nowrap">Sort By:</span>
            <select class="sort-select" onchange="sortUniversities(this.value)">
              <option value="popularity">Popularity</option>
              <option value="nirf_asc">NIRF Rank (Low→High)</option>
              <option value="nirf_desc">NIRF Rank (High→Low)</option>
              <option value="fees_asc">Fees (Low→High)</option>
              <option value="fees_desc">Fees (High→Low)</option>
              <option value="rating">Rating</option>
            </select>
          </div>
        </div>
      </div>

      <!-- ── UNIVERSITY LIST ── -->
      <div id="universityContainer" class="flex flex-col gap-4">

        <!-- Card 1 -->
        <div class="uni-list-card rv d1" data-location="Delhi" data-naac="A+" data-fees-num="6" data-nirf="2" data-rating="4.5" data-stream="engineering" data-specialization="Computer Science" data-mode="Full Time" data-level="UG">
          <div class="card-body">
            <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:10px;flex-wrap: wrap;">
              <div style="display:flex; align-items:flex-start; gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;">
                  <img src="images/list1.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'">
                </div>
                <div>
                  <h3 style="font-weight:700; font-size:15px; color:#25213B; line-height:1.3;">IIT Delhi - Indian Institute of Technology</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap: wrap;">
                    <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Hauz Kauz Delhi- Govt </span>
                  </div>
                </div>
              </div>
            </div>

            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#3</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A++</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="uni-list-card rv d2" data-location="Lucknow" data-naac="A" data-fees-num="3" data-nirf="45" data-rating="4.0" data-stream="engineering" data-specialization="Civil Engineering" data-mode="Full Time" data-level="UG">
          <div class="card-body">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap: wrap;">
              <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;"><img src="images/list2.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'"></div>
                <div>
                  <h3 style="font-weight:700;font-size:16px;color:#0E2A46;line-height:1.3;">Integral University</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap: wrap;">
                     <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Kursi Lucknow- Private</span>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#11</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A+</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="uni-list-card rv d3" data-location="Lucknow" data-naac="A" data-fees-num="4" data-nirf="23" data-rating="4.2" data-stream="engineering" data-specialization="Electrical Engineering" data-mode="Full Time" data-level="UG">
          <div class="card-body">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap: wrap;">
              <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;"><img src="images/list3.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'"></div>
                <div>
                  <h3 style="font-weight:700;font-size:16px;color:#0E2A46;line-height:1.3;">Babu Banarsi Das University</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap:wrap;">
                    <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Hauz Kauz Delhi- Govt </span>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#25</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A++</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="uni-list-card rv d4" data-location="Delhi" data-naac="A+" data-fees-num="8" data-nirf="8" data-rating="4.3" data-stream="management" data-specialization="AI" data-mode="Full Time" data-level="PG">
          <div class="card-body">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap: wrap;">
              <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;"><img src="images/list4.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'"></div>
                <div>
                  <h3 style="font-weight:700;font-size:16px;color:#0E2A46;line-height:1.3;">Amity University</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap:wrap;">
                   <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Hauz Kauz Noida- Private</span>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#8</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A++</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="uni-list-card rv d5" data-location="Lucknow" data-naac="A+" data-fees-num="2" data-nirf="1" data-rating="4.7" data-stream="engineering" data-specialization="Computer Science" data-mode="Distance" data-level="UG">
          <div class="card-body">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap: wrap;">
              <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;"><img src="images/list5.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'"></div>
                <div>
                  <h3 style="font-weight:700;font-size:16px;color:#0E2A46;line-height:1.3;">Lucknow University</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap:wrap;">
                     <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Hauz Kauz Lucknow- Govt </span>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#25</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A+</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

             <!--Addon section -->
    <section class="destination-add">
        <div class="container">
            <img src="images/addon.png" alt="View All Universities">
        </div>
    </section>
 <!-- End Addon section -->

        <!-- Card 6 -->
        <div class="uni-list-card rv d4" data-location="Delhi" data-naac="A+" data-fees-num="8" data-nirf="8" data-rating="4.3" data-stream="management" data-specialization="AI" data-mode="Full Time" data-level="PG">
          <div class="card-body">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap: wrap;">
              <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;"><img src="images/list4.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'"></div>
                <div>
                  <h3 style="font-weight:700;font-size:16px;color:#0E2A46;line-height:1.3;">Amity University</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap:wrap;">
                   <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Hauz Kauz Noida- Private</span>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#8</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A++</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

        <div class="uni-list-card rv d2" data-location="Lucknow" data-naac="A" data-fees-num="3" data-nirf="45" data-rating="4.0" data-stream="engineering" data-specialization="Civil Engineering" data-mode="Full Time" data-level="UG">
          <div class="card-body">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap: wrap;">
              <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:52px;height:52px;border-radius:10px;border:1.5px solid #e8edf5;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;"><img src="images/list2.png" alt="" style="width:36px;height:36px;object-fit:contain;" onerror="this.parentNode.innerHTML='🏛'"></div>
                <div>
                  <h3 style="font-weight:700;font-size:16px;color:#0E2A46;line-height:1.3;">Integral University</h3>
                  <div style="display:flex;align-items:center;gap:6px;margin-top:3px;flex-wrap: wrap;">
                     <img src="images/location.png" alt="Location Icon" style="width:18px;height:18px;object-fit:contain;">
                    <span style="font-size:12px;color:#0E2A46;">Kursi Lucknow- Private</span>
                  </div>
                </div>
              </div>
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:60px;grid-row-gap:10px;align-items:center;font-size:15px;color:#797979;padding-top:10px;justify-content: space-between;" class="course-portion">
              <span>Offering Courses <strong style="color:#0E2A46;">15 Courses</strong></span>
              <span>NIRF Ranking <strong style="color:#775042;">#11</strong></span>
              <span>NAAC Grade <strong style="color:#775042;">A+</strong></span>
              <span>Median Salary <strong style="color:#775042;">₹3.37LPA</strong></span>

              <div style="display:flex;gap:8px;margin-top:4px;margin-left:auto;margin-right:0;justify-content: flex-end;">
              <button onclick="openEnquiry('VIT Vellore')" style="background:var(--dark3);color:#fff;border:none;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;cursor:pointer;">Enquire Now</button>
              <a href="University-details.html" style="border:1.5px solid #c0813a;color:#c0813a;padding:9px 20px;border-radius:10px;font-size:15px;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;">View Details</a>
            </div>
            </div>
          </div>
        </div>

        <!-- No Results -->
        <div id="noResults" style="display:none; text-align:center; padding:60px 20px; background:#fff; border-radius:16px; border:1.5px solid #e8edf5;">
          <div style="font-size:48px; margin-bottom:12px;">🔍</div>
          <div style="font-family:'DM Serif Display',serif; font-size:22px; color:#25213B; margin-bottom:8px;">No Universities Found</div>
          <div style="color:#888; font-size:14px; margin-bottom:20px;">Try adjusting or clearing your filters</div>
          <button onclick="clearAllFilters()" style="background:var(--dark3);color:#fff;border:none;padding:10px 24px;border-radius:10px;font-size:13px;font-weight:700;cursor:pointer;">Clear All Filters</button>
        </div>

      </div>

      <!-- ── PAGINATION ── -->
      <div class="flex items-center justify-between mt-8 rv flex-wrap gap-4">
        <div style="font-size:13px;color:#888;">Showing <strong style="color:#25213B;">1–7</strong> of <strong style="color:#25213B;" id="totalShown">303</strong> universities</div>
        <div style="display:flex;gap:6px;align-items:center;">
          <button class="page-btn" onclick="changePage(this,-1)">‹</button>
          <button class="page-btn active">1</button>
          <button class="page-btn" onclick="changePage(this,1)">2</button>
          <button class="page-btn" onclick="changePage(this,1)">3</button>
          <span style="color:#888;font-size:13px;padding:0 4px;">...</span>
          <button class="page-btn" onclick="changePage(this,1)">10</button>
          <button class="page-btn" onclick="changePage(this,1)">›</button>
        </div>
      </div>
    </div>
  </div>
</div>


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


<!-- ══════════ MOBILE FILTER DRAWER ══════════ -->
<div class="filter-overlay" id="filterOverlay" onclick="closeMobileFilter()"></div>
<div class="filter-drawer" id="filterDrawer">
  <div style="background:linear-gradient(135deg,#25213B,#3e2518);padding:16px 18px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:2;">
    <span class="text-white font-bold text-sm">Filters</span>
    <div style="display:flex;gap:12px;align-items:center;">
      <button onclick="clearAllFilters()" style="color:#c0813a;background:none;border:none;font-size:12px;font-weight:700;cursor:pointer;">Clear All</button>
      <button onclick="closeMobileFilter()" style="color:white;background:rgba(255,255,255,.2);border:none;width:28px;height:28px;border-radius:50%;cursor:pointer;font-size:16px;">✕</button>
    </div>
  </div>
  <div style="padding:16px;font-size:13px;color:#666;">
    <!-- Mobile filters mirror -->
    <p style="text-align:center;color:#999;padding:20px 0;">Use desktop view for full filters, or use the sort options above on mobile.</p>
  </div>
</div>
@endsection

@push('scripts')
<script>
// ── DATA: All university cards ──
const allCards = Array.from(document.querySelectorAll('#universityContainer .uni-list-card, #universityContainer .uni-grid-card'));
let compareList = [];
let currentView = 'list';

// ── SCROLL ──
window.addEventListener('scroll', () => {
  const pct = window.scrollY / (document.body.scrollHeight - innerHeight) * 100;
  document.getElementById('progress').style.width = pct + '%';
  const nav = document.getElementById('navbar');
  nav.classList.toggle('scrolled', window.scrollY > 60);
});

// ── MOBILE MENU ──
function toggleMenu() { document.getElementById('mobileMenu').classList.toggle('open'); }

// ── READ MORE ──
function toggleReadMore() {
  const c = document.getElementById('readMoreContent');
  const btn = document.getElementById('readMoreBtn');
  if (c.style.display === 'none') { c.style.display = 'block'; btn.textContent = 'Read Less ▲'; }
  else { c.style.display = 'none'; btn.textContent = 'Read More ▼'; }
}

// ── FILTER SECTION TOGGLE ──
function toggleSection(id) {
  const sec = document.getElementById(id);
  sec.classList.toggle('collapsed');
}

// ── CHECKBOX SEARCH ──
function filterCheckboxes(listId, query) {
  const list = document.getElementById(listId);
  if (!list) return;
  list.querySelectorAll('.filter-checkbox').forEach(cb => {
    const text = cb.textContent.toLowerCase();
    cb.style.display = text.includes(query.toLowerCase()) ? '' : 'none';
  });
}

// ── APPLY ALL FILTERS ──
function applyFilters() {
  const selected = {};
  document.querySelectorAll('.filter-checkbox input[type="checkbox"]:checked').forEach(cb => {
    const f = cb.dataset.filter;
    if (!selected[f]) selected[f] = [];
    selected[f].push(cb.value.toLowerCase());
  });

  let visibleCount = 0;
  allCards.forEach(card => {
    let show = true;

    // Location filter
    if (selected.location && selected.location.length > 0) {
      const loc = (card.dataset.location || '').toLowerCase();
      if (!selected.location.includes(loc)) show = false;
    }

    // NAAC filter
    if (selected.naac && selected.naac.length > 0) {
      const naac = (card.dataset.naac || '').toLowerCase();
      if (!selected.naac.includes(naac)) show = false;
    }

    // Course filter (stream based)
    if (selected.course && selected.course.length > 0) {
      const stream = (card.dataset.stream || '').toLowerCase();
      const hasMatch = selected.course.some(c => {
        if (c.includes('b.e') || c.includes('b.tech')) return stream === 'engineering';
        if (c.includes('m.e') || c.includes('m.tech')) return stream === 'engineering';
        if (c.includes('bba') || c.includes('mba')) return stream === 'management';
        if (c.includes('bca') || c.includes('mca')) return stream === 'engineering' || stream === 'management';
        if (c.includes('mbbs')) return stream === 'medical';
        return true;
      });
      if (!hasMatch) show = false;
    }

    // Level filter
    if (selected.level && selected.level.length > 0) {
      const level = (card.dataset.level || '').toLowerCase();
      if (!selected.level.map(l => l.toLowerCase()).includes(level)) show = false;
    }

    // Mode filter
    if (selected.mode && selected.mode.length > 0) {
      const mode = (card.dataset.mode || '').toLowerCase();
      if (!selected.mode.map(m => m.toLowerCase()).includes(mode)) show = false;
    }

    // Fees filter
    if (selected.fees && selected.fees.length > 0) {
      const feeNum = parseFloat(card.dataset.feesNum || 0);
      const matches = selected.fees.some(range => {
        if (range === '0-1') return feeNum < 1;
        if (range === '1-3') return feeNum >= 1 && feeNum <= 3;
        if (range === '3-5') return feeNum >= 3 && feeNum <= 5;
        if (range === '5-7') return feeNum >= 5 && feeNum <= 7;
        if (range === '7-10') return feeNum >= 7 && feeNum <= 10;
        if (range === '10+') return feeNum > 10;
        return true;
      });
      if (!matches) show = false;
    }

    card.style.display = show ? '' : 'none';
    if (show) visibleCount++;
  });

  document.getElementById('resultCount').textContent = visibleCount;
  document.getElementById('noResults').style.display = visibleCount === 0 ? 'block' : 'none';
  updateActiveFiltersBar(selected);
}

// ── ACTIVE FILTER CHIPS ──
function updateActiveFiltersBar(selected) {
  const bar = document.getElementById('activeFiltersBar');
  bar.innerHTML = '';
  Object.entries(selected).forEach(([filterType, values]) => {
    values.forEach(val => {
      const chip = document.createElement('span');
      chip.className = 'active-filter';
      chip.innerHTML = `${val} <button onclick="removeFilter('${filterType}','${val}')">×</button>`;
      bar.appendChild(chip);
    });
  });
}

function removeFilter(filterType, value) {
  const cb = document.querySelector(`.filter-checkbox input[data-filter="${filterType}"][value="${value}"]`);
  if (cb) { cb.checked = false; applyFilters(); }
}

// ── CLEAR ALL ──
function clearAllFilters() {
  document.querySelectorAll('.filter-checkbox input[type="checkbox"]').forEach(cb => cb.checked = false);
  applyFilters();
  allCards.forEach(c => c.style.display = '');
  document.getElementById('resultCount').textContent = allCards.length;
  document.getElementById('noResults').style.display = 'none';
  document.getElementById('activeFiltersBar').innerHTML = '';
}

// ── SORT ──
function sortUniversities(sortBy) {
  const container = document.getElementById('universityContainer');
  const cards = Array.from(container.querySelectorAll('.uni-list-card, .uni-grid-card'));
  cards.sort((a, b) => {
    if (sortBy === 'nirf_asc') return parseFloat(a.dataset.nirf||999) - parseFloat(b.dataset.nirf||999);
    if (sortBy === 'nirf_desc') return parseFloat(b.dataset.nirf||0) - parseFloat(a.dataset.nirf||0);
    if (sortBy === 'fees_asc') return parseFloat(a.dataset.feesNum||0) - parseFloat(b.dataset.feesNum||0);
    if (sortBy === 'fees_desc') return parseFloat(b.dataset.feesNum||0) - parseFloat(a.dataset.feesNum||0);
    if (sortBy === 'rating') return parseFloat(b.dataset.rating||0) - parseFloat(a.dataset.rating||0);
    return 0;
  });
  const noResults = document.getElementById('noResults');
  cards.forEach(c => container.insertBefore(c, noResults));
}


// ── ENQUIRY ──
function openEnquiry(name) {
  document.getElementById('enquiryUniName').textContent = name !== 'General' ? '→ ' + name : '→ General Enquiry';
  const m = document.getElementById('enquiryModal');
  m.style.removeProperty('display');
  m.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeEnquiry() {
  document.getElementById('enquiryModal').style.setProperty('display','none','important');
  document.body.style.overflow = '';
}
function submitEnquiry() {
  closeEnquiry();
  const t = document.getElementById('toast');
  t.style.removeProperty('display');
  t.style.display = 'flex';
  setTimeout(() => t.style.setProperty('display','none','important'), 4000);
}

// ── MOBILE FILTER ──
function openMobileFilter() {
  document.getElementById('filterOverlay').classList.add('open');
  document.getElementById('filterDrawer').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeMobileFilter() {
  document.getElementById('filterOverlay').classList.remove('open');
  document.getElementById('filterDrawer').classList.remove('open');
  document.body.style.overflow = '';
}

// ── PAGINATION (visual only) ──
function changePage(btn, dir) {
  const pageBtns = document.querySelectorAll('.page-btn');
  pageBtns.forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}

// ── REVEAL SCROLL ──
const rvObs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); rvObs.unobserve(e.target); }});
}, { threshold: 0.06 });
document.querySelectorAll('.rv').forEach(el => rvObs.observe(el));

// ── CLOSE MODAL ON BACKDROP ──
document.getElementById('enquiryModal').addEventListener('click', function(e) {
  if (e.target === this) closeEnquiry();
});
</script>
@endpush