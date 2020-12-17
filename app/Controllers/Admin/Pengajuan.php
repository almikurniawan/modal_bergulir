<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;
use App\Libraries\SmartComponent\ListView;

class Pengajuan extends BaseController
{
    public function index()
    {
        $data['grid']   = $this->grid();
        $data['search'] = $this->search();
        $data['title']  = 'List Pengajuan';
        $data['url_delete']  = base_url("admin/pengajuan/delete");

        return view('admin/pengajuan/list', $data);
    }

    public function grid()
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
                    '<button onclick=\"upload_cetak('||peng_id||')\" class=\"btn btn-success bmd-btn-fab-sm bmd-btn-fab\" title=\"Upload\"><i class=\"k-icon k-i-upload\"></i> </button>' as btn_upload,
                    peng_id AS ID 
                FROM
                    pengajuan
                    left join member on member_id = peng_member_id
                    left join ref_jenis_pengajuan on ref_jenis_pengajuan.jns_pengajuan_id = peng_jenis_pengajuan
                    left join survey_hasil on peng_id = survey_hasil_peng_id";
        $filter = array(
            ['member_nama_lengkap', $this->request->getGet('member')],
            ['peng_tanggal', $this->request->getGet('tanggal'), '=']
        );

        if ($this->user['user_member_id']) {
            $filter[] = ['peng_member_id', $this->user['user_member_id'], '='];
        }

        $action['detail']     = array(
            'link'          => 'admin/pengajuan/detail/'
        );

