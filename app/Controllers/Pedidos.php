<?php namespace App\Controllers;

use App\Models\PedidoModel;

use App\Models\PedidoCursoModel;

class Pedidos extends BaseController
{

    // cria um novo Pedido
    public function create() {

        $data = $this->request->getJson();

        $id = (new PedidoModel())->insert([
            "usuario_id" => $data->usuario_id,
            "data_pedido" => date("Y-m-d"),
            "estado" => "feito"
        ]);

        $pedidoCursoId = null;
        
        if( $id > 0 ){
           
            foreach($data->cursos as $curso){
                
                $pedidoCursoId = (new PedidoCursoModel())->insert([
                    'curso_id'=> $curso->id,
                    'pedido_id' => $id
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

}
