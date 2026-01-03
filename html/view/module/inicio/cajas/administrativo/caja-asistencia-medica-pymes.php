<div class="col-6 col-lg-3">
    <div class="small-box color-palette" style="background-color: #84b6f4;">
        <div class="inner">
            <h3 id="contadorContratoAsistenciaMedicaPymes1" class="contadorContratoAsistenciaMedicaPymes">0</h3>
            <p>Asistencia Medica</p>
        </div>
        <div class="icon">
            <i class="fa fa-medkit"></i>
        </div>
        <a class="small-box-footer" href="#" data-toggle="modal" data-target="#modal-asistencia-medica-empresarial">
            Más info <i class="fa fa-bars"></i>
        </a>

        <div class="modal fade" id="modal-asistencia-medica-empresarial">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Asistencia Medica</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <?php
                            include "asistencia-medica-pymes/caja-emision.php";
                            if ($_SESSION["S_ROL"] == 'GERENTE') {
                                include "asistencia-medica-pymes/caja-reembolsos.php";
                                include "asistencia-medica-pymes/caja-credito-hospitalario.php";
                                include "asistencia-medica-pymes/caja-credito-ambulatorio.php";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</div>