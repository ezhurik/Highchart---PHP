<?php

class ChartModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getLast30daysReport()
    {
        $id = $this->session->userdata('userId');
        $reportArr=array();
        $d1 = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-30 days'));

        $period = new DatePeriod(
         new DateTime($d2),
         new DateInterval('P1D'),
         new DateTime($d1)
        );
        foreach ($period as $key => $value) {

            $str="SELECT bq_order_details.order_details_id as daily_orders from bq_order_details join bq_order on bq_order_details.order_id = bq_order.order_id where date(bq_order.created_date) = '" . $value->format('Y-m-d'). "' and bq_order_details.user_id = '$id' group by bq_order_details.order_id";

            $res = $this->db->query($str)->result_array();
            $countRes=count($res);
            if($res[0]['daily_orders']== 0)
            {
                $reportArr[] = 0;
            }
            else
            {
                $reportArr[] = $countRes;
            }
        }
        return $reportArr;
    }
}
