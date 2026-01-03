<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';
require '../../model/modelo_cliente.php';
require '../../model/modelo_usuario.php';

use PHPMailer\PHPMailer\PHPMailer;

class Envio_correo_recuperacion_acceso
{

    function realizar_envio_correo_recuperacion_acceso()
    {
        date_default_timezone_set("America/Guayaquil");

        $cedula = $_POST['usuario'];
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        $cadena = substr(str_shuffle($permitted_chars), 0, 10);
        $contra = password_hash($cadena, PASSWORD_DEFAULT, ['cost' => 12]);
        $fecha_actual = date('Y-m-d'); // Fecha actual
        $fecha_caduca = date('Y-m-d', strtotime($fecha_actual . ' +90 days'));

        $MU = new Modelo_Usuario();
        $consulta = $MU->Reset_Password_Usuario($cedula, $contra, $fecha_caduca);

        $idUsuario = 0;

        for ($i = 0; $i < count($consulta); $i++) {
            $idUsuario = $consulta[$i]["valor"];
        }

        if ($idUsuario > 0) {

            $MU1 = new Modelo_Usuario();
            $consulta1 = $MU1->TraerDatosUsuario($idUsuario);

            $nombre = "";
            $correo = "";
            $rol = "";

            for ($i = 0; $i < count($consulta1); $i++) {
                $nombre = $consulta1[$i]["usuario_nombre"];
                $correo = $consulta1[$i]["usuario_email"];
                $rol = $consulta1[$i]["rol_nombre"];
            }

            if ($rol == 'CLIENTE') {

                $MC = new Modelo_Cliente();
                $consultaCliente = $MC->TraerDatosClienteCedula($cedula);

                for ($j = 0; $j < count($consultaCliente); $j++) {
                    $nombre = $consultaCliente[$j]["cliente_nombre"];
                }
            }

            // if (strlen($correo) < 2) {
            //     $correo = "faustoochoa@mqpseguros.com";
            // }


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
                $mail->setFrom('info@mqpseguros.com', 'Servicios MQP Seguros');

                $mail->addAddress($correo, $nombre);

                $mail->addCC('info@mqpseguros.com', 'Info MQP Seguros');     //Add a recipient
                $mail->addCC('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');
                $mail->addCC('faustoochoa@mqpseguros.com', 'Info MQP Seguros');     //Add a recipient

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                $mail->addAttachment("../../view/documentos-info/CANALES DE INFORMACION.pdf");

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'RECUPERACIÓN DE CONTRASEÑAS PARA ACCESO AL PORTAL MQP ASESORES DE SEGUROS';
                //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                        <div style="position:relative; margin:auto; width:800px; background:white; padding-top:20px; padding-bottom:20px">
                            <center>
                                <img style="padding:20px; width:15%" src="https://crm.mqpseguros.com/view/img/icon-email.png">
                            </center>

                            <h4 style="font-weight:100; color:#999; padding:0px 20px;">Estimado Cliente: ' . $nombre . '</h4>
                            <h4 style="font-weight:100; color:#999; padding:0px 20px;">Te damos la bienvenida a MQP Asesores de Seguros, la plataforma que te ayudará administrar tus seguros.
                            </h4>
                            <h4 style="font-weight:100; color:#999; padding:0px 20px;">A continuación tus credenciales.
                            </h4>
                            <h4 style="font-weight:100; color:#999; padding:0px 20px;"> Link: <a href="https://crm.mqpseguros.com"><strong>https://crm.mqpseguros.com</strong></a>
                            </h4>
                            <h4 style="font-weight:100; color:#999; padding:0px 20px;">Usuario: <strong>' . $cedula . '</strong>
                            </h4>
                            <h4 style="font-weight:100; color:#999; padding:0px 20px;">Contrase&ntilde;a: <strong>' . $cadena . '</strong>
                            </h4>

                            <h4 style="font-weight:100; color:#999; padding:0px 20px;">Adjuntamos nuestros canales de información y los siguientes mails.
                            </h4>

                            <center>
                                <table style=" border: 1px solid #1C6EA4;background-color: #EEEEEE;width: 60%;text-align: left;border-collapse: collapse;">
                                    <thead style="background: #1C6EA4;background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);border-bottom: 2px solid #444444;">
                                        <th style="font-size: 15px;font-weight: bold;color: #000000;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                            CORREO</th>
                                        <th style="font-size: 15px;font-weight: bold;color: #000000;border-left: 2px solid #D0E4F5; border:1px solid #AAAAAA;padding: 3px 2px;">
                                            DESCRIPCIÓN</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border:1px solid #AAAAAA;">info@mqpseguros.com</td>
                                            <td style="border:1px solid #AAAAAA;">Canal para conocer el estado de sus pólizas, cambios de plan, consultas en general.</td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #AAAAAA;">reembolsos@mqpseguros.com</td>
                                            <td style="border:1px solid #AAAAAA;">
                                                Canal para conocer el estado de sus reembolsos asistencia médica.</td>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #AAAAAA;">siniestros@mqpseguros.com</td>
                                            <td style="border:1px solid #AAAAAA;">Canal para conocer el estado de sus siniestros vehiculares.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </center>

                            <p style="color:#000000; padding:15px 20px; font-size:14px; line-height:1.5;">
                                <strong>Nota:</strong> Declaramos contar con el consentimiento explícito para llevar a cabo el trámite en beneficio del cliente.
                            </p>

                            <div class=WordSection1>
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

                echo 'ok';
            } catch (Exception $e) {

                echo $mail->ErrorInfo;
            }
        } else {
            echo "No existe el usuario";
        }
    }
}



// /*=============================================
// ENVIO DE CORREO DATOS ACCESO PLATAFORMA
// =============================================*/
$envio_correo_acceso_plataforma = new Envio_correo_recuperacion_acceso();
$envio_correo_acceso_plataforma->realizar_envio_correo_recuperacion_acceso();