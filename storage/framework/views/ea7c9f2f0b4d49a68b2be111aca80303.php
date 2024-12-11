<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="31">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="31">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                    </a>
                </li>
                
                    
                


                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Practice Access'])): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarSetup" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSetup">
                            <i class="mdi mdi-cogs"></i> <span>Setup</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarSetup">
                            <ul class="nav nav-sm flex-column">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any('Practice Access')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('/practice')); ?>" class="nav-link">Practice</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any('UserManagement access')): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span>User Management</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(url('/permissions')); ?>" class="nav-link">Permissions</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/roles')); ?>" class="nav-link">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(url('/users')); ?>" class="nav-link">Users</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>


                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

<script>
    $(document).ready(function () {
        // Get the current path or URL
        var currentPath = window.location.pathname;

        // Specify the default active link
        var defaultActiveLink = '/';

        // Add the "active" class to the default menu item
        $('.nav-item .nav-link').each(function () {
            var linkPath = $(this).attr('href');

            // Check if the current path is the default active link
            if (currentPath === defaultActiveLink) {
                $('.nav-item .nav-link[href="/"]').addClass('active');
                $('.nav-item .nav-link[href="/"]').parents('.nav-item').addClass('active');
            }

            // Check if the current path includes the linkPath or vice versa
            else if (currentPath.includes(linkPath) || linkPath.includes(currentPath)) {
                $(this).addClass('active');

                // Handle the parent elements based on the structure
                $(this).parents('.collapse').addClass('show');
                $(this).parents('.nav-item').addClass('active');
            }
        });
    });
</script>

<?php /**PATH C:\xampp\htdocs\tms-zeta\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>