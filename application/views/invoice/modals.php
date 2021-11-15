<div class="modal fade" id="modal-update">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update Modal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('invoice/update')?>" method="post" id="update">
				<div class="card-body">

					<div class="row">

						<div class="col-sm-6">
							<div class="form-group">
								<label>Category invoice</label>
								<input type="text" class="form-control" name="category" id="category"  value="<?=set_value('category')?>" required readonly>
							</div>
						</div>

						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Code invoice</label>
								<input type="text" class="form-control" name="invoice_id" id="invoice_id"  value="<?=set_value('invoice_id')?>" required readonly>
							</div>
						</div>

						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Name invoice</label>
								<input type="text" class="form-control" name="invoice_name" id="invoice_name"  value="<?=set_value('invoice_name')?>" required>
							</div>
						</div>
						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Quantity</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="quantity" id="quantity"  value="<?=set_value('quantity')?>">
									<div class="input-group-append">
										<select class="input-group-text" name="unit" id="unit" required>
											<option value="pcs">PCS</option>
											<option value="pac">PAC</option>
										</select>
									</div>
								</div>
								<?=form_error('quantity', '<small class="text-danger">','</small>')?>
							</div>
						</div>

						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Capital price</label>
								<input type="number" class="form-control" name="capital_price" id="capital_price"  value="<?=set_value('capital_price')?>" required>
								<?=form_error('capital_price', '<small class="text-danger">','</small>')?>
							</div>
						</div>
						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Selling price</label>
								<input type="number" class="form-control" name="selling_price" id="selling_price"  value="<?=set_value('selling_price')?>" required>
								<?=form_error('selling_price', '<small class="text-danger">','</small>')?>
							</div>
						</div>
					</div>

				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<div class="float-right">
						<button type="submit" class="btn btn-primary float-right">Save</button>
						<button type="cancel" class="btn btn-default mr-2">Cancel</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal update-->

<div class="modal fade" id="modal-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Delete invoice</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('invoice/delete')?>">
				<div class="modal-body">
					<p>Are you sure to <b class="text-danger">Delete</b> invoice ?</p>
					<input type="hidden" name="invoice_id" id="invoice_id" readonly>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Yes do it&hellip;</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal delete -->