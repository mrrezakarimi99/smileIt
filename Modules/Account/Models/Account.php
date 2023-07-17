<?php

namespace Modules\Account\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Database\factories\AccountFactory;
use Modules\Account\Http\Resources\AccountCollection;
use Modules\Account\Http\Resources\AccountResource;
use Modules\Bank\Models\Bank;
use Modules\Core\Models\CoreModel;
use Modules\User\Models\User;


class Account extends CoreModel
{
    use HasFactory;

    const RESOURCE = AccountResource::class;
    const RESOURCE_COLLECTION = AccountCollection::class;
    const RULES = [
        'bank_id' => 'required|exists:banks,id' ,
        'user_id' => 'required|exists:users,id' ,
    ];
    protected $fillable = [
        'bank_id' ,
        'user_id' ,
        'account_number' ,
        'balance' ,
    ];

    /*
    |--------------------------------------------------------------------------
    | Internal API
    |--------------------------------------------------------------------------
    |
    */

    protected static function newFactory(): AccountFactory
    {
        return AccountFactory::new();
    }

    public function getSearchFields(): array
    {
        return [
            'account_number' ,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    |
    */

    public function getFilterFields(): array
    {
        return [
            'bank_id' ,
            'user_id' ,
        ];
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    |
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * convert account number to 4 digits
     *
     * @return string
     */
    public function getAccountNumberAttribute(): string
    {
        return implode('-' , str_split($this->attributes['account_number'] , 4));
    }

    /*
     * get balance
     *
     * @return string
     */
    public function getBalanceAttribute(): string
    {
        return number_format($this->attributes['balance'] , 2);
    }

}
