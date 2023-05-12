<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class projects extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        
        'project_name', 
        'category',
        'dateStart',
        'dateEnd',
        'project_manager',
        'status',
        'description',

    ];

    public $sortable = [
        'project_name',
        'category',
        'dateStart',
        'dateEnd',
        'project_manager',
        'status',
        'description'
    ];
}
