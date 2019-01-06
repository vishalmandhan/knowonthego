<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_cont extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('includes/home_header');
        $this->load->view('know/home_view');
        $this->load->view('includes/home_footer');
    }

    public function feedback()
    {
        if ($_POST) {

            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

            } else {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $usersubject = $this->input->post('subject');
                $message = $this->input->post('message');

                //=======================================================
                $this->load->library('email');
                //Sending Email
                $subject = 'User Feedback';
                $mail_message = '';
                $mail_message .= '<br>';
                $mail_message .= '<br>NAME : <b>' . $name .'</b>';
                $mail_message .= '<br>';
                $mail_message .= '<br>EMAIL : <b>' . $email .'</b>';
                $mail_message .= '<br>';
                $mail_message .= '<br>SUBJECT : <b>' . $usersubject .'</b>';
                $mail_message .= '<br>';
                $mail_message .= '<br>MESSAGE : <b>' . $message .'</b>';

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
                $mail->addAddress('know.otg@gmail.com');
                $mail->Subject = 'User Feedback';
                $mail->Body = $mail_message;
                $mail->AltBody = $mail_message;

                if (!$mail->send()) {
                    echo "Mailer Error:" . $mail->ErrorInfo;
                } else {
                    //echo "Message sent Successfully!";
                }
                //=======================================================
            }
        }
        $this->load->view('includes/home_header');
        $this->load->view('know/home_view');
        $this->load->view('includes/home_footer');
    }
}