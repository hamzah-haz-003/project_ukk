<?php
class M_pengaduan extends CI_Model
{
    public function getAllPengaduan()
    {
        $this->db->order_by('id_pengaduan', 'DESC');
        return $this->db->get('tbl_pengaduan')->result();
    }

    public function getPengaduanByIdJoinMasyarakat($id)
    {
        $pengaduan = $this->db->get_where('tbl_pengaduan', ['md5(id_pengaduan)' => $id])->row_array();
        $idp = $pengaduan['id_pengaduan'];
        // var_dump($idp);die();
        $query = "SELECT * FROM tbl_pengaduan INNER JOIN tbl_masyarakat ON tbl_pengaduan.nik = tbl_masyarakat.nik WHERE tbl_pengaduan.id_pengaduan = $idp";
        return $this->db->query($query)->row();
    }

    public function getTanggapanByIdJoinAdmin($id)
    {
        $pengaduan = $this->db->get_where('tbl_pengaduan', ['md5(id_pengaduan)' => $id])->row();
        $idp = $pengaduan->id_pengaduan;

        $query = "SELECT * FROM tbl_tanggapan INNER JOIN tbl_admin ON tbl_tanggapan.id_admin = tbl_admin.id_admin WHERE tbl_tanggapan.id_pengaduan = $idp ORDER BY tbl_tanggapan.id_tanggapan DESC";
        return $this->db->query($query)->result();
    }

    public function add_tanggapan($id, $id_admin)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            'id_tanggapan' => time(),
            'id_pengaduan' => $id,
            'tgl_tanggapan' => date('Y-m-d'),
            'tanggapan' => htmlspecialchars($this->input->post('tanggapan')),
            'id_admin' => $id_admin
        ];

        if ($this->db->insert('tbl_tanggapan', $data)) {
            $this->session->set_flashdata('true', 'Tanggapan berhasi di kirim');
            redirect('pengaduan/detail/' . md5($id));
        } else {
            $this->session->set_flashdata('false', 'Tanggapan gagal di kirim');
            redirect('pengaduan/detail/' . md5($id));
        }
    }

    public function del_tanggapan($id_pengaduan, $id_tanggapan)
    {
        if ($this->db->delete('tbl_tanggapan', ['id_tanggapan' => $id_tanggapan])) {
            $this->session->set_flashdata('true', 'Tanggapan berhasil di hapus');
            redirect('pengaduan/detail/' . md5($id_pengaduan));
        } else {
            $this->session->set_flashdata('false', 'Tanggapan gagal di hapus');
            redirect('pengaduan/detail/' . md5($id_pengaduan));
        }
    }

    public function del_pengaduan($id)
    {
        $pengaduan = $this->db->get_where('tbl_pengaduan', ['id_pengaduan' => $id])->row();
        unlink(FCPATH . 'asset/upload/' . $pengaduan->foto);
        if ($this->db->delete('tbl_pengaduan', ['id_pengaduan' => $id])) {
            $this->db->delete('tbl_tanggapan', ['id_pengaduan' => $id]);
            $this->session->set_flashdata('true', 'Laporan pengaduan berhasil di hapus');
            redirect('pengaduan');
        } else {
            $this->session->set_flashdata('else', 'Laporan pengaduan gagal di hapus');
            redirect('pengaduan');
        }

    }

    public function edit_status()
    {
        $id = md5($this->input->post('id'));
        $this->db->set('status', $this->input->post('status'));
        $this->db->where('md5(id_pengaduan)', $id);
        if ($this->db->update('tbl_pengaduan')) {
            $this->session->set_flashdata('true', 'Status pengaduan berhasil di edit');
            redirect('pengaduan/detail/' . $id);
        } else {
            $this->session->set_flashdata('false', 'Status pengaduan gagal di edit');
            redirect('pengaduan/detail/' . $id);
        }
    }
    public function status_notif()
    {
        $id = md5($this->input->post('id'));
        $this->db->set('status_notif', $this->input->post('status_notif'));
        $this->db->where('id_pengaduan', $id);
        if ($this->db->update('tbl_pengaduan')) {
            $this->session->set_flashdata('true', 'Status pengaduan berhasil di edit');
            redirect('pengaduan/detail/' . $id);
        } else {
            $this->session->set_flashdata('false', 'Status pengaduan gagal di edit');
            redirect('pengaduan/detail/' . $id);
        }
    }

}