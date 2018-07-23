<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url('mastercms/home'); ?>" title="" class="tip-bottom" data-original-title="Go to Home"> <i class="icon-home"></i> Home </a>
            <a href="<?php echo base_url('mastercms/karyawan'); ?>">Profil Perusahaan </a>
            <a href="#" class="current"></i>Edit Profil
            </a>
        </div>
    </div>
    <!--Container Fluid start-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon">  <i class="icon-edit"></i> </span>
                        <h5>Edit Profil Perusahaan</h5>
                        <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                    </div>
                    <div class="widget-content">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Nama Perusahaan</label>
                                <div class="controls">
                                    <input type="text" name="perusahaan_nama" class="span11" value="<?= $profil['perusahaan_nama']; ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Email</label>
                                <div class="controls">
                                    <input type="text" name="perusahaan_email" class="span11" value="<?= $profil['perusahaan_email']; ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> No. Telepon</label>
                                <div class="controls">
                                    <input type="number" min="0" minlength="9" maxlength="12" name="perusahaan_telp" class="span11" value="<?php if(!empty($profil['perusahaan_telp']))echo $profil['perusahaan_telp']; else echo "-"; ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><span class="asterik">*</span> Bidang Perusahaan</label>
                                <div class="controls">
                                    <input type="text" name="perusahaan_bidang" class="span11" value="<?= $profil['perusahaan_bidang']; ?>" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Alamat Perusahaan</label>
                                <div class="controls">
                                    <textarea rows="2" name="perusahaan_alamat" class="span11"><?php if (!empty($profil['perusahaan_alamat'])) echo $profil['perusahaan_alamat']; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group form-action">
                                <label class="span2" ><code>(*) wajib diisi.</code></label>
                                <div class="span10"><br/>
                                    <button type="submit" class="btn btn-success"><i class="icon-check"></i> Simpan</button> &nbsp;
                                    <a href="<?= base_url('mastercms/home'); ?>" class="btn btn-danger"><i class="icon-remove"></i> Batal</a>
                                </div><br/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Container fluid-->
</div><!-- page Content-->
