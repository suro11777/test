<?php


namespace App\Http\Controllers\Api\Admin;


use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->baseService = $userService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers(Request $request)
    {
        if (empty($request->all())){
            $users = $this->baseService->getAllUsers();
        }else{
            $users = $this->baseService->searchUserByEvent($request->only('search'));
        }
        if ($users->isEmpty()){
            return response()->json(['status' => 404, 'message' => 'Users not found']);
        }

        return response()->json(['status' => 200, 'data' => $users]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'surname' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        [$user, $response] = $this->baseService->createUser($request->all());

        if (!$user){
            return response()->json(['status' => 500, 'message' => 'user not created']);
        }
        return response()->json(['status' => 200, 'user' => $user, (string) $response->getBody()]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'surname' => 'required|min:5',
        ]);
        $user= $this->baseService->updateUser($id, $request->all());

        if (!$user){
            return response()->json(['status' => 500, 'message' => 'user not updated']);
        }
        return response()->json(['status' => 200, 'user' => $user]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = $this->baseService->find($id);dd($user);
        if (!$user) {
            return response()->json(['status' => 404, 'message' => "User not found by id"]);
        }

        return response()->json(["status" => 200,  "data" => $user]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $deleted = $this->baseService->delete($id);
        if (!$deleted) {
            return response()->json(["status" => 502,"error" => "item not deleted"]);
        }
        return response()->json(["status" => 200, "success" => "item deleted"]);
    }

}
