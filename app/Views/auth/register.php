<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3><i class="fas fa-user-plus"></i> Register</h3>
                </div>
                <div class="card-body">
                    <?= form_open('/auth/register') ?>
                        <div class="mb-3">
                            <label for="username_in_game" class="form-label">Username in Game</label>
                            <input type="text" class="form-control" id="username_in_game" name="username_in_game" required>
                            <small class="form-text text-muted">This should match your Minecraft username exactly.</small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email (Optional)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8">
                            <small class="form-text text-muted">Minimum 8 characters.</small>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-minecraft" onclick="return confirmUsername()">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </div>
                    <?= form_close() ?>
                    
                    <hr>
                    <div class="text-center">
                        <p>Already have an account? <a href="/auth/login" style="color: var(--minecraft-green);">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmUsername() {
    const username = document.getElementById('username_in_game').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return false;
    }
    
    return confirm(`Apakah username "${username}" sesuai dengan in-game username Anda? Pastikan username ini benar karena akan digunakan untuk memberikan item in-game.`);
}
</script>
<?= $this->endSection() ?>