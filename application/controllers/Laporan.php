<?php
class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_jika_user();
        $this->load->model('M_user');
    }

    // Halaman Utama Laporan Pengaduan Untuk User(Masyarakat)
    public function index()
    {
        $data['title'] = 'Laporan Pengaduan';
        // $data['ntf'] = $this->db->get('tbl_tanggapan')->result();
        // var_dump($query);  die;

        $id_user = $this->session->userdata('nik');

        $query = $this->db->select('*')
            ->from('tbl_tanggapan')
            ->join('tbl_pengaduan', 'tbl_pengaduan.id_pengaduan = tbl_tanggapan.id_pengaduan')
            ->where('nik', $id_user)
            ->where('notif_status', 0)
            ->get();

        $data['ntf_jumlah'] = $query->num_rows();

        $query = $this->db->select('*')
            ->from('tbl_tanggapan')
            ->join('tbl_pengaduan', 'tbl_pengaduan.id_pengaduan = tbl_tanggapan.id_pengaduan')
            ->where('nik', $id_user)
            ->get();

        $data['ntf'] = $query->result();

        // var_dump($data); die;


        $data['title'] = 'Laporan Pengaduan';
        $data['pengguna'] = $this->db->get_where('tbl_masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $data['laporan'] = $this->M_user->getLaporanByNIK();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }

    // Untuk menambahkan laporan pengaduan
    public function add_laporan()
    {


        $id_user = $this->session->userdata('nik');

        $query = $this->db->select('*')
            ->from('tbl_tanggapan')
            ->join('tbl_pengaduan', 'tbl_pengaduan.id_pengaduan = tbl_tanggapan.id_pengaduan')
            ->where('nik', $id_user)
            ->where('notif_status', 0)
            ->get();

        $data['ntf_jumlah'] = $query->num_rows();

        $query = $this->db->select('*')
            ->from('tbl_tanggapan')
            ->join('tbl_pengaduan', 'tbl_pengaduan.id_pengaduan = tbl_tanggapan.id_pengaduan')
            ->where('nik', $id_user)
            ->get();

        $data['ntf'] = $query->result();


        $data['title'] = 'Tambah Laporan Pengaduan';
        $data['pengguna'] = $this->db->get_where('tbl_masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $data['notif'] = $this->db->get('tbl_pengaduan')->result();

        $this->form_validation->set_rules('isi', 'isi', 'required|trim|min_length[10]', [
            'required' => 'Isi laporan wajib di isi',
            'min_length' => 'Isi laporan min 10 karakter'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('laporan/add');
            $this->load->view('templates/footer');
        } else {
            $this->M_user->add_laporan();
        }
    }

    // Halaman detail pengaduan
    public function detail($id = null)
    {

        $pengaduan = $this->db->get_where('tbl_pengaduan', ['(id_pengaduan)' => $id])->row();

        $data['title'] = 'Detail Laporan Pengaduan';
        $id_user = $this->session->userdata('nik');

        $query = $this->db->select('*')
            ->from('tbl_tanggapan')
            ->join('tbl_pengaduan', 'tbl_pengaduan.id_pengaduan = tbl_tanggapan.id_pengaduan')
            ->where('nik', $id_user)
            ->where('notif_status', 0)
            ->get();

        $data['ntf_jumlah'] = $query->num_rows();

        $query = $this->db->select('*')
            ->from('tbl_tanggapan')
            ->join('tbl_pengaduan', 'tbl_pengaduan.id_pengaduan = tbl_tanggapan.id_pengaduan')
            ->where('nik', $id_user)
            ->get();

        $data['ntf'] = $query->result();

        $pengaduan = $this->db->get_where('tbl_pengaduan', ['md5(id_pengaduan)' => $id])->row();
        $idp = md5($pengaduan->id_pengaduan);
        if ($this->uri->segment(3) == null) {
            redirect('laporan/error404');
        } else {
            if ($id != $idp) {
                redirect('laporan/error404');
            }
        }


        $data['title'] = 'Detail Laporan Pengaduan';
        $data['pengguna'] = $this->db->get_where('tbl_masyarakat', ['username' => $this->session->userdata('username')])->row_array();
        $data['pengaduan'] = $this->M_user->getPengaduanJoinMasyarakat($id, $data['pengguna']['nik']);
        $data['tanggapan'] = $this->M_user->getTanggapanJoinAdmin($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/detail', $data);
        $this->load->view('templates/footer');
    }


    public function notif_status($id)
    {
        $this->db->set('notif_status', 1);
        // var_dump($id);
        // die;
        $this->db->where('(id_tanggapan)', $id);
        if ($this->db->update('tbl_tanggapan')) {
            // $this->session->set_flashdata('true', 'Status pengaduan berhasil di edit');
            redirect('laporan/');
        } else {
            // $this->session->set_flashdata('false', 'Status pengaduan gagal di edit');
            // redirect('pengaduan/detail/' . $id);
        }
    }


    // Halaman error 404
    public function error404()
    {
        $this->load->view('error/404');
    }
}