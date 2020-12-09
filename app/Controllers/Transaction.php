<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Transaction extends ResourceController
{
    protected $modelName = 'App\Models\TransactionModel';
    protected $format = 'json';

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'lapak_id' => 'required',
            'freelancer_id' => 'required',
            'client_id' => 'required',
            'payment_via' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'lapak_id' => $this->request->getVar('lapak_id'),
                'freelancer_id' => $this->request->getVar('freelancer_id'),
                'client_id' => $this->request->getVar('client_id'),
                'payment_date' => $this->request->getVar('payment_date'),
                'payment_via' => $this->request->getVar('payment_via'),
                'creates_on' => date("Y-m-d H:i:s"),
            ];
            $post_id = $this->model->insert($data);
            $data['id'] = $post_id;
            return $this->respondCreated($data);
        }
    }

    //get transaksi yang telah di setujui dan belum dikerjakan
    public function ongoing($id = null)
    {
        $data = $this->model->ongoing($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    //GET transaksi yang sudah selesai
    public function finish($id = null)
    {
        $data = $this->model->finish($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    //GET transaksi cancel
    public function getcancel($id = null)
    {
    }

    //konfirmasi pengerjaan untuk jasa. terima 
    //method : POST
    public function confirm($id = null)
    {

        helper(['form']);

        $rules = [
            'accept' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $d = $this->model->find($id);
            if ($d) {
                $data = [
                    'id' => $id,
                    'lapak_id' => $d['lapak_id'],
                    'freelancer_id' => $d['freelancer_id'],
                    'client_id' => $d['client_id'],
                    'accept' => $this->request->getVar('accept'),
                ];
                $this->model->save($data);
                if ($data['accept'] == '1') {
                    $data['confirm_message'] = 'diterima';
                } else if ($data['accept'] == '2') {
                    $data['confirm_message'] = 'dibatalkan';
                } else {
                    $data['confirm_message'] = 'nilai 1 = diterima , nilai 2 = dibatalkan';
                }
                return $this->respond($data);
            } else {
                return $this->failNotFound('Item not Found');
            }
        }
    }

    //kirim message selesai untuk freelancer
    //Method : POST
    public function submit($id = null)
    {
        helper(['form']);

        $rules = [
            'message' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $d = $this->model->get_Trans_User_Lapak($id);
            $data = [
                'id' => $id,
                'freelancer_name' => $d['freelancer_name'],
                'client_name' => $d['client_name'],
                'message' => $this->request->getVar('message'),
                'finished_on' => date("Y-m-d H:i:s"),
            ];
            $this->model->save($data);
            return $this->respond($data);
        }
    }

    //transaksi yang selesai untuk client
    //Method : POST
    public function done($id = null)
    {
        helper(['form']);

        $rules = [
            'status' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $d = $this->model->get_Trans_User_Lapak($id);
            $data = [
                'id' => $id,
                'freelancer_name' => $d['freelancer_name'],
                'client_name' => $d['client_name'],
                'status' => $this->request->getVar('status'),
                'finished_on' => date("Y-m-d H:i:s"),
            ];
            $this->model->save($data);
            return $this->respond($data);
        }
    }
}