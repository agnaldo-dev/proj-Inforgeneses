<?php namespace App\Controllers;

use App\Models\PedidoModel;


class Pedido extends BaseController
{

    // cria um novo Pedido
    public function create() {

        $model = new PedidoModel();

        $data = (array) $this->request->getJson();

		$model->insert($data);
		
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

}
