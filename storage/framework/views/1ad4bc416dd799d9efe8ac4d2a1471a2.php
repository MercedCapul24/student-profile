<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Profile Management System</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/theme.css')); ?>">
</head>
<body>
    <nav>
        <span class="brand">Student <span>Profile</span> Management System</span>
        <a href="<?php echo e(route('students.index')); ?>">Students</a>
        <a href="<?php echo e(route('courses.index')); ?>">Courses</a>
        <a href="<?php echo e(route('subjects.index')); ?>">Subjects</a>
        <a href="<?php echo e(route('enrollments.index')); ?>">Enrollments</a>

        <span class="spacer"><?php echo e(auth()->user()->name); ?></span>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="link" data-loading="Logging out...">Logout</button>
        </form>
    </nav>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('partials.form-guard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/layouts/app.blade.php ENDPATH**/ ?>