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
    $data['cari_karyawan'] = "null";

    if ($this->input->post('filter')) {
      $keyword = $this->input->post('cari');
      $data['cari_karyawan'] = $this->Mkaryawan->cari($keyword);
    }
    elseif($this->input->post('reset')) {

    }
    $this->render_page('backend/karyawan/tampil', $data);
  }
  function tambah()
  {
    $this->form_validation->set_rules('karyawan_email', 'Email', 'is_unique[_karyawan.karyawan_email]');
    $this->form_validation->set_message("is_unique", "<div class='alert alert-error'><button class='close' data-dismiss='alert'>×</button><strong>Gagal</strong>, %s yang sama sudah digunakan. </div>");

    if($this->form_validation->run() == TRUE) {
      $input = $this->input->post();
      $receiver = $input['karyawan_email'];
      $this->Mkaryawan->sendEmail($receiver);
      $this->Mkaryawan->tambah($input);
      $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Sukses!</strong> Data berhasil ditambahkan. Email terkirim di email karyawan.</div>');
    }
    $data['karyawan'] = $this->Mkaryawan->daftar_perusahaan();
    $this->render_page('backend/karyawan/tambah', $data);
  }
  function cekemail()
  {
    $email = $this->input->post('karyawan_email');
    $hasil = $this->Mkaryawan->ambil_email($email);
    if(empty($hasil))
    {
      echo "gagal";
    }
    else
    {
      echo "berhasil";
    }
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
    $this->session->set_flashdata('msg', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Sukses!</strong> Data berhasil dihapus.</div>');
    redirect("mastercms/karyawan", "refresh");
  }
  // function hapus_karyawan()
  // {
  //   $id=$this->input->get('id');
  //   $data = $this->Mkaryawan->get_by_id($id);

  //   $this->Mkaryawan->hapus($id);
  //   redirect("mastercms/karyawan", "refresh");
  // }
  function tampil_detail()
  {
    $detail = $this->db->query('SELECT * FROM _karyawan WHERE karyawan_id='.$_GET['id'].'')->row_array();
    $lokasi = $this->db->query('SELECT l.lokasi_nama, l.perusahaan_title FROM _lokasi l RIGHT JOIN _karyawan k ON k.lokasi_id=l.lokasi_id where k.karyawan_id='.$_GET['id'].' ')->row_array();
    if($detail['karyawan_password']==NULL) {$password = '<span class="label label-important">tidak diatur</span>';}else{$password = '<span class="label label-success">diatur</span>';}
    if(!empty($detail['no_hp'])) {$phone = $detail['no_hp'];}else{$phone = "-";}
    if(!empty($detail['karyawan_ttl'])){$lahir = tanggal($detail['karyawan_ttl']);}else{$lahir = "-";}
    if(!empty($detail['karyawan_salary'])){$gaji = rupiah($detail['karyawan_salary']);}else{$gaji = rupiah(0);}
    if (empty($detail)) { echo "Data tidak ditemukan."; }
    else{
      echo '<table class="table table-stripped" width="100%"><tbody>';
      echo '
        <tr>
          <td style="width:25%;">Asal Perusahaan</td>
          <td width="5px">:</td>
          <td class="detail">'.$lokasi['lokasi_nama'].'</td>
        </tr>
        <tr>
          <td style="width:25%;">Tipe Perusahaan</td>
          <td>:</td>
          <td>'.$lokasi['perusahaan_title'].'</td>
        </tr>
        <tr>
          <td style="width:25%;">Nama Karyawan</td>
          <td>:</td>
          <td>'.$detail['karyawan_nama'].'</td>
        </tr>
        <tr>
          <td>Jabatan</td>
          <td>:</td>
          <td>'.$detail['karyawan_jabatan'].'</td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td>:</td>
          <td>'.$lahir.'</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td>'.$detail['karyawan_email'].'</td>
        </tr>
        <tr>
          <td>User Login</td>
          <td>:</td>
          <td>'.$detail['karyawan_user'].'</td>
        </tr>
        <tr>
          <td>User Password</td>
          <td>:</td>
          <td>'.$password.'</td>
        </tr>
        <tr>
          <td>No.Telp</td>
          <td>:</td>
          <td>'.$phone.'</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td>'.$detail['karyawan_alamat'].'</td>
        </tr>
        <tr>
          <td>Gaji Pokok</td>
          <td>:</td>
          <td>'.$gaji.'</td>
        </tr>
      ';
      echo '</tbody></table>';
    }
  }

}
?>