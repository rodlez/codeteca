<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeCategory extends Model
{
    use HasFactory;

   // protected array with the keys that are valid, when create method get the data array will have access to this keys
   protected $fillable = [
    'name'
];

/**
     * Get the entries associated with the category.
     */
    public function codes()
    {
        return $this->hasMany(
            CodeEntry::class,
            foreignKey: 'category_id'
        );
    }

}
