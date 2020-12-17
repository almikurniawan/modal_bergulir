<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class SurveyHasil extends BaseController
{

    public function index($id)
    {
        $data['grid']   = $this->grid_survey_hasil($id);
        $data['search'] = '';
        $data['title']  = 'Survey Hasil';
        $data['url_delete']  = '';
        $data['url_kunci']  = base_url('admin/surveyHasil/kunci');
        $data['url_buka_kunci']  = base_url('admin/surveyHasil/bukaKunci');

        return view('admin/surveyhasil/list', $data);
    }

    public function grid_survey_hasil($id)
    {
        $SQL = "SELECT
                *,
                survey_tem_id as id,
                '<a href=\"" . base_url('admin/surveyHasil/form') . "/" . $id . "/'||peng_id||'\" class=\"btn btn-primary btn-xs btn-raised\">Buat Hasil</a> ' as action,
                case when survey_hasil_lock_is is true then '<button onclick=\"surveyHasil_buka_kunci('||survey_hasil_id||')\" class=\"btn btn-danger bmd-btn-fab-sm bmd-btn-fab\" title=\"Buka Kunci\"><i class=\"k-icon k-i-unlock\"></i> </button>' else '<button onclick=\"surveyHasil_kunci('||survey_hasil_id||')\" class=\"btn btn-success bmd-btn-fab-sm bmd-btn-fab\" title=\"Kunci\"><i class=\"k-icon k-i-lock\"></i> </button>' end as kunci,
                case 
                    when survey_hasil_reject_is is true then '<span class=\"badge badge-danger\">Rejected</span>' 
                    when survey_hasil_approve_is is true then '<span class=\"badge badge-success\">Approved</span>' 
                    when survey_hasil_lock_is is true then '<span class=\"badge badge-success\">Terkunci</span>' 
                    when survey_hasil_lock_is is false then '<span class=\"badge badge-danger\">Belum Dikunci</span>' 
                    else '<span class=\"badge badge-warning\">-</span>' end as status
                from survey_tempat
                left join survey_hasil on survey_tem_head_id = survey_hasil_survey_id and survey_tem_peng_id = survey_hasil_peng_id
                left join pengajuan on peng_id = survey_tem_peng_id
                left join member on member_id = peng_member_id
                left join ref_jenis_pengajuan on ref_jenis_pengajuan.jns_pengajuan_id = peng_jenis_pengajuan
                where survey_tempat.survey_tem_head_id = " . $id . " ";
        // die($SQL);
        $action['detail'] = ['link' => 'admin/surveyHasil/form/'];
        $grid = new Grid();
        return $grid->set_query($SQL, [
            // ['survey_nomor', $this->request->getGet('nomor')],
            // ['survey_tanggal', $this->request->getGet('tanggal'),'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/surveyHasil/grid_survey_hasil/" . $id . "?datasource&" . get_query_string()),
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
                            'field' => 'action',
                            'title' => 'Action',
                            'encoded' => false,
                            'width' => 200
                        ),
                        array(
                            'field' => 'kunci',
                            'title' => 'Kunci/Buka Kunci',
                            'encoded' => false,
                            'width' => 200
                        ),
                        array(
                            'field' => 'status',
                            'title' => 'Status',
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
        $data['grid_tempat']   = '$this->grid_tempat($peng_id)';
        $data['grid_petugas']   = '$this->grid_petugas($peng_id)';
        $data['url_back']   = base_url("admin/surveyHasil/index/" . $id);
        $data['title']  = 'Survey Hasil <b>' . strtoupper($data['peng_prof_nama_usaha']) . '</b>';
        $data['id'] = $peng_id;

        return view('global/form', $data);
    }

    public function head(Type $var = null)
    {
        # code...
    }

    public function form_survey($id, $peng_id)
    {

        $data = $this->db->table("survey_hasil")->getWhere(['survey_hasil_peng_id' => $peng_id])->getRowArray();
        // print_r($data);die();
        $dataHasil = array(
            'survey_hasil_survey_id' => $id,
            'survey_hasil_peng_id' => $peng_id,
            'survey_hasil_created_at' => 'now()'
        );
        if (!empty($data)) {
            $this->db->table("survey_hasil")->where('survey_hasil_peng_id', $peng_id)->update($dataHasil);
        } else {
            $this->db->table("survey_hasil")->insert($dataHasil);
            $data = $this->db->table("survey_hasil")->getWhere(['survey_hasil_peng_id' => $peng_id])->getRowArray();
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')->set_resume(($data['survey_hasil_lock_is'] == "t" ? true : false))->set_template_column(2)
            ->add('survey_hasil_1_perijinan', 'Perijinan yang dimiliki', 'text', FALSE, !empty($data) ? $data['survey_hasil_1_perijinan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_nilai_kes_usp', 'Penilaian Kesehatan USP', 'text', FALSE, !empty($data) ? $data['survey_hasil_1_nilai_kes_usp'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_rat', 'Pelaksanaan RAT', 'text', FALSE, !empty($data) ? $data['survey_hasil_1_rat'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_jml_angg_produktif', 'Jumlah Anggota Produktif', 'number', FALSE, !empty($data) ? $data['survey_hasil_1_jml_angg_produktif'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_jml_angg', 'Jumlah Anggota Total', 'number', FALSE, !empty($data) ? $data['survey_hasil_1_jml_angg'] : '', 'style="width:100%;"')
            ->add('survey_hasil_1_status', 'Status tempat Usaha', 'text', FALSE, !empty($data) ? $data['survey_hasil_1_status'] : '', 'style="width:100%;"')
            ->add('survey_hasil_2_modal_sendiri', 'Modal sendiri', 'number', FALSE, !empty($data) ? $data['survey_hasil_2_modal_sendiri'] : '', 'style="width:100%;"')
            ->add('survey_hasil_2_modal_luar', 'Modal luar', 'number', FALSE, !empty($data) ? $data['survey_hasil_2_modal_luar'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_usaha', 'Usaha yang dilaksanakan', 'text', FALSE, !empty($data) ? $data['survey_hasil_3_usaha'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_omset_per_tahun', 'Omset per tahun', 'number', FALSE, !empty($data) ? $data['survey_hasil_3_omset_per_tahun'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_pendptn_per_tahun', 'Pendapatan per tahun', 'number', FALSE, !empty($data) ? $data['survey_hasil_3_pendptn_per_tahun'] : '', 'style="width:100%;"')
            ->add('survey_hasil_3_beban_operasional', 'Beban operasional', 'number', FALSE, !empty($data) ? $data['survey_hasil_3_beban_operasional'] : '', 'style="width:100%;"')
            ->add('survey_hasil_4_kas_per_bulan', 'Penerimaan Kas Per bulan', 'number', FALSE, !empty($data) ? $data['survey_hasil_4_kas_per_bulan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_4_pengeluaran', 'Pengeluaran', 'number', FALSE, !empty($data) ? $data['survey_hasil_4_pengeluaran'] : '', 'style="width:100%;"')
            ->add('survey_hasil_5_jaminan', 'Jaminan yang diajukan', 'text', FALSE, !empty($data) ? $data['survey_hasil_5_jaminan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_5_taksiran_harga', 'Taksiran harga', 'number', FALSE, !empty($data) ? $data['survey_hasil_5_taksiran_harga'] : '', 'style="width:100%;"')
            ->add('survey_hasil_5_status_jaminan', 'Status Jaminan', 'text', FALSE, !empty($data) ? $data['survey_hasil_5_status_jaminan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_6_kelangsungan_hidup', 'Aspek kelangsungan hidup', 'text', FALSE, !empty($data) ? $data['survey_hasil_6_kelangsungan_hidup'] : '', 'style="width:100%;"')
            ->add('survey_hasil_permasalahan', 'PERMASALAHAN', 'text', FALSE, !empty($data) ? $data['survey_hasil_permasalahan'] : '', 'style="width:100%;"')
            ->add('survey_hasil_file', 'File', 'file', FALSE, !empty($data) ? base_url().'/uploads/'.$data['survey_hasil_file'] : base_url().'/uploads/'.$data['survey_hasil_file'], 'style="width:100%;"');

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('survey_hasil_file');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['survey_hasil_file'] = $name;
                }
            }
            if (!empty($data)) {
                $this->db->table("survey_hasil")->where('survey_hasil_peng_id', $peng_id)->update($dataForm);
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
            'survey_hasil_reject_is' => 'false'
        ]);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Sukses kunci hasil survey'
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
            'status' => true,
            'message' => 'Sukses buka kunci hasil survey'
        ]);
    }
}
