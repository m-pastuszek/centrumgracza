<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'bio',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'twitch_url',
        'website_url',
        'background',
        'gender',
        'birth_date',
        'my_hardware'
        ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country() {
        return $this->belongsTo(Country::class);
    }
}
