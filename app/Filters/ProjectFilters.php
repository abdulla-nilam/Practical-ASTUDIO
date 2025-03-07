<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProjectFilters
{
    /**
     * Apply query filters based on URL parameters.
     *
     * @param Builder $query
     * @param array   $filters
     * @return Builder
     */
    public function apply(Builder $query, array $filters): Builder
    {
        foreach ($filters as $field => $filterValue) {
            $operator = '=';
            $value = urldecode($filterValue);

            if (preg_match('/^(>=|<=|>|<|LIKE):?(.*)$/i', $value, $matches)) {
                $operator = strtoupper($matches[1]);
                $value = $matches[2];

                if ($operator === 'LIKE') {
                    $value = '%' . $value . '%';
                }
            }

            if (in_array($field, ['name', 'status'])) {
                $query->where($field, $operator, $value);
            } else {
                $query->whereHas('attributes', static function ($q) use ($field, $operator, $value) {
                    $q->whereHas('attribute', static function ($aq) use ($field) {
                        $aq->where('name', $field);
                    })->where('value', $operator, $value);
                });
            }
        }
        return $query;
    }
}
