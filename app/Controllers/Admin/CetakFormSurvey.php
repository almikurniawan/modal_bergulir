<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use TCPDF;

class CetakFormSurvey extends BaseController
{
    public function cetak($survey_id)
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

        $survey_detail = $this->db->table("survey_tempat")->getWhere(['survey_tem_head_id'=> $survey_id])->getResultArray();
        foreach ($survey_detail as $key => $value) {
            $pdf->addPage();
            $pdf->writeHTML($this->html_survey($value['survey_tem_peng_id']), true, false, true, false, '');
    
            $pdf->addPage();
            $pdf->writeHTML($this->html_masalah(), true, false, true, false, '');
            $pdf->addPage();
            $pdf->writeHTML($this->html_berita_acara(), true, false, true, false, '');
        }
        
        $pdf->Output();
        die();
    }

    public function html_survey($peng_id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id'=> $peng_id])->getRowArray();

        $html = '<table style="border-collapse: collapse; width: 100%; margin-left: auto; margin-right: auto;" >
        <tbody>
        <tr>
        <td style="width: 100%; text-align: center;">LAPORAN HASIL SURVEY</td>
        </tr>
        <tr style="text-align: center;">
        <td style="width: 100%;">PENGAJUAN DANA BERGULIR APBD PEMKOT KEDIRI</td>
        </tr>
        <tr style="text-align: center;">
        <td style="width: 100%;">( Untuk Pengajuan Koperasi )</td>
        </tr>
        </tbody>
        </table>
        <p>A. OBJEK SURVEY</p>
        <table style="border-collapse: collapse; width: 100%;" >
        <tbody>
        <tr>
        <td style="width: 5.26316%;">1.</td>
        <td style="width: 22.807%;">Nama Koperasi</td>
        <td style="width: 71.9298%;">: '.$pengajuan['peng_prof_nama_usaha'].'</td>
        </tr>
        <tr>
        <td style="width: 5.26316%;">2.</td>
        <td style="width: 22.807%;">Badan Hukum</td>
        <td style="width: 71.9298%;">: '.$pengajuan['peng_badan_hukum_no'].'</td>
        </tr>
        <tr>
        <td style="width: 5.26316%;">3.</td>
        <td style="width: 22.807%;">Alamat</td>
        <td style="width: 71.9298%;">: '.$pengajuan['peng_prof_alamat'].'</td>
        </tr>
        <tr>
        <td style="width: 5.26316%;">4.</td>
        <td style="width: 22.807%;">Nama Ketua</td>
        <td style="width: 71.9298%;">: '.$pengajuan['peng_ketua'].'</td>
        </tr>
        <tr>
        <td style="width: 5.26316%;">5.</td>
        <td style="width: 22.807%;">Jumlah Permohonan</td>
        <td style="width: 71.9298%;">: Rp. '.number_format($pengajuan['peng_nominal'],0,'.','.').'</td>
        </tr>
        </tbody>
        </table>
        <p>B. HASIL SURVEY</p>
        <p>1. Aspek Organisasi dan Manajemen</p>
        <table style="border-collapse: collapse; width: 100%;" >
        <tbody>
        <tr>
        <td style="width: 27.9727%;">- Perijinan yang dimiliki</td>
        <td style="width: 72.0273%;">:</td>
        </tr>
        <tr>
        <td style="width: 27.9727%;">- Penilaian Kesehatan USP</td>
        <td style="width: 72.0273%;">:</td>
        </tr>
        <tr>
        <td style="width: 27.9727%;">- Pelaksanaan RAT</td>
        <td style="width: 72.0273%;">:</td>
        </tr>
        <tr>
        <td style="width: 27.9727%;">- Jumlah Anggota Produktif</td>
        <td style="width: 72.0273%;">:......................... orang dari...................... orang anggota</td>
        </tr>
        <tr>
        <td style="width: 27.9727%;">- Status tempat Usaha</td>
        <td style="width: 72.0273%;">:</td>
        </tr>
        </tbody>
        </table>
        <p>2. Aspek Permodalan</p>
        <table style="border-collapse: collapse; width: 100%;" >
        <tbody>
        <tr>
        <td style="width: 28.0242%;">a) Modal sendiri</td>
        <td style="width: 71.9758%;">:Rp. </td>
        </tr>
        <tr>
        <td style="width: 28.0242%;">b) Modal Luar</td>
        <td style="width: 71.9758%;">:Rp.</td>
        </tr>
        </tbody>
        </table>
        <p>3. Aspek Usaha</p>
        <table style="border-collapse: collapse; width: 100%;" >
        <tbody>
        <tr>
        <td style="width: 27.8226%;">a) Usaha yang dilaksanakan</td>
        <td style="width: 72.1774%;">:</td>
        </tr>
        <tr>
        <td style="width: 27.8226%;">b) Omset pertahun</td>
        <td style="width: 72.1774%;">:Rp.</td>
        </tr>
        <tr>
        <td style="width: 27.8226%;">c) Pendapatan pertahun</td>
        <td style="width: 72.1774%;">:Rp.</td>
        </tr>
        <tr>
        <td style="width: 27.8226%;">d) Beban operasional</td>
        <td style="width: 72.1774%;">:Rp.</td>
        </tr>
        <tr>
        <td style="width: 27.8226%;">SHU</td>
        <td style="width: 72.1774%;">:Rp.</td>
        </tr>
        </tbody>
        </table>
        <p>4. Aspek Keuangan / Likuiditas</p>
        <table style="border-collapse: collapse; width: 100%;" >
        <tbody>
        <tr>
        <td style="width: 27.6209%;">a) Penerimaan Kas Perbulan</td>
        <td style="width: 72.3791%;">:Rp.</td>
        </tr>
        <tr>
        <td style="width: 27.6209%;">b) Pengeluaran</td>
        <td style="width: 72.3791%;">:Rp.</td>
        </tr>
        <tr>
        <td style="width: 27.6209%;">Saldo</td>
        <td style="width: 72.3791%;">:Rp.</td>
        </tr>
        </tbody>
        </table>
        <p>5. Aspek Jaminan</p>
        <table style="border-collapse: collapse; width: 100%;" >
        <tbody>
        <tr>
        <td style="width: 27.4194%;">a) Jaminan yang diajukan</td>
        <td style="width: 72.5807%;">:</td>
        </tr>
        <tr>
        <td style="width: 27.4194%;">b) Taksiran harga</td>
        <td style="width: 72.5807%;">:Rp.</td>
        </tr>
        <tr>
        <td style="width: 27.4194%;">c) Status jaminan</td>
        <td style="width: 72.5807%;">:</td>
        </tr>
        </tbody>
        </table>
        <p>6. Aspek kelangsuangan hidup :</p>';
        return $html;
    }

    public function html_masalah()
    {
        $html = '<p>C. PERMASALAHAN</p>
        <p>.........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................</p>
        <table style="border-collapse: collapse; width: 100%; height: 98px;">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">Mengetahui</td>
        <td style="width: 50%; height: 18px;">kediri, </td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">Koperasi</td>
        <td style="width: 50%; height: 18px;">PETUGAS SURVEY</td>
        </tr>
        <tr style="height: 44px;">
        <td style="width: 50%; height: 44px;">&nbsp;</td>
        <td style="width: 50%; height: 44px;">&nbsp;</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 50%; height: 18px; text-align: center;">(____________________)</td>
        <td style="width: 50%; height: 18px;">1.________________________<br />2.________________________<br />3.________________________<br />4.________________________<br />5.________________________</td>
        </tr>
        </tbody>
        </table>';
        return $html;
    }

    public function html_berita_acara()
    {
        $html = '<table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 13.1579%;">&nbsp;</td>
        <td style="width: 86.8421%;">BERITA ACARA SURVEY</td>
        </tr>
        <tr>
        <td style="width: 13.1579%;">&nbsp;</td>
        <td style="width: 86.8421%;">TIM TEKNIS PERMOHONAN PINJAMAN</td>
        </tr>
        <tr>
        <td style="width: 13.1579%;">&nbsp;</td>
        <td style="width: 86.8421%;">DANA BERGULIR</td>
        </tr>
        <tr>
        <td style="width: 13.1579%;">&nbsp;</td>
        <td style="width: 86.8421%;">(untuk koperasi)</td>
        </tr>
        <tr>
        <td style="width: 13.1579%;">&nbsp;</td>
        <td style="width: 86.8421%;">&nbsp;</td>
        </tr>
        <tr>
        <td style="width: 13.1579%;">&nbsp;</td>
        <td style="width: 86.8421%;">____________________________________________</td>
        </tr>
        </tbody>
        </table>
        <p>Pada hari ini ............................................tanggal.............................................telah dilaksanakan survey ke Lapangan oleh Tim Teknis program Permberdayaan KUMKM Kota Kediri terhadap permohonan pinjaman</p>';
        return $html;
    }
}