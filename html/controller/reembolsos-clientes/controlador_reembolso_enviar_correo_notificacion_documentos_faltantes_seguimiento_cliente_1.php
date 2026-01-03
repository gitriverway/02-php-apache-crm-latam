<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

class Envio_correo_notificacion_documentos_faltantes_seguimiento_reembolso_1
{

    function realizar_envio_correo_notificacion_documentos_faltantes_seguimiento_reembolso_1($idReembolso, $idContrato)
    {

        $MU = new Modelo_Reembolso_Cliente();

        $consulta = $MU->traer_reembolso_unico($idReembolso, $idContrato);

        $consulta_observaciones = $MU->listar_observacion_reembolsos($idReembolso);

        $nombre = "";
        $correo = "";
        $cliente_email_opcional = "";
        $Ticket = 0;
        $reembolso_documentos_seguimiento = "";
        $documento_pedido_aseguradora_1 = "";

        $lista_observaciones = "";
        $observacion_final = "";

        for ($i = 0; $i < count($consulta); $i++) {
            $nombre = $consulta[$i]["cliente_nombre"];
            $correo = $consulta[$i]["cliente_email"];
            $cliente_email_opcional = $consulta[$i]["cliente_email_opcional"];
            $Ticket = $consulta[$i]["reembolso_id"];
            $reembolso_documentos_seguimiento = json_decode($consulta[$i]["reembolso_documentos_seguimiento_1"], true);
            $documento_pedido_aseguradora_1 = $consulta[$i]["DOCUMENTO_PEDIDO_ASEGURADORA_1"];
        }

        for ($j = 0; $j < count($consulta_observaciones); $j++) {
            $lista_observaciones = json_decode($consulta_observaciones[$j]["reembolso_observacion_descripcion"], true);
        }

        foreach ($lista_observaciones as $value) {
            $observacion_final = $value["observaciones"];
        }

        $listado_documentos = "";
        $opciones = "";

        foreach ($reembolso_documentos_seguimiento as $value) {

            switch ($value["estado"]) {
                case 'SI':
                    $opciones = '<td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center;">X</td>
                    <td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center;"></td>';
                    break;
                case 'NO':
                    $opciones = '<td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center;"></td>
                    <td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center;">X</td>';
                    break;
                default:
                    # code...
                    break;
            }

            $listado_documentos .= '<tr>
                <td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px;">' . $value["documento"] . '</td>' . $opciones . '</tr>';
        }

        if ($listado_documentos == "") {
            $listado_documentos = '<tr>
                <td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center;">SIN REGISTROS</td>
                </tr>';
        }

        date_default_timezone_set("America/Guayaquil");
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {

            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Username = 'mireyaquintana@mqpseguros.com';
            $mail->Password = 'Seguros2022,';

            //Recipients
            $mail->setFrom('mireyaquintana@mqpseguros.com', 'Reembolsos MQP Seguros');

            $mail->addAddress($correo, $nombre);

            if ($cliente_email_opcional != "") {
                $mail->addAddress($cliente_email_opcional, $nombre . " opcional");
            }

            $mail->addReplyTo('reembolsos@mqpseguros.com', 'Reembolsos MQP Seguros');     //Add a recipient
            $mail->addCC('reembolsos@mqpseguros.com', 'Reembolsos MQP Seguros');     //Add a recipient
            $mail->addCC('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');
            $mail->addCC('faustoochoa@mqpseguros.com', 'Prueba MQP Seguros');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Attachments

            if ($documento_pedido_aseguradora_1 != "") {
                $mail->addAttachment("../../" . $documento_pedido_aseguradora_1);
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'IMPORTANTE: DOCUMENTOS SOLICITADOS POR ASEGURADORA PARA REEMBOLSO Nº ' . $Ticket . ' - ASISTENCIA MÉDICA';
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

            <div style="position:relative; margin:auto; width:600px; background:white; padding-bottom:20px">
        
                <h3 style="font-weight:100; color:#999; padding:0px 20px;">Estimado Cliente: ' . $nombre . '</h3>
                <h3 style="font-weight:100; color:#999; padding:0px 20px;">Favor de completar los documentos marcados como
                    <strong>SI</strong>
                </h3>
                <center>
                    <h2 style="font-weight:100; color:#999;">LISTA DOCUMENTOS SOLICITA ASEGURADORA</h2>
                </center>
        
                <center>
                    <table
                        style=" border: 1px solid #1C6EA4;background-color: #EEEEEE;width: 60%;text-align: left;border-collapse: collapse;">
                        <thead
                            style="background: #1C6EA4;background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);border-bottom: 2px solid #444444;">
                            <th
                                style="font-size: 15px;font-weight: bold;color: #FFFFFF;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                DOCUMENTOS</th>
                            <th
                                style="font-size: 15px;font-weight: bold;color: #FFFFFF;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                SI</th>
                            <th
                                style="font-size: 15px;font-weight: bold;color: #FFFFFF;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                NO
                            </th>
                        </thead>
                        <tbody>
                            ' . $listado_documentos . '
                        </tbody>
                    </table>
                </center>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Observación: </strong> ' . $observacion_final . '</h3>
                <h3 style="font-weight:100; color:#999; padding:0px 20px;">Favor enviar los documento en un solo
                    <strong>PDF</strong>, Tiempo limite 72 Horas, al siguiente correo <strong>reembolsos@mqpseguros.com</strong> con numero de Ticket: Nº <strong>' . $Ticket . '</strong>
                </h3>

                <p style="color:#000000; padding:15px 20px; font-size:14px; line-height:1.5;">
                    <strong>Nota:</strong> Declaramos contar con el consentimiento explícito para llevar a cabo el trámite en beneficio del cliente.
                </p>
        
                <div class=WordSection1>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Saludos cordiales,<o:p>
                                </o:p></span></b></p>
                    <p class=MsoNormal><span style="font-family:Arial,sans-serif">
                            <o:p>&nbsp;</o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Departamento Servicio al Cliente<o:p></o:p>
                                </span></b></p>
                    <p class=MsoNormal><span style="font-family:Arial,sans-serif">
                            <o:p>&nbsp;</o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Dirección:</span></b><span
                            style="font-family:Arial,sans-serif"> <span style="color:#2F5496">Centro Empresarial Qworks - Quicentro Shopping, oficina 303
                                <o:p></o:p></span></span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Código
                                postal:</span></b><span style="font-family:Arial,sans-serif;color:#2F5496"> 170311</span><span
                            style="font-family:Arial,sans-serif">
                            <o:p></o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Celular:</span></b><span
                            style="font-family:Arial,sans-serif"> <span style="color:#2F5496">59398 940 9581</span>
                            <o:p></o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Web:</span></b><span
                            style="font-family:Arial,sans-serif"> <span style="color:#2F5496">https://<a
                                    href=http://www.mqpseguros.com><span
                                        style="color:#2F5496">www.mqpseguros.com</span></a></span>
                            <o:p></o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Credencial:</span></b><span
                            style="font-family:Arial,sans-serif"> <span style="color:#2F5496">1793190</span>
                            <o:p></o:p>
                        </span></p>
                    <p class=MsoNormal><span style="font-family:Arial,sans-serif">
                            <o:p>&nbsp;</o:p>
                        </span></p>
                    <p class=MsoNormal><span style="font-size:12.0pt;font-family:Script MT Bold;color:#1F3864">“Su visión será
                            clara solo cuando mira a su corazón. El que mira hacia afuera, sueña.  El que mira hacia dentro,
                            despierta”<o:p></o:p></span></p>
                    <p class=MsoNormal><span style="font-size:12.0pt;font-family:Script MT Bold;color:#1F3864">Carl Jung<o:p>
                            </o:p></span></p>
                    <p class=MsoNormal><span style="font-size:10.0pt;font-family:Verdana,sans-serif"><img border=0 width=200
                                height=87 style="width:2.0833in;height:.9062in" id=Imagen_x0020_1
                                src=cid:image001.png@01D88E03.4839E730></span><span
                            style="font-family:Script MT Bold;color:#1F3864">
                            <o:p></o:p>
                        </span></p>
                </div>
        
            </div>
        
        </div>');

            $mail->send();

            return 'ok';
        } catch (Exception $e) {

            return $mail->ErrorInfo;
        }
    }
}



// /*=============================================
// ENVIO DE CORREO COTIZACION EMPRESARIAL
// =============================================*/
// $envio_correo_empresarial = new Envio_correo_notificacion_documentos_faltantes_seguimiento_reembolso();
// $envio_correo_empresarial -> realizar_envio_correo_notificacion_documentos_faltantes_seguimiento_reembolso();