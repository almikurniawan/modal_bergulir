<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class Rekapperhari extends BaseController
{
    public function index()
    {
        $data['grid']   = $this->grid();
        $data['search'] = '';
        $data['title']  = 'Rekap Perhari';
        $data['url_delete']  = '';

        return view('global/list', $data);
    }

    public function grid()
    {
        $SQL = "select to_char(peng_disetujui_kunci_at,'YYYY-MM-DD') AS id, count(*) as jumlah, to_char(peng_disetujui_kunci_at,'YYYY-MM-DD') AS tanggal from pengajuan where peng_disetujui_kunci_is is true GROUP BY to_char(peng_disetujui_kunci_at,'YYYY-MM-DD')";

        $action['detail']     = array(
            'link'          => 'admin/Rekapperhari/detail/'
        );

        $grid = new Grid();
        return $grid->set_query($SQL)
            ->set_sort(array('tanggal', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/rekapperhari/grid?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'tanggal',
                            'title' => 'Tanggal',
                            'format' => 'date'
                        ),
                        array(
                            'field' => 'jumlah',
                            'title' => 'Jumlah Pengajuan',
                        ),
                    ),
                    'action'    => $action,
                )
            )
            ->output();
    }
    public function detail($date)
    {
        $data['grid']   = $this->grid_detail($date);
        $data['search'] = '';
        $data['title']  = 'Detail Rekap Perhari Tanggal ' . date('d-m-Y', strtotime($date));
        $data['url_delete']  = '';

        return view('admin/verifikasi/list', $data);
    }
    public function grid_detail($date)
    {
        $SQL = "SELECT
                    peng_nominal,
                    member_nama_lengkap,
                    jns_pengajuan_label,
                    peng_tanggal,
                    CASE
                        WHEN survey_hasil_reject_is IS TRUE THEN
                            '<span class=\"badge badge-danger\">Survey Rejected</span>'
                        WHEN survey_hasil_approve_is IS TRUE THEN
                            '<span class=\"badge badge-success\">Survey Verified</span>'
                        WHEN peng_surv_is IS TRUE THEN
                            '<span class=\"badge badge-success\">Disurvey</span>'
                        WHEN peng_verif_reject_is IS TRUE THEN
                            '<span class=\"badge badge-danger\">Rejected</span><br/><b>Note : </b>' || peng_verif_reject_note
                        WHEN peng_verif_is IS TRUE THEN
                            '<span class=\"badge badge-success\">Disetujui</span><br/><b>Nominal : </b> Rp. ' || to_char(peng_disetujui_nominal,'999G999G999G999G999')
                        ELSE
                            case 
                                when peng_lock_is is true then 
                                    '<span class=\"badge badge-warning\">Waiting</span>'
                                else 
                                    '<span class=\"badge badge-primary\">Not Submitted</span>'
                            end
                    END AS status,
                    peng_verif_is,
                    '<button onclick=\"view('||peng_id||','||peng_jenis_pengajuan||')\" class=\"btn btn-primary bmd-btn-fab-sm bmd-btn-fab\"><i class=\"k-icon k-i-preview\"></i> </button> ' as download,
                    peng_id AS ID 
                FROM
                    pengajuan
                    left join member on member_id = peng_member_id
                    left join ref_jenis_pengajuan on ref_jenis_pengajuan.jns_pengajuan_id = peng_jenis_pengajuan
                    left join survey_hasil on peng_id = survey_hasil_peng_id where peng_disetujui_kunci_at::date='".$date."'";
            // die($SQL);
        // $action['detail']     = array(
        //     'link'          => 'admin/pengajuan/detail/'
        // );
        // $action['delete']     = array(
        //     'jsf'          => '_delete'
        // );

        $grid = new Grid();
        return $grid->set_query($SQL)
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/rekapperhari/grid_detail/".$date."?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'member_nama_lengkap',
                            'title' => 'Pengaju',
                        ),
                        array(
                            'field' => 'jns_pengajuan_label',
                            'title' => 'Jenis',
                        ),
                        array(
                            'field' => 'peng_tanggal',
                            'title' => 'Tanggal',
                            'format' => 'date'
                        ),
                        array(
                            'field' => 'peng_nominal',
                            'title' => 'Jumlah Pinjaman',
                            'format' => 'number',
                            'align' => 'right'
                        ),
                        array(
                            'field' => 'status',
                            'title' => 'Status',
                            'encoded' => false,
                            'width' => 150
                        ),
                        array(
                            'field' => 'download',
                            'title' => ' ',
                            'encoded' => false,
                            'width' => 150
                        ),
                    ),
                    // 'action'    => $action,
                    // 'head_left'        => array('add' => base_url('/admin/pengajuan/pilihPaket'))
                )
            )
            ->set_snippet(function ($id, $value) {
                if ($value['peng_verif_is'] == 't') {
                    $value['delete'] = '';
                }
                return $value;
            })
            ->set_label_add('Buat Pengajuan')
            ->output();
    }
}
