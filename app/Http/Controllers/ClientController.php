<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Repository\ClientRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection(
            ClientRepository::fetchByAdminWithPaginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClientStoreRequest $request
     * @return ClientResource
     */
    public function store(ClientStoreRequest $request): ClientResource
    {
        $client = ClientRepository::store($request);

        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client): ClientResource
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClientUpdateRequest $request
     * @param Client $client
     * @return ClientResource
     */
    public function update(ClientUpdateRequest $request, Client $client): ClientResource
    {
        $client = ClientRepository::update($request, $client);

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return JsonResponse
     */
    public function destroy(Request $request, Client $client): JsonResponse
    {
        if (ClientRepository::delete($request, $client)) {
            return response()->json(
                ['message' => __('messages.success.the_record_deleted_successfully')],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ['message' => __('messages.errors.not_found')],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
