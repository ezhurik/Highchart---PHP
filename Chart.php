<?php

class Chart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ChartModel','model');
    }

    public function index() {
        $data['dailyReports'] = $this->model->getLast30daysReport();
        $this->load->view('chartView',$data);
    }

}

?>