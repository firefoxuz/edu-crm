<?php

namespace Modules\Subject\Actions;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Subject\Entities\Subject;

class UpdateSubjectAction
{
    public function update(FormRequest $formRequest, $subject_id)
    {
        $subject = Subject::query()->findOrFail($subject_id);
        $subject->fill(
            $formRequest->only($subject->getFillable())
        );
        $subject->save();
        return $subject;
    }
}
