<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo e(asset('/css/app.css')); ?>"></link>
    <!-- Font-Awesome -->
    <script src="https://kit.fontawesome.com/fac3d9d15e.js" crossorigin="anonymous"></script> 
    <title>NexoAbogados</title>
</head>
    <body>
        <div class="card m-4 mx-auto" style="width: 900px;">
            <div class="card-header">
                <nav class="nav nav-pills nav-fill">
                    <a class="nav-link" href="<?php echo e(route('users.index')); ?>">Abogados</a>
                    <a class="nav-link" href="<?php echo e(route('subscriptions.index')); ?>">Suscripciones</a>
                    <a class="nav-link" href="<?php echo e(route('recurrents.index')); ?>">Recurrencias</a>
                </nav>
            </div>
            <div class="card-body">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
        <script src="<?php echo e(asset('/js/app.js')); ?>"></script>
        <script src="<?php echo e(asset('/js/jquery.js')); ?>"></script>
    </body>
</html><?php /**PATH C:\laragon\www\Nexoabogados\test_nexoabogados_api\resources\views/index.blade.php ENDPATH**/ ?>