<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplinesemployees extends Model
{
   protected $fillable = [
      'employee_id',
      'discipline_id'
  ];
   use HasFactory;
   public $timestamps = false;
   protected $table = 'disciplines-employees';
}

