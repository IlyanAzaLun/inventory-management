<?php $this->load->view('components/header')?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse pace-primary">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('components/navbar')?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('components/sidebar')?>
    <!-- /.Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <!-- container-fluid -->
        <?php $this->load->view('components/breadcrumb')?>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">

          <!-- insert -->
          <form action="<?=base_url('warehouse/queue')?>" method="post" id="insert">
            <div class="row">

              
              <div class="col-sm-12 col-lg-12">
                  <!-- /.col -->          

                  <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Informasi pelanggan</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div class="row">

                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="customer_id" readonly>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div class="form-group">
                            <label for="fullname">Nama toko</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="" required>
                            <?=form_error('user_id[]', '<small class="text-danger">','</small>')?>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div class="form-group">
                            <label for="contact_number">Nomor kontak <small class="text-primary">(whatsapp)</small></label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" value="" required readonly>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="address">Alamat atau tujuan</label>
                            <textarea type="text" name="address" id="address" class="form-control" value="" required readonly></textarea>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- /.card-body -->
                  </div>
                
              </div>
              <div class="col-sm-12 col-lg-12">

                <!-- /.col -->          

                <div class="card" id="order_item">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Informasi barang</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" id="order_item">

                    <div class="row" id="order_item">

                      <div class="col-12">
                        <div class="form-group">
                          <input type="text" name="order_id" id="order_id" class="form-control" placeholder="order_id" readonly>
                        </div>
                      </div>

                      <div class="col-10">
                        <div class="form-group">
                          <label for="item_name">Cari nama barang...</label>
                          <input required type="hidden" id="item_id" class="form-control" autocomplete="off">
                          <input required type="text" id="item_name" class="form-control" placeholder="Cari barang..." autocomplete="off">
                        </div>
                        <?=form_error('item_name[]', '<small class="text-danger">','</small>')?>
                        <?=form_error('quantity[]', '<small class="text-danger">','</small>')?>
                        <?=form_error('unit[]', '<small class="text-danger">','</small>')?>
                      </div>
                      
                      <div class="col-2">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-block btn-primary" id="add_order_item"><i class="fa fa-tw fa-plus"></i></button>
                      </div>

                    </div>

                    <hr>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary float-right">Save</button>
                      <button type="cancel" class="btn btn-default mr-2">Cancel</button>
                    </div>
                  </div>
                </div>
                

              </div>
            </div>
          </form>
          <!-- insert -->
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">Daftar pemesanan keluar</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode pemesanan</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                        <th>Status validasi barang</th>
                        <th>Status pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($invoices as $key => $invoice): ?>
                    <tr>
                      <th scope="row" width="5px"><?=++$key?></th>
                      <td>
                        <div class="btn-group d-flex justify-content-center" data-id="<?=$invoice['invoice_order_id']?>" data-id-invoice="<?=$invoice['invoice_id']?>">
                          <a href="<?=base_url('sale/info')?>?id=<?=$invoice['invoice_id']?>" target="_blank" class="btn btn-sm btn-default" id="info"><i class="fa fa-tw fa-expand-alt"></i></a>
                          <a href="<?=base_url('sale/info')?>?id=<?=$invoice['invoice_id']?>" target="_blank" class="btn btn-sm btn-default" id="update"><i class="fa fa-tw fa-pencil-alt"></i></a>

                          <button class="btn btn-sm btn-default" id="detail" data-toggle="modal" data-target="#modal-detail"><i class="fa fa-tw fa-search-plus"></i></button>

                          <?php if (boolval((int)$invoice['status_active'])): ?>
                          <button class="btn btn-sm btn-default" id="cancel" data-toggle="modal" data-target="#modal-cancel" data-status="<?=$invoice['status_active']?>"><i class="fa fa-tw fa-ban"></i></button>
                          <?php endif ?>
                        </div>
                      </td>
                      <td>
                        <p>
                          <?=$invoice['invoice_id']?>
                          <?=($invoice['status_active']=='0')?'<span class="right badge badge-danger">Cancel</span>':'';?>
                        </p>
                      </td>
                      <td>
                        <small>
                          <?=date('d F Y - H:m:s', $invoice['date'])?></span>
                        </small>
                      </td>
                      <td>
                        <small>
                          <a href="<?=base_url('customer/'.$invoice['to_customer_destination'])?>">
                            <?=$invoice['user_fullname']?>
                          </a>
                          <p><?=$invoice['user_address']?>,<?=$invoice['village']?><br><?=$invoice['sub-district']?>,<?=$invoice['district']?>,<?=$invoice['province']?>,<?=$invoice['zip']?></p>
                          <a href="https://wa.me/<?=$invoice['user_contact_phone']?>" target="_blank"><?=$invoice['user_contact_phone']?></a>

                        </small>
                      </td>
                      <td><small><?=$invoice['note']?></small></td>
                      <td id="validation" class="text-right" data-id="<?=$invoice['invoice_id']?>">
                        <?=($invoice['status_item']=='3'?
                            '<button class="btn btn-sm btn-success m-1" id="status-item" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item">Checked</button>': 
                          ($invoice['status_item']=='2'?
                            '<button class="btn btn-sm btn-warning m-1" id="status-item" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item">Recheck on warehouse</button>': 
                          ($invoice['status_item']=='1'?
                            '<button class="btn btn-sm btn-warning m-1" id="status-item" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item">Recheck on marketing</button>':
                            '<button class="btn btn-sm btn-danger m-1"  id="status-item" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item">Uncheck</button>' )));?>
                        <?=($invoice['status_validation']=='1')?
                            '<button class="btn btn-sm btn-success m-1" id="status-item" data-variabel="status_validation" data-toggle="modal" data-target="#modal-status-item">Send</button>':
                            '<button class="btn btn-sm btn-secondary m-1" id="status-item" data-variabel="status_validation" data-toggle="modal" data-target="#modal-status-item">Hold</button>';?>
                      </td>
                      <td id="payment" class="text-right" data-id="<?=$invoice['invoice_id']?>">
                        <?=($invoice['status_settlement']=='1')?
                            '<button class="btn btn-sm btn-primary m-1" data-variabel="status_settlement">Tunai</button>':
                            '<button class="btn btn-sm btn-secondary m-1" data-variabel="status_settlement">Cicilan</button>';?>
                        <?=($invoice['status_payment']=='1')?
                            '<button class="btn btn-sm btn-success m-1" data-variabel="status_payment">Lunas</button>':
                            '<button class="btn btn-sm btn-danger m-1" data-variabel="status_payment">Belum Lunas</button>';?>
                      </td>
                    </tr>

                    <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.col -->
            </div>
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-danger">
                  <h3 class="card-title">Daftar barang kembali, dari pengiriman</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode pemesanan</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                        <th>Status validasi barang</th>
                        <th>Status pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>