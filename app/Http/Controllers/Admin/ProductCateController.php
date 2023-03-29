<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Cloud\CosService;
use App\Models\ProductCate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductCateController extends Controller
{
    /**
     * 产品分类列表
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function getCateList(Request $request)
    {
        Log::info("ProductCateController@getCateList", $request->all());
        $data = ProductCate::cateTree();
        return response()->json(['data' => [$data]]);
    }

    /**
     * 创建产品分类
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function createCate(Request $request)
    {
        Log::info("ProductCateController@createCate", $request->all());
        try {
            $insert = [
                'cate_name' => $request->input('cate_name'),
                'status' => $request->input('cate_status'),
                'cate_bid' => $request->input('cate_bid'),
            ];
            if ($request->hasFile('cate_img')) {
                $file = $request->file('cate_img');
                $body = $file->openFile('rb');
                $filename = $file->getClientOriginalName();
                $res = CosService::putObj('/product/category/'.$filename, $body);
                $insert['cate_img'] = Str::start($res['Location'], 'https://');
            } else {
                $insert['cate_img'] = '';
            }
            $cate = ProductCate::query()->create($insert);
            Log::info("ProductCateController@createCate success");
            return response()->json(['data' => $cate, 'message' => 'success']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['errors' => $e->getMessage(), 'message' => 'failed'], $e->getCode());
        }
    }

    /**
     * 产品分类上架或下架
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function upOrDown(Request $request)
    {
        Log::info("ProductCateController@upOrDown", $request->all());
        dd($request->all());
    }
}
