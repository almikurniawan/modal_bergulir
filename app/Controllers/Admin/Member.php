<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class Member extends BaseController
{
    public function index()
    {
        $data['grid']   = $this->grid();
        $data['search'] = $this->search();
        $data['title']  = 'Pemohon';
        $data['url_delete'] = 'admin/member/delete';

        return view('global/list', $data);
    }

    public function grid()
    {
        $SQL = "SELECT
                    member_id as id,
                    *,
                    to_char(member_created_at,'dd-mm-YYYY HH24:MI:SS') as tgl
                FROM
                    MEMBER LEFT JOIN PUBLIC.USER ON user_member_id = member_id";

        $action['edit']     = array(
            'link'          => 'admin/member/edit/'
        );
        $action['delete']     = array(
            'jsf'          => '_delete'
        );

        $grid = new Grid();
        return $grid->set_query($SQL, array(
            array('user_name', $this->request->getGet('user_name'))
        ))
            ->set_sort(array('member_id', 'desc'))
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/member/grid?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'member_nama_lengkap',
                            'title' => 'Nama Lengkap',
                        ),
                        array(
                            'field' => 'member_alamat',
                            'title' => 'Alamat',
                        ),
                        array(
                            'field' => 'member_no_telp',
                            'title' => 'No Telp',
                        ),
                        array(
                            'field' => 'member_kelurahan',
                            'title' => 'Kelurahan',
                        ),
                        array(
                            'field' => 'user_name',
                            'title' => 'Username',
                        ),
                        array(
                            'field' => 'tgl',
                            'title' => 'Tanggal buat',
                        ),
                    ),
                    'action'    => $action,
                    'head_left' => array('add' => base_url('/admin/member/add')),
                    'toolbar'   => ['download']
                )
            )
            ->set_label_add('Tambah Pemohon')
            ->output();
    }
    public function search()
    {
        $form = new Form();
        return $form->set_form_type('search')
            ->set_form_method('GET')
            ->set_submit_label('Cari')
            ->add('user_name', 'Usernmae', 'text', false, $this->request->getGet('user_name'), 'style="width:100%;" ')
            ->output();
    }

    public function add()
    {
        $data['title']  = 'Tambah Pemohon';
        $data['form']   = $this->form();
        $data['url_back'] = base_url('admin/member');
        return view('global/form', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Edit Member';
        $data['form']   = $this->form($id);
        $data['url_back'] = base_url('admin/member');

        return view('global/form', $data);
    }
    public function delete()
    {
        $id = $this->request->getPost('id');

        $this->db->table('member')->where(['member_id' => $id])->update(['member_visible' => false]);
        return $this->response->setJSON(
            array(
                'status' => true,
                'message' => 'Success delete data'
            )
        );
    }
    public function form($id = null)
    {

        if ($id != null) {
            $data = $this->db->table('member')->select('*')->join('public.user', 'user_member_id=member_id')->getWhere(['member_id' => $id])->getRowArray();
        } else {
            $data = array(
                'member_nama_lengkap' => '',
                'member_alamat' => '',
                'member_no_telp' => '',
                'member_kelurahan' => '',
                'member_no_ktp' => '',
                'member_pekerjaan' => '',
                'user_name' => '',
                'user_password' => ''
            );
        }

        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->add('member_nama_lengkap', 'Nama Lengkap', 'text', true, ($data) ? $data['member_nama_lengkap'] : '', 'style="width:100%;"')
            ->add('member_alamat', 'Alamat', 'text', true, ($data) ? $data['member_alamat'] : '', 'style="width:100%;"')
            ->add('member_no_telp', 'No Telp', 'text', true, ($data) ? $data['member_no_telp'] : '', 'style="width:100%;"')
            ->add('member_kelurahan', 'Kelurahan', 'select', true, ($data) ? $data['member_kelurahan'] : '', 'style="width:100%;"', [
                'table'=> 'ref_kelurahan left join ref_kecamatan on ref_kel_kec_id = ref_kec_id',
                'id'=>'ref_kel_id',
                'label'=>"ref_kel_label || ' - '|| ref_kec_label"
            ])
            ->add('member_no_ktp', 'No KTP', 'text', true, ($data) ? $data['member_no_ktp'] : '', 'style="width:100%;"')
            ->add('member_pekerjaan', 'Pekerjaan', 'text', true, ($data) ? $data['member_pekerjaan'] : '', 'style="width:100%;"')
            ->add('user_name', 'Username', 'text', true, ($data) ? $data['user_name'] : '', 'style="width:100%;"')
            ->add('user_password', 'Password', 'password', true, ($data) ? '***' : '', 'style="width:100%;"');

        if ($form->formVerified()) {
            if ($id != null) {
                $member_update = array(
                    'member_nama_lengkap'     => $this->request->getPost('member_nama_lengkap'),
                    'member_alamat'         => $this->request->getPost('member_alamat'),
                    'member_no_telp'         => $this->request->getPost('member_no_telp'),
                    'member_kelurahan'         => $this->request->getPost('member_kelurahan'),
                    'member_no_ktp'         => $this->request->getPost('member_no_ktp'),
                    'member_pekerjaan'         => $this->request->getPost('member_pekerjaan'),
                    'member_created_at'        => 'now()',
                );
                $this->db->table('public.member')->where('member_id', $id)->update($member_update);

                $cekUser = $this->db->table('user')->getWhere(['user_name' => $this->request->getPost('user_name')])->getRowArray();
                if (!empty($cekUser)) {
                    $this->session->setFlashdata('danger', 'username = ' . strtoupper($this->request->getPost('user_name')) . ' sudah ada! Silahkan buat username yang baru');
                    die(forceRedirect(base_url('/admin/member/edit/' . $id)));
                }
                $user_update = array(
                    'user_name'         => $this->request->getPost('user_name'),
                    'user_member_id'     => $id,
                    'user_namalengkap'     => $this->request->getPost('member_nama_lengkap'),
                    'user_created_at'    => 'now()'
                );
                if ($this->request->getPost('user_password') != '') {
                    $user_update['user_password'] = sha1($this->request->getPost('user_password'));
                }
                $this->db->table('public.user')->where('user_member_id', $id)->update($user_update);
                $this->session->setFlashdata('success', 'Registrasi username = ' . strtoupper($this->request->getPost('user_name')) . ' berhasil! Silahkan login untuk melanjutkan');
                $this->session->setFlashdata('success', 'Sukses Edit Data');
                die(forceRedirect(base_url('/admin/member/edit/' . $id)));
            } else {
                $member_insert = array(
                    'member_nama_lengkap'     => $this->request->getPost('member_nama_lengkap'),
                    'member_alamat'         => $this->request->getPost('member_alamat'),
                    'member_no_telp'         => $this->request->getPost('member_no_telp'),
                    'member_kelurahan'         => $this->request->getPost('member_kelurahan'),
                    'member_no_ktp'         => $this->request->getPost('member_no_ktp'),
                    'member_pekerjaan'         => $this->request->getPost('member_pekerjaan'),
                    'member_created_at'        => 'now()',
                );
                $this->db->table('public.member')->insert($member_insert);
                $id = $this->db->insertID();

                $cekUser = $this->db->table('user')->getWhere(['user_name' => $this->request->getPost('user_name')])->getRowArray();
                if (!empty($cekUser)) {
                    $this->session->setFlashdata('danger', 'username = ' . strtoupper($this->request->getPost('user_name')) . ' sudah ada! Silahkan buat username yang baru');
                    die(forceRedirect(base_url('/admin/member/edit/' . $id)));
                }
                $user_insert = array(
                    'user_name'         => $this->request->getPost('user_name'),
                    'user_member_id'     => $id,
                    'user_namalengkap'     => $this->request->getPost('member_nama_lengkap'),
                    'user_created_at'    => 'now()'
                );
                if ($this->request->getPost('user_password') != '') {
                    $user_insert['user_password'] = sha1($this->request->getPost('user_password'));
                }
                $this->db->table('public.user')->insert($user_insert);
                $this->session->setFlashdata('success', 'Registrasi username = ' . strtoupper($this->request->getPost('user_name')) . ' berhasil! Silahkan login untuk melanjutkan');
                die(forceRedirect(base_url('/admin/member/edit/' . $id)));
            }
        } else {
            return $form->output();
        }
    }
}
