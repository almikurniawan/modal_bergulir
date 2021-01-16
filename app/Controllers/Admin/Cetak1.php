<?php

namespace App\Controllers\Admin;

use TCPDF;
use App\Controllers\BaseController;

class Cetak1 extends BaseController
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
				<td height="20" width="30%">NAMA USAHA MIKRO</td>
				<td height="20" width="70%">: ' . ($data['peng_prof_nama_usaha'] ? strtoupper($data['peng_prof_nama_usaha']) : '') . '</td>
			</tr>
			<tr>
				<td height="20" width="30%">NAMA PEMILIK USAHA</td>
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
						<td width="25%">NAMA USAHA</td>
						<td width="75%">: ' . ($data['peng_prof_nama_usaha'] ? strtoupper($data['peng_prof_nama_usaha']) : '') . '</td>
					</tr>
					<tr>
						<td width="25%">ALAMAT</td>
						<td width="75%">: ' . ($data['peng_prof_alamat'] ? strtoupper($data['peng_prof_alamat']) : '') . '</td>
					</tr>
					<tr>
						<td width="25%">NO TELP/HP</td>
						<td width="75%">: ' . ($data['peng_no_telp'] ? strtoupper($data['peng_no_telp']) : '') . '/' . ($data['peng_no_hp'] ? strtoupper($data['peng_no_hp']) : '') . '</td>
					</tr>
					<tr>
						<td width="25%">KELURAHAN</td>
						<td width="75%">: ' . ($data['peng_prof_alamat'] ? strtoupper($data['peng_prof_alamat']) : '') . '</td>
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
					<tr>
						<td width="10%">Nomor</td>
						<td width="45%">: _ _ _ _ _  _</td>
						<td width="5%"> </td>
						<td width="40%">Kediri, </td>
					</tr>
					<tr>
						<td width="10%">Lamp</td>
						<td width="45%">: 2 (dua) berkas Permohonan</td>
						<td width="5%"> </td>
						<td width="40%">Kepada</td>
					</tr>
					<tr>
						<td width="10%">Hal</td>
						<td width="40%">: Permohonan Pinjaman Dana Bergulir Yth. Kepala Dinas Koperasi, UMTK
						Program Pemberdayaan Usaha Mikro
						Kota Kediri
					  </td>
						<td width="10%"> </td>
						<td width="40%">Yth. Kepala Dinas Koperasi, UMTK Kota Kediri</td>
					</tr>
				</table>
		';

		$foto_suami = '';
		$ext = strtolower(pathinfo('/uploads/'.$data['peng_foto_suami'], PATHINFO_EXTENSION));
		if(in_array($ext, ['png','jpg','jpeg'])){
			$foto_suami = $data['peng_foto_suami'];
		}
		$foto_istri = '';
		$ext = strtolower(pathinfo('/uploads/'.$data['peng_foto_istri'], PATHINFO_EXTENSION));
		if(in_array($ext, ['png','jpg','jpeg'])){
			$foto_istri = $data['peng_foto_istri'];
		}

		$html .= '<p align="justify" style="text-indent: 0.5in;">
		Dengan hormat, dalam upaya pengembangan dan peningkatan usaha dalam bidang <b>' . ($data['peng_bidang_usaha'] ? $data['peng_bidang_usaha'] : '') . '</b>, maka bersama ini kami mengajukan permohonan dukungan tambahan sarana usaha /modal kerja sebesar Rp <b>' . ($data['peng_nominal'] ? number_format($data['peng_nominal'], 2, ",", ".") : '') . '</b> [' . terbilang($data['peng_nominal']) . ']
		Tujuan penggunaan dana tersebut untuk <b>' . ($data['peng_tujuan_penggunaan'] ? $data['peng_tujuan_penggunaan'] : '') . '</b>. 
		Untuk melengkapi permohonan tersebut, kami sertakan lampiran sebagai berikut;<br/>
		1.	Profil usaha Usaha Mikro;<br/>
		2.	Pas foto suami istri berwarna 4x6 @ 2 lembar;<br/>
		3.	Foto copy KTP suami istri yang masih berlaku;<br/>
		4.	Foto copy Kartu Keluarga;<br/>
		5.	Foto copy Surat Nikah;<br/>
		6.	Foto copy legalitas jaminan.
		</p>
		<p align="justify" style="text-indent: 0.5in;">
		Sehubungan dengan hal tersebut untuk dapatnya kami mendapatkan persetujuan sebagai peserta program perkuatan modal kerja bergulir.
		</p>
		<p align="justify" style="text-indent: 0.5in;">
		Demikian atas perkenannya disampaikan terimakasih.
		</p>
		<table>
			<tr>
				<td width="10%"></td>
				<td width="45%"></td>
				<td width="5%"></td>
				<td width="45%">UM.</td>
			</tr>
			<tr>
				<td width="30%"><img src="' . base_url('/uploads') . '/' . $foto_suami . '" width="200"></td>
				<td width="25%"><img src="' . base_url('/uploads') . '/' . $foto_istri . '" width="200"></td>
				<td width="5%"></td>
				<td width="45%" height="100" align="center"><b>Pemilik Usaha</b></td>
			</tr>
			<tr>
				<td width="10%"></td>
				<td width="45%"></td>
				<td width="5%"></td>
				<td width="45%" align="center"><b>[' . ($data['peng_prof_pimpinan'] ? $data['peng_prof_pimpinan'] : '') . ']</b></td>
			</tr>
		</table>';
		return $html;
	}

	public function profil3($id)
	{
		$data = $this->db->table('pengajuan')->select('*')->join('ref_bidang_usaha', 'ref_bidang_id=peng_prof_jenis_usaha')->getWhere(['peng_id' => $id])->getRowArray();

		$html = '
				<table>
					<tr>
						<td width="100%" align="center"><h1>PROFIL USAHA MIKRO</h1></td>
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
					<tr>
						<td width="5%">1.</td>
						<td width="45%">IDENTITAS PERUSAHAAN</td>
						<td width="5%"></td>
						<td width="40%"></td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">1.</td>
						<td width="30%">Nama Usaha Mikro</td>
						<td width="40%">: ' . ($data['peng_prof_nama_usaha'] ? $data['peng_prof_nama_usaha'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">2.</td>
						<td width="30%">Alamat</td>
						<td width="40%">: ' . ($data['peng_prof_alamat'] ? $data['peng_prof_alamat'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">3.</td>
						<td width="30%">Pimpinan/pemilik</td>
						<td width="40%">: ' . ($data['peng_prof_pimpinan'] ? $data['peng_prof_pimpinan'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">4.</td>
						<td width="30%">Perizinan yang dimiliki (SK dari kelurahan)</td>
						<td width="40%">: ' . ($data['peng_prof_perizinan'] ? $data['peng_prof_perizinan'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">5.</td>
						<td width="30%">Jumlah Karyawan</td>
						<td width="40%">: ' . ($data['peng_prof_jumlah_karyawan'] ? $data['peng_prof_jumlah_karyawan'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">6.</td>
						<td width="30%">Tahun Mulai Usaha</td>
						<td width="40%">: ' . ($data['peng_prof_tahun_mulai'] ? $data['peng_prof_tahun_mulai'] : '') . '</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
					<tr>
						<td width="5%">2.</td>
						<td width="45%">USAHA YANG DIKELOLA</td>
						<td width="5%"></td>
						<td width="40%"></td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">1.</td>
						<td width="30%">Jenis usaha</td>
						<td width="40%">: ' . ($data['ref_bidang_label'] ? $data['ref_bidang_label'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">2.</td>
						<td width="30%">Komoditi produk</td>
						<td width="40%">: ' . ($data['peng_prof_komoditi_produk'] ? $data['peng_prof_komoditi_produk'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">3.</td>
						<td width="30%">Omset per bulan</td>
						<td width="40%">: Rp. ' . ($data['peng_prof_omset_per_bulan'] ? number_format($data['peng_prof_omset_per_bulan'], 2, ",", ".") : '-') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">4.</td>
						<td width="30%">Lokasi pemasaran</td>
						<td width="40%">: ' . ($data['peng_prof_lokasi_pemasaran'] ? $data['peng_prof_lokasi_pemasaran'] : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">5.</td>
						<td width="30%">Pola pemasaran</td>
						<td width="40%">: ' . ($data['peng_prof_pola_pemasaran'] ? $data['peng_prof_pola_pemasaran'] : '') . '</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
					<tr>
						<td width="5%">3.</td>
						<td width="45%">KINERJA PERUSAHAAN</td>
						<td width="5%"></td>
						<td width="40%"></td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">1.</td>
						<td width="30%">Pendapatan / penjualan</td>
						<td width="40%">: Rp. ' . ($data['peng_prof_pendapatan_penjualan'] ? number_format($data['peng_prof_pendapatan_penjualan'], 2, ",", ".") : '-') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">2.</td>
						<td width="30%">Beban penjualan</td>
						<td width="40%">: Rp. ' . ($data['peng_prof_beban_penjualan'] ? number_format($data['peng_prof_beban_penjualan'], 2, ",", ".") : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">3.</td>
						<td width="30%">Laba per bulan</td>
						<td width="40%">: Rp. ' . ($data['peng_prof_laba_per_bulan'] ? number_format($data['peng_prof_laba_per_bulan'], 2, ",", ".") : '') . '</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
					<tr>
						<td width="5%">4.</td>
						<td width="45%">PERMODALAN</td>
						<td width="5%"></td>
						<td width="40%"></td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">1.</td>
						<td width="30%">Modal sendiri</td>
						<td width="40%">: Rp. ' . ($data['peng_prof_modal_sendiri'] ? number_format($data['peng_prof_modal_sendiri'], 2, ",", ".") : '') . '</td>
					</tr>
					<tr>
						<td width="5%"></td>
						<td width="5%">2.</td>
						<td width="30%">Modal luar</td>
						<td width="40%">: Rp. ' . ($data['peng_prof_modal_luar'] ? number_format($data['peng_prof_modal_luar'], 2, ",", ".") : '') . '</td>
					</tr>
				</table>
				<table>
					<tr>
						<td height="30" width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%"></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%">UM.</td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" height="100" align="center"><b>Pemilik Usaha</b></td>
					</tr>
					<tr>
						<td width="10%"></td>
						<td width="45%"></td>
						<td width="5%"></td>
						<td width="45%" align="center"><b>[' . ($data['peng_prof_pimpinan'] ? $data['peng_prof_pimpinan'] : '') . ']</b></td>
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
						<td width="100%" align="center"><h1>DILAKUKAN UJI KELAYAKAN USAHA</h1></td>
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
				<td width="20%">Alamat</td>
				<td width="80%">: ' . $data['peng_prof_alamat'] . '</td>
			</tr>
			<tr>
				<td width="20%">Pemegang KTP No</td>
				<td width="80%">: ' . $data['peng_uji_kel_no_ktp'] . '</td>
			</tr>
			<tr>
				<td width="20%">Pekerjaan</td>
				<td width="80%">: ' . $data['peng_uji_kel_pekerjaan'] . '</td>
			</tr>
		</table>
		<p align="justify" style="text-indent: 0.5in;">
		Berdasarkan permohonan pinjaman Dana Bergulir Pemerintah Kota Kediri, dengan ini kami menyatakan bersedia dilakukan uji kelayakan usaha kami sebagaimana ketentuan dalam prosedur penyaluran Dana bergulir dimaksud.
		</p>
		<p align="justify">
		Demikian pernyataan ini kami buat, selanjutnya dapat digunakan sebagaimana mestinya.
		</p>
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
						<td width="45%" height="100" align="center"><b>Pemilik Usaha</b></td>
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
		$data = $this->db->query("select * from pengajuan left join ref_kecamatan on peng_sk_kecamatan = ref_kec_id where peng_id=" . $id)->getRowArray();

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
				<td width="80%">: ' . $data['ref_kec_label'] . '</td>
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
				<td width="60%">: ' . $data['peng_sk_tanah_kecamatan'] . 'sesuai dengan</td>
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
				<td width="89%">Kami nilai transaksi harga tanah tersebut sesuai dengan harga umum yang berlaku saat ini</td>
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
				<td width="30%">Harga bangunan [M2]	</td>
				<td width="60%">: Rp. ' . number_format($data['peng_sk_tanah_harga_bangunan'], 2, ",", ".") . '</td>
			</tr>

			<tr>
				<td width="10%"></td>
				<td width="80%"></td>
				<td width="80%"></td>
			</tr>
			<tr>
				<td width="10%">04</td>
				<td width="89%">Letak tanah dengan batas-batas sebagai berikut :</td>
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
		$data = $this->db->table('pengajuan')->select('*')->join('pengajuan_foto', 'peng_foto_peng_id = peng_id')->getWhere(['peng_foto_jenis' => 2, 'peng_id' => $id])->getResultArray();
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
			$ext = strtolower(pathinfo('/uploads/foto_kegiatan/'.$value['peng_foto_file'], PATHINFO_EXTENSION));
			if(in_array($ext, ['png','jpg','jpeg'])){
				$html .= '
							<tr>
								<td width="100%" align="center"><img src="./uploads/foto_kegiatan/' . $value['peng_foto_file'] . '" height="150"></td>
							</tr>';
			}
		}
		$html .= '
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

		$pdf->SetMargins(20, 20, 10);
		$pdf->SetAutoPageBreak(TRUE, 10);

		$pdf->SetFont('times', '', 12, '', 'false');

		$pdf->addPage();
		$pdf->writeHTML($this->profil1($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil2($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil3($id), true, false, true, false, '');

		$pdf->addPage();
		$pdf->writeHTML($this->profil4($id), true, false, true, false, '');

		// $pdf->addPage();
		// $pdf->writeHTML($this->profil5($id), true, false, true, false, '');

		// $pdf->addPage();
		// $pdf->writeHTML($this->profil8($id), true, false, true, false, '');

		// $pdf->addPage();
		// $pdf->writeHTML($this->profil8_($id), true, false, true, false, '');

		// $pdf->lastPage();
		//Close and output PDF document
		$pdf->Output();
		die();
	}
}
