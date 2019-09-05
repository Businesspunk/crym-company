<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use App\Models\PhotoManager;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->using('App\Models\RoleUser');
    }

    public function deleteOne()
    {
        $user = $this;
        $posts = $user->posts;

        foreach( $posts as $post ){
            $post->deleteOne();
        }
        $photo = $user->profile->photo;

        if( isExistsPhoto($photo) ){
            Storage::delete($photo);
        }
        
        $user->delete();
    }
    public function updateOne( Request $request )
    {
        $user = $this;
        $profile = $user->profile;
        $user->update( $request->all() ); 
        $profile->update( $request->except(['user_id']) );
        
    }

    public function updateAvatar( Request $request )
    {
        $user = $this;
        $profile = $user->profile;
        $path = PhotoManager::savePhoto( $request->file('avatar'), 'avatars', 'avatarUpload' );
        Storage::delete( $profile->photo );
        $profile->photo = $path;
        $profile->save();

        return $path;
    }

    public function getActivePosts()
    {
        return $this->posts()->where('isClose', '=', null)->get();
    }

    public function getClosedPosts()
    {
        return $this->posts()->where('isClose', '!=', null)->get();
    }
}
