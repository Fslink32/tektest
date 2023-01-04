<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataModel extends Model
{
    use HasFactory;

    protected $table = 'tektest';

    protected $fillable = [
      'Nama','Alamat','Jenis_Kelamin'
   ];
}
