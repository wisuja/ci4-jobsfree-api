<?php

namespace App\Models;

use CodeIgniter\Model;

class LapakModel extends Model
{
    protected $table = 'lapak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'category_id', 'title', 'description', 'requirement', 'price_tag', 'working_hours', 'status', 'created_on'];

    function getCategory($id)
    {
        return $this->table('lapak')
            ->getWhere(['category_id' => $id])
            ->getResultArray();
    }

    function get_services($user_id)
    {
        return $this->table('lapak')
            ->getWhere(['user_id' => $user_id])
            ->getRowArray();
    }
}