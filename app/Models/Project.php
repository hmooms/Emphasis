<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'customer',
        'contact',
        'contact_phone',
        'contact_email',
        'is_completed'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
