<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?= base_url('mastercms/home'); ?>" title="Home" class="tip-bottom" data-original-title="Go to Home"> <i class="icon-home"></i> Home </a>
            <a href="<?php echo base_url('mastercms/karyawan'); ?>">Karyawan </a>
            <a href="#" class="current"></i> Edit Data Karyawan </a>
        </div>
    </div>
    <!--Container Fluid start-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon"><i class="icon-edit"></i></span>
                        <h5>Edit Data Karyawan</h5>
                        <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal " role="form" method="post" enctype="multipart/form-data" name="tambah_karyawan">
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Nama Karyawan </label>
                                <div class="controls">
                                    <input type="text" name="karyawan_nama" class="span11" value="<?php echo $edit['karyawan_nama']; ?>" required="required" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Perusahaan </label>
                                <div class="controls">
                                    <select name="lokasi_id" class="span11" required="required">
                                       <?php if (empty($karyawan)): ?>
                                        <option value=""><?php echo "Data perusahaan kosong."; ?></option>
                                        <?php else: ?>
                                            <?php foreach ($karyawan as $key => $value) :?>
                                                <option <?php if($edit['lokasi_id']==$value['lokasi_id']) echo "selected"; ?> value="<?php echo $value['lokasi_id'] ?>" ><?php echo $value['lokasi_nama']; ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Jabatan </label>
                                <div class="controls">
                                    <input type="text" name="karyawan_jabatan" class="span3" value="<?php echo $edit['karyawan_jabatan']; ?>" required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik"></span> Tanggal Lahir </label>
                                <div class="controls">
                                    <input type="date" name="karyawan_ttl" class="span3" value="<?php echo $edit['karyawan_ttl']; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Email </label>
                                <div class="controls">
                                    <input type="email" name="karyawan_email" value="<?php echo $edit['karyawan_email']; ?>" class="span3" value="" readonly>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik"></span> No.Telp </label>
                                <div class="controls">
                                    <input type="number" name="no_hp" value="<?php echo $edit['no_hp']; ?>" class="span3" value="<?php echo $edit['no_hp']; ?>" min="0" minlength="10" maxlength="12">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Alamat </label>
                                <div class="controls">
                                    <textarea class="form-control span11" name="karyawan_alamat"  rows="2" required="required"><?php echo $edit['karyawan_alamat']; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik"></span> Sallary Karyawan </label>
                                <div class="controls">
                                    <input type="number" name="karyawan_salary" value="<?php echo $edit['karyawan_salary']; ?>" class="span11" value="">
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
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Container fluid END-->
</div>
