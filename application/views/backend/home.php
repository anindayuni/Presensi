<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i> Home</a></div>
    </div>
    <div class="container-fluid" >
        <?php echo $this->session->userdata('msg'); ?>
        <div class="quick-actions_homepage" style="text-align: left;margin-left: 20px;">
            <ul class="quick-actions">
                <li> <a href="#"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
                <li> <a href="#"> <i class="icon-database"></i> <?= count($perusahaan); ?> Perusahaan </a> </li>
                <li> <a href="#"> <i class="icon-people"></i> <?= $totalkaryawan; ?> Karyawan </a> </li>
            </ul>
        </div>
        <?php foreach ($perusahaan as $key => $p): ?>
        <div class="span6" style="padding-left: -20px;">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                <h5><?= $p['lokasi_nama']; ?></h5>
            </div>
            <div class="widget-content nopadding">
                <div id="container-<?= $p['lokasi_id'];?>" class="pie controls" style="padding: 0px; position: relative;"></div>
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
        <br>
    </div>
</div>