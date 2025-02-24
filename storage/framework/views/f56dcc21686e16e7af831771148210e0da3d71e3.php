<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <!-- <img src="<?php echo e(URL::asset('images/sidthu-final.jpg')); ?>" alt="logo" width="150"> -->
            </span>
            <!-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Sidthu Inverstment</span> -->
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?php echo e(request()->is('admin') || request()->is('admin') ? 'active' : ''); ?>">
            <a href="<?php echo e(route("admin.home")); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_management_access')): ?>
        <li class="menu-item <?php echo e(request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : ''); ?> <?php echo e(request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active open' : ''); ?> <?php echo e(request()->is('admin/users') || request()->is('admin/users/*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-user'></i>
                <div data-i18n="Layouts">User Managment</div>
            </a>

            <ul class="menu-sub">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission_access')): ?>
                <li class="menu-item <?php echo e(request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : ''); ?>">

                    <a href="<?php echo e(route("admin.permissions.index")); ?>" class="menu-link ">

                        <?php echo e(trans('cruds.permission.title')); ?>

                    </a>
                </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role_access')): ?>
                <li class="menu-item <?php echo e(request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : ''); ?>">

                    <a href="<?php echo e(route("admin.roles.index")); ?>" class="menu-link ">

                        <?php echo e(trans('cruds.role.title')); ?>

                    </a>
                </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_access')): ?>
                <li class="menu-item <?php echo e(request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : ''); ?>">

                    <a href="<?php echo e(route("admin.users.index")); ?>" class="menu-link ">

                        <?php echo e(trans('cruds.user.title')); ?>

                    </a>
                </li>
                <?php endif; ?>

            </ul>


        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('status_access')): ?>
        <li class="menu-item <?php echo e(request()->is('admin/statuses') || request()->is('admin/statuses/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route("admin.statuses.index")); ?>" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-message-square-dots"></i>

                <div data-i18n="Analytics"> <?php echo e(trans('cruds.status.title')); ?></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('customer_application_access')): ?>
        <li class="menu-item <?php echo e(request()->is('admin/customer-applications') || request()->is('admin/customer-applications/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route("admin.customer-applications.index")); ?>" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-notepad"></i>

                <div data-i18n="Analytics"> Customer Application</div>
            </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loan_application_access')): ?>
        <li class="menu-item <?php echo e(request()->is('admin/loan-applications') || request()->is('admin/loan-applications/*') ? 'active' : ''); ?>">
            <a href="<?php echo e(route("admin.loan-applications.index")); ?>" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-notepad"></i>

                <div data-i18n="Analytics"> Seat booking</div>
            </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('comment_access')): ?>
        <li class="menu-item <?php echo e(request()->is('admin/comments') || request()->is('admin/comments/*') ? 'active' : ''); ?> ">
            <a href="<?php echo e(route("admin.comments.index")); ?>" class="menu-link ">
                <i class="menu-icon tf-icons bx bxs-comment-detail"></i>

                <div data-i18n="Analytics"> <?php echo e(trans('cruds.comment.title')); ?></div>
            </a>
        </li>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings_access')): ?>
        <li class="menu-item <?php echo e(request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active open' : ''); ?> <?php echo e(request()->is('admin/settings-income-type') || request()->is('admin/settings-income-type/*') ? 'active open' : ''); ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">

                <i class='menu-icon tf-icons bx bx-cog'></i>

                <div data-i18n="Layouts"> Settings</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item <?php echo e(request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route("admin.settings.index")); ?>" class="menu-link ">
                        <div data-i18n="Without menu"> Intrest Type</div>
                    </a>
                </li>
                <li class="menu-item <?php echo e(request()->is('admin/settings-income-type') || request()->is('admin/settings-income-type/*') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route("admin.settings.income")); ?>" class="menu-link ">
                        <div data-i18n="Without menu"> Income type</div>
                    </a>
                </li>

            </ul>


        </li>
        <?php endif; ?>


</aside><?php /**PATH /Applications/MAMP/htdocs/seatbooking/resources/views/partials/menu.blade.php ENDPATH**/ ?>