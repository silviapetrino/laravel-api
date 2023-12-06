<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Project;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function projects(){
        return $this->belongsToMany(Project::class);
    }

    public static function generateSlug($title){
        $slug = Str::slug($title, "-");
        $original_slug = $slug;
        $exists = Project::where("slug", $slug)->first();
        $c = 1;
        while($exists){
            $slug = $original_slug . "-" . $c;
            $exists = Project::where("slug", $slug)->first();

            $c++;
        }
        return $slug;
    }
}
