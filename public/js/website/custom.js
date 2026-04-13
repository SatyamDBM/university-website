document.addEventListener("DOMContentLoaded", function () {

  /* ─────────────────────────────
     GLOBAL FUNCTIONS (for onclick)
  ───────────────────────────── */

  window.toggleFaq = function (el) {
    const item = el.closest('.faq-item');
    const isOpen = item.classList.contains('open');

    document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
  };

  window.switchTab = function (event, tabType) {
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
    console.log('Switched to:', tabType);
  };

  window.openLoginModal = function () {
    const login = document.getElementById('loginModal');
    const signup = document.getElementById('signupModal');
    if (login) login.style.display = 'block';
    if (signup) signup.style.display = 'none';
  };

  window.closeLoginModal = function () {
    const login = document.getElementById('loginModal');
    if (login) login.style.display = 'none';
  };

  window.openSignupModal = function () {
    const signup = document.getElementById('signupModal');
    const login = document.getElementById('loginModal');
    if (signup) signup.style.display = 'block';
    if (login) login.style.display = 'none';
  };

  window.closeSignupModal = function () {
    const signup = document.getElementById('signupModal');
    if (signup) signup.style.display = 'none';
  };

    window.openEnquiryModal = function () {
    const enquiry = document.getElementById('enquiryModal');
    const login = document.getElementById('loginModal');
    if (enquiry) enquiry.style.display = 'block';
    if (login) login.style.display = 'none';
  };

  window.closeEnquiryModal = function () {
    const enquiry = document.getElementById('enquiryModal');
    if (enquiry) enquiry.style.display = 'none';
  };

  window.handleLogin = function (event) {
    event.preventDefault();
    const email = event.target[0]?.value;
    alert(`Login successful!\nEmail: ${email}`);
    closeLoginModal();
    return false;
  };

  window.handleSignup = function (event) {
    event.preventDefault();
    const name = event.target[0]?.value;
    const email = event.target[1]?.value;
    alert(`Signup successful!\nInstitute: ${name}\nEmail: ${email}`);
    closeSignupModal();
    return false;
  };

  window.subscribeNewsletter = function () {
    const input = document.getElementById('newsletterEmail');
    const email = input?.value;

    if (email && email.includes('@')) {
      alert(`Subscribed: ${email}`);
      input.value = '';
    } else {
      alert('Enter valid email');
    }
  };

  window.openGallery = function () {
    const el = document.getElementById('galleryLB');
    if (el) el.classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  window.closeGallery = function () {
    const el = document.getElementById('galleryLB');
    if (el) el.classList.remove('open');
    document.body.style.overflow = '';
  };

  window.navTo = function (btn, id) {
    document.querySelectorAll('.pnb').forEach(b => b.classList.remove('on'));
    btn.classList.add('on');
    const el = document.getElementById(id);
    if (el) window.scrollTo({ top: el.offsetTop - 118, behavior: 'smooth' });
  };

  window.switchPlaceTab = function (btn, id) {
    document.querySelectorAll('.ptb').forEach(b => {
      b.classList.remove('active');
      b.setAttribute('aria-selected', 'false');
    });

    document.querySelectorAll('.ptab-panel').forEach(p => p.classList.remove('active'));

    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');

    const panel = document.getElementById('pt-' + id);
    if (panel) panel.classList.add('active');
  };

  /* ─────────────────────────────
     SEARCH
  ───────────────────────────── */

  const searchBtn = document.querySelector('.btn-search');
  if (searchBtn) {
    searchBtn.addEventListener('click', function () {
      const selects = document.querySelectorAll('.search-field select');

      if (selects.length < 3) return;

      const [stream, program, location] = [...selects].map(s => s.value);

      if (stream.includes('Select') || program.includes('Select') || location.includes('Select')) {
        alert('Please select all fields');
      } else {
        alert(`Searching...\n${stream} | ${program} | ${location}`);
      }
    });
  }

  /* ─────────────────────────────
     FILTER BUTTONS
  ───────────────────────────── */

  function handleFilter(selector) {
    const btns = document.querySelectorAll(selector);
    btns.forEach(btn => {
      btn.addEventListener('click', function () {
        btns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
      });
    });
  }

  handleFilter('.popular-courses .filter-btn');
  handleFilter('.university-ranking .filter-btn');

  /* ─────────────────────────────
     SMOOTH SCROLL
  ───────────────────────────── */

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  /* ─────────────────────────────
     SCROLL EFFECTS
  ───────────────────────────── */

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.stream-card, .university-card, .course-card, .place-card')
    .forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = '0.5s';
      observer.observe(el);
    });

  /* ─────────────────────────────
     SCROLL HANDLERS (MERGED)
  ───────────────────────────── */

  window.addEventListener('scroll', function () {

    // Progress Bar
    const pgb = document.getElementById('pgb');
    if (pgb) {
      const pct = window.scrollY / (document.body.scrollHeight - window.innerHeight) * 100;
      pgb.style.width = pct + '%';
    }

    // Sticky Header
    const header = document.querySelector('.header');
    if (header) {
      if (window.scrollY > 50) header.classList.add('sticky');
      else header.classList.remove('sticky');
    }

  });

  /* ─────────────────────────────
     LOAD EFFECT
  ───────────────────────────── */

  window.addEventListener('load', function () {
    const hero = document.getElementById('heroBg');
    if (hero) setTimeout(() => hero.classList.add('loaded'), 100);
  });

  console.log('✅ Custom JS Loaded Successfully');

});


document.querySelectorAll(".has-dropdown").forEach(item => {
    item.addEventListener("click", function () {
        this.classList.toggle("open");
    });
});