<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model {
    use HasFactory;
    public $table = "settings";

    protected $fillable = [
        'name',
        'value',
        'type'
    ];
    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public function getValueAttribute($value)
    {
        if (isset($this->attributes['type']) && $this->attributes['type'] == "file") {
            if (!empty($value)) {
                // Check if file exists in 'public' disk
                if (Storage::disk('public')->exists($value)) {
                    return url(Storage::url($value));
                } else {
                    return null; // Return only the file name if file not found
                }
            }
            return '';
        }

        return $value;
    }
}
