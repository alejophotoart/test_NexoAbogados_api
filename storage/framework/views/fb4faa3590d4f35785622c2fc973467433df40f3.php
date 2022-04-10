

<?php $__env->startSection('contents'); ?>
    <h1>Suscripciones</h1>
<!-- tabla de suscripciones -->
    <?php echo $__env->make('message.deleteMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- comienza la tabla -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?php echo e(__("Abogado")); ?></th>
                <th scope="col"><?php echo e(__("Email")); ?></th>
                <th scope="col"><?php echo e(__("Valor Suscripcion")); ?></th>
                <th scope="col"><?php echo e(__("Fecha de Suscripcion")); ?></th>
                <th scope="col"><?php echo e(__("Estado de Suscripcion")); ?></th>
                <th scope="col"><?php echo e(__("Acciones")); ?></th>
            </tr>
        </thead>
        <tbody>

            <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($s->id); ?></td>
                <td><?php echo e($s->user->name); ?></td>
                <td><?php echo e($s->user->email); ?></td>
                <td>$ <?php echo e(number_format($s->price_subs->price, 2, ",", ".")); ?></td>
                <td><?php echo e($s->date_subscription); ?></td>
                <?php if( $s->confirmed == 0 ): ?>
                <td><?php echo e(__("Pendiente")); ?></td>
                <?php elseif( $s->confirmed == 1 ): ?> 
                <td><?php echo e(__("Activo")); ?></td>
                <?php endif; ?>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#detaillSub">
                        <i class="fas fa-eye" style="color: black; margin: 5px; cursor: pointer;" onclick="showDetaills('<?php echo e($s->id); ?>')"></i>
                    </a>
                    <form action="<?php echo e(route('subscription.delete')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <input type="text" value="<?php echo e($s->id); ?>" name="id" hidden>
                        <input type="text" value="<?php echo e($s->user->name); ?>" name="name" hidden>

                        <button style="background-color: transparent; border-color: transparent;" type="submit">
                            <i class="fas fa-ban" style="color: black; margin: 5px; cursor: pointer;"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
        </tbody>
    </table>
<!-- /Se termina la tabla -->
    <script>
        function showDetaills(id) {
    
            $.ajax({ //ajax que pinta la informacion detallada del modal
                url: "/getDetaills/subscriptions/" + id,
                type: "GET",
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    contentType: "application/json"
                },
                success: function(r) {
                    console.log(r);

                    let detailuser = r.detaill.user;
                    let detailPrice = r.detaill.price_subs;
                    let details = r.detaill;

                    const options2 = { style: 'currency', currency: 'USD' };
                    const numberFormat2 = new Intl.NumberFormat('en-US', options2);

                    $("#userName").val(detailuser.name); //se pintan los valores en cada input correspondido
                    $("#userEmail").val(detailuser.email);
                    $("#subPrice").val(numberFormat2.format(detailPrice.price));
                    $("#userIn").val(detailuser.created_at);
                    $("#subDate").val(details.date_subscription);
                    if( details.confirmed == 0 ){
                        $("#subState").val("Pendiente");
                    }else if(details.confirmed == 1){
                        $("#subState").val("Activo");
                    }

                    if( detailuser.subscribed == 0 ){
                        $("#subConfirm").val("Sin confirmar");
                    }else if(detailuser.subscribed == 1){
                        $("#subState").val("Confirmado");
                    }

                }
            });
        }
    </script>
    <!-- Se importa el modal -->
    <?php echo $__env->make('subscriptions.detaill', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Nexoabogados\test_nexoabogados_api\resources\views/subscriptions/index.blade.php ENDPATH**/ ?>