<?php
class Debplans_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_debplans() {
        $query = $this->db->get('pr_debplans');
        return $query->result_array();
    }
	public function add_debplans($model, $mold_no, $cavity, $attachment, $created_by) {
        // Add your logic to insert the item into the database
    
        $date_add = date('Y-m-d h:i');
        $path="http://localhost/codeigniter_login/index.php/debplans/";
        // Set a default value for $attachment if it's empty
        if (empty($attachment)) {
            $attachment = NULL; // or '' depending on your database column definition
        }
    
        $data = array(
            'model' => $model,
            'mold_no' => $mold_no,
            'cavity' => $cavity,
            'attachment' => $attachment,
            'created_at' => $date_add,
            'file_path' => $path,
            'created_by' => $created_by
        );
    
        $this->db->insert('pr_debplans', $data);
    }
    

	public function get_area_by_name($area_name) {
		$this->db->where('area', $area_name);
		$query = $this->db->get('set_areas');
		return $query->row_array(); // Assuming you expect only one row for a given area name
	}

     public function get_debplan_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('pr_debplans', ['id' => $id]);
        
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
