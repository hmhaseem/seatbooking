<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h1>All Buses</h1>
        <a href="<?php echo e(route('admin.buses.create')); ?>">Create New Bus</a>
        
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LoanApplication">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bus Name</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $buses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($bus->id); ?></td>
                                <td><?php echo e($bus->bus_name); ?></td>
                                <td><?php echo e($bus->origin); ?></td>
                                <td><?php echo e($bus->destination); ?></td>
                                <td>
                                    <a href="<?php echo e(route('admin.buses.edit', $bus->id)); ?>">Edit</a>
                                    <form action="<?php echo e(route('admin.buses.destroy', $bus->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit">Delete</button>
                                    </form>
                                    <a href="<?php echo e(route('admin.seats.manage', $bus->id)); ?>">Manage Seats</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table> 
            </table>
        </div>
    </div>

 
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/seatbooking/resources/views/admin/buses/index.blade.php ENDPATH**/ ?>