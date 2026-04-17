@extends('layouts.website')

@section('title', 'Course')

@section('body-class', 'course_listing')

@section('content')

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
          {{-- <div class="course-grid">
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
          </div> --}}
          <div class="course-grid">
      @forelse($categories as $category)

          <div class="cc rv">

              {{-- HEADER --}}
              <div class="cc-head">
                  <div class="cc-name">
                      {{ $category->icon ?? '📚' }} {{ $category->name }}
                  </div>

                  <span class="cc-dur">
                      {{ optional($category->courses->first())->duration }}
                  </span>
              </div>

              {{-- BODY --}}
              <div class="cc-body">

                  @foreach($category->courses as $course)

                      {{-- COURSE NAME --}}
                      <div class="font-semibold mt-2">
                          {{ $course->course_name }}
                      </div>

                      {{-- STREAMS --}}
                      @forelse($course->streams as $stream)
                          <div class="fee-row">
                              <span class="fee-spec">
                                  {{ $stream->name }}
                              </span>

                              <span class="fee-amt">
                                  ₹{{ number_format($course->total_fees ?? 0) }}
                              </span>
                          </div>
                      @empty
                          <div class="text-gray-400 text-sm">
                              No streams
                          </div>
                      @endforelse

                  @endforeach

                  {{-- EXAMS --}}
                  <div class="cc-exams">
                      <div class="cc-exam-l">Entrance Exams</div>

                      @php
                          $exams = $category->courses
                              ->pluck('required_exams')
                              ->filter()
                              ->flatMap(fn($e) => explode(',', $e))
                              ->unique();
                      @endphp

                      @foreach($exams as $exam)
                          <span class="cc-exam">{{ trim($exam) }}</span>
                      @endforeach
                  </div>

              </div>

          </div>

      @empty
          <div class="text-center py-10">
              No courses found
          </div>
      @endforelse

          </div>
         </div>
       </div>

      </div>

      </div>
        </div>
      </section>
   @endsection