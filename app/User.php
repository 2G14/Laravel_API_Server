<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table = 'users';
  public function scopeContains($query, string $field, string $value)
  {
    return $query->where($field, 'LIKE', '%'.$value.'%');
  }
  public function scopeStartsWith($query, string $field, string $value)
  {
    return $query->where($field, 'LIKE', $value.'%');
  }
  public function scopeEndsWith($query, string $field, string $value)
  {
    return $query->where($field, 'LIKE', '%'.$value);
  }
  public function scopeMatch($query, string $field, string $value)
  {
    return $query->where($field, $value);
  }
}
