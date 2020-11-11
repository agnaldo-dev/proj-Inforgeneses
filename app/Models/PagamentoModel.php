<?php 
namespace App\Models;
use CodeIgniter\Model;


class PagamentoModel extends Model
{
    protected $table = 'pagamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tipo_pagamento_id','pedido_id','data_pagamento','valor'];

}
