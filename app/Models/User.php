<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory;
    
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'department_id',
        'is_leader',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class,'user_projects');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
