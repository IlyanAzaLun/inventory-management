<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		is_signin(get_class($this));
		$this->load->model('M_invoice');
		$this->load->model('M_order');
		$this->load->model('M_users');
        $this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
	}
	public function index(){
		$this->data['title'] = 'Buat antrian pesanan barang';	
		$this->data['invoices'] = $this->M_invoice->invoice_select(false, 'INV/SEL/');
		$this->data['plugins'] = array(
			'css' => [
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/css/select.bootstrap4.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/css/autoFill.bootstrap4.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/select2/css/select2.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.structure.min.css'),
				 base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.theme.min.css'),
			],
			'js' => [
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/dataTables.buttons.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/dataTables.select.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-select/js/select.bootstrap4.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/dataTables.autoFill.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/datatables-autofill/js/autoFill.bootstrap4.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/select2/js/select2.full.min.js'),
				 base_url('assets/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js'),
			],
			'module' => [
				 base_url('assets/pages/warehouse/index.js'),
			],
	   );
	   $this->form_validation->set_rules('user_id', 'Customer', 'required|trim');
	   if ($this->form_validation->run()==false) {
		   $this->load->view('warehouse/queue/index', $this->data);
		   $this->load->view('warehouse/queue/modals');
	   }else{
			$this->add_invoice();
	   }
	}

	protected function add_invoice()
	{
		 $this->db->like('order_id', '/ORD/SEL/'.date("my"), 'before');
		 $order_id   = sprintf("%04s/ORD/SEL/", $this->db->get('tbl_order')->num_rows()+1).date("my");

		 $this->db->like('invoice_id', '/INV/SEL/'.date("my"), 'before');
		 $invoice_id = sprintf("%04s/INV/SEL/", $this->db->get('tbl_invoice')->num_rows()+1).date("my");

		 foreach ($this->input->post('item_code', true) as $key => $value) {
			  $this->request['order']['order_id'][$key]           = $order_id;
			  $this->request['order']['item_code'][$key]          = $this->input->post('item_code', true)[$key];
			  $this->request['order']['item_capital_price'][$key] = $this->input->post('item_capital_price', true)[$key];
			  $this->request['order']['item_selling_price'][$key] = $this->input->post('item_selling_price', true)[$key];
			  $this->request['order']['item_quantity'][$key]      = (-(int)$this->input->post('quantity', true)[$key]);
			  $this->request['order']['item_unit'][$key]          = $this->input->post('unit', true)[$key];
			  $this->request['order']['rebate_price'][$key]       = $this->input->post('rebate_price', true)[$key];
			  $this->request['order']['status_in_out'][$key]      = 'OUT';
			  $this->request['order']['user_id'][$key]            = $this->input->post('user_id', true);
			  $this->request['order']['date'][$key]               = time();

		 }

		 $this->invoice = [
			  'invoice_id'              => $invoice_id,
			  'date'                    => time(),
			  'date_due'                => time()+(7 * 24 * 60 * 60), //7 days; 24 hours; 60 mins; 60 secs
			  'to_customer_destination' => $this->input->post('user_id', true),
			  'order_id'                => $order_id,
			  'sub_total'               => ($this->input->post('sub_total', true))?$this->input->post('sub_total', true):0,
			  'discount'                => ($this->input->post('discount', true))?$this->input->post('discount', true):0,
			  'shipping_cost'           => ($this->input->post('shipping_cost', true))?$this->input->post('shipping_cost', true):0,
			  'other_cost'              => ($this->input->post('other_cost', true))?$this->input->post('other_cost', true):0,
			  'grand_total'             => ($this->input->post('grand_total', true))?$this->input->post('grand_total', true):0,
			  'status_active'           => 1,
			  'status_item'             => 0,
			  'status_validation'       => 0,
			  'status_payment'          => ($this->input->post('status_payment', true))?1:0,
			  'status_settlement'       => ($this->input->post('status_payment', true))?1:0,
			  'user'                    => $this->session->userdata('fullname'),
			  'note'                    => ($this->input->post('note', true))?$this->input->post('note', true):'Di input oleh bagian gudang'
		 ];
		 $this->M_order->order_insert($this->request['order']); // insert to tbl_order, insert to tbl_history, and update item
		 $this->M_invoice->invoice_insert($this->invoice);
		 Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
		 redirect('warehouse/queue');
	}

	public function get_item_invoice()
	{
		if ($this->input->post('request')) {
			if ($this->input->post('data')) {
				$this->data = $this->db->get_where('tbl_item', array('item_code' => $this->input->post('data')))->row_array();
				if ($this->data) {
					echo json_encode($this->data);
				}else{
					echo json_encode($data = array(
						'0' => array(
							'item_code' => '', 
							'item_name' => '', 
							'quantity' => '', 
							'capital_price' => '', 
							'selling_price' => '', 
						)
					));
				}
			}elseif ($this->input->post('_data')) {
				$this->db->like('item_name', $this->input->post('_data'), 'both');
				$this->data = $this->db->get('tbl_item')->result_array();
				if ($this->data) {
					echo json_encode($this->data);
				}else{
					echo json_encode($data = array(
						'0' => array(
							'item_code' => '', 
							'item_name' => '', 
							'quantity' => '', 
							'capital_price' => '', 
							'selling_price' => '', 
						)
					));
				}
			}else{
				echo json_encode($this->db->get('tbl_item')->result_array());
			}
		}
	}
}
