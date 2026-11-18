

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>Add Subject</h2>
    <form method="POST" action="<?php echo e(route('subjects.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="grid">
            <div>
                <label>Subject name</label>
                <input type="text" name="name" value="<?php echo e(old('name')); ?>" required>
            </div>
            <div>
                <label>Subject code</label>
                <input type="text" name="code" value="<?php echo e(old('code')); ?>" required>
            </div>
            <div>
                <label>Units</label>
                <input type="number" name="units" value="<?php echo e(old('units', 3)); ?>" min="1" max="9" required>
            </div>
        </div>
        <button type="submit">Add Subject</button>
    </form>
</div>

<div class="card">
    <h2>Subjects</h2>
    <table>
        <thead>
            <tr><th>#</th><th>Name</th><th>Code</th><th>Units</th></tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($subject->name); ?></td>
                    <td><?php echo e($subject->code); ?></td>
                    <td><?php echo e($subject->units); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4">No subjects yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/subjects/index.blade.php ENDPATH**/ ?>