        $grid = new Grid();
        return $grid->set_query($SQL, $filter)
            ->set_sort(array('id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/pengajuan/grid?datasource&" . get_query_string()),
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
                            'field' => 'btn_upload',
                            'title' => ' ',
                            'encoded' => false,
                            'width' => 150
                        ),
                    ),
                    'action'    => $action,
                    'head_left'        => array('add' => base_url('/admin/pengajuan/pilihPaket'))
                )
            )
            ->set_label_add('Buat Pengajuan')
            ->output();
    }

    public function search()
    {
        $form = new Form();
        return $form->set_form_type('search')
            ->set_form_method('GET')
            ->set_submit_label('Cari')
            ->add('member', 'Pengaju', 'text', false, $this->request->getGet('member'), 'style="width:100%;" ')
            ->add('tanggal', 'Tanggal', 'date', false, $this->request->getGet('tanggal'), 'style="width:100%;" ')
            ->output();
    }

    public function pilihPaket()
    {
        $data['title']  = 'Buat Pengajuan';
        $data['form']   = $this->formPilihPaket();
        $data['url_back']   = base_url("admin/pengajuan");

        return view('global/form', $data);
    }

    public function detail($id)
    {
        $data['title']  = 'Detail Pengajuan';
        $data['form']   = $this->stepper_form($id);
        $data['url_back']   = base_url("admin/pengajuan");

        return view('global/form', $data);
    }

    public function stepper_form($id)
    {
        $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($data['peng_jenis_pengajuan'] == 1) {
            $stepper = 'admin/pengajuan/stepper_form';
        } else if ($data['peng_jenis_pengajuan'] == 2) {
            $stepper = 'admin/pengajuan/stepper_form_jenis_2';
        } else {
            $stepper = 'admin/pengajuan/stepper_form_jenis_3';
        }

        if ($this->request->getGet('step') == 2) {
            $data['form'] = $this->formStep2($id);
        } else if ($this->request->getGet('step') == 3) {
            $data['form'] = $this->formStep3($id);
        } else if ($this->request->getGet('step') == 4) {
            $data['form'] = $this->formStep4($id);
        } else if ($this->request->getGet('step') == 5) {
            $data['form'] = $this->formStep5($id);
        } else if ($this->request->getGet('step') == 6) {
            $data['form'] = $this->formStep6($id);
        } else if ($this->request->getGet('step') == 7) {
            $data['form'] = $this->formStep7($id);
        } else {
            $data['form'] = $this->formStep1($id);
        }
        $data['id'] = $id;
        return view($stepper, $data);
    }

    public function formPilihPaket($id = null)
    {
        $data  = null;
        $where = " true";
        if ($this->user['user_member_id'] != '') {
            $where = " member_id=" . $this->user['user_member_id'];
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_submit_label('Lanjut')
            ->set_submit_icon('k-icon k-i-arrow-right')
            ->add('peng_member_id', 'Nama Pengaju', 'select', true, ($data) ? 0 : 1, ' style="width:100%;"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
                'where' => $where
            ))
            ->add('peng_jenis_pengajuan', 'Jenis Pengajuan', 'select', true, ($data) ? 0 : 1, ' style="width:100%;"', array(
                'table' => 'ref_jenis_pengajuan',
                'id' => 'jns_pengajuan_id',
                'label' => 'jns_pengajuan_label',
            ));
        if ($form->formVerified()) {
            die(forceRedirect(base_url('/admin/pengajuan/pengajuan/' . $this->request->getPost('peng_jenis_pengajuan') . '/' . $this->request->getPost('peng_member_id'))));
        } else {
            return $form->output();
        }
    }

    public function pengajuan($jenis, $member_id)
    {
        $data['title']  = 'Detail Pengajuan';
        $data['form']   = $this->step1($jenis, $member_id);
        $data['url_back']   = base_url("admin/pengajuan/pilihPaket");

        return view('global/form', $data);
    }

    public function step1($jenis, $member_id)
    {
        if ($jenis == 1) {
            $view = 'admin/pengajuan/stepper_form';
            $data['form']   = $this->formPengajuanDibawah10($jenis, $member_id);
        } else if ($jenis == 2) {
            $view = 'admin/pengajuan/stepper_form_jenis_2';
            $data['form']   = $this->formPengajuanDiatas10($jenis, $member_id);
        } else {
            $view = 'admin/pengajuan/stepper_form_jenis_3';
            $data['form']   = $this->formPengajuanDanaBergulir($jenis, $member_id);
        }
        $data['peng_lock_is'] = 'false';
        $data['id'] = 0;
        return view($view, $data);
    }

    public function formPengajuanDibawah10($jenis, $member_id)
    {
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_template('admin/pengajuan/sf_step1')
            ->add('peng_member_id', 'Nama Pengaju', 'select', false, $member_id, ' style="width:100%;" readonly="readonly"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
            ))
            ->add('peng_tanggal', 'Tanggal', 'date', true, date("Y-m-d"), 'style="width:100%;"')
            ->add('peng_nominal', 'Nominal Pinjaman', 'number', true, 500000, 'style="width:100%;" min="0" max="10000000"')
            ->add('peng_bidang_usaha', 'Bidang Usaha', 'select', true, '', ' style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label',
            ))
            ->add('peng_tujuan_penggunaan', 'Tujuan Penggunaan', 'text', false, '', 'style="width:100%;"')
            ->add('peng_foto_suami', 'Foto Suami', 'file', false, '', 'style="width:100%;" accept="image/*"')
            ->add('peng_foto_istri', 'Foto Istri', 'file', false, '', 'style="width:100%;" accept="image/*"')
            ->add('peng_fc_ktp', 'Fotocopy KTP suami istri', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_kk', 'Fotocopy KK', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_surat_nikah', 'Fotocopy Surat Nikah', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_legalitas_jaminan', 'Fotocopy Legalitas Jaminan', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_foto_suami');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_suami'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_istri');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_istri'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_kk');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_kk'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_surat_nikah');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_surat_nikah'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_legalitas_jaminan');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_legalitas_jaminan'] = $name;
                }
            }

            $dataForm['peng_jenis_pengajuan'] = $jenis;

            $this->db->table("pengajuan")->insert($dataForm);
            $id = $this->db->insertID();
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=2')));
        } else {
            return $form->output();
        }
    }

    public function formPengajuanDiatas10($jenis, $member_id)
    {
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_template('admin/pengajuan/sf_step1')
            ->add('peng_member_id', 'Nama Pengaju', 'select', false, $member_id, ' style="width:100%;" readonly="readonly"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
            ))
            ->add('peng_tanggal', 'Tanggal', 'date', true, date("Y-m-d"), 'style="width:100%;"')
            ->add('peng_nominal', 'Nominal Pinjaman', 'number', true, 10000000, 'style="width:100%;" min="10000000" max="100000000"')
            ->add('peng_bidang_usaha', 'Bidang Usaha', 'select', true, '', ' style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label',
            ))
            ->add('peng_tujuan_penggunaan', 'Tujuan Penggunaan', 'text', false, '', 'style="width:100%;"')
            ->add('peng_foto_suami', 'Foto Suami', 'file', false, '', 'style="width:100%;" accept="image/*"')
            ->add('peng_foto_istri', 'Foto Istri', 'file', false, '', 'style="width:100%;" accept="image/*"')
            ->add('peng_fc_ktp', 'Fotocopy KTP suami istri', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_kk', 'Fotocopy KK', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_surat_nikah', 'Fotocopy Surat Nikah', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_legalitas_jaminan', 'Fotocopy Legalitas Jaminan', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_foto_suami');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_suami'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_istri');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_istri'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_kk');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_kk'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_surat_nikah');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_surat_nikah'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_legalitas_jaminan');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_legalitas_jaminan'] = $name;
                }
            }

            $dataForm['peng_jenis_pengajuan'] = $jenis;

            $this->db->table("pengajuan")->insert($dataForm);
            $id = $this->db->insertID();
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=2')));
        } else {
            return $form->output();
        }
    }

    public function formPengajuanDanaBergulir($jenis, $member_id)
    {
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_template('admin/pengajuan/sf_step1_jenis3')
            ->add('peng_member_id', 'Nama Pengaju', 'select', false, $member_id, ' style="width:100%;" readonly="readonly"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
            ))
            ->add('peng_tanggal', 'Tanggal', 'date', true, date("Y-m-d"), 'style="width:100%;"')
            ->add('peng_tempat', 'Tempat', 'text', false, '', 'style="width:100%;"')
            ->add('peng_tanggal', 'Tanggal', 'date', true, date("Y-m-d"), 'style="width:100%;"')
            ->add('peng_nominal', 'Nominal Pinjaman', 'number', true, 10000000, 'style="width:100%;" min="0" max="100000000000"')
            ->add('peng_susunan_pengurus', 'Susunan Pengurus', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_akta_pendirian', 'FC Akta Pendirian', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_buku_laporan_rapat', 'FC Buku Laporan Rapat', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_jaminan', 'FC Jaminan', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_ktp_pengurus', 'FC KTP Pengurus', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_ktp_pengawas', 'FC KTP Pengawas', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_siup', 'FC SIUP', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_tdp', 'FC TDP', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_npwp', 'FC NPWP', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_sertifikat_penilaian', 'FC Sertifikat Penilaian', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_foto_pengurus', 'Foto Pengurus', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_foto_pengawas', 'Foto Pengawas', 'file', false, '', 'style="width:100%;" accept="image/*, application/pdf"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_susunan_pengurus');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_susunan_pengurus'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_akta_pendirian');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_akta_pendirian'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_buku_laporan_rapat');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_buku_laporan_rapat'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_jaminan');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_jaminan'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp_pengurus');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp_pengurus'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp_pengawas');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp_pengawas'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_siup');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_siup'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_tdp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_tdp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_npwp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_npwp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_sertifikat_penilaian');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_sertifikat_penilaian'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_pengurus');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_pengurus'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_pengawas');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_pengawas'] = $name;
                }
            }

            $dataForm['peng_jenis_pengajuan'] = $jenis;

            $this->db->table("pengajuan")->insert($dataForm);
            $id = $this->db->insertID();
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=2')));
        } else {
            return $form->output();
        }
    }

    public function formStep1($id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 1) {
            return $this->formStep1Jenis1($id, $pengajuan['peng_jenis_pengajuan']);
        } else if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formStep1Jenis2($id, $pengajuan['peng_jenis_pengajuan']);
        } else {
            return $this->formStep1Jenis3($id, $pengajuan['peng_jenis_pengajuan']);
        }
    }

    public function formStep1Jenis1($id, $jenis)
    {
        $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        // die(var_dump($data['peng_lock_is']));
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $where = " true";
        if ($this->user['user_member_id'] != '') {
            $where = " member_id=" . $this->user['user_member_id'];
        }

        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_template('admin/pengajuan/sf_step1')
            ->set_resume($resume)
            ->add('peng_member_id', 'Nama Pengaju', 'select', false, $data['peng_member_id'], ' style="width:100%;" readonly="readonly"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
                'where' => $where
            ))
            ->add('peng_tanggal', 'Tanggal', 'date', true, $data['peng_tanggal'], 'style="width:100%;"')
            ->add('peng_nominal', 'Nominal Pinjaman', 'number', true, $data['peng_nominal'], 'style="width:100%;" min="0" max="10000000"')
            ->add('peng_bidang_usaha', 'Bidang Usaha', 'select', true, $data['peng_bidang_usaha'], 'style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label',
            ))
            ->add('peng_tujuan_penggunaan', 'Tujuan Penggunaan', 'text', false, $data['peng_tujuan_penggunaan'], 'style="width:100%;"')
            ->add('peng_foto_suami', 'Foto Suami', 'file', ($data['peng_foto_suami'] == '' ? false  : false), ($data['peng_foto_suami'] == '' ? '' : base_url("uploads/" . $data['peng_foto_suami'])), 'style="width:100%;" accept="image/*"')
            ->add('peng_foto_istri', 'Foto Istri', 'file', ($data['peng_foto_istri'] == '' ? false  : false), ($data['peng_foto_istri'] == '' ? '' : base_url("uploads/" . $data['peng_foto_istri'])), 'style="width:100%;" accept="image/*"')
            ->add('peng_fc_ktp', 'Fotocopy KTP', 'file', ($data['peng_fc_ktp'] == '' ? false  : false), ($data['peng_fc_ktp'] == '' ? '' : base_url("uploads/" . $data['peng_fc_ktp'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_kk', 'Fotocopy KK', 'file', ($data['peng_fc_kk'] == '' ? false  : false), ($data['peng_fc_kk'] == '' ? '' : base_url("uploads/" . $data['peng_fc_kk'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_surat_nikah', 'Fotocopy Surat Nikah', 'file', ($data['peng_fc_surat_nikah'] == '' ? false  : false), ($data['peng_fc_surat_nikah'] == '' ? '' : base_url("uploads/" . $data['peng_fc_surat_nikah'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_legalitas_jaminan', 'Fotocopy Legalitas Jaminan', 'file', ($data['peng_fc_legalitas_jaminan'] == '' ? false  : false), ($data['peng_fc_legalitas_jaminan'] == '' ? '' : base_url("uploads/" . $data['peng_fc_legalitas_jaminan'])), 'style="width:100%;" accept="image/*, application/pdf"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_foto_suami');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_suami'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_istri');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_istri'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_kk');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_kk'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_surat_nikah');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_surat_nikah'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_legalitas_jaminan');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_legalitas_jaminan'] = $name;
                }
            }

            $dataForm['peng_jenis_pengajuan'] = $jenis;
            $dataForm['peng_srt_jumlah_pinjaman'] = $this->request->getPost('peng_nominal');
            $dataForm['peng_srt_jenis_usaha'] = $this->request->getPost('peng_bidang_usaha');
            $dataForm['peng_prof_jenis_usaha'] = $this->request->getPost('peng_bidang_usaha');

            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=2')));
        } else {
            return $form->output();
        }
    }

    public function formStep1Jenis2($id, $jenis)
    {
        $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $where = " true";
        if ($this->user['user_member_id'] != '') {
            $where = " member_id=" . $this->user['user_member_id'];
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_template('admin/pengajuan/sf_step1')
            ->set_resume($resume)
            ->add('peng_member_id', 'Nama Pengaju', 'select', false, $data['peng_member_id'], ' style="width:100%;" readonly="readonly"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
                'where' => $where
            ))
            ->add('peng_tanggal', 'Tanggal', 'date', true, date("Y-m-d"), 'style="width:100%;"')
            ->add('peng_nominal', 'Nominal Pinjaman', 'number', true, $data['peng_nominal'], 'style="width:100%;" min="10000000" max="100000000"')
            ->add('peng_bidang_usaha', 'Bidang Usaha', 'select', true, $data['peng_bidang_usaha'], 'style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label',
            ))
            ->add('peng_tujuan_penggunaan', 'Tujuan Penggunaan', 'text', false, $data['peng_tujuan_penggunaan'], 'style="width:100%;"')
            ->add('peng_foto_suami', 'Foto Suami', 'file', ($data['peng_foto_suami'] == '' ? false  : false), ($data['peng_foto_suami'] == '' ? '' : base_url("uploads/" . $data['peng_foto_suami'])), 'style="width:100%;" accept="image/*"')
            ->add('peng_foto_istri', 'Foto Istri', 'file', ($data['peng_foto_istri'] == '' ? false  : false), ($data['peng_foto_istri'] == '' ? '' : base_url("uploads/" . $data['peng_foto_istri'])), 'style="width:100%;" accept="image/*"')
            ->add('peng_fc_ktp', 'Fotocopy KTP', 'file', ($data['peng_fc_ktp'] == '' ? false  : false), ($data['peng_fc_ktp'] == '' ? '' : base_url("uploads/" . $data['peng_fc_ktp'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_kk', 'Fotocopy KK', 'file', ($data['peng_fc_kk'] == '' ? false  : false), ($data['peng_fc_kk'] == '' ? '' : base_url("uploads/" . $data['peng_fc_kk'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_surat_nikah', 'Fotocopy Surat Nikah', 'file', ($data['peng_fc_surat_nikah'] == '' ? false  : false), ($data['peng_fc_surat_nikah'] == '' ? '' : base_url("uploads/" . $data['peng_fc_surat_nikah'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_legalitas_jaminan', 'Fotocopy Legalitas Jaminan', 'file', ($data['peng_fc_legalitas_jaminan'] == '' ? false  : false), ($data['peng_fc_legalitas_jaminan'] == '' ? '' : base_url("uploads/" . $data['peng_fc_legalitas_jaminan'])), 'style="width:100%;" accept="image/*, application/pdf"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_foto_suami');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_suami'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_istri');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_istri'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_kk');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_kk'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_surat_nikah');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_surat_nikah'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_legalitas_jaminan');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_legalitas_jaminan'] = $name;
                }
            }

            $dataForm['peng_jenis_pengajuan'] = $jenis;
            $dataForm['peng_srt_jumlah_pinjaman'] = $this->request->getPost('peng_nominal');
            $dataForm['peng_srt_jenis_usaha'] = $this->request->getPost('peng_bidang_usaha');
            $dataForm['peng_prof_jenis_usaha'] = $this->request->getPost('peng_bidang_usaha');

            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=2')));
        } else {
            return $form->output();
        }
    }

    public function formStep1Jenis3($id, $jenis)
    {
        $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $where = " true";
        if ($this->user['user_member_id'] != '') {
            $where = " member_id=" . $this->user['user_member_id'];
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_template('admin/pengajuan/sf_step1_jenis3')
            ->set_resume($resume)
            ->add('peng_member_id', 'Nama Pengaju', 'select', false, $data['peng_member_id'], ' style="width:100%;" readonly="readonly"', array(
                'table' => 'member',
                'id' => 'member_id',
                'label' => 'member_nama_lengkap',
                'where' => $where
            ))
            ->add('peng_tanggal', 'Tanggal', 'date', true, $data['peng_tanggal'], 'style="width:100%;"')
            ->add('peng_tempat', 'Tempat', 'text', true, $data['peng_tempat'], 'style="width:100%;"')
            ->add('peng_nominal', 'Nominal Pinjaman', 'number', true, $data['peng_nominal'], 'style="width:100%;" min="0" max="100000000000"')
            ->add('peng_susunan_pengurus', 'Susunan Pengurus', 'file', ($data['peng_susunan_pengurus'] == '' ? false  : false), ($data['peng_susunan_pengurus'] == '' ? '' : base_url("uploads/" . $data['peng_susunan_pengurus'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_akta_pendirian', 'FC Akta Pendirian', 'file', ($data['peng_fc_akta_pendirian'] == '' ? false  : false), ($data['peng_fc_akta_pendirian'] == '' ? '' : base_url("uploads/" . $data['peng_fc_akta_pendirian'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_buku_laporan_rapat', 'FC Buku Laporan Rapat', 'file', ($data['peng_fc_buku_laporan_rapat'] == '' ? false  : false), ($data['peng_fc_buku_laporan_rapat'] == '' ? '' : base_url("uploads/" . $data['peng_fc_buku_laporan_rapat'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_jaminan', 'FC Jaminan', 'file', ($data['peng_fc_jaminan'] == '' ? false  : false), ($data['peng_fc_jaminan'] == '' ? '' : base_url("uploads/" . $data['peng_fc_jaminan'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_ktp_pengurus', 'FC KTP Pengurus', 'file', ($data['peng_fc_ktp_pengurus'] == '' ? false  : false), ($data['peng_fc_ktp_pengurus'] == '' ? '' : base_url("uploads/" . $data['peng_fc_ktp_pengurus'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_ktp_pengawas', 'FC KTP Pengawas', 'file', ($data['peng_fc_ktp_pengawas'] == '' ? false  : false), ($data['peng_fc_ktp_pengawas'] == '' ? '' : base_url("uploads/" . $data['peng_fc_ktp_pengawas'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_siup', 'FC SIUP', 'file', ($data['peng_fc_siup'] == '' ? false  : false), ($data['peng_fc_siup'] == '' ? '' : base_url("uploads/" . $data['peng_fc_siup'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_tdp', 'FC TDP', 'file', ($data['peng_fc_tdp'] == '' ? false  : false), ($data['peng_fc_tdp'] == '' ? '' : base_url("uploads/" . $data['peng_fc_tdp'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_npwp', 'FC NPWP', 'file', ($data['peng_fc_npwp'] == '' ? false  : false), ($data['peng_fc_npwp'] == '' ? '' : base_url("uploads/" . $data['peng_fc_npwp'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_fc_sertifikat_penilaian', 'FC Sertifikat Penilaian', 'file', ($data['peng_fc_sertifikat_penilaian'] == '' ? false  : false), ($data['peng_fc_sertifikat_penilaian'] == '' ? '' : base_url("uploads/" . $data['peng_fc_sertifikat_penilaian'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_foto_pengurus', 'Foto Pengurus', 'file', ($data['peng_foto_pengurus'] == '' ? false  : false), ($data['peng_foto_pengurus'] == '' ? '' : base_url("uploads/" . $data['peng_foto_pengurus'])), 'style="width:100%;" accept="image/*, application/pdf"')
            ->add('peng_foto_pengawas', 'Foto Pengawas', 'file', ($data['peng_foto_pengawas'] == '' ? false  : false), ($data['peng_foto_pengawas'] == '' ? '' : base_url("uploads/" . $data['peng_foto_pengawas'])), 'style="width:100%;" accept="image/*, application/pdf"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_susunan_pengurus');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_susunan_pengurus'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_akta_pendirian');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_akta_pendirian'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_buku_laporan_rapat');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_buku_laporan_rapat'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_jaminan');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_jaminan'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp_pengurus');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp_pengurus'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_ktp_pengawas');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_ktp_pengawas'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_siup');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_siup'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_tdp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_tdp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_npwp');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_npwp'] = $name;
                }
            }

            $file = $this->request->getFile('peng_fc_sertifikat_penilaian');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_fc_sertifikat_penilaian'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_pengurus');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_pengurus'] = $name;
                }
            }

            $file = $this->request->getFile('peng_foto_pengawas');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_foto_pengawas'] = $name;
                }
            }

            $dataForm['peng_jenis_pengajuan'] = $jenis;
            $dataForm['peng_srt_jumlah_pinjaman'] = $this->request->getPost('peng_nominal');

            $this->db->table("pengajuan")->insert($dataForm);
            $id = $this->db->insertID();
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=2')));
        } else {
            return $form->output();
        }
    }

    public function formStep2($id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 1) {
            return $this->formStep2Jenis1($id);
        } else if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formStep2Jenis2($id);
        } else {
            return $this->formStep2Jenis3($id);
        }
    }

    public function formStep2Jenis1($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template('admin/pengajuan/sf_step2_jenis1')
            ->set_resume($resume)
            ->add('peng_prof_nama_usaha', 'Nama Usaha Mikro', 'text', false, empty($data) ? '' : $data['peng_prof_nama_usaha'], 'style="width:100%;"')
            ->add('peng_prof_alamat', 'Alamat', 'text', false, empty($data) ? '' : $data['peng_prof_alamat'], 'style="width:100%;"')
            ->add('peng_prof_pimpinan', 'Pimpinan / Pemilik', 'text', false, empty($data) ? '' : $data['peng_prof_pimpinan'], 'style="width:100%;"')
            ->add('peng_prof_perizinan', 'Perizinan yang dimiliki (SK dari kelurahan)', 'text', false, empty($data) ? '' : $data['peng_prof_perizinan'], 'style="width:100%;"')
            ->add('peng_prof_jumlah_karyawan', 'Jumlah Karyawan', 'number', false, empty($data) ? '' : $data['peng_prof_jumlah_karyawan'], 'style="width:100%;"')
            ->add('peng_prof_tahun_mulai', 'Tahun Mulai Usaha', 'text', false, empty($data) ? '' : $data['peng_prof_tahun_mulai'], 'style="width:100%;"')
            ->add('peng_prof_jenis_usaha', 'Jenis Usaha', 'select', false, empty($data) ? '' : $data['peng_prof_jenis_usaha'], ' style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label'
            ))
            ->add('peng_prof_komoditi_produk', 'Komoditi Produk', 'text', false, empty($data) ? '' : $data['peng_prof_komoditi_produk'], 'style="width:100%;"')
            ->add('peng_prof_omset_per_bulan', 'Omset per bulan', 'number', false, empty($data) ? '' : $data['peng_prof_omset_per_bulan'], 'style="width:100%;"')
            ->add('peng_prof_lokasi_pemasaran', 'Lokasi Pemasaran', 'text', false, empty($data) ? '' : $data['peng_prof_lokasi_pemasaran'], 'style="width:100%;"')
            ->add('peng_prof_pola_pemasaran', 'Pola Pemasaran', 'text', false, empty($data) ? '' : $data['peng_prof_pola_pemasaran'], 'style="width:100%;"')
            ->add('peng_prof_pendapatan_penjualan', 'Pendapatan / Penjualan', 'number', false, empty($data) ? '' : $data['peng_prof_pendapatan_penjualan'], 'style="width:100%;"')
            ->add('peng_prof_beban_penjualan', 'Beban Penjualan', 'number', false, empty($data) ? '' : $data['peng_prof_beban_penjualan'], 'style="width:100%;"')
            ->add('peng_prof_laba_per_bulan', 'Laba per bulan', 'number', false, empty($data) ? '' : $data['peng_prof_laba_per_bulan'], 'style="width:100%;"')
            ->add('peng_prof_modal_sendiri', 'Modal sendiri', 'number', false, empty($data) ? '' : $data['peng_prof_modal_sendiri'], 'style="width:100%;"')
            ->add('peng_prof_modal_luar', 'Modal luar', 'number', false, empty($data) ? '' : $data['peng_prof_modal_luar'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            // print_r($dataForm);
            // die();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);

            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=3')));
        } else {
            return $form->output();
        }
    }

    public function formStep2Jenis2($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template('admin/pengajuan/sf_step2_jenis1')
            ->set_resume($resume)
            ->add('peng_prof_nama_usaha', 'Nama Usaha Mikro', 'text', false, empty($data) ? '' : $data['peng_prof_nama_usaha'], 'style="width:100%;"')
            ->add('peng_prof_alamat', 'Alamat', 'text', false, empty($data) ? '' : $data['peng_prof_alamat'], 'style="width:100%;"')
            ->add('peng_prof_pimpinan', 'Pimpinan / Pemilik', 'text', false, empty($data) ? '' : $data['peng_prof_pimpinan'], 'style="width:100%;"')
            ->add('peng_prof_perizinan', 'Perizinan yang dimiliki (SK dari kelurahan)', 'text', false, empty($data) ? '' : $data['peng_prof_perizinan'], 'style="width:100%;"')
            ->add('peng_prof_jumlah_karyawan', 'Jumlah Karyawan', 'number', false, empty($data) ? '' : $data['peng_prof_jumlah_karyawan'], 'style="width:100%;"')
            ->add('peng_prof_tahun_mulai', 'Tahun Mulai Usaha', 'text', false, empty($data) ? '' : $data['peng_prof_tahun_mulai'], 'style="width:100%;"')
            ->add('peng_prof_jenis_usaha', 'Jenis Usaha', 'select', false, ($data['peng_prof_jenis_usaha'] == '') ? $data['peng_bidang_usaha'] : $data['peng_prof_jenis_usaha'], ' style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label'
            ))
            ->add('peng_prof_komoditi_produk', 'Komoditi Produk', 'text', false, empty($data) ? '' : $data['peng_prof_komoditi_produk'], 'style="width:100%;"')
            ->add('peng_prof_omset_per_bulan', 'Omset per bulan', 'number', false, empty($data) ? '' : $data['peng_prof_omset_per_bulan'], 'style="width:100%;"')
            ->add('peng_prof_lokasi_pemasaran', 'Lokasi Pemasaran', 'text', false, empty($data) ? '' : $data['peng_prof_lokasi_pemasaran'], 'style="width:100%;"')
            ->add('peng_prof_pola_pemasaran', 'Pola Pemasaran', 'text', false, empty($data) ? '' : $data['peng_prof_pola_pemasaran'], 'style="width:100%;"')
            ->add('peng_prof_pendapatan_penjualan', 'Pendapatan / Penjualan', 'number', false, empty($data) ? '' : $data['peng_prof_pendapatan_penjualan'], 'style="width:100%;"')
            ->add('peng_prof_beban_penjualan', 'Beban Penjualan', 'number', false, empty($data) ? '' : $data['peng_prof_beban_penjualan'], 'style="width:100%;"')
            ->add('peng_prof_laba_per_bulan', 'Laba per bulan', 'number', false, empty($data) ? '' : $data['peng_prof_laba_per_bulan'], 'style="width:100%;"')
            ->add('peng_prof_modal_sendiri', 'Modal sendiri', 'number', false, empty($data) ? '' : $data['peng_prof_modal_sendiri'], 'style="width:100%;"')
            ->add('peng_prof_modal_luar', 'Modal luar', 'number', false, empty($data) ? '' : $data['peng_prof_modal_luar'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);

            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=3')));
        } else {
            return $form->output();
        }
    }

    public function formStep2Jenis3($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template('admin/pengajuan/sf_step2_jenis3')
            ->set_resume($resume)
            ->add('peng_prof_nama_usaha', 'Nama Koperasi', 'text', false, empty($data) ? '' : $data['peng_prof_nama_usaha'], 'style="width:100%;"')
            ->add('peng_badan_hukum_no', 'No. Badan Hukum', 'text', false, empty($data) ? '' : $data['peng_badan_hukum_no'], 'style="width:100%;"')
            ->add('peng_badan_hukum_tanggal', 'Tgl. Badan Hukum', 'date', false, empty($data) ? '' : $data['peng_badan_hukum_tanggal'], 'style="width:100%;"')
            ->add('peng_prof_alamat', 'Alamat', 'text', false, empty($data) ? '' : $data['peng_prof_alamat'], 'style="width:100%;"')
            ->add('peng_kesehatan_usp', 'Kesehatan USP', 'text', false, empty($data) ? '' : $data['peng_kesehatan_usp'], 'style="width:100%;"')
            ->add('peng_jumlah_anggota', 'Jumlah Anggota', 'number', false, empty($data) ? '' : $data['peng_jumlah_anggota'], 'style="width:100%;"')
            ->add('peng_pelaksanaan_rat', 'Pelaksanaan RAT', 'text', false, empty($data) ? '' : $data['peng_pelaksanaan_rat'], 'style="width:100%;"')
            ->add('peng_ketua', 'Pengurus Ketua', 'text', false, empty($data) ? '' : $data['peng_ketua'], 'style="width:100%;"')
            ->add('peng_sekretaris', 'Pengurus Sekretaris', 'text', false, empty($data) ? '' : $data['peng_sekretaris'], 'style="width:100%;"')
            ->add('peng_bendahara', 'Pengurus Bendahara', 'text', false, empty($data) ? '' : $data['peng_bendahara'], 'style="width:100%;"')
            ->add('peng_pengawas_koor', 'Pengawas Koordinator', 'text', false, empty($data) ? '' : $data['peng_pengawas_koor'], 'style="width:100%;"')
            ->add('peng_pengawas_anggota1', 'Pengawas Anggota 1', 'text', false, empty($data) ? '' : $data['peng_pengawas_anggota1'], 'style="width:100%;"')
            ->add('peng_pengawas_anggota2', 'Pengawas Anggota 2', 'text', false, empty($data) ? '' : $data['peng_pengawas_anggota2'], 'style="width:100%;"')
            ->add('peng_prof_jumlah_karyawan', 'Jumlah Karyawan', 'number', false, empty($data) ? '' : $data['peng_prof_jumlah_karyawan'], 'style="width:100%;"')
            ->add('peng_usaha_dikelola_1', 'Usaha yang dikelola 1', 'text', false, empty($data) ? '' : $data['peng_usaha_dikelola_1'], 'style="width:100%;"')
            ->add('peng_usaha_dikelola_2', 'Usaha yang dikelola 2', 'text', false, empty($data) ? '' : $data['peng_usaha_dikelola_2'], 'style="width:100%;"')
            ->add('peng_prof_omset_per_bulan', 'Omset Usaha', 'number', false, empty($data) ? '' : $data['peng_prof_omset_per_bulan'], 'style="width:100%;"')
            ->add('peng_prof_pendapatan_penjualan', 'Pendapatan Penjualan', 'number', false, empty($data) ? '' : $data['peng_prof_pendapatan_penjualan'], 'style="width:100%;"')
            ->add('peng_prof_beban_penjualan', 'Beban Penjualan', 'number', false, empty($data) ? '' : $data['peng_prof_beban_penjualan'], 'style="width:100%;"')
            ->add('peng_usaha_shu', 'SHU', 'number', false, empty($data) ? '' : $data['peng_usaha_shu'], 'style="width:100%;"')

            ->add('peng_prof_modal_sendiri', 'Equitas / Modal Sendiri', 'number', false, empty($data) ? '' : $data['peng_prof_modal_sendiri'], 'style="width:100%;"')
            ->add('peng_permodalan_kewajiban', 'Kewajiban', 'number', false, empty($data) ? '' : $data['peng_permodalan_kewajiban'], 'style="width:100%;"')
            ->add('peng_permodalan_modal_kerja', 'Modal Kerja', 'number', false, empty($data) ? '' : $data['peng_permodalan_modal_kerja'], 'style="width:100%;"')
            ->add('peng_prof_modal_luar', 'Modal Investasi', 'number', false, empty($data) ? '' : $data['peng_prof_modal_luar'], 'style="width:100%;"')
            ->add('peng_permodalan_pinjaman_bank', 'Pinjaman Bank / lembaga lainnya', 'number', false, empty($data) ? '' : $data['peng_permodalan_pinjaman_bank'], 'style="width:100%;"');

        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=3')));
        } else {
            return $form->output();
        }
    }

    public function formStep3($id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 1) {
            return $this->formStep3Jenis1($id);
        } else if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formFilterJaminan($id) . $this->formStep3Jenis2($id);
        } else {
            return $this->formFilterJaminan($id) . $this->formStep3Jenis3($id);
        }
    }

    public function formStep3Jenis1($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step3_jenis1")
            ->set_resume($resume)
            ->add('peng_uji_kel_no_ktp', 'NO. KTP', 'text', false, empty($data) ? '' : $data['peng_uji_kel_no_ktp'], 'style="width:100%;"')
            ->add('peng_uji_kel_pekerjaan', 'Pekerjaan', 'text', false, empty($data) ? '' : $data['peng_uji_kel_pekerjaan'], 'style="width:100%;"')
            ->add('peng_sk_kepala_kelurahan', 'Kepala Kelurahan', 'text', false, empty($data) ? '' : $data['peng_sk_kepala_kelurahan'], 'style="width:100%;"')
            ->add('peng_sk_kecamatan', 'Kecamatan', 'select', false, empty($data) ? '' : $data['peng_sk_kecamatan'], ' style="width:100%;"', array(
                'table' => 'ref_kecamatan',
                'id' => 'ref_kec_id',
                'label' => 'ref_kec_label',
            ))
            ->add('peng_sk_kota', 'Kota', 'text', false, 'KEDIRI', 'style="width:100%;" readonly="readonly"')
            ->add('peng_sk_tanah_luas', 'Luas Tanah (M2)', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_luas'], 'style="width:100%;"')
            ->add('peng_sk_tanah_desa', 'Di Desa / Kelurahan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_desa'], 'style="width:100%;"')
            ->add('peng_sk_tanah_kecamatan', 'Kecamatan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_kecamatan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_no_shm', 'No. SHM', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_no_shm'], 'style="width:100%;"')
            ->add('peng_sk_tanah_tanggal_shm', 'Tanggal SHM', 'date', false, empty($data) ? '' : $data['peng_sk_tanah_tanggal_shm'], 'style="width:100%;"')
            ->add('peng_sk_tanah_atas_nama', 'Atas Nama', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_atas_nama'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_ru', 'Harga Tanah per - RU', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_ru'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_meter', 'Harga Tanah per meter', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_meter'], 'style="width:100%;"')
            ->add('peng_sk_tanah_luas_bangunan', 'Luas Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_luas_bangunan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_bangunan', 'Harga Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_bangunan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_bangunan', 'Harga Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_bangunan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_utara', 'Letak Sebelah Utara', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_utara'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_selatan', 'Letak Sebelah Selatan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_selatan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_timur', 'Letak Sebelah Timur', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_timur'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_barat', 'Letak Sebelah Barat', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_barat'], 'style="width:100%;"')
            ->add('peng_sk_tanah_penggunaan', 'Penggunaan tanah saat ini', 'textArea', false, empty($data) ? '' : $data['peng_sk_tanah_penggunaan'], 'style="width:100%;" rows="5"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=3')));
        } else {
            return $form->output();
        }
    }

    public function formFilterJaminan($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_form_type('search')
            ->set_submit_name('cari')
            ->set_form_method('GET')
            ->set_submit_label('Pilih')
            ->add('step', '', 'hidden', false, $this->request->getGet('step'))
            ->add('jenis_jaminan', 'Jenis Jaminan', 'select_custom', true, ($data['peng_jam_jenis'] == '') ? $this->request->getGet('jenis_jaminan') : $data['peng_jam_jenis'], ' style="width:100%;"', array(
                'option' => [
                    [
                        'id' => 1,
                        'label' => 'BPKB'
                    ],
                    [
                        'id' => 2,
                        'label' => 'SERTIFIKAT'
                    ]
                ]
            ));
        if ($form->formVerified()) {
            $this->db->table("pengajuan")->where("peng_id=" . $id)->update([
                'peng_jam_jenis' => $this->request->getGet('jenis_jaminan')
            ]);
        }
        return $form->output();
    }

    public function formSertifikat($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step3_jenis2_sertifikat")
            ->set_resume($resume)
            ->add('peng_jam_jenis_tanah', 'Jenis Jaminan', 'select', true, empty($data) ? '' : $data['peng_jam_jenis_tanah'], ' style="width:100%;"', array(
                'table' => 'ref_jenis_jaminan',
                'id' => 'jns_jam_id',
                'label' => 'jns_jam_label',
            ))
            ->add('peng_jam_pemegang_ktp_no', 'Pemegang KTP No', 'text', false, empty($data) ? '' : $data['peng_jam_pemegang_ktp_no'], 'style="width:100%;"')
            ->add('peng_jam_pekerjaan', 'Pekerjaan', 'text', false, empty($data) ? '' : $data['peng_jam_pekerjaan'], 'style="width:100%;"')
            ->add('peng_jam_no_akta', 'Nomor Akta', 'text', false, empty($data) ? '' : $data['peng_jam_no_akta'], 'style="width:100%;"')
            ->add('peng_jam_tempat', 'Tempat', 'text', false, empty($data) ? '' : $data['peng_jam_tempat'], 'style="width:100%;"')
            ->add('peng_jam_atas_nama_tanah', 'Atas Nama', 'text', false, empty($data) ? '' : $data['peng_jam_atas_nama_tanah'], 'style="width:100%;"')
            ->add('peng_jam_alamat_tanah', 'Alamat', 'text', false, empty($data) ? '' : $data['peng_jam_alamat_tanah'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=5')));
        } else {
            return $form->output();
        }
    }

    public function formBpkb($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step3_jenis2_bpkb")
            ->set_resume($resume)
            ->add('peng_jam_jenis_bpkb', 'Jenis Jaminan', 'select', true, empty($data) ? '' : $data['peng_jam_jenis_bpkb'], ' style="width:100%;"', array(
                'table' => 'ref_jenis_jaminan',
                'id' => 'jns_jam_id',
                'label' => 'jns_jam_label',
            ))
            ->add('peng_jam_pemegang_ktp_no', 'Pemegang KTP No', 'text', false, empty($data) ? '' : $data['peng_jam_pemegang_ktp_no'], 'style="width:100%;"')
            ->add('peng_jam_pekerjaan', 'Pekerjaan', 'text', false, empty($data) ? '' : $data['peng_jam_pekerjaan'], 'style="width:100%;"')
            ->add('peng_jam_tahun_pembuatan', 'Tahun Pembuatan', 'text', false, empty($data) ? '' : $data['peng_jam_tahun_pembuatan'], 'style="width:100%;"')
            ->add('peng_jam_nopol', 'Nomor Polisi', 'text', false, empty($data) ? '' : $data['peng_jam_nopol'], 'style="width:100%;"')
            ->add('peng_jam_mesin', 'Nomor Mesin', 'text', false, empty($data) ? '' : $data['peng_jam_mesin'], 'style="width:100%;"')
            ->add('peng_jam_rangka', 'Nomor Rangka', 'text', false, empty($data) ? '' : $data['peng_jam_rangka'], 'style="width:100%;"')
            ->add('peng_jam_atas_nama', 'Atas Nama', 'text', false, empty($data) ? '' : $data['peng_jam_atas_nama'], 'style="width:100%;"')
            ->add('peng_jam_alamat', 'Alamat', 'text', false, empty($data) ? '' : $data['peng_jam_alamat'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=5')));
        } else {
            return $form->output();
        }
    }

    public function formStep3Jenis2($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $jenis_jaminan = ($data['peng_jam_jenis'] == '' ? $this->request->getGet('jenis_jaminan') : $data['peng_jam_jenis']);
        if ($jenis_jaminan == 1) {
            return $this->formBpkb($id);
        } else {
            return $this->formSertifikat($id);
        }
    }

    public function formStep3Jenis3($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $jenis_jaminan = ($data['peng_jam_jenis'] == '' ? $this->request->getGet('jenis_jaminan') : $data['peng_jam_jenis']);
        if ($jenis_jaminan == 1) {
            return $this->formBpkb($id);
        } else {
            return $this->formSertifikat($id);
        }
    }

    public function formStep4($id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formStep4Jenis2($id);
        } else if ($pengajuan['peng_jenis_pengajuan'] == 3) {
            return $this->formStep4Jenis3($id);
        }
    }

    public function formStep4Jenis2($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step4_jenis2")
            ->set_resume($resume)
            ->add('peng_sk_kepala_kelurahan', 'Kepala Kelurahan', 'text', false, empty($data) ? '' : $data['peng_sk_kepala_kelurahan'], 'style="width:100%;"')
            ->add('peng_sk_kecamatan', 'Kecamatan', 'select', false, empty($data) ? '' : $data['peng_sk_kecamatan'], 'style="width:100%;"', array(
                'table' => 'ref_kecamatan',
                'id' => 'ref_kec_id',
                'label' => 'ref_kec_label'
            ))
            ->add('peng_sk_kota', 'Kota', 'text', false, empty($data) ? 'KEDIRI' : 'KEDIRI', 'style="width:100%;"')
            // ->add('peng_sk_tanah_luas', 'Luas Tanah (M2)', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_luas'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_desa', 'Di Desa / Kelurahan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_desa'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_kecamatan', 'Kecamatan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_kecamatan'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_no_shm', 'No. SHM', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_no_shm'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_tanggal_shm', 'Tanggal SHM', 'date', false, empty($data) ? '' : $data['peng_sk_tanah_tanggal_shm'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_atas_nama', 'Atas Nama', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_atas_nama'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_harga_ru', 'Harga Tanah per - RU', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_ru'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_harga_meter', 'Harga Tanah per meter', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_meter'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_luas_bangunan', 'Luas Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_luas_bangunan'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_harga_bangunan', 'Harga Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_bangunan'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_harga_bangunan', 'Harga Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_bangunan'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_letak_utara', 'Letak Sebelah Utara', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_utara'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_letak_selatan', 'Letak Sebelah Selatan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_selatan'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_letak_timur', 'Letak Sebelah Timur', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_timur'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_letak_barat', 'Letak Sebelah Barat', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_barat'], 'style="width:100%;"')
            // ->add('peng_sk_tanah_penggunaan', 'Penggunaan tanah saat ini', 'textArea', false, empty($data) ? '' : $data['peng_sk_tanah_penggunaan'], 'style="width:100%;" rows="5"')
        ;
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=5')));
        } else {
            return $form->output();
        }
    }

    public function formStep4Jenis3($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step4_jenis2")
            ->set_resume($resume)
            ->add('peng_sk_kepala_kelurahan', 'Kepala Kelurahan', 'text', false, empty($data) ? '' : $data['peng_sk_kepala_kelurahan'], 'style="width:100%;"')
            ->add('peng_sk_kecamatan', 'Kecamatan', 'select', false, empty($data) ? '' : $data['peng_sk_kecamatan'], 'style="width:100%;"', array(
                'table' => 'ref_kecamatan',
                'id' => 'ref_kec_id',
                'label' => 'ref_kec_label'
            ))
            ->add('peng_sk_kota', 'Kota', 'text', false, empty($data) ? 'KEDIRI' : $data['peng_sk_kota'], 'style="width:100%;"')
            ->add('peng_sk_tanah_luas', 'Luas Tanah (M2)', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_luas'], 'style="width:100%;"')
            ->add('peng_sk_tanah_desa', 'Di Desa / Kelurahan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_desa'], 'style="width:100%;"')
            ->add('peng_sk_tanah_kecamatan', 'Kecamatan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_kecamatan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_no_shm', 'No. SHM', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_no_shm'], 'style="width:100%;"')
            ->add('peng_sk_tanah_tanggal_shm', 'Tanggal SHM', 'date', false, empty($data) ? '' : $data['peng_sk_tanah_tanggal_shm'], 'style="width:100%;"')
            ->add('peng_sk_tanah_atas_nama', 'Atas Nama', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_atas_nama'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_ru', 'Harga Tanah per - RU', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_ru'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_meter', 'Harga Tanah per meter', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_meter'], 'style="width:100%;"')
            ->add('peng_sk_tanah_luas_bangunan', 'Luas Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_luas_bangunan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_bangunan', 'Harga Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_bangunan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_harga_bangunan', 'Harga Bangunan', 'number', false, empty($data) ? '' : $data['peng_sk_tanah_harga_bangunan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_utara', 'Letak Sebelah Utara', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_utara'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_selatan', 'Letak Sebelah Selatan', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_selatan'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_timur', 'Letak Sebelah Timur', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_timur'], 'style="width:100%;"')
            ->add('peng_sk_tanah_letak_barat', 'Letak Sebelah Barat', 'text', false, empty($data) ? '' : $data['peng_sk_tanah_letak_barat'], 'style="width:100%;"')
            ->add('peng_sk_tanah_penggunaan', 'Penggunaan tanah saat ini', 'textArea', false, empty($data) ? '' : $data['peng_sk_tanah_penggunaan'], 'style="width:100%;" rows="5"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=5')));
        } else {
            return $form->output();
        }
    }

    public function formStep5($id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formStep5Jenis2($id);
        } else if ($pengajuan['peng_jenis_pengajuan'] == 3) {
            return $this->formStep5Jenis3($id);
        }
    }

    public function formStep5Jenis2($id)
    {
        if (isset($_POST['lat'])) {
            $dataUpdate = array(
                'peng_lokasi_lat' => $this->request->getPost('lat'),
                'peng_lokasi_lon' => $this->request->getPost('lon'),
                'peng_lokasi_keterangan' => $this->request->getPost('keterangan'),
            );
            $this->db->table("pengajuan")->where("peng_id", $id)->update($dataUpdate);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=6')));
        } else {
            $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
            $data['peng_lokasi_lat'] = ($data['peng_lokasi_lat'] == '' ? '-7.812725' : $data['peng_lokasi_lat']);
            $data['peng_lokasi_lon'] = ($data['peng_lokasi_lon'] == '' ? '112.014705' : $data['peng_lokasi_lon']);
            return view('admin/pengajuan/sf_denah_lokasi', $data);
        }
    }

    public function formStep5Jenis3($id)
    {
        if (isset($_POST['lat'])) {
            $dataUpdate = array(
                'peng_lokasi_lat' => $this->request->getPost('lat'),
                'peng_lokasi_lon' => $this->request->getPost('lon'),
                'peng_lokasi_keterangan' => $this->request->getPost('keterangan'),
            );
            $this->db->table("pengajuan")->where("peng_id", $id)->update($dataUpdate);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=6')));
        } else {
            $data = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
            $data['peng_lokasi_lat'] = ($data['peng_lokasi_lat'] == '' ? '-7.812725' : $data['peng_lokasi_lat']);
            $data['peng_lokasi_lon'] = ($data['peng_lokasi_lon'] == '' ? '112.014705' : $data['peng_lokasi_lon']);
            return view('admin/pengajuan/sf_denah_lokasi', $data);
        }
    }

    public function formStep6($id)
    {
        $btn_next = '<a href="' . base_url("admin/pengajuan/detail/" . $id . "?step=7") . '" class="btn btn-primary btn-raised">Lanjut <i class="k-icon k-i-arrow-right"></i></a>';
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formStep6Jenis2($id) . $this->listFoto($id) . $btn_next;
        } else if ($pengajuan['peng_jenis_pengajuan'] == 3) {
            return $this->formStep6Jenis3($id) . $this->listFoto($id) . $btn_next;
        }
    }

    public function formStep6Jenis2($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        if ($data['peng_lock_is'] == 't') {
            return '';
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_resume(false)
            ->add('foto', 'Foto Kegiatan Usaha', 'file', true, '', 'style="width:100%;" accept="image/*"')
            ->add('peng_foto_jenis', 'Jenis Foto', 'select_custom', false, '', ' style="width:100%;"', array(
                'option' => [
                    [
                        'id' => 1,
                        'label' => 'Foto Kegiatan Usaha'
                    ],
                    [
                        'id' => 2,
                        'label' => 'Foto Jaminan'
                    ]
                ]
            ));

        if ($form->formVerified()) {
            $file = $this->request->getFile('foto');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName();
                if ($file->move('./uploads/foto_kegiatan', $name)) {
                    $dataForm['peng_foto_peng_id'] = $id;
                    $dataForm['peng_foto_file'] = $name;
                    $dataForm['peng_foto_created_at'] = date("Y-m-d H:i:s");
                    $dataForm['peng_foto_created_by'] = $this->user['user_id'];
                    $dataForm['peng_foto_jenis'] = $this->request->getPost('peng_foto_jenis');
                    $this->db->table("pengajuan_foto")->insert($dataForm);
                }
            }
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=6')));
        } else {
            return '<div clas="row"><div class="col-sm-6"><h5>Form Foto Kegiatan Usahan & Jaminan</h5>' . $form->output() . '</div></div><script>function delete_foto(id){if(confirm("Yakin ingin hapus data ini?")){$.post("' . base_url("admin/pengajuan/del_foto") . '",{"id" : id},function(res){reloadList();})}}</script>';
        }
    }

    public function listFoto($id)
    {
        $SQL = "select *, peng_foto_id as id from pengajuan_foto";
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $template = '<div class="col-sm-4 list"><img class="img-thumbnail" src="' . base_url("uploads/foto_kegiatan") . '/#:peng_foto_file#" alt="" /><Br/><button onclick="delete_foto(#:peng_foto_id#);" class="btn btn-sm btn-danger btn-raised">Hapus</button></div>';
        if ($data['peng_lock_is'] == 't') {
            $template = '<div class="col-sm-4 list"><img class="img-thumbnail" src="' . base_url("uploads/foto_kegiatan") . '/#:peng_foto_file#" alt="" /></div>';
        }
        $list = new ListView();
        return $list->set_datasource(array(
            'url' => base_url("admin/pengajuan/listFoto/" . $id . "?datasource&" . get_query_string()),
        ))
            ->set_query($SQL, array(
                ['peng_foto_peng_id', $id, '=']
            ))
            ->set_title("<h5>List Foto Kegiatan Usahan & Jaminan</h5>")
            ->set_template($template)
            ->output();
    }

    public function del_foto()
    {
        $id = $this->request->getPost('id');
        $this->db->table("pengajuan_foto")->where("peng_foto_id", $id)->delete();
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Sukses Delete Foto'
        ]);
    }

    public function formStep6Jenis3($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        if ($data['peng_lock_is'] == 't') {
            return '';
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal" enctype="multipart/form-data"')
            ->set_resume(false)
            ->add('foto', 'Foto Jaminan', 'file', true, '', 'style="width:100%;" accept="image/*"');

        if ($form->formVerified()) {
            $file = $this->request->getFile('foto');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName();
                if ($file->move('./uploads/foto_kegiatan', $name)) {
                    $dataForm['peng_foto_peng_id'] = $id;
                    $dataForm['peng_foto_file'] = $name;
                    $dataForm['peng_foto_created_at'] = date("Y-m-d H:i:s");
                    $dataForm['peng_foto_created_by'] = $this->user['user_id'];
                    $dataForm['peng_foto_jenis'] = 2;
                    $this->db->table("pengajuan_foto")->insert($dataForm);
                }
            }
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=6')));
        } else {
            return '<div clas="row"><div class="col-sm-6"><h5>Form Foto Kegiatan Usahan & Jaminan</h5>' . $form->output() . '</div></div><script>function delete_foto(id){if(confirm("Yakin ingin hapus data ini?")){$.post("' . base_url("admin/pengajuan/del_foto") . '",{"id" : id},function(res){reloadList();})}}</script>';
        }
    }

    public function formStep7($id)
    {
        $pengajuan = $this->db->table("pengajuan")->getWhere(['peng_id' => $id])->getRowArray();
        if ($pengajuan['peng_jenis_pengajuan'] == 2) {
            return $this->formStep7Jenis2($id);
        } else if ($pengajuan['peng_jenis_pengajuan'] == 3) {
            return $this->formStep7Jenis3($id);
        }
    }

    public function formStep7Jenis2($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step7_jenis2", $data)
            ->set_resume($resume)
            ->add('peng_srt_nama', 'Nama', 'text', false, empty($data) ? '' : $data['peng_srt_nama'], 'style="width:100%;"')
            ->add('peng_srt_pekerjaan', 'Pekerjaan', 'text', false, empty($data) ? '' : $data['peng_srt_pekerjaan'], 'style="width:100%;"')
            ->add('peng_srt_nama_usaha', 'Nama Usaha', 'text', false, empty($data) ? '' : $data['peng_srt_nama_usaha'], 'style="width:100%;"')
            ->add('peng_srt_jenis_usaha', 'Jenis Usaha', 'select', false, ($data['peng_srt_jenis_usaha'] == '') ? $data['peng_bidang_usaha'] : $data['peng_srt_jenis_usaha'], ' style="width:100%;"', array(
                'table' => 'ref_bidang_usaha',
                'id' => 'ref_bidang_id',
                'label' => 'ref_bidang_label'
            ))
            ->add('peng_srt_alamat', 'Alamat', 'text', false, empty($data) ? '' : $data['peng_srt_alamat'], 'style="width:100%;"')

            ->add('peng_srt_jumlah_pinjaman', 'Jumlah Pinjaman', 'number', false, ($data['peng_srt_jumlah_pinjaman'] == '') ? $data['peng_nominal'] : $data['peng_srt_jumlah_pinjaman'], 'style="width:100%;"')
            ->add('peng_srt_modal_kerja', 'Modal Kerja', 'number', false, empty($data) ? '' : $data['peng_srt_modal_kerja'], 'style="width:100%;"')
            ->add('peng_srt_investasi', 'Investasi', 'number', false, empty($data) ? '' : $data['peng_srt_investasi'], 'style="width:100%;"')

            ->add('peng_srt_pengambilan_waktu', 'Pengambilan Waktu', 'select_custom', false, ($data['peng_srt_pengambilan_waktu'] == '') ? 36 : $data['peng_srt_pengambilan_waktu'], 'style="width:100%;"', [
                'option' => [
                    [
                        'id' => 36,
                        'label' => '3 Tahun'
                    ],
                ]
            ])
            ->add('peng_srt_bunga', 'Bunga (%)', 'number', false, empty($data) ? '' : $data['peng_srt_bunga'], 'style="width:100%;" max="100"')

            ->add('peng_srt_omset_penjualan_pokok', 'Omset Penjualan Pokok', 'number', false, empty($data) ? '' : $data['peng_srt_omset_penjualan_pokok'], 'style="width:100%;"')
            ->add('peng_srt_pendapatan_lain', 'Pendapatan Lain-Lain', 'number', false, empty($data) ? '' : $data['peng_srt_pendapatan_lain'], 'style="width:100%;"')

            ->add('peng_srt_harga_pokok_penjualan', 'Harga Pokok Penjualan', 'number', false, empty($data) ? '' : $data['peng_srt_harga_pokok_penjualan'], 'style="width:100%;"')
            ->add('peng_srt_beban_bunga', 'Beban Bunga', 'number', false, empty($data) ? '' : $data['peng_srt_beban_bunga'], 'style="width:100%;"')
            ->add('peng_srt_beban_usaha', 'Beban Usaha', 'number', false, empty($data) ? '' : $data['peng_srt_beban_usaha'], 'style="width:100%;"')
            ->add('peng_srt_beban_non_usaha', 'Beban Non Usaha', 'number', false, empty($data) ? '' : $data['peng_srt_beban_non_usaha'], 'style="width:100%;"')

            ->add('peng_srt_laba', 'Laba', 'number', false, empty($data) ? '' : $data['peng_srt_laba'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=7')));
        } else {
            return $form->output();
        }
    }

    public function formStep7Jenis3($id)
    {
        $data = $this->db->table('pengajuan')->getWhere(['peng_id' => $id])->getRowArray();
        $resume = false;
        if ($data['peng_lock_is'] == 't') {
            $resume = true;
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->set_template("admin/pengajuan/sf_step7_jenis3", $data)
            ->set_resume($resume)
            ->add('peng_srt_jumlah_pinjaman', 'Jumlah Pinjaman', 'number', false, ($data['peng_srt_jumlah_pinjaman'] == '') ? $data['peng_nominal'] : $data['peng_srt_jumlah_pinjaman'], 'style="width:100%;"')
            ->add('peng_srt_modal_kerja', 'Modal Kerja', 'number', false, empty($data) ? '' : $data['peng_srt_modal_kerja'], 'style="width:100%;"')
            ->add('peng_srt_investasi', 'Investasi', 'number', false, empty($data) ? '' : $data['peng_srt_investasi'], 'style="width:100%;"')
            ->add('peng_srt_pengambilan_waktu', 'Pengambilan Waktu', 'select_custom', false, ($data['peng_srt_pengambilan_waktu'] == '') ? 36 : $data['peng_srt_pengambilan_waktu'], 'style="width:100%;"', [
                'option' => [
                    [
                        'id' => 36,
                        'label' => '3 Tahun'
                    ],
                ]
            ])
            ->add('peng_srt_bunga', 'Bunga (%)', 'number', false, empty($data) ? '' : $data['peng_srt_bunga'], 'style="width:100%;" max="100"')
            ->add('peng_srt_omset_penjualan_pokok', 'Omset Penjualan Pokok', 'number', false, empty($data) ? '' : $data['peng_srt_omset_penjualan_pokok'], 'style="width:100%;"')
            ->add('peng_srt_pendapatan_lain', 'Pendapatan Lain-Lain', 'number', false, empty($data) ? '' : $data['peng_srt_pendapatan_lain'], 'style="width:100%;"')
            ->add('peng_srt_harga_pokok_penjualan', 'Harga Pokok Penjualan', 'number', false, empty($data) ? '' : $data['peng_srt_harga_pokok_penjualan'], 'style="width:100%;"')
            ->add('peng_srt_beban_bunga', 'Beban Bunga', 'number', false, empty($data) ? '' : $data['peng_srt_beban_bunga'], 'style="width:100%;"')
            ->add('peng_srt_beban_usaha', 'Beban Usaha', 'number', false, empty($data) ? '' : $data['peng_srt_beban_usaha'], 'style="width:100%;"')
            ->add('peng_srt_beban_non_usaha', 'Beban Non Usaha', 'number', false, empty($data) ? '' : $data['peng_srt_beban_non_usaha'], 'style="width:100%;"')
            ->add('peng_srt_laba', 'Laba', 'number', false, empty($data) ? '' : $data['peng_srt_laba'], 'style="width:100%;"')

            ->add('peng_manf_meningkatkan_penjualan', 'Meningkatkan penjualan & pendapatan', 'number', false, empty($data) ? '' : $data['peng_manf_meningkatkan_penjualan'], 'style="width:100%;"')
            ->add('peng_manf_menambah_modal', 'Menambah permodalan', 'number', false, empty($data) ? '' : $data['peng_manf_menambah_modal'], 'style="width:100%;"')
            ->add('peng_manf_peningkatan_omset', 'Peningkatan Omset', 'number', false, empty($data) ? '' : $data['peng_manf_peningkatan_omset'], 'style="width:100%;"')
            ->add('peng_manf_peningkatan_shu', 'Peningkatan SHU', 'number', false, empty($data) ? '' : $data['peng_manf_peningkatan_shu'], 'style="width:100%;"')
            ->add('peng_manf_peningkatan_asset', 'Peningkatan Asset', 'number', false, empty($data) ? '' : $data['peng_manf_peningkatan_asset'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die(forceRedirect(base_url('/admin/pengajuan/detail/' . $id . '?step=7')));
        } else {
            return $form->output();
        }
    }

    public function lock($id)
    {
        $dataUpdate = array(
            'peng_lock_is' => true,
            'peng_lock_at' => date("Y-m-d H:i:s"),
            'peng_lock_by' => $this->user['user_id']
        );
        $this->db->table("pengajuan")->where("peng_id", $id)->update($dataUpdate);
        return redirect()->to(base_url("admin/pengajuan/detail/" . $id));
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
            ->add('peng_cetak_pengajuan_ttd', 'Cetakan bertanda tangan', 'file', false, empty($data['peng_cetak_pengajuan_ttd']) ? '' : base_url() . '/uploads/' . $data['peng_cetak_pengajuan_ttd'], 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataForm = $form->get_data();
            $file = $this->request->getFile('peng_cetak_pengajuan_ttd');
            if ($file->getName() != '') {
                $ext = $file->getClientExtension();
                $name = $file->getName();
                $name = $file->getRandomName() . "." . $ext;
                if ($file->move('./uploads/', $name)) {
                    $dataForm['peng_cetak_pengajuan_ttd'] = $name;
                }
            }
            $this->db->table("pengajuan")->where('peng_id', $id)->update($dataForm);
            die('<script>window.close();</script>');
        } else {
            return $form->output();
        }
    }
}
