<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Actions\DestroyUserAction;
use Modules\User\Actions\StoreUserAction;
use Modules\User\Actions\UpdateUserAction;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\QueryFilter\UserFilter;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = (new UserFilter(User::query(), \request()))
            ->apply()
            ->paginate(30)
            ->appends(\request()->query());

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request, StoreUserAction $action)
    {
        return response()->json($action->store($request));
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id, UpdateUserAction $action)
    {
        return response()->json($action->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, DestroyUserAction $action)
    {
        return response()->json($action->destroy($id));
    }
}
