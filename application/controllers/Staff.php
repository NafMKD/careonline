<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends Home_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!is_staff()) {
            redirect(base_url());
        }
    }


    public function appointments()
    {  
        $data = array();
        $data['page'] = 'Staffs';
        $data['page_title'] = 'Appointments';
        $data['page_lang'] = 'appointments';
        $data['menu'] = FALSE;
        $data['appointments'] = $this->common_model->get_staff_appointments();
        $data['staff'] = $this->common_model->get_by_id(staff()->id, 'staffs');
        $data['company'] = $this->common_model->get_by_uid($data['staff']->business_id, 'business');
        $data['services'] = $this->common_model->get_services(staff()->user_id);
        $data['customers'] = $this->common_model->get_customers_by_userid(staff()->user_id);
        $data['main_content'] = $this->load->view('staffs/appointments', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function payment($id)
    {   
        $data = array();
        $data['page'] = 'staffs';
        $data['page_title'] = 'Payment';
        $data['menu'] = FALSE;
        $data['appointment'] = $this->common_model->get_appointment($id);
        $data['appointment_id'] = $data['appointment']->user_id;
        $data['user'] = $this->common_model->get_by_id($data['appointment']->user_id, 'users');
        $data['main_content'] = $this->load->view('staffs/payment', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function account()
    {   
        $data = array();
        $data['page'] = 'staffs';
        $data['page_title'] = 'Account';
        $data['page_lang'] = 'account';
        $data['menu'] = FALSE;
        $data['staff'] = $this->common_model->get_by_id(staff()->id, 'staffs');
        $data['main_content'] = $this->load->view('staffs/account', $data, TRUE);
        $this->load->view('index', $data);
    }


    //update
    public function update(){
        
        check_status();

        if ($_POST) {

            $id = $this->input->post('id', true);
            $data = array(
                'name' => $this->input->post('name', true),
                'phone' => $this->input->post('phone', true),
                'email' => $this->input->post('email', true)
            );

            // insert photos
            if($_FILES['photo']['name'] != ''){
                $up_load = $this->admin_model->upload_image('800');
                $data_img = array(
                    'image' => $up_load['images'],
                    'thumb' => $up_load['thumb']
                );
                $this->admin_model->edit_option($data_img, $id, 'staffs');   
            }

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'staffs');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('staff/account'));
        }
    }


    public function update_appointment($id)
    {	
        if($_POST)
        {   
            $data = array(
                'customer_id' => $this->input->post('customer_id', true),
                'service_id' => $this->input->post('service_id', true),
                'date' => $this->input->post('date', true),
                'time' => $this->input->post('start_time').'-'.$this->input->post('end_time'),
                'status' => $this->input->post('status', true)
            );
            
            if (date('Y-m-d') > $this->input->post('date')) {
                $this->session->set_flashdata('error', trans('select-a-valid-date'));  
                redirect(base_url('staff/appointments'));
            }

            $this->common_model->edit_option($data, $id, 'appointments');
            $this->session->set_flashdata('msg', trans('updated-successfully')); 
            redirect(base_url('staff/appointments'));
        }
    }


    //cancel appointment
    public function cancel_appointment($status, $id){
        $data = array(
            'status' => $status
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'appointments');
        $this->session->set_flashdata('msg', trans('updated-successfully')); 
        redirect(base_url('staff/appointments'));
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'appointments'); 
        echo json_encode(array('st' => 1));
    }



    public function change_password()
    {
        $data = array();
        $data['page'] = 'staffs';
        $data['menu'] = FALSE;
        $data['page_title'] = 'Change Password';
        $data['page_lang'] = 'change-password';
        $data['staff'] = $this->common_model->get_by_id($this->session->userdata('id'), 'staffs');
        $data['main_content'] = $this->load->view('staffs/account', $data, TRUE);
        $this->load->view('index', $data);
    }
    

    //change password
    public function change()
    {   
        check_status();

        if($_POST){
            
            $id = $this->session->userdata('id');
            $user = $this->admin_model->get_by_id($id, 'staffs');

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, 'staffs');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }



}