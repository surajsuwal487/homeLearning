<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiBaseController;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\UserAndRoles\Entities\Role;

class LoginController extends ApiBaseController
{
    public function login(Request $request)
    {
        try {
            // return 'hello';
            if ($request->login_type) {
                if ($request->login_type == 'facebook') {
                    if (!User::where('facebook_id', $request->id)->first()) {
                        $data['name'] = $request->name;
                        $data['slug'] = SlugService::createSlug(User::class, 'slug', $request->name);
                        $data['facebook_id'] = $request->id;
                        $data['facebook_token'] = $request->token;
                        if ($request->email) {
                            $data['email'] = $request->email;
                        }
                        if ($request->phone_no) {
                            $data['phone_no'] = $request->phone_no;
                        }
                        $result = $this->facebook($data);
                        Auth::loginUsingId($result->id);
                    } else {
                        $result = User::where('facebook_id', $request->id)->first();
                        Auth::loginUsingId($result->id);
                    }
                } elseif ($request->login_type == 'google') {
                    if (!User::where('google_id', $request->id)->first()) {
                        $data['name'] = $request->name;
                        $data['slug'] = SlugService::createSlug(User::class, 'slug', $request->name);
                        $data['google_id'] = $request->id;
                        $data['google_token'] = $request->token;
                        if ($request->email) {
                            $data['email'] = $request->email;
                        }
                        if ($request->phone_no) {
                            $data['phone_no'] = $request->phone_no;
                        }
                        $result = $this->google($data);
                        Auth::loginUsingId($result->id);
                    } else {
                        $result = User::where('google_id', $request->id)->first();
                        Auth::loginUsingId($result->id);
                    }
                }
            } else {
                $login = $request->validate([
                    'email' => 'required|string|',
                    'password' => 'required|string',
                ]);
                if (!Auth::attempt($login)) {
                    return $this->errorResponse("invalid login credentials", 500);
                }
            }
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            $user = Auth::user();
            if (isset($user->image)) {
                $user->image = asset('/storage/user/' . $user->id . '/' . $user->image);
            }
            $data = ['user' => $user, 'access_token' => $accessToken];
            return $this->successData("success", $data, 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $tokens = $request->user()->tokens;
            foreach ($tokens as $token) {
                $token->delete();
            }
            return $this->successResponse('Logged Out Successfully !', 200);
        } catch (\Exception $e) {
            return $this->errorData($e->getMessage(), 500);
        }
    }

    public function facebook(array $attributes)
    {
        try {
            $finduser = User::where('facebook_id', $attributes['facebook_id'])->first();
            if ($finduser) {
                return $finduser;
            } else {
                $user = $this->create($attributes);
                $role = Role::where('name', 'user')->first();
                $user->roles()->attach($role);
                return $user;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function google(array $attributes)
    {
        try {
            $finduser = User::where('google_id', $attributes['google_id'])->first();
            if ($finduser) {
                return $finduser;
            } else {
                $user = $this->create($attributes);
                $role = Role::where('name', 'user')->first();
                $user->roles()->attach($role);
                return $user;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create(array $attributes)
    {
        try {
            return User::create($attributes);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
