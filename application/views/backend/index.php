<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <!-- <link rel="shortcut icon" href="<?/*php echo base_url();*/?>/images/favicon.png" type="image/png">-->
    
    <title>SMOP - Sistem Manajemen Otret Presensi</title>
    <!--icheck-->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/iCheck/skins/minimal/minimal.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/iCheck/skins/square/square.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/iCheck/skins/square/red.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/iCheck/skins/square/blue.css');?>" />  
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/iCheck/skins/flat/blue.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/clndr.css');?>" /><!--dashboard calendar-->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/morris-chart/morris.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/bootstrap-fileupload.min.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/bootstrap-datepicker/css/datepicker-custom.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/bootstrap-timepicker/css/timepicker.css');?>" />  
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/bootstrap-datetimepicker/css/datetimepicker-custom.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/bootstrap-daterangepicker/daterangepicker.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/jquery-tags-input/jquery.tagsinput.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/nestable/jquery.nestable.css');?>" /><!--nestable css-->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/dropzone/css/dropzone.css');?>" />
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/style.css');?>" /> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/mystyle.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/style-responsive.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/table-responsive.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/fuelux/css/tree-style.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/bootstrap-fileinput-master/css/fileinput.css');?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/js/sweetalert-master/dist/sweetalert.css');?>" />
    <!--Bootstrap + Maruti-->
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/bootstrap.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/bootstrap-responsive.min.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/uniform.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/select2.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/datepicker.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/maruti-style.css');?>" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/maruti-media.css');?>" class="skin-color" />
    <link rel="stylesheet" href="<?= base_url('assets/backend/css/css/jquery.gritter.css') ?>" />
    <!-- pie chart -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>

    <!-- Light Modal -->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/css/light-modal.css');?>" />
</head>

<body class="cz-shortcut-listen='true'" style="min-height: 700px;">
  <div id="header">
      <h1><a href="<?= base_url(); ?>">SMOP</a></h1>
  </div>
    <div id="user-nav" class="navbar navbar-inverse" style="border-color: #47475c;top:-2px;">
      <ul class="nav">
        <!-- <li class="dropdown" >
            <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i><span class="text" style="color: #fff"> Pengguna</span></a>
            <ul>
                <li class="dropdown-menu"><a href="#myProfil" data-toggle="modal">Profil</a></li>
                <li class="dropdown-menu">Ubah</li>
            </ul>
        </li> -->
        <li class="dropdown" ><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="icon-user"></i> <span class="text" style="color: #fff">Pengguna</span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a class="" title="" href="#myProfil" data-toggle="modal">Profil</a></li>
                <li><a class="" title="" href="#ubahPassword" data-toggle="modal">Ubah Password</a></li>
            </ul>
        </li>
        <li class=""><a href="#logout"><i class="icon-share-alt"></i> <span class="text" style="color: #fff">Keluar</span></a></li>


    </ul>
</div>
    <!-- Modal -->
    <div class="light-modal" id="logout" role="dialog" aria-labelledby="light-modal-label" aria-hidden="false">
      <div class="light-modal-content  animated zoomInUp">
        <div class="light-modal-header">
          <h3 class="light-modal-heading"><i class="fa fa-warning"></i> Keluar</h3>
      </div>
      <div class="light-modal-body">
          Yakin ingin Keluar?
      </div>
      <div class="light-modal-footer">
          <a href="<?php echo base_url('mastercms/login/logout'); ?>" class="btn btn-danger" aria-label="close">Ya</a>&nbsp;&nbsp;&nbsp;
          <a href="#" class="btn btn-info" aria-label="close">Tidak</a>
      </div>
    </div>
    </div>
