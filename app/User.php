<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';
  public function scopeContains($query, string $target, string $str)
  {
    return $query->where($target, 'LIKE', "%$str%");
  }
}
