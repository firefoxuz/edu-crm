<?php

namespace Modules\Subject\QueryFilter;

class SubjectFilter extends QueryFilter
{
    use WithSorting;

    public function name($value)
    {
        $this->builder->where('name', 'like', '%' . $value . '%');
    }
}

