 <div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="<?php echo base_url('mastercms/home'); ?>" title="" class="tip-bottom" data-original-title="Go to Home"> <i class="icon-home"></i> Beranda </a>
      <a href="#" class="current">Ringkasan</i> </a>
    </div>
  </div>
  <div class="container-fluid">

    <div class="row-fluid">
      <div class="span12">
        <form name="filterFrm" action="" method="post">
          <div class="span5">
            <div class="controls">
              <select  name="lokasi_id">
                  <?php foreach ($cabang as $key => $value): ?>
                  <option value="<?php echo $value['lokasi_id']; ?>" <?php if($lokasi_id == $value['lokasi_id']){ echo "selected=selected"; } ?>><?php echo $value['lokasi_nama']; ?></option>
                <?php endforeach; ?>
                </select>
                <?php $bln = $bulan; ?>
                <select  name="bulan">
                  <option value="01" <?php if($bln == '01'){ echo "selected=selected"; } ?>>Januari</option>
                  <option value="02" <?php if($bln == '02'){ echo "selected=selected"; } ?>>Februari</option>
                  <option value="03" <?php if($bln == '03'){ echo "selected=selected"; } ?>>Maret</option>
                  <option value="04" <?php if($bln == '04'){ echo "selected=selected"; } ?>>April</option>
                  <option value="05" <?php if($bln == '05'){ echo "selected=selected"; } ?>>Mei</option>
                  <option value="06" <?php if($bln == '06'){ echo "selected=selected"; } ?>>Juni</option>
                  <option value="07" <?php if($bln == '07'){ echo "selected=selected"; } ?>>Juli</option>
                  <option value="08" <?php if($bln == '08'){ echo "selected=selected"; } ?>>Agustus</option>
                  <option value="09" <?php if($bln == '09'){ echo "selected=selected"; } ?>>September</option>
                  <option value="10" <?php if($bln == '10'){ echo "selected=selected"; } ?>>Oktober</option>
                  <option value="11" <?php if($bln == '11'){ echo "selected=selected"; } ?>>November</option>
                  <option value="12" <?php if($bln == '12'){ echo "selected=selected"; } ?>>Desember</option>
                </select>
                <select name="tahun">
                  <?php
                  $thn_skr = date('Y');
                  for ($x = $thn_skr; $x >= 2010; $x--) {
                    ?>
                    <option value="<?php echo $x ?>" <?php if ($tahun == $x){ echo "selected=selected"; } ?>>
                      <?php echo $x ?>
                    </option>
                    <?php
                  }
                  ?>
                </select>
            </div>
          </div>
          <div class="span2" style="margin-left: 2px">
            <div class="controls">
              <p>
                <button type="submit" class="btn btn-primary" name="cari" value="1" ><i class="icon-search"></i> Cari Data</button>
                <a href="<?php echo base_url('mastercms/absensi/summary/'); ?>">
                  <button name="reset" type="" class="btn btn-warning" value="1"><i class="icon-repeat"></i> Reset Filter</button>
                </a>
              </p>
            </div>
          </div>
        </form>
       
        <?php if (!empty($lokasi_id)) : ?>
        <div align="right">
          <span class="label label-success" style="margin-bottom: 8px;" align="right"><a style="color: #fff;" href="<?php echo base_url('mastercms/absensi/export_excel/'.$lokasi_id.'/'.$bulan.'/'.$tahun); ?>"><i class="icon-print"></i>  Export to Excel</a></span>
        </div>
      <?php endif; ?>
      </div>
    </div>
    
    <div class="row-fluid">
      <div class="span12">


        <?php if (empty($lokasi_id)) : ?>
        <div class="accordion" id="collapse-group">
            <?php foreach ($cabang as $key => $value): ?>
              <?php $lokasi_id = $value['lokasi_id']; ?>

            <div class="accordion-group widget-box">
              <div class="accordion-heading">
                <div class="widget-title">
                  <a data-parent="#collapse-group" href="#collapse-<?= $key;?>" data-toggle="collapse">
                    <span class="icon"><i class="icon-folder-open"></i></span><h5><?php echo $value['lokasi_nama']; ?></h5>
                  </a>
                </div>
              </div>
              <div class="collapse accordion-body <?php if($key==0)echo "in"; ?>" id="collapse-<?= $key;?>">
                <div class="widget-content nopadding">
                  <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i></span> 
                    <!-- <h5>Ringkasan Presensi Bulan</h5> -->
                    <h5 style="padding-top: 0px; margin-top: 0px;">
                    <span class="label label-success" align="left"><a style="color: #fff;" href="<?php echo base_url('mastercms/absensi/export_excel/'.$lokasi_id.'/'.$bulan.'/'.$tahun); ?>"><i class="icon-print"></i>  Export to Excel</a></span>
                  </h5>
                  </div>

                  <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th width="3%;">No</th>
                        <th>Nama Karyawan</th>
                        <th width="10%;">Jml Hari Kerja</th>
                        <th width="10%;">Masuk</th>
                        <th width="10%;">Terlambat</th>
                        <th width="10%;">Sakit</th>
                        <th width="10%;">Izin</th>
                        <th width="10%;">Cuti</th>
                        <th width="10%;">Absen</th>
                        <th width="5%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; if (!empty($karyawan)): ?>
                          <?php foreach ($karyawan as $key => $kary) : ?>
                              <?php if ($value['lokasi_id']==$kary['lokasi_id']): ?>
                                <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td><a href="<?php echo base_url('mastercms/absensi/detail/').$kary['karyawan_id'].'/'.$bulan; ?>" class="mydetail"><?= $kary['karyawan_nama']; ?></a></td>
                                  <td><?php echo $jml_hari_kerja; ?></td>
                                  <td>
                                    <?php
                                    foreach ($kehadiran as $key => $kehad) :
                                      if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Masuk Kerja")
                                        { echo $kehad['jumlah']; }
                                    endforeach;
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                    foreach ($kehadiran as $key => $kehad) :
                                      if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Terlambat")
                                        {  echo $kehad['jumlah']; }
                                    endforeach;
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                    foreach ($kehadiran as $key => $kehad) :
                                      if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Sakit")
                                        { echo $kehad['jumlah']; }
                                    endforeach;
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                    foreach ($kehadiran as $key => $kehad) :
                                      if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Izin")
                                        { echo $kehad['jumlah']; }
                                    endforeach;
                                    ?>
                                  </td>
                                  <td>
                                    <?php
                                    foreach ($kehadiran as $key => $kehad) :
                                      if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Cuti")
                                        { echo $kehad['jumlah']; }
                                    endforeach;
                                    ?>
                                  </td>
                                  <td style="color:#ff0000;">
                                    <?php
                                    foreach ($presensi as $key => $pres) :
                                      if ($pres['karyawan_id'] == $kary['karyawan_id'])
                                      {
                                        $tot_presensi = $pres['jumlah'];
                                        $absen = $jml_hari_kerja - $tot_presensi;
                                        echo $absen;
                                      }
                                    endforeach;
                                    ?>
                                  </td>
                                  <td>
                                    <div class="fr"><a href="<?php echo base_url('mastercms/absensi/detail/').$kary['karyawan_id'].'/'.$bulan; ?>" class="btn btn-info btn-mini">Detail</a></div>
                                  </td>
                                </tr>
                              <?php endif ?>
                            
                          <?php endforeach; ?>
                        <?php else: ?> <!-- Jika perusahaan yang dipilih belum memiliki data karyawan -->
                        <div class="alert alert-error alert-block" style="margin-right: 10px;margin-left: 10px;margin-top: 15px">
                          <a class="close" data-dismiss="alert" href="#">×</a>
                          Perusahaan anda <strong>belum memasukkan data karyawan</strong>, Silahkan masukkan data karyawan Anda
                        </div>
                      <?php endif ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
            <?php endforeach ?> 
             
          </div>

          <?php else: ?>

                <div class="span12">
                  <div class="widget-box">
                    <div class="widget-title">
                     <span class="icon"><i class="icon-th"></i></span> 
                     <h5>Ringkasan Presensi</h5>
                   </div>
          
                  <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th width="3%;">No</th>
                        <th>Nama Karyawan</th>
                        <th width="10%;">Jml Hari Kerja</th>
                        <th width="10%;">Masuk</th>
                        <th width="10%;">Terlambat</th>
                        <th width="10%;">Sakit</th>
                        <th width="10%;">Izin</th>
                        <th width="10%;">Cuti</th>
                        <th width="10%;">Absen</th>
                        <th width="5%;">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach ($karyawan as $key => $kary) : ?>
                        <?php if ($lokasi_id ==$kary['lokasi_id']): ?>
                          <tr>
                            <td><?php echo $key+1; ?></td>
                            <td><a href="<?php echo base_url('mastercms/absensi/detail/').$kary['karyawan_id'].'/'.$bulan; ?>" ><?= $kary['karyawan_nama']; ?></a></td>
                            <td><?php echo $jml_hari_kerja; ?></td>
                            <td>
                              <?php
                              foreach ($kehadiran as $key => $kehad) :
                                if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Masuk Kerja")
                                  { echo $kehad['jumlah']; }
                              endforeach;
                              ?>
                            </td>
                            <td>
                              <?php
                              foreach ($kehadiran as $key => $kehad) :
                                if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Terlambat")
                                  {  echo $kehad['jumlah']; }
                              endforeach;
                              ?>
                            </td>
                            <td>
                              <?php
                              foreach ($kehadiran as $key => $kehad) :
                                if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Sakit")
                                  { echo $kehad['jumlah']; }
                              endforeach;
                              ?>
                            </td>
                            <td>
                              <?php
                              foreach ($kehadiran as $key => $kehad) :
                                if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Izin")
                                  { echo $kehad['jumlah']; }
                              endforeach;
                              ?>
                            </td>
                            <td>
                              <?php
                              foreach ($kehadiran as $key => $kehad) :
                                if ($kehad['karyawan_id'] == $kary['karyawan_id'] && $kehad['status']=="Cuti")
                                  { echo $kehad['jumlah']; }
                              endforeach;
                              ?>
                            </td>
                            <td style="color:#ff0000;">
                              <?php
                              foreach ($presensi as $key => $pres) :
                                if ($pres['karyawan_id'] == $kary['karyawan_id'])
                                {
                                  $tot_presensi = $pres['jumlah'];
                                  $absen = $jml_hari_kerja - $tot_presensi;
                                  echo $absen;
                                }
                              endforeach;
                              ?>
                            </td>
                            <td>
                              <div class="fr"><a href="<?php echo base_url('mastercms/absensi/detail/').$kary['karyawan_id'].'/'.$bulan; ?>" class="btn btn-info btn-mini">Detail</a></div>
                            </td>
                          </tr>
                        <?php endif ?>

                      <?php endforeach; ?>



                    </tbody>
                  </table>

                </div>
              </div>
            

          <?php endif; ?>



      </div>
    </div>

    
    </div>
    <!-- Body wrapper End -->

  </div> <!-- penutup id="content" -->

