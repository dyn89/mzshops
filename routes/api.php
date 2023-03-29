<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function(){
    // 登录
    Route::post('/auth/login', 'Admin\LoginController@login');
});

// 管理后台接口
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api', 'namespace' => 'Admin'], function(){
    // 注销登录
    Route::post('auth/logout', 'LoginController@logout');
    // 用户详细信息
    Route::get('user/info', 'LoginController@userInfo');

    // 订单列表
    // Route::get('order/list', 'Web\OrderController@lists');

     // 员工管理
    Route::get('employee/list', 'EmployeeController@lists');
    Route::post('employee/info', 'EmployeeController@postInfo');
    Route::delete('employee/del', 'EmployeeController@del');
    Route::post('employee/resetpwd', 'EmployeeController@resetPwd');
    Route::post('account/setting', 'EmployeeController@setting');

    // // 产品列表
    // Route::get('product/list', 'Web\ProductController@lists');
    // // 创建产品分类
    // Route::post('product/cate', 'Web\ProductController@createCate');
     // 产品分类管理
    Route::get('product/cate', 'ProductCateController@getCateList');
    Route::post('product/cate', 'ProductCateController@createCate');
    Route::post('cate/updown', 'ProductCateController@upOrDown');

    // // 获取一级分类列表
    // Route::get('product/parent/cate', 'Web\ProductController@getParentCate');


});

// // 小程序接口----------------------------------------------------------------------
// Route::group(['prefix' => 'wechat'], function(){
//     // 首页
//     Route::get('/home/base', 'API\HomeController@lists');
//     // 首页产品列表
//     Route::get('/goods/list', 'API\GoodsController@lists');
// });
