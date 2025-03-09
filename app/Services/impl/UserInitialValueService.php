<?php

namespace App\Services\impl;

use App\Http\Requests\UserInitialValue\StoreUserInitialValueRequest;
use App\Http\Requests\UserInitialValue\UpdateUserInitialValueRequest;
use App\Http\Resources\UserInitialValue\UserInitialValueCollection;
use App\Http\Resources\UserInitialValue\UserInitialValueResource;
use App\Models\UserInitialValue;
use App\Services\IUserInitialValueService;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserInitialValueService implements IUserInitialValueService
{
    public function getAll()
    {
        $request=request();
        if(!$request->has('key')){
            $data = UserInitialValue::where('user_id',auth()->user()->id)->get();

        }
        else{
            if($request->get('key')=='fiscalYearId'){
                $data = UserInitialValue::where('user_id',auth()->user()->id)->get();
            }
            $data = UserInitialValue::where('user_id',auth()->user()->id)->where('key',$request->key)->get();
        }
        if ($data->isEmpty()) {
            throw new Exception('No Record Found', 1);
        }

        return UserInitialValueCollection::make($data);
    }

    public function getById( $id)
    {

        $response = UserInitialValue::find($id);
        if (! $response) {
            throw new NotFoundHttpException;
        }

        return new UserInitialValueResource($response);

    }

    public function store(StoreUserInitialValueRequest $request)
    {
        $request->validated();
         UserInitialValue::updateOrInsert(
            [
                'user_id' => auth()->id(), // Matching condition
                'key' => $request->input('key'), // Matching condition
            ],
            [
                'value' => $request->input('value'), // Update or insert this field
                'updated_at' => now(), // Set updated_at timestamp
            ]
        );
        $response = UserInitialValue::where('user_id', auth()->id())
    ->where('key', $request->input('key'))
    ->first();

        return UserInitialValueResource::make($response);
    }

    public function update(UpdateUserInitialValueRequest $request, $id)
    {
        $data = UserInitialValue::find($id);
        $response = $data->update($request->validated());
        if (! $response) {
            throw new NotFoundHttpException;
        }

        return UserInitialValueResource::make($data);

    }

    public function delete( $id)
    {
        $response = UserInitialValue::find($id);
        if (! $response) {
            throw new NotFoundHttpException;
        }
        $response->delete();

        return response()->noContent();

    }
}