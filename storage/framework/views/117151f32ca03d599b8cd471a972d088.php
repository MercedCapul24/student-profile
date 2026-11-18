

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>Assign Subject to Student</h2>
    <form method="POST" action="<?php echo e(route('enrollments.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="grid">
            <div>
                <label>Student</label>
                <select name="student_id" required>
                    <option value="">-- Select student --</option>
                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($student->id); ?>" <?php if(old('student_id') == $student->id): echo 'selected'; endif; ?>>
                            <?php echo e($student->last_name); ?>, <?php echo e($student->first_name); ?> (<?php echo e($student->student_no); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label>Subject</label>
                <select name="subject_id" required>
                    <option value="">-- Select subject --</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($subject->id); ?>" <?php if(old('subject_id') == $subject->id): echo 'selected'; endif; ?>>
                            <?php echo e($subject->code); ?> - <?php echo e($subject->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <button type="submit">Assign Subject</button>
    </form>
</div>

<div class="card">
    <h2>Student Enrollments</h2>
    <table>
        <thead>
            <tr><th>#</th><th>Student</th><th>Subjects</th><th>Total units</th></tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></td>
                    <td>
                        <?php $__empty_2 = true; $__currentLoopData = $student->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                            <?php echo e($subject->code); ?><?php if(! $loop->last): ?>, <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($student->subjects->sum('units')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="4">No students yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/enrollments/index.blade.php ENDPATH**/ ?>