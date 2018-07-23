
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a></div>
    </div>
    <div class="container-fluid" >
        <!--REPORT START-->
        <div class="row-fluid">
            <div class="span12">
                <?php echo $this->session->userdata('msg'); ?>
                <div class="widget-content" style="border-bottom: none;padding: 12px 0px;">
                    <ul class="quick-actions" style="margin-left: 0px;">
                        <li> <a href="#"> <i class="icon-database"></i> <?= count($perusahaan); ?> Perusahaan </a> </li>
                        <li> <a href="#"> <i class="icon-people"></i> <?= $totalkaryawan; ?> Karyawan </a> </li>
                    </ul>
                </div>

                <div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-hand-right"></i> </span>
                    <h5>Pop-up dialogs</h5>
                </div>
                <div class="widget-content"> <a href="#myModal" data-toggle="modal" class="btn btn-success">View Popup</a> <a href="#myAlert" data-toggle="modal" class="btn btn-warning">Alert</a> <a href="#myModal2" data-toggle="modal" class="btn btn-info">image Popup</a>
                    <div id="myModal" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>Pop up Header</h3>
                    </div>
                    <div class="modal-body">
                        <p>Here is the text coming you can put also image if you want…</p>
                    </div>
                </div>
                <div id="myModal2" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>Alert modal</h3>
                </div>
                <div class="modal-body">
                    <p><img src="images/gallery/imgbox3.jpg"/></p>
                </div>
                <div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a> </div>
            </div>
            <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Alert modal</h3>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet...</p>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Hai</th>
                            <th>Hai</th>
                            <th>Hai</th>
                            <th>Hai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>hello dunia</td>
                            <td>hello dunia</td>
                            <td>hello dunia</td>
                            <td>hello dunia</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer"> <a data-dismiss="modal" class="btn btn-primary" href="#">Confirm</a> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
        </div>
    </div>
</div>

</div>
<!-- </div> -->


        
      
<!-- kawe -->
    <!-- <div class="row-fluid"> -->
<?php foreach ($perusahaan as $key => $p) { ?>
   

<!-- <div class="col-md-2" > -->
     <div class="span5 jarakspan">
        <!-- <div class="jarakspan"> -->
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
            <h5><?= $p['lokasi_nama']; ?></h5>
          </div>
          <div class="widget-content">
            <div id="container-<?= $p['lokasi_id'];?>" class="pie" style="padding: 0px; position: relative;">
 


            </div>
          </div>
        </div>
        <!-- </div> -->
      </div>
<!-- </div> -->
            <script>
                Highcharts.chart('container-<?= $p['lokasi_id'];?>', {
                  chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Presensi <?= $p['lokasi_nama'];?>'
                },
                subtitle: {
                    text: 'Total Karyawan : <?= $p['jml_karyawan']; ?>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Jumlah',
                data: <?= (!empty($absen[$p['lokasi_id']])) ? json_encode($absen[$p['lokasi_id']]) : json_encode(array('kosong')) ?>
            }]  
        });
    </script>


<?php
} ?>
</div>


<!-- ori -->
<!--   <div class="row-fluid">
        <?php foreach ($perusahaan as $key => $p): ?>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon">
                            <i class="fa fa-suitcase"></i>
                        </span>
                        <h5><?= $p['lokasi_nama']; ?></h5>
                    </div>  
                    <div class="widget-content nopadding" style="margin-top: -20px; width: 100%;">
                        <div id="container-<?= $p['lokasi_id'];?>" style="min-width: 310px; min-height: 400px; max-width: 600px; margin: 0 auto"></div>
                    </div> 
                </div>
            </div>
            <script>
                Highcharts.chart('container-<?= $p['lokasi_id'];?>', {
                  chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Presensi <?= $p['lokasi_nama'];?>'
                },
                subtitle: {
                    text: 'Total Karyawan : <?= $p['jml_karyawan']; ?>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Jumlah',
                data: <?= (!empty($absen[$p['lokasi_id']])) ? json_encode($absen[$p['lokasi_id']]) : json_encode(array('kosong')) ?>
            }]  
        });
    </script>
<?php endforeach ?>
</div> -->
<br>
<!--REPORT END-->
</div>
</div>