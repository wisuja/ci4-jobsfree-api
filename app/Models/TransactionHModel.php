<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionHModel extends Model
{
    protected $table = 'transactions_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['t_id', 'lapak_id', 'freelancer_id', 'client_id', 'payment_date', 'payment_via', 'accept', 'status', 'message', 'creates_on', 'finished_on'];
}