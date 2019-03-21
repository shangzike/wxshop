<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'shop_goods';
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $primaryKey = 'goods_id';
    
}
