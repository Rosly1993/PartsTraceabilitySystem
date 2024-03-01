<?php
class Lines_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	// public function get_lines() {
    //     $query = $this->db->get('set_lines');
    //     return $query->result_array();
    // }  if getting data without join

    public function get_lines() {
        $this->db->select('set_lines.id, set_lines.lines, set_areas.area'); // Select desired columns
        $this->db->from('set_lines');
        $this->db->join('set_areas', 'set_lines.area_id = set_areas.id', 'left'); // Join with set_areas table
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_line_by_name($lineName, $areaName) {
        // Add your database query logic here to retrieve the item by name
        $query = $this->db->get_where('set_lines', array('lines' => $lineName, 'area_id' => $areaName));
        return $query->row(); // Assuming you expect only one result
    }

    public function add_line($lineName, $areaName , $userdata) {
        // Add your logic to insert the item into the database
        $date_add = date('Y-m-d h:i');
        $active_now = 1;
        $data = array(
            'lines' => $lineName,
            'area_id' => $areaName,
            'is_active' => $active_now,
            'created_at' => $date_add,
            'created_by' => $userdata
        );
        $this->db->insert('set_lines', $data);
    }

    // public function get_line_details($id) {
    //     // Perform a database query to get the current item details based on the ID
    //     $query = $this->db->get_where('set_lines', ['id' => $id]);
        
    //     // Return the result as an array
    //     return $query->row_array();
    // } get data without join on one table

    public function get_line_details($id) {
        // Perform a database query to get the current item details based on the ID
        $this->db->select('set_lines.*, set_areas.area');
        $this->db->from('set_lines');
        $this->db->join('set_areas', 'set_lines.area_id = set_areas.id', 'left');
        $this->db->where('set_lines.id', $id);
        $query = $this->db->get();
    
        // Return the result as an array
        return $query->row_array();
    }
    // public function update_line() {
    //     $data = array(
    //         'lines' => strtoupper($this->input->post('lines')), // Convert to uppercase
    //         // 'area_id' => $this->input->post('area_id')
    //     );
    //     $this->db->where('id', $this->input->post('id'));
    //     $this->db->update('set_lines', $data);
    // }

    public function update_line($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('set_lines', $data);
        return $result;
    }
    
    

    public function delete_line() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('set_lines');
    }
	
}

?>
