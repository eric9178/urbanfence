<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class JobModel extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

    }

    public function getJobByJobID($job_id)
    {
        $query = $this->db->get_where('jobs', array('id' => $job_id));
        return $query->row();
    }

    public function getJobs()
    {
        $job_id = $this->input->get('job_id');
        $status = $this->input->get('status');
        $quote_id = $this->input->get('quote_id');
        $installer = $this->input->get('installer');
        $job_balance = $this->input->get('job_balance');
        $customer_id = $this->input->get('customer_id');
        $customer = $this->input->get('customer');
        $job_type = $this->input->get('job_type');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $site_city = $this->input->get('site_city');

        $this->db->select('jobs.*, customers.customer AS customer, customers.contact_person AS contact_person,
        opportunities.job_type AS job_type,opportunities.site_address AS site_address,opportunities.contact_onsite AS contact_onsite,
        opportunities.site_city AS site_city, opportunities.site_desc AS site_desc, users.name AS installer');
        $this->db->from('jobs');
        if ($job_id) {
            $this->db->where('jobs.id', $job_id);
        }
        if ($status) {
            $this->db->where('jobs.status', $status);
        }
        if ($quote_id) {
            $this->db->where('jobs.quote_id', $quote_id);
        }
        if ($installer) {
            $this->db->where('jobs.installer', $installer);
        }
        if ($job_balance) {
            $this->db->where('job_balance >= ' . $job_balance, null, false);
        }
        if ($customer) {
            $this->db->like('customers.customer', $customer);
        }
        if ($customer_id) {
            $this->db->where('jobs.customer_id', $customer_id);
        }
        if ($job_type) {
            $this->db->where('opportunities.job_type', $job_type);
        }
        if ($start_date) {
            list($from_date, $to_date) = explode('-', $start_date);
            $this->db->where('start_date BETWEEN "' . date('Y-m-d', strtotime($from_date)) . '" AND "' . date('Y-m-d', strtotime($to_date)) . '"', "", FALSE);
        }
        if ($end_date) {
            list($from_date, $to_date) = explode('-', $end_date);
            $this->db->where('end_date BETWEEN "' . date('Y-m-d', strtotime($from_date)) . '" AND "' . date('Y-m-d', strtotime($to_date)) . '"', "", FALSE);
        }
        if ($site_city) {
            $this->db->where('site_city', $site_city);
        }
        $this->db->join('customers', 'customers.id=jobs.customer_id', 'inner');
        $this->db->join('users', 'users.id=jobs.installer', 'left');
        $this->db->join('opportunities', 'opportunities.id=jobs.oppor_id', 'inner');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPayamountByJobID($job_id){
        $payments = $this->db->get_where('payments', array('job_id'=>$job_id))->result();
        $pay_amounts = 0;
        foreach ($payments as $payment){
            $pay_amounts += $payment->payment_amount;
        }
        return $pay_amounts;
    }

}
