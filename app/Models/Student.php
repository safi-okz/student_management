<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'class_id', 'section_id'];

    protected $with = ['classess', 'section'];

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function classess()  // Or 'classes'
    {
        return $this->belongsTo(Classess::class, 'class_id');
    }
}
