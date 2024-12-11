
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row mt-5" >
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        
                        <form id="profile-form" action="<?php echo e(route('update-avatar')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="<?php if($user->avatar != ''): ?> <?php echo e(URL::asset('build/users/' . $user->avatar)); ?><?php else: ?><?php echo e(URL::asset('build/images/users/user-dummy-img.jpg')); ?> <?php endif; ?>"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow"
                                    alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" value="" name="avatar"
                                        accept="image/png, image/gif, image/jpeg" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('profile-img-file-input').addEventListener('change', function () {
                                document.getElementById('profile-form').submit();
                            });
                        </script>
                        <h5 class="fs-16 mb-1"><?php echo e($user->name." ".$user->full_name); ?></h5>
                        <p class="text-muted mb-0"><?php echo e($user->email); ?></p>
                        
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist" id="Tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <?php if(Session::has('message')): ?>
                            <div class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>" id="alert-message">
                                <?php echo e(Session::get('message')); ?>

                            </div>

                            <script>
                                // Add a timer to automatically dismiss the alert after 5 seconds (adjust as needed)
                                setTimeout(function() {
                                    document.getElementById('alert-message').style.display = 'none';
                                }, 5000); // 5000 milliseconds = 5 seconds
                            </script>
                        <?php endif; ?>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger" id="alert-message">
                                <?php echo e($message); ?>

                            </div>

                            <script>
                                // Add a timer to automatically dismiss the alert after 5 seconds (adjust as needed)
                                setTimeout(function() {
                                    document.getElementById('alert-message').style.display = 'none';
                                }, 5000); // 5000 milliseconds = 5 seconds
                            </script>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <form method="post" action="<?php echo e(route('profile-update')); ?>" >
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Enter your First Name" value="<?php echo e($user->name); ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Enter your Email" value="<?php echo e($user->email); ?>" disabled>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="telephone1" class="form-label">Telephone</label>
                                            <input type="text" class="form-control" name="telephone1"
                                                id="telephone1" placeholder="Enter your Telephone" value="<?php echo e($user->telephone1); ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="address1" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address1" id="address1"
                                                placeholder="Enter your Address" value="<?php echo e($user->address1); ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="city_town" class="form-label">City</label>
                                            <input type="text" class="form-control" name="city_town" id="city_town" placeholder="Enter your City"
                                                value="<?php echo e($user->city_town); ?>" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country</label>
                                            <input type="text" class="form-control" name="country" id="country"
                                                placeholder="Enter your Country" value="<?php echo e($user->country); ?>" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="postcode" class="form-label">Post
                                                Code</label>
                                            <input type="text" class="form-control" name="postcode" minlength="5" maxlength="6"
                                                id="postcode" placeholder="Enter your PostCode" value="<?php echo e($user->postcode); ?>">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form method="post" action="<?php echo e(route('change_password')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="current_password" class="form-label">Current
                                                Password*</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password"
                                                placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password" class="form-label">New
                                                Password*</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="password_confirmation" class="form-label">Confirm
                                                Password*</label>
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                                placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Change
                                                Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/js/pages/profile-setting.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your custom script -->
<script type="text/javascript">
    $(document).ready(function() {
        var ActiveTab = localStorage.getItem('ActiveTab');
        if (ActiveTab) {
            $('#Tabs a[href="' + ActiveTab + '"]').tab('show');
        }

        $('#Tabs a').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr('href');
            localStorage.setItem('ActiveTab', target);
        });
    });
</script>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tms-zeta\resources\views/profile/profile.blade.php ENDPATH**/ ?>