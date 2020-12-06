<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['role_id', 'name', 'email', 'password', 'image', 'phone_no', 'idcard_no', 'phone_with_card', 'created_on', 'update_on'];

    function get_user_password($username, $password)
    {
        return $this->table('users')
            ->getWhere(['email' => $username, 'password' => $password])
            ->getRowArray();
    }
    function get_email($username)
    {
        return $this->table('users')
            ->getWhere(['email' => $username])
            ->getRowArray();
    }

    function update_pswd($email, $new_password)
    {
        $this->set("password", "$new_password")
            ->where('email', "$email")
            ->update();
    }
}