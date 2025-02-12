<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'child_category_id',
        'seller_id',
        'service_city_id',
        'service_area_id',
        'title',
        'slug',
        'description',
        'image',
        'status',
        'is_service_on',
        'price',
        'tax',
        'view',
        'featured',
        'image_gallery',
        'video',
        'is_service_all_cities',
    ];

    
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory');
    }

    public function childcategory(){
        return $this->belongsTo(ChildCategory::class, 'child_category_id', 'id');
    }

    public function serviceInclude(){
        return $this->hasMany('App\Serviceinclude');
    }

    public function serviceAdditional(){
        return $this->hasMany('App\Serviceadditional');
    }

    public function serviceBenifit(){
        return $this->hasMany('App\Servicebenifit');
    }

    public function serviceFaq(){
        return $this->hasMany('App\OnlineServiceFaq');
    }

    public function seller(){
        return $this->belongsTo('App\User','seller_id','id');
    }

    public function seller_for_mobile(){
        return $this->belongsTo('App\User','seller_id','id')->select('id','name','image','country_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'service_id','id');
    }

    public function reviews_for_mobile(){
        return $this->hasMany(Review::class,'service_id','id')
            ->select('id','service_id','rating','message','buyer_id');
    }

    public function pendingOrder(){
        return $this->hasMany(Order::class,'service_id','id')->where('status',0);
    }

    public function completeOrder(){
        return $this->hasMany(Order::class,'service_id','id')->where('status',2);
    }

    public function cancelOrder(){
        return $this->hasMany(Order::class,'service_id','id')->where('status',4);
    }

    public function avgFeedback() {

        return $this->hasMany(Review::class, 'service_id', 'id')
                        ->selectRaw('service_id,AVG(s8_reviews.rating) AS average_rating');
    }

    public function metaData(){
        return $this->morphOne(MetaData::class,'meta_taggable');
    }

    public function serviceCity(){
        return $this->belongsTo(ServiceCity::class,'service_city_id','id');
    }

    public function seller_subscription(){
        $number_of_connect = get_static_option('set_number_of_connect',2);
        return $this->belongsTo('\Modules\Subscription\Entities\SellerSubscription','seller_id','seller_id')
            ->where('connect','>=',$number_of_connect)
            ->where('expire_date','>=',date('d-m-Y'));
    }

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'integer',
    ];
    
}

