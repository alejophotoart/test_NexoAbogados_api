<!-- Modal donde se muestran los precios de suscripcion -->

<div class="modal fade" id="createSub" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="<?php echo e(route('subscribed.user')); ?>">
    <?php echo csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-header">
          <input type="text" class="modal-title border border-white" id="modalName" name="nameUser" disabled>
        </div>
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <h3>Valor de pago</h3>
              <select class="form-select <?php $__errorArgs = ['subscriptionPrice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="selectPrice" name="subscriptionPrice" type="number">
                <option selected>---Seleccione un valor de suscripcion---</option>
              </select>

              <input type="text" id="idUser" name="id" hidden>
              <input type="text" id="name" name="nameUser" hidden>

              <div class="mt-2">                
                <?php $__errorArgs = ['subscriptionPrice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <div class="alert alert-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cerrar</button>
          <button type="submit" class="btn btn-primary">Suscribir</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>

  window.addEventListener('DOMContentLoaded', (event) => {

    const options2 = { style: 'currency', currency: 'USD' };
    const numberFormat2 = new Intl.NumberFormat('en-US', options2);

    $.ajax({ //se traen los precios a travez de un ajax
      url: "/getPriceSubs",
      type: "GET",
      contentType: "application/json",
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          contentType: "application/json"
      },
      success: function(r) {
        console.log(r);
        let pricesSubs = r.prices;

        for (var i = 0; i < pricesSubs.length; i++) {
          $("#selectPrice").append(
            '<option value="' + pricesSubs[i].id + '">' + numberFormat2.format(pricesSubs[i].price) + "</option>" //se llenan las opciones del select para el listado de precios
          );
        }
      }
    });

  });

    function closeModal() { //funcion que cierra el modal y desactiva el checkbox

        let miCheck = document.querySelectorAll('.subsSwitch');
        console.log(miCheck);

        miCheck.forEach((miChecked) => {

            let arr = miChecked.value;
            let idlocal = localStorage.getItem('id');

            let arr2 = arr.split(',');
            
            let id = arr2[0];
            let name = arr2[1];
            
            if( idlocal == id ){
                miChecked.checked = false;
            }
        });
    }
</script><?php /**PATH C:\laragon\www\Nexoabogados\test_nexoabogados_api\resources\views/subscriptions/create.blade.php ENDPATH**/ ?>