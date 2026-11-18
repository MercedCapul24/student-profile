

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>Add Course</h2>
    <form method="POST" action="<?php echo e(route('courses.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="grid">
            <div>
                <label>Course name</label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required>
            </div>
            <div>
                <label>Course code</label>
                <input type="text" name="code" value="<?php echo e(old('code')); ?>" required>
            </div>
        </div>
        <button type="submit">Add Course</button>
    </form>
</div>

<div class="card">
    <h2>Courses</h2>
    <table>
        <thead>
            <tr><th>#</th><th>Name</th><th>Code</th><th>No. of students</th></tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($course->name); ?></td>
                    <td><?php echo e($course->code); ?></td>
                    <td><?php echo e($course->students_count); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4">No courses yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/courses/index.blade.php ENDPATH**/ ?>