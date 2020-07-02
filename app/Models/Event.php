<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'date', 'city'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_event');
    }
}
