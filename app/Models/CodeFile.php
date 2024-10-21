<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CodeFile extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'code_id',
        'original_filename',
        'storage_filename',
        'path',
        'media_type',
        'size'
    ];

    /**
     * Get the Code entry associated with the file.
     */
    public function codes()
    {
        return $this->belongsTo(
            CodeEntry::class,
            foreignKey: 'code_id'
        );
    }
}
