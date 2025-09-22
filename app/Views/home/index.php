<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1><?= $settings['site_name'] ?? 'Duniaku Network' ?></h1>
            <p class="lead mb-4">Welcome to the ultimate Minecraft server experience!</p>
            <p class="mb-5">Join thousands of players in our custom survival world with unique features and endless adventures.</p>
            <div class="hero-buttons">
                <?php if (!session()->get('is_logged_in')): ?>
                <a href="/auth/register" class="btn btn-minecraft btn-lg me-3">
                    <i class="fas fa-user-plus"></i> Join Now
                </a>
                <a href="/auth/login" class="btn btn-gold btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <?php else: ?>
                <a href="/dashboard" class="btn btn-minecraft btn-lg me-3">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="/shop" class="btn btn-gold btn-lg">
                    <i class="fas fa-shopping-cart"></i> Visit Shop
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Why Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="color: var(--minecraft-green); font-weight: bold;">Why Choose Duniaku Network?</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 h-100">
                    <div class="text-center mb-3">
                        <i class="fas fa-users fa-3x" style="color: var(--minecraft-green);"></i>
                    </div>
                    <h4 class="text-center mb-3" style="color: var(--minecraft-gold);">Active Community</h4>
                    <p class="text-center">Join a thriving community of passionate Minecraft players who share your love for adventure and creativity.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 h-100">
                    <div class="text-center mb-3">
                        <i class="fas fa-shield-alt fa-3x" style="color: var(--minecraft-green);"></i>
                    </div>
                    <h4 class="text-center mb-3" style="color: var(--minecraft-gold);">Safe & Secure</h4>
                    <p class="text-center">Experience worry-free gameplay with our advanced anti-griefing protection and professional moderation team.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card p-4 h-100">
                    <div class="text-center mb-3">
                        <i class="fas fa-rocket fa-3x" style="color: var(--minecraft-green);"></i>
                    </div>
                    <h4 class="text-center mb-3" style="color: var(--minecraft-gold);">High Performance</h4>
                    <p class="text-center">Enjoy lag-free gaming on our premium servers with 99.9% uptime and dedicated hardware.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How Section -->
<section class="py-5" style="background-color: var(--minecraft-darker);">
    <div class="container">
        <h2 class="text-center mb-5" style="color: var(--minecraft-green); font-weight: bold;">How to Get Started</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-pill" style="font-size: 2rem; padding: 1rem;">1</span>
                    </div>
                    <h4 style="color: var(--minecraft-gold);">Create Account</h4>
                    <p>Register with your in-game username to get started on your adventure.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-pill" style="font-size: 2rem; padding: 1rem;">2</span>
                    </div>
                    <h4 style="color: var(--minecraft-gold);">Join Server</h4>
                    <p>Connect to our Minecraft server and explore our unique survival world.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-success rounded-pill" style="font-size: 2rem; padding: 1rem;">3</span>
                    </div>
                    <h4 style="color: var(--minecraft-gold);">Start Playing</h4>
                    <p>Begin your journey, make friends, and create amazing builds!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What Section - Server Features -->
<?php if (!empty($features)): ?>
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5" style="color: var(--minecraft-green); font-weight: bold;">What We Offer</h2>
        <div class="row">
            <?php foreach (array_slice($features, 0, 3) as $feature): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 feature-card">
                    <img src="<?= $feature['image'] ?>" class="card-img-top" alt="<?= esc($feature['title']) ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title" style="color: var(--minecraft-gold);"><?= esc($feature['title']) ?></h5>
                        <p class="card-text"><?= esc($feature['description']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="/features" class="btn btn-minecraft">
                <i class="fas fa-star"></i> View All Features
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action -->
<section class="py-5" style="background: linear-gradient(135deg, var(--minecraft-green), var(--minecraft-gold));">
    <div class="container text-center">
        <h2 class="mb-4" style="color: var(--minecraft-dark); font-weight: bold;">Ready to Begin Your Adventure?</h2>
        <p class="lead mb-4" style="color: var(--minecraft-dark);">Join our community today and discover what makes Duniaku Network special!</p>
        <?php if (!session()->get('is_logged_in')): ?>
        <a href="/auth/register" class="btn btn-dark btn-lg me-3">
            <i class="fas fa-user-plus"></i> Register Now
        </a>
        <a href="/community" class="btn btn-outline-dark btn-lg">
            <i class="fab fa-discord"></i> Join Discord
        </a>
        <?php else: ?>
        <a href="/shop" class="btn btn-dark btn-lg me-3">
            <i class="fas fa-shopping-cart"></i> Visit Shop
        </a>
        <a href="/community" class="btn btn-outline-dark btn-lg">
            <i class="fab fa-discord"></i> Join Discord
        </a>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>