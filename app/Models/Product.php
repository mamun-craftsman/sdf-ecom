<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id'; // Single Custom Primary Key (day-month-year-FarmerID)
    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Primary key is a string

    protected $fillable = [
        'id',
        'name',
        'category_id',
        'title',
        'mrp_price',
        'whole_sale_price',
        'producer_price',
        'short_description',
        'long_description',
        'farmer_id',
        'is_approved',
        'approved_by',
        'agent_id',
        'hubpoint_id',
        'contents',
        'thumbnail_image',
        'estimated_stock',
        'stock',
        'unit_type',
        'origin_from',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
        'contents' => 'array', // Cast JSON field to array
    ];

    // Boot method to generate custom primary key
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->id)) {
                $product->id = now()->format('d-m-y') . '-' . $product->farmer_id;
            }
        });
    }

    // Relationships
    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'farmer_id'); // Assuming Farmer is another model
    }

    public function approvedBy()
    {
        return $this->belongsTo(SubAdmin::class, 'approved_by'); // SubAdmin who approved
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id'); // Agent managing the product
    }

    public function hubpoint()
    {
        return $this->belongsTo(HubPoint::class, 'hubpoint_id'); // HubPoint storing the product
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id'); // Link to Product Variations
    }

    // Accessors & Mutators
    public function setContentsAttribute($value)
    {
        $this->attributes['contents'] = json_encode($value);
    }

    public function getContentsAttribute($value)
    {
        return json_decode($value, true);
    }
}