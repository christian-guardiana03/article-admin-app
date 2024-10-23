<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'image',
        'date',
        'content',
        'status',
        'writer_id',
        'editor_id',
        'company_id'
    ];

    public function writer () {
        return $this->hasOne(User::class, 'id', 'writer_id');
    }

    public function editor () {
        return $this->hasOne(User::class, 'id', 'editor_id');
    }

    public function company () {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function versions () {
        return $this->hasMany(ArticleVersion::class, 'article_id')->orderBy('created_at', 'desc');
    }
}
