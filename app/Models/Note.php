<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'activity_id','nota'];

    // uno a muchos inversa
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    // uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
