<?php
/**
 * Created by PhpStorm.
 * User: Aakash
 * Date: 29-Nov-18
 * Time: 8:43 PM
 */

class forgotPass_model extends CI_Model
{


    public function checkEmail($email){
        $this->db->select('user_email');
        $this->db->from('users');
        $this->db->where('user_email', $email);
        $query = $this->db->get();
        return $query->row();
    }

    public function sendPassword($email)
    {
        $this->load->library('email');

        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('user_email', $email);
        $query = $this->db->get();

        $row = $query->result_array();
        if ($query->num_rows() > 0) {
            $passwordplain = "";
            $passwordplain = (rand(100000, 10000000));
            $newpass['password'] = md5($passwordplain);
            $this->db->where('user_email', $email);
            $this->db->update('users', $newpass);

            //Sending Email
            $subject = 'Password Reset';
            $mail_message = 'Your New Password Is: <b>' . $passwordplain . '</b>' . "\r\n";
            $mail_message .= '<br>Please Update your password.';
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
            $mail->Subject = 'Reset Password';
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

