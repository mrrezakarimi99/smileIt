<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\Interfaces\FilterableModel;

class CoreModel extends Model implements FilterableModel
{

    public function getSearchFields(): array
    {
        return [];
    }

    public function getFilterFields(): array
    {
        return [];
    }

    public function getWithFields(): array
    {
        return [];
    }

    public function getCreatedAtAttribute($value): string
    {
        if ($value == null) {
            return '';
        }
        return date('Y-m-d H:i:s' , strtotime($value));
    }

    public function getUpdatedAtAttribute($value): string
    {
        if ($value == null) {
            return '';
        }
        return date('Y-m-d H:i:s', strtotime($value));
    }

    public function getDeletedAtAttribute($value): string
    {
        if ($value == null) {
            return '';
        }
        return date('Y-m-d H:i:s', strtotime($value));
    }

}
