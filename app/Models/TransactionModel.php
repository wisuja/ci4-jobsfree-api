<?php

namespace App\Models;

use CodeIgniter\Model;
use PDO;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['lapak_id', 'freelancer_id', 'client_id', 'payment_date', 'payment_via', 'accept', 'status'];

    public function ongoing($freelancer_id)
    {
        return $this->db->query("SELECT * from transactions WHERE freelancer_id='$freelancer_id' or client_id='$freelancer_id'")->getResultArray();
    }
}