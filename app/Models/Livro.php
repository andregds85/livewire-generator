<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'livros';

    protected $fillable = ['nome','ibsn','descricao'];
	
}
