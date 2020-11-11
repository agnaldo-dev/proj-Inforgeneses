<?php 
namespace App\Models;
use CodeIgniter\Model;


class TipoPagamentoModel extends Model
{
    protected $table = 'tipo_pagamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome'];

}
