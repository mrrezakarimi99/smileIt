<?php

namespace Modules\Core\Traits;

trait Sluggable
{
    public function setSlugAttribute($slug): void
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '_', $slug);
        $this->attributes['slug'] = strtolower($slug);
    }
}
