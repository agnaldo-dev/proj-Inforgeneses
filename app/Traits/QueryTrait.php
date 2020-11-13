<?php namespace App\Traits;

/**
 * Query trait.
 *
 * Executa querys de models 
 * Retona array como resultado ou null
 */
trait QueryTrait
{
 
    public function query($db,$sql){

        try {

            $query = $db->query($sql);
        
            if ($query === false) {
                throw new Exception($db->error()['message'], $db->error()['code']);
            }

            return $query->getResult();
        
        } catch (Exception $e) {
            return null;
        }

    }

}