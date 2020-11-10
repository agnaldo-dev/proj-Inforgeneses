<?php namespace App\Controllers;

//use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\UsuarioModel;


class Usuario extends BaseController
{

    use ResponseTrait;

    //retorna todos os usuarios 
    public function index(){

		$model = new UsuarioModel();

		$data['usuarios'] = $model->orderBy('id', 'DESC')->findAll();

		return $this->respond($data);
    }

    // cria um novo usuario
    public function create() {

        $model = new UsuarioModel();
		
		$data = [
            'nome' => $this->request->getVar('nome'),
            'email'  => $this->request->getVar('email'),
            'senha'  => $this->request->getVar('senha'),
        ];
		
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
    public function getUsuarios($id = null){

		$data = (new UsuarioModel())->where('id', $id)->first();

		if( !$data ){
	   
			return $this->failNotFound('Not Found');
       
		}
		
		return $this->respond($data);
        
    }

    //autaliza um usuario por id
    public function update($id = null){

		$model = new UsuarioModel();

		$id = $this->request->getVar('id');

		$data = [
            'nome' => $this->request->getVar('nome'),
            'email'  => $this->request->getVar('email'),
            'senha'  => $this->request->getVar('senha')
		];
		
        $model->update($id, $data);
		
		$response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Usuario atualizado com sucesso'
          ]
	  ];
	  
      return $this->respond($response);
	
	}

    // delete usuarios por id
    public function delete($id = null){

        $model = new UsuarioModel();
		
		$data = $model->where('id', $id)->delete($id);
		
		if( !$data ){
	   
			return $this->failNotFound('No employee found');
		}    
		
		$model->delete($id);
		
		$response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Employee successfully deleted'
                ]
            ];
		
		return $this->respondDeleted($response);
    }
}
