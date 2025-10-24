<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
      'first_name','last_name','birth_year','phone','email','position',
      'experience','education','resume_path','status','meta'
    ];

    protected $casts = [
      'meta' => 'array',
    ];
}
