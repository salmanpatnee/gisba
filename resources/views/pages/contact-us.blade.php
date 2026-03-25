@extends('layouts.site')

@section('title', 'Contact GISBA Consultants | Cybersecurity &amp; Training Consulting')
@section('meta_description', 'Contact GISBA Consultants Co. W.L.L. for cybersecurity consulting, NIS2 implementation, and training course development services. Based in the Kingdom of Bahrain.')

@section('banner')
  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span><i class="bi bi-envelope me-2"></i>GISBA Consultants Co. W.L.L. — Global Reach in Consulting &amp; Training</span>
    <div class="d-flex gap-3">
      <a href="{{ route('home') }}"><i class="bi bi-house me-1"></i>Home</a>
      <a href="#get-in-touch"><i class="bi bi-chat-dots me-1"></i>Get in Touch</a>
      <a href="#enquiry-form"><i class="bi bi-envelope me-1"></i>Send Enquiry</a>
    </div>
  </div>
@endsection

@section('footer_tagline')
  Global Cybersecurity Consulting &amp; Training.<br />
  Kingdom of Bahrain.
@endsection

@section('content')

  <div class="page-layout">
    <div class="container">

      <div class="col-12">
        <main class="img-content">
          <section class="hero-section container">
            <div class="row align-items-center">
              <div class="col-md-6">
                <h1 class="hero-title">
                  Contact<br />
                  <span>GISBA Consultants</span>
                </h1>
                <p class="hero-subtitle">Get in Touch with Our Cybersecurity Experts</p>
                <p class="hero-desc">
                  Whether you have a question about our <strong>NIS2 Implementation Kit</strong>, require Cybersecurity Training Development Services, or want to discuss a consulting engagement — our team is ready to help.
                </p>
              </div>
              <div class="col-md-6 text-center">
                <img class="image-content img-fluid" src="{{ asset('assets/images/contact.jpg') }}" alt="Contact GISBA Consultants">
              </div>
            </div>
          </section>
        </main>
      </div>

      <div class="row g-4">

        <div class="col-12 col-md-3">
          <aside class="sidebar">
            <nav class="sidebar-nav">
              <p class="sidebar-nav-title">Quick Links</p>
              <ul>
                {{-- <li><a href="#about"><i class="bi bi-info-circle"></i> About GISBA</a></li> --}}
                <li><a href="#get-in-touch"><i class="bi bi-chat-dots"></i> Get in Touch</a></li>
                <li><a href="#enquiry-form"><i class="bi bi-envelope"></i> Send Enquiry</a></li>
              </ul>
            </nav>
            <div class="sidebar-contact">
              <strong><i class="bi bi-envelope me-1"></i>Contact GISBA</strong>
              <a href="mailto:support@gisba.net">support@gisba.net</a>
            </div>
          </aside>
        </div>

        <div class="col-12 col-md-9">
          <main class="main-content">

            <section id="get-in-touch">
              <h2 class="section-heading">Get in Touch</h2>
              <p>Reach us directly using the contact details below. We respond to all enquiries within one business day.</p>

              <div class="row g-3 mt-2">
                <div class="col-12 col-sm-6">
                  <div class="contact-card h-100">
                    <div class="contact-card-title"><i class="bi bi-envelope me-2"></i>Email</div>
                    <div class="contact-card-body">
                      <p>For general enquiries, service requests, and proposals:</p>
                      <p style="font-size:15px; font-weight:600;"><a href="mailto:support@gisba.net">support@gisba.net</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <hr class="content-divider" />

            <section id="enquiry-form">
              <h2 class="section-heading">Send Us an Enquiry</h2>
              <p>Fill in the form below and we will get back to you as soon as possible.</p>

              <div id="form-alert" role="alert" aria-live="polite" style="display:none;" class="mt-3"></div>

              <div class="contact-card mt-3">
                <div class="contact-card-body">
                  <form id="enquiry-form-el" action="{{ route('contact.send') }}" method="post" novalidate>

                    <div class="row g-3">

                      <div class="col-12 col-sm-6">
                        <label for="contact-name" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact-name" name="name"
                               placeholder="Your full name" required
                               minlength="2" maxlength="100"
                               style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;" />
                        <div class="invalid-feedback" id="err-name"></div>
                      </div>

                      <div class="col-12 col-sm-6">
                        <label for="contact-org" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Organization</label>
                        <input type="text" class="form-control" id="contact-org" name="organization"
                               placeholder="Your organization name" maxlength="150"
                               style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;" />
                      </div>

                      <div class="col-12 col-sm-6">
                        <label for="contact-email" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="contact-email" name="email"
                               placeholder="your@email.com" required maxlength="150"
                               style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;" />
                        <div class="invalid-feedback" id="err-email"></div>
                      </div>

                      <div class="col-12 col-sm-6">
                        <label for="contact-service" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Service of Interest</label>
                        <select class="form-select" id="contact-service" name="service"
                                style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;">
                          <option value="" selected>— Select a service —</option>
                          <option value="nis2">NIS2 Implementation Kit</option>
                          <option value="training">Cybersecurity Training Development Services</option>
                          <option value="consulting">Cybersecurity Consulting</option>
                          <option value="project-management">Project Management Consulting</option>
                          <option value="other">Other / General Enquiry</option>
                        </select>
                      </div>

                      <div class="col-12 col-sm-6">
                        <label for="contact-heard-from" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">From where you heard about us <span class="text-danger">*</span></label>
                        <select class="form-select" id="contact-heard-from" name="heard_from" required
                                style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;">
                          <option value="" selected>— Please select —</option>
                          <option value="linkedin">LinkedIn</option>
                          <option value="google">Google Search</option>
                          <option value="diac">DIAC (Partner's Website)</option>
                          <option value="visionary-alpha">Visionary Alpha (Partner's Website)</option>
                          <option value="other">Others</option>
                        </select>
                        <div class="invalid-feedback" id="err-heard-from"></div>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="contact-phone" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Phone Number</label>
                        <input type="tel" class="form-control" id="contact-phone" name="phone"
                               placeholder="+1 234 567 8900" maxlength="25"
                               style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px;" />
                        <div class="invalid-feedback" id="err-phone"></div>
                      </div>
                      <div class="col-12">
                        <label for="contact-message" class="form-label" style="font-weight:600; font-size:13.5px; color:var(--text-heading);">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="contact-message" name="message" rows="5"
                                  placeholder="Please describe your requirements or question..."
                                  required minlength="10" maxlength="3000"
                                  style="border-color:var(--border-mid); border-radius:var(--radius-sm); font-size:14px; resize:vertical;"></textarea>
                        <div class="invalid-feedback" id="err-message"></div>
                        <div style="font-size:12px; color:var(--text-muted); text-align:right; margin-top:4px;">
                          <span id="msg-count">0</span> / 3000
                        </div>
                      </div>

                      <div class="col-12">
                        <button type="submit" id="submit-btn" class="btn-hero-primary" style="border:none; cursor:pointer;">
                          <i class="bi bi-send me-2"></i>Send Enquiry
                        </button>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </section>

          </main>
        </div>

      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  const msgArea  = document.getElementById('contact-message');
  const msgCount = document.getElementById('msg-count');
  if (msgArea && msgCount) {
    msgArea.addEventListener('input', () => {
      msgCount.textContent = msgArea.value.length;
    });
  }

  function setFieldError(inputEl, errEl, message) {
    inputEl.classList.add('is-invalid');
    inputEl.classList.remove('is-valid');
    if (errEl) { errEl.textContent = message; }
  }

  function setFieldValid(inputEl) {
    inputEl.classList.remove('is-invalid');
    inputEl.classList.add('is-valid');
  }

  function clearFieldState(inputEl, errEl) {
    inputEl.classList.remove('is-invalid', 'is-valid');
    if (errEl) { errEl.textContent = ''; }
  }

  function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function validatePhone(phone) {
    return /^\+?[\d\s\-().]{7,20}$/.test(phone);
  }

  function validateForm() {
    let valid = true;
    const name      = document.getElementById('contact-name');
    const email     = document.getElementById('contact-email');
    const phone     = document.getElementById('contact-phone');
    const heardFrom = document.getElementById('contact-heard-from');
    const message   = document.getElementById('contact-message');

    if (!name.value.trim() || name.value.trim().length < 2) {
      setFieldError(name, document.getElementById('err-name'), 'Full name must be at least 2 characters.');
      valid = false;
    } else {
      setFieldValid(name);
    }

    if (!email.value.trim()) {
      setFieldError(email, document.getElementById('err-email'), 'Email address is required.');
      valid = false;
    } else if (!validateEmail(email.value.trim())) {
      setFieldError(email, document.getElementById('err-email'), 'Please enter a valid email address.');
      valid = false;
    } else {
      setFieldValid(email);
    }

    if (phone.value.trim() && !validatePhone(phone.value.trim())) {
      setFieldError(phone, document.getElementById('err-phone'), 'Please enter a valid phone number.');
      valid = false;
    } else {
      clearFieldState(phone, document.getElementById('err-phone'));
    }

    if (!heardFrom.value) {
      setFieldError(heardFrom, document.getElementById('err-heard-from'), 'Please let us know how you heard about us.');
      valid = false;
    } else {
      setFieldValid(heardFrom);
    }

    if (!message.value.trim() || message.value.trim().length < 10) {
      setFieldError(message, document.getElementById('err-message'), 'Message must be at least 10 characters.');
      valid = false;
    } else {
      setFieldValid(message);
    }

    return valid;
  }

  const form      = document.getElementById('enquiry-form-el');
  const alertEl   = document.getElementById('form-alert');
  const submitBtn = document.getElementById('submit-btn');

  function showAlert(type, message) {
    const iconMap = { success: 'bi-check-circle-fill', danger: 'bi-exclamation-triangle-fill', warning: 'bi-exclamation-circle-fill' };
    alertEl.className = `alert alert-${type} d-flex align-items-start gap-2 mt-3`;
    alertEl.innerHTML = `<i class="bi ${iconMap[type] || 'bi-info-circle-fill'} flex-shrink-0 mt-1"></i><span>${message}</span>`;
    alertEl.style.display = '';
    alertEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      if (!validateForm()) {
        showAlert('warning', 'Please correct the highlighted fields before submitting.');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending…';
      alertEl.style.display = 'none';

      try {
        const response = await fetch(form.action, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: new FormData(form),
        });

        const data = await response.json();

        if (data.success) {
          showAlert('success', data.message);
          form.reset();
          form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
          });
          if (msgCount) { msgCount.textContent = '0'; }
        } else if (data.errors) {
          const fieldMap = {
            name:       ['contact-name',       'err-name'],
            email:      ['contact-email',      'err-email'],
            phone:      ['contact-phone',      'err-phone'],
            heard_from: ['contact-heard-from', 'err-heard-from'],
            message:    ['contact-message',    'err-message'],
          };
          Object.entries(data.errors).forEach(([field, msg]) => {
            if (fieldMap[field]) {
              const [inputId, errId] = fieldMap[field];
              setFieldError(document.getElementById(inputId), document.getElementById(errId), msg);
            }
          });
          showAlert('warning', 'Please correct the highlighted fields before submitting.');
        } else {
          showAlert('danger', data.message || 'Something went wrong. Please try again or email us directly at <a href="mailto:support@gisba.net">support@gisba.net</a>.');
        }
      } catch (err) {
        showAlert('danger', 'A network error occurred. Please check your connection or email us directly at <a href="mailto:support@gisba.net">support@gisba.net</a>.');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Send Enquiry';
      }
    });

    ['contact-name', 'contact-email', 'contact-phone', 'contact-message'].forEach(id => {
      const el = document.getElementById(id);
      if (el) { el.addEventListener('blur', () => validateForm()); }
    });
  }
</script>
@endpush
