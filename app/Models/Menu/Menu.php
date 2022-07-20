<?php

namespace App\Models\Menu;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function profile()
    {
        return $this->hasOne(Has::class);
    }
    public function users()
    {
        return $this->hasOne(User::class, 'role', 'role_id');
    }
}
