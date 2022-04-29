<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

    //muchos a muchos
    public function users(){
        return $this->belongsToMany(User::class);
    }

    /**
     * Relación uno a muchos inversa.
     *
     */
    public function note() {
        return $this->belongsTo(Note::class);
    }

    public function file() {
        return $this->belongsTo(File::class);
    }    



}
