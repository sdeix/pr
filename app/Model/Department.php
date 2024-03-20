<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
   protected $fillable = [
      'Название кафедры'
  ];
   use HasFactory;
   public $timestamps = false;
   protected $table = 'кафедры';
}

