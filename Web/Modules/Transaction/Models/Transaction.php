<?php

namespace Modules\Transaction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Account\Models\Account;
use Modules\Core\Models\CoreModel;
use Modules\Transaction\Database\factories\TransactionFactory;
use Modules\Transaction\Http\Resources\TransactionCollection;
use Modules\Transaction\Http\Resources\TransactionResource;
use Modules\User\Models\User;


class Transaction extends CoreModel
{
    use HasFactory;

    protected $fillable = [
        'user_id' ,
        'amount' ,
        'description' ,
        'type' ,
        'from_account_id' ,
        'to_account_id' ,
    ];

    const RESOURCE = TransactionResource::class;
    const RESOURCE_COLLECTION = TransactionCollection::class;

    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_TRANSFER = 'transfer';

    const TYPES = [
        self::TYPE_DEPOSIT ,
        self::TYPE_WITHDRAW ,
        self::TYPE_TRANSFER ,
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
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fromAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class , 'from_account_id');
    }

    public function toAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class , 'to_account_id');
    }

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


    public function getSearchFields(): array
    {
        return [
            'description' ,
        ];
    }

    public function getFilterFields(): array
    {
        return [
            'type' ,
            'user_id' ,
            'from_account_id' ,
            'to_account_id' ,
        ];
    }

    public function getWithFields(): array
    {
        return [];
    }

}
