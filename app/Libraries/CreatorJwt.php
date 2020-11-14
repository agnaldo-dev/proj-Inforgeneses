<?php namespace App\Libraries;

use App\Libraries\Jwt;

class CreatorJwt
{   


    /*************This function generate token private key**************/ 

    PRIVATE $key = "12345678908dgfDgDwerF8gdfgDvXcvF8cbcvvBvCxF8zAsSdfsftF";

    public function GenerateToken($data)
    {          
        $jwt = JWT::encode($data, $this->key);
        return $jwt;
    }

    /*************This function DecodeToken token **************/

    public function DecodeToken($token)
    {          
        $decoded = JWT::decode($token, $this->key, array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }

}