<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Repository\AdminRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return AdminResource::collection(
            AdminRepository::index()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminStoreRequest $request
     * @return AdminResource
     */
    public function store(AdminStoreRequest $request): AdminResource
    {
        $admin = AdminRepository::store($request);

        return new AdminResource($admin);
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return AdminResource
     */
    public function show(Admin $admin): AdminResource
    {
        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUpdateRequest $request
     * @param Admin $admin
     * @return AdminResource
     */
    public function update(AdminUpdateRequest $request, Admin $admin): AdminResource
    {
        $admin = AdminRepository::update($request, $admin);

        return new AdminResource($admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return JsonResponse
     */
    public function destroy(Admin $admin): JsonResponse
    {
        if ($admin->clients->count()) {
            return response()->json(
                ['message' => __('messages.errors.can_not_delete_a_child_row_exists')],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $admin->delete();

        return response()->json(
            ['message' => __('messages.success.the_record_deleted_successfully')],
            Response::HTTP_OK
        );
    }
}
