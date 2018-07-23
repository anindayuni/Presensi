<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?= base_url('mastercms/home'); ?>" title="" class="tip-bottom" data-original-title="Go to Home">  <i class="icon-home"></i> Home </a>
            <a href="<?= base_url('mastercms/absensi/summary'); ?>"> Presensi  </a>
            <a href="#" class="current">Detail Presensi </a>
        </div>
    </div>
    <!-- page heading end -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span5">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-user"></i>
                        </span>
                        <h5>Detail Karyawan</h5>
                    </div>

                    <div class="widget-content nopadding">
                    <?php if (empty($detail_data)) : ?>
                        <div class="alert alert-error alert-block" style="margin-right: 10px;margin-left: 10px;margin-top: 15px">
                          <a class="close" data-dismiss="alert" href="#">×</a>
                          <strong>Detail presensi karyawan tidak dapat dilihat.</strong> Karyawan ini belum melakukan presensi
                      </div>
                    <?php else: ?>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="25%">Perusahaan</td>
                                    <td width="1%">:</td>
                                    <td class="detail"><?= $detail_data['lokasi_nama']; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Status</td>
                                    <td width="1%">:</td>
                                    <td class="detail"><span class="label label-<?php if($detail_data['perusahaan_title']=='pusat')echo "success";elseif($detail_data['perusahaan_title']=='cabang')echo "info"; ?>"><?= $detail_data['perusahaan_title']; ?></span></td>
                                </tr>
                                <tr>
                                    <td width="25%">Nama Karyawan</td>
                                    <td width="1%">:</td>
                                    <td><?= $detail_data['karyawan_nama']; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Jabatan</td>
                                    <td width="1%">:</td>
                                    <td><?= $detail_data['karyawan_jabatan']; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Tanggal Lahir</td>
                                    <td width="1%">:</td>
                                    <td><?php if(!empty($detail_data['karyawan_ttl'])) echo tanggal($detail_data['karyawan_ttl']); else echo "-"; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">No. Telp</td>
                                    <td width="1%">:</td>
                                    <td><?php if(!empty($detail_data['no_hp']))echo $detail_data['no_hp'];else echo "-"; ?></td>
                                </tr>
                                <tr>
                                    <td width="25%">Alamat</td>
                                    <td width="1%">:</td>
                                    <td><?php echo $detail_data['karyawan_alamat']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="span7">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-th-list"></i>
                        </span>
                        <h5>Detail Presensi</h5>
                        <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Hari, Tanggal</th>
                              <th width="15%">Jam Presensi</th>
                              <th width="15%">Jam Keluar</th>
                              <th width="15%">Status</th>
                              <th width="15%">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($detail_data_absensi as $key => $value): ?>
                                <tr class="odd gradeX">
                                  <td><?= hari($value['tanggal']).", ".tanggal($value['tanggal']); ?></td>
                                  <td><?= $value['jam_masuk_absen']; ?></td>
                                  <td><?= $value['jam_keluar_absen']; ?></td>
                                  <td><?= $value['status']; ?></td>
                                  <td><?php if(!empty($value['keterangan']))echo $value['keterangan'];else echo "-"; ?></td>
                                </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- row fluid -->
    </div><!-- container fluid -->
</div>
