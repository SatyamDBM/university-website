document.addEventListener("DOMContentLoaded", function () {

  /* ─────────────────────────────
     GLOBAL FUNCTIONS (for onclick)
  ───────────────────────────── */

  // FAQ Toggle
  document.querySelectorAll(".faq-q").forEach(function(q) {
      q.addEventListener("click", function () {
          const item = this.closest(".faq-item");
          const isOpen = item.classList.contains("open");
          document.querySelectorAll(".faq-item").forEach(f => f.classList.remove("open"));
          if (!isOpen) item.classList.add("open");
      });
  });
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

  // window.subscribeNewsletter = function () {
  //   const input = document.getElementById('newsletterEmail');
  //   const email = input?.value;

  //   if (email && email.includes('@')) {
  //     alert(`Subscribed: ${email}`);
  //     input.value = '';
  //   } else {
  //     alert('Enter valid email');
  //   }
  // };

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
      const href = this.getAttribute('href');

      if (!href || href === '#') {
        return;
      }

      const target = document.querySelector(href);

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
});


document.querySelectorAll(".has-dropdown").forEach(item => {
    item.addEventListener("click", function () {
        this.classList.toggle("open");
    });
});


function filterCourses(level) {

    fetch('/filter-courses?level=' + level)
        .then(response => response.json())
        .then(data => {

            let html = '';

            data.forEach(course => {

                html += `
                <div class="course-card">
                    <p class="Timer">${course.type ?? 'Full Time'}</p>

                    <h4>${course.course_name}</h4>

                    <div class="course-stats">
                        <p>Duration</p>
                        <p class="right">${course.duration}</p>
                    </div>

                    <div class="course-stats">
                        <p>Total Avg. Fees</p>
                        <p class="right">${course.fees}</p>
                    </div>

                    <div class="course-stats">
                        <p>Universities</p>
                        <p class="right">
                            ${course.university_count > 100 ? course.university_count + '+' : course.university_count}
                        </p>
                    </div>

                    <a href="/courses-details/${course.course_name}" class="course-link">
                        Course Overview →
                    </a>
                </div>`;
            });

            document.getElementById('coursesGrid').innerHTML = html;
        });
}

function subscribeNewsletter() {

    let emailInput = document.getElementById('newsletterEmail');
    let msgBox = document.getElementById('newsletterMsg');

    let email = emailInput.value;

    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // reset message
    msgBox.innerText = '';
    msgBox.className = '';

    // frontend validation
    if (!email || !email.includes('@')) {
        msgBox.innerText = 'Please enter a valid email';
        msgBox.classList.add('error');
        return;
    }

    fetch('/newsletter/subscribe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            email: email
        })
    })
    .then(res => res.json())
    .then(data => {

        // ❌ REMOVE alert
        // alert(data.message);

        msgBox.innerText = data.message;

        if (data.status) {
            msgBox.classList.add('success');
            emailInput.value = '';
        } else {
            msgBox.classList.add('error');
        }
    })
    .catch(() => {
        msgBox.innerText = 'Something went wrong';
        msgBox.classList.add('error');
    });
}

function handleEnquiry(event) {
    event.preventDefault();

    // clear previous errors
    document.querySelectorAll('.error').forEach(e => e.innerText = '');

    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    let data = {
        name: document.getElementById('enq_name').value,
        email: document.getElementById('enq_email').value,
        mobile: document.getElementById('enq_mobile').value,
        course: document.getElementById('enq_course').value,
        message: document.getElementById('enq_message').value,
    };

    fetch('/enquiry/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(data)
    }).then(async (response) => {

          let res = await response.json().catch(() => null);

          if (!res) return;

          // ❌ VALIDATION ERROR
            if (!response.ok) {

          if (res.errors) {

              if (res.errors.name) {
                  document.getElementById('err_name').innerText = res.errors.name[0];
              }

              if (res.errors.email) {
                  document.getElementById('err_email').innerText = res.errors.email[0];
              }

              if (res.errors.mobile) {
                  document.getElementById('err_mobile').innerText = res.errors.mobile[0];
              }

              if (res.errors.course) {
                  document.getElementById('err_course').innerText = res.errors.course[0];
              }

              if (res.errors.message) {
                  document.getElementById('err_message').innerText = res.errors.message[0];
              }
          }

          return;
      }

      // ✅ SUCCESS CASE
     if (res.status === true) {

    showSuccessPopup(res.message);

    document.getElementById('enquiryForm').reset();

    setTimeout(() => {
        closeEnquiryModal();
    }, 500); // small delay so user sees success message

    return;
}

  })
    .catch(() => {
        alert("Something went wrong!");
    });
}


function showToast(message, type = "success") {

    let toast = document.getElementById("toast");

    toast.className = "toast " + type;
    toast.innerText = message;
    toast.style.display = "block";

    setTimeout(() => {
        toast.style.display = "none";
    }, 3000);
}