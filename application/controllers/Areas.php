<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('areas_model');
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user')){
            // User is logged in, load the areas data
            $data['areas'] = $this->areas_model->get_areas();
            
            // Load the areas view with data
            $this->load->view('areas/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }
    public function get_areas() {
        $data = $this->areas_model->get_areas();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }

    public function get_area_details($id) {
        $area_details = $this->areas_model->get_area_details($id);
        echo json_encode(['area_details' => $area_details]);
    }    

    public function add_area() {
        // Check if it's an AJAX request
        if ($this->input->is_ajax_request()) {
            // Get form data
            $area = $this->input->post('areaName');
            $location = $this->input->post('locationName');
            $created_by = $this->input->post('userdata');
    
            // Check if the area already exists
            $existing_area = $this->areas_model->get_area_by_name($area);
            if ($existing_area) {
                // Area already exists, return error response
                $response['status'] = 'error';
                $response['message'] = 'Area already exists!';
            }else{

           
                // If the item doesn't exist, add it to the database
                $this->areas_model->add_area($area, $location, $created_by);
        
                // Return a success response
                $response['status'] = 'success';
                $response['message'] = 'Item added successfully!';
            }
        
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