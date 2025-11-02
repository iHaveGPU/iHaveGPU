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
    if (empty($value)) {
        $this->attributes['password'] = null;
        return;
    }

    // ถ้าเป็น bcrypt อยู่แล้ว (ขึ้นต้นด้วย $2y$ และยาว ~60) ให้เก็บตรง ๆ
    if (is_string($value) && strlen($value) === 60 && str_starts_with($value, '$2y$')) {
        $this->attributes['password'] = $value;
    } else {
        $this->attributes['password'] = bcrypt($value);
    }
}

}
