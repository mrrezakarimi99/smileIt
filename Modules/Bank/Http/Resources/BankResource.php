<?php

namespace Modules\Bank\Http\Resources;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $created_at
 */
class BankResource extends CoreResource
{

    public function toArray($request): array
    {
        return [
            'id'         => $this->id ,
            'name'       => $this->name ,
            'created_at' => $this->created_at ,
        ];
    }
}
