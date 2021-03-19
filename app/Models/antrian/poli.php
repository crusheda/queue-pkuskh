<?php

namespace App\Models\antrian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class poli extends Model
{
    protected $table = 'queue_poli';
    public $timestamps = true;
    use SoftDeletes;
}
