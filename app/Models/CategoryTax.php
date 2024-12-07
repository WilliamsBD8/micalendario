<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryTax extends Model
{
    protected $table            = 'category_taxes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
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

    public function getCalendary($id){
        $data = $this->builder('calendary_taxes')
        ->select([
            'calendary_taxes.*',
            'COUNT(DISTINCT upload_tax_calendar.ubication) as total_ubi',
            'upload_tax_calendar.Municipality_id as municipality',
            'upload_tax_calendar.ubication'
        ])
        ->where(['calendary_taxes.category_tax_id' => $id])
        ->join('upload_tax_calendar', 'calendary_taxes.id = upload_tax_calendar.calendary_tax_id', 'left')
        ->groupBy([
            'calendary_taxes.id',
            'upload_tax_calendar.ubication',
            'upload_tax_calendar.Municipality_id'
        ])
        ->get()->getResult();
        return $data;
    }

    public function getCalendaryTax($id, $municipality = 613){
        $session = session()->get('filter');
        if(!$session) {
            $session = session();
			$session->set('filter', (object)[
				"anio"		=> date('Y'),
				"mes"		=> "",
				"nit"	    => "",
				"last_dig"  => "",
			]);
        }
        $filter = ['calendary_tax_id'  => $id, 'Municipality_id'  => $municipality];
        // if(!empty(session('filter')->last_dig))
        //     $filter['last_digit_nit'] = session('filter')->last_dig;
        if(!empty(session('filter')->anio))
            $filter['YEAR(date)'] = session('filter')->anio;
        if(!empty(session('filter')->mes))
            $filter['MONTH(date)'] = session('filter')->mes;
        $data = $this->builder('upload_tax_calendar')->where($filter)->get()->getResult();
        return $data;
    }
}
