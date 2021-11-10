<?php

namespace App\Repository;

use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Admin;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository
{
    public static function store(ClientStoreRequest $request): Client
    {
        $image = ImageRepository::storeClientImage($request);

        $client = new Client;
        $client->name   = $request->input('name');
        $client->email  = $request->input('email');
        $client->image  = $image;
        $client->admin_id  = $request->admin->id;

        $client->save();

        return $client;
    }

    public static function update(ClientUpdateRequest $request, Client $client): Client
    {
        $client->name   = $request->input('name');
        $client->email  = $request->input('email');
        $client->admin_id  = $request->admin->id;

        if($request->has('image')) {
            ImageRepository::deleteImage($client->image);
            $client->image = ImageRepository::storeClientImage($request);
        }

        $client->save();

        return $client;
    }

    public static function delete(Request $request, Client $client): bool
    {
        if ($request->admin->id != $client->admin->id) {
            return false;
        }

        ImageRepository::deleteImage($client->image);
        $client->delete();

        return true;
    }

    public static function fetchAllByAdmin(Admin $admin): ?Client
    {
        return Client::where('admin_id', $admin->id)->latest()->get();
    }

    public static function fetchByAdminWithPaginate(): ?LengthAwarePaginator
    {
        $admin = request()->admin;

        return Client::where('admin_id', $admin->id)->latest()->paginate(Client::PER_PAGE);
    }


}
