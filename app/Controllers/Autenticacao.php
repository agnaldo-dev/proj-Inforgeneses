<?php namespace App\Controllers;

use App\Libraries\CreatorJwt;

use App\Models\UsuarioModel;

class Autenticacao extends BaseController
{
 

    public function login(){

        $data = $this->request->getJson();

        $user = (new UsuarioModel)->where('email',$data->email)->first();

        if( !$user ){
            return $this->respond([
                'statusCode' => 401,
                'message'    => 'Usuario não existe'
            ], 401); 
        }
       
        $user = (Object) $user;
     
        if ( !password_verify($data->senha, $user->senha) ){
            return $this->respond([
                'statusCode' => 401,
                'message'    => 'Senha incorreta'
            ], 401); 
        }

        $token = $this->loginToken($user);

        return $this->respond([
            'statusCode' => 200,
            'message'    => 'OK',
            'Authenticate'=> $token
        ], 200);

    }
    
    public function loginToken($user)
    {
        $objOfJwt = new CreatorJwt();
        $tokenData['id'] = $user->id;
        $tokenData['nome'] = $user->nome;
        $tokenData['email'] = $user->email;
        $tokenData['timeStamp'] = Date('Y-m-d h:i:s');

        $jwtToken = $objOfJwt->GenerateToken($tokenData);

        return json_encode(array('Token'=>$jwtToken));
    }
    
    public function GetTokenData()
    {
       $objOfJwt = new CreatorJwt();
   
       $received_Token = $this->input->request_headers('Authorization');
       try
       {
            $jwtData = $objOfJwt->DecodeToken($received_Token['Token']);

           return $this->respond([
               'statusCode' => 200,
               'message'    => 'OK',
               'data'       => json_encode($jwtData) 
           ], 200);
       }
       catch (Exception $e)
       {
          
           return $this->respond([
               'statusCode' => 401,
               'message'    => $e->getMessage()
           ], 401);

       }
    }

//--------------------------------------------------------------------
}
