<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="Sign in to the Cerillo Dental Clinic staff portal.">
 <title>Sign in &middot; Cerillo Dental Clinic</title>
 <link href="{{ asset('assets/images/cerillo-logo.png') }}" rel="icon">
 <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/cerillo-responsive.css">
<script src="/assets/js/cerillo-format.js"></script>
</head>
<body class="login-page">
 <main class="auth-page">
  <aside class="auth-story">
   <a aria-label="Cerillo Dental Clinic home" class="brand" href="{{ route('home') }}">
    <img alt="Cerillo tooth logo" src="{{ asset('assets/images/cerillo-logo.png') }}">
    <span>Cerillo<small>Dental Clinic</small></span>
   </a>
   <div>
    <p class="eyebrow">Your care, all in one place</p>
    <h1>A familiar face.<br>A simpler visit.</h1>
    <p>Access the clinic workspace for scheduling, clinical records, billing and administration.</p>
    <img alt="Cerillo Dental Clinic interior" class="scene" src="{{ asset('assets/images/clinic.jpg') }}">
   </div>
   <p class="small">Cerillo Dental Clinic &middot; Staff portal</p>
  </aside>
  <section aria-labelledby="login-title" class="auth-form-area">
   <div class="auth-form">
    <a aria-label="Cerillo Dental Clinic home" class="brand" href="{{ route('home') }}">
     <img alt="Cerillo tooth logo" src="{{ asset('assets/images/cerillo-logo.png') }}">
     <span>Cerillo<small>Dental Clinic</small></span>
    </a>
    <a class="small auth-back-link" href="{{ route('home') }}">&larr; Back to the clinic</a>
    <header class="auth-heading">
     <p class="eyebrow">Secure clinic portal</p>
     <h1 id="login-title">Welcome back.</h1>
     <p class="muted">Sign in to your authorized clinic workspace.</p>
    </header>
    <form action="{{ route('login') }}" id="login-form" method="POST">
     @csrf
     <div class="field">
      <label for="login-email">Email address</label>
      <input autocomplete="username" id="login-email" name="email" placeholder="name@example.com" required type="email" value="{{ old('email') }}">
     </div>
     <div class="field">
      <label for="login-password">Password</label>
      <div class="password-reveal-field"><input autocomplete="current-password" id="login-password" name="password" placeholder="Enter your password" required type="password"><button type="button" id="loginPasswordToggle" aria-label="Show password" aria-pressed="false" title="Show password"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></button></div>
     </div>
     <div class="auth-options">
      <label class="check" for="remember-me"><input id="remember-me" name="remember" type="checkbox"> Remember me</label>
      <a class="small" href="#password-help">Forgot password?</a>
     </div>
     <button class="btn auth-primary-action" type="submit">Sign in <span aria-hidden="true">&nearrow;</span></button>
    </form>
    @if($errors->any())
     <p aria-live="polite" class="login-message visible" id="login-message" role="alert">{{ $errors->first() }}</p>
    @endif
    <p class="small muted auth-switch">Need a dental appointment? <a href="{{ route('booking') }}">Request an appointment online</a></p>
    <aside aria-labelledby="test-accounts-title" class="test-accounts">
     <div class="test-accounts-heading">
      <p class="eyebrow">Portal access</p>
      <h2 id="test-accounts-title">Account credentials</h2>
      <p class="small muted">Use the account that matches the workspace you want to review.</p>
     </div>
     <div class="account-credential-list">
      @foreach([
       ['Super Admin', 'superadmin@cerillodental.com', 'Cerillo@2026'],
       ['Admin', 'admin@cerillodental.com', 'Admin@2026'],
       ['Dentist', 'dentist@cerillodental.com', 'Dentist@2026'],
       ['Front Desk', 'frontdesk@cerillodental.com', 'FrontDesk@2026'],
      ] as [$role, $email, $password])
       <article class="account-credential"><strong>{{ $role }}</strong><span>{{ $email }}</span><code>{{ $password }}</code></article>
      @endforeach
     </div>
    </aside>
    <aside class="auth-help" id="password-help">
     <strong>Password assistance</strong>
     <p class="small muted">Contact the clinic administrator if you need help recovering access to your account.</p>
    </aside>
   </div>
  </section>
 </main>
 <script>
  if (localStorage.getItem('cerilloDarkMode') === 'true') document.body.classList.add('dark-mode');
 </script>

<script src="/assets/js/cerillo-responsive.js"></script>
<script src="/assets/js/cerillo-table-pagination.js"></script>
<script>document.getElementById("loginPasswordToggle")?.addEventListener("click", function(){const input=document.getElementById("login-password");const show=input.type==="password";input.type=show?"text":"password";this.setAttribute("aria-pressed",String(show));this.setAttribute("aria-label",show?"Hide password":"Show password");this.title=show?"Hide password":"Show password";});</script><style>.password-reveal-field{position:relative}.password-reveal-field input{width:100%;padding-right:52px}.password-reveal-field button{position:absolute;right:9px;top:50%;transform:translateY(-50%);background:transparent;border:0;cursor:pointer;color:inherit;display:grid;place-items:center;padding:8px;border-radius:8px}.password-reveal-field button:focus-visible{outline:2px solid #409589}</style></body>
</html>