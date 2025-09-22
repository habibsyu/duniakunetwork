<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2 style="color: var(--minecraft-green); font-weight: bold;">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </h2>
            <p class="lead">Welcome back, <?= session()->get('username_in_game') ?>!</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-server fa-2x mb-3" style="color: var(--minecraft-green);"></i>
                    <h5>Server Status</h5>
                    <span class="badge bg-success">Online</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-2x mb-3" style="color: var(--minecraft-gold);"></i>
                    <h5>Players Online</h5>
                    <h4 style="color: var(--minecraft-green);">127</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-receipt fa-2x mb-3" style="color: var(--minecraft-blue);"></i>
                    <h5>Your Transactions</h5>
                    <h4 style="color: var(--minecraft-green);"><?= count($payments) ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-2x mb-3" style="color: var(--minecraft-gold);"></i>
                    <h5>Quick Shop</h5>
                    <a href="/shop" class="btn btn-minecraft btn-sm">Visit Shop</a>
                </div>
            </div>
        </div>
    </div>

    <!-- News & Events -->
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-newspaper"></i> Latest News & Events
                </div>
                <div class="card-body">
                    <div class="mb-3 p-3" style="border-left: 4px solid var(--minecraft-green); background-color: rgba(0, 255, 65, 0.1);">
                        <h5 style="color: var(--minecraft-gold);">New Battle Pass Season!</h5>
                        <p class="mb-1">Season 5 is now live with amazing rewards and challenges!</p>
                        <small class="text-muted">2 days ago</small>
                    </div>
                    <div class="mb-3 p-3" style="border-left: 4px solid var(--minecraft-blue); background-color: rgba(85, 85, 255, 0.1);">
                        <h5 style="color: var(--minecraft-gold);">Server Upgrade Complete</h5>
                        <p class="mb-1">Our servers have been upgraded for better performance and reduced lag!</p>
                        <small class="text-muted">1 week ago</small>
                    </div>
                    <div class="p-3" style="border-left: 4px solid var(--minecraft-gold); background-color: rgba(255, 170, 0, 0.1);">
                        <h5 style="color: var(--minecraft-gold);">Community Event Weekend</h5>
                        <p class="mb-1">Join our building contest this weekend for amazing prizes!</p>
                        <small class="text-muted">2 weeks ago</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Quick Links
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="/shop" class="btn btn-minecraft btn-sm">
                            <i class="fas fa-shopping-cart"></i> Visit Shop
                        </a>
                        <a href="/features" class="btn btn-gold btn-sm">
                            <i class="fas fa-star"></i> Server Features
                        </a>
                        <a href="/community" class="btn btn-outline-light btn-sm">
                            <i class="fab fa-discord"></i> Join Discord
                        </a>
                        <a href="/admin-info" class="btn btn-outline-light btn-sm">
                            <i class="fas fa-users"></i> Contact Staff
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History -->
    <?php if (!empty($payments)): ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-history"></i> Your Transaction History
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table minecraft-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Proof</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= esc($payment['item_name']) ?></td>
                                    <td>Rp <?= number_format($payment['amount'], 0, ',', '.') ?></td>
                                    <td>
                                        <span class="status-<?= $payment['status'] ?>">
                                            <?= ucfirst($payment['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y H:i', strtotime($payment['created_at'])) ?></td>
                                    <td>
                                        <?php if ($payment['proof_image']): ?>
                                        <a href="/uploads/payment_proofs/<?= $payment['proof_image'] ?>" target="_blank" class="btn btn-sm btn-outline-light">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-4x mb-3" style="color: var(--minecraft-gray);"></i>
                    <h5>No Transactions Yet</h5>
                    <p>Start shopping to see your transaction history here!</p>
                    <a href="/shop" class="btn btn-minecraft">
                        <i class="fas fa-shopping-cart"></i> Visit Shop
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>