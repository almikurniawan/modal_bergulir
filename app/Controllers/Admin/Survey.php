<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;
use TCPDF;

class Survey extends BaseController
{

    public function index()
    {
        $data['grid']   = $this->grid_survey();
        $data['search'] = $this->search();
        $data['title']  = 'Survey';
        $data['url_delete']  = '';

        return view('admin/survey/list', $data);
    }

    public function grid_survey()
    {
        $SQL = "SELECT
                    *,
                    survey_id as id,
                    '<a href=\"" . base_url('admin/surveyHasil/index') . "/'||survey_id||'\" class=\"btn btn-primary btn-xs btn-raised\">Hasil Survey </a> <a target=\"_new\" href=\"" . base_url('admin/survey/jadwal') . "/'||survey_id||'\" class=\"btn btn-raised btn-success\">Surat Tugas</a> <button onclick=\"upload_cetak('||survey_id||')\" class=\"btn btn-success bmd-btn-fab-sm bmd-btn-fab\" title=\"Upload\"><i class=\"k-icon k-i-upload\"></i> </button> <a target=\"_new\" href=\"" . base_url('admin/cetakBI/index') . "/'||survey_id||'\" class=\"btn btn-raised btn-danger\">Cetak</a> <a target=\"_new\" href=\"" . base_url('admin/cetakFormSurvey/cetak') . "/'||survey_id||'\" class=\"btn btn-raised btn-success\">Cetak Form</a>' as action
                from survey";
        // die($SQL);
        $action['detail'] = ['link' => 'admin/survey/form/'];
        $grid = new Grid();
        return $grid->set_query($SQL, [
            ['survey_nomor', $this->request->getGet('nomor')],
            ['survey_tanggal', $this->request->getGet('tanggal'), '=']
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
                            'format' => 'date',
                        ),
                        array(
                            'field' => 'action',
                            'title' => 'Action',
                            'width' => 250,
                            'encoded' => false
                        ),
                    ),
                    "action"    => $action,
                    'head_left' => array('add' => base_url('/admin/survey/start'))
                )
            )
            ->set_label_add('Buat Jadwal Survey')
            ->set_sort(['id', 'desc'])
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
            ['member_nama_lengkap', $this->request->getGet('member')],
            ['peng_tanggal', $this->request->getGet('tanggal'), '='],
            ['peng_verif_is', 'true', 'is'],
            ['peng_surv_is', 'not true', 'is']
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
                            'encoded' => false
                        ),
                        array(
                            'field' => 'action',
                            'title' => 'Aksi',
                            'encoded' => false
                        )
                    ),
                )
            )
            ->set_sort(['status', 'desc'])
            ->output();
    }

    public function proses()
    {
        $peng_id = explode(",", $this->request->getGet('id'));
        $dataSurvey = array(
            'survey_created_by' => $this->user['user_id'],
            'survey_created_at' => date("Y-m-d H:i:s")
        );

        $this->db->table("survey")->insert($dataSurvey);
        $id = $this->db->insertId();

        foreach ($peng_id as $val) {
            $dataTempat = array(
                'survey_tem_head_id' => $id,
                'survey_tem_peng_id' => $val
            );
            $this->db->table("survey_tempat")->insert($dataTempat);
            $this->db->table("pengajuan")->where("peng_id", $val)->update([
                'peng_surv_is' => true,
                'peng_surv_id' => $id
            ]);
        }
        return redirect()->to(base_url("admin/survey/form/" . $id));
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
        $data = $this->db->table("survey")->getWhere(['survey_id' => $surv_id])->getRowArray();
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template_column(2)
            ->add('survey_nomor_lengkap', 'Nomor Surat', 'text', true, !empty($data) ? $data['survey_nomor_lengkap'] : '', 'style="width:100%;"')
            ->add('survey_dasar', 'Dasar', 'text', true, !empty($data) ? $data['survey_dasar'] : '', 'style="width:100%;"')
            ->add('survey_untuk', 'Untuk', 'text', true, !empty($data) ? $data['survey_untuk'] : '', 'style="width:100%;"')
            ->add('survey_keterangan', 'Keterangan', 'textArea', true, !empty($data) ? $data['survey_keterangan'] : '', 'style="width:100%;"')
            ->add('survey_tanggal', 'Tanggal', 'date', true, !empty($data) ? $data['survey_tanggal'] : '', 'style="width:100%;"')
            ->add('survey_kepala_dinas_ttd', 'Kepala Dinas', 'select', true, !empty($data) ? $data['survey_kepala_dinas_ttd'] : '', 'style="width:100%;"', [
                'table' => 'karyawan',
                'id' => 'kar_id',
                'label' => 'kar_nama'
            ])
            ->add('survey_ketua_teknis_ttd', 'Ketua Tim Teknis', 'select', true, !empty($data) ? $data['survey_ketua_teknis_ttd'] : '', 'style="width:100%;"', [
                'table' => 'karyawan',
                'id' => 'kar_id',
                'label' => 'kar_nama'
            ]);

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            if (!empty($data)) {
                try {
                    $this->db->table("survey")->where('survey_id', $surv_id)->update($dataForm);
                } catch (\Exception $e) {
                    echo $this->db->getLastQuery();
                    die($e->getMessage());
                }
            } else {
                $this->db->table("survey")->insert($dataForm);
            }
            return $form->output();
        } else {
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
            ["survey_tem_head_id", $surv_id, '=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_tempat/" . $surv_id . "?datasource&" . get_query_string()),
                    'gridReload' => 'gridReloadTempat()',
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
            ->set_sort(['id', 'desc'])
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
            ['survey_detail.survey_det_head_id', $surv_id, '=']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_petugas/" . $surv_id . "?datasource&" . get_query_string()),
                    'gridReload' => 'gridReloadPetugas()',
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
            ->set_sort(['id', 'desc'])
            ->output();
    }

    public function deleteTempat()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_tempat")->where('survey_tem_id', $id)->delete();
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Sukses delete lokasi survey'
        ]);
    }

    public function deletePetugas()
    {
        $id = $this->request->getPost('id');
        $this->db->table("survey_detail")->where('survey_det_id', $id)->delete();
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Sukses delete petugas survey'
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
            'status' => true,
            'message' => 'Sukses menambah lokasi'
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
        return $grid->set_query($SQL, [
            ['peng_surv_is', 'false', 'is'],
            ['peng_verif_is', 'true', 'is']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_lokasi_belum_survey/" . $surv_id . "?datasource&" . get_query_string()),
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
                            'encoded' => false
                        ),
                    ),
                )
            )
            ->set_sort(['id', 'desc'])
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
            'status' => true,
            'message' => 'Sukses menambah petugas'
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
            ['kar_id', '(select survey_det_kar_id from survey_detail where survey_detail.survey_det_head_id=' . $surv_id . ')', 'not in']
        ])
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/survey/grid_petugas_belum_survey/" . $surv_id . "?datasource&" . get_query_string()),
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
                            'encoded' => false
                        ),
                    ),
                )
            )
            ->set_sort(['id', 'desc'])
            ->output();
    }
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
        $data_survey = $this->db->table("survey")->join("karyawan", "kar_id=survey_kepala_dinas_ttd")->getWhere(['survey_id' => $jadwal_id])->getRowArray();
        $data_kepada = $this->db->query("select * from survey_detail left join karyawan on kar_id = survey_det_kar_id where survey_det_head_id=" . $jadwal_id)->getResultArray();

        $kepada = '';
        $nomor = 1;
        foreach ($data_kepada as $key => $value) {
            $kepada .= '<tr>
                            <td style="width: 3.45525%;">' . $nomor . '.</td>
                            <td style="width: 29.8781%;">Nama</td>
                            <td style="width: 66.6666%;">: ' . $value['kar_nama'] . '</td>
                            </tr>
                            <tr>
                            <td style="width: 3.45525%;">&nbsp;</td>
                            <td style="width: 29.8781%;">NIP</td>
                            <td style="width: 66.6666%;">: ' . $value['kar_nip'] . '</td>
                            </tr>
                            <tr>
                            <td style="width: 3.45525%;">&nbsp;</td>
                            <td style="width: 29.8781%;">Pangkat / Gol</td>
                            <td style="width: 66.6666%;">: ' . $value['kar_pangkat'] . '</td>
                            </tr>
                            <tr>
                            <td style="width: 3.45525%;">&nbsp;</td>
                            <td style="width: 29.8781%;">Jabatan</td>
                            <td style="width: 66.6666%;">: ' . $value['kar_jabatan'] . '</td>
                        </tr>';
            $nomor++;
        }

        $data_tempat = $this->db->query("select pengajuan.* from survey_tempat left join pengajuan on survey_tem_peng_id = peng_id where survey_tem_head_id=" . $jadwal_id)->getResultArray();
        $tempat = '';
        foreach ($data_tempat as $key => $value) {
            $nomor = 1;
            $tempat .= '<tr>
                            <td style="width: 4.2683%;">' . $nomor . '.</td>
                            <td style="width: 95.7317%;">' . $value['peng_prof_nama_usaha'] . '</td>
                            </tr>
                            <tr>
                            <td style="width: 4.2683%;">&nbsp;</td>
                            <td style="width: 95.7317%;">' . $value['peng_prof_alamat'] . '</td>
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
        <td>: </td>
        </tr>
        <tr>
        <td style="width: 50.3929%;">&nbsp;</td>
        <td style="width: 25%;">Tanggal </td>
        <td>: ' . date_format(date_create($data_survey['survey_created_at']), 'd F Y') . '</td>
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
        <td style="width: 20%; height: 18px; text-align: right;" rowspan="4"><img src="./assets/images/logo.svg" alt="Girl in a jacket" width="60"/></td>
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
        <td style="width: 100%; text-align: center;"><strong>NOMOR : ' . $data_survey['survey_nomor_lengkap'] . '</strong></td>
        </tr>
        </tbody>
        </table>
        <br />
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 13.6542%;">Dasar</td>
        <td style="width: 86.3458%;"> : ' . $data_survey['survey_dasar'] . '</td>
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
        ' . $kepada . '
        </tbody>
        </table>
        <p>&nbsp;</p>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        <tr>
        <td style="width: 18.2927%;">Untuk</td>
        <td style="width: 81.7073%;">: ' . $data_survey['survey_untuk'] . '</td>
        </tr>
        <tr>
        <td style="width: 18.2927%;">Waktu</td>
        <td style="width: 81.7073%;">: ' . date_format(date_create($data_survey['survey_tanggal']), 'd F Y') . '</td>
        </tr>
        <tr>
        <td style="width: 18.2927%;">Tempat</td>
        <td style="width: 81.7073%;">:</td>
        </tr>
        </tbody>
        </table>
        <table style="border-collapse: collapse; width: 100%;">
        <tbody>
        ' . $tempat . '
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
        <td style="width: 20.7317%; height: 18px;">: ' . date_format(date_create($data_survey['survey_created_at']), 'd F Y') . '</td>
        </tr>
        </tbody>
        </table>
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
        <td style="width: 50%; text-align: center;"><u>'.$data_survey['kar_nama'].'</u></td>
        </tr>
        <tr>
        <td style="width: 50%;">&nbsp;</td>
        <td style="width: 50%; text-align: center;">'.$data_survey['kar_pangkat'].'
        </td>
        </tr>
        <tr>
        <td style="width: 50%;">&nbsp;</td>
        <td style="width: 50%; text-align: center;">NIP.'.$data_survey['kar_nip'].'
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
    public function upload_cetakan($id)
    {
        $data['title']  = 'Upload Bertanda tangan';
        $data['form']   = $this->form_upload_cetakan($id);
        $data['url_back'] = base_url('admin');
        return view('global/form_pop', $data);
    }
    public function form_upload_cetakan($id)
    {
        $data = $this->db->table('survey')->getWhere(['survey_id' => $id])->getRowArray();

        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->add('survey_surat_tugas_ttd', 'Surat tugas bertanda tangan', 'file', false, empty($data['survey_surat_tugas_ttd']) ? '' : base_url() . '/uploads/' . $data['survey_surat_tugas_ttd'], 'style="width:100%;"')
            ->add('survey_cetak_ttd', 'Cetak bertanda tangan', 'file', false, empty($data['survey_cetak_ttd']) ? '' : base_url() . '/uploads/' . $data['survey_cetak_ttd'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('survey_surat_tugas_ttd');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['survey_surat_tugas_ttd'] = $name;
                }
            }
            $file = $this->request->getFile('survey_cetak_ttd');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['survey_cetak_ttd'] = $name;
                }
            }
            $this->db->table("survey")->where('survey_id', $id)->update($dataForm);
            die('<script>window.close();</script>');
        } else {
            return $form->output();
        }
    }
}
