<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'administrador';
    protected $primaryKey       = 'id_admin';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_admin', 'password'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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
    

    public function addAdmin($data){
        $this->db->table('administrador')->insert($data);

    }
    // public function obtindreAdmin($data){
    //     $usuario=$this->db->table('administrador');
    //     $usuario->where($data);
    //     return $usuario->get()->getResultArray();
    // }

    public function obtindreAdmin($id_admin) {
        //el $id_admin introducido por POST sera buscado y comparado con el campo 'id_admin' hasta encontrar el que coincide
        //En sql seria asi: SELECT * FROM administrador WHERE id_admin = :id_admin LIMIT 1;
        return $this->where('id_admin', $id_admin)->first();
    }

}
