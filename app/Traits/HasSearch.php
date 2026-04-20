<?php


namespace App\Traits;

trait HasSearch
{
    public function scopeSearch($query, $search = null)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {

            // check if model has searchable columns
            if (!property_exists($this, 'searchable')) {
                return $q;
            }

            foreach ($this->searchable as $column) {
                $q->orWhere($column, 'LIKE', "%{$search}%");
            }
        });
    }
}
