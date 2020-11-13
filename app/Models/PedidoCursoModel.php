<?php 
namespace App\Models;
use CodeIgniter\Model;


class PedidoCursoModel extends Model
{
    protected $table = 'pedidos_curso';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pedido_id','curso_id'];

}
