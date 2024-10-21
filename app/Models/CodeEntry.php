<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

/* use App\Models\CodeType;
use App\Models\CodeCategory;
use App\Models\CodeTag;
use App\Models\CodeFile; */

class CodeEntry extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'user_id',
        'type_id',
        'category_id',
        'title',
        'url',
        'info',
        'code'
    ];

    /**
     * Get the user associated.
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            foreignKey: 'user_id'
        );
    }

    /**
     * Get the type associated.
     */
    public function type()
    {
        return $this->belongsTo(
            CodeType::class,
            foreignKey: 'type_id'
        );
    }

    /**
     * Get the category associated.
     */
    public function category()
    {
        return $this->belongsTo(
            CodeCategory::class,
            foreignKey: 'category_id'
        );
    }

     /**
     * Get the tags associated.
     */
    public function tags()
    {
        return $this->belongsToMany(
            CodeTag::class,
            table: 'code_entry_tag',
            foreignPivotKey: 'code_entry_id'
        )->withTimestamps();
    }

    /**
     * Get the Files associated.
     */
    public function files()
    {
        return $this->hasMany(
            CodeFile::class,
            foreignKey: 'code_id'
        );
    }
}
