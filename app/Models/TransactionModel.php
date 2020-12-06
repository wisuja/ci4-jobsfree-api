<?php

namespace App\Models;

use CodeIgniter\Model;
use PDO;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['lapak_id', 'freelancer_id', 'client_id', 'payment_date', 'payment_via', 'accept', 'status', 'message', 'finished_on'];

    public function ongoing($freelancer_id)
    {
        return $this->db->query("SELECT * from transactions WHERE client_id in (select client_id from transactions where client_id='$freelancer_id' or freelancer_id='$freelancer_id') and status is null")->getResultArray();
    }
    public function finish($freelancer_id)
    {
        return $this->db->query("SELECT * from transactions WHERE client_id in (select client_id from transactions where client_id='$freelancer_id' or freelancer_id='$freelancer_id') and status is not null")->getResultArray();
    }
}