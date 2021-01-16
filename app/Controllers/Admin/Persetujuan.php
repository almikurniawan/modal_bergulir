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
        $data['url_buka_kunci']  = base_url('admin/persetujuan/bukaKunci');
        $data['url_kunci']  = base_url('admin/persetujuan/kunci');

        return view('admin/persetujuan/list', $data);
    }

    public function grid_persetujuan()
    {
        $SQL = "SELECT
                *,
                survey_tem_id as id,
                '<a href=\"" . base_url('admin/CetakSPPK/index') . "/'||peng_id||'\" target=\"_new\" class=\"btn btn-primary btn-raised\" title=\"Lihat\">Cetak SPPK</a> 
                <button onclick=\"upload_cetak('||peng_id||')\" class=\"btn btn-success bmd-btn-fab-sm bmd-btn-fab\" title=\"Upload\"><i class=\"k-icon k-i-upload\"></i> </button>
                <a href=\"" . base_url('admin/CetakAngsuran/cetak') . "/'||peng_id||'\" target=\"_new\" class=\"btn btn-primary btn-raised\" title=\"Lihat\">Cetak Angsuran</a> 
                <a href=\"" . base_url('admin/persetujuan/form') . "/'||peng_id||'\" class=\"btn btn-primary bmd-btn-fab-sm bmd-btn-fab\" title=\"Lihat\"><i class=\"k-icon k-i-preview m-2\"></i> </a>' as lihat,
                case when peng_disetujui_nominal is not null then '<span class=\"badge badge-success\">Disetujui</span>' when peng_disetujui_kunci_is is true then '<span class=\"badge badge-success\">Terkunci</span>' when peng_disetujui_kunci_is is false then '<span class=\"badge badge-danger\">Belum dikunci</span>' end as status,
                case 
                when peng_disetujui_kunci_is is true then '<button onclick=\"persetujuan_buka_kunci('||peng_id||')\" class=\"btn btn-danger bmd-btn-fab-sm bmd-btn-fab\" title=\"Buka Kunci\"><i class=\"k-icon k-i-unlock\"></i> </button>'
                else '<button onclick=\"persetujuan_kunci('||peng_id||')\" class=\"btn btn-success bmd-btn-fab-sm bmd-btn-fab\" title=\"Kunci\"><i class=\"k-icon k-i-lock\"></i> </button>' end as kunci
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
                            'field' => 'peng_disetujui_nominal',
                            'title' => 'Pinjaman Disetujui',
                            'format' => 'number',
                            'align' => 'right'
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
                        array(
                            'field' => 'lihat',
                            'title' => ' ',
                            'encoded' => false,
                            'width' => 250
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

        $data['form']   .= $this->grid_angsuran($peng_id);

        $data['url_back']   = base_url("admin/persetujuan");
        $data['title']  = 'Persetujuan <b>' . strtoupper($data['peng_prof_nama_usaha']) . '</b>';
        return view('global/form', $data);
    }

    public function form_pengajuan($peng_id)
    {

        $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $peng_id])->getRowArray();
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_resume(true)
            ->set_template_column(2)
            ->add('peng_nominal', 'Pengajuan Nominal', 'number', false, !empty($data) ? $data['peng_nominal'] : '', 'style="width:100%;"')->set_resume($data['peng_disetujui_kunci_is'] == "t" ? true : false)
            ->add('peng_disetujui_no_penetapan', 'Nomor Penetapan', 'text', true, !empty($data) ? $data['peng_disetujui_no_penetapan'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_nominal', 'Nominal Disetujui', 'number', false, ($data['peng_disetujui_nominal'] != '') ? $data['peng_disetujui_nominal'] : $data['peng_nominal'], 'style="width:100%;"')
            // ->add('peng_disetujui_cicilan', 'Cicilan', 'number', false, !empty($data) ? $data['peng_disetujui_cicilan'] : '', 'style="width:100%;"')
            // ->add('peng_disetujui_jangka_waktu_bln', 'Jangka waktu Bulan', 'number', false, !empty($data) ? $data['peng_disetujui_jangka_waktu_bln'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_jangka_waktu_bln', 'Pengambilan Waktu (Bulan)', 'number', false, ($data['peng_disetujui_jangka_waktu_bln'] == '') ? 36 : $data['peng_disetujui_jangka_waktu_bln'], 'style="width:100%;" readonly')
            ->add('peng_disetujui_jangka_waktu_text', 'Jangka waktu keternangan', 'text', false, !empty($data) ? $data['peng_disetujui_jangka_waktu_text'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_bank', 'Bank Pelaksana', 'select', true, !empty($data) ? $data['peng_disetujui_bank'] : '', ' style="width:100%;"', array(
                'table' => 'ref_bank',
                'id' => 'ref_bank_id',
                'label' => 'ref_bank_label',
            ))
            ->add('peng_disetujui_tanggal_penetapan', 'Tanggal penetapan', 'date', true, !empty($data) ? $data['peng_disetujui_tanggal_penetapan'] : '', 'style="width:100%;"')
            ->add('peng_disetujui_tanggal_jatuh_tempo', 'Tanggal Jatuh Tempo', 'date', true, !empty($data) ? $data['peng_disetujui_tanggal_jatuh_tempo'] : '', 'style="width:100%;"')
            ->add('peng_kepala_dinas_ttd', 'Kepala Dinas', 'select', true, !empty($data) ? $data['peng_kepala_dinas_ttd'] : '', 'style="width:100%;"', [
                'table'=> 'karyawan',
                'id'=> 'kar_id',
                'label'=> 'kar_nama'
            ]);
            

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            unset($dataForm['peng_nominal']);
            if (!empty($data)) {
                $this->db->table("pengajuan")->where('peng_id', $peng_id)->update($dataForm);
                $this->db->table("pembayaran")->where('pembayaran_peng_id', $peng_id)->delete();
                $bunga = !empty($data['peng_srt_bunga']) ? $data['peng_srt_bunga'] : 2;
                $bulan = $this->request->getPost('peng_disetujui_jangka_waktu_bln');

                $nominal    = $this->request->getPost('peng_disetujui_nominal');
                $lama_tahun = floor($bulan / 12);
                $jumlah_cicilan = ($bulan - $lama_tahun);
                $cicilan    = $nominal / $jumlah_cicilan;
                die($cicilan);
                $sisa_cicilan = $nominal;
                $result     = array();
                for ($i = 1; $i <= $bulan; $i++) {
                    $jatuh_tempo = $this->request->getPost('peng_disetujui_tanggal_jatuh_tempo');
                    if ($i == 1) {
                        $date = $jatuh_tempo;
                    } else {
                        $date = date("Y-m-d", strtotime(($i-1) . " month", strtotime($jatuh_tempo)));
                    }

                    $row = array();
                    $uniq = $i - 1;
                    if ($uniq % 12 == 0 || $i == 1) {
                        $row['type'] = "Bunga";
                        $row['nominal'] = $sisa_cicilan * ($bunga / 100);
                        try {
                            //code...
                            $this->db->table("pembayaran")->insert([
                                'pembayaran_penetapan_no' => $dataForm['peng_disetujui_no_penetapan'],
                                'pembayaran_peng_id' => $peng_id,
                                'pembayaran_ke' => $i,
                                'pembayaran_bunga' => $sisa_cicilan * ($bunga / 100),
                                'pembayaran_tanggal' => $date,
                                'pembayaran_sisa' => $nominal
                            ]);
                        } catch (\Exception $e) {
                            echo $this->db->getLastQuery();
                            die($e->getMessage());
                        }
                    } else {
                        $row['type'] = "Cicilan";
                        $row['nominal'] = $cicilan;
                        try {
                            //code...
                            $this->db->table("pembayaran")->insert([
                                'pembayaran_penetapan_no' => $dataForm['peng_disetujui_no_penetapan'],
                                'pembayaran_peng_id' => $peng_id,
                                'pembayaran_ke' => $i,
                                'pembayaran_cicilan' => $cicilan,
                                'pembayaran_tanggal' => $date,
                                'pembayaran_sisa' => $sisa_cicilan
                            ]);
                        } catch (\Exception $e) {
                            echo $this->db->getLastQuery();
                            die($e->getMessage());
                        }
                        $sisa_cicilan -= $cicilan;
                    }
                }
                // die();
            }
            return $form->output();
        } else {
            return $form->output();
        }
    }
    public function kunci()
    {
        $id = $this->request->getPost('id');
        $this->db->table("pengajuan")->where('peng_id', $id)->update([
            'peng_disetujui_kunci_is' => 'true',
            'peng_disetujui_kunci_at' => 'now()',
            'peng_disetujui_kunci_by' => $this->user['user_id']
        ]);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Sukses kunci hasil survey'
        ]);
    }
    public function bukaKunci()
    {
        $id = $this->request->getPost('id');
        $this->db->table("pengajuan")->where('peng_id', $id)->update([
            'peng_disetujui_kunci_is' => 'false',
            'peng_disetujui_kunci_at' => 'now()',
            'peng_disetujui_kunci_by' => $this->user['user_id'],
        ]);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Sukses buka kunci hasil survey'
        ]);
    }
    public function grid_angsuran($peng_id)
    {
        $SQL = "SELECT
                *,
                pembayaran_id as id,
                case when pembayaran_lunas_is is true then '<span class=\"badge badge-success\">Lunas</span> <br/>Tanggal <b>'||to_char(pembayaran_lunas_tanggal, 'DD Month YYYY')||'</b>' else '<span class=\"badge badge-warning\">-</span>' end as status
                from pembayaran";
        // die($SQL);
        $action['detail'] = ['link' => 'admin/surveyHasil/form/'];
        $grid = new Grid();
        return $grid->set_query($SQL, [
            ['pembayaran_peng_id', $peng_id, '='],
            // ['survey_tanggal', $this->request->getGet('tanggal'),'=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/pembayaran/grid_angsuran/" . $peng_id . "?datasource&" . get_query_string()),
                    'pageSize'=> 200,
                    'grid_columns'  => array(
                        array(
                            'field' => 'pembayaran_tanggal',
                            'title' => 'Tanggal',
                            'format' => 'date'
                        ),
                        array(
                            'field' => 'pembayaran_ke',
                            'title' => 'Ke',
                        ),
                        array(
                            'field' => 'pembayaran_cicilan',
                            'title' => 'Angsuran pokok',
                            'format' => 'number',
                            'align' => 'right',
                            'width' => 200
                        ),
                        array(
                            'field' => 'pembayaran_bunga',
                            'title' => 'Angsuran bunga',
                            'format' => 'number',
                            'align' => 'right',
                            'width' => 200
                        ),
                        array(
                            'field' => 'status',
                            'title' => 'Status',
                            'encoded' => false,
                            'width' => 250
                        )
                    ),
                )
            )
            ->set_toolbar(function($tb){
                $tb->add('download');
            })
            ->set_sort(['pembayaran_ke', 'asc'])
            ->output();
    }
    public function upload_cetakan($id)
    {
        $data['title']  = 'Upload Bertanda tangan';
        $data['form']   = $this->form_upload_cetakan($id);
        $data['url_back'] = base_url('admin');
        return view('global/form_pop', $data);
    }
    public function form_upload_cetakan($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();

        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->add('peng_disetujui_cetak_sppk', 'Cetakan SPPK bertanda tangan', 'file', false, empty($data['peng_disetujui_cetak_sppk']) ? '' : base_url() . '/uploads/' . $data['peng_disetujui_cetak_sppk'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_disetujui_cetak_sppk');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_disetujui_cetak_sppk'] = $name;
                }
            }
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die('<script>window.close();</script>');
        } else {
            return $form->output();
        }
    }
}
