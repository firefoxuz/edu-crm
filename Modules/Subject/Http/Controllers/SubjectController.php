<?php

namespace Modules\Subject\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Subject\Actions\DestroySubjectAction;
use Modules\Subject\Actions\StoreSubjectAction;
use Modules\Subject\Actions\UpdateSubjectAction;
use Modules\Subject\Entities\Subject;
use Modules\Subject\Http\Requests\StoreSubjectRequest;
use Modules\Subject\Http\Requests\UpdateSubjectRequest;
use Modules\Subject\QueryFilter\SubjectFilter;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $subjects = (new SubjectFilter(Subject::query(), request()))
            ->apply()
            ->paginate(30)
            ->appends(request()->query());
        return response()->json($subjects);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSubjectRequest $request, StoreSubjectAction $action)
    {
        return response()->json($action->store($request), Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     * @param Subject $subject
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Subject $subject)
    {
        return response()->json($subject);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSubjectRequest $request, $id, UpdateSubjectAction $action)
    {
        return response()->json($action->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, DestroySubjectAction $action)
    {
        return response()->json($action->destroy($id));
    }
}
