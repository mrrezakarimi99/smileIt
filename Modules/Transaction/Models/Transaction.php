<?php

namespace Modules\Transaction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\CoreModel;
use Modules\Transaction\Database\factories\TransactionFactory;
use Modules\Transaction\Http\Resources\TransactionCollection;
use Modules\Transaction\Http\Resources\TransactionResource;


class Transaction extends CoreModel
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'type',
        'to_user_id',
    ];

    const RESOURCE = TransactionResource::class;
    const RESOURCE_COLLECTION = TransactionCollection::class;

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

    protected static function newFactory(): TransactionFactory
    {
        return TransactionFactory::new();
    }

}
