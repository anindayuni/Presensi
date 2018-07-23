<?php
class Absensi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Mabsensi');
        if (!$this->session->userdata('user'))
        {
            $log = base_url("mastercms");
            $this->session->set_flashdata('msg', '<div class="alert alert-block alert-info fade in"><button type="button" class="close close-sm" data-dismiss="alert"><i class="icon-remove"></i></button><i class="fa fa-warning"></i>&nbsp;&nbsp;Anda harus login terlebih dahulu.</div>');
            echo "<script>location='$log';</script>";
        }
    }
    public function index(){
        $data['absensi']    = "";
        $data['lokasi']     = "";
        $data['bulan']     = date('m');
        $data['data']       = $this->Mabsensi->get_cabang();
        $data['data_presensi'] = $this->Mabsensi->get_presensi_by_day();
        $this->render_page('backend/report/absensi',$data);
    }
    public function get_karyawan(){
        $id     = $this->input->post('id');
        $data   = $this->Mabsensi->get_karyawan($id);
        echo json_encode($data);
    }
    public function pencarian(){
        $cabang     = $this->input->get('cabang');
        $bulan      = $this->input->get('filterbulan');
        $tahun      = $this->input->get('tahun');
        $karyawan   = $this->input->get('karyawan');
        $data['lokasi'] = $cabang;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['karyawan'] = $karyawan;
        $data['data']=$this->Mabsensi->get_cabang();
        $data['absensi']=$this->Mabsensi->pencarian_d($cabang,$bulan,$tahun,$karyawan);

        switch ($bulan) {
            case '01':
               $data['month'] = "Januari";
                break;
            case '02':
                $data['month'] = "Februari";
                break;
            case '03':
                $data['month'] = "Maret";
                break;
            case '04':
                $data['month'] = "April";
                break;
            case '05':
                $data['month'] = "Mei";
                break;
            case '06':
                $data['month'] = "Juni";
                break;
            case '07':
                $data['month'] = "Juli";
                break;
            case '08':
                $data['month'] = "Agustus";
                break;
            case '09':
                $data['month'] = "September";
                break;
            case '10':
                $data['month'] = "Oktober";
                break;
            case '11':
                $data['month'] = "November";
                break;
            case '12':
                $data['month'] = "Desember";
                break;
            default:
                break;
        }

        $this->render_page('backend/report/absensi',$data);
        // $this->render_page('backend/report/filter_absensi',$data);
    }
    public function summary()
    {
        $id = $_SESSION['user']['perusahaan_id'];
        $data['cabang'] = $this->Mabsensi->semua_cabang($id);
        $bulan = date('m');
        $tahun = date('Y');
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['lokasi_id'] = "";
    
        $data['karyawan'] = $this->Mabsensi->get_karyawan_by_lokasi();
        $data['jml_hari_kerja'] = $this->Mabsensi->jumlah_hari_kerja($bulan, $tahun);
        $data['presensi'] = $this->Mabsensi->presensi_per_karyawan($bulan, $tahun);
        $data['kehadiran'] = $this->Mabsensi->kehadiran($bulan, $tahun);

        if ($this->input->post('cari')) //Perintah yg dijalankan saat tombol cari diklik (methode formnya "POST")
        { 

            $input = $this->input->post();
            $lokasi_id = $input['lokasi_id'];
            if (!empty($this->input->post('cari'))) 
            {
                $bulan = $input['bulan'];
                $tahun = $input['tahun'];

            }
            elseif (!empty($this->input->post('reset'))) 
            {
                $bulan = date('m');
                $tahun = date('Y');
            }
            else
            {
                echo "Pencarian tidak diketahui";
            }
            $data['bulan'] = $bulan;
            $data['tahun'] = $tahun;
            $data['lokasi_id'] = $lokasi_id;
            $data['lokasi'] = $this->Mabsensi->lokasi_by_id($lokasi_id);
            $data['karyawan'] = $this->Mabsensi->semua_karyawan($lokasi_id);
            $data['jml_hari_kerja'] = $this->Mabsensi->jml_hari_kerja($lokasi_id, $bulan, $tahun);
            $data['presensi'] = $this->Mabsensi->presensi_per_karyawan($bulan, $tahun);
            $data['kehadiran'] = $this->Mabsensi->kehadiran($bulan, $tahun);
            
        }
        
        $this->render_page('backend/report/summary', $data);
    }

    public function export_excel($lokasi_id, $bulan, $tahun){
            $data = array( 'title' => 'Laporan Excel | Absensi',
                'karyawan' => $this->Mabsensi->semua_karyawan($lokasi_id),
                'kehadiran' => $this->Mabsensi->kehadiran($bulan, $tahun),
                'lokasi_by_id' => $this->Mabsensi->lokasi_by_id($lokasi_id),
                'jml_hari_kerja' => $this->Mabsensi->jml_hari_kerja($lokasi_id, $bulan, $tahun),
                'presensi' => $this->Mabsensi->presensi_per_karyawan($bulan, $tahun),
                'bulan' => $bulan,
                'tahun' => $tahun);
           $this->load->view('backend/report/excel_semua_karyawan',$data);
    }
    public function detail($karyawan_id, $bulan){
        $data['detail_data'] = $this->Mabsensi->detail($karyawan_id);
        $data['detail_data_absensi'] = $this->Mabsensi->detail_absensi($karyawan_id, $bulan);
        $data['bulan'] = $bulan;
        $this->render_page('backend/report/detail', $data);
    }
    function export_excel_karyawan($lokasi,$bulan,$tahun,$karyawan){
        $nama = str_replace("%20", " ", $karyawan); 
        $data = array( 'title' => 'Laporan Presensi Karyawan - '.$karyawan,
            'lokasi_nama' => $this->Mabsensi->lokasi_nama($lokasi),
            'karyawan' => $karyawan,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'user' => $this->Mabsensi->absensi_perorangan($lokasi,$bulan,$tahun,$nama));
       $this->load->view('backend/report/excel_karyawan',$data);
    }

}
?>