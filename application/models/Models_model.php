<?php
class Models_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_models() {
        $query = $this->db->get('set_models');
        return $query->result_array();
    }
	public function add_model($modelName, $created_by) {
        // Add your logic to insert the item into the database

       $date_add = date('Y-m-d h:i');
       $active_now = 1;

        $data = array(
            'model' => $modelName,
            'is_active' => $active_now,
            'created_at' => $date_add,
            'created_by' => $created_by

        );
        $this->db->insert('set_models', $data);
    }
	public function get_model_by_name($modelName) {
		$this->db->where('model', $modelName);
		$query = $this->db->get('set_models');
		return $query->row_array(); // Assuming you expect only one row for a given area name
	}

     public function get_model_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('set_models', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    public function delete_model() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('set_models');
    }
	
}
?>  
