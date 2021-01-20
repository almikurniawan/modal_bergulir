<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use TCPDF;

class CetakSPPK extends BaseController
{
    public function index($peng_id)
    {
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        setlocale(LC_TIME, 'id_ID');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('DINKOP');
        $pdf->SetTitle('Profil');
        $pdf->SetSubject('Profil');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 5);

        $pdf->SetFont('times', '', 12, '', 'false');

        $pdf->addPage();
        $pdf->writeHTML($this->html_jadwal($peng_id), true, false, true, false, '');

        $pdf->Output();
        die();
    }

    public function html_jadwal($peng_id)
    {

        $pengajuan = $this->db->query("SELECT
                                        peng_prof_nama_usaha as nama,
                                        peng_prof_alamat as alamat,
                                        peng_disetujui_nominal as nominal,
                                        peng_disetujui_jangka_waktu_bln as jangka_waktu,
                                        peng_disetujui_jangka_waktu_text as jangka_waktu_text,
                                        kar_nama as ttd,
                                        *
                                    FROM
                                        pengajuan
                                        left join karyawan on kar_id = peng_kepala_dinas_ttd
                                    WHERE
                                        peng_id = " . $peng_id)->getRowArray();
        $SQL_UNION = "select 
        peng_id,
        peng_id as id,
        'pengajuan' AS TYPE,
        ref_jaminan_label AS jenis,
        peng_jam_pemegang_ktp_no AS no_ktp,
        peng_jam_pekerjaan AS pekerjaan,
            case
                when peng_jam_jenis = 1 then 
                    CASE
                            WHEN peng_jam_jenis_bpkb = 1 THEN
                            'Pribadi' ELSE 'Orang Lain' 
                    END
                when peng_jam_jenis = 2 then 
                    CASE
                            WHEN peng_jam_jenis_tanah = 1 THEN
                            'Pribadi' ELSE 'Orang Lain' 
                    END
                when peng_jam_jenis = 3 then 
                    CASE
                            WHEN peng_jam_jenis_emas = 1 THEN
                            'Pribadi' ELSE 'Orang Lain' 
                    END
            end AS kepemilikan,
        case when peng_jam_jenis = 1 then 
            '<tr><td width=\"20%\"><b>Tahun Pembuatan</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_tahun_pembuatan,0)||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Polisi</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_nopol,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Mesin</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_mesin,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Rangka</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_rangka,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Atas Nama</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_atas_nama,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Alamat</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_alamat,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. BPKB</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_no_bpkb,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Type BPKB</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_type_bpkb,'')||'</td></tr>'
        when peng_jam_jenis = 2 then 
            '<tr><td width=\"20%\"><b>No. Akta</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_no_akta,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Tempat</b></td><td width=\"80%\"> :  '||coalesce(peng_jam_tempat,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Atas Nama</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_atas_nama_tanah,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Alamat</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_alamat_tanah,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>SU. Tanggal</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_su_tanggal::text,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Surat Ukur</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_nomor_surat_ukur,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Luas Tanah</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_luas_tanah,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Harga Perkiraan</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_harga_perkiraan,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Total Harga Perkiraan</b></td><td width=\"80%\"> :  '||COALESCE(peng_jam_harga_perkiraan_total,'')||'</td></tr>'
        else
            '<tr><td width=\"20%\"><b>Karat</b></td><td width=\"80%\"> : '||COALESCE(peng_jam_emas_karat,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Gram</b></td><td width=\"80%\"> : '||COALESCE(peng_jam_emas_gram,'')||'</td></tr>'
        end as detail_jaminan
        
        from pengajuan
        left join ref_jaminan ON ref_jaminan.ref_jaminan_id = peng_jam_jenis ";
        $SQL = "SELECT
        jam_peng_id as peng_id,
        jam_id as id,
        'jaminan' AS TYPE,
        ref_jaminan_label AS jenis,
        jam_pemegang_ktp_no AS no_ktp,
        jam_pekerjaan AS pekerjaan,
        CASE
            
            WHEN jam_jenis_kepemilikan = 1 THEN
            'Pribadi' ELSE'Orang Lain' 
        END AS kepemilikan,
        case when jam_jenis = 1 then 
            '<tr><td width=\"20%\"><b>Tahun Pembuatan</b></td><td width=\"80%\"> :  '||coalesce(jam_tahun_pembuatan,0)||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Polisi</b></td><td width=\"80%\"> :  '||coalesce(jam_nopol,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Mesin</b></td><td width=\"80%\"> :  '||coalesce(jam_mesin,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Rangka</b></td><td width=\"80%\"> :  '||coalesce(jam_rangka,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Atas Nama</b></td><td width=\"80%\"> :  '||coalesce(jam_atas_nama,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Alamat</b></td><td width=\"80%\"> :  '||coalesce(jam_alamat,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. BPKB</b></td><td width=\"80%\"> :  '||coalesce(jam_no_bpkb,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Type BPKB</b></td><td width=\"80%\"> :  '||coalesce(jam_type_bpkb,'')||'</td></tr>'
        when jam_jenis = 2 then 
            '<tr><td width=\"20%\"><b>No. Akta</b></td><td width=\"80%\"> :  '||coalesce(jam_no_akta,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Tempat</b></td><td width=\"80%\"> :  '||coalesce(jam_tempat,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Atas Nama</b></td><td width=\"80%\"> :  '||COALESCE(jam_atas_nama_tanah,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Alamat</b></td><td width=\"80%\"> :  '||COALESCE(jam_alamat_tanah,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>SU. Tanggal</b></td><td width=\"80%\"> :  '||COALESCE(jam_su_tanggal::text,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>No. Surat Ukur</b></td><td width=\"80%\"> :  '||COALESCE(jam_nomor_surat_ukur,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Luas Tanah</b></td><td width=\"80%\"> :  '||COALESCE(jam_luas_tanah,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Harga Perkiraan</b></td><td width=\"80%\"> :  '||COALESCE(jam_harga_perkiraan,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Total Harga Perkiraan</b></td><td width=\"80%\"> :  '||COALESCE(jam_harga_perkiraan_total,'')||'</td></tr>'
        else
            '<tr><td width=\"20%\"><b>Karat</b></td><td width=\"80%\"> : '||COALESCE(jam_emas_karat,'')||'</td></tr>'||
            '<tr><td width=\"20%\"><b>Gram</b></td><td width=\"80%\"> : '||COALESCE(jam_emas_gram,'')||'</td></tr>'
        end as detail_jaminan
        
    FROM
        pengajuan_jaminan
        LEFT JOIN ref_jaminan ON ref_jaminan.ref_jaminan_id = jam_jenis";
        if ($pengajuan['peng_jam_jenis'] != '') {
            $SQL .= " UNION " . $SQL_UNION;
        }
        $SQL .= " where peng_id=" . $peng_id;
        $jaminan = $this->db->query($SQL)->getResultArray();
        // if($pengajuan['peng_jam_jenis']==1){
        //     $jaminan = '<table style="border-collapse: collapse; width: 100%; height: 144px;">
        //     <tbody>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">1</td>
        //     <td style="width: 35.3857%; height: 18px;">BPKB No</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_no_bpkb'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Type</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_type_bpkb'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">No. Rangka</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_rangka'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">No. Mesin</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_mesin'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Warna/Th.Pemb</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_tahun_pembuatan'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">No.Polisi</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_nopol'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Pemegang Hak</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.($pengajuan['peng_jam_jenis_bpkb']==1 ? 'Pribadi' : 'Orang Lain').'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Alamat</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">&nbsp;</td>
        //     </tr>
        //     </tbody>
        //     </table>';
        // }else{
        //     $jaminan = '<table style="border-collapse: collapse; width: 100%; height: 144px;">
        //     <tbody>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">1</td>
        //     <td style="width: 35.3857%; height: 18px;">SHM No.</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_no_akta'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">An.SHM</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_atas_nama'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">SU Tgl</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.date('d-m-Y',strtotime($pengajuan['peng_jam_su_tanggal'])).'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">No. Surat Ukur</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_nomor_surat_ukur'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Luas</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_luas_tanah'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Lokasi</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">'.$pengajuan['peng_jam_tempat'].'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Harga Perkiraan</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">Rp. '.number_format($pengajuan['peng_jam_harga_perkiraan'], 2, ',', '.').'</td>
        //     </tr>
        //     <tr style="height: 18px;">
        //     <td style="width: 5.71217%; height: 18px;">&nbsp;</td>
        //     <td style="width: 35.3857%; height: 18px;">Total Harga Perkiraan</td>
        //     <td style="width: 3.56079%; height: 18px;">:</td>
        //     <td style="width: 55.3412%; height: 18px;">( Rp. '.number_format($pengajuan['peng_jam_harga_perkiraan_total'], 2, ',', '.').')</td>
        //     </tr>
        //     </tbody>
        //     </table>';
        // }

        $html = '<table style="border-collapse: collapse; width: 100%; height: 108px;">
        <tbody>
        <tr>
        <td style="width: 15.1072%;" rowspan="5"><img src="./assets/images/logo.svg" alt="Girl in a jacket" width="80" /></td>
        <td style="width: 84.8928%; text-align: center; font-size: 16px;">PEMERINTAH KOTA KEDIRI</td>
        </tr>
        <tr>
        <td style="width: 84.8928%; text-align: center; font-size: 16px;">DINAS KOPERASI, USAHA MIKRO DAN TENAGA KERJA</td>
        </tr>
        <tr>
        <td style="width: 84.8928%; text-align: center;">JL.Brigjend. Pol. Imam Bachri No. 100-c Telp/Fax (0354) 688107</td>
        </tr>
        <tr>
        <td style="width: 84.8928%; text-align: center;">Kode Pos : 64131 e-mail : dinaskop_kdr@yahoo.com</td>
        </tr>
        <tr>
        <td style="width: 84.8928%; text-align: center; font-size: 14px;">KOTA KEDIRI</td>
        </tr>
        </tbody>
        </table>
        <hr />
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 59.7466%;">&nbsp;</td>
        <td style="width: 40.2534%;">Kediri, ' . date('d F Y') . '</td>
        </tr>
        <tr>
        <td style="width: 59.7466%;">&nbsp;</td>
        <td style="width: 40.2534%;">Kepada Yth.</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 20%;">Nomor</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 37.6476%;">' . $pengajuan['peng_disetujui_no_penetapan'] . '</td>
        <td style="width: 32.294%;">' . $pengajuan['nama'] . '</td>
        </tr>
        <tr>
        <td style="width: 20%;">Sifat</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 37.6476%;">Segera</td>
        <td style="width: 32.294%;">' . $pengajuan['alamat'] . '</td>
        </tr>
        <tr>
        <td style="width: 20%;">Lamp</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 37.6476%;">-</td>
        <td style="width: 32.294%; text-align: center;"><span style="text-decoration: underline;"><strong>KEDIRI</strong></span></td>
        </tr>
        <tr>
        <td style="width: 20%;">Perihal</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 37.6476%;">Surat Pemberitahuan Persetujuan Kredit (SPPK)</td>
        <td style="width: 32.294%; text-align: center;">&nbsp;</td>
        </tr>
        </tbody>
        </table>
        <br/><br/>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 100%;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Menindaklanjuti hasil verifikasi lapangan oleh Tim Teknis Dinas dan Bank Pelaksana,dengan ini diberitahukan bahwa permohonan kredit program induk investasi Pemerintah Kota Kediri tahun 2019 dapat disetujui dengan ketentuan sebagai berikut :</td>
        </tr>
        </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
        <tbody>
        <tr>
        <td style="width: 4.83871%;">1.</td>
        <td style="width: 24.3952%;">Plafon Kredit</td>
        <td style="width: 2.01613%;">:</td>
        <td style="width: 68.75%;">Rp. ' . number_format($pengajuan['nominal'], 2, ",", ".") . '</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">2.</td>
        <td style="width: 24.3952%;">Jangka Waktu</td>
        <td style="width: 2.01613%;">:</td>
        <td style="width: 68.75%;">' . $pengajuan['jangka_waktu'] . ' ' . $pengajuan['jangka_waktu_text'] . '</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">3.</td>
        <td style="width: 24.3952%;">Cara Pembayaran</td>
        <td style="width: 2.01613%;">:</td>
        <td style="width: 68.75%;">Sesuai jadwal yang ditetapkan oleh Bank</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">4.</td>
        <td style="width: 24.3952%;">Suku bunga</td>
        <td style="width: 2.01613%;">:</td>
        <td style="width: 68.75%;">' . $pengajuan['peng_srt_bunga'] . '% ( ' . str_replace("rupiah", "", terbilang($pengajuan['peng_srt_bunga'])) . ' persen ) pertahun &nbsp;dibayar di depan</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">5.</td>
        <td style="width: 24.3952%;">Bentuk Kredit</td>
        <td style="width: 2.01613%;">:</td>
        <td style="width: 68.75%;">Modal Kerja</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">6.</td>
        <td style="width: 24.3952%;">Agunan Kredit</td>
        <td style="width: 2.01613%;">:</td>
        <td style="width: 68.75%;">
        ';
        $html .= '<table>';
        foreach ($jaminan as $key => $value) {
            $html .= '
			<tr>
				<td width="50%"><b>' . $value['jenis'] . '</b></td>
				<td width="50%"></td>
			</tr>
			' . $value['detail_jaminan'];
        }
        $html .= '</table>';
        $html = '</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">7.</td>
        <td style="width: 95%;" colspan="3">Membuka rekening tabungan pada PD. Bank Perkreditan Rakyat, Kota Kediri</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">8.</td>
        <td style="width: 95%;" colspan="3">Menyerahkan surat kuasa kepada PD. Bank Perkreditan Rakyat, Kota Kediri untuk memindahbukukan / mendebet dana dari rekening tabungan sebagai angsuran kredit sampai dengan lunas;</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">9.</td>
        <td style="width: 95%;">Pencairan Kredit dapat melalui dapat dilaksanakan apabila debitur dengan PD. Bank Perkreditan Rakyat, Kota telah menandatangani surat perjanjian kredit dan surat kuasa pendebetan rekening tabungan;</td>
        </tr>
        <tr>
        <td style="width: 4.83871%;">10.</td>
        <td style="width: 95%;">Pencairan kredit melalui PD.Bank Perkreditan Rakyat, Kota Kediri;<br/>Demikian Surat Persetujuan Pemberitahuan Kredit ini dibuat untuk dilaksanakan, dan apabila dalam batas waktu sampai dengan tanggal 13 JUNI 2019 belum dapat dilaksanakan,maka dinyatakan batal dengan sendirinya.</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 4.83871%;">&nbsp;</td>
        <td style="width: 95.1613%;">Demikian,atas perhatian serta kerjasamanya disampaikan terima kasih.</td>
        </tr>
        </tbody>
        </table>
        <br/>
        <table style="border-collapse: collapse; width: 100%; height: 169px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">Penerima</td>
        <td style="width: 50%; height: 18px; text-align: center;">KEPALA DINAS KOPERASI USAHA MIKRO</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">&nbsp;</td>
        <td style="width: 50%; height: 18px; text-align: center;">DAN TENAGA KERJA</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">&nbsp;</td>
        <td style="width: 50%; height: 18px; text-align: center;">KOTA KEDIRI</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 40px;">&nbsp;</td>
        <td style="width: 50%; height: 40px;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">' . $pengajuan['peng_prof_pimpinan'] . '</td>
        <td style="width: 50%; height: 18px; text-align: center;"><span style="text-decoration: underline;"><strong>' . $pengajuan['ttd'] . '</strong></span></td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">&nbsp;</td>
        <td style="width: 50%; height: 18px; text-align: center;">' . $pengajuan['kar_pangkat'] . '</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">&nbsp;</td>
        <td style="width: 50%; height: 18px; text-align: center;">' . $pengajuan['kar_nip'] . '</td>
        </tr>
        </tbody>
        </table>
       ';

        return $html;
    }
}
