<?php

namespace Modules\Subject\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Subject\Database\factories\SubjectFactory;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return new SubjectFactory();
    }

}
