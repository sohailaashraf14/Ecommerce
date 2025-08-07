<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;



class Order extends Model
{
protected $fillable = ['user_id', 'amount_cents', 'is_paid'];

public function user()
 {
    return $this->belongsTo(User::class);
 }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }
    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }


}
