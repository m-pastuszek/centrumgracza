<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'active',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
        'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'activation_token',
    ];

    protected $dates = [
        'deleted_at',
        'email_verified_at' => 'datetime',

    ];

    /**
     * If user role is admin returns true.
     *
     * @return bool
     */


    public function isAdmin() {
        if($this->role->name == 'admin'){
            return true;
        }
        return false;
    }

    /**
     * Build Social Relationships.
     *
     * @return mixed
     */
    public function social()
    {
        return $this->hasMany(Social::class);
    }

    /**
     * User Profile Relationships.
     *
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // User Profile Setup - SHould move these to a trait or interface...

    public function profiles()
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

    /**
     * User Articles Relationships
     *
     * @return mixed
     */
    public function articles() {
        return $this->hasMany(Article::class);
    }

    /**
     * User Reviews Relationships
     *
     * @return mixed
     */
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    /**
     * User Country Relationship
     *
     * @return mixed
     */

    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name == $name) {
                return true;
            }
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
