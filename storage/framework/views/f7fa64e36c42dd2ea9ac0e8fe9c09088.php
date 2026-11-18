<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Student Profile Management System</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/theme.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/auth.css')); ?>">
</head>
<body class="auth-page">

<div class="auth-container <?php echo e(old('form') === 'register' ? 'right-active' : ''); ?>" id="container">

    
    <div class="form-container sign-up">
        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="form" value="register">
            <h1>Create account</h1>
            <p class="sub">Start managing student profiles</p>

            <?php if($errors->register->any()): ?>
                <div class="alert alert-error">
                    <?php $__currentLoopData = $errors->register->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <input type="text" name="name" placeholder="Full name" value="<?php echo e(old('name')); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo e(old('form') === 'register' ? old('email') : ''); ?>" required>
            <input type="password" name="password" placeholder="Password (8+ characters, letters and numbers)" required>
            <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            <button type="submit" data-loading="Creating account...">Sign up</button>
            <p class="mobile-switch">Already have an account?
                <a onclick="document.getElementById('container').classList.remove('right-active')">Sign in</a>
            </p>
        </form>
    </div>

    
    <div class="form-container sign-in">
        <form method="POST" action="<?php echo e(route('login.attempt')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="form" value="login">
            <h1>Welcome back</h1>
            <p class="sub">Sign in to your account</p>

            <?php if($errors->login->any()): ?>
                <div class="alert alert-error">
                    <?php echo e($errors->login->first()); ?>

                    <?php if(session('lockout')): ?>
                        <br>Try again in <strong id="countdown" data-seconds="<?php echo e(session('lockout')); ?>"></strong>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <input type="email" name="email" placeholder="Email" value="<?php echo e(old('form') !== 'register' ? old('email') : ''); ?>" required>
            <input type="password" name="password" placeholder="Password" required>
            <label class="remember"><input type="checkbox" name="remember"> Remember me</label>
            <button type="submit" id="loginBtn" data-loading="Signing in...">Sign in</button>
            <p class="mobile-switch">No account yet?
                <a onclick="document.getElementById('container').classList.add('right-active')">Sign up</a>
            </p>
        </form>
    </div>

    
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Already registered?</h1>
                <p>Sign in to see your students, courses, and subjects.</p>
                <button type="button" class="ghost" id="goLogin">Sign in</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>New here?</h1>
                <p>Create an account and start building student profiles.</p>
                <button type="button" class="ghost" id="goRegister">Sign up</button>
            </div>
        </div>
    </div>
</div>

<script>
    var container = document.getElementById('container');
    document.getElementById('goRegister').addEventListener('click', function () { container.classList.add('right-active'); });
    document.getElementById('goLogin').addEventListener('click', function () { container.classList.remove('right-active'); });

    // lockout countdown
    var countdown = document.getElementById('countdown');
    if (countdown) {
        var seconds = parseInt(countdown.dataset.seconds, 10);
        var loginBtn = document.getElementById('loginBtn');
        loginBtn.disabled = true;

        var tick = function () {
            var m = Math.floor(seconds / 60);
            var s = String(seconds % 60).padStart(2, '0');
            countdown.textContent = m + ':' + s;
            if (seconds <= 0) {
                clearInterval(timer);
                loginBtn.disabled = false;
                countdown.closest('.alert').remove();
            }
            seconds--;
        };
        var timer = setInterval(tick, 1000);
        tick();
    }
</script>

<?php echo $__env->make('partials.form-guard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/auth/index.blade.php ENDPATH**/ ?>