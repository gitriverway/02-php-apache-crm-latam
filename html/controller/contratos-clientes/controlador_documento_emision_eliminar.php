<?php
    require '../../model/modelo_contrato_cliente_documento.php';

    $idDocumentoEmision = $_POST['idDocumentoEmision'];
    $documentoRuta ="../../". $_POST['documentoRuta'];

    if(is_file($documentoRuta)) {
        unlink($documentoRuta);
    }
    $carpeta_documento = "../../view/contratos/".$_POST['idCliente']."/".$_POST['carpetaDocumento'];
    $contador_documento_carpeta = scandir("../../view/contratos/".$_POST['idCliente']."/".$_POST['carpetaDocumento']);

    $MU = new Modelo_Contrato_Cliente_Documento();
    $consulta = $MU->Eliminar_Documento_Emision($idDocumentoEmision);

    if (count($contador_documento_carpeta) < 3){
        rmdir($carpeta_documento);
        // echo count($contador_documento_carpeta);
        // echo json_encode($contador_documento_carpeta);
    }

    echo json_encode($consulta);