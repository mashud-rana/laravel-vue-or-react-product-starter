<?php

namespace App\Services;

use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use PDF;
class SubscriberService extends BaseService
{
//    protected $fileUploadService;
    protected $userService;

    public function __construct(UserDetail $model, UserService $userService)
    {
        parent::__construct($model);
//        $this->fileUploadService = $fileUploadService;
        $this->userService = $userService;

    }
    public function createOrUpdate($request, int $id = null): mixed
    {
        $data           = $request->all();
        if ($id) {
            // Update
            $user           = $this->userService->getWithTrashed($id, ['userDetail'=>function($q){
                $q->withTrashed();
            }]);
            $userProfile    = $this->getWithTrashed($user->userDetail->id);
            // Password
            if (isset($data['password']) && $data['password']) {
                $user->password = Hash::make($data['password']);
            }

            // Avatar
            if (isset($data['avatar']) && $data['avatar'] != null) {
                $user->avatar = $this->fileUploadService->uploadFile($request,'avatar',User::FILE_STORE_PATH,$user->avatar);
            }
            $user->first_name       = $data['first_name'];
            $user->last_name        = $data['last_name'];
            $user->email            = $data['email'];
            $user->phone            = $data['phone'];
            $user->gender           = $data['gender'];
            $user->type             = User::TYPE_SUBSCRIBER;
            $user->status           = $data['status'];
            $user->updated_by       = Auth::id();

            // Update user
            $user->save();

            $userProfile->update($data);

            return $user;
        } else {
            // Create
            $data['password']        = Hash::make($data['password']);
            if (isset($data['avatar']) && $data['avatar'] != null) {
                $data['avatar']      = $this->fileUploadService->uploadFile($request,'avatar',User::FILE_STORE_PATH,);
            }
            $data['created_by']         = Auth::id();
            $data['type']               = User::TYPE_SUBSCRIBER;
            // Store user
            $user                       = User::create($data);
            $data['user_id']            = $user->id;
            $userDetail                 = UserDetail::create($data);

            return $userDetail;

        }
    }

    public function updatePersonalDetails($request){
        $data           = $request->all();
        $user           = $this->userService->getWithTrashed(auth()->user()->id,['userDetail'=>function($q){
            $q->withTrashed();
        }]);
        // Password
        if (isset($data['password']) && $data['password']) {
            $user->password = Hash::make($data['password']);
        }

        // Avatar
        if (isset($data['avatar']) && $data['avatar'] != null) {
            $user->avatar = $this->fileUploadService->uploadFile($request,'avatar',User::FILE_STORE_PATH,$user->avatar);
        }
        $user->first_name       = $data['first_name'];
        $user->last_name        = $data['last_name'];
        $user->email            = $data['email'];
        $user->phone            = $data['phone'];
        if(isset($data['gender'])){
            $user->gender           = $data['gender'];
        }
        $user->type             = User::TYPE_SUBSCRIBER;
        $user->status           = User::STATUS_ACTIVE;
        $user->updated_by       = Auth::id();

        // Update user
        $user->save();

        $userProfile    = $this->getWithTrashed($user->userDetail->id);

        $userProfile->update($data);
        return $userProfile;
    }
    public function updateAvatar($request){
        $data           = $request->all();
        $user           = $this->userService->get(auth()->user()->id);
        // Avatar
        if (isset($data['avatar']) && $data['avatar'] != null) {
            $user->avatar = $this->fileUploadService->uploadFile($request,'avatar',User::FILE_STORE_PATH,$user->avatar);
        }
        $user->updated_by       = Auth::id();

        // Update user
        $user->save();

        return $user;
    }
    public function updatePassword($request){
        $data           = $request->all();
        $user           = $this->userService->get(auth()->user()->id);
        // Password
        if (isset($data['password']) && $data['password']) {
            $user->password = Hash::make($data['password']);
        }
        $user->updated_by       = Auth::id();

        // Update user
        $user->save();

        return $user;
    }
    public function deleteProfile($id)
    {
        $user       = $this->userService->get($id,['userDetail'=>function($q){
            $q->withTrashed();
        }]);
        $student    = $this->get($user->userDetail->id);

        $user->tokens()->delete();
        $user->delete();
        $student->delete();
        return $user;
    }


}
