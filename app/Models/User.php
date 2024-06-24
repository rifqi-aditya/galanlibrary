<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    const PICTURE_PATH = 'user-pictures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'address',
        'date_of_bird',
        'picture',
        'attendance_token',
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
        'date_of_bird' => 'date:Y-m-d',
    ];

    public static function booted()
    {

        static::deleted(function ($user) {
            if ($user->picture) {
                Storage::delete(self::PICTURE_PATH . '/' . $user->picture);
            }
        });

        static::creating(function ($user) {
            $user->username = uniqid();
        });

        static::created(function ($user) {

            if ($user->picture) {
                $imageManager = new ImageManager();
                $picture = $imageManager->make('app/' . self::PICTURE_PATH . '/' . $user->picture);
                $width = $picture->getWidth();
                $height = $picture->getHeight();
                $size = min([$width, $height]);
                $picture->fit($size, $size, null, 'center');
                $picture->save('app/' . self::PICTURE_PATH . '/' . $user->picture);
            }
        });

        static::updated(function ($user) {
            if ($user->picture) {
                $imageManager = new ImageManager();
                $picture = $imageManager->make(storage_path('app/' . self::PICTURE_PATH . '/' . $user->picture));
                $width = $picture->getWidth();
                $height = $picture->getHeight();
                $size = min([$width, $height]);
                $picture->fit($size, $size, null, 'center');
                $picture->save(storage_path('app/' . self::PICTURE_PATH . '/' . $user->picture));
            }
        });
    }

    public function pictureURL()
    {
        if ($this->picture !== null) {
            return route('user-pictures', ['path' => $this->picture]);
        }

        $email = strtolower($this->email);
        $hash = md5($email);

        return 'https://www.gravatar.com/avatar/' . $hash . '?s=200';
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
