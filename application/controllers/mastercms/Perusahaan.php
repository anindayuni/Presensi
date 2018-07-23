<?php

class Perusahaan extends MY_Controller
{
	private $def_lat;
	private $def_lng;

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form','url'));
		// Load Config Map
		$this->load->config('map');
		// Set lokasi latitude dan longitude
		$this->def_lat=$this->config->item('default_lat');
		$this->def_lng=$this->config->item('default_lng');
		
		//Load library googlemap
		$this->load->library('googlemaps');

		if (!$this->session->userdata('user'))
		{
			$log = base_url("mastercms");
			$this->session->set_flashdata('msg', '<div class="alert alert-block alert-info fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="icon-remove"></i></button><i class="fa fa-warning"></i>&nbsp;&nbsp;Anda harus login terlebih dahulu.</div>');
			echo "<script>location='$log';</script>";
		}
	}

	function index()
	{
		$this->render_page('backend/perusahaan/profil');
	}


	function cabang()
	{
		$data['keyword'] = "";
		$data['perusahaan'] = $this->Mperusahaan->get_perusahaan();
		$data['jam_kerja'] = $this->Mperusahaan->semua_jamkerja();

		if ($this->input->post('cari')) {
			$keyword = $this->input->post('cari', TRUE);
			$data['perusahaan'] = $this->Mperusahaan->cari($keyword);
			$data['keyword'] = $keyword;
		}

		$this->render_page('backend/perusahaan/data-cabang',$data);
	}

	function tampil_jadwal()
	{
		// echo $_GET['id'];
		$jam_kerja=$this->db->query('SELECT * FROM _jam_kerja j, _lokasi l, _perusahaan p WHERE j.lokasi_id=l.lokasi_id and p.perusahaan_id=l.perusahaan_id and l.lokasi_id='.$_GET['id'].'')->result_array();

		$nama_lokasi=$this->db->query('SELECT * FROM _jam_kerja j, _lokasi l, _perusahaan p WHERE j.lokasi_id=l.lokasi_id and p.perusahaan_id=l.perusahaan_id and l.lokasi_id='.$_GET['id'].'')->row_array();


		if (empty($jam_kerja)) {
	echo 'Data Masih Kosong';                                                      	# code...
	}                 

	else{                                     
	// echo ''.$_GET['id'].'';
	// print_r($jam_kerja);
		echo '<div class="modal-header">';
		echo'<button data-dismiss="modal" class="close" type="button">×</button>
		<h3>'.$nama_lokasi['perusahaan_nama'].'</h3>';
		echo '</div>
		<div class="modal-body">
		<table class="table" align="center">';
		foreach ($jam_kerja as $key => $j) : 

			echo '<tr>
			<td>'.$j['kerja_hari'].'</td>
			<td title="Jam Masuk">'.$j['jam_masuk'].'</td>
			<td>-</td>
			<td title="Jam Selesai">'.$j['jam_keluar'].'</td>

			</tr>';

		endforeach ;

		echo '     </table>
		</div>
		<div class="modal-footer"><a data-dismiss="modal" class="btn btn-inverse" href="#">Cancel</a> 

		</div>';

	}

	}

	function editprofil($id)
	{
		$data['title'] = 'Edit Profil';
		$data['profil'] = $this->Mperusahaan->profil($id);

		if ($this->input->post()) {
			$input = $this->input->post();
			$this->Mperusahaan->edit_profil($id, $input);
			$this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Sukses!</strong> Data berhasil diubah.</div>');
			redirect('mastercms/home', 'refresh');
		}
		$this->render_page('backend/perusahaan/edit-profil', $data);
	}

	function detail($id)
	{
		$data['detail'] = $this->Mperusahaan->get_by_id($id);
		$data['jamkerja'] = $this->Mperusahaan->get_jamkerja($id);
		$data['id'] = $id;
		$this->render_page('backend/perusahaan/detail',$data);
	}

	function add()
	{
	$this->load->library('ciqrcode');

	if ($this->input->post()) {
		$input = $this->input->post();
		$input['perusahaan_id'] = $_SESSION['user']['perusahaan_id'];
		$input['lokasi_nama'] = $this->input->post('lokasi_nama');
		$input['perusahaan_alamat'] = $this->input->post('perusahaan_alamat');

		$time	= date("dmyhis");
		$url 	= strtolower($input['lokasi_nama']);
		$url 	= str_replace(" ", "-", $url);
		$url 	= str_replace(".", "-", $url);
		$url 	= str_replace(",", "-", $url);
		$url 	= str_replace("(", "-", $url);
		$url 	= str_replace(")", "-", $url);
		$alias 	= $url;

			$config['cacheable']    = true; //boolean, the default is true
	        $config['cachedir']     = './assets/'; //string, the default is application/cache/
	        $config['errorlog']     = './assets/'; //string, the default is application/logs/
	        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
	        $this->ciqrcode->initialize($config);

	        $image_name	=	$alias.'-'.$time.'.png'; //buat name dari qr code sesuai dengan nama

	        $params['data'] = $input['lokasi_nama']."\n"."\n".$input['perusahaan_alamat']; //data yang akan di jadikan QR CODE
	        $params['level'] = 'H'; //H=High
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
	        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

	        $this->Mperusahaan->add_lokasi($input,$image_name);
	        redirect('mastercms/perusahaan/cabang', 'refresh');
	    } 

	    $center=$this->def_lat.",".$this->def_lng;
	    $cfg=array(
	    	'class'			=>'map-canvas',
	    	'map_div_id'	=>'map-canvas',
	    	'center'		=>$center,
	    	'zoom'			=>17,
		'places'		=>TRUE, //Aktifkan pencarian alamat
		'placesAutocompleteInputID'	=>'pencarian', //set sumber pencarian input
		'placesAutocompleteBoundsMap'	=>TRUE,
		'placesAutocompleteOnChange'	=>'showmap();' //Aksi ketika pencarian dipilih
	);
	    $this->googlemaps->initialize($cfg);

	    $marker=array(
	    	'position'		=>$center,
	    	'draggable'		=>TRUE,
	    	'title'			=>'Coba diDrag',
	    	'ondragend'		=>"document.getElementById('lat').value = event.latLng.lat();
	    	document.getElementById('lng').value = event.latLng.lng();
	    	showmap();",
	    );		
	    $this->googlemaps->add_marker($marker);

	    $d['map']=$this->googlemaps->create_map();
	    $d['lat']=$this->def_lat;
	    $d['lng']=$this->def_lng;

	    $this->render_page('backend/perusahaan/tambah-cabang', $d);
	}

	function edit($id)
	{
		$this->load->library('ciqrcode');
		$data['title'] = 'Edit Perusahaan / Cabang';
		$data['data'] = $this->Mperusahaan->get_by_id($id);
		// Get lokasi latitude dan longitude
		$data['latitude_longitude'] = $this->Mperusahaan->get_lat_log($id);
		$lokasi_lat = $data['latitude_longitude']['latitude'];
		$lokasi_lng = $data['latitude_longitude']['longitude'];

		if ($this->input->post()) {
			$input = $this->input->post();
			$input['lokasi_nama'] = $this->input->post('lokasi_nama');
			$input['perusahaan_alamat'] = $this->input->post('perusahaan_alamat');
			$time	= date("dmyhis");
			$url 	= strtolower($input['lokasi_nama']);
			$url 	= str_replace(" ", "-", $url);
			$url 	= str_replace(".", "-", $url);
			$url 	= str_replace(",", "-", $url);
			$url 	= str_replace("(", "-", $url);
			$url 	= str_replace(")", "-", $url);
			$alias 	= $url;
			$config['cacheable']    = true; //boolean, the default is true
	        $config['cachedir']     = './assets/'; //string, the default is application/cache/
	        $config['errorlog']     = './assets/'; //string, the default is application/logs/
	        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
	        $this->ciqrcode->initialize($config);
	        $image_name	=	$alias.'-'.$time.'.png'; //buat name dari qr code sesuai dengan nama
	        $params['data'] = $input['lokasi_nama']."\n"."\n".$input['perusahaan_alamat']; //data yang akan di jadikan QR CODE
	        $params['level'] = 'H'; //H=High
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
	        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
	        $this->Mperusahaan->edit($id, $input, $image_name);
	        redirect('mastercms/perusahaan/cabang', 'refresh');
	    }
	    $center=$lokasi_lat.",".$lokasi_lng;
	    $cfg=array(
	    	'class'			=>'map-canvas',
	    	'map_div_id'	=>'map-canvas',
	    	'center'		=>$center,
	    	'zoom'			=>17,
		'places'		=>TRUE, //Aktifkan pencarian alamat
		'placesAutocompleteInputID'	=>'pencarian', //set sumber pencarian input
		'placesAutocompleteBoundsMap'	=>TRUE,
		'placesAutocompleteOnChange'	=>'showmap();' //Aksi ketika pencarian dipilih
	);
	    $this->googlemaps->initialize($cfg);
	    $marker=array(
	    	'position'		=>$center,
	    	'draggable'		=>TRUE,
	    	'title'			=>'Coba diDrag',
	    	'ondragend'		=>"document.getElementById('lat').value = event.latLng.lat();
	    	document.getElementById('lng').value = event.latLng.lng();
	    	showmap();",
	    );		
	    $this->googlemaps->add_marker($marker);
	    $data['map']=$this->googlemaps->create_map();
	    $data['lat']=$lokasi_lat;
	    $data['lng']=$lokasi_lng;
	    $this->render_page('backend/perusahaan/edit', $data);
	}

	function add_jam_kerja($id)
	{
		$datatime = $this->Mperusahaan->get_jamkerja($id);
		$data = array();
		foreach ($datatime as $key => $value) {
			$data[$value['kerja_hari']] = array(
				'masuk' => $value['jam_masuk'],
				'keluar' => $value['jam_keluar'],
			);
		}

		if ($this->input->post())
		{
			$input = $this->input->post();
			if ($input['hari']['senin']) {
				$jamkerja['lokasi_id'] = $id;
				$jamkerja['kerja_hari']	= "senin";
				$jamkerja['jam_masuk'] = $input['hari']['senin']['masuk'];
				$jamkerja['jam_keluar'] = $input['hari']['senin']['keluar'];
				$this->Mperusahaan->jam_kerja($jamkerja['kerja_hari'], $id, $jamkerja);
			}
			if ($input['hari']['selasa']) {
				$jamkerja['lokasi_id'] = $id;
				$jamkerja['kerja_hari']	= "selasa";
				$jamkerja['jam_masuk'] = $input['hari']['selasa']['masuk'];
				$jamkerja['jam_keluar'] = $input['hari']['selasa']['keluar'];
				$this->Mperusahaan->jam_kerja($jamkerja['kerja_hari'], $id, $jamkerja);
			}
			if ($input['hari']['rabu']) {
				$jamkerja['lokasi_id'] = $id;
				$jamkerja['kerja_hari']	= "rabu";
				$jamkerja['jam_masuk'] = $input['hari']['rabu']['masuk'];
				$jamkerja['jam_keluar'] = $input['hari']['rabu']['keluar'];
				$this->Mperusahaan->jam_kerja($jamkerja['kerja_hari'], $id, $jamkerja);
			}
			if ($input['hari']['kamis']) {
				$jamkerja['lokasi_id'] = $id;
				$jamkerja['kerja_hari']	= "kamis";
				$jamkerja['jam_masuk'] = $input['hari']['kamis']['masuk'];
				$jamkerja['jam_keluar'] = $input['hari']['kamis']['keluar'];
				$this->Mperusahaan->jam_kerja($jamkerja['kerja_hari'], $id, $jamkerja);
			}
			if ($input['hari']['jumat']) {
				$jamkerja['lokasi_id'] = $id;
				$jamkerja['kerja_hari']	= "jumat";
				$jamkerja['jam_masuk'] = $input['hari']['jumat']['masuk'];
				$jamkerja['jam_keluar'] = $input['hari']['jumat']['keluar'];
				$this->Mperusahaan->jam_kerja($jamkerja['kerja_hari'], $id, $jamkerja);
			}
			if ($input['hari']['sabtu']) {
				$jamkerja['lokasi_id'] = $id;
				$jamkerja['kerja_hari']	= "sabtu";
				$jamkerja['jam_masuk'] = $input['hari']['sabtu']['masuk'];
				$jamkerja['jam_keluar'] = $input['hari']['sabtu']['keluar'];
				$this->Mperusahaan->jam_kerja($jamkerja['kerja_hari'], $id, $jamkerja);
			}
			redirect('mastercms/perusahaan/cabang', 'refresh');	
		}


		$this->render_page('backend/perusahaan/tambah-jam-kerja',$data);
	}

	// function cari(){
	// 	$keyword = $this->input->get('cari', TRUE);
	// 	$data['perusahaan']=$this->Mperusahaan->cari($keyword);
	// 	$data['jam_kerja'] = $this->Mperusahaan->semua_jamkerja();
	// 	$this->render_page('backend/perusahaan/data-cabang', $data);
	// }
	
}
?>