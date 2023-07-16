<?php

namespace Modules\Example\Http\Resources;

use Modules\Core\Http\Resources\CoreResource;

/**
 * @property mixed $name
 */
class ExampleResource extends CoreResource
{

    public function toArray($request): array
    {
        return [
            'name' => $this->name ,
        ];
    }
}
