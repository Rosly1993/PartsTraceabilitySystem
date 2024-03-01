<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debplans extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('debplans_model');
        $this->load->model('molddetails_model'); // Load the Models model for dropdown
        $this->load->model('models_model'); // Load the Models model for dropdown
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user')){
            // User is logged in, load the areas data
            $data['debplans'] = $this->debplans_model->get_debplans();
            $data['molddetails'] = $this->molddetails_model->get_molddetails();

            $data['models'] = $this->models_model->get_models(); // Fetch models data
            // Load the areas view with data
            $this->load->view('debplans/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_mold_numbers() {
        // Retrieve the selected model from the AJAX request
        $selectedModel = $this->input->post('model');
    
        // Use the selected model to fetch corresponding mold numbers from your database
        // Assuming you have a method in your model to fetch mold numbers based on model
        $moldNumbers = $this->molddetails_model->get_mold_numbers_by_model($selectedModel);
    
        // Return mold numbers as JSON response
        echo json_encode($moldNumbers);
    }
    public function get_mold_numbers_by_model() {
        // Retrieve the selected model from the AJAX request
        $selectedModel = $this->input->post('model');
    
        // Use the selected model to fetch corresponding mold numbers from your database
        // Assuming you have a method in your model to fetch mold numbers based on model
        $moldNumbers = $this->molddetails_model->get_mold_numbers_by_model($selectedModel);
    
        // Return mold numbers as JSON response
        echo json_encode($moldNumbers);
    }
    
    public function get_cavities_by_mold_number() {
        // Retrieve the selected mold number from the AJAX request
        $selectedMoldNo = $this->input->post('mold_no');
    
        // Use the selected mold number to fetch corresponding cavities from your database
        // Assuming you have a method in your model to fetch cavities based on mold number
        $cavities = $this->molddetails_model->get_cavities_by_mold_number($selectedMoldNo);
    
        // Return cavities as JSON response
        echo json_encode($cavities);
    }
    public function get_cavities() {
        // Retrieve the selected model from the AJAX request
        $selectedModel = $this->input->post('model');
    
        // Use the selected model to fetch corresponding cavities from your database
        // Assuming you have a method in your model to fetch cavities based on model
        $cavities = $this->molddetails_model->get_cavities_by_model($selectedModel);
    
        // Return cavities as JSON response
        echo json_encode($cavities);
    }
    public function get_debplans() {
        $data = $this->debplans_model->get_debplans();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_debplan_details($id) {
        $debplan_details = $this->debplans_model->get_debplan_details($id);
        echo json_encode(['debplan_details' => $debplan_details]);
    }    


    public function add_debplans() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Get form data
            $model = $this->input->post('model');
            $mold_no = $this->input->post('mold_no');
            $cavity = $this->input->post('cavity');
            $created_by = $this->input->post('userdata');
            
            // Handle file upload
            $attachment = ''; // Default value if no file is uploaded
            if (!empty($_FILES['attachment']['name'])) {
                $config['upload_path'] = './uploads/'; // Set your upload path
                $config['allowed_types'] = 'pdf'; // Specify allowed file types
                $config['max_size'] = 2048; // Specify maximum file size (in kilobytes)
                $config['encrypt_name'] = TRUE; // Encrypt file name for security
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('attachment')) {
                    $attachment = $this->upload->data('file_name');
                } else {
                    $response['status'] = 'error';
                    $response['message'] = $this->upload->display_errors('', '');
    
                    // Send the JSON-encoded response
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }
            }
    
            // If the item doesn't exist, add it to the database
            $this->debplans_model->add_debplans($model, $mold_no, $cavity, $attachment, $created_by);
        
            // Return a success response
            $response['status'] = 'success';
            $response['message'] = 'Debplan added successfully!';
        
            // Send the JSON-encoded response
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
    


        public function update_area() {
            $id = $this->input->post('id');
            $area = strtoupper($this->input->post('area')); // Convert to uppercase
            $location = $this->input->post('location');
            $userdata = $this->input->post('userdata');
            $updated_at =date('Y-m-d h:i');
        
            // Fetch the existing data from the database
            $existing_data = $this->db->get_where('set_areas', array('id' => $id))->row_array();
        
            // Check if there are changes
            if ($existing_data['area'] === $area && $existing_data['location'] == $location) {
                // No changes, return a response indicating no changes
                echo json_encode(array('status' => 'no_changes', 'message' => 'No changes detected.'));
                return;
            }
        
            // Check if the combination of lines and area_id already exists in the database
            $existing_combination = $this->db->get_where('set_areas', array('area' => $area, 'location' => $location))->row_array();
            if ($existing_combination && $existing_combination['id'] != $id) {
                // Combination already exists, return a response indicating duplicate data
                echo json_encode(array('status' => 'duplicate', 'message' => 'Combination of Area and Location already exists.'));
                return;
            }
        
            // Changes detected and no duplicate combination, proceed with updating the data
            $data = array(
                'area' => $area,
                'location' => $location,
                'created_by' => $userdata,
                'updated_at' => $updated_at
            );
        
            $this->db->where('id', $id);
            $result = $this->db->update('set_areas', $data);
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