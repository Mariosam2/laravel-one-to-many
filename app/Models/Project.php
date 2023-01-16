<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'img', 'description', 'creation_date'];

    public  function getProjectWithSlug()
    {
        $this->setAttribute('slug', Str::slug($this->getAttribute('title')));
        return $this;
    }
}
