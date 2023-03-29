<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCate extends Model
{
    protected $table = 'product_cate';

    protected $guarded = [];

    /**
     * Find the user instance for the given username.
     *
     * @param integer $bid
     * @return array
     */
    public static function cateTree($bid = 0)
    {
        $root = [];
        if ($bid === 0) {
            $root = [
                'title'     => '顶级分类',
                'value'     => 0,
                'key'       => 0,
                'img'       => '',
                'status'    => 1,
                'children'  => []
            ];
        }

        $cate = ProductCate::query()
            ->where('cate_bid', '=', $bid)
            ->get();

        if ($cate->count() > 0) {
            $children = [];
            foreach ($cate as $item) {
                $itemArr = self::cateTree($item->id);
                array_push($children, [
                    'title'     => $item->cate_name,
                    'value'     => $item->id,
                    'key'       => $item->id,
                    'img'       => $item->cate_img,
                    'status'    => $item->status,
                    'children'  => $itemArr
                ]);
            }
            if (isset($root['children'])) {
                $root['children'] = $children;
            } else {
                return $children;
            }
        }
        return $root;
    }
}
