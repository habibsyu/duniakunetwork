<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Duniaku Network' ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $settings['favicon'] ?? '' ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --minecraft-dark: #1a1a1a;
            --minecraft-darker: #0f0f0f;
            --minecraft-green: #00ff41;
            --minecraft-gold: #ffaa00;
            --minecraft-blue: #5555ff;
            --minecraft-gray: #555555;
            --minecraft-light-gray: #aaaaaa;
            --minecraft-border: #333333;
        }

        body {
            background-color: var(--minecraft-dark);
            color: var(--minecraft-light-gray);
            font-family: 'Courier New', monospace;
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--minecraft-darker) !important;
            border-bottom: 2px solid var(--minecraft-border);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand, .nav-link {
            color: var(--minecraft-light-gray) !important;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .nav-link:hover {
            color: var(--minecraft-green) !important;
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .btn-minecraft {
            background: linear-gradient(45deg, var(--minecraft-green), #00cc33);
            border: 2px solid var(--minecraft-green);
            color: var(--minecraft-dark);
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(0, 255, 65, 0.3);
            transition: all 0.3s ease;
        }

        .btn-minecraft:hover {
            background: linear-gradient(45deg, #00cc33, var(--minecraft-green));
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 255, 65, 0.5);
            color: var(--minecraft-dark);
        }

        .btn-gold {
            background: linear-gradient(45deg, var(--minecraft-gold), #cc8800);
            border: 2px solid var(--minecraft-gold);
            color: var(--minecraft-dark);
            font-weight: bold;
        }

        .btn-gold:hover {
            background: linear-gradient(45deg, #cc8800, var(--minecraft-gold));
            transform: translateY(-3px);
            color: var(--minecraft-dark);
        }

        .card {
            background-color: var(--minecraft-darker);
            border: 2px solid var(--minecraft-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            border-color: var(--minecraft-green);
        }

        .card-header {
            background-color: var(--minecraft-gray);
            border-bottom: 2px solid var(--minecraft-border);
            color: var(--minecraft-green);
            font-weight: bold;
            text-transform: uppercase;
        }

        .form-control {
            background-color: var(--minecraft-dark);
            border: 2px solid var(--minecraft-border);
            color: var(--minecraft-light-gray);
        }

        .form-control:focus {
            background-color: var(--minecraft-dark);
            border-color: var(--minecraft-green);
            color: var(--minecraft-light-gray);
            box-shadow: 0 0 0 0.25rem rgba(0, 255, 65, 0.25);
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= $settings['banner'] ?? '' ?>');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: bold;
            color: var(--minecraft-green);
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            margin-bottom: 2rem;
        }

        .hero-content p {
            font-size: 1.5rem;
            color: var(--minecraft-light-gray);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .feature-card {
            background: linear-gradient(135deg, var(--minecraft-darker), var(--minecraft-gray));
            border: 2px solid var(--minecraft-border);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--minecraft-green), var(--minecraft-gold), var(--minecraft-blue));
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 255, 65, 0.3);
        }

        .alert {
            border: 2px solid;
            border-radius: 8px;
            font-weight: bold;
        }

        .alert-success {
            background-color: rgba(0, 255, 65, 0.1);
            border-color: var(--minecraft-green);
            color: var(--minecraft-green);
        }

        .alert-danger {
            background-color: rgba(255, 0, 0, 0.1);
            border-color: #ff0000;
            color: #ff5555;
        }

        .footer {
            background-color: var(--minecraft-darker);
            border-top: 2px solid var(--minecraft-border);
            color: var(--minecraft-light-gray);
            padding: 3rem 0 1rem;
            margin-top: 5rem;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1.2rem;
            }
            
            .navbar-nav {
                text-align: center;
            }
        }

        .minecraft-table {
            background-color: var(--minecraft-darker);
            border: 2px solid var(--minecraft-border);
        }

        .minecraft-table th {
            background-color: var(--minecraft-gray);
            color: var(--minecraft-green);
            border-color: var(--minecraft-border);
            text-transform: uppercase;
            font-weight: bold;
        }

        .minecraft-table td {
            background-color: var(--minecraft-dark);
            color: var(--minecraft-light-gray);
            border-color: var(--minecraft-border);
        }

        .minecraft-table tbody tr:hover {
            background-color: rgba(0, 255, 65, 0.1);
        }

        .status-pending {
            color: var(--minecraft-gold);
            font-weight: bold;
        }

        .status-approved {
            color: var(--minecraft-green);
            font-weight: bold;
        }

        .status-rejected {
            color: #ff5555;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="<?= $settings['logo'] ?? '' ?>" alt="Logo" height="40" class="d-inline-block align-text-top me-2">
                <?= $settings['site_name'] ?? 'Duniaku Network' ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/features"><i class="fas fa-star"></i> Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin-info"><i class="fas fa-users"></i> Staff</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/community"><i class="fab fa-discord"></i> Community</a>
                    </li>
                    <?php if (session()->get('is_logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/shop"><i class="fas fa-shopping-cart"></i> Shop</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('is_logged_in')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <?php if (session()->get('role_id') <= 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin"><i class="fas fa-cog"></i> Admin</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/logout"><i class="fas fa-sign-out-alt"></i> Logout (<?= session()->get('username_in_game') ?>)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/login"><i class="fas fa-sign-in-alt"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/register"><i class="fas fa-user-plus"></i> Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>

    <footer class="footer">
        <div class="container text-center">
            <p>&copy; 2025 <?= $settings['site_name'] ?? 'Duniaku Network' ?>. All rights reserved.</p>
            <p>Experience the ultimate Minecraft adventure!</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>