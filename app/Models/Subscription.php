<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'token'];

    public function generateToken()
    {
        $token=Str::random(100);
        $this->token=$token;
        $this->save();
    }

}
