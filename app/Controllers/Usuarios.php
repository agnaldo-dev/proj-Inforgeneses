<?php namespace App\Controllers;

use App\Models\UsuarioModel;


class Usuarios extends BaseController
{

    //retorna todos os usuarios 
    public function index(){

		$model = new UsuarioModel();

		$data['usuarios'] = $model->orderBy('id', 'DESC')->findAll();

		return $this->respond($data);
    }

    // cria um novo usuario
    public function create() {

        $model = new UsuarioModel();

        $data = (array) $this->request->getJson();
        		
		$model->insert($data);
		
		$response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Usuario criado com sucesso'
          ]
	  ];
	  
      return $this->respondCreated($response);
	
	}

    //retorna um usuarios por id
    public function show($id = null){

		$data = (new UsuarioModel())->where('id', $id)->first();

		if( !$data ){
	   
			return $this->failNotFound('Usuario não encontrado');
       
		}
		
		return $this->respond($data);
        
    }

    //autaliza um usuario por id
    public function update($id = null){

        $model = new UsuarioModel();

        $usuario = $model->find($id);

        if( !$usuario ) {
            
            return $this->respond([
                'status'   => 401,
                'error'    => null,
                'messages' => [
                    'success' => 'Usuario não encontrado'
                ]
            ]);
        }

		
        $data = (array) $this->request->getJson();
        
        $model->update($id, $data);
		
		return $this->respond([
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Usuario atualizado com sucesso'
          ]
	  ]);
	  
	}

    // delete usuarios por id
    public function delete($id = null){

        $model = new UsuarioModel();
		
		$data = $model->where('id', $id)->delete($id);
		
		if( !$data ){
	   
			return $this->failNotFound('Usuario não encontrado');
		}    
		
//		$model->delete($id);
		
		$response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Usuario deletado com sucesso'
                ]
            ];
		
		return $this->respondDeleted($response);
    }
}
