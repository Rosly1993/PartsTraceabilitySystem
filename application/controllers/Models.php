<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Models extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('models_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user')){
            // User is logged in, load the areas data
            $data['models'] = $this->models_model->get_models();
            
            // Load the areas view with data
            $this->load->view('models/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_models() {
        $data = $this->models_model->get_models();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_model_details($id) {
        $model_details = $this->models_model->get_model_details($id);
        echo json_encode(['model_details' => $model_details]);
    }    

    public function add_model() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Get form data
            $model = strtoupper($this->input->post('modelName'));
            $created_by = $this->input->post('userdata');
    
            // Check if the area already exists
            $existing_area = $this->models_model->get_model_by_name($model);
            if ($existing_area) {
                // Area already exists, return error response
                $response['status'] = 'error';
                $response['message'] = 'Model already exists!';
            }else{

           
                // If the item doesn't exist, add it to the database
                $this->models_model->add_model($model, $created_by);
        
                // Return a success response
                $response['status'] = 'success';
                $response['message'] = 'Model added successfully!';
            }
        
            // Send the JSON-encoded response
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }


        public function update_model() {
            $id = $this->input->post('id');
            $model = strtoupper($this->input->post('model')); // Convert to uppercase
            $userdata = $this->input->post('userdata');
            $updated_at =date('Y-m-d h:i');
        
            // Fetch the existing data from the database
            $existing_data = $this->db->get_where('set_models', array('id' => $id))->row_array();
        
            // Check if there are changes
            if ($existing_data['model'] === $model) {
                // No changes, return a response indicating no changes
                echo json_encode(array('status' => 'no_changes', 'message' => 'No changes detected.'));
                return;
            }
        
            // Check if the combination of lines and area_id already exists in the database
            $existing_combination = $this->db->get_where('set_models', array('model' => $model))->row_array();
            if ($existing_combination && $existing_combination['id'] != $id) {
                // Combination already exists, return a response indicating duplicate data
                echo json_encode(array('status' => 'duplicate', 'message' => 'Model already exists.'));
                return;
            }
        
            // Changes detected and no duplicate combination, proceed with updating the data
            $data = array(
                'model' => $model,
                'created_by' => $userdata,
                'updated_at' => $updated_at
            );
        
            $this->db->where('id', $id);
            $result = $this->db->update('set_models', $data);
            if ($result) {
                echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
            }
        }
        
        
       
        
        
    
        public function delete_model() {
            $this->models_model->delete_model();
            echo json_encode(['success' => true]);
        }
    }
        

        ?>