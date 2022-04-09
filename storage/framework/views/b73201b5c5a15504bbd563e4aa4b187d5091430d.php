<?php if($message = Session::get('warning')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?php echo e($message); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?><?php /**PATH C:\laragon\www\Nexoabogados\test_nexoabogados_api\resources\views/message/pendingMessage.blade.php ENDPATH**/ ?>