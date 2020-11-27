<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use TCPDF;

class Cetak3 extends BaseController
{
	public function index()
	{
		return view('login');
	}
	public function profil1($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
		<table>
			<tr>
				<td width="100%" align="center"><h1>PERMOHONAN PENGAJUAN</h1></td>
			</tr>
			<tr>
				<td width="100%" align="center"><h1>DANA BERGULIR</h1></td>
			</tr>
			<tr>
				<td width="100%" align="center"><h1>PROGRAM PEMBERDAYAAN</h1></td>
			</tr>
			<tr>
				<td width="100%" align="center"><h1>KEPADA KOPERASI DAN USAHA MIKRO</h1></td>
			</tr>
			<tr>
				<td width="100%" align="center"><h1>KOTA KEDIRI</h1></td>
			</tr>
			<tr>
				<td width="100%" align="center"><img src="./assets/images/logo.svg" alt="Girl in a jacket" height="400"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td height="50" width="30%"></td>
				<td height="50" width="70%"></td>
			</tr>
			<tr>
				<td height="20" width="30%">NAMA KOPERASI</td>
				<td height="20" width="70%">: ' . ($data['peng_prof_nama_usaha'] ? strtoupper($data['peng_prof_nama_usaha']) : '') . '</td>
			</tr>
			<tr>
				<td height="20" width="30%">NAMA KETUA</td>
				<td height="20" width="70%">: ' . ($data['peng_prof_pimpinan'] ? strtoupper($data['peng_prof_pimpinan']) : '') . '</td>
			</tr>
			<tr>
				<td height="20" width="30%">ALAMAT</td>
				<td height="20" width="70%">: ' . ($data['peng_prof_alamat'] ? strtoupper($data['peng_prof_alamat']) : '') . '</td>
			</tr>
			<tr>
				<td height="20" width="30%">NO TLP/ HP</td>
				<td height="20" width="70%">: ' . ($data['peng_no_telp'] ? strtoupper($data['peng_no_telp']) : '') . '/' . ($data['peng_no_hp'] ? strtoupper($data['peng_no_hp']) : '') . '</td>
			</tr>
		</table>
		';
		return $html;
	}
	public function profil2($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="15%" align="center" rowspan="3"><img src="./assets/images/logokoperasi.jpg" alt="Girl in a jacket" height="50"></td>
						<td width="30%">KOPERASI</td>
						<td width="55%">: ' . ($data['peng_prof_nama_usaha'] ? strtoupper($data['peng_prof_nama_usaha']) : '') . '</td>
					</tr>
					<tr>
						<td width="30%">BADAN HUKUM</td>
						<td width="55%">: ' . ($data['peng_prof_alamat'] ? strtoupper($data['peng_prof_alamat']) : '') . '</td>
					</tr>
					<tr>
						<td width="30%">TANGGAL BADAN HUKUM</td>
						<td width="55%">: ' . ($data['peng_no_telp'] ? strtoupper($data['peng_no_telp']) : '') . '/' . ($data['peng_no_hp'] ? strtoupper($data['peng_no_hp']) : '') . '</td>
					</tr>
				</table>
				<hr/>
				<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="40%">Kediri, </td>
					</tr>
					<tr>
						<td width="10%">Nomor</td>
						<td width="45%">: _ _ _ _ _  _</td>
						<td width="5%"> </td>
						<td width="40%">Kepada</td>
					</tr>
					<tr>
						<td width="10%">Lamp</td>
						<td width="45%">: 2 (dua) Berkas Proposal</td>
						<td width="5%"> </td>
						<td width="40%">Yth. Kepala Dinas Koperasi, UMTK Kota Kediri</td>
					</tr>
					<tr>
						<td width="10%">Hal</td>
						<td width="40%">: Permohonan Pinjaman Dana Bergulir Program Pemberdayaan Koperasi
					  </td>
						<td width="10%"> </td>
						<td width="40%"></td>
					</tr>
				</table>
		';

		$html .= '<p align="justify" style="text-indent: 0.5in;">
		Berdasarkan hasil keputusan Rapat Anggota pada hari ' . strftime('%A', strtotime($data['peng_tanggal'])) . ' tanggal ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . ' bertempat di ' . $data['peng_prof_alamat'] . ' dan rencana kerja RAPB Tahun Buku berjalan serta dalam upaya pengembangan dan peningkatan usaha Koperasi, maka diperlukan dukungan tambahan sarana usaha / modal kerja sebesar Rp ' . number_format($data['peng_nominal'], 2, ',', '.') . ' [ ' . terbilang($data['peng_nominal']) . ' ]</br>
		Untuk itu bersama ini kami mengajukan permohonan pinjaman Dana Bergulir yang bersumber dari APBD Pemerintah Kota Kediri.</br>
		Untuk melengkapi permohonan tersebut, kami sertakan lampiran sebagai berikut;
		</p>
		<table>
			<tr>
				<td width="5%">1.</td>
				<td width="95%">Profil Koperasi;</td>
			</tr>
			<tr>
				<td width="5%">2.</td>
				<td width="95%"> Susunan pengurus dan pengawas koperasi di Legalisir Kepala Dinas Koperasi, UMTK;</td>
			</tr>
			<tr>
				<td width="5%">3.</td>
				<td width="95%">Foto copy akta pendirian koperasi minimal 2 tahun</td>
			</tr>
			<tr>
				<td width="5%">4.</td>
				<td width="95%">Buku laporan Rapat Anggota Tahunan 2 Tahun Terakhir</td>
			</tr>
			<tr>
				<td width="5%">5.</td>
				<td width="95%">Foto copy jaminan yang disertai surat pernyataan sanggup menyerahkan jaminan</td>
			</tr>
			<tr>
				<td width="5%">6.</td>
				<td width="95%">Foto copy KTP Pengurus dan Pengawas yang masih berlaku</td>
			</tr>
			<tr>
				<td width="5%">7.</td>
				<td width="95%">Ijin ijin yang dimiliki (foto copy SIUP, TDP, NPWP) serta foto copy Sertifikat Penilaian Kesehatan
				Koperasi;</td>
			</tr>
			<tr>
				<td width="5%">8.</td>
				<td width="95%">Berita Acara Rapat Anggota [tentang kesepakatan pengajuan Dana Bergulir dan surat kuasa kepada Pengurus untuk melakukan penyelesaian terhadap hal-hal yang terkait pengajuan Dana Bergulir]
				</td>
			</tr>
			<tr>
				<td width="5%">9.</td>
				<td width="95%">Surat pernyataan sanggup dilakukan uji penilaian kelayakan usaha</td>
			</tr>
			<tr>
				<td width="5%">10.</td>
				<td width="95%">Pas foto Pengurus dan Pengawas [ berwarna 4 x 6 @ 2 lembar terbaru ]</td>
			</tr>
			<tr>
				<td width="5%">11.</td>
				<td width="95%">Surat pernyataan pemanfaatan pinjaman dan rencana penggunaan bermaterai Rp. 6 .000</td>
			</tr>
			<tr>
				<td width="5%">12</td>
				<td width="95%"> Surat pernyataan Barang Jaminan Perorangan/aset Koperasi yang menjadi jaminan bermaterai Rp. 6
				.000 dan foto jaminan.</td>
			</tr>
			<tr>
				<td width="5%">13.</td>
				<td width="95%">Foto copy KTP suami istri yang masih berlaku dan KK, Surat Nikah pemilik jaminan [apabila jaminan bukan milik Koperasi]</td>
			</tr>
			<tr>
				<td width="5%">14.</td>
				<td width="95%">Denah lokasi ,Papan Nama Koperasi dan Foto Kegiatan</td>
			</tr>
			<tr>
				<td width="5%">15.</td>
				<td width="95%">Surat keterangan taksiran harga tanah dari Kelurahan [apabila jaminan berupa sertifikat]</td>
			</tr>
		</table>
		<p align="justify">
		Demikian  permohonan kami atas perkenannya disampaikan terimakasih.
		</p>
		<table>
			<tr>
				<td width="5%"></td>
				<td width="90%" align="center"><b>Pengurus Koperasi ' . ($data['peng_prof_nama_usaha'] ? $data['peng_prof_nama_usaha'] : '') . '</b></td>
				<td width="5%"></td>
			</tr>
			<tr>
				<td width="33%" height="80" align="center"><b>Ketua</b></td>
				<td width="33%"></td>
				<td width="33%"  align="center"><b>Sekretaris</b></td>
			</tr>
			<tr>
				<td width="33%"  align="center"><b>[' . ($data['peng_ketua'] ? $data['peng_ketua'] : '') . ']</b></td>
				<td width="33%"></td>
				<td width="33%" align="center"><b>[' . ($data['peng_sekretaris'] ? $data['peng_sekretaris'] : '') . ']</b></td>
			</tr>
		</table>';
		return $html;
	}

