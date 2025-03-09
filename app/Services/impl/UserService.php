<?php

namespace App\Services\impl;

use App\Exceptions\ModelNotFoundException as ExceptionsModelNotFoundException;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\IUserService;
use Exception;

class UserService implements IUserService
{
    public function getAll()
    {

        $users = User::all();

        if ($users->isEmpty()) {
            return response()->json([
                'message' => 'No records found.',
            ], 404); // Return 404 status code
        }

        return UserCollection::make($users);

    }

    public function getById(int $id)
    {

        try {
            $response = User::findOrFail($id);

            return UserResource::make($response);
        } catch (Exception $e) {
            // Handle the case where the model is not found
            // throw new ExceptionsModelNotFoundException($e);
            // return new ExceptionsModelNotFoundException($e);
            return response()->json([
                'status' => false,
                'message' => 'Record not found.',
                'code' => 404,
            ], 404);
        }
    }

    public function store(StoreUserRequest $request)
    {
        $response = User::create($request->validated());

        return UserResource::make($response);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $response = User::find($id)->update($request->validated());

        return UserResource::make($response);
    }

    public function delete(int $id)
    {
        User::find($id)->delete();

        return response()->noContent();
    }

    public function profile()
    {
        $response = auth()->user();

        return UserResource::make($response);
    }
}
