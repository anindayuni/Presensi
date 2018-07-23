<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url('mastercms/home'); ?>" title="" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a>
            <a href="<?php echo base_url('mastercms/karyawan'); ?>">Karyawan</a>
            <a href="#" class="current"></i>Tambah Karyawan
            </a>
        </div>
    </div>
    <!--Container Fluid start-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <?php echo $this->session->userdata('msg');  ?>
                <?php echo validation_errors(); ?>
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon"><i class="icon-plus"></i></span>
                        <h5>Tambah Karyawan</h5>
                        <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal " role="form" action="" method="post" enctype="multipart/form-data" name="tambah_karyawan">
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Nama Karyawan </label>
                                <div class="controls">
                                    <input type="text" name="karyawan_nama" class="span11" value="" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Perusahaan </label>
                                <div class="controls">
                                    <select name="lokasi_id" class="span11">
                                    <?php if (empty($karyawan)): ?>
                                        <option value=""><?php echo "Tidak ada perusahaan yang dimasukkan"; ?></option>
                                        <?php else: ?>
                                            <?php foreach ($karyawan as $key => $value) :?>
                                                <option value="<?php echo $value['lokasi_id'] ?>"><?php echo $value['lokasi_nama']; ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Jabatan </label>
                                <div class="controls">
                                    <input type="text" name="karyawan_jabatan" class="span3" value="" required="required" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"> Tanggal Lahir </label>
                                <div class="controls">
                                    <input type="date" name="karyawan_ttl" class="span3" size="16" value="2000-01-01">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Email </label>
                                <div class="controls">
                                    <input type="email" name="karyawan_email" onkeyup="cekemail();return false;" class="span3" value=""  required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"> No. Telp </label>
                                <div class="controls">
                                    <input type="number" name="no_hp" class="span3" min="0" value="" minlength="10" maxlength="12">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Alamat </label>
                                <div class="controls">
                                    <textarea class="span11" name="karyawan_alamat" rows="2" minlength="20"  required="required"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"> Sallary Karyawan </label>
                                <div class="controls">
                                    <input type="number" name="karyawan_salary" class="span11" >
                                </div>
                            </div>
                            <div class="control-group form-action">
                                <label class="span2 control-label"><code>(*) wajib diisi.</code></label>
                                <div class="controls">
                                    <button type="submit" class="btn btn-success"><i class="icon-check"></i> Simpan</button> &nbsp;
                                    <a href="<?php echo base_url('mastercms/karyawan'); ?>" class="btn btn-danger"><i class="icon-remove"></i> Batal</a>
                                </div><br/>
                            </div>
                        </form>
                    </div><!--widget-content nopadding-->
                </div><!--widget-box-->
            </div><!--span12-->
        </div><!--row-fluid-->
    </div>
</div><!--content-->