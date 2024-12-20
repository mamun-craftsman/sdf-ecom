<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Farmer extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $primaryKey = 'id'; // Custom Primary Key (e.g., nameMobile_Number)
    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Primary key is a string

    protected $fillable = [
        'id',
        'name',
        'mobile_number',
        'division',
        'district',
        'sub_district',
        'address',
        'nid',
        'assets',
        'is_verified',
        'password',
        'payable',
        'due',
        'image', // New column for farmer image
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'assets' => 'array', // Cast JSON field to array
    ];

    // Boot method to generate custom primary key
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($farmer) {
            if (empty($farmer->id)) {
                $farmer->id = preg_replace('/\s+/', '', $farmer->name) . $farmer->mobile_number;

            }
        });
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class, 'farmer_id'); // Farmer has many products
    }

    // Accessors & Mutators
    public function setAssetsAttribute($value)
    {
        $this->attributes['assets'] = json_encode($value);
    }

    public function getAssetsAttribute($value)
    {
        return json_decode($value, true);
    }
}
