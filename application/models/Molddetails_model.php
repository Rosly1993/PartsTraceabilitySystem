<?php
class Molddetails_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }

	public function get_molddetails() {
        $query = $this->db->get('set_molddetails');
        return $query->result_array();
    }
	public function add_molddetails($model, $mold_no, $cavityno, $cavity1, $cavity2, $cavity3, $cavity4, $created_by) {
        // Add your logic to insert the item into the database

       $date_add = date('Y-m-d h:i');
       $active_now = 1;
       // Concatenate the cavity values with commas
       $cavities = implode(',', array_filter([$cavity1, $cavity2, $cavity3, $cavity4]));

        $data = array(
            'model' => $model,
            'mold_no' => $mold_no,
            'cavity_no' => $cavityno,
            'cavity1' => $cavities, // Insert concatenated cavities
            // 'cavity1' => $cavity1,
            // 'cavity2' => $cavity2,
            // 'cavity3' => $cavity3,
            // 'cavity4' => $cavity4,
            'is_active' => $active_now,
            'created_at' => $date_add,
            'created_by' => $created_by

        );
        $this->db->insert('set_molddetails', $data);
    }
	public function get_molddetails_by_name($model,$mold_no) {
        $query = $this->db->get_where('set_molddetails', array('model' => $model, 'mold_no' => $mold_no));
		// $this->db->where('area', $area_name);
		
		return $query->row_array(); // Assuming you expect only one row for a given area name
	}

     public function get_molddetails_details($id) {
        // Perform a database query to get the current item details based on the ID
        $query = $this->db->get_where('set_molddetails', ['id' => $id]);
        
        // Return the result as an array
        return $query->row_array();
    } 
    public function delete_area() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('set_areas');
    }

    public function get_mold_numbers_by_model($selectedModel) {
        // Fetch mold numbers from the database based on the selected model
        // Adjust the database query according to your schema
        $this->db->select('mold_no');
        $this->db->where('model', $selectedModel);
        $query = $this->db->get('set_molddetails');
    
        // Process the query result and return mold numbers as an array
        $moldNumbers = array();
        foreach ($query->result() as $row) {
            $moldNumbers[] = $row->mold_no;
        }
        return $moldNumbers;
    }

    public function get_cavities_by_mold_number($selectedMoldNo) {
        // Fetch cavities from the database based on the selected mold number
        // Adjust the database query according to your schema
        $this->db->select('cavity1');
        $this->db->where('mold_no', $selectedMoldNo);
        $query = $this->db->get('set_molddetails');
        
        $cavities = array();
        foreach ($query->result_array() as $row) {
            // Split comma-separated cavities and add them individually to the cavities array
            $cavities = array_merge($cavities, explode(',', $row['cavity1']));
        }
        
        return $cavities;
    }
    
    
}

	

?>  
