<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
                </div>
                <div class="card-body">
                    <?= form_open('/auth/login') ?>
                        <div class="mb-3">
                            <label for="username_in_game" class="form-label">Username in Game</label>
                            <input type="text" class="form-control" id="username_in_game" name="username_in_game" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-minecraft">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                    <?= form_close() ?>
                    
                    <hr>
                    <div class="text-center">
                        <p>Don't have an account? <a href="/auth/register" style="color: var(--minecraft-green);">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>