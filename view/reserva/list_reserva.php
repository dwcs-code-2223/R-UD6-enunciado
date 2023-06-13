<div class="row">
    <div class="col-md-12 text-right">
        <a href="FrontController.php?controller=Reserva&action=edit" class="btn btn-outline-primary">Crear reserva</a>
        <hr/>
    </div>
    <?php
    if (count($dataToView["data"]) > 0) {
        foreach ($dataToView["data"] as $reserva) {
            ?>
            <div class="col-md-3 card border border-secondary rounded m-2">
                <?php
              
                    
                
               
                ?>
              
                <img src=<?php $path= $reserva->getImage($reserva->getRestaurante()) ; echo $path;?> class="card-img-top" >
                <div class="card-body ">

                    <h5 class="card-title"><?php echo $reserva->getRestaurante()->getNombre(); ?></h5>

                    <div class="card-text"><?php echo nl2br($reserva->getTel()); ?></div>
                    <hr class="mt-1"/>
                    <div class="card-text"><?php echo nl2br($reserva->getComensales()); ?></div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="alert alert-info">
            Actualmente no existen reservas.
        </div>
        <?php
    }
    ?>
</div>