<?php

use PHPMailer\PHPMailer\PHPMailer;

class Envio_correo_aseguradora_con_documentos_reembolso_empresarial
{

    function realizar_envio_correo_aseguradora_con_documentos_reembolso_empresarial($idReembolso, $idContrato)
    {

        $MU = new Modelo_Reembolso_Cliente_Empresarial();

        $consulta = $MU->traer_reembolso_unico($idReembolso, $idContrato);

        $nombre = "";
        $aseguradora = "";
        $lista_correo_reembolso = "";
        $cliente_email = "";
        $cliente_email_opcional = "";
        $Ticket = 0;
        $numero_contrato = "";
        $reembolso_descripcion = "";

        $nombre_paciente = "";
        $diagnostico = "";
        $valor_presentado = "";

        $documento = "";

        for ($i = 0; $i < count($consulta); $i++) {
            $nombre = $consulta[$i]["cliente_nombre"];
            $aseguradora = $consulta[$i]["proveedor_descripcion"];
            $lista_correo_reembolso = json_decode($consulta[$i]["proveedor_correo_reembolsos"], true);
            $cliente_email = $consulta[$i]["cliente_email"];
            $cliente_email_opcional = $consulta[$i]["cliente_email_opcional"];
            $Ticket = $consulta[$i]["reembolso_id"];
            $numero_contrato = $consulta[$i]["contrato_numero"];
            $reembolso_descripcion = json_decode($consulta[$i]["reembolso_descripcion"], true);
            $documento = $consulta[$i]["DOCUMENTO"];
        }

        foreach ($reembolso_descripcion as $value) {

            $nombre_paciente = $value["nombre_paciente"];
            $diagnostico = $value["diagnostico"];
            $valor_presentado = $value["valor_presentado"];
        }

        date_default_timezone_set("America/Guayaquil");

        $meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");

        $mes =  $meses[date('n') - 1];

        $dia = date('d');
        $ano = date('Y');

        $fechaActual = $dia . " " . $mes . " " . $ano;
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

            foreach ($lista_correo_reembolso as $value) {
                $mail->addAddress($value["correo"], $value["destinatario"]);
            }
            if ($cliente_email != "") {
                $mail->addAddress($cliente_email, $nombre);
            }
            if ($cliente_email_opcional != "") {
                $mail->addAddress($cliente_email_opcional, $nombre . ' - Adicional');
            }

            $mail->addReplyTo('reembolsos@mqpseguros.com', 'Reembolsos MQP Seguros');     //Add a recipient
            $mail->addCC('reembolsos@mqpseguros.com', 'Reembolsos MQP Seguros');     //Add a recipient
            $mail->addCC('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');
            $mail->addCC('faustoochoa@mqpseguros.com', 'Prueba MQP Seguros');

            if ($documento != "") {
                $mail->addAttachment("../../" . $documento);
            }

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'REEMBOLSO SEGURO ' . $fechaActual . ' ' . $nombre;
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

            <div style="position:relative; margin:auto; width:800px; background:white; padding-bottom:20px">
        
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;">Estimados Colegas,</h3>
                <h3 style="font-weight:100; color:#000000; padding:0px 20px;">Adjunto sírvase encontrar, documentos de reembolso de acuerdo al siguiente detalle:</h3>
        
                <!-- <center> -->
                <h4 style="font-weight:100; color:#000000; padding:0px 20px;">Número de Contrato: ' . $numero_contrato . '
                    </h4>
                    <h4 style="font-weight:100; color:#000000; padding:0px 20px;">Nombre del Titular: ' . $nombre . '
                    </h4>
                    <h4 style="font-weight:100; color:#000000; padding:0px 20px;">Nombre Paciente: ' . $nombre_paciente . '</h4>
                    <h4 style="font-weight:100; color:#000000; padding:0px 20px;">Diagnóstico: ' . $diagnostico . '</h4>
        
                    <h4 style="font-weight:100; color:#000000; padding:0px 20px;">Valor presentado: $' . $valor_presentado . '</h4>
        
                <!-- </center> -->

                <p style="color:#000000; padding:15px 20px; font-size:14px; line-height:1.5;">
                    <strong>Nota:</strong> Declaramos contar con el consentimiento explícito para llevar a cabo el trámite en beneficio del cliente.
                </p>
        
                <div class=WordSection1>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Saludos cordiales,<o:p>
                                </o:p></span></b></p>
                    <p class=MsoNormal><span style="font-family:Arial,sans-serif">
                            <o:p>&nbsp;</o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Departamento Servicio al
                                Cliente<o:p></o:p>
                            </span></b></p>
                    <p class=MsoNormal><span style="font-family:Arial,sans-serif">
                            <o:p>&nbsp;</o:p>
                        </span></p>
                    <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Dirección:</span></b><span
                            style="font-family:Arial,sans-serif"> <span style="color:#2F5496">Centro Empresarial Qworks - Quicentro Shopping, oficina 303
                                <o:p></o:p>
                            </span></span></p>
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
// $envio_correo_empresarial = new Envio_correo_aseguradora_con_documentos_reembolso();
// $envio_correo_empresarial -> realizar_envio_correo_aseguradora_con_documentos_reembolso();