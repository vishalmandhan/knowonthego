<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_cont extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('changePass_model');
        $this->load->model('forgotPass_model');

    }

    /*   ==============================================================
               LOGIN
            ============================================================== */
    public function login()
    {
        if ($_POST) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run()) {

                //true
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $check_success = $this->login_model->login($username, $password);
                if (!$check_success) {
                    $data['db_error'] = "Invalid Username or Password";
                }

                $this->load->model('login_model');
                $user_data = $this->login_model->login($username, md5($password));

                if ($user_data) {

                    $session_data = array(
                        'user_id' => $user_data['user_id'],
                        'full_name' => $user_data['user_name'],
                        'username' => $user_data['username'],
                        'user_email' => $user_data['user_email'],
                        'is_admin' => ($user_data['fk_user_type_id'] == 1) ? 1 : 0
                    );

                    $this->session->set_userdata("user_login_data", $session_data);
                    //$session_data = $this->session->userdata('user_login_data');
                    redirect(site_url() . '/dashboard_cont/dashboard');

                } else {

                    $this->session->set_flashdata('error', 'Invalid Username or Password. Try Again');
                    redirect(site_url() . '/login_cont/login');
                }
            } else {
                //false
                $this->load->view('know/login_view');
            }
        }

        $this->load->view('know/login_view');
    }

    /*   ==============================================================
               LOGOUT
            ============================================================== */
    public function logout()
    {
        $this->session->unset_userdata('Email');
        redirect(site_url() . '/home_cont/index');
    }


    /*   ==============================================================
           FORGOT PASSWORD
        ============================================================== */

    public function forgotPassword()
    {
        $this->load->view('know/Forgot_password');
    }

    public function resetPassword()
    {

        if ($_POST) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('know/Forgot_password');
            } else {

                $this->load->model('forgotPass_model');
                $email = $this->input->post('email');

                $result = $this->forgotPass_model->checkEmail($email);

                if ($result == FALSE) {
                    $this->session->set_flashdata('error', 'Email Not Found. Try Again');
                    redirect(site_url() . '/login_cont/forgotPassword');
                } else {
                    $sent = $this->forgotPass_model->sendPassword($email);
                    if ($sent == TRUE) {

                        $this->session->set_flashdata("success", "Password Sent to Your Email ");
                        redirect('login_cont/forgotPassword');

                    }
                }
            }
        }
    }

    /*   ==============================================================
           CHANGE PASSWORD
        ============================================================== */
    public function change_Password()
    {
        if ($_POST) {
            // password field with confirmation field matching
            $this->form_validation->set_rules('old_password', 'Password', 'required');
            $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[8]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]|min_length[8]');

            if ($this->form_validation->run() == FALSE) {
//                echo "<script type='text/javascript'>
//                alert('PASSWORD MUST BE MINIMUM 8 CHARACTER LONG!!');
//                </script>";
//                $this->session->set_flashdata("error", "PASSWORD LENGTH SHOULD BE 8 CHARACTER LONG!!");
            } else {

                $user_session = $this->session->userdata('user_login_data');

                $old_password = $this->input->post('old_password');
                $new_password = $this->input->post('new_password');
                $confirm_password = $this->input->post('confirm_password');

                $result = $this->changePass_model->updatePassword($user_session['user_email'] ,md5($old_password), md5($new_password));

                if ($result == TRUE) {
                    $this->session->set_flashdata("success", "Congrats. Password Updated Successfully.");
                    redirect('login_cont/change_password');
                } else {
                    $this->session->set_flashdata("error", "Old Password Does Not Match. Try Again");
                    redirect('login_cont/change_password');
                }
            }
        }
        $this->load->view('know/change_password');
    }
}