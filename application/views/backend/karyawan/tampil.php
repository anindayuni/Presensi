<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="<?php echo base_url('mastercms'); ?>" title="" class="tip-bottom" data-original-title="Go to Home"> <i class="icon-home"></i> Home </a>
      <a href="#" class="current">Data Karyawan</i>  </a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <?php echo $this->session->userdata('msg');?>
        <form name="filterFrm" method="post">
          <div class="span2">
            <div class="controls">
              <input type="text" name="cari" class="span12" placeholder="Cari Karyawan" />
            </div>
          </div>
          <div class="span4" style="margin-left: 5px">
            <div class="controls">
              <p>
                <button name="filter" value="1" type="submit" class="btn btn-primary"><i class="icon-search"></i> Cari Data</button>
                <button name="reset" value="1" class="btn btn-warning"><i class="icon-repeat"></i> Reset Filter</button>
              </p>
            </div>
          </div>
        </form>
        <div class="buttons" align="right"><a href="<?php echo base_url('mastercms/karyawan/tambah'); ?>" class="btn btn-success"><i class="icon-plus" style="color: #fff;"></i> Tambah Karyawan</a></div>
      </div>
    </div><!-- row-fluid -->

    <div class="row-fluid">
      <div class="span12">
        <?php if ($cari_karyawan == 'null'): ?>
          <?php if (!empty($perusahaan)): ?>
            <div class="accordion" id="collapse-group">
              <?php foreach ($perusahaan as $key => $value): ?>
                <div class="accordion-group widget-box">
                  <div class="accordion-heading">
                    <div class="widget-title">
                      <a data-parent="#collapse-group" href="#collapse-<?= $key; ?>" data-toggle="collapse">
                        <span class="icon"><i class="icon-folder-open"></i></span><h5><?= $value['lokasi_nama']; ?></h5>
                      </a>
                    </div>
                  </div>
                  <div class="collapse accordion-body <?php if($key==0) echo "in"; ?>" id="collapse-<?= $key; ?>">
                    <div class="widget-content nopadding">
                      <div class="widget-title">
                       <span class="icon"><i class="icon-th"></i></span> 
                       <h5>Data Karyawan</h5>
                     </div>

                     <table class="table table-bordered data-table">
                      <thead>
                        <tr>
                          <th width="3%;">No</th>
                          <th>Nama Karyawan</th>
                          <th>Jabatan</th>
                          <th>Email</th>
                          <th>No.Telp</th>
                          <th width="20%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($karyawan as $key => $empl): ?>
                          <?php if ($value['lokasi_id']==$empl['lokasi_id']): ?>
                            <tr class="gradeX">
                              <td class="center"><?= $i++; ?></td>
                              <td><?= $empl['karyawan_nama']; ?></td>
                              <td><?= $empl['karyawan_jabatan']; ?></td>
                              <td><?= $empl['karyawan_email']; ?></td>
                              <td><?php if(!empty($empl['no_hp']))echo $empl['no_hp']; else echo "-"; ?></td>
                              <td>
                                <div class="fr">
                                  <a href="#detail-<?=$empl['karyawan_id']; ?>" data-toggle="modal" onclick="ambil_id<?= $empl['karyawan_id']; ?>()"  class="btn btn-info btn-mini">Detail</a>
                                  <a href="<?php echo base_url("mastercms/karyawan/edit/$empl[karyawan_id]"); ?>" class="btn btn-warning btn-mini">Edit</a>
                                  <a href="#hapus-<?=$empl['karyawan_id']; ?>" data-toggle="modal" class="btn btn-danger btn-mini">Hapus</a>
                                </div>
                              </td>
                            </tr>                           
                          <div id="detail-<?=$empl['karyawan_id']; ?>" class="modal hide">
                            <div class="modal-header">
                              <button data-dismiss="modal" class="close" type="button">×</button>
                              <h3><i class="icon-th"></i>&nbsp; Detail <?= $empl['karyawan_nama']; ?></h3>
                            </div>
                            <div class="modal-body"><div id="load_data<?= $empl['karyawan_id']; ?>"></div></div>
                            <div class="modal-footer"> <a class="btn btn-warning" href="<?php echo base_url("mastercms/karyawan/edit/$empl[karyawan_id]"); ?>">Edit</a> <a data-dismiss="modal" class="btn" href="#">Tutup</a>
                            </div>
                          </div><!-- modal detail -->
                          <div id="hapus-<?=$empl['karyawan_id']; ?>" class="modal hide">
                            <div class="modal-header">
                              <button data-dismiss="modal" class="close" type="button">×</button>
                              <h3><i class="icon-warning-sign"></i>&nbsp; Hapus Data !</h3>
                            </div>
                            <div class="modal-body">
                              Yakin ingin menghapus karyawan '<b><?= $empl['karyawan_nama']; ?> ?</b>'
                            </div>
                            <div class="modal-footer"> <a class="btn btn-danger" href="<?= base_url("mastercms/karyawan/hapus/$empl[karyawan_id]"); ?>">Ya</a> <a data-dismiss="modal" class="btn" href="#">Tidak</a> </div>
                          </div><!-- Modal Delete -->
                          <script type="text/javascript">
                            function ambil_id<?= $empl['karyawan_id']; ?>() {
                              var id="<?= $empl['karyawan_id']; ?>";
                              $.ajax({
                                url:"<?php echo base_url()?>mastercms/karyawan/tampil_detail",
                                type : "GET",
                                data:"id="+id,
                                success: function(res){
                                  $('#load_data<?= $empl['karyawan_id']; ?>').html(res);
                                }                                                                       
                              }); }
                            </script>
                          <?php endif ?><!-- $value['lokasi_id']==$empl['lokasi_id'] -->
                          <?php endforeach ?>                
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <?php endforeach ?> 
            </div><!-- accordion -->
            <?php endif ?><!-- if (!empty($perusahaan)): -->
            <?php else: ?><!-- $cari_karyawan -->
            <?php if (empty($cari_karyawan)): ?>
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                  <h5><?= count($cari_karyawan); ?> data ditemukan.</h5>
                </div>
                <div class="widget-content">
                  <div class="alert alert-info">
                    <button class="close" data-dismiss="alert">×</button>
                    <strong>Info!</strong> Karyawan tidak ditemukan. </div>
                  </div>
                </div>
                <?php else: ?>
                  <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                      <h5><?= count($cari_karyawan); ?> data ditemukan.</h5>
                    </div>
                    <div class="widget-content nopadding">
                      <table class="table table-bordered data-table">
                        <thead>
                          <tr>
                            <th width="3%;">No</th>
                            <th>Nama Karyawan</th>
                            <th>Perusahaan</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>No.Telp</th>
                            <th width="20%">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($cari_karyawan as $key => $value): ?>
                            <tr class="odd gradeX">
                              <td><?= $key+1; ?></td>
                              <td><?= $value['karyawan_nama']; ?></td>
                              <td class="detail"><?= $value['lokasi_nama']; ?></td>
                              <td><?= $value['karyawan_jabatan']; ?></td>
                              <td><?= $value['karyawan_email']; ?></td>
                              <td><?php if(!empty($value['no_hp']))echo $value['no_hp']; else echo "-"; ?></td>
                              <td>
                                <div class="fr">
                                  <a href="#detail-<?=$value['karyawan_id']; ?>" onclick="detail_id<?=$value['karyawan_id']; ?>()" data-toggle="modal" class="btn btn-info btn-mini">Detail</a>
                                  <a href="<?php echo base_url("mastercms/karyawan/edit/$value[karyawan_id]"); ?>" class="btn btn-warning btn-mini">Edit</a>
                                  <a href="#hapus-<?=$value['karyawan_id']; ?>" data-toggle="modal" class="btn btn-danger btn-mini">Hapus</a>
                                </div>
                              </td>
                            </tr>
                            <div id="detail-<?=$value['karyawan_id']; ?>" class="modal hide">
                              <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>Detail <?= $value['karyawan_nama']; ?></h3>
                              </div>
                              <div class="modal-body">
                                <div id="load_data<?= $value['karyawan_id']; ?>"></div>
                              </div>
                              <div class="modal-footer"> <a class="btn btn-warning" href="<?php echo base_url("mastercms/karyawan/edit/$value[karyawan_id]"); ?>">Edit</a> <a data-dismiss="modal" class="btn" href="#">Tutup</a> </div>
                            </div><!-- Modal Delete -->
                            <!-- </div> -->
                            <div id="hapus-<?=$value['karyawan_id']; ?>" class="modal hide">
                              <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3><i class="icon-warning-sign"></i>&nbsp; Hapus Data !</h3>
                              </div>
                              <div class="modal-body">
                                Yakin ingin menghapus karyawan '<b><?= $value['karyawan_nama']; ?> ?</b>'
                              </div>
                              <div class="modal-footer"> <a class="btn btn-danger" href="<?= base_url("mastercms/karyawan/hapus/$value[karyawan_id]"); ?>">Ya</a> <a data-dismiss="modal" class="btn" href="#">Tidak</a> </div>
                            </div><!-- Modal End -->
                            <script type="text/javascript">
                            function detail_id<?= $value['karyawan_id']; ?>() {
                              var id="<?= $value['karyawan_id']; ?>";
                              $.ajax({
                                url:"<?php echo base_url()?>mastercms/karyawan/tampil_detail",
                                type : "GET",
                                data:"id="+id,
                                success: function(res){
                                  $('#load_data<?= $value['karyawan_id']; ?>').html(res);
                                }                                                                       
                              }); }
                            </script>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php endif ?>
                <?php endif ?><!-- if (empty($cari_karyawan)):-->
              </div><!-- span12 -->
            </div>

          </div><!-- container-fluid -->
</div> <!-- content -->