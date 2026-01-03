<?php

use PHPMailer\PHPMailer\PHPMailer;

class Envio_correo_condiciones_renovacion_asistencia_medica
{

    function realizar_envio_correo_condiciones_renovacion_asistencia_medica($nombre, $email, $listaCondiciones, $ruta_condiciones, $fecha_fin, $nombre_proveedor)
    {

        $aseguradora = "";

        for ($i = 0; $i < count($nombre_proveedor); $i++) {
            $aseguradora = $nombre_proveedor[$i]["proveedor_descripcion"];
        }

        $lista = json_decode($listaCondiciones, true);
        $listado_documentos = "";

        foreach ($lista as $value) {

            $opciones = '<td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: left; color:#000000;">' . $value["condicion"] . '</td>
                        <td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center; color:#000000;">' . $value["valor"] . '</td>';

            $listado_documentos .= '<tr>' . $opciones . '</tr>';
        }

        if ($listado_documentos == "") {
            $listado_documentos = '<tr>
                <td style="border: 1px solid #AAAAAA;padding: 3px 2px;font-size: 13px; text-align: center;">SIN REGISTROS</td>
                </tr>';
        }

        date_default_timezone_set('America/Guayaquil');

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

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
            $mail->setFrom('mireyaquintana@mqpseguros.com', 'Servicios MQP Seguros');
            $mail->addAddress($email, $nombre);
            $mail->addReplyTo('info@mqpseguros.com', 'Servicios MQP Seguros');     //Add a recipient
            $mail->addReplyTo('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');     //Add a recipient
            $mail->addCC('info@mqpseguros.com', 'Servicios MQP Seguros');     //Add a recipient
            $mail->addCC('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');
            $mail->addCC('faustoochoa@mqpseguros.com', 'Prueba MQP Seguros');

            //Attachments
            if ($ruta_condiciones != "") {
                $mail->addAttachment("../../" . $ruta_condiciones);
            }

            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'IMPORTANTE: RENOVACIÓN DE ASISTENCIA MÉDICA CON ' . $aseguradora . ' - ' . $nombre;
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                    <div style="position:relative; margin:auto; width:800px; background:white; padding-top:20px; padding-bottom:20px">
                
                        <h4 style="font-weight:100; color:#999; padding:0px 20px; color: #000000;">Apreciado Cliente: ' . $nombre . '</h4>
                        <h4 style="font-weight:100; color:#999; padding:0px 20px; color: #000000; text-align: justify"> Agradecemos la confianza depositada durante este año, ratificamos nuestro compromiso para seguirle acompañando, brindado la tranquilidad y confianza para que usted y su familia estén siempre protegidos. Nos permitimos informarle que está próximo a la renovación de su contrato de medicina prepagada, para lo cual ponemos a su disposición las condiciones y cambios que aplicarán para su plan actual.
                        </h4>
                
                        <h4 style="font-weight:100; color:#999; padding:0px 20px; color: #000000;">Fecha renovación:' . $fecha_fin . '
                        </h4>
                        <center>
                            <table style=" border: 1px solid #1C6EA4;background-color: #EEEEEE;width: 60%;text-align: left;border-collapse: collapse;">
                                <thead style="background: #1C6EA4;background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);border-bottom: 2px solid #444444;">
                                    <th style="font-size: 15px;font-weight: bold;color: #000000;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                        FORMAS DE PAGO</th>
                                    <th style="font-size: 15px;font-weight: bold;color: #000000;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                        VALOR USD</th>
                                </thead>
                                <tbody>
                                    ' . $listado_documentos . '
                                </tbody>
                            </table>
                        </center>
                        <h4 style="font-weight:100; color:#999; padding:0px 20px; color: #000000;">*Valor renovación*
                        </h4>

                        <p style="color:#000000; padding:15px 20px; font-size:14px; line-height:1.5;">
                            <strong>Nota:</strong> Declaramos contar con el consentimiento explícito para llevar a cabo el trámite en beneficio del cliente.
                        </p>
                
                        <div class=WordSection1>
                        <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Saludos cordiales,<o:p></o:p>
                                </span></p>
                            <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Departamento Servicio al Cliente<o:p></o:p>
                                    </span></b></p>
                            <p class=MsoNormal><span style="font-family:Arial,sans-serif">
                                    <o:p>&nbsp;</o:p>
                                </span></p>
                            <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Dirección:</span></b><span style="font-family:Arial,sans-serif"> <span style="color:#2F5496">Centro Empresarial Qworks - Quicentro Shopping, oficina 303
                                        <o:p></o:p>
                                    </span></span></p>
                            <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Código
                                        postal:</span></b><span style="font-family:Arial,sans-serif;color:#2F5496"> 170311</span><span style="font-family:Arial,sans-serif">
                                    <o:p></o:p>
                                </span></p>
                            <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Celular:</span></b><span style="font-family:Arial,sans-serif"> <span style="color:#2F5496">59398 940 9581</span>
                                    <o:p></o:p>
                                </span></p>
                            <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Web:</span></b><span style="font-family:Arial,sans-serif"> <span style="color:#2F5496">https://<a href=http://www.mqpseguros.com><span style="color:#2F5496">www.mqpseguros.com</span></a></span>
                                    <o:p></o:p>
                                </span></p>
                            <p class=MsoNormal><b><span style="font-family:Arial,sans-serif;color:#1F3864">Credencial:</span></b><span style="font-family:Arial,sans-serif"> <span style="color:#2F5496">1793190</span>
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
                            <p class=MsoNormal><span style="font-size:10.0pt;font-family:Verdana,sans-serif"><img border=0 width=200 height=87 style="width:2.0833in;height:.9062in" id=Imagen_x0020_1 src=cid:image001.png@01D88E03.4839E730></span><span style="font-family:Script MT Bold;color:#1F3864">
                                    <o:p></o:p>
                                </span></p>
                        </div>
                
                    </div>');

            $mail->send();

            return 'ok';
        } catch (Exception $e) {

            return $mail->ErrorInfo;
        }
    }
}