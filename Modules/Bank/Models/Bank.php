<?php

namespace Modules\Bank\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Account\Models\Account;
use Modules\Bank\Database\factories\BankFactory;
use Modules\Bank\Http\Resources\BankCollection;
use Modules\Bank\Http\Resources\BankResource;
use Modules\Core\Models\CoreModel;


class Bank extends CoreModel
{
    use HasFactory;

    const RESOURCE = BankResource::class;
    const RESOURCE_COLLECTION = BankCollection::class;
    const RULES = [
        'name' => 'required|string|unique:banks,name,{{id}}' ,
    ];
    protected $fillable = ['name'];

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
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    |
    */

    protected static function newFactory(): BankFactory
    {
        return BankFactory::new();
    }

}
