

<?php $__env->startSection('content'); ?>
<div class="card">
    <h2>Add Student</h2>
    <form method="POST" action="<?php echo e(route('students.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="grid">
            <div>
                <label>Course</label>
                <select name="course_id" required>
                    <option value="">-- Select course --</option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($course->id); ?>" <?php if(old('course_id') == $course->id): echo 'selected'; endif; ?>>
                            <?php echo e($course->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label>Student no.</label>
                <input type="text" name="student_no" value="<?php echo e(old('student_no')); ?>" required>
            </div>
            <div>
                <label>First name</label>
                <input type="text" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
            </div>
            <div>
                <label>Last name</label>
                <input type="text" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" required>
            </div>
            <div>
                <label>Address</label>
                <input type="text" name="address" value="<?php echo e(old('address')); ?>" required>
            </div>
            <div>
                <label>Contact no.</label>
                <input type="text" name="contact_no" value="<?php echo e(old('contact_no')); ?>" required>
            </div>
            <div>
                <label>Birthdate</label>
                <input type="date" name="birthdate" value="<?php echo e(old('birthdate')); ?>" required>
            </div>
            <div>
                <label>Guardian name (optional)</label>
                <input type="text" name="guardian_name" value="<?php echo e(old('guardian_name')); ?>">
            </div>
        </div>
        <button type="submit">Add Student</button>
    </form>
</div>

<div class="card">
    <h2>Students</h2>
    <table>
        <thead>
            <tr>
                <th>#</th><th>Student no.</th><th>Name</th><th>Course</th>
                <th>Email</th><th>Address</th><th>Contact</th><th>Birthdate</th><th>Guardian</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($student->student_no); ?></td>
                    <td><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></td>
                    <td><?php echo e($student->course->name); ?></td>
                    <td><?php echo e($student->email); ?></td>
                    <td><?php echo e($student->profile->address ?? '-'); ?></td>
                    <td><?php echo e($student->profile->contact_no ?? '-'); ?></td>
                    <td><?php echo e($student->profile->birthdate ?? '-'); ?></td>
                    <td><?php echo e($student->profile->guardian_name ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="9">No students yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Vash Dave Jumanguin\student-profile\resources\views/students/index.blade.php ENDPATH**/ ?>