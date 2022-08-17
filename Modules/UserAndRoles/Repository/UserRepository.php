<?php

namespace Modules\UserAndRoles\Repository;

use App\Repository\BaseRepository;
use App\Models\User;
use App\Models\VerificationCode;


use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Facades\DB;  

class UserRepository extends BaseRepository
{

   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
    public function allCustomer(): Collection
    {
        return $this->model->whereHas('roles', function($q){
            $q->where('name','user');
        })->get();
    }

    public function allAdmin(): Collection
    {
        return $this->model->whereHas('roles', function($q){
            $q->where('name','admin');
            $q->orWhere('name','superadmin');
        })->get();
    }

    public function saveCode(array $attributes):Model
    {
        try {
            DB::beginTransaction();
            $data = VerificationCode::create($attributes);
            DB::commit();
            return $data;
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function getSingleUser($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function removeCode($code)
    {
        try {
            DB::beginTransaction();
            $data = VerificationCode::where('verification_code',$code)->delete();
            DB::commit();
            return $data;
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            echo $e->getMessage();
        }
    }

    public function create(array $attributes):Model
    {
        try {
            DB::beginTransaction();
            $data = $this->model->create($attributes);
            DB::commit();
            return $data;
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            echo $e->getMessage();
        }
    }

   /**
    * @return success
    */
    public function update(array $attributes,$id):Model
    {
        try {
            DB::beginTransaction();
            $data = $this->model->find($id);
            $return_data = $data->update($attributes);
            DB::commit();
            return $data;
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            echo $e->getMessage();
        }
    }
}