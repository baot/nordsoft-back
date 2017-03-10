<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model{

  protected $fillable = ['name', 'email', 'phone'];

  protected $table = 'participants';

  protected $name = 'name';

  protected $email = 'email';

  protected $phone = 'phone';
}
