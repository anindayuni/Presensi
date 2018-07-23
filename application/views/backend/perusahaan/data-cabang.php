<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url('mastercms/home'); ?>" title="" class="tip-bottom" data-original-title="Go to Home">
                <i class="icon-home"></i> Home
            </a>
            <a href="#" class="current"> Data Perusahaan </a>
        </div>
    </div>
    <!-- body wrapper start -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <form name="filterFrm" method="post">
                    <div class="span2">
                        <div class="controls">
                            <input type="text" name="cari" class="span12" placeholder="Cari Perusahaan" value="" />
                        </div>
                    </div>
                    <div class="span4" style="margin-left: 5px">
                        <div class="controls">
                            <p>
                                <button type="submit" class="btn btn-primary"><i class="icon-search"></i> Cari Data</button>
                                <a href="<?php echo base_url('mastercms/perusahaan/cabang'); ?>" class="btn btn-warning"><i class="icon-repeat"></i> Reset Filter</a>
                            </p>
                        </div>
                    </div>
                    <div class="buttons" align="right"><a href="<?php echo base_url('mastercms/perusahaan/add'); ?>" class="btn btn-success"><i class="icon-plus" style="color: #fff;"></i> Tambah Perusahaan</a></div>
                </form>
            </div>
        </div>
        <div class="row-fluid">
            <?php echo $this->session->userdata('msg');?>
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span> 
                        <h5>Data Perusahaan</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Perusahaan</th>
                                    <th>Jumlah Karyawan</th>
                                    <th>Title</th>
                                    <th width="25%">Alamat Perusahaan</th>
                                    <th>Hari & Jam Kerja</th>
                                    <th>QR Code</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($perusahaan)): ?>
                                    <?php foreach ($perusahaan as $key => $p): ?>
                                        <tr class="gradeX">
                                            <td class="center"><?= $key+1; ?></td>
                                            <td>
                                                <a href="<?= base_url('mastercms/perusahaan/detail/'.$p['lokasi_id']); ?>" style="color: #000;font-weight: bold;"><?= $p['lokasi_nama']; ?></a>
                                            </td>
                                            <td class="center"><?= $p['jml_karyawan']; ?></td>
                                            <td><?= $p['perusahaan_title']; ?></td>
                                            <td><?= $p['perusahaan_alamat'] ?></td>
                                            <td>
                                                <div align="center">

                                                    <!-- start modal jam kerja -->
                                                    <a href="#jadwal-<?= $p['lokasi_id']; ?>" data-toggle="modal" onclick="ambil_id<?= $p['lokasi_id']; ?>()" class="btn btn-info btn-mini">Lihat</a>

                                                    <script type="text/javascript">
                                                        function ambil_id<?= $p['lokasi_id']; ?>() {
                                                            var id="<?= $p['lokasi_id']; ?>";
                                                            $.ajax({
                                                                url:"<?php echo base_url()?>mastercms/perusahaan/tampil_jadwal",
                                                                data:"id="+id,
                                                                success: function(res){
                                                                  $('#load_data<?= $p['lokasi_id']; ?>').html(res);
                                                              }                                                                       
                                                          }); }
                                                      </script>


                                                      <div id="jadwal-<?= $p['lokasi_id']; ?>" class="modal hide">
                                                        <div class="modal-header">
                                                            <button data-dismiss="modal" class="close" type="button">×</button>
                                                            <h3>Pop up Header </h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table" align="center">

                                                                <div id="load_data<?= $p['lokasi_id']; ?>">

                                                                </div>

                                                            </table>
                                                            <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a> </div>


                                                        </div>

                                                    </div>
                                                    <!-- end modal jam kerja -->

                                                    <!-- <span><a href="#jadwal-<?= $p['lokasi_id']; ?>" class="btn btn-info btn-mini">Lihat</a></span>    -->
                                                    <span class="btn btn-warning btn-mini"><a href="<?php echo base_url('mastercms/perusahaan/add_jam_kerja/'.$p['lokasi_id']); ?>" title="Detail" style="color: white">Tambah / Edit</a></span>
                                                </div>
                                                <!--  Modal Jam Kerja -->
                                          <!--   <div class="light-modal" id="jadwal-<?= $p['lokasi_id']; ?>" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false">
                                                <div class="light-modal-content animated zoomInUp">
                                                    <div class="light-modal-header">
                                                        <h3 class="light-modal-heading">Jam Kerja</h3>
                                                        <a href="#" class="light-modal-close-icon" aria-label="close">&times;</a>
                                                    </div>
                                                    <div class="light-modal-body">
                                                        <table class="table" align="center">

                                                            <?php foreach ($jam_kerja as $key => $j) : ?>
                                                                <?php if ($p['lokasi_id'] == $j['lokasi_id']): ?>
                                                                    <tr>
                                                                        <td><?php echo $j['kerja_hari']; ?></td>
                                                                        <td title="Jam Masuk"><?php echo $j['jam_masuk']; ?></td>
                                                                        <td>-</td>
                                                                        <td title="Jam Selesai"><?php echo $j['jam_keluar']; ?></td>

                                                                    </tr>
                                                                <?php endif ?>
                                                            <?php endforeach ?>

                                                        </table>
                                                    </div>
                                                    <div class="light-modal-footer">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- / Modal Jam Kerja -->
                                        </td>
                                        <td><img style="width: 120px;" src="<?= base_url('assets/images/qrcode/').$p['qr_code'];?>"></td>
                                        <td>
                                            <div class="fr">
                                                <a href="<?= base_url('mastercms/perusahaan/detail/'.$p['lokasi_id']); ?>" class="btn btn-info btn-mini">Detail</a> 
                                                <a href="<?= base_url('mastercms/perusahaan/edit/'.$p['lokasi_id']); ?>" class="btn btn-warning btn-mini">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- end container -->
</div><!-- end content -->
