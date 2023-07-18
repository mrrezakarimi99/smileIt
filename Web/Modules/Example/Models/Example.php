<?php

namespace Modules\Example\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\CoreModel;
use Modules\Example\Database\factories\ExampleFactory;
use Modules\Example\Http\Resources\ExampleCollection;
use Modules\Example\Http\Resources\ExampleResource;


class Example extends CoreModel
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name'];

    const RESOURCE = ExampleResource::class;
    const RESOURCE_COLLECTION = ExampleCollection::class;

    const RULES = [
        'name' => 'required|string|unique:groups,name,{{id}}' ,
    ];

    /*
    |--------------------------------------------------------------------------
    | Internal API
    |--------------------------------------------------------------------------
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    |
    */

    protected static function newFactory(): ExampleFactory
    {
        return ExampleFactory::new();
    }

}
