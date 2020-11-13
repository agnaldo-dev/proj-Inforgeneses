<?php namespace App\Controllers;

use App\Models\CursoModel;


class Cursos extends BaseController
{

    //retorna todos os Cursos 
    public function index(){

		$model = new CursoModel();
        
        
		$data['cursos'] = $model->orderBy('id', 'DESC')->findAll();

		return $this->respond($data);
    }

    // cria um novo Curso
    public function create() {

        $model = new CursoModel();


        $data = (array) $this->request->getJson();

		$model->insert($data);
		
		$response = [
          'status'   => 201,
          'error'    => null,
          'messages' => [
              'success' => 'Curso criado com sucesso'
          ]
	  ];
	  
      return $this->respondCreated($response);
	
	}

    //retorna um Cursos por id
    public function show($id = null){

		$data = (new CursoModel())->where('id', $id)->first();

		if( !$data ){
	   
			return $this->failNotFound('Curso não encontrado');
       
		}
		
		return $this->respond($data);
        
    }

    //autaliza um Curso por id
    public function update($id = null){

        $model = new CursoModel();

        $Curso = $model->find($id);

        if( !$Curso ) {
            
            return $this->respond([
                'status'   => 401,
                'error'    => null,
                'messages' => [
                    'success' => 'Curso não encontrado'
                ]
            ]);
        }

		
        $data = (array) $this->request->getJson();
        
        $model->update($id, $data);
		
		return $this->respond([
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Curso atualizado com sucesso'
          ]
	  ]);
	  
	}

    // delete Cursos por id
    public function delete($id = null){

        $model = new CursoModel();
		
		$data = $model->where('id', $id)->delete($id);

        if( !$data ){
	   
			return $this->failNotFound('Curso não encontrado');
		}    
		
		$response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Curso deletado com sucesso'
                ]
            ];
		
		return $this->respondDeleted($response);
    }
}
