<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url('mastercms/home'); ?>" title="" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home </a>
            <a href="<?php echo base_url('mastercms/perusahaan/cabang'); ?>">Perusahaan </a>
            <a href="#" class="current"></i>Jam Kerja </a>
        </div>
    </div>
    <!--Container Fluid start-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon"> <i class="icon-plus"></i> </span>
                        <h5> Tambah Hari & Jam Kerja </h5>
                        <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                    </div>
                    <div class="widget-content">
                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                            <div class="control-group">
                                <div class="span6">
                                    <div class="controls">
                                        <div class="col-md-6" style="margin-left: -15px; margin-bottom: 15px; padding-top: 5px;"><strong>Jam Masuk</strong></div>
                                        <input class="span3" type="text" name="" disabled="disabled" value="Senin" >
                                        <input class="span4" type="time" name="hari[senin][masuk]" value="<?php if(!empty($Senin['masuk'])){echo $Senin['masuk'];} ?>" >
                                    </div>
                                    <div class="controls">
                                        <input class="span3" type="text" name="" disabled="disabled" value="Selasa" >
                                        <input class="span4" type="time" name="hari[selasa][masuk]" value="<?php if(!empty($Selasa['masuk'])){echo $Selasa['masuk'];} ?>" >
                                    </div>
                                    <div class="controls">
                                        <input class="span3" type="text" name="" disabled="disabled" value="Rabu" >
                                        <input class="span4" type="time" name="hari[rabu][masuk]" value="<?php if(!empty($Rabu['masuk'])){echo $Rabu['masuk'];} ?>" >
                                    </div>
                                    <div class="controls">
                                        <input class="span3" type="text" name="" disabled="disabled" value="Kamis" >
                                        <input class="span4" type="time" name="hari[kamis][masuk]" value="<?php if(!empty($Kamis['masuk'])){echo $Kamis['masuk'];} ?>" >
                                    </div>
                                    <div class="controls">
                                        <input class="span3" type="text" name="" disabled="disabled" value="Jum'at" >
                                        <input class="span4" type="time" name="hari[jumat][masuk]" value="<?php if(!empty($Jumat['masuk'])){echo $Jumat['masuk'];} ?>" >
                                    </div>
                                    <div class="controls">
                                        <input class="span3" type="text" name="" disabled="disabled" value="Sabtu" >
                                        <input class="span4" type="time" name="hari[sabtu][masuk]" value="<?php if(!empty($Sabtu['masuk'])){echo $Sabtu['masuk'];} ?>" >
                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="controls">
                                       <div class="" style="margin-left: -15px; margin-bottom: 15px; padding-top: 5px;"><strong>Jam Keluar</strong></div>
                                       <input class="span3" type="text" name="" disabled="disabled" value="Senin" >
                                       <input class="span4" type="time" name="hari[senin][keluar]" value="<?php if(!empty($Senin['keluar'])){echo $Senin['keluar'];} ?>" >
                                   </div>
                                   <div class="controls">
                                    <input class="span3" type="text" name="" disabled="disabled" value="Selasa" >
                                    <input class="span4" type="time" name="hari[selasa][keluar]" value="<?php if(!empty($Selasa['keluar'])){echo $Selasa['keluar'];} ?>" >
                                </div>
                                <div class="controls">
                                    <input class="span3" type="text" name="" disabled="disabled" value="Rabu" >
                                    <input class="span4" type="time" name="hari[rabu][keluar]" value="<?php if(!empty($Rabu['keluar'])){echo $Rabu['keluar'];} ?>" >
                                </div>
                                <div class="controls">
                                    <input class="span3" type="text" name="" disabled="disabled" value="Kamis" >
                                    <input class="span4" type="time" name="hari[kamis][keluar]" value="<?php if(!empty($Kamis['keluar'])){echo $Kamis['keluar'];} ?>" >
                                </div>
                                <div class="controls">
                                    <input class="span3" type="text" name="" disabled="disabled" value="Jum'at" >
                                    <input class="span4" type="time" name="hari[jumat][keluar]" value="<?php if(!empty($Jumat['keluar'])){echo $Jumat['keluar'];} ?>" >
                                </div>
                                <div class="controls">
                                    <input class="span3" type="text" name="" disabled="disabled" value="Sabtu" >
                                    <input class="span4" type="time" name="hari[sabtu][keluar]" value="<?php if(!empty($Sabtu['keluar'])){echo $Sabtu['keluar'];} ?>" >
                                </div>
                            </div>
                            <div class="control-group form-action text-center">
                                <div class="span12"><br/>
                                    <button type="submit" class="btn btn-success"><i class="icon-check"></i> Simpan</button> &nbsp;
                                    <a href="javascript:history.back()" class="btn btn-danger"><i class="icon-remove"></i> Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- widget-content -->          
            </div>
        </div>
    </div>
</div><!--Span12-->
</div><!-- Container fluid-->
</div><!-- page Content-->

