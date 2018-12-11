<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use App\Http\Resources\User as UserResource;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Users\UserRepositoryInterface;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        return UserResource::collection(
            $this->user->getUser($request->search, $request->role_id)
        );
    }

    public function updateRole(Request $request, $id)
    {
        $this->validate($request, [
            'role_id' => 'required',
        ]);
        $user = $this->user->find($id);
        $this->authorize('updateRole', Auth::user());
        $user->update([
            'role_id' => $request->role_id,
        ]);

        return response()->json([
            'message' => config('api.update'),
        ], 200);
    }

    public function update(Request $request)
    {
        $errors = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'school' => 'string|max:255|nullable',
        ]);

        if ($errors->fails()) {
            return Response()->json(['errors' => $errors->errors()]);
        }
        $user = Auth::user();
        $this->authorize('update', $user);
        $user->update(
            $request->only(
                'name',
                'school'
            )
        );

        return response()->json([
            'message' => config('api.update'),
        ], 200);
    }

    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => config('api.update'),
        ], 200);
    }

    public function profile()
    {
        $user = Auth::user();

        return new ProfileResource($user);
    }

    public function updateAvatar(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpg,jpeg,png,bmp',
        ]);

        $user = Auth::user();

        if (isset($user->avatar)) {
            Storage::delete($user->avatar);
        }

        $path = $request->file('avatar')->store(config('api.avatar_folder'));

        $user->avatar = $path;

        $user->save();

        return $path;
    }
}
