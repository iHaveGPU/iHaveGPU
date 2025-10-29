<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name','email','password','role',
        'phone','line_id','address1','address2','district','province','postcode',
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Helpers
    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isStaff(): bool     { return $this->role === 'staff'; }
    public function isCustomer(): bool  { return $this->role === 'customer'; }
    // (ถ้าต้องการ) แปลงรหัสผ่านอัตโนมัติ
    public function setPasswordAttribute($value)
    {
        if ($value && strlen($value) < 60) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
