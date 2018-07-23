<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url('mastercms'); ?>" title="" class="tip-bottom" data-original-title="Go to Home">
                <i class="icon-home"></i> Home </a>
            <a href="<?php echo base_url('mastercms/absensi'); ?>" class="current" >Presensi Karyawan </a>
        </div>
    </div>
    <!-- body wrapper start -->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <form name="filterFrm" class="form" method="get" action="<?= base_url('mastercms/absensi/pencarian'); ?>">
                    <div class="span2" style="margin-right: 3%;">
                        <div class="controls">
                            <select name="cabang" id="cabang" class="form-control" align="right" required>
                                <option value="">- Pilih Perusahaan -</option>
                                <?php if (!empty($data)): ?>
                                    <?php foreach($data->result() as $row):?>
                                        <option value="<?= $row->lokasi_id;?>" <?php if($lokasi == $row->lokasi_id) echo "selected"; ?>><?= $row->lokasi_nama;?></option>
                                    <?php endforeach;?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="controls">
                            <select name="filterbulan" style="width: 100%;" class="form-control" required>
                                <option value="">- Bulan -</option>
                                <option value="01" <?php if($bulan == '01') echo "selected"; ?>>Januari</option>
                                <option value="02" <?php if($bulan == '02') echo "selected"; ?>>Februari</option>
                                <option value="03" <?php if($bulan == '03') echo "selected"; ?>>Maret</option>
                                <option value="04" <?php if($bulan == '04') echo "selected"; ?>>April</option>
                                <option value="05" <?php if($bulan == '05') echo "selected"; ?>>Mei</option>
                                <option value="06" <?php if($bulan == '06') echo "selected"; ?>>Juni</option>
                                <option value="07" <?php if($bulan == '07') echo "selected"; ?>>Juli</option>
                                <option value="08" <?php if($bulan == '08') echo "selected"; ?>>Agustus</option>
                                <option value="09" <?php if($bulan == '09') echo "selected"; ?>>September</option>
                                <option value="10" <?php if($bulan == '10') echo "selected"; ?>>Oktober</option>
                                <option value="11" <?php if($bulan == '11') echo "selected"; ?>>November</option>
                                <option value="12" <?php if($bulan == '12') echo "selected"; ?>>Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="span2">
                        <div class="controls">
                            <select name="tahun" class="form-control" style="width: 100%;" required>
                                <?php
                                $mulai= date('Y') - 2;
                                for($i = $mulai;$i<$mulai + 20;$i++){
                                    $sel = $i == date('Y') ? ' selected="selected"' : '';
                                    echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="span2" style="margin-right: 3%;">
                        <div class="controls">
                            <select name="karyawan" class="karyawan form-control" required>
                                <option value="">- Karyawan -</option>
                            </select>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="controls">
                            <p>
                               <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
                               <a href="<?= base_url('mastercms/absensi'); ?>" name="resetFilterCustomer" class="btn btn-warning"><i class="fa fa-rotate-left"></i> Reset Filter</a>
                           </p>
                       </div>
                   </div>
                </form>
            </div>
        </div><!-- row fluid -->
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon"> <i class="icon-th-list"></i></span>
                        <h5>Data Presensi Karyawan</h5>
                        <?php if (!empty($absensi)): ?>
                            <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                            <span class="label label-success"><a style="color: #fff" href="<?php echo base_url('mastercms/absensi/export_excel_karyawan/'.$lokasi.'/'.$bulan.'/'.$tahun.'/'.$karyawan) ?>"><i class="icon-download" style="color: #fff;"></i> Export to Excel</a></span>
                        <?php endif ?>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped" style="padding-top: -10px;">
                            <?php if (!empty($absensi)): ?>
                            <thead>
                                <tr>
                                  <th width="10px">No</th>
                                  <th width="15%">Hari, Tanggal</th>
                                  <th>Nama Karyawan</th>
                                  <th width="15%">Jam Masuk Presensi</th>
                                  <th width="15%">Jam Keluar Presensi</th>
                                  <th width="10%">Status</th>
                                  <th width="10%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($absensi as $key => $value): ?>
                                <tr class="odd gradeX">
                                    <td><?= $key+1 ; ?></td>
                                    <td><?= hari($value['tanggal']).', '.tanggal($value['tanggal']); ?></td>
                                    <td><strong><?= $value['karyawan_nama']; ?></strong></td>
                                    <td><?= $value['jam_masuk_absen']; ?></td>
                                    <td><?= $value['jam_keluar_absen']; ?></td>
                                    <td><?= strtolower($value['status']); ?></td>
                                    <td><?php if(!empty($value['keterangan'])) echo strtolower($value['keterangan']); else echo "-";; ?></td>
                                </tr>
                            <?php endforeach ?>

                            <?php elseif(empty($karyawan)): ?>
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th width="10px">No</th>
                                        <th width="15%">Hari, Tanggal</th>
                                        <th>Nama Karyawan</th>
                                        <th>Perusahaan</th>
                                        <th width="10%">Masuk Presensi</th>
                                        <th width="10%">Keluar Presensi</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_presensi as $key => $data): ?>
                                        <tr class="gradeX">
                                            <td><?= $key+1 ; ?></td>
                                            <td><?= hari($data['tanggal']).', '.tanggal($data['tanggal']); ?></td>
                                            <td><strong><?= $data['karyawan_nama']; ?></strong></td>
                                            <td><?= $data['lokasi_nama']; ?></td>
                                            <td><?= $data['jam_masuk_absen']; ?></td>
                                            <td><?= $data['jam_keluar_absen']; ?></td>
                                            <td><?= strtolower($data['status']); ?></td>
                                            <td><?php if(!empty($data['keterangan'])) echo strtolower($data['keterangan']); else echo "-";; ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                             </table>

                            <?php else: ?>
                                <div class="alert alert-info">
                                    <button class="close" data-dismiss="alert">×</button>
                                    <strong>Info!</strong> Karyawan <strong><?= $karyawan; ?></strong> belum presensi bulan di <strong><?= $month; ?>
                                </div>
                            </tbody>
                            <?php endif ?>
                        </table>

                        <!-- <section id="no-more-tables">
                            <div class="panel-body" style="padding-left: 8px; padding-right: 8px">
                                <?php if (!empty($absensi)): ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="background: #dedeec; font-size: 12px" width="2%">No</th>
                                            <th style="background: #dedeec; font-size: 12px" width="15%">Hari, Tanggal</th>
                                            <th style="background: #dedeec; font-size: 12px">Nama Karyawan</th>
                                            <th style="background: #dedeec; font-size: 12px" width="15%">Jam Masuk Presensi</th>
                                            <th style="background: #dedeec; font-size: 12px" width="15%">Jam Keluar Presensi</th>
                                            <th style="background: #dedeec; font-size: 12px" width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php endif ?>
                                        <?php if (!empty($absensi)): ?>
                                            <?php foreach ($absensi as $key =>$value): ?>
                                                <tr>
                                                    <td data-title="No"><?php echo $key+1 ; ?></td>
                                                    <td data-title="hari"><?php echo hari($value['tanggal']).', '.tanggal($value['tanggal']); ?></td>
                                                    <td data-title="karyawan_nama"><strong><?php echo $value['karyawan_nama']; ?></strong></td>
                                                    <td data-title="jam masuk"><?php echo $value['jam_masuk_absen']; ?></td>
                                                    <td data-title="jam kelauar"><?php echo $value['jam_keluar_absen']; ?></td>
                                                    <td data-title="Aksi" align="center"><?php echo $value['status']; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                            <?php elseif(empty($karyawan)): ?>
                                               <div class="alert alert-info">
                                                    Silahkan <strong>pilih karyawan</strong> yang ingin dilihat.
                                                </div><br/>
                                            <?php else: ?>
                                                <div class="alert alert-warning">
                                                    Ups, Karyawan <strong><?= $karyawan; ?></strong> belum presensi bulan di <strong><?= $month; ?></strong>.
                                                </div><br/>
                                        <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </section> -->

                        </div>
                    </div>
                </div>
            </div>
</div>

</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#cabang').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url();?>mastercms/absensi/get_karyawan",
                type : "POST",
                data : {id: id},
                dataType : 'json',
                success: function(data){
                    var html = '';
                    var i;

                    if (!$.trim(data)){   
                        html += '<option>Tidak ada karyawan.</option>';
                    }
                    else{   
                        for(i=0; i<data.length; i++){
                            html += '<option>'+data[i].karyawan_nama+'</option>';
                        }
                    }
                    $('.karyawan').html(html);
                }
            });
        });
    });
</script>