<?php

namespace App\Models;

use CodeIgniter\Model;

class LapakModel extends Model
{
    protected $table = 'lapak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'category_id', 'title', 'description', 'requirement', 'price_tag', 'working_hours', 'status', 'created_on', 'update_on'];

    function getLapak($id = null)
    {
        if ($id) {
            return $this->db->query("
            SELECT lapak.*, categories.name as category_name, users.name as freelancer_name from lapak
            INNER JOIN users ON lapak.user_id=users.id
            INNER JOIN categories ON lapak.category_id = categories.id
            WHERE lapak.id = '$id'
            ")->getRowArray();
        } else {
            return $this->db->query("
            SELECT lapak.*, categories.name as category_name, users.name as freelancer_name from lapak
            INNER JOIN users ON lapak.user_id=users.id
            INNER JOIN categories ON lapak.category_id = categories.id
            ")->getResultArray();
        }
    }

    function getCategory($id)
    {
        return $this->db->query("
        SELECT lapak.*, categories.name as category_name, users.name as freelancer_name from lapak
        INNER JOIN users ON lapak.user_id=users.id
        INNER JOIN categories ON lapak.category_id = categories.id
        WHERE categories.id = $id
        ")->getResultArray();
    }

    function get_services($user_id)
    {
        return $this->table('lapak')
            ->getWhere(['user_id' => $user_id])
            ->getRowArray();
    }
}