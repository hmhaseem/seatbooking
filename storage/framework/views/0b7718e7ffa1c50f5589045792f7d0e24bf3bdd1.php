<?php $__env->startSection('content'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_create')): ?>
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="<?php echo e(route('admin.loan-applications.create')); ?>">
            <?php echo e(trans('global.add')); ?> <?php echo e(trans('cruds.loanApplication.title_singular')); ?>

        </a>
    </div>
</div>
<?php endif; ?>
<div class="card">
    <div class="card-header">
        <?php echo e(trans('cruds.loanApplication.title_singular')); ?> <?php echo e(trans('global.list')); ?>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LoanApplication">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.id')); ?>

                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.loan_amount')); ?>

                        </th>

                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.status')); ?>

                        </th>
                        <?php if($user->is_admin): ?>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.analyst')); ?>

                        </th>
                        <th>
                            <?php echo e(trans('cruds.loanApplication.fields.cfo')); ?>

                        </th>
                        <?php endif; ?>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loanApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $loanApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-entry-id="<?php echo e($loanApplication->id); ?>">
                        <td>

                        </td>
                        <td>
                            <?php echo e($loanApplication->id ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($loanApplication->name ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($loanApplication->loan_amount ?? ''); ?>

                        </td>

                        <td>
                            <?php echo e($user->is_user && $loanApplication->status_id < 8 ? $defaultStatus->name : $loanApplication->status->name); ?>

                        </td>
                        <?php if($user->is_admin): ?>
                        <td>
                            <?php echo e($loanApplication->analyst->name ?? ''); ?>

                        </td>
                        <td>
                            <?php echo e($loanApplication->cfo->name ?? ''); ?>

                        </td>
                        <?php endif; ?>
                        <td>
                            <?php if($user->is_admin && in_array($loanApplication->status_id, [1, 3, 4])): ?>
                            <a class="btn btn-xs btn-success" href="<?php echo e(route('admin.loan-applications.showSend', $loanApplication->id)); ?>">
                                Send to
                                <?php if($loanApplication->status_id == 1): ?>
                                Manager
                                <?php else: ?>
                                CFO
                                <?php endif; ?>
                            </a>
                            <?php elseif(($user->is_analyst && $loanApplication->status_id == 2) || ($user->is_cfo && $loanApplication->status_id == 5)): ?>
                            <a class="btn btn-xs btn-success" href="<?php echo e(route('admin.loan-applications.showAnalyze', $loanApplication->id)); ?>">
                                Submit analysis
                            </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_show')): ?>
                            <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.loan-applications.show', $loanApplication->id)); ?>">
                                <?php echo e(trans('global.view')); ?>

                            </a>
                            <?php endif; ?>

                            <?php if(Gate::allows('loan_application_edit')): ?>
                            <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.loan-applications.edit', $loanApplication->id)); ?>">
                                <?php echo e(trans('global.edit')); ?>

                            </a>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_delete')): ?>
                            <form action="<?php echo e(route('admin.loan-applications.destroy', $loanApplication->id)); ?>" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <input type="submit" class="btn btn-xs btn-danger" value="<?php echo e(trans('global.delete')); ?>">
                            </form>
                            <?php endif; ?>

                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>


</div>





<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>

<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_delete')): ?>
        let deleteButtonTrans = '<?php echo e(trans('global.datatables.delete')); ?>'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "<?php echo e(route('admin.loan-applications.massDestroy')); ?>",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('<?php echo e(trans('global.datatables.zero_selected')); ?>')

                    return
                }

                if (confirm('<?php echo e(trans('global.areYouSure')); ?>')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        <?php endif; ?>

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        let table = $('.datatable-LoanApplication:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/seatbooking/resources/views/admin/loanApplications/index.blade.php ENDPATH**/ ?>