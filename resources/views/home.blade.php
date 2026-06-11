@extends('layout')

@section('title', 'Home')

@section('content')

<style>
  .home-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .hero-section {
    text-align: center;
    margin-bottom: 48px;
    padding: 20px 0;
  }

  .hero-section h1 {
    font-size: 42px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 12px;
  }

  .hero-section p {
    font-size: 18px;
    color: #718096;
    margin-bottom: 8px;
  }

  .hero-section .subtitle {
    font-size: 14px;
    color: #a0aec0;
    font-style: italic;
  }

  .features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
    margin-bottom: 48px;
  }

  .feature-card {
    background: #fff;
    border-radius: 12px;
    padding: 28px 20px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    border: 2px solid transparent;
  }

  .feature-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    border-color: #4a9eff;
    text-decoration: none;
    color: inherit;
  }

  .feature-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f0f4f8;
    border-radius: 12px;
    overflow: hidden;
  }

  .feature-icon img {
    width: 80px;
    height: 80px;
    object-fit: contain;
  }

  .feature-title {
    font-size: 18px;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 8px;
  }

  .feature-desc {
    font-size: 13px;
    color: #718096;
    line-height: 1.5;
  }

  .cta-section {
    background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
    border-radius: 12px;
    padding: 40px 32px;
    text-align: center;
    color: #fff;
    margin-top: 48px;
  }

  .cta-section h3 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .cta-section p {
    font-size: 16px;
    margin-bottom: 24px;
    opacity: 0.9;
  }

  .cta-btn {
    display: inline-block;
    background: #fff;
    color: #2B6CB0;
    padding: 12px 32px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    font-size: 15px;
  }

  .cta-btn:hover {
    background: #f0f4f8;
    transform: scale(1.05);
    text-decoration: none;
    color: #2B6CB0;
  }

  .modules-section {
    margin-top: 48px;
  }

  .modules-title {
    font-size: 24px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 28px;
    text-align: center;
  }
</style>

@auth
{{-- ═══════════════════════════════════════════
     AUTHENTICATED USER VIEW
═══════════════════════════════════════════ --}}

<div class="home-container">
  <div class="hero-section">
    <h1>Welcome, {{ auth()->user()->name }}!</h1>
    <p>{{ now()->format('l, d M Y') }}</p>
  </div>

  <div class="modules-title">Quick Access</div>

  <div class="features-grid">
    <!-- Students -->
    <a href="{{ url('/students') }}" class="feature-card">
      <div class="feature-icon">
        <img src="/img/student.jpg" alt="Students">
      </div>
      <div class="feature-title">Students</div>
      <div class="feature-desc">Manage student records and enrollments</div>
    </a>

    @if(!auth()->user()->isTeacher())
    <!-- Teachers -->
    <a href="{{ url('/teachers') }}" class="feature-card">
      <div class="feature-icon">
        <img src="/img/teacher.png" alt="Teachers">
      </div>
      <div class="feature-title">Teachers</div>
      <div class="feature-desc">Manage teaching staff and assignments</div>
    </a>

    <!-- Courses -->
    <a href="{{ url('/courses') }}" class="feature-card">
      <div class="feature-icon">
        <img src="/img/library.png" alt="Courses">
      </div>
      <div class="feature-title">Courses</div>
      <div class="feature-desc">Manage courses and schedules</div>
    </a>

    <!-- Administrators -->
    <a href="{{ url('/administrators') }}" class="feature-card">
      <div class="feature-icon">
        <img src="/img/administrator.png" alt="Administrators">
      </div>
      <div class="feature-title">Administrators</div>
      <div class="feature-desc">Manage admin accounts and permissions</div>
    </a>
    @endif
  </div>
</div>

@else
{{-- ═══════════════════════════════════════════
     PUBLIC HOME PAGE (NOT LOGGED IN)
═══════════════════════════════════════════ --}}

<div class="home-container">
  <div class="hero-section">
    <h1>Welcome to School Management</h1>
    <p>A comprehensive system for managing students, teachers, and courses</p>
    <div class="subtitle">Streamline your educational institution with our modern management platform</div>
  </div>

  <div class="modules-title">System Features</div>

  <div class="features-grid">
    <!-- Students Management -->
    <div class="feature-card">
      <div class="feature-icon">
        <img src="/img/student.jpg" alt="Students">
      </div>
      <div class="feature-title">Student Management</div>
      <div class="feature-desc">Complete student records, enrollment tracking, and performance monitoring</div>
    </div>

    <!-- Teachers Management -->
    <div class="feature-card">
      <div class="feature-icon">
        <img src="/img/teacher.png" alt="Teachers">
      </div>
      <div class="feature-title">Teacher Management</div>
      <div class="feature-desc">Staff profiles, subject assignments, and class scheduling</div>
    </div>

    <!-- Courses Management -->
    <div class="feature-card">
      <div class="feature-icon">
        <img src="/img/library.png" alt="Courses">
      </div>
      <div class="feature-title">Course Management</div>
      <div class="feature-desc">Course creation, scheduling, and enrollment management</div>
    </div>

    <!-- Administration -->
    <div class="feature-card">
      <div class="feature-icon">
        <img src="/img/administrator.png" alt="Administration">
      </div>
      <div class="feature-title">Administration</div>
      <div class="feature-desc">System administration, user management, and access control</div>
    </div>
  </div>

  {{-- Call to Action --}}
  <div class="cta-section">
    <h3>Ready to Get Started?</h3>
    <p>Log in to your account to access the full system</p>
    <a href="{{ route('login') }}" class="cta-btn">
      <i class="fas fa-sign-in-alt me-2"></i>Login Now
    </a>
  </div>
</div>

@endauth

@endsection


