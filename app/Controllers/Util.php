<?php namespace App\Controllers;

class util extends BaseController
{

    protected function response($res){

		return [
            'status'   => $res['status'],
            'error'    => $res['errors'],
            'messages' => $res['mens']
        ];

    }
	
}
