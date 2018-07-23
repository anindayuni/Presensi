<?php
class Karyawan extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
    $this->load->model('Mkaryawan');
    $this->load->model('Mperusahaan');
    if (!$this->session->userdata('user')) {
       $log = base_url("mastercms");
       $this->session->set_flashdata('msg', '<div class="alert alert-block alert-info fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-warning"></i>&nbsp;&nbsp;Anda harus login terlebih dahulu.</div>');
       echo "<script>location='$log';</script>";			
    }
  }
  function index()
  { 
    $id = $_SESSION['user']['perusahaan_id'];
    $data['session']=$id;
    $data['perusahaan'] = $this->Mperusahaan->get_cabang($id);
    $data['karyawan'] = $this->Mkaryawan->tampil($id);

    // if ($this->input->post('cari')) {
      
    // }

    if ($this->input->post('filter'))
    {
      echo "<pre>";
      print_r($this->input->post('cari'));
      echo "</pre>";
      // $keyword = $this->input->post('cari');
      // $data['karyawan_id'] = $this->Mkaryawan->cari($keyword);
    }
    // if($this->input->post('reset') == "1")
    // {
    //   redirect('mastercms/karyawan','refreh');
    // }
    $this->render_page('backend/karyawan/tampil', $data);
  }


public function data()
{
  // DB table to use
$table = '_karyawan';
 
// Table's primary key
$primaryKey = 'karyawan_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'lokasi_id', 'dt' => 0 ),
    array( 'db' => 'karyawan_nama',  'dt' => 1 ),
    array( 'db' => 'karyawan_jabatan',   'dt' => 2 ),
    array( 'db' => 'karyawan_user',     'dt' => 3 )
    // ,
    // array(
    //     'db'        => 'start_date',
    //     'dt'        => 4,
    //     'formatter' => function( $d, $row ) {
    //         return date( 'jS M y', strtotime($d));
    //     }
    // ),
    // array(
    //     'db'        => 'salary',
    //     'dt'        => 5,
    //     'formatter' => function( $d, $row ) {
    //         return '$'.number_format($d);
    //     }
    // )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'absensi',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

}



public function pagination()
{


// inisialisasi variabel
 $lokasi_id=$this->input->get('lokasi_id');
  $id_perusahaan = $_SESSION['user']['perusahaan_id'];



// buat oret2

  // $data['lokasi']=$lokasi_id;
  // $data['coba']=$this->uri->segment(5);
  // $data['num_rows']=$this->db->query('SELECT * FROM _karyawan k, _lokasi l where k.lokasi_id=l.lokasi_id and k.lokasi_id="'.$this->input->post('lokasi_id').'"')->num_rows();




if(!isset($_GET['page'])){
    $page = 1;
  }else{
    $page =  $_GET['page'];
  }

  $record_per_page=10;
  
  $start = ($page - 1) * $record_per_page;



//tampilan tabe;

  $karyawan_id =$this->Mkaryawan->show_karyawan_id_pagination($record_per_page, $page, $lokasi_id)->result();

  // $karyawan_id =$this->db->query('SELECT * FROM `_karyawan` JOIN `_lokasi` ON `_lokasi`.`lokasi_id` = `_karyawan`.`lokasi_id` JOIN `_perusahaan` ON `_perusahaan`.`perusahaan_id` = `_lokasi`.`perusahaan_id` WHERE `_perusahaan`.`perusahaan_id` = '.$id_perusahaan.' AND `_lokasi`.`lokasi_id` = '.$lokasi_id.' ORDER BY `_karyawan`.`karyawan_id` DESC LIMIT '.$start.','.$record_per_page.'')->result();

  // $result='';
  echo '<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th><font size="2px">No</font></th>
                        <th><font size="2px">Nama</font></th>
                        <th><font size="2px">Jabatan</font></th>
                        <th><font size="2px">Email</font></th>
                        <th><font size="2px">No.Handphone</font></th>
                        <th><font size="2px">Aksi</font></th>
                      </tr>
                    </thead>
                    <tbody>
                    ';
$no=1;
                   foreach ($karyawan_id as $k) {
                   echo '<tr>
                        <td>'.$no++.'</td>';
                   echo '<td>'.$k->karyawan_nama.'</td>';
                   echo '<td>'.$k->karyawan_jabatan.'</td>';
                   echo '<td>'.$k->karyawan_email.'</td>';
                   echo '<td>'.$k->no_hp.'</td>';
                   echo '<td>';

                   echo '<span><a href="';
                   echo base_url("mastercms/karyawan/detail/$k->karyawan_id"); 
                   echo '" title="Detail"><i class="fa fa-eye"></i></a> &nbsp;</span>';


                  echo '<span><a href="';
                  echo base_url("mastercms/karyawan/edit/$k->karyawan_id");
                  echo'" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp;</span>';

                  echo '
                    <span><a ';
                     // echo base_url("mastercms/karyawan/hapus/$k->karyawan_id");
                    echo " title='Hapus' onClick='hapus_karyawan($k->karyawan_id)'><i class='fa fa-times'></i></a> &nbsp;</span>";




                   echo '</td>
                   </tr>';

                    }


                    echo '</tbody>
                    </table>'; 



//oret2
          // $lokasi = $this->input->get('lokasi_id');
          $id_perusahaan = $_SESSION['user']['perusahaan_id'];
  // echo $result;
                    // print_r($karyawan_id);
                    // echo $this->pagination->create_links();

                    $num_rows=$this->db->query('SELECT * FROM _karyawan k, _lokasi l where k.lokasi_id=l.lokasi_id and k.lokasi_id="'.$lokasi_id.'"')->num_rows();
                    $total_pages = ceil($num_rows/$record_per_page);

                    for ($i=1; $i <= $total_pages ; $i++) { 
                        echo "<span class = 'pagination' style = 'cursor:pointer; margin:1px; padding:8px; border:1px solid #ccc;' id = '".$i."'>".$i."</span>";

                    }

                    echo "<span class = 'pull-right'>Page of ".$page." out of ".$total_pages."</span>";

// print_r($karyawan_id);


}


