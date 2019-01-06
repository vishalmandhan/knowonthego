<?php
/**
 * Created by PhpStorm.
 * User: Aakash
 * Date: 27-Nov-18
 * Time: 4:29 PM
 */

class changePass_model extends CI_Model
{
    public function updatePassword($email, $old_password, $new_password){

//        $query = $this->db->query("SELECT password from users where password = '" . $old_password . "' ");

        $this->db->where('user_email', $email);
        $this->db->where('password', $old_password);
        $query = $this->db->get('users');

        $row = $query->result_array();
        if ($row) {
            $this->db->set('password', $new_password);
            $this->db->where('user_email', $email);
            $this->db->where('password', $old_password);
            $this->db->update('users');

            //Sending Email
            $subject = 'User Credentials';
            $mail_message = '';
            $mail_message .= '<br>Password Changed Successfully: <b>';
            $mail_message .= '<br>';
            $mail_message .= '<br>';
            $mail_message .= '<br>';
            $mail_message .= '<br>Regards';
            $mail_message .= '<br>Akshay & Aakash ';
            $mail_message .= '<br>E: know.otg@gmail.com';

            date_default_timezone_set('Etc/UTC');

            require FCPATH . 'assets/PHPMailer/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPSecure = "tls";
            $mail->Debugoutput = 'html';
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = "know.otg@gmail.com";
            $mail->Password = "abc123456@";
            $mail->setFrom('know.otg@gmail.com', 'KNOW-OTG');
            $mail->IsHTML(true);
            $mail->addAddress($email);
            $mail->Subject = 'Change Password';
            $mail->Body = $mail_message;
            $mail->AltBody = $mail_message;

            if (!$mail->send()) {
                echo "Mailer Error:" . $mail->ErrorInfo;
            } else {
                echo "Message sent Successfully!";
            }


            return true;
        }
    }

}