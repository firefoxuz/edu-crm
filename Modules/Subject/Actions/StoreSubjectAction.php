<?php

namespace Modules\Subject\Actions;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Subject\Entities\Subject;

class StoreSubjectAction
{
    public function store(FormRequest $formRequest)
    {
        $subject = new Subject();
        $subject->fill(
            $formRequest->only($subject->getFillable())
        );
        $subject->save();
        return $subject;
    }
}
