<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('settings.site_title', 'Center Hub') }} - Your All-in-One Tool Platform</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: rgb(6, 46, 90);
            --secondary-color: rgb(8, 60, 110);
            --accent-color: #f97316;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.8s ease-out;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            opacity: 0.95;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease-out 0.2s;
            animation-fill-mode: both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tools Section */
        .tools-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .tool-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            height: 100%;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .tool-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .tool-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .tool-icon.bg-success {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .tool-icon.bg-info {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
        }

        .tool-icon.bg-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .tool-icon.bg-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .tool-icon.bg-secondary {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        /* Pricing Section */
        .pricing-section {
            padding: 80px 0;
        }

        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            height: 100%;
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
            position: relative;
            overflow: hidden;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.highlighted {
            border-color: var(--primary-color);
            box-shadow: 0 10px 30px rgba(65, 84, 241, 0.2);
        }

        .pricing-card.highlighted::before {
            content: 'Most Popular';
            position: absolute;
            top: 20px;
            right: -35px;
            background: var(--accent-color);
            color: white;
            padding: 5px 40px;
            transform: rotate(45deg);
            font-size: 0.75rem;
            font-weight: 600;
        }

        .price {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 1rem 0;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .feature-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .feature-list li:last-child {
            border-bottom: none;
        }

        .feature-list li i {
            color: #10b981;
            margin-right: 10px;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .btn-custom {
            padding: 15px 40px;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom-primary {
            background: white;
            color: var(--primary-color);
            border: none;
        }

        .btn-custom-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: var(--primary-color);
        }

        .btn-custom-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-custom-outline:hover {
            background: white;
            color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            padding: 40px 0 20px;
        }

        .footer a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .price {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="mdi mdi-cube-outline text-primary"></i>
                {{ config('settings.site_title', 'Center Hub') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#tools">Tools</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4 ms-2" href="{{ route('login') }}">
                            Get Started
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h1 class="hero-title">All Your Tools in One Place</h1>
                    <p class="hero-subtitle">
                        Subscribe to powerful business tools and manage everything from a single platform.
                        Save time, reduce costs, and boost productivity.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#pricing" class="btn btn-custom btn-custom-primary">
                            View Pricing <i class="mdi mdi-arrow-right ms-2"></i>
                        </a>
                        <a href="#tools" class="btn btn-custom btn-custom-outline">
                            Explore Tools
                        </a>
                    </div>
                    <div class="mt-4">
                        <small class="opacity-75">
                            <i class="mdi mdi-check-circle me-2"></i>No credit card required
                            <i class="mdi mdi-check-circle ms-3 me-2"></i>Cancel anytime
                            <i class="mdi mdi-check-circle ms-3 me-2"></i>14-day free trial
                        </small>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <i class="mdi mdi-application text-white" style="font-size: 20rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Tools Section -->
    <section id="tools" class="tools-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Powerful Tools for Your Business</h2>
                <p class="lead text-muted">Choose from our collection of professional tools designed to streamline your workflow</p>
            </div>
            <div class="row g-4">
                @foreach($tools as $tool)
                <div class="col-lg-4 col-md-6">
                    <div class="tool-card">
                        <div class="tool-icon bg-{{ $tool['color'] }}">
                            <i class="mdi {{ $tool['icon'] }}"></i>
                        </div>
                        <h4 class="fw-bold mb-3">{{ $tool['name'] }}</h4>
                        <p class="text-muted mb-4">{{ $tool['description'] }}</p>
                        <div class="mb-3">
                            @foreach($tool['features'] as $feature)
                            <span class="badge bg-light text-dark me-2 mb-2">
                                <i class="mdi mdi-check-circle text-success me-1"></i>{{ $feature }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Choose Your Plan</h2>
                <p class="lead text-muted">Flexible pricing for teams of all sizes. Start free, upgrade as you grow.</p>
            </div>
            <div class="row g-4">
                @foreach($plans as $plan)
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card {{ $plan['highlighted'] ? 'highlighted' : '' }}">
                        <h3 class="fw-bold mb-2">{{ $plan['name'] }}</h3>
                        <p class="text-muted mb-4">{{ $plan['description'] }}</p>
                        <div class="price">
                            ${{ $plan['price'] }}
                            <small class="text-muted fs-6">/{{ $plan['period'] }}</small>
                        </div>
                        <ul class="feature-list">
                            @foreach($plan['features'] as $feature)
                            <li>
                                <i class="mdi mdi-check-circle"></i>
                                {{ $feature }}
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('login') }}" class="btn btn-{{ $plan['color'] }} w-100 rounded-pill btn-lg">
                            Get Started
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <p class="text-muted">Need a custom plan? <a href="{{ route('login') }}" class="text-primary fw-semibold">Contact us</a></p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 fw-bold mb-4">Ready to Get Started?</h2>
                    <p class="lead mb-4">Join thousands of teams already using our platform to manage their tools efficiently.</p>
                    <a href="{{ route('login') }}" class="btn btn-custom btn-custom-primary btn-lg">
                        Start Free Trial <i class="mdi mdi-arrow-right ms-2"></i>
                    </a>
                    <div class="mt-4">
                        <small class="opacity-75">
                            <i class="mdi mdi-shield-check me-2"></i>Secure & Reliable
                            <i class="mdi mdi-clock ms-3 me-2"></i>24/7 Support
                            <i class="mdi mdi-chart-line ms-3 me-2"></i>99.9% Uptime
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold mb-3">{{ config('settings.site_title', 'Center Hub') }}</h5>
                    <p class="text-muted">Your all-in-one platform for business tools and subscriptions.</p>
                    <div class="mt-3">
                        <a href="#" class="me-3"><i class="mdi mdi-facebook fs-4"></i></a>
                        <a href="#" class="me-3"><i class="mdi mdi-twitter fs-4"></i></a>
                        <a href="#" class="me-3"><i class="mdi mdi-linkedin fs-4"></i></a>
                        <a href="#"><i class="mdi mdi-instagram fs-4"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Product</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#tools">Tools</a></li>
                        <li class="mb-2"><a href="#pricing">Pricing</a></li>
                        <li class="mb-2"><a href="#">Features</a></li>
                        <li class="mb-2"><a href="#">Updates</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">About</a></li>
                        <li class="mb-2"><a href="#">Blog</a></li>
                        <li class="mb-2"><a href="#">Careers</a></li>
                        <li class="mb-2"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Help Center</a></li>
                        <li class="mb-2"><a href="#">Documentation</a></li>
                        <li class="mb-2"><a href="#">API</a></li>
                        <li class="mb-2"><a href="#">Status</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold mb-3">Legal</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Privacy</a></li>
                        <li class="mb-2"><a href="#">Terms</a></li>
                        <li class="mb-2"><a href="#">Security</a></li>
                        <li class="mb-2"><a href="#">Compliance</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 opacity-25">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">
                        Copyright © {{ date('Y') }} {{ config('settings.site_title', 'Center Hub') }}. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <p class="mb-0">
                        Design & Developed By <a href="https://itclanbd.com" target="_blank"
                                                  rel="noopener noreferrer"
                                                  class="text-white fw-semibold">ITclan BD</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Smooth Scroll -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>

