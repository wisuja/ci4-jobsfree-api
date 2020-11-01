<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['role_id', 'name', 'email', 'password', 'image', 'phone_no', 'idcard_no', 'phone_with_card', 'created_on', 'update_on'];



    function get_user($username, $password)
    {
        return $this->table('users')
            ->getWhere(['email' => $username, 'password' => $password])
            ->getRowArray();
    }
}