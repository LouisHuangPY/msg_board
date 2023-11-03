<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use HasUuids;

    // comment相關param，不做身分認證、只留留言者名稱
    protected $fillable = [
        'name',
        'message',
        'parent_id'
    ];

    // 做一個recursive的結構，方便取得層狀留言
    // 與User的relationship依照需求再作調整
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

}
