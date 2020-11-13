<?php namespace App\Controllers;

use App\Models\PedidoModel;

use App\Models\PagamentoModel;

use App\Models\PedidoCursoModel;

class Pedidos extends BaseController
{

    // cria um novo Pedido
    public function create() {
//        protected $allowedFields = ['usuario_id','data_pedido','estado'];

        $model = new PedidoModel();

        $data = $this->request->getJson();

        $feitoPedido = $model->insert([
            "usuario_id" => $data->usuario_id,
            "data_pedido" => date("Y-m-d");
        ]);
        
        if( $feitoPedido ){
            
            foreach($data['cursos'] as $id){
 
                $feitoPedido = (new PedidoCursoModel())->insert([
                    'curso_id'=>$id,
                    'pedido_id' => $feitoPedido->id
                    ]);
 
            }
            
        }
		
		$response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Pedido criado com sucesso'
          ]
	  ];
	  
      return $this->respondCreated($response);
	
	}

    //retorna um Pedidos por id
    public function show($id = null){

		$data = (new PedidoModel())->where('id', $id)->first();

		if( !$data ){
	   
			return $this->failNotFound('Pedido não encontrado');
       
		}
		
		return $this->respond($data);
        
    }
    
    //finalizar pedido é fazer o pagamento
    public function finalizarPedido(){
        
        $data = (array) $this->request->getJson();
        
        (new PagamentoModel())->insert($data);
		
		$response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Pagamento criado com sucesso'
          ]
	  ];        

    }

}
