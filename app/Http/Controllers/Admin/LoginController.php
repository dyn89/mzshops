<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /**
     * 登录
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function login(LoginRequest $request)
    {
        Log::info("LoginController@login", $request->all());
        $employeeInfo = Employee::query()
            ->where('em_name', '=', $request->input('username'))
            ->first();
        if (empty($employeeInfo)) {
            throw new \Exception("拒绝登录，用户不存在", 401);
        }
        if (!Hash::check($request->input('password'), $employeeInfo->em_password)) {
            throw new \Exception("拒绝登录，用户名或密码错误", 401);
        }

        Log::info("LoginController@login，请求令牌");
        $client = new Client([
            'base_uri' => config('app.url'),
            'timeout' => 10
        ]);
        $res = $client->request('POST', '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('passport.password_grant_client.id'),
                'client_secret' => config('passport.password_grant_client.secret'),
                'username' => $employeeInfo->em_name,
                'password' => $employeeInfo->em_password,
                'scope' => '*'
            ]
        ]);
        $token = json_decode((string) $res->getBody(), true);
        Log::info("LoginController@login", [$token]);
        return response()->json(['token' => $token]);
    }

    /**
     * 注销登录
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['data' => [], 'message' => 'success']);
    }

    /**
     * 注销登录
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function userInfo(Request $request)
    {
        return response()->json(['data' => $request->user()]);
    }
}
