<?php

namespace App\Models;

use CodeIgniter\Model;

class Section extends Model
{
    protected $table            = 'sections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDetails($id, $order = "ASC"){
        $details = $this->builder('section_details')->where(['section_id' => $id, 'status' => 'active'])->orderBy('position', $order)->get()->getResult();
        return $details;
    }

    public function getDetailsBasic($id, $order = "ASC"){
        $details = $this->builder('section_details')->where(['section_id' => $id, 'status' => 'active'])->orderBy('position', $order);
        return $details;
    }
}
