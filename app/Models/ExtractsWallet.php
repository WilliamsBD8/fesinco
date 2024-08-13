<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtractsWallet extends Model
{
    protected $table            = 'extracts_wallet';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'registro',
        'feccorte',
        'fecsolici',
        'fecfinal',
        'numero',
        'line_credit_extract_id',
        'tasanual',
        'tasmes',
        'valor',
        'ctapact',
        'ctapend',
        'valcta',
        'saldo',
        'fecha_cargue',
        'status'
    ];

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

    public function getLineCreditExtract($id){
        $line = $this->builder('line_credit_extracts')->where(['id' => $id])->get()->getResult();
        return $line[0];
    }
}
