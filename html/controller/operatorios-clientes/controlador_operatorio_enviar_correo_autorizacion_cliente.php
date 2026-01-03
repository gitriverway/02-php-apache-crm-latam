<?php

use PHPMailer\PHPMailer\PHPMailer;

class Envio_correo_notificacion_autorizacion_operatorio
{

    function realizar_envio_correo_notificacion_autorizacion_operatorio($idOperatorio, $idContrato)
    {

        $MU = new Modelo_Operatorio_Cliente();

        $consulta = $MU->traer_operatorio_unico($idOperatorio, $idContrato);

        $consulta_observaciones = $MU->listar_observacion_operatorios($idOperatorio);

        $nombre = "";
        $correo = "";
        $cliente_email_opcional = "";
        $Ticket = 0;
        $operatorio_descripcion = "";
        $autorizacion  = "";
        $aseguradora = "";
        $numero_contrato = "";

        $nombre_paciente = "";
        $diagnostico = "";
        $lugar_procedimiento = "";
        $fecha_procedimiento_operatorio = "";
        $valor_presentado = "";

        $lista_observaciones = "";
        $observacion_final = "";

        for ($i = 0; $i < count($consulta); $i++) {
            $nombre = $consulta[$i]["cliente_nombre"];
            $correo = $consulta[$i]["cliente_email"];
            $cliente_email_opcional = $consulta[$i]["cliente_email_opcional"];
            $Ticket = $consulta[$i]["operatorio_id"];
            $operatorio_descripcion = json_decode($consulta[$i]["operatorio_descripcion"], true);
            $aseguradora = $consulta[$i]["proveedor_descripcion"];
            $numero_contrato = $consulta[$i]["contrato_numero"];
            $autorizacion = $consulta[$i]["DOCUMENTO_AUTORIZACION"];
        }

        for ($j = 0; $j < count($consulta_observaciones); $j++) {
            $lista_observaciones = json_decode($consulta_observaciones[$j]["operatorio_observacion_descripcion"], true);
        }

        foreach ($operatorio_descripcion as $value) {

            $nombre_paciente = $value["nombre_paciente"];
            $diagnostico = $value["diagnostico"];
            $lugar_procedimiento = $value["lugar_procedimiento"];
            $fecha_procedimiento_operatorio = $value["fecha_procedimiento_operatorio"];
            $valor_presentado = $value["valor_presentado"];
        }


        foreach ($lista_observaciones as $value) {
            $observacion_final = $value["observaciones"];
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
            $mail->setFrom('mireyaquintana@mqpseguros.com', 'Creditos Hospitalarios MQP Seguros');
            $mail->addAddress($correo, $nombre);

            if ($cliente_email_opcional != "") {
                $mail->addAddress($cliente_email_opcional, $nombre . " opcional");
            }

            $mail->addReplyTo('creditohospitalario@mqpseguros.com', 'Credito Hospitalario MQP Seguros');     //Add a recipient
            $mail->addCC('creditohospitalario@mqpseguros.com', 'Credito Hospitalario MQP Seguros');     //Add a recipient
            $mail->addCC('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');
            $mail->addCC('faustoochoa@mqpseguros.com', 'Prueba MQP Seguros');

            //Attachments
            //Attachments
            if ($autorizacion != "") {
                $mail->addAttachment("../../" . $autorizacion);
            }
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'AUTORIZACIÓN APROBADA: CRÉDITO HOSPITALARIO Nº ' . $Ticket . ' FINALIZADO CON ÉXITO';
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

            <div style="position:relative; margin:auto; width:600px; background:white; padding-bottom:20px">
        
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;">Estimado Cliente: ' . $nombre . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;">Se adjunta la autorización emitida por la Compañia de Seguros ' . $aseguradora . ', ticket interno: Nº ' . $Ticket . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Número de Contrato: </strong>' . $numero_contrato . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Nombre del Titular: </strong> ' . $nombre . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Nombre del Paciente: </strong> ' . $nombre_paciente . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Diagnóstico: </strong> ' . $diagnostico . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Lugar del Procedimiento: </strong> ' . $lugar_procedimiento . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Fecha del Procedimiento: </strong> ' . $fecha_procedimiento_operatorio . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Valor presentado:</strong> $' . $valor_presentado . '</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;"><strong>Observación: </strong> ' . $observacion_final . '</h3>

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
// $envio_correo_empresarial = new Envio_correo_notificacion_autorizacion_operatorio();
// $envio_correo_empresarial -> realizar_envio_correo_notificacion_autorizacion_operatorio();