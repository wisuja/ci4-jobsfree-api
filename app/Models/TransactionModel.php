<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'lapak_id', 'freelancer_id', 'client_id', 'payment_date', 'payment_via'];
}