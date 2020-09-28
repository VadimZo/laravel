<?php

namespace App\Models;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title', 'content','date','content'
    ];
    public function users()
    {
       return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
       return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        return $this->belongsToMany(
          Tag::class,
          'post_tags',
          'post_id',
          'tag_id'
        );
    }


    public function getCategoryTitle()
    {
        if ($this->category == null) {

            return ;
        }
       return $this->category->title;
    }
    public function getCategoryId()
    {
        return $this->category->id;
    }
    public function getTagsId()
    {
        return $this->tags->pluck('id')->all();
    }


    public function getTagsTitle()
    {

        if($this->tags->isEmpty())
        {
            return 'Нет тегов';
        }
       return implode(',',$this->tags()->pluck('title')->all());
    }
    public function uploadImage($image)
    {
        if ($image == null) {
            return;
        }

        Storage::delete('uploads/' . $this->image);
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads/', $filename);
        $this->image = $filename;
        $this->save();
    }
    public function getImage()
    {
        if ($this->image == null) {
            return 'Нет картинки';
        }
        return '/uploads/'.$this->image;

    }
    public function remove()
    {
        Storage::delete('uploads/' . $this->image);
        $this->delete();
    }
    public function is_featured($value)
    {
        if($value){
            $this->is_featured=1;
            $this->save();
        }
    }
    public function status($value)
    {
        if($value) {
            $this->status = 1;
            $this->save();
        }
    }
    public function setCategory($id)
    {
        $this->category_id=$id;
        $this->save();
    }
    public function setTags($ids)
    {
        if($ids==null)
        {
            return;
        }
        $this->tags()->sync($ids);
    }
    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d',$this->date)->format('F d, Y');
    }
    public function hasNext()
    {
        return self::where('id','>',$this->id)->min('id');
    }
    public function getNextImage()
    {
       return self::find($this->hasNext())->getImage();
    }
    public function hasPrevious()
    {
        return self::where('id','<',$this->id)->max('id');
    }
    public function getPreviousImage()
    {
        return self::find($this->hasPrevious())->getImage();
    }
    public function getPreviousTitle()
    {
        return self::find($this->hasPrevious())->title;
    }
    public function getNextTitle()
    {
        return self::find($this->hasNext())->title;
    }
    public function getPrevious()
    {
        return self::find($this->hasPrevious());
    }
    public function getNext()
    {
        return self::find($this->hasNext());
    }
    public function related()
    {
        return self::paginate(2)->except($this->id);
    }


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
