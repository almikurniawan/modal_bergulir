<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use TCPDF;

class CetakBI extends BaseController
{
    public function index($survey_id)
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
        $pdf->writeHTML($this->html_jadwal($survey_id), true, false, true, false, '');

        $pdf->Output();
        die();
    }

    public function html_jadwal($survey_id)
    {
        $survey_jadwal = $this->db->query("SELECT
        *,
        kepala.kar_nama as nama_kepala,
        kepala.kar_nip as nip_kepala,
        kepala.kar_jabatan as jabatan_kepala,
        ketua.kar_nama as nama_ketua,
        ketua.kar_nip as nip_ketua,
        ketua.kar_jabatan as jabatan_ketua
    FROM
        survey s
        left join karyawan kepala on kepala.kar_id=s.survey_kepala_dinas_ttd
        left join karyawan ketua on ketua.kar_id=s.survey_ketua_teknis_ttd
        where survey_id=" . $survey_id)->getRowArray();
        // dd($survey_jadwal);
        $pengajuan = $this->db->query("SELECT
                                            peng_prof_nama_usaha,
                                            peng_prof_alamat,
                                            peng_nominal
                                        FROM
                                            survey
                                            left join survey_hasil on survey_hasil_survey_id = survey_id
                                            left join pengajuan on peng_id = survey_hasil_peng_id
                                            where survey_hasil_approve_is is true and survey_id=" . $survey_id)->getResultArray();

        $table_pengajuan = '';
        $nomor = 1;
        $total = 0;
        foreach ($pengajuan as $key => $value) {
            $table_pengajuan .= '<tr>
            <td style="width: 12.3684%;">' . $nomor . '</td>
            <td style="width: 37.6316%;">' . $value['peng_prof_nama_usaha'] . '</td>
            <td style="width: 25%;">' . $value['peng_prof_alamat'] . '</td>
            <td style="width: 25%; text-align:right;">' . number_format($value['peng_nominal'], 2, ",", ".") . '</td>
            </tr>';
            $nomor++;
            $total += $value['peng_nominal'];
        }
        $table_pengajuan .= '<tr>
            <td style="width: 12.3684%;"></td>
            <td style="width: 37.6316%;"><strong>JUMLAH</strong></td>
            <td style="width: 25%;"><strong>' . terbilang($total) . '</strong></td>
            <td style="width: 25%; text-align:right;"><strong>' . number_format($total, 2, ",", ".") . '</strong></td>
            </tr>';

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
        <td style="width: 40.2534%;">Kepada</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 20%;">Nomor</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 38.0507%;">' . $survey_jadwal['survey_nomor_lengkap'] . '</td>
        <td style="width: 8.10916%;">Yth.</td>
        <td style="width: 31.8909%;">Sdr. Direktur Utama PD. Bank</td>
        </tr>
        <tr>
        <td style="width: 20%;">Sifat</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 38.0507%;">Segera</td>
        <td style="width: 8.10916%;">&nbsp;</td>
        <td style="width: 31.8909%;">Perkreditan Rakyat Kota Kediri</td>
        </tr>
        <tr>
        <td style="width: 20%;">Lamp</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 38.0507%;">1 (Satu) bendel</td>
        <td style="width: 8.10916%;">&nbsp;</td>
        <td style="width: 31.8909%;">di</td>
        </tr>
        <tr>
        <td style="width: 20%;">Perihal</td>
        <td style="width: 1.94932%;">:</td>
        <td style="width: 38.0507%;"><strong>Bantuan Penelitian Administrasi dan Idep Peserta Program Penyertaan Modal Pengelolaan Dana Bergulir Pemerintah Kota Kediri.</strong></td>
        <td style="width: 8.10916%;">&nbsp;</td>
        <td style="width: 31.8909%; text-align: center;"><span style="text-decoration: underline;"><strong>KEDIRI</strong></span></td>
        </tr>
        </tbody>
        </table>
        <BR/>
        <BR/>
        <table style="border-collapse: collapse; width: 96.6862%; height: 18px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 19.7856%; height: 18px;">&nbsp;</td>
        <td style="width: 80.2144%; height: 18px; text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp;Menindaklanjuti surat permohonan pinjaman Program Penyertaan Modal Pengelolaan Dana Bergulir Pemerintah Kota Kediri dari Usaha Mikro perorangan sebagaimana proposal terlampir, maka bersama ini kami sampaikan daftar calon peserta program sebagai berikut:</td>
        </tr>
        <tr>
        <td style="width: 19.7856%;">&nbsp;</td>
        <td style="width: 80.2144%;"><br /><br />
        <table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>
        <tr>
        <td style="width: 12.3684%;"><strong>No</strong></td>
        <td style="width: 37.6316%;"><strong>Nama UMKM / Penanggung Jawab</strong></td>
        <td style="width: 25%;"><strong>Alamat / No. Tlp</strong></td>
        <td style="width: 25%;"><strong>Pengajuan (Rp)</strong></td>
        </tr>
        ' . $table_pengajuan . '
        </tbody>
        </table>
        <br/>
        </td>
        </tr>
        <tr>
        <td style="width: 19.7856%;">&nbsp;</td>
        <td style="width: 80.2144%; text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp;Terkait dengan hal tersebut mohon kiranya dapat dilaksanakan pengecekan administrasi pengajuan dana bergulir dan Idep terhadap calon tersebut di atas, sangat kami harapkan konfirmasi hasil Idep tersebut dapat segera kami terima yang akan digunakan sebagai salah satu bahan penetapan peserta program Penyertaan Modal Pengelolaan Dana Bergulir Pemerintah Kota Kediri.<BR/></td>
        </tr>
        <tr>
        <td style="width: 19.7856%;">&nbsp;</td>
        <td style="width: 80.2144%; text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Demikian atas kerjasama dan pelaksanaannya kami sampaikan terimakasih.</td>
        </tr>
        </tbody>
        </table>
        <p>&nbsp;</p>
        <table style="border-collapse: collapse; width: 100%; height: 54px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 18.75%; height: 18px;">&nbsp;</td>
        <td style="width: 81.25%; height: 18px; text-align: center;"><strong>TIM TEKNIS DINAS</strong></td>
        </tr>
        <tr style="height: 18px; text-align: center;">
        <td style="width: 18.75%; height: 18px;">&nbsp;</td>
        <td style="width: 81.25%; height: 18px;"><strong>PROGRAM PENYERTAAN MODAL PENGELOLAAN </strong></td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 18.75%; height: 18px; text-align: center;">&nbsp;</td>
        <td style="width: 81.25%; height: 18px; text-align: center;"><strong>DANA BERGULIR KOTA KEDIRI</strong></td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%; height: 169px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">KEPALA DINAS KOPERASI USAHA MIKRO</td>
        <td style="width: 50%; height: 18px; text-align: center;">KETUA</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">DAN TENAGA KERJA</td>
        <td style="width: 50%; height: 18px; text-align: center;">TIM TEKNIS</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">KOTA KEDIRI</td>
        <td style="width: 50%; height: 18px;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 61px;">&nbsp;</td>
        <td style="width: 50%; height: 61px;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;"><span style="text-decoration: underline;"><strong>' . $survey_jadwal['nama_kepala'] . '</strong></span></td>
        <td style="width: 50%; height: 18px; text-align: center;"><span style="text-decoration: underline;"><strong>' . $survey_jadwal['nama_ketua'] . '</strong></span></td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">' . $survey_jadwal['jabatan_kepala'] . '</td>
        <td style="width: 50%; height: 18px; text-align: center;">' . $survey_jadwal['jabatan_ketua'] . '</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">NIP. ' . $survey_jadwal['nip_kepala'] . '</td>
        <td style="width: 50%; height: 18px; text-align: center;">NIP. ' . $survey_jadwal['nip_ketua'] . '</td>
        </tr>
        </tbody>
        </table>
       ';

        return $html;
    }
}
