<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','password'
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

    public function posts()
    {
       return $this->hasMany(Post::class);
    }
    public function remove(){
        Storage::delete('/uploads/',$this->image);
        $this->delete();
    }
    public function getAvatar()
    {
        if($this->image==null)
        {
            return '/img/u0UVYy3oKYg.jpg';
        }
       return '/uploads/'.$this->image;
    }
    public function uploadImage($image)
    {
        if($this->image!=null)
        {
            Storage::delete('/uploads/',$this->image);
        }
        if ($image == null) {
            return;
        }
        $filename=Str::random(10);
        $image->storeAs('uploads/',$filename);
        $this->image=$filename;
        $this->save();
    }
    public function updatePassword($password)
    {
        if($password==null){
         return $this->password ;
        }
        $this->password=bcrypt($password);
        $this->save();
        return $this->password=bcrypt($password);
    }
}
