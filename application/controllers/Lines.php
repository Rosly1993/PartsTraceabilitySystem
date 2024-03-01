<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lines extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url'); // Load URL Helper
        $this->load->model('lines_model');
        $this->load->model('areas_model'); // Load the areas model for dropdown
    }

    public function index(){
        // Check if user session exists
        if($this->session->userdata('user')){
            // User is logged in, load the areas data
            $data['areas'] = $this->areas_model->get_areas(); // Fetch areas data
            $data['lines'] = $this->lines_model->get_lines();
            
            // Load the areas view with data
            $this->load->view('lines/index', $data);
        }
        else{
            // User is not logged in, redirect to login page
            redirect('login_page');
        }
    }

    public function get_lines() {
        $data = $this->lines_model->get_lines();
        echo json_encode(['data' => $data]); // Wrap the data in 'data' key
    }
    public function get_line_details($id) {
        $line_details = $this->lines_model->get_line_details($id);
        echo json_encode(['line_details' => $line_details]);
    }    

    // Function to add item
    public function add_line() {
        // Get data from the AJAX request
        $lineName = strtoupper($this->input->post('lineName')); // Convert to uppercase
        $areaName = $this->input->post('areaName');
        $created_by = $this->input->post('userdata');
    
        // Check if the item already exists
        $existingItem = $this->lines_model->get_line_by_name($lineName, $areaName);
    
        if ($existingItem) {
            // Item already exists, return an error response
            $response['status'] = 'error';
            $response['message'] = 'Line already exists!';
        } else {
            // If the item doesn't exist, add it to the database
            $this->lines_model->add_line($lineName, $areaName , $created_by);
    
            // Return a success response
            $response['status'] = 'success';
            $response['message'] = 'Item added successfully!';
        }
    
        // Send the JSON-encoded response
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function update_line() {
        $id = $this->input->post('id');
        $lines = strtoupper($this->input->post('lines')); // Convert to uppercase
        $area_id = $this->input->post('area_id');
        $userdata = $this->input->post('userdata');
        $updated_at =date('Y-m-d h:i');
    
        // Fetch the existing data from the database
        $existing_data = $this->db->get_where('set_lines', array('id' => $id))->row_array();
    
        // Check if there are changes
        if ($existing_data['lines'] === $lines && $existing_data['area_id'] == $area_id) {
            // No changes, return a response indicating no changes
            echo json_encode(array('status' => 'no_changes', 'message' => 'No changes detected.'));
            return;
        }
    
        // Check if the combination of lines and area_id already exists in the database
        $existing_combination = $this->db->get_where('set_lines', array('lines' => $lines, 'area_id' => $area_id))->row_array();
        if ($existing_combination && $existing_combination['id'] != $id) {
            // Combination already exists, return a response indicating duplicate data
            echo json_encode(array('status' => 'duplicate', 'message' => 'Combination of lines and area_id already exists.'));
            return;
        }
    
        // Changes detected and no duplicate combination, proceed with updating the data
        $data = array(
            'lines' => $lines,
            'area_id' => $area_id,
            'created_by' => $userdata,
            'updated_at' => $updated_at
        );
    
        $this->db->where('id', $id);
        $result = $this->db->update('set_lines', $data);
        if ($result) {
            echo json_encode(array('status' => 'success', 'message' => 'Data updated successfully'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update data'));
        }
    }
    
    
   
    
    

    public function delete_line() {
        $this->lines_model->delete_line();
        echo json_encode(['success' => true]);
    }
}
    

?>