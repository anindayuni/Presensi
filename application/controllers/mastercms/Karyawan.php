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
  function tampil_detail()
  {
    $detail = $this->db->query('SELECT * FROM _karyawan WHERE karyawan_id='.$_GET['id'].'')->row_array();
    if (empty($detail)) {
      echo "Data tidak ditemukan.";
    }
    else{
      // print_r($detail);
      echo '<div class="modal-header">';
      echo'<button data-dismiss="modal" class="close" type="button">×</button>
        <h3>Data</h3>';
        echo '</div>
        <div class="modal-body">
        <table class="table table-stripped" align="center">';
        echo '
          <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>'.$detail['karyawan_nama'].'</td>
          </tr>
          <tr>
            <td>Jabatan</td>
            <td>:</td>a
            <td>'.$detail['karyawan_jabatan'].'</td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>a
            <td>'.tanggal($detail['karyawan_ttl']).'</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>a
            <td>'.$detail['karyawan_email'].'</td>
          </tr>
          <tr>
            <td>No.Telp</td>
            <td>:</td>a
            <td>'.$detail['no_hp'].'</td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>a
            <td>'.$detail['karyawan_alamat'].'</td>
          </tr>
        ';
        echo '</table>
        </div><div class="modal-footer"><a data-dismiss="modal" class="btn btn-default" href="#">Tutup</a></div>';
    }
  }

}
?>