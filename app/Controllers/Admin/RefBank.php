<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\SmartComponent\Grid;
use App\Libraries\SmartComponent\Form;

class RefBank extends BaseController
{
    public function index()
    {
        $data['grid']   = $this->grid();
        $data['search'] = $this->search();
        $data['title']  = 'List Bank';
        $data['url_delete']  = base_url("admin/refBank/delete");

        return view('global/list', $data);
    }

    public function grid()
    {
        $SQL = "SELECT
                    ref_bank_id as id,
                    ref_bank_label
                from ref_bank";

        $action['edit']     = array(
            'link'          => 'admin/refBank/edit/'
        );
        // $action['delete']     = array(
        //     'jsf'          => '_delete'
        // );

        $grid = new Grid();
        return $grid->set_query($SQL, array(
                array('ref_bank_label', $this->request->getGet('ref_bank_label'))
            ))
            ->set_sort(array('id', 'desc'))
            // ->set_snippet(function($id, $data){
            //     $data['user_name'] = $data['user_name'];
            //     return $data;
            // })
            ->configure(
                array(
                    'datasouce_url' => base_url("admin/refBank/grid?datasource&" . get_query_string()),
                    'grid_columns'  => array(
                        array(
                            'field' => 'ref_bank_label',
                            'title' => 'BANK',
                        ),
                    ),
                    'action'    => $action,
                )
            )
            ->set_toolbar(function($toolbar){
                $toolbar
                // ->addHtml('<a href="" class="btn">Tambah User Bos</a>')
                ->add('add', ['label'=>'Tambah Bank', 'url'=> base_url("admin/refBank/add")])
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
            ->add('ref_bank_label', 'Bank', 'text', false, $this->request->getGet('ref_bank_label'), 'style="width:100%;" ')
            ->output();
    }

    public function add()
    {
        $data['title']  = 'Tambah Bank';
        $data['form']   = $this->form();
        $data['url_back'] = base_url("admin/refBank");

        return view('global/form', $data);
    }

    public function edit($id)
    {
        $data['title']  = 'Edit Bank';
        $data['form']   = $this->form($id);
        $data['url_back'] = base_url("admin/bidangUsaha");

        return view('global/form', $data);
    }
    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->db->table('ref_bank')->delete(['ref_bank_id' => $id]);
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
            $data = $this->db->table("ref_bank")->getWhere(['ref_bank_id'=>$id])->getRowArray();
        }
        $form = new Form();
        $form->set_attribute_form('class="form-horizontal"')
            ->add('ref_bank_label', 'Bank', 'text', true, (isset($data)) ? $data['ref_bank_label'] : '', 'style="width:100%;"');
        if ($form->formVerified()) {
            $dataUpdae = $form->get_data();
            if($id!=null){
                $this->db->table("ref_bank")->where(['ref_bank_id'=>$id])->update($dataUpdae);
            }else{
                $this->db->table("ref_bank")->insert($dataUpdae);
            }
            die(forceRedirect(base_url('/admin/refBank')));
        } else {
            return $form->output();
        }
    }
}
