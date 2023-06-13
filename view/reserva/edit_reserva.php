<?php
$id = $restaurante = $tel = $comensales = "";
if (isset($dataToView["data"])) {
    $reserva = $dataToView["data"];

    if ($reserva->getId() !== null) {
        $id = $reserva->getId();
    }
    if ($reserva->getRestaurante() !== null) {
        $restaurante = $reserva->getRestaurante();
    }
    if ($reserva->getTel() !== null) {
        $tel = $reserva->getTel();
    }

    if ($reserva->getComensales() !== "") {
        $comensales = $reserva->getComensales();
    }
}
?>

<div class="col-md-12 text-right">
        <a href="FrontController.php?controller=Reserva&action=list" class="btn btn-outline -secondary">Volver a lista de reservas</a>
        <hr/>
    </div>
<div class="row">
    <?php
    if (isset($reserva) && ($reserva->getStatus() === Util::OPERATION_OK )):
        ?>
        <div class="alert alert-success">
            Operación realizada correctamente. <a href="FrontController.php?controller=Reserva&action=list">Volver al listado</a>
        </div>
        <?php
    elseif (isset($reserva) && ($reserva->getStatus() === Util::OPERATION_NOK )):
        ?>
        <div class="alert alert-danger">
            Ha ocurrido algún problema y no se ha podido guardar la reserva$reserva. <a href="FrontController.php?controller=Reserva&action=list">Volver al listado</a>
        </div>
        <?php
 
    elseif (isset($reserva) && ($reserva->getStatus() === Util::NO_OPERATION)):
        ?>
     
<!-- reserva -->

        <form method="post" action="FrontController.php?controller=Reserva&action=save"  id="reservaForm">
      <div class="mb-3">
        <label for="restaurante" class="form-label">Restaurante</label>
        <select class="form-select" aria-label="Restaurante" required name="restaurante" id="restaurante">

          <?php 
          foreach ($reserva->getRestaurantes() as $restaurante) : ?>
            <option value="<?=$restaurante->getId()?>"> <?= $restaurante->getNombre()?></option>
          <?php endforeach; ?>
        </select>
      </div>

    

      <div class="mb-3">
        <label for="tel" class="form-label">Teléfono</label>
        <input type="tel" class="form-control" id="tel" placeholder="600123123" pattern="[6|9]\d{8}" required name="tel">
      </div>

      <div class="mb-3">
        <label for="comensales" class="form-label">Comensales</label>
        <input type="number" min="1" max="6" class="form-control" id="comensales"  required name="comensales">
      </div>


      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Reservar</button>
      </div>

    </form>




       
    <?php endif; ?>
</div>


        <!-- Modal -->
        <div class="modal fade" id="spa_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id='modal_msg'>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id='opt_cancel'>Cancelar</button>
                        <button type="button" class="btn btn-primary" id='opt_ok'>Aceptar</button>
                    </div>
                </div>
            </div>
        </div>


            <!--  message div -->
            <div class="row d-flex justify-content-center">

<div class="col-6  mb-4 alert alert-danger invisible" id="divMsg" role="alert">
</div>
</div>




<script src=../js/global.js></script>
<script src=../js/manejarReservas.js></script>