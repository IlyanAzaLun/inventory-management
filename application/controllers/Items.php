<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

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
		$this->load->model('M_menu');
		$this->load->model('M_items');
		$this->load->model('M_users');
		$this->data['user'] = $this->M_users->user_select($this->session->userdata('email'));
	}
	public function index(){
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
			],
			'module' => [
				base_url('assets/pages/items/index.js'),
			],
		);
		$this->data['title'] = 'Manajemen barang';
		$this->data['items'] = $this->M_items->item_select();
		$this->data['categorys'] = $this->M_menu->menu_category_select();

		$this->form_validation->set_rules('category', 'Category item', 'required|trim');
		$this->form_validation->set_rules('item_code', 'Code item', 'required|trim');
		$this->form_validation->set_rules('item_name', 'Item name', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
		$this->form_validation->set_rules('unit', 'Unit', 'required|trim');
		$this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim|integer');
		$this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|integer|greater_than['.$this->input->post('capital_price').']');
		if ($this->form_validation->run()==false) {
			$this->load->view('items/index', $this->data);
			$this->load->view('items/modals');
		}else{
			$this->data = [
				'item_category' => htmlspecialchars(($this->input->post('subcategory', true))?
					$this->input->post('category', true).'-'.$this->input->post('subcategory', true):
					$this->input->post('category', true)),
				'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
				'item_name'     => htmlspecialchars($this->input->post('item_name', true)),
				'quantity'      => htmlspecialchars($this->input->post('quantity', true)),
				'MG'			=> htmlspecialchars(($this->input->post('MG', true))?$this->input->post('MG', true):''),
				'ML'			=> htmlspecialchars(($this->input->post('ML', true))?$this->input->post('ML', true):''),
				'VG'			=> htmlspecialchars(($this->input->post('VG', true))?$this->input->post('VG', true):''),
				'PG'			=> htmlspecialchars(($this->input->post('PG', true))?$this->input->post('PG', true):''),
				'falvour'		=> htmlspecialchars(($this->input->post('flavour', true))?$this->input->post('flavour', true):''),
				'brand_1'		=> htmlspecialchars(($this->input->post('brand_1', true))?$this->input->post('brand_1', true):''),
				'brand_2'		=> htmlspecialchars(($this->input->post('brand_2', true))?$this->input->post('brand_2', true):''),
				'unit'          => htmlspecialchars($this->input->post('unit', true)),
				'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
				'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
				'note' => htmlspecialchars($this->input->post('note', true)),
			];
			$this->M_items->item_insert($this->data);
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to entry new data!');
			redirect('items');
		}
	}

	public function getcode()
	{
		echo json_encode($this->db->get_where('tbl_item', ['item_category'=>$this->input->post('data')])->num_rows());
	}

	public function getitem()
	{
		echo json_encode($this->db->get_where('tbl_item', ['item_code'=>$this->input->post('data')])->row_array());
	}

	public function update()
	{
		$this->form_validation->set_rules('item_code', 'Code item', 'required|trim');
		$this->form_validation->set_rules('item_name', 'Item name', 'required|trim');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
		$this->form_validation->set_rules('unit', 'Unit', 'required|trim');
		$this->form_validation->set_rules('capital_price', 'Capital price', 'required|trim|integer');
		$this->form_validation->set_rules('selling_price', 'Selling price', 'required|trim|integer|greater_than['.$this->input->post('capital_price').']', array('greater_than' => 'The %s must greater than Capital price'));
		if ($this->form_validation->run()==false) {
			Flasher::setFlash('info', 'error', 'Failed', ' something worng to update data! '.validation_errors());
			redirect('items');
		}else{
			$this->data = [
				'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
				'item_name'     => htmlspecialchars($this->input->post('item_name', true)),
				'quantity'      => htmlspecialchars($this->input->post('quantity', true)),
				'MG'			=> htmlspecialchars(($this->input->post('MG', true))?$this->input->post('MG', true):''),
				'ML'			=> htmlspecialchars(($this->input->post('ML', true))?$this->input->post('ML', true):''),
				'VG'			=> htmlspecialchars(($this->input->post('VG', true))?$this->input->post('VG', true):''),
				'PG'			=> htmlspecialchars(($this->input->post('PG', true))?$this->input->post('PG', true):''),
				'falvour'		=> htmlspecialchars(($this->input->post('falvour', true))?$this->input->post('falvour', true):''),
				'brand_1'		=> htmlspecialchars(($this->input->post('brand_1', true))?$this->input->post('brand_1', true):''),
				'brand_2'		=> htmlspecialchars(($this->input->post('brand_2', true))?$this->input->post('brand_2', true):''),
				'unit'          => htmlspecialchars($this->input->post('unit', true)),
				'capital_price' => htmlspecialchars($this->input->post('capital_price', true)),
				'selling_price' => htmlspecialchars($this->input->post('selling_price', true)),
			];
			$this->M_items->item_update($this->data);
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to update data!');
			redirect('items');
		}
	}
	public function delete()
	{
		$this->form_validation->set_rules('item_code', 'Code item', 'required|trim');
		if ($this->form_validation->run()==false) {
			Flasher::setFlash('info', 'error', 'Failed', ' something worng to delete data! '.validation_errors());
			redirect('items');
		}else{
			$this->data = [
				'item_code'     => htmlspecialchars($this->input->post('item_code', true)),
			];
			$this->M_items->item_delete($this->data);
			Flasher::setFlash('info', 'success', 'Success', ' congratulation success to delete data!');
			redirect('items');
		}	
	}
}
