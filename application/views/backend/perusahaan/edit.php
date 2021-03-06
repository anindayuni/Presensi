<?php echo $map['js']; ?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="" class="tip-bottom" data-original-title="Go to Home"> <i class="icon-home"></i> Home </a>
            <a href="<?php echo base_url('mastercms/perusahaan/cabang'); ?>">Perusahaan </a>
            <a href="#" class="current"></i>Edit Perusahaan </a>
        </div>
    </div>
    <!--Container Fluid start-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title" style="margin-bottom: 15px">
                        <span class="icon"><i class="icon-plus"></i></span>
                        <h5> Edit Lokasi / Perusahaan / Cabang </h5>
                        <div class="buttons"><button onclick="goBack()" class="btn btn-mini btn-default"></i> Kembali </button></div>
                    </div>
                    <!--Add content start-->
                    <div class="widget-content nopadding">
                        <form class="form-horizontal " role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="widget-content">
                                        <div class="control-group">
                                            <label class="control-label"><span class="asterik">*</span> Nama Lokasi / Perusahaan</label>
                                            <div class="controls">
                                                <input class="span12" type="text" name='lokasi_nama' minlength="4" required="required" value="<?php echo $data['lokasi_nama']; ?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><span class="asterik">*</span> Title</label>
                                            <div class="controls">
                                                <label>
                                                    <input type="radio" name="perusahaan_title" required="required" value="pusat" <?php if($data['perusahaan_title']=='pusat'){echo "checked";} ?> /> Pusat
                                                </label>
                                                <label>
                                                    <input type="radio" name="perusahaan_title" required="required" value="cabang" <?php if($data['perusahaan_title']=='cabang'){echo "checked";} ?> /> Cabang
                                                </label>
                                            </div>
                                        </div>

                                    <div class="control-group">
                                            <label class="control-label"> <span class="asterik">*</span> Lokasi</label>
                                            <div class="controls">
                                                <input class="span12" name="perusahaan_alamat" id="pencarian"  type="text" placeholder="Cari Alamat atau Tempat" required="required" onchange="geocodeLokasi()">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <div style="width:100%;"><?php echo $map['html'];?></div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><span class="asterik">*</span> latitude</label>
                                            <div class="controls">
                                                <input class="span4" type="text" name='latitude' id='lat' readonly="readonly" required="required" value="<?=$lat;?>"/ >
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><span class="asterik">*</span> longitude</label>
                                            <div class="controls">
                                                <input class="span4" type="text" name='longitude' id='lng' readonly="readonly" required="required" value="<?=$lng;?>"/ >
                                            </div>
                                        </div>
                                        <div class="control-group form-action">
                                            <label class="span2 span2" ><code>(*) wajib diisi.</code></label>
                                            <div class="span8">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button> &nbsp;
                                                <a href="javascript:history.back()" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>                        
                            <!-- page end-->
                        </form>
                    </div>
                    <!--Add contetn End-->
                </div>
            </div>
        </div>
        <!--Span12 End-->
    </div>
    <!-- Container fluid END-->
</div>
<!-- page Content End-->

<script>
update_address(<?=$lat;?>,<?=$lng;?>); //Set terlebih dahulu alamat lokasi pusat
function showmap()
{                       
    var place = placesAutocomplete.getPlace(); //Inisialkan auto complete atau pencarian
    if (!place.geometry) //Jika hasil tidak ada
    {
        return; //Abaikan
    }
    var lat = place.geometry.location.lat(), // Ambil Posisi Latitude Auto Complete
    lng = place.geometry.location.lng(); // Ambil Posisi Longitude Auto Complete
    document.getElementById('lat').value=lat; //Set Latitude pada input lat
    document.getElementById('lng').value=lng; //Set Longitude pada input lng
    var map = new google.maps.Map(document.getElementById('map-canvas'), { //Refresh alamat
        center: {lat: lat, lng: lng},
        zoom: 17
    });
    placesAutocomplete.bindTo('bounds', map); //Render Map Auto Complete
    
    //Tambah penandaan pada alamat
    var marker = new google.maps.Marker({
        map: map,
        draggable: true,
        title: "Drag Untuk mencari posisi",
        anchorPoint: new google.maps.Point(0, -29)
    });
    
    if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          map.setZoom(17);
    }
    marker.setPosition(place.geometry.location);        
    marker_0 = createMarker_map(marker);
    
        var alamat=document.getElementById('pencarian');
            google.maps.event.addListener(marker_0, "dragend", function(event) {
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();
                update_address(event.latLng.lat(),event.latLng.lng());              
            });
}

//Fungsi mendapatkan alamat disaat drag marker
function update_address(lat,lng)
{
    var geocoder = new google.maps.Geocoder;
    var latlng={lat: parseFloat(lat), lng: parseFloat(lng)};
    geocoder.geocode({'location': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {         
        document.getElementById('pencarian').value=results[0].formatted_address;
      } else {
        window.alert('Tidak ada hasil pencarian');
      }
    } else {
      window.alert('Geocoder error: ' + status);
    }
  });
}
</script>