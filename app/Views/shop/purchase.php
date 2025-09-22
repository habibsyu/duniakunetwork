<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h3><i class="fas fa-shopping-cart"></i> Purchase <?= esc($shop_item['item_name']) ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="color: var(--minecraft-gold);">Item Details</h5>
                            <table class="table minecraft-table">
                                <tr>
                                    <td><strong>Item Name:</strong></td>
                                    <td><?= esc($shop_item['item_name']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td><?= esc($shop_item['description']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Type:</strong></td>
                                    <td><?= ucwords(str_replace('_', ' ', $shop_item['type'])) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Price:</strong></td>
                                    <td><h4 style="color: var(--minecraft-green);">Rp <?= number_format($shop_item['price'], 0, ',', '.') ?></h4></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6 text-center">
                            <h5 style="color: var(--minecraft-gold);">Scan QRIS to Pay</h5>
                            <?php if (!empty($settings['qris_image'])): ?>
                            <img src="<?= $settings['qris_image'] ?>" alt="QRIS Payment" class="img-fluid mb-3" style="max-width: 250px; border: 2px solid var(--minecraft-border); border-radius: 10px;">
                            <?php endif; ?>
                            
                            <div class="alert alert-warning">
                                <small><i class="fas fa-exclamation-triangle"></i> Make sure to pay exactly <strong>Rp <?= number_format($shop_item['price'], 0, ',', '.') ?></strong></small>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h5 style="color: var(--minecraft-gold);">Upload Payment Proof</h5>
                    <?= form_open_multipart('/shop/purchase/' . $shop_item['id']) ?>
                        <div class="mb-3">
                            <label for="proof_image" class="form-label">Payment Proof Image</label>
                            <input type="file" class="form-control" id="proof_image" name="proof_image" accept="image/*" required>
                            <small class="form-text text-muted">Upload a clear screenshot of your payment confirmation.</small>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="confirm_payment" required>
                                <label class="form-check-label" for="confirm_payment">
                                    I confirm that I have paid <strong>Rp <?= number_format($shop_item['price'], 0, ',', '.') ?></strong> for this item and uploaded a valid payment proof.
                                </label>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/shop" class="btn btn-outline-light">
                                <i class="fas fa-arrow-left"></i> Back to Shop
                            </a>
                            <button type="submit" class="btn btn-minecraft">
                                <i class="fas fa-upload"></i> Submit Payment Proof
                            </button>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-body">
                    <h6 style="color: var(--minecraft-green);"><i class="fas fa-info-circle"></i> Important Notes:</h6>
                    <ul class="small">
                        <li>Your payment will be verified by our admin team within 1-24 hours</li>
                        <li>Items will be delivered directly to your in-game account: <strong><?= session()->get('username_in_game') ?></strong></li>
                        <li>Make sure your in-game username is correct before purchasing</li>
                        <li>Contact our support team if you have any issues</li>
                        <li>Refunds are only available for technical issues on our end</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>