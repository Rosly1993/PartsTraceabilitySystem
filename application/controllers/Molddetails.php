<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Molddetails extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('molddetails_model');
        $this->load->model('models_model'); // Load the Models model for dropdown
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user')){
            // User is logged in, load the areas data
            $data['molddetails'] = $this->molddetails_model->get_molddetails();
            $data['models'] = $this->models_model->get_models(); // Fetch models data
            
            // Load the areas view with data
            $this->load->view('molddetails/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_molddetails() {
        $data = $this->molddetails_model->get_molddetails();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_molddetails_details($id) {
        $molddetails_details = $this->molddetails_model->get_molddetails_details($id);
        echo json_encode(['molddetails_details' => $molddetails_details]);
    }    

    public function add_molddetails() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Get form data
            $model = $this->input->post('model');
            $mold_no = $this->input->post('mold_no');
            $cavityno = $this->input->post('cavity_no');
            $cavity1 = strtoupper($this->input->post('cavity1'));
            $cavity2 = strtoupper($this->input->post('cavity2'));
            $cavity3 = strtoupper($this->input->post('cavity3'));
            $cavity4 = strtoupper($this->input->post('cavity4'));
            $created_by = $this->input->post('userdata');
    
            // Check if the area already exists
            $existing_mold = $this->molddetails_model->get_molddetails_by_name($model,$mold_no);
            if ($existing_mold) {
                // Area already exists, return error response
                $response['status'] = 'error';
                $response['message'] = 'Mold already exists!';
            }else{

           
                // If the item doesn't exist, add it to the database
                $this->molddetails_model->add_molddetails($model, $mold_no, $cavityno, $cavity1, $cavity2, $cavity3, $cavity4, $created_by);
        
                // Return a success response
                $response['status'] = 'success';
                $response['message'] = 'Mold added successfully!';
            }
        
            // Send the JSON-encoded response
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }


        public function update_molddetails() {
            $id = $this->input->post('id');
            $model = strtoupper($this->input->post('model')); // Convert to uppercase
            $mold_no = $this->input->post('mold_no');
            $cavity1 = strtoupper($this->input->post('cavity1'));
            $cavity2 = strtoupper($this->input->post('cavity2'));
            $cavity3 = strtoupper($this->input->post('cavity3'));
            $cavity4 = strtoupper($this->input->post('cavity4'));
            $userdata = $this->input->post('userdata');
            $updated_at =date('Y-m-d h:i');
        
            // Fetch the existing data from the database
            $existing_data = $this->db->get_where('set_molddetails', array('id' => $id))->row_array();
        
            // Check if there are changes
            if ($existing_data['model'] === $model && $existing_data['mold_no'] == $mold_no && $existing_data['cavity1'] == $cavity1 && $existing_data['cavity2'] == $cavity2 && $existing_data['cavity3'] == $cavity3 && $existing_data['cavity4'] == $cavity4) {
                // No changes, return a response indicating no changes
                echo json_encode(array('status' => 'no_changes', 'message' => 'No changes detected.'));
                return;
            }
        
            // Check if the combination of lines and area_id already exists in the database
            $existing_combination = $this->db->get_where('set_molddetails', array('model' => $model, 'mold_no' => $mold_no))->row_array();
            if ($existing_combination && $existing_combination['id'] != $id) {
                // Combination already exists, return a response indicating duplicate data
                echo json_encode(array('status' => 'duplicate', 'message' => 'Combination of Model and Mold Number already exists.'));
                return;
            }
        
            // Changes detected and no duplicate combination, proceed with updating the data
            $data = array(
                'model' => $model,
                'mold_no' => $mold_no,
                'cavity1' => $cavity1,
                'cavity2' => $cavity2,
                'cavity3' => $cavity3,
                'cavity4' => $cavity4,
                'created_by' => $userdata,
                'updated_at' => $updated_at
            );
        
            $this->db->where('id', $id);
            $result = $this->db->update('set_molddetails', $data);
            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
            }
        }
        
        
       
        
        
    
        public function delete_area() {
            $this->areas_model->delete_area();
            echo json_encode(['success' => true]);
        }
    }
        

        ?>