<!-- end modal -->
        <?php echo $sidebar; ?>
        <?php echo $content; ?>
    <!-- footer -->
    <div class="row-fluid">
        <div id="footer" style="color: #fff;" class="span12">Sistem Manajemen Otret Presensi &copy; 2018 by <a href="http://otret.com/" target="_blank">PT OTRET.COM</a> </div>
    </div>
    <!-- modal -->
    <div id="myProfil" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3 clas>Profil Pengguna</h3>
        </div>
        <div class="modal-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td width="25%">Perusahaan</td>
                        <td>:</td>
                        <td><?= $profil['perusahaan_nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td><?php if($profil['status']==1) echo "<span class='label label-success'>active</span>";; ?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><?= $profil['perusahaan_user']; ?></td>
                    </tr>
                    <tr>
                        <td>Email Perusahaan</td>
                        <td>:</td>
                        <td><?= $profil['perusahaan_email']; ?></td>
                    </tr>
                    <tr>
                        <td>No.Telepon</td>
                        <td>:</td>
                        <td><?= $profil['perusahaan_telp']; ?></td>
                    </tr>
                    <tr>
                        <td>Bidang Perusahaan</td>
                        <td>:</td>
                        <td><?= $profil['perusahaan_bidang']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Perusahaan</td>
                        <td>:</td>
                        <td><?= $profil['perusahaan_alamat']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer"> <a class="btn btn-warning" href="<?php echo base_url('mastercms/perusahaan/editprofil/').$profil['perusahaan_id']; ?>">Edit</a> <a data-dismiss="modal" class="btn" href="#">Tutup</a> </div>
    </div>
    <!-- modal end -->

    <!-- modal ubah password -->
    <div id="ubahPassword" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3 clas>Ubah Password</h3>
        </div>
        <div class="modal-body">
            <form action="<?php echo base_url('mastercms/login/ubah_password/'); ?>" method="post" class="form-horizontal" name="basic_validate" id="basic_validate" >
            <div class="row-fluid">
                <!-- <div class="span6"> -->
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            
                                <div class="control">
                                    <label class="control-label">Password Baru :</label>
                                    <div class="controls">
                                        <input type="password" class="span11" name="password" placeholder="Masukkan Password Baru Anda" required="required" />
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" type="submit" href="<?php echo base_url('mastercms/login/ubah_password/'); ?>">Ubah</button>
            <a data-dismiss="modal" class="btn" href="#">Tutup</a>
        </div>
        </form>
    </div>
    <!-- modal end -->
    
<!--ios7-->
<script src="<?php echo base_url('assets/backend/js/ios-switch/switchery.js');?>" ></script>
<script src="<?php echo base_url('assets/backend/js/ios-switch/ios-init.js');?>" ></script>
<!--icheck -->
<script src="<?php echo base_url('assets/backend/js/iCheck/jquery.icheck.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/icheck-init.js');?>"></script>
<!--pickers plugins-->
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-daterangepicker/date.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-daterangepicker/moment.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-daterangepicker/daterangepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-colorpicker/js/bootstrap-colorpicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/js/bootstrap-timepicker/js/bootstrap-timepicker.js');?>"></script>

<!--pickers initialization-->
<script src="<?php echo base_url('assets/backend/js/pickers-init.js');?>"></script>

<!--easy pie chart-->
<script src="<?php echo base_url('assets/backend/js/easypiechart/jquery.easypiechart.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/easypiechart/easypiechart-init.js');?>"></script>

<!--Sparkline Chart-->
<script src="<?php echo base_url('assets/backend/js/sparkline/jquery.sparkline.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/sparkline/sparkline-init.js');?>"></script>


<!--Morris Chart-->
<!-- <script src="<?php echo base_url('assets/backend/js/morris-chart/morris.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/morris-chart/raphael-min.js');?>"></script> -->

<!--Calendar-->
<!--<script src="<?php echo base_url();?>/js/calendar/clndr.js"></script>
<script src="<?php echo base_url();?>/js/calendar/evnt.calendar.init.js"></script>
<script src="<?php echo base_url();?>/js/calendar/moment-2.2.1.js"></script>
<script src="<?php echo base_url();?>/js/underscore-min.js"></script>-->

<!--Dashboard Charts-->
<!-- <script src="<?php echo base_url('assets/backend/js/dashboard-chart-init.js');?>"></script> -->
<!--file upload-->
<script src="<?php echo base_url('assets/backend/js/bootstrap-fileupload.min.js');?>"></script>

<!--tags input-->
<script src="<?php echo base_url('assets/backend/js/jquery-tags-input/jquery.tagsinput.js');?>"></script>
<script src="<?php echo base_url('assets/backend/js/tagsinput-init.js');?>"></script>

<script src="<?php echo base_url('assets/backend/js/ckeditor/ckeditor.js');?>"></script>

<!--New Template-->
<script src="<?= base_url('assets/backend/js/js/excanvas.min.js');?>"></script>
<script src="<?= base_url('assets/backend/js/js/jquery.uniform.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/select2.min.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/jquery.flot.min.js');?>"></script>
<script src="<?= base_url('assets/backend/js/js/jquery.flot.resize.min.js');?>"></script>
<script src="<?= base_url('assets/backend/js/js/jquery.peity.min.js');?>"></script>
<script src="<?= base_url('assets/backend/js/js/fullcalendar.min.js');?>"></script>
<script src="<?= base_url('assets/backend/js/js/maruti.dashboard.js');?>"></script>

<!--gritter script-->
<!-- <script src="<?= base_url('assets/backend/js/gritter/js/jquery.gritter.js');?>"></script>
<script src="<?= base_url('assets/backend/js/gritter/js/gritter-init.js');?>"></script> -->
<script src="<?= base_url('assets/backend/js/jquery.maskMoney.js');?>"></script>

<!-- include baru -->
<script src="<?= base_url('assets/backend/js/js/jquery.min.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/jquery.ui.custom.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/bootstrap.min.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/jquery.dataTables.min.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/maruti.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/maruti.tables.js') ?>"></script>
<script src="<?= base_url('assets/backend/js/js/maruti.popover.js') ?>"></script>
<script src="<?= base_url('assets/backend/js/js/jquery.gritter.min.js') ?>"></script> 
<!-- <script src="<?= base_url('assets/backend/js/js/jquery.gritter.min.js') ?>"></script>  -->
<script src="<?= base_url('assets/backend/js/js/jquery.peity.min.js') ?>"></script>
<script src="<?= base_url('assets/backend/js/js/maruti.interface.js') ?>"></script> 
<script src="<?= base_url('assets/backend/js/js/bootstrap-datepicker.js') ?>"></script> 

 <!-- Placed js at the end of the document so the pages load faster -->
 <!--    <script src="<?php echo base_url('assets/backend/js/jquery-1.10.2.min.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/jquery-ui-1.9.2.custom.min.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/jquery-migrate-1.2.1.min.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/modernizr.min.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/jquery.nicescroll.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/fuelux/js/tree.min.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/tree-init.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/bootstrap-fileinput-master/js/fileinput.js');?>"></script>
    <script src="<?php echo base_url('assets/backend/js/RobinHerbots-Inputmask/dist/jquery.inputmask.bundle.js');?>"></script> -->
    <!-- <script src="<?php echo base_url('assets/backend/js/tooltip.js');?>"></script> -->
    <script src="<?php echo base_url('assets/backend/js/sweetalert-master/dist/sweetalert-dev.js');?>"></script>
 
    <!-- js yang belum ke load -->
    <!-- <script type="text/javascript" src="<?php echo base_url('assets/backend/js/flot-chart/jquery.flot.tooltip.js');?>"></script> -->


<!--dropzone-->
<script src="<?php echo base_url('assets/backend/js/dropzone/dropzone.js');?>"></script>
<!--common scripts for all pages-->
<script src="<?php echo base_url('assets/backend/js/scripts.js');?>"></script>
<script>
function goBack() {
    window.history.back();
}
</script>
<script>
    function cekemail(){
        var member = $("#email").val();
        var pesan = document.getElementById('pesan');
        // membuat ajax
        $.ajax({
            url:'<?php echo base_url("home/cekemail"); ?>',
            method:'POST',
            data:'email_member='+member,
            success:function(hasil)
            {
                if(hasil=="gagal")
                {
                    pesan.style.color='green';
                    pesan.innerHTML="email boleh digunakan.";
                }
                else
                {
                    pesan.style.color='red';
                    pesan.innerHTML="email tidak boleh digunakan";
                }
            }
        });
    }
</script>

</body>
</html>
