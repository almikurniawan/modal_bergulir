<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class Survey extends BaseController
{

    public function index()
    {
        $data['grid']   = $this->grid_survey();
        $data['search'] = $this->search();
        $data['title']  = 'Survey';
        $data['url_delete']  = '';

        return view('global/list', $data);
    }

    public function grid_survey()
    {
        $SQL = "SELECT
                    *,
                    survey_id as id
                from survey";
        $action['detail'] = ['link'=> 'admin/survey/form/'];
        $grid = new Grid();
        return $grid->set_query($SQL,[
            ['survey_nomor', $this->request->getGet('nomor')],
            ['survey_tanggal', $this->request->getGet('tanggal'),'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_survey?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'survey_nomor_lengkap',
                            'title' => 'Nomor Surat',
                        ),
                        array(
                            'field' => 'survey_dasar',
                            'title' => 'Dasar',
                        ),
                        array(
                            'field' => 'survey_untuk',
                            'title' => 'Untuk',
                        ),
                        array(
                            'field' => 'survey_tanggal',
                            'title' => 'Tanggal',
                            'format'=> 'date',
                        ),
                    ),
                    "action"    => $action,
                    'head_left' => array('add' => base_url('/admin/survey/start'))
                )
            )
            ->set_sort(['id','desc'])
            ->output();
    }

    public function start()
    {
        $data['grid']   = $this->grid();
        $data['search'] = '';
        $data['title']  = 'Form Survey';

        return view('admin/survey/list', $data);
    }
    public function search()
    {
        $form = new Form();
        return $form->set_form_type('search')
            ->set_form_method('GET')
            ->set_submit_label('Cari')
            ->add('nomor', 'Nomor', 'text', false, $this->request->getGet('nomor'), 'style="width:100%;" ')
            ->add('tanggal', 'Tanggal', 'date', false, $this->request->getGet('tanggal'), 'style="width:100%;" ')
            ->output();
    }

    public function grid()
    {
        $SQL = "SELECT
                    peng_nominal,
                    member_nama_lengkap,
                    jns_pengajuan_label,
                    peng_tanggal,
                    case when peng_verif_reject_is is true then '<span class=\"badge badge-danger\">Rejected</span>' when peng_verif_is is true then '<span class=\"badge badge-success\">Verified</span>' else '<span class=\"badge badge-warning\">Waiting</span>' end as status,
                    '<input value=\"'||peng_id||'\" name=\"peng[]\" type=\"checkbox\" style=\"width:25px; height:25px;\"/>' as action,
                    peng_id AS ID 
                FROM
                    pengajuan
                    left join member on member_id = peng_member_id
                    left join ref_jenis_pengajuan on ref_jenis_pengajuan.jns_pengajuan_id = peng_jenis_pengajuan";

        $filter = array(
            ['member_nama_lengkap',$this->request->getGet('member')],
            ['peng_tanggal',$this->request->getGet('tanggal'),'='],
            ['peng_verif_is','true','is'],
            ['peng_surv_is','false','is']
        );

        $grid = new Grid();
        return $grid->set_query($SQL, $filter)
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid?datasource&" . get_query_string()),
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
                            'format'=> 'date'
                        ),
                        array(
                            'field' => 'peng_nominal',
                            'title' => 'Jumlah Pinjaman',
                            'format'=> 'number',
                            'align' => 'right'
                        ),
                        array(
                            'field' => 'status',
                            'title' => 'Status',
                            'encoded'=> false
                        ),
                        array(
                            'field' => 'action',
                            'title' => 'Aksi',
                            'encoded'=> false
                        )
                    ),
                )
            )
            ->set_sort(['status','desc'])
            ->output();
    }

    public function proses()
    {
        $peng_id = explode(",",$this->request->getGet('id'));
        $dataSurvey = array(
            'survey_created_by'=> $this->user['user_id'],
            'survey_created_at'=> date("Y-m-d H:i:s")
        );

        $this->db->table("survey")->insert($dataSurvey);
        $id = $this->db->insertId();

        foreach($peng_id as $val){
            $dataTempat = array(
                'survey_tem_head_id'=> $id,
                'survey_tem_peng_id'=> $val
            );
            $this->db->table("survey_tempat")->insert($dataTempat);
            $this->db->table("pengajuan")->where("peng_id", $val)->update([
                'peng_surv_is'=> true,
                'peng_surv_id'=> $id
            ]);
        }
        return redirect()->to(base_url("admin/survey/form/".$id));
    }

    public function form($surv_id)
    {
        $data['form']   = $this->form_survey($surv_id);
        $data['grid_tempat']   = $this->grid_tempat($surv_id);
        $data['grid_petugas']   = $this->grid_petugas($surv_id);
        $data['url_back']   = base_url("admin/survey");
        $data['title']  = 'Survey Form';
        $data['id'] = $surv_id;

        return view('admin/survey/start', $data);
    }

    public function form_survey($surv_id)
    {
        $data = $this->db->table("survey")->getWhere(['survey_id'=> $surv_id])->getRowArray();
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->add('survey_dasar', 'Dasar', 'text', true, !empty($data) ? $data['survey_dasar'] : '', 'style="width:100%;"')
            ->add('survey_untuk', 'Untuk', 'text', true, !empty($data) ? $data['survey_untuk'] : '', 'style="width:100%;"')
            ->add('survey_keterangan', 'Keterangan', 'textArea', true, !empty($data) ? $data['survey_keterangan'] : '', 'style="width:100%;"')
            ->add('survey_tanggal', 'Tanggal', 'date', true, !empty($data) ? $data['survey_tanggal'] : '', 'style="width:100%;"')
            ;

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            if(!empty($data)){
                $this->db->table("survey")->where('survey_id', $surv_id)->update($dataForm);
            }else{
                $this->db->table("survey")->insert($dataForm);
            }
            return $form->output();
        }else{
            return $form->output();
        }
    }
    
    public function grid_tempat($surv_id)
    {
        $SQL = "SELECT
                    peng_prof_alamat,
                    peng_prof_nama_usaha,
                    survey_tem_id as id
                FROM
                    survey_tempat
                    left join pengajuan on survey_tempat.survey_tem_peng_id = peng_id";
        $action['delete']     = array(
            'jsf'          => 'deleteTempat'
        );
        $grid = new Grid();
        return $grid->set_query($SQL, [
            ["survey_tem_head_id",$surv_id,'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_tempat/".$surv_id."?datasource&" . get_query_string()),
                    'gridReload'=>'gridReloadTempat()',
                    'grid_columns'  => array(
                        array(
                            'field' => 'peng_prof_nama_usaha',
                            'title' => 'Nama Tempat',
                        ),
                        array(
                            'field' => 'peng_prof_alamat',
                            'title' => 'Alamat',
                        ),
                    ),
                    'action'    => $action,
                )
            )
            ->set_sort(['id','desc'])
            ->output();
    }

    public function grid_petugas($surv_id)
    {
        $SQL = "SELECT
                    *,
                    survey_det_id as id
                FROM
                    survey_detail
                    LEFT JOIN karyawan ON kar_id = survey_det_kar_id";
        $action['delete']     = array(
            'jsf'          => 'deletePetugas'
        );
        $grid = new Grid();
        return $grid->set_query($SQL, [
            ['survey_detail.survey_det_head_id',$surv_id,'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_petugas/".$surv_id."?datasource&" . get_query_string()),
                    'gridReload'=>'gridReloadPetugas()',
                    'grid_columns'  => array(
                        array(
                            'field' => 'kar_nama',
                            'title' => 'Karyawan',
                        ),
                        array(
                            'field' => 'kar_nip',
                            'title' => 'NIP',
                        ),
                        array(
                            'field' => 'kar_pangkat',
                            'title' => 'Pangkat',
                        ),
                        array(
                            'field' => 'kar_jabatan',
                            'title' => 'Jabatan',
                        ),
                    ),
                    'action'    => $action,
                )
            )
            ->set_sort(['id','desc'])
            ->output();
    }

    public function deleteTempat()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_tempat")->where('survey_tem_id', $id)->delete();
        return $this->response->setJSON([
            'status'=>true,
            'message'=>'Sukses delete lokasi survey'
        ]);
    }

    public function deletePetugas()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_detail")->where('survey_det_id', $id)->delete();
        return $this->response->setJSON([
            'status'=>true,
            'message'=>'Sukses delete petugas survey'
        ]);
    }

    public function add_lokasi($surv_id)
    {
        $data['grid'] = $this->grid_lokasi_belum_survey($surv_id);
        $data['title'] = 'Pilih Lokasi';
        $data['id'] = $surv_id;
        return view('admin/survey/add_tempat', $data);
    }

    public function proses_add_lokasi($surv_id)
    {
        $peng_id = $this->request->getPost('id');
        $this->db->table("survey_tempat")->insert([
            'survey_tem_head_id' => $surv_id,
            'survey_tem_peng_id' => $peng_id
        ]);
        $this->db->table("pengajuan")->where('peng_id', $peng_id)->update([
            'peng_surv_is' => true,
            'peng_surv_id' => $surv_id
        ]);
        return $this->response->setJSON([
            'status'=> true,
            'message'=> 'Sukses menambah lokasi'
        ]);
    }

    public function grid_lokasi_belum_survey($surv_id)
    {
        $SQL = "SELECT
                    peng_prof_alamat,
                    peng_prof_nama_usaha,
                    peng_id as id,
                    '<button onclick=\"pilih('||peng_id||')\" class=\"btn btn-sm btn-raised btn-success\"><i class=\"k-icon k-i-check\"></i> Pilih</button>' as action
                FROM
                    pengajuan";
        $grid = new Grid();
        return $grid->set_query($SQL,[
            ['peng_surv_is','false','is'],
            ['peng_verif_is','true','is']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_lokasi_belum_survey/".$surv_id."?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'peng_prof_nama_usaha',
                            'title' => 'Nama Tempat',
                        ),
                        array(
                            'field' => 'peng_prof_alamat',
                            'title' => 'Alamat',
                        ),
                        array(
                            'field' => 'action',
                            'title' => 'Action',
                            'width' => 100,
                            'encoded'=> false
                        ),
                    ),
                )
            )
            ->set_sort(['id','desc'])
            ->output();
    }

    public function add_perugas($surv_id)
    {
        $data['grid'] = $this->grid_petugas_belum_survey($surv_id);
        $data['title'] = 'Pilih Petugas';
        $data['id'] = $surv_id;
        return view('admin/survey/add_petugas', $data);
    }

    public function proses_add_petugas($surv_id)
    {
        $kar_id = $this->request->getPost('id');
        $this->db->table("survey_detail")->insert([
            'survey_det_head_id' => $surv_id,
            'survey_det_kar_id' => $kar_id
        ]);
        return $this->response->setJSON([
            'status'=> true,
            'message'=> 'Sukses menambah petugas'
        ]);
    }

    public function grid_petugas_belum_survey($surv_id)
    {
        $SQL = "SELECT
                    *,
                    kar_id as id,
                    '<button onclick=\"pilih('||kar_id||')\" class=\"btn btn-sm btn-raised btn-success\"><i class=\"k-icon k-i-check\"></i> Pilih</button>' as action
                from
                    karyawan";
        $action['delete']     = array(
            'jsf'          => 'deletePetugas'
        );
        $grid = new Grid();
        return $grid->set_query($SQL, [
            ['kar_id','(select survey_det_kar_id from survey_detail where survey_detail.survey_det_head_id='.$surv_id.')','not in']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_petugas_belum_survey/".$surv_id."?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'kar_nama',
                            'title' => 'Karyawan',
                        ),
                        array(
                            'field' => 'kar_nip',
                            'title' => 'NIP',
                        ),
                        array(
                            'field' => 'kar_pangkat',
                            'title' => 'Pangkat',
                        ),
                        array(
                            'field' => 'kar_jabatan',
                            'title' => 'Jabatan',
                        ),
                        array(
                            'field' => 'action',
                            'title' => 'Action',
                            'width' => 100,
                            'encoded'=> false
                        ),
                    ),
                )
            )
            ->set_sort(['id','desc'])
            ->output();
    }
}