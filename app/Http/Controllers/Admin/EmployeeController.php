<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountSettingRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * 员工列表
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function lists(Request $request)
    {
        Log::info("EmployeeController@lists", $request->all());
        $data = Employee::query()
            ->where('em_name', '!=' ,'admin')
            ->orderByDesc('id')
            ->get();
        return response()->json(['data' => $data]);
    }

    /**
     * 员工新建或编辑
     *
     * @param EmployeeRequest $request
     * @return JsonResponse
     *
     */
    public function postInfo(EmployeeRequest $request)
    {
        Log::info("EmployeeController@postInfo", $request->all());
        $create = $request->all();
        $create['em_password'] = Hash::make($create['em_password']);
        Employee::query()->create($create);
        return response()->json(['data' => [], 'message' => '操作成功']);
    }

    /**
     * 删除(入职或离职)
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function del(Request $request)
    {
        Log::info("EmployeeController@del", $request->all());
        $user = $request->input('user');
        $employee = Employee::query()->findOrFail($request->input('id'));

        if ($user !== 'admin' && $user !== $employee->em_name) {
            return response()->json(['data' => [], 'message' => '权限异常'], 403);
        }

        $employee->em_status = $request->input('status') == 'true' ? 1 : 0;
        $employee->save();
        return response()->json(['data' => [], 'message' => '操作成功']);
    }

    /**
     * 重置密码
     *
     * @param Request $request
     * @return JsonResponse
     *
     */
    public function resetPwd(Request $request)
    {
        Log::info("EmployeeController@resetPwd", $request->all());
        $user = $request->input('user');
        $employee = Employee::query()->findOrFail($request->input('id'));

        if ($user !== 'admin' && $user !== $employee->em_name) {
            return response()->json(['data' => [], 'message' => '权限异常'], 403);
        }

        $employee->em_password = Hash::make('123456');
        $employee->save();
        return response()->json(['data' => [], 'message' => '操作成功']);
    }

    /**
     * 员工信息编辑
     *
     * @param AccountSettingRequest $request
     * @return JsonResponse
     *
     */
    public function setting(AccountSettingRequest $request)
    {
        Log::info("EmployeeController@resetPwd", $request->all());
        $employee = Employee::query()->findOrFail($request->input('userid'));
        $employee->em_name = $request->input('em_name');
        $employee->em_birth = $request->input('em_birth');
        $employee->em_email = $request->input('em_email');
        $employee->em_gender = $request->input('em_gender');
        $employee->em_phone = $request->input('em_phone');
        $employee->em_password = Hash::make($request->input('em_password'));
        $employee->save();
        return response()->json(['data' => [], 'message' => '操作成功']);
    }
}
