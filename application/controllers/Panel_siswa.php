<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel_siswa extends CI_Controller
{

	public function index()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "HOME"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/dashboard', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function pengumuman()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "PENGUMUMAN"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/pengumuman', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function biodata()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		} else {
			$sess = $this->session->userdata('no_pendaftaran');
			$data = array(
				'user'		=> $this->siswa->base_biodata($sess),
				'judul_web'	=> "BIODATA"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/biodata', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function cetak()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		}
		$sess 		= $this->session->userdata('no_pendaftaran');
		$base_bio 	= $this->siswa->base_biodata($sess);
		$data = array(
			'user'			=> $base_bio,
			'judul_web'		=> ucwords($base_bio->no_pendaftaran) . '-' . ucwords($base_bio->nama_lengkap),
			'thn_ppdb'		=> date('Y', strtotime($base_bio->tgl_siswa))
		);

		$this->load->view('siswa/cetak', $data);
	}

	public function rekap_nilai()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		}

		$sess 		= $this->session->userdata('no_pendaftaran');
		$base_bio 	= $this->siswa->base_biodata($sess);

		$data = array(
			'user'			=> $base_bio,
			'judul_web'		=> "Cetak Rekap Nilai " . ucwords($base_bio->nama_lengkap),
			'thn_ppdb'		=> $this->siswa->get_fy(),
			'nilai_rapor'	=> $this->siswa->get_print('study-report', $sess)->rata_rata_nilai,
			'rapor'			=> array(
				'sci'	=> $this->siswa->get_val('rapor', $sess, "Ilmu Pengetahuan Alam (IPA)"),
				'soc'	=> $this->siswa->get_val('rapor', $sess, "Ilmu Pengetahuan Sosial (IPS)"),
				'mat'	=> $this->siswa->get_val('rapor', $sess, "Matematika"),
				'ind'	=> $this->siswa->get_val('rapor', $sess, "Bahasa Indonesia"),
				'eng'	=> $this->siswa->get_val('rapor', $sess, "Bahasa Inggris"),
				'rlg'	=> $this->siswa->get_val('rapor', $sess, "Pendidikan Agama"),
				'nat'	=> $this->siswa->get_val('rapor', $sess, "PKN")
			),
			'nilai_usbn'	=> $this->siswa->get_print('schtest-val', $sess)->nilai_usbn,
			'usbn'			=> array(
				'sci'	=> $this->siswa->get_val('usbn', $sess, "Ilmu Pengetahuan Alam (IPA)"),
				'soc'	=> $this->siswa->get_val('usbn', $sess, "Ilmu Pengetahuan Sosial (IPS)"),
				'mat'	=> $this->siswa->get_val('usbn', $sess, "Matematika"),
				'ind'	=> $this->siswa->get_val('usbn', $sess, "Bahasa Indonesia"),
				'eng'	=> $this->siswa->get_val('usbn', $sess, "Bahasa Inggris"),
				'rlg'	=> $this->siswa->get_val('usbn', $sess, "Pendidikan Agama"),
				'nat'	=> $this->siswa->get_val('usbn', $sess, "PKN")
			),
			'nilai_unbk'	=> $this->siswa->get_print('nattest-val', $sess)->nilai_unbk,
			'unbk'			=> array(
				'sci'	=> $this->siswa->get_val('unbk', $sess, "Ilmu Pengetahuan Alam (IPA)"),
				'mat'	=> $this->siswa->get_val('unbk', $sess, "Matematika"),
				'ind'	=> $this->siswa->get_val('unbk', $sess, "Bahasa Indonesia"),
				'eng'	=> $this->siswa->get_val('unbk', $sess, "Bahasa Inggris")
			),
		);

		$this->load->view('siswa/rekap_nilai', $data);
	}

	public function cetak_lulus()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('logcs');
		}

		$sess 		= $this->session->userdata('no_pendaftaran');
		$base_bio 	= $this->siswa->base_biodata($sess);

		$data = array(
			'user'		=> $this->siswa->get_print('passed', $sess),
			'judul_web'	=> "Cetak Bukti Lulus " . ucwords($base_bio->nama_lengkap),
			'thn_ppdb'	=> date('Y', strtotime($base_bio->tgl_siswa)),
			'v_ket'		=> $this->siswa->get_print('announcement')
		);

		if ($data['user']->status_pendaftaran != 'lulus') {
			redirect('404');
		}

		$this->load->view('siswa/cetak_lulus', $data);
	}

	public function uploading()
	{
		if ($this->session->userdata('no_pendaftaran') == NULL) {
			redirect('');
		} else {
			$data = array(
				'user'		=> $this->siswa->base_biodata($this->session->userdata('no_pendaftaran')),
				'judul_web'	=> "UNGGAHAN"
			);

			$this->load->view('siswa/header', $data);
			$this->load->view('siswa/upload_file', $data);
			$this->load->view('siswa/footer');
		}
	}

	public function saving_file($id_siswa)
	{
		$this->load->model('Model_siswa');
		$siswa = $this->Model_siswa->get_siswa_by_id($id_siswa);
		if (!$siswa) {
			show_error('Siswa tidak ditemukan');
			return;
		}

		$uploadedFiles = [];

		$upload_path = FCPATH . 'img/';

		if (!empty($_FILES['ijazah']['name'])) {
			$nama_file_ijazah = $siswa->no_pendaftaran . '-ijazah.' . pathinfo($_FILES['ijazah']['name'], PATHINFO_EXTENSION);
			$old_file_ijazah = $upload_path . 'ijazah/' . $siswa->ijazah;
			if (file_exists($old_file_ijazah) && is_file($old_file_ijazah)) {
				unlink($old_file_ijazah);
			}
			move_uploaded_file($_FILES['ijazah']['tmp_name'], $upload_path . 'ijazah/' . $nama_file_ijazah);
			$uploadedFiles['ijazah'] = $nama_file_ijazah;
		} else {
			$uploadedFiles['ijazah'] = $siswa->ijazah;
		}

		if (!empty($_FILES['skhu']['name'])) {
			$nama_file_skhu = $siswa->no_pendaftaran . '-skhu.' . pathinfo($_FILES['skhu']['name'], PATHINFO_EXTENSION);
			$old_file_skhu = $upload_path . 'skhu/' . $siswa->skhu;
			if (file_exists($old_file_skhu) && is_file($old_file_skhu)) {
				unlink($old_file_skhu);
			}
			move_uploaded_file($_FILES['skhu']['tmp_name'], $upload_path . 'skhu/' . $nama_file_skhu);
			$uploadedFiles['skhu'] = $nama_file_skhu;
		} else {
			$uploadedFiles['skhu'] = $siswa->skhu;
		}

		if (!empty($_FILES['kk']['name'])) {
			$nama_file_kk = $siswa->no_pendaftaran . '-kk.' . pathinfo($_FILES['kk']['name'], PATHINFO_EXTENSION);
			$old_file_kk = $upload_path . 'kk/' . $siswa->kk;
			if (file_exists($old_file_kk) && is_file($old_file_kk)) {
				unlink($old_file_kk);
			}
			move_uploaded_file($_FILES['kk']['tmp_name'], $upload_path . 'kk/' . $nama_file_kk);
			$uploadedFiles['kk'] = $nama_file_kk;
		} else {
			$uploadedFiles['kk'] = $siswa->kk;
		}


		if (!empty($_FILES['photo']['name'])) {
			$nama_file_photo = $siswa->no_pendaftaran . '-photo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
			$old_file_photo = $upload_path . 'photo/' . $siswa->photo;
			if (file_exists($old_file_photo) && is_file($old_file_photo)) {
				unlink($old_file_photo);
			}
			move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path . 'photo/' . $nama_file_photo);
			$uploadedFiles['photo'] = $nama_file_photo;
		} else {
			$uploadedFiles['photo'] = $siswa->photo;
		}

		$this->db->where('id_siswa', $siswa->id_siswa);
		$this->db->update('tbl_siswa', [
			'ijazah' => $uploadedFiles['ijazah'],
			'skhu' => $uploadedFiles['skhu'],
			'kk' => $uploadedFiles['kk'],
			'photo' => $uploadedFiles['photo'],
		]);

		$this->session->set_flashdata('success', 'Dokument dan pas foto sudah diperbarui');
		redirect(base_url('panel_siswa/uploading'));
	}


	public function logout()
	{
		if ($this->session->userdata('no_pendaftaran') != '') {
			$this->session->sess_destroy();
		}
		redirect('');
	}
}
