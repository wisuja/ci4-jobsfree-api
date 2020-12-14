<?php

namespace App\Models;

use CodeIgniter\Model;
use PDO;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['lapak_id', 'freelancer_id', 'client_id', 'payment_date', 'payment_via', 'accept', 'status', 'message', 'creates_on', 'finished_on'];

    public function get_Trans_User_Lapak($id)
    {
        return $this->db->query("
    select transactions.id, transactions.lapak_id, freelancer.id as freelancer_id, 
    freelancer.name as freelancer_name, client.id as client_id, client.name as client_name from transactions
    inner join users as freelancer on transactions.freelancer_id = freelancer.id
    inner join users as client on transactions.client_id = client.id
    where transactions.id = '$id'
    ")->getRowArray();
    }

    public function ongoing($freelancer_id)
    {
        return $this->db->query("SELECT * from transactions WHERE client_id in (select client_id from transactions where client_id='$freelancer_id' or freelancer_id='$freelancer_id') and status is null")->getResultArray();
    }
    public function finish($freelancer_id)
    {
        return $this->db->query("SELECT * from transactions WHERE client_id in (select client_id from transactions where client_id='$freelancer_id' or freelancer_id='$freelancer_id') and status is not null")->getResultArray();
    }
}