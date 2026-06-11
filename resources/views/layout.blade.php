<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'School Management')</title>

  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="/css/style.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* ── Layout ─────────────────────────────────── */
    body {
      background: #f5f7fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* ── Header banner ──────────────────────────── */
    .site-header {
      position: relative;
      overflow: hidden;
    }

    .site-header img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      object-position: center;
      display: block;
    }

    /* ── Navbar ─────────────────────────────────── */
    .navbar {
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%) !important;
      padding: 12px 0;
    }

    .navbar-brand {
      font-weight: 800;
      font-size: 18px;
      letter-spacing: 0.5px;
      color: #fff !important;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .navbar .nav-link {
      font-size: 13px;
      padding: 8px 14px !important;
      border-radius: 6px;
      transition: all 0.3s ease;
      color: rgba(255,255,255,0.85) !important;
      font-weight: 500;
      letter-spacing: 0.3px;
    }

    .navbar .nav-link:hover {
      background: rgba(255,255,255,0.15);
      color: #fff !important;
    }

    .navbar .nav-link.active-nav {
      background: rgba(255,255,255,0.25);
      color: #fff !important;
      font-weight: 700;
    }

    /* ── Page wrapper ───────────────────────────── */
    .page-wrapper {
      display: flex;
      align-items: flex-start;
      gap: 0;
      min-height: calc(100vh - 160px - 56px - 60px);
      padding: 0;
    }

    /* ── Sidebar ─────────────────────────────────── */
    .sidebar {
      display: none;
    }

    .sidebar header {
      font-size: 11px;
      font-weight: 900;
      color: #fff;
      text-align: center;
      padding: 20px 16px;
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      letter-spacing: 3px;
      text-transform: uppercase;
      border-bottom: 3px solid #1e4d7b;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      box-shadow: 0 4px 12px rgba(43, 108, 176, 0.25);
    }

    .sidebar header i {
      font-size: 18px;
      animation: slideInLeft 0.5s ease;
    }

    @keyframes slideInLeft {
      from {
        transform: translateX(-20px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .sidebar-user {
      padding: 18px 16px;
      background: linear-gradient(135deg, rgba(43, 108, 176, 0.2) 0%, rgba(30, 77, 123, 0.15) 100%);
      border-bottom: 2px solid rgba(43, 108, 176, 0.3);
      margin: 0;
      position: relative;
      overflow: hidden;
    }

    .sidebar-user::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, #2B6CB0, #4a9eff, #2B6CB0);
    }

    .sidebar-user .user-name {
      font-weight: 800;
      color: #fff;
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 6px;
    }

    .sidebar-user .user-name i {
      font-size: 10px;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% {
        opacity: 1;
      }
      50% {
        opacity: 0.6;
      }
    }

    .sidebar-user .user-role {
      font-size: 10px;
      color: #4a9eff;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      font-weight: 800;
      background: rgba(74, 158, 255, 0.15);
      padding: 4px 8px;
      border-radius: 4px;
      display: inline-block;
      border: 1px solid rgba(74, 158, 255, 0.3);
    }

    .sidebar-menu {
      padding: 12px 0;
    }

    .sidebar-section-label {
      font-size: 9px;
      color: #4a9eff;
      text-transform: uppercase;
      letter-spacing: 2px;
      padding: 16px 16px 10px;
      font-weight: 900;
      display: flex;
      align-items: center;
      gap: 8px;
      position: relative;
    }

    .sidebar-section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(90deg, #4a9eff, transparent);
    }

    .sidebar-section-label i {
      font-size: 13px;
      color: #4a9eff;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 12px;
      height: 46px;
      color: #a8bcc9;
      padding: 0 16px;
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.5px;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
      transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
      text-decoration: none;
      position: relative;
      margin: 4px 8px;
      border-radius: 8px;
    }

    .sidebar a::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 4px;
      background: linear-gradient(180deg, #2B6CB0, #4a9eff);
      border-radius: 4px 0 0 4px;
      transform: scaleY(0);
      transform-origin: center;
      transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .sidebar a:hover {
      background: rgba(43, 108, 176, 0.15);
      color: #4a9eff;
      border-left-color: transparent;
      text-decoration: none;
      transform: translateX(4px);
    }

    .sidebar a:hover::before {
      transform: scaleY(1);
    }

    .sidebar a.active-link {
      background: rgba(43, 108, 176, 0.2);
      color: #4a9eff;
      border-left-color: transparent;
      font-weight: 900;
      box-shadow: 0 4px 12px rgba(43, 108, 176, 0.25);
      transform: translateX(4px);
    }

    .sidebar a.active-link::before {
      transform: scaleY(1);
    }

    .sidebar a i {
      font-size: 16px;
      width: 18px;
      text-align: center;
      flex-shrink: 0;
      color: #4a9eff;
      transition: all 0.35s ease;
    }

    .sidebar a:hover i,
    .sidebar a.active-link i {
      transform: scale(1.15) rotate(5deg);
    }

    .sidebar a span {
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 0.9px;
    }

    .sidebar-divider {
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(74, 158, 255, 0.2), transparent);
      margin: 10px 16px;
      border-radius: 1px;
    }

    /* ── Scrollbar ──────────────────────────────── */
    .sidebar::-webkit-scrollbar {
      width: 8px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 4px;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, #2B6CB0, #4a9eff);
      border-radius: 4px;
      box-shadow: 0 0 6px rgba(43, 108, 176, 0.4);
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, #1e4d7b, #2B6CB0);
      box-shadow: 0 0 8px rgba(43, 108, 176, 0.6);
    }

    /* ── Main content ───────────────────────────── */
    .main-content {
      flex: 1;
      min-width: 0;
      padding: 24px 28px;
      background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
      width: 100%;
    }

    .content-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .content-card:hover {
      box-shadow: 0 8px 24px rgba(43, 108, 176, 0.12);
    }

    .content-card-header {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      color: #fff;
      padding: 20px 28px;
      font-size: 18px;
      font-weight: 800;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 3px solid rgba(255,255,255,0.1);
      letter-spacing: 0.5px;
    }

    .content-card-header i {
      font-size: 22px;
      opacity: 0.95;
    }

    .content-card-body {
      padding: 32px;
      background: #fff;
    }

    /* ── Tables ─────────────────────────────────── */
    .table {
      margin-bottom: 0;
      border-collapse: separate;
      border-spacing: 0;
    }

    .table thead th {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      color: #fff;
      font-weight: 900;
      padding: 18px 14px;
      border: none;
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 1.2px;
      border-bottom: 3px solid rgba(255,255,255,0.15);
      position: relative;
    }

    .table thead th:first-child {
      border-radius: 8px 0 0 0;
    }

    .table thead th:last-child {
      border-radius: 0 8px 0 0;
    }

    .table tbody tr {
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      border-bottom: 1px solid #e8ecf1;
    }

    .table tbody tr:hover {
      background: linear-gradient(90deg, #f0f7ff 0%, #e6f2ff 100%);
      box-shadow: inset 0 0 12px rgba(43, 108, 176, 0.08);
      transform: scale(1.01);
    }

    .table tbody td {
      padding: 16px 14px;
      vertical-align: middle;
      color: #4a5568;
      font-size: 13px;
      font-weight: 500;
    }

    .table tbody tr:last-child {
      border-bottom: none;
    }

    .table tbody tr:last-child td:first-child {
      border-radius: 0 0 0 8px;
    }

    .table tbody tr:last-child td:last-child {
      border-radius: 0 0 8px 0;
    }

    /* ── Table Wrapper ──────────────────────────── */
    .table-responsive {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }

    .table-responsive table {
      margin-bottom: 0;
    }

    /* ── Buttons ─────────────────────────────────── */
    .btn {
      font-weight: 700;
      padding: 10px 18px;
      border-radius: 6px;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-size: 12px;
      border: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      color: #fff;
      box-shadow: 0 4px 12px rgba(43, 108, 176, 0.3);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #1e4d7b 0%, #2B6CB0 100%);
      box-shadow: 0 6px 20px rgba(43, 108, 176, 0.4);
      transform: translateY(-2px);
      color: #fff;
    }

    .btn-success {
      background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
      color: #fff;
      box-shadow: 0 4px 12px rgba(56, 161, 105, 0.3);
    }

    .btn-success:hover {
      background: linear-gradient(135deg, #2f855a 0%, #38a169 100%);
      box-shadow: 0 6px 20px rgba(56, 161, 105, 0.4);
      transform: translateY(-2px);
      color: #fff;
    }

    .btn-warning {
      background: linear-gradient(135deg, #d69e2e 0%, #c05621 100%);
      color: #fff;
      box-shadow: 0 4px 12px rgba(214, 158, 46, 0.3);
    }

    .btn-warning:hover {
      background: linear-gradient(135deg, #c05621 0%, #d69e2e 100%);
      box-shadow: 0 6px 20px rgba(214, 158, 46, 0.4);
      transform: translateY(-2px);
      color: #fff;
    }

    .btn-danger {
      background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
      color: #fff;
      box-shadow: 0 4px 12px rgba(229, 62, 62, 0.3);
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #c53030 0%, #e53e3e 100%);
      box-shadow: 0 6px 20px rgba(229, 62, 62, 0.4);
      transform: translateY(-2px);
      color: #fff;
    }

    .btn-info {
      background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
      color: #fff;
      box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3);
    }

    .btn-info:hover {
      background: linear-gradient(135deg, #2c5aa0 0%, #3182ce 100%);
      box-shadow: 0 6px 20px rgba(49, 130, 206, 0.4);
      transform: translateY(-2px);
      color: #fff;
    }

    /* ── Forms ──────────────────────────────────── */
    .form-control {
      border: 2px solid #e8ecf1;
      border-radius: 8px;
      padding: 12px 16px;
      font-size: 13px;
      transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
      background: #fff;
      font-weight: 500;
    }

    .form-control:focus {
      border-color: #2B6CB0;
      box-shadow: 0 0 0 4px rgba(43, 108, 176, 0.15);
      background: #fff;
      transform: translateY(-2px);
    }

    .form-control::placeholder {
      color: #a0aec0;
      font-weight: 500;
    }

    .form-label {
      font-weight: 800;
      color: #2d3748;
      margin-bottom: 10px;
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-check-input {
      width: 20px;
      height: 20px;
      border: 2px solid #e8ecf1;
      border-radius: 4px;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .form-check-input:checked {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      border-color: #2B6CB0;
    }

    .form-check-input:focus {
      box-shadow: 0 0 0 3px rgba(43, 108, 176, 0.15);
    }

    .form-check-label {
      font-weight: 600;
      color: #4a5568;
      cursor: pointer;
      margin-left: 8px;
    }

    /* ── Alerts ─────────────────────────────────── */
    .alert {
      border: none;
      border-radius: 8px;
      padding: 14px 18px;
      font-weight: 600;
      border-left: 4px solid;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border-left-color: #38a169;
    }

    .alert-danger {
      background: #fef2f2;
      color: #991b1b;
      border-left-color: #e53e3e;
    }

    .alert-warning {
      background: #fffbeb;
      color: #92400e;
      border-left-color: #d69e2e;
    }

    .alert-info {
      background: #f0f9ff;
      color: #0c4a6e;
      border-left-color: #3182ce;
    }

    /* ── Cards ──────────────────────────────────── */
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      overflow: hidden;
    }

    .card:hover {
      box-shadow: 0 8px 24px rgba(43, 108, 176, 0.12);
      transform: translateY(-4px);
    }

    .card-header {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      color: #fff;
      border: none;
      font-weight: 800;
      padding: 16px 20px;
      border-bottom: 2px solid rgba(255,255,255,0.1);
    }

    .card-body {
      padding: 20px;
    }

    /* ── Badges ─────────────────────────────────── */
    .badge {
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: 700;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .badge-primary {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      color: #fff;
    }

    .badge-success {
      background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
      color: #fff;
    }

    .badge-danger {
      background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
      color: #fff;
    }

    .badge-warning {
      background: linear-gradient(135deg, #d69e2e 0%, #c05621 100%);
      color: #fff;
    }

    /* ── Modals ─────────────────────────────────── */
    .modal-content {
      border: none;
      border-radius: 16px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.2);
      overflow: hidden;
    }

    .modal-header {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      color: #fff;
      border: none;
      padding: 24px 28px;
      border-bottom: 3px solid rgba(255,255,255,0.15);
      font-weight: 900;
      font-size: 18px;
      letter-spacing: 0.5px;
    }

    .modal-header .btn-close {
      filter: brightness(0) invert(1);
      opacity: 0.7;
      transition: all 0.2s ease;
    }

    .modal-header .btn-close:hover {
      opacity: 1;
    }

    .modal-body {
      padding: 28px;
      background: #fff;
    }

    .modal-footer {
      border-top: 2px solid #e8ecf1;
      padding: 18px 28px;
      background: linear-gradient(135deg, #f8fafc 0%, #f0f7ff 100%);
      gap: 10px;
    }

    .modal-footer .btn {
      min-width: 100px;
    }

    /* ── Pagination ─────────────────────────────── */
    .school-pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 12px;
    }

    .pagination-list {
      display: flex;
      align-items: center;
      gap: 6px;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .page-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      height: 38px;
      min-width: 38px;
      padding: 0 14px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
      border: 2px solid #e2e8f0;
      color: #4a5568;
      background: #fff;
      user-select: none;
    }

    .page-btn:hover {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      border-color: #2B6CB0;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(43, 108, 176, 0.35);
      text-decoration: none;
    }

    .page-btn.current {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      border-color: #2B6CB0;
      color: #fff;
      box-shadow: 0 4px 12px rgba(43, 108, 176, 0.35);
      transform: scale(1.1);
      cursor: default;
    }

    .page-btn.prev-btn,
    .page-btn.next-btn {
      padding: 0 18px;
      background: #f8fafc;
      border-color: #cbd5e0;
      color: #2B6CB0;
      font-weight: 800;
    }

    .page-btn.prev-btn:hover,
    .page-btn.next-btn:hover {
      background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
      border-color: #2B6CB0;
      color: #fff;
    }

    .page-item.disabled .page-btn {
      opacity: 0.45;
      cursor: not-allowed;
      pointer-events: none;
      transform: none;
      box-shadow: none;
    }

    .page-btn.dots {
      background: transparent;
      border-color: transparent;
      color: #a0aec0;
      cursor: default;
      font-size: 16px;
      letter-spacing: 2px;
      pointer-events: none;
    }

    /* ── Dropdowns ──────────────────────────────── */
    .dropdown-menu {
      border: none;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    .dropdown-item {
      padding: 10px 16px;
      transition: all 0.2s ease;
      font-weight: 600;
    }

    .dropdown-item:hover {
      background: linear-gradient(135deg, #f0f7ff 0%, #e6f2ff 100%);
      color: #2B6CB0;
    }

    .dropdown-divider {
      background: #e8ecf1;
    }

    /* ── Footer ─────────────────────────────────── */
    .site-footer {
      background: #1a2332;
      color: #8899aa;
      text-align: center;
      padding: 14px;
      font-size: 12px;
      border-top: 1px solid rgba(255,255,255,0.05);
    }

    .site-footer a {
      color: #4a9eff;
      text-decoration: none;
    }
  </style>
</head>

<body>

  {{-- ── Header Banner ── --}}
  <div class="site-header">
    <img src="/img/header.jpg" alt="School Management">
  </div>

  {{-- ── Navbar ── --}}
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid px-3">

      <a class="navbar-brand" href="{{ url('/') }}">
        <i class="fas fa-school"></i>School Management
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#mainNav" aria-controls="mainNav"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        {{-- Left links --}}
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active-nav' : '' }}" href="{{ route('dashboard') }}">
              <i class="fas fa-tachometer-alt me-1"></i>Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('students*') ? 'active-nav' : '' }}" href="{{ url('/students') }}">
              <i class="fas fa-user-graduate me-1"></i>Students
            </a>
          </li>
          @if(!auth()->user()->isTeacher())
          <li class="nav-item">
            <a class="nav-link {{ request()->is('teachers*') ? 'active-nav' : '' }}" href="{{ url('/teachers') }}">
              <i class="fas fa-chalkboard-teacher me-1"></i>Teachers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('courses*') ? 'active-nav' : '' }}" href="{{ url('/courses') }}">
              <i class="fas fa-book-open me-1"></i>Courses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('administrators*') ? 'active-nav' : '' }}" href="{{ url('/administrators') }}">
              <i class="fas fa-user-shield me-1"></i>Administrators
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('help') ? 'active-nav' : '' }}" href="{{ route('help') }}">
              <i class="fas fa-book me-1"></i>User Guide
            </a>
          </li>
          @endauth
        </ul>

        {{-- Right: user dropdown --}}
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
               href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle fa-lg"></i>
              <span>{{ auth()->user()->name }}</span>
              <span class="badge bg-light text-dark" style="font-size:10px;">{{ ucfirst(auth()->user()->role) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
              <li>
                <span class="dropdown-item-text text-muted" style="font-size:12px;">
                  {{ auth()->user()->email }}
                </span>
              </li>
              <li><hr class="dropdown-divider my-1"></li>
              <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                  <i class="fas fa-user-cog me-2 text-secondary"></i>Profile
                </a>
              </li>
              <li><hr class="dropdown-divider my-1"></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                  <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
                <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <i class="fas fa-sign-in-alt me-1"></i>Login
            </a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  {{-- ── Page Wrapper (sidebar + content) ── --}}
  <div class="page-wrapper">

    {{-- ── Sidebar ── --}}
    <div class="sidebar">
      <header>
        <i class="fas fa-bars"></i>Menu
      </header>

      @auth
      {{-- User info --}}
      <div class="sidebar-user">
        <div class="user-name">
          <i class="fas fa-circle text-success" style="font-size:8px;"></i>
          {{ auth()->user()->name }}
        </div>
        <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
      </div>

      <div class="sidebar-section-label">
        <i class="fas fa-compass"></i>Navigation
      </div>

      <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active-link' : '' }}">
        <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
      </a>

      <div class="sidebar-divider"></div>
      <div class="sidebar-section-label">
        <i class="fas fa-cube"></i>Modules
      </div>

      <a href="{{ url('/students') }}" class="{{ request()->is('students*') ? 'active-link' : '' }}">
        <i class="fas fa-user-graduate"></i><span>Students</span>
      </a>

      @if(!auth()->user()->isTeacher())
      <a href="{{ url('/teachers') }}" class="{{ request()->is('teachers*') ? 'active-link' : '' }}">
        <i class="fas fa-chalkboard-teacher"></i><span>Teachers</span>
      </a>

      <a href="{{ url('/courses') }}" class="{{ request()->is('courses*') ? 'active-link' : '' }}">
        <i class="fas fa-book-open"></i><span>Courses</span>
      </a>

      <a href="{{ url('/administrators') }}" class="{{ request()->is('administrators*') ? 'active-link' : '' }}">
        <i class="fas fa-user-shield"></i><span>Administrators</span>
      </a>
      @endif

      <a href="{{ route('help') }}" class="{{ request()->routeIs('help') ? 'active-link' : '' }}">
        <i class="fas fa-book"></i><span>User Guide</span>
      </a>

      <div class="sidebar-divider"></div>
      <div class="sidebar-section-label">
        <i class="fas fa-user"></i>Account
      </div>

      <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active-link' : '' }}">
        <i class="fas fa-user-cog"></i><span>Profile</span>
      </a>

      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i><span>Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

      @endauth

      @guest
      <div class="sidebar-section-label">
        <i class="fas fa-home"></i>Options
      </div>

      <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active-link' : '' }}">
        <i class="fas fa-home"></i><span>Home</span>
      </a>

      <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active-link' : '' }}">
        <i class="fas fa-sign-in-alt"></i><span>Login</span>
      </a>
      @endguest
    </div>
    {{-- ── End Sidebar ── --}}

    {{-- ── Main Content ── --}}
    <div class="main-content">
      <div class="content-card">
        <div class="content-card-header">
          <i class="fas fa-circle" style="font-size:8px; opacity:0.6;"></i>
          @yield('title', 'School Management')
        </div>
        <div class="content-card-body">
          @yield('content')
        </div>
      </div>
    </div>
    {{-- ── End Main Content ── --}}

  </div>
  {{-- ── End Page Wrapper ── --}}

  {{-- ── Footer ── --}}
  <footer class="site-footer">
    © {{ date('Y') }} School Management System &mdash; <strong>ATTAR AYOUB</strong>
  </footer>

  <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>
