<?php namespace App\Controllers;

use App\Models\PagamentoModel;

class Pagamentos extends BaseController
{
    
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
