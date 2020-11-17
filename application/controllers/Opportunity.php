<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opportunity extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('CustomerModel');
        $this->load->model('CompanyModel');
        $this->load->model('UserModel');
        $this->load->model('OpportunityModel');
//        $this->load->library('auth');
//        $this->load->library('session');
//        $this->auth->check_admin_auth();
    }

    public function opportunity_list()
    {
        $data['status'] = 'All';
        if(isset($_GET['status'])){
            $data['status'] = 'New';
        }
        $data['sales'] = $this->UserModel->getSaleUsers();
        $this->load->view('inc/header');
        $this->load->view('opportunities/view_opportunity', $data);
        $this->load->view('inc/footer');
    }

    public function add_opportunity()
    {
        $data['customer'] = array();
        $data['opportunity'] = array();
        if (isset($_GET['customer_id'])) {
            $data['customer'] = $this->CustomerModel->get_customer($_GET['customer_id']);
        } elseif (isset($_GET['opportunity_id'])) {
            $data['opportunity'] = $this->OpportunityModel->get_opportunity($_GET['opportunity_id']);
            $data['customer'] = $this->CustomerModel->get_customer($data['opportunity']->customer_id);
        }
        $data['customer_list'] = $this->CustomerModel->getCustomers();
        $data['companies'] = $this->CompanyModel->getCompanies();
        $data['users'] = $this->UserModel->getUsers();
        $this->load->view('inc/header');
        $this->load->view('opportunities/add_opportunity', $data);
        $this->load->view('inc/footer');
    }

    public function add_customer()
    {
        $data['customer'] = array();
        if (isset($_GET['customer_id'])) {
            $data['customer'] = $this->CustomerModel->get_customer($_GET['customer_id']);
        }
        $data['status'] = 1;
        $companies = new CompanyModel;
        $data['company'] = $companies->getCompanies();
        $this->load->view('inc/header');
        $this->load->view('opportunities/add_customer', $data);
        $this->load->view('inc/footer');
    }

    public function create_customer(){
        $data = $_POST;
        $this->db->insert('customers', $data);
        $customer_id = $this->db->insert_id();
        echo $customer_id;
    }

    public function save_customer()
    {
        $data = $_POST;
        $customer_id = $this->input->post('customer_id');
        unset($data['customer_id']);
        if ($customer_id != "") {
            $this->db->where('id', $customer_id);
            $this->db->update('customers', $data);
        } else {
            $this->db->insert('customers', $data);
            $customer_id = $this->db->insert_id();
        }
        redirect('Customer/customers_list');
    }

    public function save_opportunity()
    {
        $data = $_POST;
        $opportunity_id = $this->input->post('opportunity_id');
        unset($data['opportunity_id']);
        if ($data['customer_id'] == '') {
            $data['customer_id'] = $data['created_customer_id'];
        }
        if ($opportunity_id != "") {
            $this->db->where('id', $opportunity_id);
            $this->db->update('opportunities', $data);
        } else {
            $data['status'] = 'New';
            $this->db->insert('opportunities', $data);
        }
        redirect('Opportunity/opportunity_list');
    }

    public function get_opportunities()
    {
        $data['data'] = $this->OpportunityModel->getOpportunities();
        echo json_encode($data);
    }

    public function change_sale_rep()
    {
        $oppor_id = $this->input->post('oppor_id');
        $sale_id = $this->input->post('user_id');
        $this->db->where('id', $oppor_id);
        $this->db->update('opportunities', array('sale_rep' => $sale_id, 'status'=>'Assigned'));
        echo 'Success';
    }

    public function get_search_customer()
    {
        $search = $this->input->get('search');
        $this->db->select('customers.id, customers.customer AS text');
        $this->db->from('customers');
        $this->db->like('customer', $search);
        $query = $this->db->get();
        echo json_encode($query->result());
    }
    public function get_customer(){
        $customer_id = $this->input->get('customer_id');
        $data = $this->CustomerModel->get_customer($customer_id);
        echo json_encode($data);
    }
}
