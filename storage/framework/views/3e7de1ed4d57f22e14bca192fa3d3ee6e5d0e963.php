<?php $__env->startSection('content'); ?>
    <h1><?php echo e(isset($bus) ? 'Edit Bus' : 'Create Bus'); ?></h1>

    <form 
        action="<?php echo e(isset($bus) 
                    ? route('admin.buses.update', $bus->id) 
                    : route('admin.buses.store')); ?>" 
        method="POST"
    >
        <?php echo csrf_field(); ?>
        <?php if(isset($bus)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div>
            <label>Bus Name</label>
            <input type="text" name="bus_name" value="<?php echo e($bus->bus_name ?? old('bus_name')); ?>" required>
        </div>

        <div>
            <label>Origin</label>
            <input type="text" name="origin" value="<?php echo e($bus->origin ?? old('origin')); ?>" required>
        </div>

        <div>
            <label>Destination</label>
            <input type="text" name="destination" value="<?php echo e($bus->destination ?? old('destination')); ?>" required>
        </div>

        <div>
            <label>Departure Time</label>
            <input type="datetime-local" name="departure_time"
                value="<?php echo e(isset($bus) ? \Carbon\Carbon::parse($bus->departure_time)->format('Y-m-d\TH:i') : old('departure_time')); ?>"
                required>
        </div>

        <div>
            <label>Arrival Time</label>
            <input type="datetime-local" name="arrival_time"
                value="<?php echo e(isset($bus) ? \Carbon\Carbon::parse($bus->arrival_time)->format('Y-m-d\TH:i') : old('arrival_time')); ?>"
                required>
        </div>

        <button type="submit"><?php echo e(isset($bus) ? 'Update' : 'Create'); ?></button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/seatbooking/resources/views/admin/buses/edit.blade.php ENDPATH**/ ?>