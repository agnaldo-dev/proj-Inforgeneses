<?php 
namespace App\Models;
use CodeIgniter\Model;


class CursoModel extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome','valor'];

}
