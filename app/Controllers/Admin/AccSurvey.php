<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class AccSurvey extends BaseController
{

    public function index()
    {
        $data['grid']   = $this->grid_accsurvey();
        $data['search'] = '';
        $data['title']  = 'Survey Hasil';
        $data['url_delete']  = '';
        $data['url_kunci']  = base_url('admin/surveyHasil/kunci');
        $data['url_buka_kunci']  = base_url('admin/surveyHasil/bukaKunci');

        return view('admin/surveyhasil/list', $data);
    }

    public function grid_accsurvey()
    {
        $SQL = "SELECT
                *,
                survey_tem_id as id,
                '<a href=\"" . base_url('admin/AccSurvey/form') . "/'||survey_tem_head_id||'/'||peng_id||'\" class=\"btn btn-primary bmd-btn-fab-sm bmd-btn-fab\" title=\"Lihat\"><i class=\"k-icon k-i-preview m-2\"></i> </a>' as lihat,
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
            ['survey_hasil_lock_is', 'true', 'is'],
            // ['survey_tanggal', $this->request->getGet('tanggal'),'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/AccSurvey/grid_accsurvey?datasource&" . get_query_string()),
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
    public function form($id, $peng_id)
    {
        $data = $this->db->table('pengajuan')->select('*')->getWhere(['peng_id' => $peng_id])->getRowArray();
        $data['form']   = $this->form_survey($id, $peng_id);
        $approve = $this->db->table('survey_hasil')->select('*')->getWhere(['survey_hasil_peng_id' => $peng_id])->getRowArray();
        if($approve['survey_hasil_approve_is'] != 't'){
            $data['form']   .= '<div class="row">
                <div class="col">
                <button onclick="approve('.$peng_id.')" class="btn btn-raised btn-success" title="Approve"><i class="k-icon k-i-check-circle"></i> Approve </button>
                </div>
                <div class="col">
                <button onclick="reject('.$peng_id.')" class="btn btn-raised btn-danger" title="Reject"><i class="k-icon k-i-close-circle"></i> Reject </button>
                </div>
            </div>
            ';
        }
        $data['grid_tempat']   = '$this->grid_tempat($peng_id)';
        $data['grid_petugas']   = '$this->grid_petugas($peng_id)';
        $data['url_back']   = base_url("admin/AccSurvey");
        $data['title']  = 'Survey Hasil <b>' . strtoupper($data['peng_prof_nama_usaha']) . '</b>';
        $data['id'] = $peng_id;

        $data['url_approve']  = base_url('admin/accSurvey/approve');
        $data['url_reject']  = base_url('admin/accSurvey/reject');

        return view('admin/accsurvey/form', $data);
    }

    public function form_survey($id, $peng_id)
    {

        $data = $this->db->table("survey_hasil")->getWhere(['survey_hasil_peng_id' => $peng_id])->getRowArray();
        $dataHasil = array(
            'survey_hasil_survey_id' => $id,
            'survey_hasil_peng_id' => $peng_id,
            'survey_hasil_created_at' => 'now()'
        );
        if (!empty($data)) {
            $this->db->table("survey_hasil")->where('survey_hasil_id', $peng_id)->update($dataHasil);
        } else {
            $this->db->table("survey_hasil")->insert($dataHasil);
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')->set_resume($data['survey_hasil_lock_is'])->set_template_column(2)
            ->add('survey_hasil_1_perijinan', 'Perijinan yang dimiliki', 'text', true, !empty($data) ? $data['survey_hasil_1_perijinan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_nilai_kes_usp', 'Penilaian Kesehatan USP', 'text', true, !empty($data) ? $data['survey_hasil_1_nilai_kes_usp'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_rat', 'Pelaksanaan RAT', 'text', true, !empty($data) ? $data['survey_hasil_1_rat'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_jml_angg_produktif', 'Jumlah Anggota Produktif', 'number', true, !empty($data) ? $data['survey_hasil_1_jml_angg_produktif'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_jml_angg', 'Jumlah Anggota Total', 'number', true, !empty($data) ? $data['survey_hasil_1_jml_angg'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_status', 'Status tempat Usaha', 'text', true, !empty($data) ? $data['survey_hasil_1_status'] : '', 'style="width:100%;"')
            ->add('survey_hasil_2_modal_sendiri', 'Modal sendiri', 'number', true, !empty($data) ? $data['survey_hasil_2_modal_sendiri'] : '', 'style="width:100%;"')
            ->add('survey_hasil_2_modal_luar', 'Modal luar', 'number', true, !empty($data) ? $data['survey_hasil_2_modal_luar'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_usaha', 'Usaha yang dilaksanakan', 'text', true, !empty($data) ? $data['survey_hasil_3_usaha'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_omset_per_tahun', 'Omset per tahun', 'number', true, !empty($data) ? $data['survey_hasil_3_omset_per_tahun'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_pendptn_per_tahun', 'Pendapatan per tahun', 'number', true, !empty($data) ? $data['survey_hasil_3_pendptn_per_tahun'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_beban_operasional', 'Beban operasional', 'number', true, !empty($data) ? $data['survey_hasil_3_beban_operasional'] : '', 'style="width:100%;"')
            ->add('survey_hasil_4_kas_per_bulan', 'Penerimaan Kas Per bulan', 'number', true, !empty($data) ? $data['survey_hasil_4_kas_per_bulan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_4_pengeluaran', 'Pengeluaran', 'number', true, !empty($data) ? $data['survey_hasil_4_pengeluaran'] : '', 'style="width:100%;"')
            ->add('survey_hasil_5_jaminan', 'Jaminan yang diajukan', 'text', true, !empty($data) ? $data['survey_hasil_5_jaminan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_5_taksiran_harga', 'Taksiran harga', 'number', true, !empty($data) ? $data['survey_hasil_5_taksiran_harga'] : '', 'style="width:100%;"')
            ->add('survey_hasil_5_status_jaminan', 'Status Jaminan', 'text', true, !empty($data) ? $data['survey_hasil_5_status_jaminan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_6_kelangsungan_hidup', 'Aspek kelangsungan hidup', 'text', true, !empty($data) ? $data['survey_hasil_6_kelangsungan_hidup'] : '', 'style="width:100%;"')
            ->add('survey_hasil_permasalahan', 'PERMASALAHAN', 'text', true, !empty($data) ? $data['survey_hasil_permasalahan'] : '', 'style="width:100%;"');

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            if (!empty($data)) {
                $this->db->table("survey_hasil")->where('survey_hasil_id', $peng_id)->update($dataForm);
            }
            return $form->output();
        } else {
            return $form->output();
        }
    }
    public function kunci()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_hasil")->where('survey_hasil_id', $id)->update([
            'survey_hasil_lock_is' => 'true',
            'survey_hasil_lock_at' => 'now()',
            'survey_hasil_lock_by' => $this->user['user_id'],
        ]);
        return $this->response->setJSON([
            'status'=>true,
            'message'=>'Sukses kunci hasil survey'
        ]);
    }
    public function bukaKunci()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_hasil")->where('survey_hasil_id', $id)->update([
            'survey_hasil_lock_is' => 'false',
            'survey_hasil_lock_at' => 'now()',
            'survey_hasil_lock_by' => $this->user['user_id'],
        ]);
        return $this->response->setJSON([
            'status'=>true,
            'message'=>'Sukses buka kunci hasil survey'
        ]);
    }

    public function approve()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_hasil")->where('survey_hasil_peng_id', $id)->update([
            'survey_hasil_approve_is' => 'true',
            'survey_hasil_approve_at' => 'now()',
            'survey_hasil_approve_by' => $this->user['user_id'],
            'survey_hasil_reject_is' => 'false'
        ]);
        return $this->response->setJSON([
            'status'=>true,
            'message'=>'Sukses approve hasil survey'
        ]);
    }
    public function reject()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_hasil")->where('survey_hasil_peng_id', $id)->update([
            'survey_hasil_reject_is' => 'true',
            'survey_hasil_reject_at' => 'now()',
            'survey_hasil_reject_by' => $this->user['user_id'],
            'survey_hasil_approve_is' => 'false',
        ]);
        return $this->response->setJSON([
            'status'=>true,
            'message'=>'Sukses reject hasil survey'
        ]);
    }
}
