<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h2 style="color: var(--minecraft-green); font-weight: bold;">
                <i class="fas fa-shopping-cart"></i> Duniaku Network Shop
            </h2>
            <p class="lead">Enhance your gameplay with premium items and features!</p>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($shop_items)): ?>
            <?php foreach ($shop_items as $item): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 feature-card">
                    <div class="card-header text-center">
                        <?php
                        $icon = match($item['type']) {
                            'money_coin' => 'fas fa-coins',
                            'battle_pass' => 'fas fa-trophy',
                            'gacha_key' => 'fas fa-key',
                            default => 'fas fa-gift'
                        };
                        $color = match($item['type']) {
                            'money_coin' => 'var(--minecraft-gold)',
                            'battle_pass' => 'var(--minecraft-green)',
                            'gacha_key' => 'var(--minecraft-blue)',
                            default => 'var(--minecraft-light-gray)'
                        };
                        ?>
                        <i class="<?= $icon ?> fa-3x mb-2" style="color: <?= $color ?>;"></i>
                        <h5 style="color: var(--minecraft-gold);"><?= esc($item['item_name']) ?></h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="flex-grow-1"><?= esc($item['description']) ?></p>
                        <div class="mt-auto">
                            <div class="text-center mb-3">
                                <h4 style="color: var(--minecraft-green);">
                                    Rp <?= number_format($item['price'], 0, ',', '.') ?>
                                </h4>
                            </div>
                            <div class="d-grid">
                                <a href="/shop/purchase/<?= $item['id'] ?>" class="btn btn-minecraft">
                                    <i class="fas fa-shopping-cart"></i> Purchase Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-exclamation-triangle fa-4x mb-3" style="color: var(--minecraft-gold);"></i>
                        <h5>No Items Available</h5>
                        <p>The shop is currently empty. Please check back later!</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Payment Information -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Payment Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 style="color: var(--minecraft-gold);">How to Purchase:</h5>
                            <ol>
                                <li>Select the item you want to purchase</li>
                                <li>Click "Purchase Now" to proceed</li>
                                <li>Scan the QRIS code with your banking app</li>
                                <li>Upload proof of payment</li>
                                <li>Wait for admin verification</li>
                                <li>Items will be delivered to your in-game account</li>
                            </ol>
                            <div class="alert alert-info mt-3">
                                <i class="fas fa-clock"></i> <strong>Processing Time:</strong> Payments are typically processed within 1-24 hours during business hours.
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <?php if (!empty($settings['qris_image'])): ?>
                            <h6 style="color: var(--minecraft-green);">QRIS Payment:</h6>
                            <img src="<?= $settings['qris_image'] ?>" alt="QRIS Payment" class="img-fluid" style="max-width: 200px; border: 2px solid var(--minecraft-border); border-radius: 10px;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>