<?php

namespace Modules\UserAndRoles\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Api\ApiBaseController;
use App\Models\VerificationCode;
use App\Models\User;
use Modules\UserAndRoles\Entities\Role;
use Modules\UserAndRoles\Repository\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Repository\ImageRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\UserAndRoles\Emails\SendVerificationCode;
use Modules\UserAndRoles\Http\Requests\UserRequest;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Modules\UserAndRoles\Http\Requests\UserUpdateRequest;
use Illuminate\Http\File;

class UserController extends ApiBaseController
{

    private $userRepository;
    private $imageRepository;

    public function __construct(UserRepository $userRepository, ImageRepository $imageRepository)
    {
        $this->userRepository = $userRepository;
        $this->imageRepository = $imageRepository;
    }

    public function registerVerification(Request $request)
    {
        try {

            $existing    = User::where('email', $request->email)->first();
            if (isset($existing)) {
                return $this->errorResponse("Email already exist", 500);
            }
            $existing_phone   = User::where('phone_no', $request->phone_no)->first();
            if (isset($existing_phone)) {
                return $this->errorResponse("Phone Number already exist", 500);
            }
            $verification_code = rand(1000, 9999);
            $data = [
                'verification_code' => $verification_code,
            ];
            Mail::to($request->email)->send(new SendVerificationCode($data));
            // return 'hello';
            $data['verification_code'] = $verification_code;
            $code = $this->userRepository->saveCode($data);
            if ($code) {
                return $this->successData("Verification Code Sent Successfully", $code, 200);
            } else {
                return $this->errorResponse("There is something error in the Server while Sending Verification Code", 500);
            }
        } catch (\Exception $e) {
            dd($e);
            $exception = $e->getMessage();
            return redirect()->back()->with('error', $exception);
        }
    }

    public function register(UserRequest $request)
    {
        try {
            $code = VerificationCode::where('verification_code', $request->verification_code)->first();
            if (!isset($code)) {
                return $this->errorResponse("Verification Code does not match", 500);
            }
            $user        = new User();
            $user->email = $request->email;
            $user->name       = $request->name;
            $user->slug   = SlugService::createSlug(User::class, 'slug', $request->name);
            if ($request->password !== $request->confirm_password) {
                return $this->errorResponse("Password does not match", 500);
            }
            $user->password = Hash::make($request->password);
            $user->phone_no    = $request->phone_no;
            if ($user->save()) {
                $userrole = Role::where('name', 'user')->first();
                $user->roles()->attach($userrole);
                $data = ['user' => $user];
                return $this->successData('User created Successfully', $data, 200);
            } else {
                return $this->errorResponse("Unable to save due to some incorrect data", 500);
            }
            return $this->errorResponse("failed to save", 500);
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("Failed to register user", $e, 500);
        }
    }

    public function updateProfile(UserUpdateRequest $request)
    {
        try {
            $user = auth()->guard('api')->user();
            if ($request->hasFile('image')) {
                if ($user->image) {
                    Storage::delete('public/user/' . $user->id . '/' . $user->image);
                }
                $image    = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/user/' . $user->id . '/', new File($image), $filename);
                //resize_crop_images(250, 100, $image, "public/user/" . $user->id . '/thumb_' . $filename);
                $user->image = $filename;
            }
            if ($request->has('name')) {
                $user->name = $request->name;
            }
            if ($request->has('email')) {
                $user->email = $request->email;
            }
            if ($request->has('gender')) {
                $user->gender = $request->gender;
            }
            if ($request->has('dateofbirth')) {
                $user->dateofbirth = $request->dateofbirth;
            }
            if ($request->has('address')) {
                $user->address = $request->address;
            }
            if ($request->has('phone_no')) {
                $user->phone_no = $request->phone_no;
            }

            if ($user->save()) {
                return [
                    "success" => "User updated successfully",
                ];
            } else {
                return $this->errorData("failed to update", 500);
            }
            return $this->errorData("failed to update", 500);
        } catch (\Exception $e) {
            return $this->errorData("failed to update", $e, 500);
        }
    }


    public function changePassword(Request $request)
    {
        try {
            if ($request->newpassword != $request->confirmpassword) {
                return $this->errorResponse("New password and Confirm password does not match", 500);
            }
            $user = auth()->guard('api')->user();
            if (!Hash::check($request->currentpassword, $user->password)) {
                return $this->errorResponse("Current Password do not match", 500);
            }
            $user->password = Hash::make($request->newpassword);
            if ($user->save()) {
                //  return [
                //   "success" => "Password Updated Successfully",
                //  ];
                return $this->successResponse("Password Changed Successfully", 200);
            }
            return $this->errorResponse("Failed to change password", 500);
        } catch (\Exception $e) {
            return $this->errorData("Failed to change password", $e, 500);
        }
    }


    public function sendVerificationCode(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (!isset($user->id)) {
                return $this->errorResponse("The user with this email does not exist", 500);
            }
            $verification_code = rand(1000, 9999);
            $data              = [
                'verification_code' => $verification_code,
            ];
            Mail::to($user->email)->send(new SendVerificationCode($data));
            $user->verification_code = $verification_code;
            if ($user->save()) {
                return $this->successResponse("Verification Code Sent Successfully", 200);
            } else {
                return $this->errorResponse("There is something error in the Server while Sending Verification Code", 500);
            }
        } catch (\Exception $e) {
            return $e;
            return $this->errorData("failed to send Verification Code", $e, 500);
        }
    }

    public function checkVerificationCode(Request $request)
    {
        try {
            if (!isset($request->verification_code)) {
                return redirect()->back()->with('error', "Please Enter the verification code");
            }
            $user = User::where('email', $request->email)->first();
            if ($request->verification_code == $user->verification_code) {
                $user->verification_code = NULL;
                $user->save();
                return $this->successResponse("Verification Code Verified Successfully", 200);
            } else {
                return $this->errorResponse("Verification code does not match", 500);
            }
        } catch (\Exception $e) {
            return $this->errorData("failed to send Verification Code", $e, 500);
        }
    }

    public function changeForgotPassword(Request $request)
    {
        try {
            if ($request->newpassword != $request->confirmpassword) {
                return $this->errorResponse("New password and Confirm password does not match", 500);
            }
            $user = User::where('email', $request->email)->first();

            // return $request->email;

            $user->password = Hash::make($request->newpassword);
            if ($user->save()) {
                return $this->successResponse("Password Changed Successfully", 200);
            }
            return $this->errorResponse("Unable to change password", 500);
        } catch (\Exception $e) {
            return $this->errorData("Failed to change password", $e, 500);
        }
    }
}
