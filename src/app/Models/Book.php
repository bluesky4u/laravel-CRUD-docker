<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

class Book extends EloquentModel
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title',
        'author',
    ];

    public $sortable = ['id', 'author', 'title'];

    /**
     * @var array
     */
    protected $guarded = [
        'id',
        'title',
        'author',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'created_at' => 'immutable_datetime',
        'updated_at' => 'immutable_datetime',
    ];
}
