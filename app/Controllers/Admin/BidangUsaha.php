<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class BidangUsaha extends BaseController
{
    public function index()
    {
        $data['grid']   = $this->grid();
        $data['search'] = $this->search();
        $data['title']  = 'List Bidang Usaha';
        $data['url_delete']  = base_url("admin/bidangUsaha/delete");

        return view('global/list', $data);
    }

    public function grid()
    {
        $SQL = "SELECT
                    ref_bidang_id as id,
                    ref_bidang_label
                from ref_bidang_usaha";

        $action['edit']     = array(
            'link'          => 'admin/bidangUsaha/edit/'
        );
        // $action['delete']     = array(
        //     'jsf'          => '_delete'
        // );

        $grid = new Grid();
        return $grid->set_query($SQL, array(
                array('ref_bidang_label', $this->request->getGet('ref_bidang_label'))
            ))
            ->set_sort(array('id', 'desc'))
            // ->set_snippet(function($id, $data){
            //     $data['user_name'] = $data['user_name'];
            //     return $data;
            // })
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/bidangUsaha/grid?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'ref_bidang_label',
                            'title' => 'Bidang Usaha',
                        ),
                    ),
                    'action'    => $action,
                )
            )
            ->set_toolbar(function($toolbar){
                $toolbar
                // ->addHtml('<a href="" class="btn">Tambah User Bos</a>')
                ->add('add', ['label'=>'Tambah Bidang Usaha', 'url'=> base_url("admin/bidangUsaha/add")])
                ->add('download');
            })
            ->output();
    }

    public function search()
    {
        $form = new Form();
        return $form->set_form_type('search')
            ->set_form_method('GET')
            ->set_submit_label('Cari')
            ->add('ref_bidang_label', 'Bidang Usaha', 'text', false, $this->request->getGet('ref_bidang_label'), 'style="width:100%;" ')
            ->output();
    }

    public function add()
    {
        $data['title']  = 'Tambah Bidang Usaha';
        $data['form']   = $this->form();
        $data['url_back'] = base_url("admin/bidangUsaha");

        return view('global/form', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Edit Bidang Usaha';
        $data['form']   = $this->form($id);
        $data['url_back'] = base_url("admin/bidangUsaha");

        return view('global/form', $data);
    }
    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->db->table('ref_bidang_usaha')->delete(['ref_bidang_id' => $id]);
        return $this->response->setJSON(
            array(
                'status' => true,
                'message' => 'Success delete data'
            )
        );
    }
    public function form($id = null)
    {
        if($id!=null){
            $data = $this->db->table("ref_bidang_usaha")->getWhere(['ref_bidang_id'=>$id])->getRowArray();
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->add('ref_bidang_label', 'Bidang Usaha', 'text', true, (isset($data)) ? $data['ref_bidang_label'] : '', 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataUpdae = $form->get_data();
            if($id!=null){
                $this->db->table("ref_bidang_usaha")->where(['ref_bidang_id'=>$id])->update($dataUpdae);
            }else{
                $this->db->table("ref_bidang_usaha")->insert($dataUpdae);
            }
            die(forceRedirect(base_url('/admin/bidangUsaha')));
        } else {
            return $form->output();
        }
    }
}
