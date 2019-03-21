<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'shop_cart';
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $primaryKey = 'cart_id';
}
