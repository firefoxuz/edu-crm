<?php

namespace Modules\Subject\Actions;

use Modules\Subject\Entities\Subject;

class DestroySubjectAction
{
    public function destroy($subject_id)
    {
        $subject = Subject::query()->findOrFail($subject_id);
        $subject->delete();
        return $subject;
    }
}
