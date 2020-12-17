<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use TCPDF;

class CetakSurvey extends BaseController
{
    public function jadwal($jadwal_id)
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

		$pdf->SetFont('times', '', 11, '', 'false');

		$pdf->addPage();
        $pdf->writeHTML($this->html_jadwal($jadwal_id), true, false, true, false, '');
        
        $pdf->Output();
        die();
    }

    public function html_jadwal($jadwal_id)
    {
        $data_survey = $this->db->table("survey")->getWhere(['survey_id'=>$jadwal_id])->getRowArray();
        $data_kepada = $this->db->query("select * from survey_detail left join karyawan on kar_id = survey_det_kar_id where survey_det_head_id=".$jadwal_id)->getResultArray();

        $kepada = '';
        $nomor = 1;
        foreach ($data_kepada as $key => $value) {
            $kepada .= '<tr>
                            <td style="width: 3.45525%;">'.$nomor.'.</td>
                            <td style="width: 29.8781%;">Nama</td>
                            <td style="width: 66.6666%;">: '.$value['kar_nama'].'</td>
                            </tr>
                            <tr>
                            <td style="width: 3.45525%;">&nbsp;</td>
                            <td style="width: 29.8781%;">NIP</td>
                            <td style="width: 66.6666%;">: '.$value['kar_nip'].'</td>
                            </tr>
                            <tr>
                            <td style="width: 3.45525%;">&nbsp;</td>
                            <td style="width: 29.8781%;">Pangkat / Gol</td>
                            <td style="width: 66.6666%;">: '.$value['kar_pangkat'].'</td>
                            </tr>
                            <tr>
                            <td style="width: 3.45525%;">&nbsp;</td>
                            <td style="width: 29.8781%;">Jabatan</td>
                            <td style="width: 66.6666%;">: '.$value['kar_jabatan'].'</td>
                        </tr>';
            $nomor++;
        }

        $data_tempat = $this->db->query("select pengajuan.* from survey_tempat left join pengajuan on survey_tem_peng_id = peng_id where survey_tem_head_id=".$jadwal_id)->getResultArray();
        $tempat = '';
        foreach ($data_tempat as $key => $value) {
            $nomor = 1;
            $tempat .= '<tr>
                            <td style="width: 4.2683%;">'.$nomor.'.</td>
                            <td style="width: 95.7317%;">'.$value['peng_prof_nama_usaha'].'</td>
                            </tr>
                            <tr>
                            <td style="width: 4.2683%;">&nbsp;</td>
                            <td style="width: 95.7317%;">'.$value['peng_prof_alamat'].'</td>
                        </tr>';
            $nomor++;
        }

        $html = '<table style="border-collapse: collapse; width: 100%;" border="1">
        <tbody>
        <tr>
        <td>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 50.3929%;">&nbsp;</td>
        <td style="width: 72.2301%;" colspan="2">LAMPIRAN PERATURAN WALIKOTA KEDIRI</td>
        </tr>
        <tr>
        <td style="width: 50.3929%;">&nbsp;</td>
        <td style="width: 25%;">NOMOR </td>
        <td>: '.$data_survey['survey_nomor_lengkap'].'</td>
        </tr>
        <tr>
        <td style="width: 50.3929%;">&nbsp;</td>
        <td style="width: 25%;">Tanggal </td>
        <td>: '.date_format(date_create($data_survey['survey_created_at']),'d F Y').'</td>
        </tr>
        </tbody>
        </table>
        <hr />
        <table style="border-collapse: collapse; width: 100%; height: 90px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 20%; height: 18px;"></td>
        <td style="width: 70%; text-align: center; height: 18px;">PEMERINTAH KOTA KEDIRI</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 20%; height: 18px; text-align: right;" rowspan="4"><img src="./assets/images/logo.svg" alt="Girl in a jacket" width="80"/></td>
        <td style="width: 70%; text-align: center; height: 18px;"><strong>DINAS KOPERASI, USAHA MIKRO, DAN TENAGA KERJA</strong></td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 70%; height: 18px; text-align: center;">Jl. Brigjend Pol Imam Bachri No. 100-C 64131 Telp/Fax. (0354) 688107</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 70%; height: 18px; text-align: center;"><a href="http://www.dinkop.kedirikota.go.id">www.dinkop.kedirikota.go.id</a> - email : dinaskop.kedirikota@gmail.com</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 70%; height: 18px; text-align: center;"><strong>KEDIRI</strong></td>
        </tr>
        </tbody>
        </table>
        <center>=====================================================================================</center>
        <br/>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 100%; text-align: center;"><strong>SURAT PERINTAH TUGAS</strong></td>
        </tr>
        <tr>
        <td style="width: 100%; text-align: center;"><strong>NOMOR : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/SPPD-P3KUM/419.106/2018</strong></td>
        </tr>
        </tbody>
        </table>
        <br />
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 13.6542%;">Dasar</td>
        <td style="width: 86.3458%;">1. DPA Tahun 2018</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 100%; text-align: center;"><strong>Menugaskan</strong></td>
        </tr>
        <tr>
        <td style="width: 100%;">Kepada :&nbsp;</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        '.$kepada.'
        </tbody>
        </table>
        <p>&nbsp;</p>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 18.2927%;">Untuk</td>
        <td style="width: 81.7073%;">: '.$data_survey['survey_untuk'].'</td>
        </tr>
        <tr>
        <td style="width: 18.2927%;">Waktu</td>
        <td style="width: 81.7073%;">: '.date_format(date_create($data_survey['survey_tanggal']),'d F Y').'</td>
        </tr>
        <tr>
        <td style="width: 18.2927%;">Tempat</td>
        <td style="width: 81.7073%;">:</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        '.$tempat.'
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 18.2927%;">Keterangan</td>
        <td style="width: 81.7073%;">1. Setelah selesai melakukan Perjalanan Dinas segera membuat laporan</td>
        </tr>
        <tr>
        <td style="width: 18.2927%;">&nbsp;</td>
        <td style="width: 81.7073%;">2. SPT ini berlaku sejak tanggal dikeluarkan</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%; height: 36px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 53.0487%; height: 18px;">&nbsp;</td>
        <td style="width: 26.2195%; height: 18px;">Dikeluarkan di</td>
        <td style="width: 20.7317%; height: 18px;">: Kediri</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 53.0487%; height: 18px;">&nbsp;</td>
        <td style="width: 26.2195%; height: 18px;">Pada tanggal</td>
        <td style="width: 20.7317%; height: 18px;">: '.date_format(date_create($data_survey['survey_created_at']),'d F Y').'</td>
        </tr>
        </tbody>
        </table>
        <p>&nbsp;</p>
        <table>
        <tbody>
        <tr>
        <td style="width: 50%;"></td>
        <td style="width: 50%; text-align:center;">
        KEPALA DINAS KOPERASI USAHA MIKRO
        </td>
        </tr>
        <tr>
        <td style="width: 50%;">&nbsp;</td>
        <td style="width: 50%; text-align: center;">DAN TENAGA KERJA</td>
        </tr>
        <tr>
        <td style="width: 50%; height: 50px;">&nbsp;</td>
        <td style="width: 50%; height: 50px;">&nbsp;</td>
        </tr>
        <tr>
        <td style="width: 50%;">&nbsp;</td>
        <td style="width: 50%; text-align: center;"><u>BAMBANG PRIAMBODO, SH., MM</u></td>
        </tr>
        <tr>
        <td style="width: 50%;">&nbsp;</td>
        <td style="width: 50%; text-align: center;">Pembina Tingkat I
        </td>
        </tr>
        <tr>
        <td style="width: 50%;">&nbsp;</td>
        <td style="width: 50%; text-align: center;">NIP.19670327 200112 1 001
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
       ';

        return $html;
    }
}