<?php
require '../../extensiones/PHPMailer/src/Exception.php';
require '../../extensiones/PHPMailer/src/PHPMailer.php';
require '../../extensiones/PHPMailer/src/SMTP.php';
require '../../model/modelo_cliente.php';

use PHPMailer\PHPMailer\PHPMailer;

class Envio_correo_notificacion_acceso_plataforma
{

    function realizar_envio_correo_notificacion_acceso_plataforma()
    {

        $idCliente = $_POST["idCliente"];

        $MU = new Modelo_Cliente();

        $consulta = $MU->TraerDatosCliente($idCliente);

        $nombre = "";
        $correo = "";
        $cliente_email_opcional = "";
        $cedula = "";

        for ($i = 0; $i < count($consulta); $i++) {
            $nombre = $consulta[$i]["cliente_nombre"];
            $correo = $consulta[$i]["cliente_email"];
            $cliente_email_opcional = $consulta[$i]["cliente_email_opcional"];
            $cedula = $consulta[$i]["cliente_ci"];
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
            $mail->setFrom('info@mqpseguros.com', 'Servicios MQP Seguros');
            $mail->addAddress($correo, $nombre);
            if ($cliente_email_opcional != "") {
                $mail->addAddress($cliente_email_opcional, $nombre . " opcional");
            }
            $mail->addReplyTo($correo, $nombre);

            $mail->addCC('info@mqpseguros.com', 'Info MQP Seguros');     //Add a recipient
            $mail->addCC('nicolasparedes@mqpseguros.com', 'Nicolas Paredes');
            $mail->addCC('faustoochoa@mqpseguros.com', 'Info MQP Seguros');     //Add a recipient

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            $mail->addAttachment("../../view/documentos-info/CANALES DE INFORMACION.pdf");
            $mail->addAttachment("../../view/documentos-info/Manual-CRM-2025.pdf");

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'BIENVENIDO A MQP ASESORES: INSTRUCCIONES DE ACCESO AL PORTAL';
            //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->msgHTML('<div style="margin:0; padding:0; background-color: #f4f4f4; font-family: Arial, sans-serif;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f4f4;">
            <tr>
                <td align="center" style="padding: 20px 0;">

                    <table width="600" border="0" cellspacing="0" cellpadding="0"
                        style="background-color: #ffffff; border: 1px solid #dddddd;">

                        <tr>
                            <td align="center" style="padding: 30px 0 20px 0;">
                                <img src="https://crm.mqpseguros.com/view/img/icon-email.png" alt="MQP Logo" width="100"
                                    style="display: block; border:0;">
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 40px;">
                                <h1 style="color: #1c6ea4; font-size: 22px; margin: 0 0 20px 0; text-align: center;">
                                    ¡Bienvenido a MQP Asesores de Seguros!</h1>
                                <p style="color: #555555; font-size: 15px; line-height: 24px; margin: 0 0 20px 0;">
                                    Estimado Cliente ' . $nombre . ',<br><br>
                                    Es un gusto saludarte. Hemos habilitado tu acceso a nuestra plataforma exclusiva
                                    para la
                                    gestión integral de tus pólizas vigentes.
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 40px 20px 40px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="20"
                                    style="background-color: #f9f9f9; border: 1px solid #eeeeee;">
                                    <tr>
                                        <td>
                                            <p style="margin: 0 0 10px 0; font-size: 14px; color: #333;"><strong>Tus
                                                    credenciales de acceso:</strong></p>
                                            <p style="margin: 5px 0; font-size: 14px; color: #555;">
                                                <strong>Usuario:</strong> ' . $cedula . '
                                            </p>
                                            <p style="margin: 5px 0; font-size: 14px; color: #555;">
                                                <strong>Contraseña:</strong> (Número de Cédula/RUC)
                                            </p>

                                            <div
                                                style="height: 15px; line-height: 15px; font-size: 1px; border-bottom: 1px solid #dddddd; margin-bottom: 15px;">
                                                &nbsp;</div>

                                            <p style="margin: 0 0 5px 0; font-size: 13px; color: #777;">URL de acceso
                                                directo:</p>
                                            <a href="https://crm.mqpseguros.com"
                                                style="color: #1c6ea4; font-weight: bold; font-size: 15px; text-decoration: underline;">https://crm.mqpseguros.com</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 40px 30px 40px;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="15"
                                    style="background-color: #fff9e6; border-left: 4px solid #f1c40f;">
                                    <tr>
                                        <td style="color: #856404; font-size: 14px; line-height: 20px;">
                                            <strong>⚠️ NOTA SOBRE ARCHIVOS ADJUNTOS:</strong><br>
                                            Hemos adjuntado documentos importantes a este correo. Le solicitamos
                                            <strong>revisarlos detalladamente</strong>, ya que contienen información
                                            vital
                                            sobre su cobertura.
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 40px 30px 40px;">
                                <p style="margin: 0 0 15px 0; font-size: 14px; color: #333; font-weight: bold;">Canales
                                    de
                                    Atención:</p>
                                <table width="100%" border="0" cellspacing="0" cellpadding="10"
                                    style="border-collapse: collapse; font-size: 12px; border: 1px solid #dddddd;">
                                    <tr style="background-color: #1c6ea4;">
                                        <td style="color: #ffffff; border: 1px solid #1c6ea4; font-weight: bold;">CORREO
                                        </td>
                                        <td style="color: #ffffff; border: 1px solid #1c6ea4; font-weight: bold;">
                                            DESCRIPCIÓN</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #dddddd; color: #555;">info@mqpseguros.com</td>
                                        <td style="border: 1px solid #dddddd; color: #555;">Pólizas, cambios y consultas
                                            generales.</td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #dddddd; color: #555;">reembolsos@mqpseguros.com
                                        </td>
                                        <td style="border: 1px solid #dddddd; color: #555;">Estado de reembolsos
                                            médicos.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #dddddd; color: #555;">siniestros@mqpseguros.com
                                        </td>
                                        <td style="border: 1px solid #dddddd; color: #555;">Siniestros vehiculares.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 30px 40px; background-color: #fcfcfc; border-top: 1px solid #eeeeee;">
                                <p style="margin: 0; color: #1f3864; font-weight: bold; font-size: 14px;">Servicio al
                                    Cliente - MQP Asesores</p>
                                <p style="margin: 5px 0; color: #666666; font-size: 12px; line-height: 18px;">
                                    Centro Empresarial Qworks - Quicentro Shopping, Of. 303<br>
                                    Celular: 593 98 940 9581 | <a href="https://www.mqpseguros.com"
                                        style="color: #1c6ea4; text-decoration: none;">www.mqpseguros.com</a>
                                </p>
                                <p
                                    style="margin: 15px 0 0 0; font-family: Georgia, serif; font-style: italic; color: #1f3864; font-size: 13px;">
                                    “Su visión será
                                    clara solo cuando mira a su corazón. El que mira hacia afuera, sueña.  El que mira
                                    hacia
                                    dentro,
                                    despierta” - Carl Jung
                                </p>
                            </td>
                        </tr>

                    </table>

                    <table width="600" border="0" cellspacing="0" cellpadding="20">
                        <tr>
                            <td style="font-size: 11px; color: #999999; text-align: center; line-height: 16px;">
                                <strong>Aviso Legal:</strong> Declaramos contar con el consentimiento explícito para
                                llevar
                                a cabo el trámite en beneficio del cliente.<br>
                                Este es un correo informativo, no es necesario responder.
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </div>');

            $mail->send();

            echo 'ok';
        } catch (Exception $e) {

            echo $mail->ErrorInfo;
        }
    }
}



// /*=============================================
// ENVIO DE CORREO DATOS ACCESO PLATAFORMA
// =============================================*/
$envio_correo_acceso_plataforma = new Envio_correo_notificacion_acceso_plataforma();
$envio_correo_acceso_plataforma->realizar_envio_correo_notificacion_acceso_plataforma();
