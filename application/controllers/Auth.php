<?php
// Controller: Auth.php
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Load URL Helper
    }

    public function login() {
        redirect('/');
    }
}
?>
