<?php

namespace Modules\Account\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Account\Models\Account;
use Modules\Core\Repositories\CoreRepository;
use Modules\Core\Services\CollectionService;

class AccountRepository extends CoreRepository
{
    public function __construct()
    {
        $this->collectionService = new CollectionService();
        $this->model = new Account();
    }

    /**
     * generate balance for all accounts
     *
     * @return array
     */
    public function generateBalance(): array
    {
        return DB::select("
            SELECT
                a.id AS account_id,
                u.id AS user_id,
                SUM(
                    CASE WHEN t.type = 'deposit' THEN t.amount
                         WHEN t.type = 'transfer' AND t.from_account_id = a.id THEN -t.amount
                         WHEN t.type = 'transfer' AND t.to_account_id = a.id THEN t.amount
                         WHEN t.type = 'withdraw' THEN -t.amount
                         ELSE 0
                    END
                ) AS balance
            FROM
                accounts a
            LEFT JOIN
                users u ON u.id = a.user_id
            LEFT JOIN
                transactions t ON a.id = t.from_account_id OR a.id = t.to_account_id
            GROUP BY
                a.id
        ");
    }

    /*
     * generate balance for custom account
     *
     * @param int $account_id
     */
    public function generateBalanceForCustomAccount($account_id): array
    {
        return DB::select("
            SELECT
                a.id AS account_id,
                u.id AS user_id,
                SUM(
                    CASE WHEN t.type = 'deposit' THEN t.amount
                         WHEN t.type = 'transfer' AND t.from_account_id = a.id THEN -t.amount
                         WHEN t.type = 'transfer' AND t.to_account_id = a.id THEN t.amount
                         WHEN t.type = 'withdraw' THEN -t.amount
                         ELSE 0
                    END
                ) AS balance
            FROM
                accounts a
            LEFT JOIN
                users u ON u.id = a.user_id
            LEFT JOIN
                transactions t ON a.id = t.from_account_id OR a.id = t.to_account_id
            WHERE
                a.id = $account_id
            GROUP BY
                a.id
        ");
    }

    /**
     * update balance for account
     *
     * @param $account_id
     * @return array
     */
    public function updateBalance($account_id): array
    {
        $balance = $this->generateBalanceForCustomAccount($account_id);
        $this->update('id' , $account_id , ['balance' => $balance[0]->balance]);
        return $balance;
    }
}
