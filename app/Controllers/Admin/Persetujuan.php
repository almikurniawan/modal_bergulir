<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class Persetujuan extends BaseController
{

    public function index()
    {
        $data['grid']   = $this->grid_persetujuan();
        $data['search'] = '';
        $data['title']  = 'Persetujuan';
        $data['url_delete']  = '';

        return view('global/list', $data);
    }

    public function grid_persetujuan()
    {
        $SQL = "SELECT
                *,
                survey_tem_id as id,
                '<a href=\"" . base_url('admin/CetakSPPK/index') . "/'||peng_id||'\" target=\"_new\" class=\"btn btn-primary btn-raised\" title=\"Lihat\">Cetak </a> <a href=\"" . base_url('admin/persetujuan/form') . "/'||peng_id||'\" class=\"btn btn-primary bmd-btn-fab-sm bmd-btn-fab\" title=\"Lihat\"><i class=\"k-icon k-i-preview m-2\"></i> </a>' as lihat,
                case when survey_hasil_approve_is is true then '<span class=\"badge badge-success\">Approved</span>' when survey_hasil_reject_is is true then '<span class=\"badge badge-danger\">Rejected</span>' else '<span class=\"badge badge-warning\">belum</span>' end as status
                from survey_tempat
                left join survey_hasil on survey_tem_head_id = survey_hasil_survey_id and survey_tem_peng_id = survey_hasil_peng_id and survey_hasil_lock_is is true
                left join pengajuan on peng_id = survey_tem_peng_id
                left join member on member_id = peng_member_id
                left join ref_jenis_pengajuan on ref_jenis_pengajuan.jns_pengajuan_id = peng_jenis_pengajuan";
        // die($SQL);
        $action['detail'] = ['link' => 'admin/surveyHasil/form/'];
        $grid = new Grid();
        return $grid->set_query($SQL, [
            ['survey_hasil_approve_is', 'true', 'is'],
            // ['survey_tanggal', $this->request->getGet('tanggal'),'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/persetujuan/grid_persetujuan?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'member_nama_lengkap',
                            'title' => 'Member',
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
                            'field' => 'peng_nominal',
                            'title' => 'Jumlah Pinjaman',
                            'format' => 'number',
                            'align' => 'right'
                        ),
                        array(
                            'field' => 'status',
                            'title' => 'Status',
                            'encoded' => false,
                            'width' => 200
                        ),
                        array(
                            'field' => 'lihat',
                            'title' => ' ',
                            'encoded' => false,
                            'width' => 200
                        ),
                    ),
                    // "action"    => $action,
                    // 'head_left' => array('add' => base_url('/admin/survey/start'))
                )
            )
            ->set_sort(['id', 'desc'])
            ->output();
    }
    public function form($peng_id)
    {
        $data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $peng_id])->getRowArray();
        $data['form']   = $this->form_pengajuan($peng_id);

        $data['url_back']   = base_url("admin/persetujuan");
        $data['title']  = 'Persetujuan <b>' . strtoupper($data['peng_prof_nama_usaha']) . '</b>';
        return view('global/form', $data);
    }

    public function form_pengajuan($peng_id)
    {

        $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $peng_id])->getRowArray();
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')->set_resume(false)->set_template_column(2)
            ->add('peng_disetujui_nominal', 'Nominal', 'number', true, !empty($data) ? $data['peng_disetujui_nominal'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_cicilan', 'Cicilan', 'number', true, !empty($data) ? $data['peng_disetujui_cicilan'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_jangka_waktu_bln', 'Jangka waktu Bulan', 'number', true, !empty($data) ? $data['peng_disetujui_jangka_waktu_bln'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_jangka_waktu_text', 'Jangka waktu keternangan', 'text', true, !empty($data) ? $data['peng_disetujui_jangka_waktu_text'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_tanggal_penetapan', 'Tanggal penetapan', 'date', true, !empty($data) ? $data['peng_disetujui_tanggal_penetapan'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_tanggal_jatuh_tempo', 'Tanggal Jatuh Tempo', 'date', true, !empty($data) ? $data['peng_disetujui_tanggal_jatuh_tempo'] : '', 'style="width:100%;"');

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $dataForm['peng_disetujui_created_at'] = 'now()';
            $dataForm['peng_disetujui_created_by'] = $this->user['user_id'];
            if (!empty($data)) {
                $this->db->table("pengajuan")->where('peng_id', $peng_id)->update($dataForm);
                $this->db->table("pembayaran")->where('pembayaran_peng_id', $peng_id)->delete();
                for ($i = 0; $i < $this->request->getPost('peng_disetujui_jangka_waktu_bln'); $i++) {
                    $jatuh_tempo = $this->request->getPost('peng_disetujui_tanggal_jatuh_tempo');
                    $date = date("Y-m-d", strtotime($i." month", strtotime($jatuh_tempo)));
                    $this->db->table("pembayaran")->insert([
                        'pembayaran_peng_id' => $peng_id,
                        'pembayaran_tanggal' => $date,
                        'pembayaran_ke' => $i+1,
                        'pembayaran_cicilan' => $this->request->getPost('peng_disetujui_cicilan'),
                    ]);
                }
            }
            return $form->output();
        } else {
            return $form->output();
        }
    }
}
