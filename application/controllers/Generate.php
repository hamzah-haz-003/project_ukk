<?php
require_once FCPATH . 'asset/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Generate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_only_admin();
        $this->load->model('M_generate');
    }

    public function index()
    {
        $data['title'] = 'Aplikasi Pengaduan Masyarakat | Home';
        $data['pengguna'] = $this->db->get_where('tbl_admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengaduan'] = $this->db->get('tbl_pengaduan')->result();
        $data['notif'] = $this->db->get('tbl_pengaduan')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('generate/index');
        $this->load->view('templates/footer');
    }

    private function to_generate($html, $filename = '')
    {
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream($filename . 'pdf', array('Attachment' => 0));
    }

    public function gen_pengaduan()
    {
        $tglAwal = $this->input->post('tglAwal');
        $tglAkhir = $this->input->post('tglAkhir');

        $data['pengaduan'] = $this->M_generate->getPengaduanByTgl($tglAwal, $tglAkhir);

        $html = $this->load->view('generate/pengaduan', $data, true);
        $this->to_generate($html, 'Data Laporan Pengaduan');

    }

    public function gen_masyarakat()
    {
        $data['masyarakat'] = $this->M_generate->getMasyarakatAll();
        $html = $this->load->view('generate/masyarakat', $data, true);
        $this->to_generate($html, 'Data Masyarakat');
    }
    public function gen_tanggapan()
    {
        $data['tanggapan'] = $this->M_generate->getTanggapanAll();
        $html = $this->load->view('generate/tanggapan', $data, true);
        $this->to_generate($html, 'Data tanggapan');

    }

    public function gen_petugas()
    {
        $data['petugas'] = $this->M_generate->getPetugasAll();
        $html = $this->load->view('generate/petugas', $data, true);
        $this->to_generate($html, 'Data Petugas');
    }
}