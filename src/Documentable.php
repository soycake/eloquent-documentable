<?php

namespace Baraear\Documentable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Documentable
{

    /**
     * Hook into the eloquent model events to create the document number as required.
     */
    public static function bootDocumentable()
    {
        static::observe(app(DocumentableObserver::class));
    }

    /**
     * Return the documentable configuration array for this model.
     *
     * @return array
     */
    abstract public function documentable(): array;

}