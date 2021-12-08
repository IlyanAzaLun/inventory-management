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
		$this->load->model('M_users');
        $this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
	}
	public function index(){
		$this->data['title'] = 'Buat antrian pesanan barang';		
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
	   $this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|greater_than['.$this->input->post('capital_price').']');
	   if ($this->form_validation->run()==false) {
		   $this->load->view('warehouse/queue/index', $this->data);
		   $this->load->view('warehouse/queue/modals');
	   }else{
		   $this->_history_insert();
		   Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry data!');
		   redirect('queue');
	   }
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