function cari_karyawan(){



    if($_GET['page']=='undefined'){
        $page = 1;
      }else{
        $page =  $_GET['page'];
      }

      $record_per_page=10;
      
      $start = ($page - 1) * $record_per_page;


  
  $keyword=$_GET['cari_karyawan'];
  $karyawan_id = $this->Mkaryawan->cari($keyword);
  $lokasi_id=$_GET['lokasi_id'];


  echo '<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th><font size="2px">No</font></th>
                        <th><font size="2px">Nama</font></th>
                        <th><font size="2px">Jabatan</font></th>
                        <th><font size="2px">Email</font></th>
                        <th><font size="2px">No.Handphone</font></th>
                        <th><font size="2px">Aksi</font></th>
                      </tr>
                    </thead>
                    <tbody>
                    ';
$no=1;
                   foreach ($karyawan_id as $k) {
                   echo '<tr>
                        <td>'.$no++.'</td>';
                   echo '<td>'.$k->karyawan_nama.'</td>';
                   echo '<td>'.$k->karyawan_jabatan.'</td>';
                   echo '<td>'.$k->karyawan_email.'</td>';
                   echo '<td>'.$k->no_hp.'</td>';
                   echo '<td>';

                   echo '<span><a href="';
                   echo base_url("mastercms/karyawan/detail/$k->karyawan_id"); 
                   echo '" title="Detail"><i class="fa fa-eye"></i></a> &nbsp;</span>';


                  echo '<span><a href="';
                  echo base_url("mastercms/karyawan/edit/$k->karyawan_id");
                  echo'" title="Edit"><i class="fa fa-pencil"></i></a> &nbsp;</span>';

                  echo '
                    <span><a ';
                     // echo base_url("mastercms/karyawan/hapus/$k->karyawan_id");
                    echo " title='Hapus' onClick='hapus_karyawan($k->karyawan_id)'><i class='fa fa-times'></i></a> &nbsp;</span>";




                   echo '</td>
                   </tr>';

                    }


                    echo '</tbody>
                    </table>'; 

  

      $num_rows=$this->db->query('SELECT * FROM _karyawan k, _lokasi l where k.lokasi_id=l.lokasi_id and k.lokasi_id="'.$lokasi_id.'"')->num_rows();
                    $total_pages = ceil($num_rows/$record_per_page);

                    for ($i=1; $i <= $total_pages ; $i++) { 
                        echo "<span class = 'pagination' style = 'cursor:pointer; margin:1px; padding:8px; border:1px solid #ccc;' id = '".$i."'>".$i."</span>";

                    }

                    echo "<span class = 'pull-right'>Page of ".$page." out of ".$total_pages."</span>";

}


function tambah()
{
  if ($this->input->post())
  {
   $input = $this->input->post();
   $receiver = $input['karyawan_email'];
    $this->Mkaryawan->sendEmail($receiver);
    $this->Mkaryawan->tambah($input);
    
    $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Sukses!</strong> Data berhasil ditambahkan.</div>');
  }

  $data['karyawan'] = $this->Mkaryawan->daftar_perusahaan();
  $this->render_page('backend/karyawan/tambah', $data);
}

function edit($karyawan_id)
{
  $data['edit'] = $this->Mkaryawan->get_by_id($karyawan_id);
  $data['karyawan'] = $this->Mkaryawan->daftar_perusahaan();

  if ($this->input->post())
  {
    $input = $this->input->post();
    $this->Mkaryawan->edit($input, $karyawan_id);
    $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Sukses!</strong> Data berhasil diubah.</div>');
  }
 $this->render_page('backend/karyawan/edit',$data);
}

function hapus($karyawan_id)
{
  $data = $this->Mkaryawan->get_by_id($karyawan_id);
  $this->Mkaryawan->hapus($karyawan_id);
  $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button class="close" data-dismiss="alert">×</button><strong>Sukses!</strong> Data berhasil dihapus.</div>');
  redirect("mastercms/karyawan", "refresh");
}


function hapus_karyawan()
{
  $id=$this->input->get('id');
  $data = $this->Mkaryawan->get_by_id($id);

  $this->Mkaryawan->hapus($id);
  redirect("mastercms/karyawan", "refresh");
}

}
?>