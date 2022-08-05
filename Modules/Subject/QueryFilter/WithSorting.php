<?php

namespace Modules\Subject\QueryFilter;

trait WithSorting
{
    public array $asc;
    public array $desc;

    public function __construct($builder, $request)
    {
        parent::__construct($builder, $request);

        $this->asc = $this->request->get('asc', []);
        $this->desc = $this->request->get('desc', []);

        $this->applySorting();
    }

    protected function applySorting()
    {
        $this->applyAscSorting()
            ->applyDescSorting();
        return $this;
    }

    protected function applyAscSorting()
    {
        foreach ($this->asc as $field) {
            $this->builder->orderBy($field, 'asc');
        }
        return $this;
    }

    protected function applyDescSorting()
    {
        foreach ($this->desc as $field) {
            $this->builder->orderBy($field, 'desc');
        }
        return $this;
    }
}
