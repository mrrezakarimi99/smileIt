<?php

namespace Modules\Transaction\Http\Resources;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $name
 */
class TransactionResource extends CoreResource
{

    public function toArray($request): array
    {
        return [
            'name' => $this->name ,
        ];
    }
}
