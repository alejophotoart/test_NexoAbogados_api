

<?php $__env->startSection('contents'); ?>
    <h1>Abogados</h1>
<!-- tabla de abogados -->
    <?php echo $__env->make('message.pendingMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- COmienza la tabla -->
    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo e(__("Nombre")); ?></th>
            <th scope="col"><?php echo e(__("Email")); ?></th>
            <th scope="col"><?php echo e(__("Fecha de creacion")); ?></th>
            <th scope="col"><?php echo e(__("Suscribir")); ?></th>
            <th scope="col"><?php echo e(__("Acciones")); ?></th>
        </tr>
    </thead>
    <tbody>

        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($a->id); ?></td>
            <td><?php echo e($a->name); ?></td>
            <td><?php echo e($a->email); ?></td>
            <td><?php echo e($a->created_at); ?></td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input subsSwitch" type="checkbox" role="switch" value="<?php echo e($a->id); ?>,<?php echo e($a->name); ?>" data-bs-toggle="modal" data-bs-target="#createSub">
                </div>
            </td>
            <td>
                <a href="#">
                    <i class="fas fa-trash-alt" style="color: black; margin: 5px"></i>
                </a>
                <a href="#">
                    <i class="fas fa-eye" style="color: black; margin: 5px"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
    </tbody>
</table>
<!-- Se termina la tabla -->
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var miCheckboxes = document.querySelectorAll('.subsSwitch');
        var modalSubs = document.getElementById('createSub');
        
        miCheckboxes.forEach((miCheckbox) => {
            miCheckbox.addEventListener('click', function() {
                
                if(miCheckbox.checked) {
                    let arr = miCheckbox.value;
                    
                    let arr2 = arr.split(',');
                    console.log(arr2);
                    
                    let id = arr2[0];
                    let name = arr2[1];
                    
                    localStorage.clear();
                    localStorage.setItem('id', id); //se guardan variables en el localstorage para enviarse a el modal de crear suscripcion
                    localStorage.setItem('name', name);

                    $('#modalName').attr('value', name);
                    $('#name').attr('value', name);
                    $('#idUser').attr('value', id);

                }
            });
        })



    });
</script>
<!-- incluye a el modal de crear suscripcion -->
<?php echo $__env->make('subscriptions.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Nexoabogados\test_nexoabogados_api\resources\views/users/index.blade.php ENDPATH**/ ?>