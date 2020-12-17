<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use TCPDF;

class CetakAngsuran extends BaseController
{
    public function cetak($peng_id)
    {
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
		setlocale(LC_TIME, 'id_ID');
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('DINKOP');
		$pdf->SetTitle('Profil');
		$pdf->SetSubject('Profil');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetMargins(10, 2, 10);
		$pdf->SetAutoPageBreak(TRUE, 5);

		$pdf->SetFont('times', '', 11, '', 'false');
        $pdf->addPage();
        $pdf->writeHTML($this->html($peng_id), true, false, true, false, '');

        $pdf->Output();
        die();
    }

    public function html($peng_id)
    {
        $pengajuan = $this->db->table("pengajuan")->join("member","member_id=peng_member_id")->getWhere(['peng_id'=>$peng_id])->getRowArray();
        $cicilan = $this->db->table("pembayaran")->orderBy('pembayaran_ke','asc')->getWhere(['pembayaran_peng_id'=>$peng_id])->getResultArray();

        $row_cicilan = '';
        $nomor = 1;
        foreach ($cicilan as $key => $value) {
            $row_cicilan .= '<tr style="height: 18px;">
            <td style="width: 5.94545%; height: 18px;">'.$nomor.'</td>
            <td style="width: 18.616%; height: 18px;">'.$value['pembayaran_tanggal'].'</td>
            <td style="width: 25.4386%; height: 18px;" align="right">'.number_format($value['pembayaran_sisa'],0,'','.').'</td>
            <td style="width: 16.6667%; height: 18px;" align="right">'.number_format($value['pembayaran_cicilan'],0,'','.').'</td>
            <td style="width: 16.6667%; height: 18px;" align="right">'.number_format($value['pembayaran_bunga'],0,'','.').'</td>
            <td style="width: 16.6667%; height: 18px;" align="right">'.number_format(($value['pembayaran_bunga']+$value['pembayaran_cicilan']),0,'','.').'</td>
            </tr>';
            $nomor++;
        }

        $html = '<table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 100%; text-align: center;">JADWAL ANGSURAN</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 25.2437%;">Nama Debitur</td>
        <td style="width: 74.7563%;">: '.$pengajuan['member_nama_lengkap'].' / '.$pengajuan['peng_prof_nama_usaha'].'</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">Alamat</td>
        <td style="width: 74.7563%;">: '.$pengajuan['peng_prof_alamat'].'</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">Plafon Pinjaman</td>
        <td style="width: 74.7563%;">: Rp. '.number_format($pengajuan['peng_disetujui_nominal'],0,'','.').'</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">NO. PK</td>
        <td style="width: 74.7563%;">: '.$pengajuan['peng_disetujui_no_penetapan'].'</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">Tanggal Pinjaman</td>
        <td style="width: 74.7563%;">: '.$pengajuan['peng_disetujui_tanggal_jatuh_tempo'].'</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">Suku Bunga</td>
        <td style="width: 74.7563%;">: '.$pengajuan['peng_srt_bunga'].' %</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">Jangka Waktu</td>
        <td style="width: 74.7563%;">: '.$pengajuan['peng_disetujui_jangka_waktu_bln'].' Bln</td>
        </tr>
        <tr>
        <td style="width: 25.2437%;">Angsuran</td>
        <td style="width: 74.7563%;">: </td>
        </tr>
        </tbody>
        </table>
        <br/><br/>
        <table style="border-collapse: collapse; width: 100%; height: 54px;" border="1">
        <tbody>
        <tr style="height: 18px;">
        <td style="width: 5.94545%; height: 36px; text-align: center;" rowspan="2">NO</td>
        <td style="width: 18.616%; height: 36px; text-align: center;" rowspan="2">Tgl/Bln</td>
        <td style="width: 25.4386%; height: 36px; text-align: center;" rowspan="2">Sisa Pinjaman</td>
        <td style="width: 33.4%; height: 18px; text-align: center;">Angsuran</td>
        <td style="width: 16.6667%; height: 36px; text-align: center;" rowspan="2">Jumlah</td>
        </tr>
        <tr style="height: 18px;">
        <td style="width: 16.6667%; height: 18px; text-align: center;">Pokok</td>
        <td style="width: 16.6667%; height: 18px; text-align: center;">Bunga</td>
        </tr>
        '.$row_cicilan.'
        </tbody>
        </table>';
        return $html;
    }
}
