<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class Rekap extends BaseController
{
    public function index()
    {
        $data['grid']   = $this->grid();
        $data['search'] = $this->search();
        $data['title']  = 'Rekap';
        $data['url_delete'] = 'admin/rekap/delete';

        return view('global/list', $data);
    }

    public function grid()
    {
        $SQL = "SELECT
                    pembayaran_id AS ID,
                    member_nama_lengkap AS nama,
                    peng_prof_nama_usaha AS nama_usaha,
                    peng_disetujui_tanggal_penetapan AS tanggal_penetapan,
                    peng_disetujui_no_penetapan AS nomor_penetapan,
                    peng_disetujui_tanggal_jatuh_tempo AS tanggal_realisasi,
                    peng_disetujui_tanggal_jatuh_tempo AS tanggal_jatuh_tempo,
                    CASE
                        WHEN peng_jam_jenis = 1 THEN
                        'BPKB ' ||coalesce(survey_hasil_5_jaminan,'')
                        WHEN peng_jam_jenis = 2 THEN
                        'Sertifikat ' ||coalesce(survey_hasil_5_jaminan,'') ELSE '-' ||coalesce(survey_hasil_5_jaminan,'')
                    END AS jaminan,
                    survey_hasil_5_taksiran_harga as taksiran_jaminan,
                    peng_disetujui_nominal as nominal_pengajuan,
                    (select COALESCE(sum(pembayaran_cicilan),0) + COALESCE(sum(pembayaran_bunga),0) from pembayaran child where child.pembayaran_peng_id = peng_id and child.pembayaran_ke < pembayaran.pembayaran_ke and pembayaran_lunas_is is true) as total_sebelumnya,
                    COALESCE(pembayaran_cicilan,0) + COALESCE(pembayaran_bunga,0) as cicilan_bulan_ini,
                    (select COALESCE(sum(pembayaran_cicilan),0) + COALESCE(sum(pembayaran_bunga),0) from pembayaran child where child.pembayaran_peng_id = peng_id and pembayaran_lunas_is is not true) as sisa_angsuran,
                    *
                FROM
                    pembayaran
                    LEFT JOIN pengajuan ON peng_id = pembayaran_peng_id
                    LEFT JOIN MEMBER ON member_id = peng_member_id 
                    left join survey_hasil on survey_hasil_peng_id = peng_id
                WHERE
                    pembayaran_lunas_is IS TRUE 
                    AND to_char( pembayaran_tanggal, 'YYYY-MM' ) = '".$this->request->getGet('bulan')."'";

        // die($SQL);
        $grid = new Grid();
        return $grid->set_query($SQL, array(
        ))
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/rekap/grid?datasource&" . get_query_string()),
                    'scrollable'    => 'true',
                    'grid_columns'  => array(
                        array(
                            'field' => 'member_nama_lengkap',
                            'title' => 'Nama',
                            'locked'=> true,
                            'width'=> 150
                        ),
                        array(
                            'field' => 'nama_usaha',
                            'title' => 'Usaha',
                            'locked'=> true,
                            'width'=> 150
                        ),
                        array(
                            'field' => 'tanggal_penetapan',
                            'title' => 'Tgl. Penetapan',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'nomor_penetapan',
                            'title' => 'NO. Penetapan',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'tanggal_realisasi',
                            'title' => 'Tgl. Realisasi',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'tanggal_jatuh_tempo',
                            'title' => 'Tgl. Jatuh Tempo',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'jaminan',
                            'title' => 'Jaminan',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'taksiran_jaminan',
                            'title' => 'Taksiran',
                            'align' => 'right',
                            'format'=> 'number',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'nominal_pengajuan',
                            'title' => 'Pengajuan',
                            'align' => 'right',
                            'format'=> 'number',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'total_sebelumnya',
                            'title' => 'Angsuran Sebelumnya',
                            'align' => 'right',
                            'format'=> 'number',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'cicilan_bulan_ini',
                            'title' => 'Bulan ini',
                            'align' => 'right',
                            'format'=> 'number',
                            'width'=> 150
                        ),
                        array(
                            'field' => 'pembayaran_sisa',
                            'title' => 'Sisa Angsuran',
                            'align' => 'right',
                            'format'=> 'number',
                            'width'=> 150
                        ),
                    ),
                )
            )
            ->set_toolbar(function($toolbar)
            {
                $toolbar->add('download');  
            })
            ->output();
    }

    public function search()
    {
        $form = new Form();
        return $form->set_form_type('search')
            ->set_form_method('GET')
            ->set_submit_label('Cari')
            ->add('bulan', 'Bulan', 'month', false, $this->request->getGet('bulan'), 'style="width:100%;" ')
            ->output();
    }
}
