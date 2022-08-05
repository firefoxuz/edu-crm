<?php

namespace Modules\User\QueryFilter;

use Modules\Subject\QueryFilter\WithSorting;

class UserFilter extends QueryFilter
{
    use WithSorting;

    public function full_name($value)
    {
        $this->builder->where('full_name', 'like', '%' . $value . '%');
    }

    public function email($value)
    {
        $this->builder->where('email', 'like', '%' . $value . '%');
    }

    public function role($value)
    {
        $this->builder->where('role', $value);
    }
}

