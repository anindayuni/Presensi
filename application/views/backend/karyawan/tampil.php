 <div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="<?php echo base_url('mastercms'); ?>" title="" class="tip-bottom" data-original-title="Go to Home">
        <i class="icon-home"></i> Home
      </a>
      <a href="#" class="current">Data Karyawan</i>
      </a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
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
    </div>

    <div class="row-fluid">
      <div class="span12">
        <?php echo $this->session->userdata('msg');?>
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
                          <th>Aksi</th>
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
                                  <a href="#det-<?=$empl['karyawan_id']; ?>" class="btn btn-info btn-mini">Detail</a> 
                                  <a href="<?php echo base_url("mastercms/karyawan/edit/$empl[karyawan_id]"); ?>" class="btn btn-warning btn-mini">Edit</a>
                                  <a href="#del-<?=$empl['karyawan_id']; ?>" class="btn btn-danger btn-mini">Delete</a>
                                </div>
                              </td>
                            </tr>                           
                          <?php endif ?> 

                          <!-- Modal Detail -->
                          <div class="light-modal" id="det-<?=$empl['karyawan_id']; ?>" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false">
                            <div class="light-modal-content large-content animated zoomInUp">
                              <div class="light-modal-header">
                                <h6 class="light-modal-heading"><i class="fa fa-warning"></i> Detail <?= $empl['karyawan_nama']; ?></h6>
                              </div>
                              <div class="light-modal-body">
                                <ul>
                                  <li>Perusahaan    : </li><p><?= $empl['lokasi_nama']; ?></p>
                                  <li>Nama Lengkap  : </li><p><?= $empl['karyawan_nama']; ?></p>
                                  <li>Jabatan       : </li><p><?= $empl['karyawan_jabatan']; ?></p>
                                  <li>Tanggal Lahir : </li><p><?= date("d M Y", strtotime($empl['karyawan_ttl']));  ?></p>
                                  <li>Email         : </li><p><?= $empl['karyawan_email']; ?></p>
                                  <li>No. Telp      : </li><p><?php if(!empty($empl['no_hp'])) echo $empl['no_hp']; else echo "-"; ?></p>
                                  <li>Alamat        : </li><p><?= $empl['karyawan_alamat']; ?></p>
                                </ul>
                              </div>
                              <div class="light-modal-footer">
                                <a href="<?php echo base_url("mastercms/karyawan/edit/$empl[karyawan_id]"); ?>" class="btn btn-warning" aria-label="edit">Edit</a>&nbsp;&nbsp;&nbsp;
                                <a href="#" class="btn btn-info" aria-label="close">Tutup</a>
                              </div>
                            </div>
                          </div>
                          <!-- Modal End -->
                          
                          <!-- Modal Delete -->
                          <div class="light-modal" id="del-<?=$empl['karyawan_id']; ?>" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false">
                            <div class="light-modal-content  animated zoomInUp">
                              <div class="light-modal-header">
                                <h6 class="light-modal-heading"><i class="icon-warning"></i> Hapus Data</h6>
                              </div>
                              <div class="light-modal-body">
                                Yakin ingin menghapus karyawan '<b><?= $empl['karyawan_nama']; ?> ?</b>'
                              </div>
                              <div class="light-modal-footer">
                                <a href="<?= base_url("mastercms/karyawan/hapus/$empl[karyawan_id]"); ?>" class="btn btn-danger" aria-label="close">Ya</a>&nbsp;&nbsp;&nbsp;
                                <a href="#" class="btn btn-info" aria-label="close">Tidak</a>
                              </div>
                            </div>
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