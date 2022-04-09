<div class="modal fade" id="createSub" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalName"></h5>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Cerrar</button>
        <button type="button" class="btn btn-primary">Suscribir</button>
      </div>
    </div>
  </div>
</div>

<script>

    function closeModal() {

        $('#modalName').attr('text', 'hola');

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
</script><?php /**PATH C:\xampp\htdocs\Nexoabogados\test_nexoabogados_api\resources\views/subscriptions/create.blade.php ENDPATH**/ ?>