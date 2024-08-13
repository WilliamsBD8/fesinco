<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtractsContributions extends Model
{
    protected $table            = 'extracts_contributions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'numero',
        'fecha',
        'salahoper',
        'salahopex',
        'salresesp',
        'salahovol',
        'salahopro',
        'salaportes',
        'ctaahorro',
        'ctaaportes',
        'ctareserva',
        'total',
        'cartera',
        'nivelendeu',
        'salario',
        'fecha_cargue',
        'status',
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
}
