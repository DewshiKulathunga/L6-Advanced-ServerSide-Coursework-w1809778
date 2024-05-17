<?php
// Defining the AboutUs class which extends the CI_Controller class.
class AboutUs extends CI_Controller {
    public function index() {
        //Load the URL helper, which provides various functions to work with URLs.
        $this->load->helper('url');
        // Load the 'aboutus' view.
        $this->load->view('aboutus'); 
    }
}
