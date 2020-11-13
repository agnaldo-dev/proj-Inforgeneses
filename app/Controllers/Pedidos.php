<?php namespace App\Controllers;

use App\Models\PedidoModel;

use App\Models\PagamentoModel;

use App\Models\PedidoCursoModel;

class Pedidos extends BaseController
{

    // cria um novo Pedido
    public function create() {

        $data = $this->request->getJson();

        $pedidoId = (new PedidoModel())->insert([
            "usuario_id" => $data->usuario_id,
            "data_pedido" => date("Y-m-d"),
            "estado" => "feito"
        ]);

        $pedidoCursoId = null;
        
        if( $pedidoId > 0 ){
           
            foreach($data->cursos as $curso){
                
                $pedidoCursoId = (new PedidoCursoModel())->insert([
                    'curso_id'=> $curso->id,
                    'pedido_id' => $pedidoId
                    ]);
 
            }
            
        }
		
		$response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Pedido criado com sucesso'
          ],
          'data'=>$pedidoCursoId
	  ];
	  
      return $this->respondCreated($response);
	
	}

    //retorna todos curso do pedidos por id
    public function show($id = null){

		$data = (new PedidoModel())->pedidosCursoPorId($id);

		if( !$data ){
	   
			return $this->failNotFound('Pedido não encontrado');
       
		}
		
		return $this->respond($data);
        
    }
    
    //finalizar pedido é fazer o pagamento
    public function pagamento(){
        
        $data = (array) $this->request->getJson();
        
        $pagamentoId = (new PagamentoModel())->insert($data);
		
		$response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Pagamento criado com sucesso'
          ],
          "data" => $pagamentoId
      ];        
      
      return $this->respondCreated($response);
    }

}
