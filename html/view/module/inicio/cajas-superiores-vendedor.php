<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Individual</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                include "cajas/administrativo/caja-prospecto-individual.php";
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pymes</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                include "cajas/administrativo/caja-prospecto-pymes.php";
                ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        contadoresGenerales();
    })
</script>