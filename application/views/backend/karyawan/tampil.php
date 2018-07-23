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
                <button name="filter" type="submit" class="btn btn-primary"><i class="icon-search"></i> Cari Data</button>
                <button name="reset" class="btn btn-warning"><i class="icon-repeat"></i> Reset Filter</button>
              </p>
            </div>
          </div>
        </form>
        <div class="buttons" align="right"><a href="<?php echo base_url('mastercms/karyawan/tambah'); ?>" class="btn btn-success"><i class="icon-plus" style="color: #fff;"></i> Tambah Karyawan</a></div>
      </div>
    </div><!-- row-fluid -->

    <div class="row-fluid">
      <div class="span12">
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
                  <!-- <div class="widget-box"> -->
                    <div class="widget-title">
                     <span class="icon"><i class="icon-th"></i></span> 
                     <h5>Karyawan</h5>
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
                                <a href="#detail-<?=$empl['karyawan_id']; ?>" data-toggle="modal" class="btn btn-info btn-mini">Detail</a>
                                <a href="<?php echo base_url("mastercms/karyawan/edit/$empl[karyawan_id]"); ?>" class="btn btn-warning btn-mini">Edit</a>
                                <a href="#hapus-<?=$empl['karyawan_id']; ?>" data-toggle="modal" class="btn btn-danger btn-mini">Hapus</a>
                              </div>
                            </td>
                          </tr>                           
                        <?php endif ?> 

                        <!-- Modal Detail -->
                        <div id="detail-<?=$empl['karyawan_id']; ?>" class="modal hide">
                          <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3>Detail <?= $empl['karyawan_nama']; ?></h3>
                          </div>
                          <div class="modal-body">
                            <table class="table"></table>
                          </div>
                          <div class="modal-footer"> <a class="btn btn-warning" href="<?php echo base_url("mastercms/karyawan/edit/$empl[karyawan_id]"); ?>">Edit</a> <a data-dismiss="modal" class="btn" href="#">Batal</a> </div>
                        </div>
                        <!-- Modal Delete -->
                        <div id="hapus-<?=$empl['karyawan_id']; ?>" class="modal hide">
                          <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3><i class="icon-warning-sign"></i>&nbsp; Hapus Data !</h3>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus karyawan '<b><?= $empl['karyawan_nama']; ?> ?</b>'
                          </div>
                          <div class="modal-footer"> <a class="btn btn-danger" href="<?= base_url("mastercms/karyawan/hapus/$empl[karyawan_id]"); ?>">Ya</a> <a data-dismiss="modal" class="btn" href="#">Tidak</a> </div>
                        </div>
                        <!-- Modal End -->
                      <?php endforeach ?>                
                    </tbody>
                  </table>
                  <!-- </div> -->
                </div>
              </div>
            </div>
          <?php endforeach ?> 

        </div>
      </div>
    </div>

  </div>
</div> <!-- penutup id="content" -->