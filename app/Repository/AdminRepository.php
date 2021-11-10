<?php

namespace App\Repository;

use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class AdminRepository
{
    public static function index(): LengthAwarePaginator
    {
        return Admin::latest()->paginate(Admin::PER_PAGE);
    }

    public static function store(AdminStoreRequest $request): Admin
    {
        $admin = new Admin;

        $admin->first_name  = $request->input('first_name');
        $admin->surname     = $request->input('surname');
        $admin->email       = $request->input('email');
        $admin->password    = Hash::make($request->input('password'));
        $admin->status      = $request->input('status', Admin::STATUS_ACTIVE);

        $admin->save();

        return $admin;
    }

    public static function update(AdminUpdateRequest $request, Admin $admin): Admin
    {
        $admin->first_name  = $request->input('first_name');
        $admin->surname     = $request->input('surname');
        $admin->status      = $request->input('status', Admin::STATUS_ACTIVE);

        if ($request->input('email') != $admin->email) {
            $admin->email = $request->input('email');
        }

        if ($request->input('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        $admin->save();

        return $admin;
    }

    public static function updatePassword(string $newPassword, Admin $admin): Admin
    {
        $admin->password = Hash::make($newPassword);
        $admin->save();

        return $admin;
    }

    public static function fetchAdminByEmail(string $email): ?Admin
    {
        return Admin::whereEmail($email)->first();
    }
}
