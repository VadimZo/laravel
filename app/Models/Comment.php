<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable=['text'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function allow()
    {
        $this->status = 1;
        $this->save();
    }

    public function disAlow()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggle_status()
    {
        if ($this->status == 0) {
            return $this->allow();
        }
        return $this->disAlow();
    }

}
