<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }

    public function checkPermissionAccess($permissionCheck){
        //user login co quyen xem menu
        //B1 lấy được tất cả các quyền của user dang login vào trong hệ thống
        $roles = auth()->user()->roles;
        //B2 so sánh giá trị đưa vào của router hiện tại xem có tồn tại trong các quyền đã lấy được hay ko
        foreach ($roles as $role) {
            $permissions = $role->permissions;

            if ($permissions->contains('key_code',$permissionCheck) ) {
                return true;
            }
        }

        return false;


        
    }
}
