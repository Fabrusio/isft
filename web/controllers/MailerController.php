<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerController
{
    static public function sendNewUser($password, $email, $name, $last_name)
    {
        $id = UserController::getSessionData('id_user');

        $credential = UserModel::getFirstValidCredential($id);
        if ($credential === false) {
            error_log("Error: No se pudo obtener la credencial.");
            return false;
        }
        
        if ($credential === null) {
            error_log("Error: No se encontró ninguna credencial.");
            return false;
        }
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host =$credential['host'];;
        $mail->SMTPAuth = true;
        $mail->Username = $credential['email'];
        $mail->Password = $credential['token'];
        $mail->SMTPSecure =$credential['certificatedSSL'];;
        $mail->Port =$credential['port_email'];

        $mail->setFrom($credential['email'], 'ISFT 177');
        $mail->addAddress($email, 'Usuario');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Tu cuenta ha sido activada!";

        $htmlFile = 'views/html/activateAccount.html';


        $htmlContent = file_get_contents($htmlFile);
        $htmlContent = str_replace('{{name}}', $name, $htmlContent);
        $htmlContent = str_replace('{{last_name}}', $last_name, $htmlContent);
        $htmlContent = str_replace('{{email}}', $email, $htmlContent);
        $htmlContent = str_replace('{{password}}', $password, $htmlContent);
        $mail->Body = $htmlContent;
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }



    static public function generateNewPasswordviaEmail($email,$password){

        $id = UserController::getSessionData('id_user');
        $credential = UserModel::getFirstValidCredential($id);
        if ($credential === false) {
            error_log("Error: No se pudo obtener la credencial.");
            return false;
        }
        
        if ($credential === null) {
            error_log("Error: No se encontró ninguna credencial.");
            return false;
        }
        
        // Depuración
        error_log(print_r($credential, true));
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host =$credential['host'];;
        $mail->SMTPAuth = true;
        $mail->Username = $credential['email'];
        $mail->Password = $credential['token'];
        $mail->SMTPSecure =$credential['certificatedSSL'];;
        $mail->Port =$credential['port_email'];

        $mail->setFrom($credential['email'], 'ISFT 177');
        $mail->addAddress($email, 'Usuario');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Se le genero una nueva clave aleatoria!";

        $htmlFile = 'views/html/emailGeneratePassword.html';
        $htmlContent = file_get_contents($htmlFile);
        $htmlContent = str_replace('{{password}}', $password, $htmlContent);
        $mail->Body = $htmlContent;
         if ($mail->send()) {
            return true;
        } else {
            return false;
        }


    }

    static public function sendNewStudent($password, $email, $name, $last_name,$career)
    {
        $id = UserController::getSessionData('id_user');
        error_log("id",$id);

        $credential = UserModel::getFirstValidCredential($id);
        if ($credential === false) {
            error_log("Error: No se pudo obtener la credencial.");
            return false;
        }
        
        if ($credential === null) {
            error_log("Error: No se encontró ninguna credencial.");
            return false;
        }
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host =$credential['host'];;
        $mail->SMTPAuth = true;
        $mail->Username = $credential['email'];
        $mail->Password = $credential['token'];
        $mail->SMTPSecure =$credential['certificatedSSL'];;
        $mail->Port =$credential['port_email'];

        $mail->setFrom($credential['email'],'ISFT177');
        $mail->addAddress($email, 'Usuario');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "¡Tu cuenta ha sido activada!";

        $htmlFile = 'views/html/activateAccountStudent.html';


        $htmlContent = file_get_contents($htmlFile);
        $htmlContent = str_replace('{{career}}', $career, $htmlContent);
        $htmlContent = str_replace('{{name}}', $name, $htmlContent);
        $htmlContent = str_replace('{{last_name}}', $last_name, $htmlContent);
        $htmlContent = str_replace('{{email}}', $email, $htmlContent);
        $htmlContent = str_replace('{{password}}', $password, $htmlContent);
        $mail->Body = $htmlContent;
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }


}
