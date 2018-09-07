<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Lunaweb\EmailVerification\Traits\CanVerifyEmail;
use Lunaweb\EmailVerification\Contracts\CanVerifyEmail as CanVerifyEmailContract;


/**
 * App\Models\Users\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $email_verified_at
 * @property bool $verified
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users\User whereVerified($value)
 */
class User extends Authenticatable implements CanVerifyEmailContract
{
    use Notifiable, HasApiTokens, CanVerifyEmail;

    /**
     * Custom Model Event
     *
     * @var array
     */
    protected $observables = ['verified'];


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
     * Verifies the user Email status
     *
     */
    public function verifyEmail()
    {
        $this->forceFill([
            'verified' => true
        ])->save();

        $this->fireModelEvent('emailVerified', false);
    }
}
