<x-guest-layout>

<style>
  /* ── Login Page Styles ── */
  .login-wrapper {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  /* Info button */
  .test-accounts-btn {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
    color: #fff;
    border: none;
    font-size: 22px;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(43, 108, 176, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 9999;
    animation: pulse-btn 2s infinite;
  }

  .test-accounts-btn:hover {
    transform: scale(1.15);
    box-shadow: 0 8px 24px rgba(43, 108, 176, 0.6);
  }

  @keyframes pulse-btn {
    0%, 100% { box-shadow: 0 4px 16px rgba(43, 108, 176, 0.5); }
    50%       { box-shadow: 0 4px 28px rgba(43, 108, 176, 0.9); }
  }

  /* Tooltip label */
  .test-accounts-btn::before {
    content: 'Test Accounts';
    position: absolute;
    right: 60px;
    background: #1a202c;
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 6px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
    letter-spacing: 0.5px;
  }

  .test-accounts-btn:hover::before {
    opacity: 1;
  }

  /* Modal overlay */
  .modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    padding: 20px;
  }

  .modal-overlay.active {
    display: flex;
  }

  /* Modal box */
  .modal-box {
    background: #fff;
    border-radius: 16px;
    width: 100%;
    max-width: 520px;
    box-shadow: 0 25px 60px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  @keyframes slideUp {
    from { transform: translateY(40px); opacity: 0; }
    to   { transform: translateY(0);    opacity: 1; }
  }

  /* Modal header */
  .modal-head {
    background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .modal-head-left {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .modal-head-icon {
    width: 44px;
    height: 44px;
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #fff;
  }

  .modal-head h2 {
    color: #fff;
    font-size: 18px;
    font-weight: 800;
    margin: 0;
    letter-spacing: 0.3px;
  }

  .modal-head p {
    color: rgba(255,255,255,0.75);
    font-size: 12px;
    margin: 2px 0 0 0;
  }

  .modal-close {
    background: rgba(255,255,255,0.15);
    border: none;
    color: #fff;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
  }

  .modal-close:hover {
    background: rgba(255,255,255,0.3);
  }

  /* Warning banner */
  .modal-warning {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border-left: 4px solid #d69e2e;
    padding: 14px 20px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin: 0;
  }

  .modal-warning i {
    color: #d69e2e;
    font-size: 18px;
    margin-top: 1px;
    flex-shrink: 0;
  }

  .modal-warning p {
    color: #92400e;
    font-size: 12px;
    font-weight: 600;
    margin: 0;
    line-height: 1.5;
  }

  /* Modal body */
  .modal-body {
    padding: 24px 28px;
    max-height: 380px;
    overflow-y: auto;
  }

  /* Account card */
  .account-card {
    border: 2px solid #e8ecf1;
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
  }

  .account-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    border-radius: 4px 0 0 4px;
  }

  .account-card.admin::before   { background: linear-gradient(180deg, #2B6CB0, #4a9eff); }
  .account-card.teacher::before { background: linear-gradient(180deg, #38a169, #68d391); }

  .account-card:hover {
    border-color: #2B6CB0;
    box-shadow: 0 4px 16px rgba(43, 108, 176, 0.12);
    transform: translateY(-2px);
  }

  .account-card:hover .copy-hint {
    opacity: 1;
  }

  .account-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
  }

  .account-role {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .role-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
  }

  .role-icon.admin   { background: #EBF8FF; color: #2B6CB0; }
  .role-icon.teacher { background: #F0FFF4; color: #38a169; }

  .role-name {
    font-weight: 800;
    font-size: 14px;
    color: #1a202c;
  }

  .role-desc {
    font-size: 11px;
    color: #718096;
    margin-top: 1px;
  }

  .copy-hint {
    font-size: 10px;
    color: #a0aec0;
    opacity: 0;
    transition: opacity 0.2s;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .account-creds {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
  }

  .cred-item {
    background: #f8fafc;
    border-radius: 6px;
    padding: 8px 10px;
  }

  .cred-label {
    font-size: 9px;
    color: #a0aec0;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 700;
    margin-bottom: 2px;
  }

  .cred-value {
    font-size: 12px;
    color: #2d3748;
    font-weight: 700;
    font-family: 'Courier New', monospace;
  }

  /* Fill button */
  .fill-btn {
    width: 100%;
    margin-top: 8px;
    padding: 8px;
    background: linear-gradient(135deg, #2B6CB0 0%, #1e4d7b 100%);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: none;
  }

  .account-card:hover .fill-btn {
    display: block;
  }

  .fill-btn:hover {
    opacity: 0.9;
  }

  /* Footer */
  .modal-footer {
    padding: 16px 28px;
    background: #f8fafc;
    border-top: 1px solid #e8ecf1;
    text-align: center;
    font-size: 11px;
    color: #a0aec0;
    font-weight: 600;
  }
</style>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}" id="loginForm">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <x-primary-button class="ms-3">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</form>

{{-- ── Test Accounts Button (floating) ── --}}
<button class="test-accounts-btn" onclick="openModal()" title="Test Accounts">
    <i class="fas fa-info"></i>
</button>

{{-- ── Test Accounts Modal ── --}}
<div class="modal-overlay" id="testModal" onclick="closeOnOverlay(event)">
    <div class="modal-box">

        {{-- Header --}}
        <div class="modal-head">
            <div class="modal-head-left">
                <div class="modal-head-icon">
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <h2>Test Accounts</h2>
                    <p>Click any account to auto-fill the login form</p>
                </div>
            </div>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- Warning Banner --}}
        <div class="modal-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <p>
                <strong>⚠ FOR TESTING PURPOSES ONLY</strong><br>
                These credentials are for demonstration only. Do not use in production.
                Each role has different access levels and permissions.
            </p>
        </div>

        {{-- Body --}}
        <div class="modal-body">

            {{-- Admin Account --}}
            <div class="account-card admin" onclick="fillLogin('admin@school.com', 'admin123')">
                <div class="account-top">
                    <div class="account-role">
                        <div class="role-icon admin">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <div class="role-name">Administrator</div>
                            <div class="role-desc">Full access — manage everything</div>
                        </div>
                    </div>
                    <span class="copy-hint"><i class="fas fa-mouse-pointer"></i> Click to fill</span>
                </div>
                <div class="account-creds">
                    <div class="cred-item">
                        <div class="cred-label">Email</div>
                        <div class="cred-value">admin@school.com</div>
                    </div>
                    <div class="cred-item">
                        <div class="cred-label">Password</div>
                        <div class="cred-value">admin123</div>
                    </div>
                </div>
                <button class="fill-btn">
                    <i class="fas fa-sign-in-alt"></i> Use This Account
                </button>
            </div>

            {{-- Teacher 2 --}}
            <div class="account-card teacher" onclick="fillLogin('fatima.zahra@school.com', 'teacher123')">
                <div class="account-top">
                    <div class="account-role">
                        <div class="role-icon teacher">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <div class="role-name">Teacher — Fatima Zahra</div>
                            <div class="role-desc">Physics — View students & schedule only</div>
                        </div>
                    </div>
                    <span class="copy-hint"><i class="fas fa-mouse-pointer"></i> Click to fill</span>
                </div>
                <div class="account-creds">
                    <div class="cred-item">
                        <div class="cred-label">Email</div>
                        <div class="cred-value">fatima.zahra@school.com</div>
                    </div>
                    <div class="cred-item">
                        <div class="cred-label">Password</div>
                        <div class="cred-value">teacher123</div>
                    </div>
                </div>
                <button class="fill-btn">
                    <i class="fas fa-sign-in-alt"></i> Use This Account
                </button>
            </div>

            {{-- Teacher 3 --}}
            <div class="account-card teacher" onclick="fillLogin('youssef.alami@school.com', 'teacher123')">
                <div class="account-top">
                    <div class="account-role">
                        <div class="role-icon teacher">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
                            <div class="role-name">Teacher — Youssef Alami</div>
                            <div class="role-desc">French — View students & schedule only</div>
                        </div>
                    </div>
                    <span class="copy-hint"><i class="fas fa-mouse-pointer"></i> Click to fill</span>
                </div>
                <div class="account-creds">
                    <div class="cred-item">
                        <div class="cred-label">Email</div>
                        <div class="cred-value">youssef.alami@school.com</div>
                    </div>
                    <div class="cred-item">
                        <div class="cred-label">Password</div>
                        <div class="cred-value">teacher123</div>
                    </div>
                </div>
                <button class="fill-btn">
                    <i class="fas fa-sign-in-alt"></i> Use This Account
                </button>
            </div>

        </div>

        {{-- Footer --}}
        <div class="modal-footer">
            <i class="fas fa-lock me-1"></i>
            All passwords are hashed and stored securely &mdash; School Management System
        </div>

    </div>
</div>

{{-- FontAwesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    function openModal() {
        document.getElementById('testModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('testModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function closeOnOverlay(e) {
        if (e.target === document.getElementById('testModal')) {
            closeModal();
        }
    }

    function fillLogin(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
        closeModal();

        // Flash effect on form
        const form = document.getElementById('loginForm');
        form.style.transition = 'all 0.3s ease';
        form.style.boxShadow = '0 0 0 3px rgba(43, 108, 176, 0.3)';
        form.style.borderRadius = '8px';
        setTimeout(() => {
            form.style.boxShadow = '';
            form.style.borderRadius = '';
        }, 1500);
    }

    // Open modal with keyboard shortcut (?)
    document.addEventListener('keydown', function(e) {
        if (e.key === '?' || (e.key === 'i' && e.ctrlKey)) {
            openModal();
        }
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>

</x-guest-layout>
