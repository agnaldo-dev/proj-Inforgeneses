<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Traits\QueryTrait;

class PedidoModel extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id','data_pedido','estado'];

    use QueryTrait;

    //retorna todos cursos feito no pedido por id
    public function pedidosCursoPorId($id){
     
        $sql = "SELECT * FROM pedidos p ".
                "INNER JOIN pedidos_cursos pc ON (pc.pedido_id = p.id)".
                " where p.id={$id}";

        return $this->query($this->db,$sql);
      
    }

}
