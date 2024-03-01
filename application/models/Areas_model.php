<?php
class Areas_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_areas() {
        $query = $this->db->get('set_areas');
        return $query->result_array();
    }
	public function add_area($areaName, $locationName, $userdata) {
        // Add your logic to insert the item into the database

       $date_add = date('Y-m-d h:i');
       $active_now = 1;

        $data = array(
            'area' => $areaName,
            'location' => $locationName,
            'is_active' => $active_now,
            'created_at' => $date_add,
            'created_by' => $userdata

        );
        $this->db->insert('set_areas', $data);
    }
	public function get_area_by_name($area_name) {
		$this->db->where('area', $area_name);
		$query = $this->db->get('set_areas');
		return $query->row_array(); // Assuming you expect only one row for a given area name
	}

     public function get_area_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('set_areas', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    public function delete_area() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('set_areas');
    }
	
}
?>  
