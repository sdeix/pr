<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
   protected $fillable = [
      'discipline_name'
  ];
   use HasFactory;
   public $timestamps = false;
   protected $table = 'disciplines';
}

