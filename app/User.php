<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use App\Helpers\Images\PhotoManager;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Dialog;

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dialogs()
    {
        $id = $this->id;
        $where = Dialog::where('one_side_id', $id)->orWhere('other_side_id', $id);

        return $where->get();
    }

    public function getDialog( $with )
    {
        $with = (int) $with;
        $iam = $this->id;

        $result = Dialog::where( function($query) use ($iam, $with) {
                $query->where('one_side_id', $iam)
                    ->where('other_side_id', $with);
            })->orWhere(function ($query) use ($iam, $with) {
                $query->where('other_side_id', $iam)
                    ->where('one_side_id', $with);
            })->get();

        return $result;
    }

    public function messagesNotification()
    {
        return $this->hasOne('App\Models\MessagesNotification');
    }

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
    
    public function isAdmin()
    {
        if( $this->roles->where('id', 1)->count() == 1 ){
            return true;
        }
        elseif( $this->roles->where('id', 2)->count() == 1 ){
            return true;
        }
        
        return false;
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
    public function updateOne( $request )
    {
        $user = $this;
        $profile = $user->profile;
        $user->update( $request->all() ); 
        $profile->update( $request->except(['user_id']) );
        
    }

    public function updateAvatar( $request )
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

    public static function getVip()
    {
        $user = User::whereHas( 'roles', function (Builder $query) {
            $query->where('role_id', 3);
        })->first();

        return $user;
    }

    public function isVip()
    {
        return $this->roles->where('id', 3)->count() == 1;;
    }

    public function getLastFreePublications()
    {
        return num_decline( $this->free_publications, 'бесплатная публикация', 'бесплатной публикации', 'бесплатных публикаций' );
    }
}
