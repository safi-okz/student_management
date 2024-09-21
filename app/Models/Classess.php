<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classess extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function sections() {
        return $this->hasMany(Section::class, 'class_id');
    }
}
