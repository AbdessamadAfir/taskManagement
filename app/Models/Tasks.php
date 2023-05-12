<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Tasks extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'task_name',
        'id_project',
        'dateStart',
        'dateEnd',
        'status',
        'description',
    ];

    public $sortable = [
        'task_name',
        'id_project',
        'dateStart',
        'dateEnd',
        'status',
        'description'
    ];
}