	public function profil3($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="15%" align="center"><img src="./assets/images/logokoperasi.jpg" alt="Girl in a jacket" height="50"></td>
						<td width="85%" align="center" valign="bottom"><h1>PROFIL KOPERASI</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<b>
				<table>
				<tr>
				<td width="5%"></td>
				<td width="35%"></td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%">1.</td>
				<td width="35%">IDENTITAS KOPERASI</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">1.</td>
				<td width="30%">Nama Koperasi</td>
				<td width="60%">: ' . $data['peng_prof_nama_usaha'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">2.</td>
				<td width="30%">Badan Hukum</td>
				<td width="60%">: No. ' . $data['peng_badan_hukum_no'] . ' Tgl ' . $data['peng_badan_hukum_tanggal'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">3.</td>
				<td width="30%">Alamat</td>
				<td width="60%">: ' . $data['peng_prof_alamat'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">4.</td>
				<td width="30%">Kesehatan USP</td>
				<td width="60%">: ' . $data['peng_kesehatan_usp'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">5.</td>
				<td width="30%">Jumlah Anggota</td>
				<td width="60%">: ' . $data['peng_jumlah_anggota'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">6.</td>
				<td width="30%">Pelaksanaan RAT</td>
				<td width="60%">: ' . $data['peng_pelaksanaan_rat'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">7.</td>
				<td width="30%">Pengurus</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="30%">- Ketua</td>
				<td width="60%">: ' . $data['peng_ketua'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="30%">- Sekretaris</td>
				<td width="60%">: ' . $data['peng_sekretaris'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="30%">- Bendahara</td>
				<td width="60%">: ' . $data['peng_bendahara'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">8.</td>
				<td width="30%">Pengawas</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="30%">- Koordinator</td>
				<td width="60%">: ' . $data['peng_pengawas_koor'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="30%">- Anggota</td>
				<td width="60%">: 1. ' . $data['peng_pengawas_anggota1'] . ' 2. ' . $data['peng_pengawas_anggota2'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">9.</td>
				<td width="30%">Karyawan</td>
				<td width="60%">: ' . $data['peng_prof_jumlah_karyawan'] . ' Orang</td>
			</tr>

			<tr>
				<td width="5%"></td>
				<td width="35%"></td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%">2.</td>
				<td width="35%">USAHA</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">1.</td>
				<td width="30%">Usaha yang dikelola</td>
				<td width="60%">: 1. ' . $data['peng_usaha_dikelola_1'] . ' 2. ' . $data['peng_usaha_dikelola_2'] . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">2.</td>
				<td width="30%">Omset usaha</td>
				<td width="60%">: ' . number_format($data['peng_prof_omset_per_bulan'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">3.</td>
				<td width="30%">Pendapatan penjualan</td>
				<td width="60%">: ' . number_format($data['peng_prof_pendapatan_penjualan'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">4.</td>
				<td width="30%">Beban penjualan</td>
				<td width="60%">: ' . number_format($data['peng_prof_beban_penjualan'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">5.</td>
				<td width="30%">SHU</td>
				<td width="60%">: ' . number_format($data['peng_usaha_shu'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="35%"></td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%">3.</td>
				<td width="35%">PERMODALAN</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">1.</td>
				<td width="30%">Equitas [modal sendiri]</td>
				<td width="60%">: ' . number_format($data['peng_prof_modal_sendiri'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">2.</td>
				<td width="30%">Kewajiban</td>
				<td width="60%">: ' . number_format($data['peng_permodalan_kewajiban'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">3.</td>
				<td width="30%">Modal Kerja</td>
				<td width="60%">: ' . number_format($data['peng_permodalan_modal_kerja'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">4.</td>
				<td width="30%">Modal investasi [asset tetap]</td>
				<td width="60%">: ' . number_format($data['peng_prof_modal_luar'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">5.</td>
				<td width="30%">Pinjam Bank/lembaga lainnya</td>
				<td width="60%">: ' . number_format($data['peng_permodalan_pinjaman_bank'], 2, ',', '.') . '</td>
			</tr>
		</table>
		</b>
		<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height="20" align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>Pengurus Koperasi</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>' . $data['peng_srt_nama_usaha'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height="100" align="center"><b>Ketua</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>[' . $data['peng_ketua'] . ']</b></td>
					</tr>
				</table>
		';
		return $html;
	}
	public function profil4($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();
		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>PERNYATAAN BERSEDIA</h1></td>
					</tr>
					<tr>
						<td width="100%" align="center"><h1>MENYERAHKAN JAMINAN</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
				</table>
		';

		$html .= '<b>
		<table>
			<tr>
				<td width="50%">Yang bertanda tangan dibawah ini kami:</td>
				<td width="50%"></td>
			</tr>
			<tr>
				<td width="20%">Nama</td>
				<td width="80%">: ' . $data['peng_prof_pimpinan'] . '</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
			</tr>
			<tr>
				<td width="20%">Pemegang KTP No</td>
				<td width="80%">: ' . $data['peng_jam_pemegang_ktp_no'] . '</td>
			</tr>
			<tr>
				<td width="20%">Pekerjaan</td>
				<td width="80%">: ' . $data['peng_jam_pekerjaan'] . '</td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
		Berdasarkan Permohonan Pinjaman Dana Bergulir Pemerintah Kota Kediri yang kami ajukan melalui Dinas Koperasi, UMTK Kota Kediri, apabila permohonan tersebut disetujui maka kami menyatakan: 
		</p>
		<p align="justify">
		Bersedia menyerahkan jaminan atas pinjaman yang disetujui selama pinjaman berlangsung berupa:
		BPKB Kendaraan roda /  empat
		</p>
		<table>
			<tr>
				<td width="20%">Tahun Pembuatan</td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="20%">No Polisi</td>
				<td width="80%">: ' . $data['peng_jam_nopol'] . '</td>
			</tr>
			<tr>
				<td width="20%">No Mesin</td>
				<td width="80%">: ' . $data['peng_jam_mesin'] . '</td>
			</tr>
			<tr>
				<td width="20%">No Rangka</td>
				<td width="80%">: ' . $data['peng_jam_rangka'] . '</td>
			</tr>
			<tr>
				<td width="20%">Atas Nama</td>
				<td width="80%">: ' . $data['peng_jam_atas_nama'] . '</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_jam_alamat'] . '</td>
			</tr>
			<tr>
				<td width="20%" height="40">Sertifikat Tanah</td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="20%">No Akta</td>
				<td width="80%">: ' . $data['peng_jam_no_akta'] . '</td>
			</tr>
			<tr>
				<td width="20%">Tempat</td>
				<td width="80%">: ' . $data['peng_jam_tempat'] . '</td>
			</tr>
			<tr>
				<td width="20%">Atas Nama</td>
				<td width="80%">: ' . $data['peng_jam_atas_nama_tanah'] . '</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_jam_alamat_tanah'] . '</td>
			</tr>
		</table>
		<p align="justify">
		Demikian pernyataan ini kami buat agar dapat digunakan sebagaimana perlunya.
		</p>
		</b>
		<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center">Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height="100" align="center"><b>Yang membuat pernyataan</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>[' . $data['peng_prof_pimpinan'] . ']</b></td>
					</tr>
				</table>';
		return $html;
	}
	public function profil5($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();
		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>PERNYATAAN BERSEDIA MENYERAHKAN JAMINAN</h1></td>
					</tr>
					<tr>
						<td width="100%" align="center"><h1>(JIKA JAMINAN BUKAN ATAS NAMA PEMOHON)</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
				</table>
		';

		$html .= '
		<table>
			<tr>
				<td width="50%">Yang bertanda tangan dibawah ini kami:</td>
				<td width="50%"></td>
			</tr>
			<tr>
				<td width="20%">Nama</td>
				<td width="80%">: ' . $data['peng_prof_pimpinan'] . '</td>
			</tr>
			<tr>
				<td width="20%">Tempat Tanggal Lahir</td>
				<td width="80%">: kosong</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
			</tr>
			<tr>
				<td width="20%">Pemegang KTP No</td>
				<td width="80%">: ' . $data['peng_jam_pemegang_ktp_no'] . '</td>
			</tr>
			<tr>
				<td width="20%">Pekerjaan</td>
				<td width="80%">: ' . $data['peng_jam_pekerjaan'] . '</td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
		Berdasarkan Permohonan Pinjaman Dana Bergulir Pemerintah Kota Kediri yang diajukan oleh Pengurus Koperasi melalui Dinas Koperasi, UMTK Kota Kediri, apabila permohonan tersebut disetujui maka kami sebagai pemilik jaminan menyatakan :
		</p>
		<p align="justify">
		Bersedia menyerahkan jaminan atas pinjaman yang disetujui  selama pinjaman berlangsung berupa :
		</p>
		<table>
		<tr>
				<td width="20%">BPKB kendaraan roda dua /empat</td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="20%">Tahun Pembuatan</td>
				<td width="80%">: ' . $data['peng_jam_tahun_pembuatan'] . '</td>
			</tr>
			<tr>
				<td width="20%">No Polisi</td>
				<td width="80%">: ' . $data['peng_jam_nopol'] . '</td>
			</tr>
			<tr>
				<td width="20%">No Mesin</td>
				<td width="80%">: ' . $data['peng_jam_mesin'] . '</td>
			</tr>
			<tr>
				<td width="20%">No Rangka</td>
				<td width="80%">: ' . $data['peng_jam_rangka'] . '</td>
			</tr>
			<tr>
				<td width="20%">Atas Nama</td>
				<td width="80%">: ' . $data['peng_jam_atas_nama'] . '</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_jam_alamat'] . '</td>
			</tr>
			<tr>
				<td width="20%" height="40">Sertifikat Tanah</td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="20%">No Akta</td>
				<td width="80%">: ' . $data['peng_jam_no_akta'] . '</td>
			</tr>
			<tr>
				<td width="20%">Tempat</td>
				<td width="80%">: ' . $data['peng_jam_tempat'] . '</td>
			</tr>
			<tr>
				<td width="20%">Atas Nama</td>
				<td width="80%">: ' . $data['peng_jam_atas_nama_tanah'] . '</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_jam_alamat_tanah'] . '</td>
			</tr>
		</table>
		<p align="justify">
		Demikian Pernyataan ini kami buat, agar dapat digunakan sebagaimana perlunya
		</p>
		<table>
					<tr>
						<td width="10%"></td>
						<td width="45%">Mengetahui,</td>
						<td width="5%"></td>
						<td width="45%">Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%">Kepala Kelurahan</td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>Yang membuat pernyataan</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>Suami / Istri / Keluarga</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>Nama Terang</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="left"><b>1. .................. [' . $data['peng_prof_pimpinan'] . ']</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%">[' . $data['peng_prof_pimpinan'] . ']</td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="left"><b>2. .................. [' . $data['peng_prof_pimpinan'] . ']</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="left"><b>3. .................. [' . $data['peng_prof_pimpinan'] . ']</b></td>
					</tr>
				</table>';
		return $html;
	}
	public function profil6_($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();
		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>SURAT PERSETUJUAN PINJAMAN</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
				</table>
		';

		$html .= '
		<table>
			<tr>
				<td width="100%">Yang bertanda tangan dibawah ini pengurus dan pengawas Koperasi ' . $data['peng_prof_pimpinan'] . ':</td>
			</tr>
			<tr>
				<td width="5%">a)</td>
				<td width="20%">Nama Koperasi</td>
				<td width="75%">: ' . $data['peng_prof_nama_usaha'] . '</td>
			</tr>
			<tr>
				<td width="5%">b)</td>
				<td width="20%">Badan Hukum</td>
				<td width="75%">: ' . $data['peng_badan_hukum_no'] . '</td>
			</tr>
			<tr>
				<td width="5%">c)</td>
				<td width="20%">Tanggal BH</td>
				<td width="75%">: ' . $data['peng_badan_hukum_tanggal'] . '</td>
			</tr>
			<tr>
				<td width="5%">d)</td>
				<td width="20%">Alamat</td>
				<td width="75%">: ' . $data['peng_prof_alamat'] . '</td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
		Sehubungan dengan pengajuan pinjaman koperasi kami kepada Pemerintah Kota Kediri sebesar Rp <b>' . ($data['peng_nominal'] ? number_format($data['peng_nominal'], 2, ",", ".") : '') . '</b> [' . terbilang($data['peng_nominal']) . ']
		</p>
		<p align="justify">
		Dengan ini kami menyatakan bahwa :
		</p>
		<p align="justify" style="text-indent: 0.5in;">
		1.	Kami mengetahui dan menyetujui pengajuan pinjaman tersebut untuk menambah modal usaha koperasi kami;</br>
		2.	Kami atas nama koperasi siap menanggung segala resiko yang antara lain:</br>
		a)	Membayar denda atas tunggakan angsuran sebagaimana ketentuan yang berlaku ;</br>
		b)	Apabila pengurus lalai dan atau meninggal dunia, sehingga tidak bertanggung jawab terhadap pinjaman yang telah diterima, maka kami bertanggung jawab atas penyelesaian pinjaman tersebut.
		</p>
		<p align="justify">
		Demikian persetujuan ini sebagai bahan pertimbangan.
		</p>
		<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height="50">Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%">Yang mengajukan permohonan</td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>mengetahui / menyetujui</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%">Pengurus Koperasi </td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="center"><b>Pengawas Koperasi</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%" height = "30" align="left"><b>1. .................. [' . $data['peng_ketua'] . ']</b></td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="left"><b>1. .................. [' . $data['peng_pengawas_koor'] . ']</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%" height = "30" align="left"><b>1. .................. [' . $data['peng_sekretaris'] . ']</b></td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="left"><b>2. .................. [' . $data['peng_pengawas_anggota1'] . ']</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%" height = "30" align="left"><b>1. .................. [' . $data['peng_bendahara'] . ']</b></td>
						<td width="5%"></td>
						<td width="45%" height = "30" align="left"><b>3. .................. [' . $data['peng_pengawas_anggota2'] . ']</b></td>
					</tr>
				</table>';
		return $html;
	}
	public function profil6($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();
		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>SURAT KESANGGUPAN BERSEDIA </h1></td>
					</tr>
					<tr>
						<td width="100%" align="center"><h1>DILAKUKAN KELAYAKAN USAHA</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
				</table>
		';

		$html .= '
		<table>
			<tr>
				<td width="50%">Yang bertanda tangan dibawah ini pengurus koperasi:</td>
				<td width="50%"></td>
			</tr>
			<tr>
				<td width="20%">Nama Koperasi</td>
				<td width="80%">: ' . $data['peng_prof_pimpinan'] . '</td>
			</tr>
			<tr>
				<td width="20%">Badan Hukum</td>
				<td width="80%">: ' . $data['peng_badan_hukum_no'] . '</td>
			</tr>
			<tr>
				<td width="20%">Tanggal BH</td>
				<td width="80%">: ' . $data['peng_badan_hukum_tanggal'] . '</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
		Berdasarkan Permohonan Pinjaman Dana Bergulir Pemerintah Kota Kediri yang kami ajukan, dengan ini kami sanggup  dilakukan uji kelayakan usaha kami sebagaimana ketentuan dalam prosedur penyaluran dana bergulir dimaksud.
		</p>
		<p align="justify">
		Demikian pernyataan ini kami buat, selanjutnya dapat digunakan sebagaimana mestinya.
		</p>
		<table>
					<tr>
						<td  height="50"></td>
					</tr>
					<tr>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>	
					</tr>
					<tr>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>Yang membuat Pengurus</b></td>
					</tr>
					<tr>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>Koperasi</b></td>
					</tr>
					<tr>
						<td width="30%"  height="50"></td>
						<td width="5%"></td>
						<td width="30%"></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>[' . $data['peng_prof_nama_usaha'] . ']</b></td>
					</tr>
					<tr>
						<td width="30%" height="70" align="center"><b>Ketua</b></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>Sekretaris</b></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>Bendahara</b></td>
					</tr>
					<tr>
						<td width="30%" align="center"><b>[' . $data['peng_ketua'] . ']</b></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>[' . $data['peng_sekretaris'] . ']</b></td>
						<td width="5%"></td>
						<td width="30%" align="center"><b>[' . $data['peng_bendahara'] . ']</b></td>
					</tr>
				</table>';
		return $html;
	}
	public function profil7($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>SURAT KETERANGAN</h1></td>
					</tr>
					<tr>
						<td width="100%" align="center"><h1>Nomor : </h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
		';

		$html .= '
		<table>
		<tr>
				<td width="50%"></td>
				<td width="50%"></td>
			</tr>
			<tr>
				<td width="50%">Pada hari ini, ' . strftime('%A', strtotime($data['peng_tanggal'])) . '</td>
				<td width="50%">Tanggal ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</td>
			</tr>
			<tr>
				<td width="50%">Kami,</td>
				<td width="50%"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td width="20%">Kepala kelurahan</td>
				<td width="80%">: ' . $data['peng_sk_kepala_kelurahan'] . '</td>
			</tr>
			<tr>
				<td width="20%">Kecamatan</td>
				<td width="80%">: ' . $data['peng_sk_kecamatan'] . '</td>
			</tr>
			<tr>
				<td width="20%">Kota</td>
				<td width="80%">: ' . $data['peng_sk_kota'] . '</td>
			</tr>
		</table>
		<table>
			<tr>
				<td width="10%"></td>
				<td width="80%"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="10%">01</td>
				<td width="30%">Sebidang tanah seluas</td>
				<td width="60%">: ' . $data['peng_sk_tanah_luas'] . ' M2</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Terletak di Desa / Kelurahan</td>
				<td width="60%">: ' . $data['peng_sk_tanah_desa'] . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Kecamatan / Kota</td>
				<td width="60%">: ' . $data['peng_sk_tanah_kecamatan'] . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Bukti Sertifikat Hak Milik (SHM) No</td>
				<td width="60%">: ' . $data['peng_sk_tanah_no_shm'] . ' tanggal ' . date('d-m-Y', strtotime($data['peng_sk_tanah_tanggal_shm'])) . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Tercatat atas nama</td>
				<td width="60%">: ' . $data['peng_sk_tanah_atas_nama'] . '</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td width="80%"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="10%">02</td>
				<td width="89%">Kami nilai transaksi harga tanah tersebut  harga umum yang berlaku saat ini</td>
				<td width="1%"></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Harga tanah Per – RU</td>
				<td width="60%">: Rp. ' . number_format($data['peng_sk_tanah_harga_ru'], 2, ",", ".") . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Harga tanah per meter	</td>
				<td width="60%">: Rp. ' . number_format($data['peng_sk_tanah_harga_meter'], 2, ",", ".") . '</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td width="80%"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="10%">03</td>
				<td width="30%">Luas Bangunan</td>
				<td width="60%">: ' . $data['peng_sk_tanah_luas_bangunan'] . ' M2</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Harga bangunan [M2]</td>
				<td width="60%">: Rp. ' . number_format($data['peng_sk_tanah_harga_bangunan'], 2, ",", ".") . '</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td width="80%"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="10%">04</td>
				<td width="89%">Letak kami tunjukkan kepada petugas  PD. BPR Kota Kediri, dengan batas-batas:</td>
				<td width="1%"></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Sebelah utara</td>
				<td width="60%">: ' . $data['peng_sk_tanah_letak_utara'] . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Sebelah selatan</td>
				<td width="60%">: ' . $data['peng_sk_tanah_letak_selatan'] . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Sebelah timur</td>
				<td width="60%">: ' . $data['peng_sk_tanah_letak_timur'] . '</td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="30%">Sebelah barat</td>
				<td width="60%">: ' . $data['peng_sk_tanah_letak_barat'] . '</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td width="80%"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="10%">05</td>
				<td width="30%">Penggunaan  tanah saat ini</td>
				<td width="60%">: ' . $data['peng_sk_tanah_penggunaan'] . '</td>
			</tr>
			<tr>
				<td width="10%">05</td>
				<td width="30%">Demikian surat keterangan ini dibuat untuk dipergunakan sebagaiamana semestinya.</td>
				<td width="60%"></td>
			</tr>
		</table>
		<table>
			<tr>
				<td width="10%"></td>
				<td width="45%"></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="45%"></td>
				<td width="5%"></td>
				<td width="45%" height="100" align="center"><b>Kepala Kelurahan</b></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="45%"></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>[' . $data['peng_sk_kepala_kelurahan'] . ']</b></td>
			</tr>
		</table>';
		return $html;
	}
	public function profil8($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();
		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>DENAH LOKASI DAN PAPAN NAMA KOPERASI</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<table>
					<tr>
						<td width="100%" align="center"></td>
					</tr>
				</table>
		';
		return $html;
	}
	public function profil8_($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->join('pengajuan_foto', 'peng_foto_peng_id = peng_id')->getWhere(['peng_foto_jenis' => 2,'peng_id' => $id])->getResultArray();
		// print_r($data);die();
		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>FOTO JAMINAN</h1></td>
					</tr>
				</table>
				<br/>
				<hr/>
				<table>';
				foreach ($data as $key => $value) {
					$html.='
						<tr>
							<td width="100%" align="center"><img src="./uploads/foto_kegiatan/'.$value['peng_foto_file'].'" height="150"></td>
						</tr>';
				}
				$html.='
				</table>
		';
		return $html;
	}
	public function profil9($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="15%" align="center"><img src="./assets/images/logokoperasi.jpg" alt="Girl in a jacket" height="50"></td>
						<td width="85%" align="center" valign="bottom"><h1>SURAT PERNYATAAN</h1></td>
					</tr>
				</table>
				<hr/>
				<b>
				
				<table>
					<tr>
						<td width="90%">Yang bertanda tangan dibawah ini pengurus koperasi:</td>
						<td width="10%"></td>
					</tr>
					<tr>
						<td width="20%">Nama Koperasi</td>
						<td width="80%">: ' . $data['peng_prof_pimpinan'] . '</td>
					</tr>
					<tr>
						<td width="20%">Badan Hukum</td>
						<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
					</tr>
					<tr>
						<td width="20%">Tanggal BH</td>
						<td width="80%">: ' . $data['peng_jam_pemegang_ktp_no'] . '</td>
					</tr>
					<tr>
						<td width="20%">Alamat</td>
						<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
					</tr>
				</table>
				<p align="justify" style="text-indent: 0.5in;">
				Sehubungan dengan permohonan pinjaman Dana Bergulir yang koperasi kami ajukan pada Pemerintah Kota Kediri, dengan ini kami menyatakan bahwa apabila pinjaman tersebut terealisasi akan dimanfaatkan untuk pengembangan usaha sesuai proposal yang diajukan dengan rencana penggunaan sebagai berikut :
				</p>
		<table>	
			<tr>
				<td width="5%">1.</td>
				<td width="35%">Jumlah Pinjaman</td>
				<td width="60%">: ' . number_format($data['peng_nominal'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%">2.</td>
				<td width="35%">Penggunaan</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">a.</td>
				<td width="30%">Untuk Modal Kerja</td>
				<td width="60%">: ' . number_format($data['peng_srt_modal_kerja'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">b.</td>
				<td width="30%">Untuk Investasi</td>
				<td width="60%">: ' . number_format($data['peng_srt_investasi'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%">3.</td>
				<td width="35%">Pengembalian Waktu</td>
				<td width="60%">: ' . number_format($data['peng_srt_modal_kerja'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">a.</td>
				<td width="30%">Bunga 4%</td>
				<td width="60%">: ' . number_format($data['peng_srt_bunga'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%">4.</td>
				<td width="35%">Rencana Pendapatan dan Biaya</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">a.</td>
				<td width="30%">Omset Penjualan Usaha Pokok</td>
				<td width="60%">: ' . number_format($data['peng_srt_omset_penjualan_pokok'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">b.</td>
				<td width="30%">Pendapatan Lain-lain</td>
				<td width="60%">: ' . number_format($data['peng_srt_pendapatan_lain'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">c.</td>
				<td width="30%">Beban –Beban</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="5%">1.</td>
				<td width="25%">Harga Pokok Penjualan (HPP)</td>
				<td width="60%">: ' . number_format($data['peng_srt_harga_pokok_penjualan'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="5%">2.</td>
				<td width="25%">Beban bunga</td>
				<td width="60%">: ' . number_format($data['peng_srt_beban_bunga'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="5%">3.</td>
				<td width="25%">Beban usaha</td>
				<td width="60%">: ' . number_format($data['peng_srt_beban_usaha'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%"></td>
				<td width="5%">4.</td>
				<td width="25%">Beban non usaha</td>
				<td width="60%">: ' . number_format($data['peng_srt_beban_non_usaha'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">d.</td>
				<td width="30%">Laba / Keuntungan usaha</td>
				<td width="60%">: ' . number_format($data['peng_srt_laba'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%">5.</td>
				<td width="35%">Manfaat yang diperoleh</td>
				<td width="60%"></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">a.</td>
				<td width="30%">Meningkatkan penjualan & pendapatan</td>
				<td width="60%">: ' . number_format($data['peng_manf_meningkatkan_penjualan'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">b.</td>
				<td width="30%">Menambahkan permodalan</td>
				<td width="60%">: ' . number_format($data['peng_manf_menambah_modal'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">c.</td>
				<td width="30%">Peningkatan omset</td>
				<td width="60%">: ' . number_format($data['peng_manf_peningkatan_omset'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">d.</td>
				<td width="30%">Peningkatan SHU</td>
				<td width="60%">: ' . number_format($data['peng_manf_peningkatan_shu'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">e.</td>
				<td width="30%">Peningkatan asset</td>
				<td width="60%">: ' . number_format($data['peng_manf_peningkatan_asset'], 2, ',', '.') . '</td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="5%">f.</td>
				<td width="60%">f.	Meningkatkan motivasi dan kepercayaan dalam menjalani usaha</td>
				<td width="30%"></td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
			Apabila pinjaman tersebut tidak dimanfaatkan sebagaimana mestinya, kami bersedia menanggung segala resikonya.<br/>
			Demikian Pernyataan ini dibuat dengan sebenar-benarnya.
		</p>
		</b>
		<table>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>Pengurus Koperasi</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>Koperasi ' . $data['peng_prof_nama_usaha'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>Pengurus</b></td>
						<td width="5%"></td>
						<td width="45%"><b>Pengawas</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>1. ' . $data['peng_ketua'] . '</b></td>
						<td width="5%"></td>
						<td width="45%"><b>1. ' . $data['peng_pengawas_koor'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>2. ' . $data['peng_sekretaris'] . '</b></td>
						<td width="5%"></td>
						<td width="45%"><b>2. ' . $data['peng_pengawas_anggota1'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>3. ' . $data['peng_bendahara'] . '</b></td>
						<td width="5%"></td>
						<td width="45%"><b>3. ' . $data['peng_pengawas_anggota2'] . '</b></td>
					</tr>
				</table>
		';
		return $html;
	}
	public function profil10($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="15%" align="center"><img src="./assets/images/logokoperasi.jpg" alt="Girl in a jacket" height="50"></td>
						<td width="85%" align="center" valign="bottom"><h1>SURAT PERNYATAAN</h1><br/>NOMOR:</td>
					</tr>
				</table>
				<hr/>
				<b>
				
				<table>
					<tr>
						<td width="90%">Yang bertanda tangan dibawah ini pengurus koperasi:</td>
						<td width="10%"></td>
					</tr>
					<tr>
						<td width="20%">Nama Koperasi</td>
						<td width="80%">: ' . $data['peng_prof_nama_usaha'] . '</td>
					</tr>
					<tr>
						<td width="20%">Badan Hukum</td>
						<td width="80%">: ' . $data['peng_badan_hukum_no'] . '</td>
					</tr>
					<tr>
						<td width="20%">Tanggal BH</td>
						<td width="80%">: ' . date('d-m-Y', strtotime($data['peng_badan_hukum_tanggal'])) . '</td>
					</tr>
					<tr>
						<td width="20%">Alamat</td>
						<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
					</tr>
				</table>
				<p align="justify" style="text-indent: 0.5in;">
				Atas kuasa Rapat Anggota, bahwa Sehubungan dengan permohonan pinjaman modal kerja Dana Bergulir Koperasi
				Kepada Pemerintah Kota Kediri sebesar Rp.' . ($data['peng_nominal'] ? number_format($data['peng_nominal'], 2, ",", ".") : '') . ' [' . terbilang($data['peng_nominal']) . ']
				Dengan ini menyatakan :
				</p>

		<table>	
			<tr>
				<td width="5%">1.</td>
				<td width="95%">Menyetujui Asset Koperasi berupa piutang lancar sebagai tambahan jaminan atas pinjaman tersebut.</td>
			</tr>
			<tr>
				<td width="5%">2.</td>
				<td width="95%">Apabila terjadi wan prestasi [piutang macet] setelah jatuh tempo, Pemerintah Kota Kediri atau pemberi pinjaman dapat mengambil alih piutang yang dijaminkan untuk penyelesaian pinjaman sesuai dengan ketentuan yang diatur dalam Fidusia Collateral.</td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
		Demikian pernyataan ini dibuat dengan sebenarnya, sebagai bahan pertimbangan.
		</p>
		</b>
		<table>
					<tr>
						<td width="100%"align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>
					</tr>
					<tr>
						<td width="100%" align="center"><b>Pengurus dan Pengawas Koperasi ' . $data['peng_prof_nama_usaha'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>Pengurus</b></td>
						<td width="5%"></td>
						<td width="45%"><b>Pengawas</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>1. ' . $data['peng_ketua'] . '</b></td>
						<td width="5%"></td>
						<td width="45%"><b>1. ' . $data['peng_pengawas_koor'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>2. ' . $data['peng_sekretaris'] . '</b></td>
						<td width="5%"></td>
						<td width="45%"><b>2. ' . $data['peng_pengawas_anggota1'] . '</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"><b>3. ' . $data['peng_bendahara'] . '</b></td>
						<td width="5%"></td>
						<td width="45%"><b>3. ' . $data['peng_pengawas_anggota2'] . '</b></td>
					</tr>
				</table>
		';
		return $html;
	}
	public function profil11($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="15%" align="center"><img src="./assets/images/logokoperasi.jpg" alt="Girl in a jacket" height="50"></td>
						<td width="85%" align="center" valign="bottom"><h1>BERITA ACARA<br/>RAPAT ANGGOTA KOPERASI ' . $data['peng_prof_nama_usaha'] . '<br/>MEMBAHAS PERKUATAN MODAL KERJA UKM</h1></td>
					</tr>
				</table>
				<hr/>
				<b>
			<table>	
				<tr>
					<td width="5%">1.</td>
					<td width="95%">DASAR RAPAT</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="95%">Surat undangan ketua koperasi No ____________________, tanggal ____________________</td>
				</tr>
				<tr>
					<td width="5%">2.</td>
					<td width="95%">PELAKSANAAN RAPAT</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="20%">Hari / tanggal</td>
					<td width="75%">: ____________________</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="20%">Pukul</td>
					<td width="75%">: ____________________</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="20%">Tempat</td>
					<td width="75%">: ____________________</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="20%">Acara</td>
					<td width="75%">: ____________________</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="20%">Pimpinan rapat</td>
					<td width="75%">: ____________________</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="20%">Peserta rapat</td>
					<td width="75%">: Pengurus, pegawai dan anggota koperasi sejumlah ____________________ orang<br/>[daftar terlampir]</td>
				</tr>
				<tr>
					<td width="5%">3.</td>
					<td width="95%">PELAKSANAAN RAPAT</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="5%">a.</td>
					<td width="95%">Menyetujui pengajuan pinjaman modal usaha dari APBD Kota Kediri</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="5%">b.</td>
					<td width="95%">Menyetujui pengajuan pinjaman sebesar Rp. ' . number_format($data['peng_nominal'], 2, ",", ".") . '</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="5%">c.</td>
					<td width="95%">Menyetujui ____________________</td>
				</tr>
				<tr>
					<td width="5%"></td>
					<td width="5%">d.</td>
					<td width="95%">Memberikan kuasa kepada pengurus koperasi untuk menyelesaikan mekanisme pinjaman.</td>
				</tr>
			</table>
			<p align="justify" style="text-indent: 0.5in;">
				Demikian berita acara rapat anggota membahas rencana pengajuan perkuatan dana bergulir untuk dapat digunakan sebagaimana mestinya.
			</p>
		</b>
		<table>
			<tr>
				<td width="100%"align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>
			</tr>
			<tr>
				<td width="100%" align="center"><b>Pengurus Koperasi ' . strtoupper($data['peng_prof_nama_usaha']) . '</b></td>
			</tr>
			<tr>
				<td width="5%" height="100"></td>
				<td width="45%" align="center"><b>Ketua</b></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>Sekretaris</b></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="45%" align="center"><b>[____________________]</b></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>[____________________]</b></td>
			</tr>
		</table>
		';
		return $html;
	}
	public function profil12($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="15%" align="center"><img src="./assets/images/logokoperasi.jpg" alt="Girl in a jacket" height="50"></td>
						<td width="85%" align="center" valign="bottom"><h1>DAFTAR HADIR RAPAT<br/>ANGGOTA</h1></td>
					</tr>
				</table>
				<hr/>
				<b>
		<table>
			<tr>
				<td width="20%" height="10"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="20%">Nama Koperasi</td>
				<td width="80%">: '.$data['peng_prof_nama_usaha'].'</td>
			</tr>
			<tr>
				<td width="20%">Alamat</td>
				<td width="80%" height="30">: '.$data['peng_prof_alamat'].'</td>
			</tr>
		</table>
		<br/>
		<table border="1">	
			<tr>
				<td width="5%" align="center">NO</td>
				<td width="35%" align="center">NAMA ANGGOTA</td>
				<td width="30%" align="center">ALAMAT</td>
				<td width="30%" align="center">TANDA TANGAN</td>
			</tr>';
		for ($i = 1; $i <= 20; $i++) {
			$html .=	'<tr>
							<td width="5%" align="center">' . $i . '</td>
							<td width="35%"></td>
							<td width="30%"></td>
							<td width="30%"></td>
						</tr>';
		}
		$html .=	'
			<tr>
				<td width="5%"></td>
				<td width="35%" align="center">JUMLAH ANGGOTA</td>
				<td width="30%"></td>
				<td width="30%"></td>
			</tr>
		</table>
		</b>
		<br/>
		<table>
			<tr>
				<td width="100%"align="center"><b>Kediri, ' . date('d-m-Y', strtotime($data['peng_tanggal'])) . '</b></td>
			</tr>
			<tr>
				<td width="100%" height="30" align="center"><b>Pengurus Koperasi</b></td>
			</tr>
			<tr>
				<td width="5%" height="100"></td>
				<td width="45%" align="center"><b>Ketua</b></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>Sekretaris</b></td>
			</tr>
			<tr>
				<td width="5%"></td>
				<td width="45%" align="center"><b>['.$data['peng_ketua'].']</b></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>['.$data['peng_sekretaris'].']</b></td>
			</tr>
		</table>
		';
		return $html;
	}
	public function profil($id)
	{
		$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
		setlocale(LC_TIME, 'id_ID');
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('DINKOP');
		$pdf->SetTitle('Profil');
		$pdf->SetSubject('Profil');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetMargins(20, 10, 10);
		$pdf->SetAutoPageBreak(TRUE, 5);

		$pdf->SetFont('times', '', 12, '', 'false');

		$pdf->addPage();
		$pdf->writeHTML($this->profil1($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil2($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil3($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil4($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil5($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil6_($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil6($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil7($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil8($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil8_($id), true, false, true, false, '');
		// $pdf->SetFont('times', '', 11, '', 'false');
		$pdf->addPage();
		$pdf->writeHTML($this->profil9($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil10($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil11($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil12($id), true, false, true, false, '');

		//Close and output PDF document
		$pdf->Output();
		die();
	}
}
