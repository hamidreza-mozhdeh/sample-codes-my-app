<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Notifications\ForgotPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use App\Repository\AdminRepository;
use App\Repository\TokenRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SimpleAuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $admin = AdminRepository::fetchAdminByEmail($request->input('email'));

        if (!$admin) {
            return $this->failedLoginResponse();
        }

        $checkPassword = Hash::check($request->input('password'), $admin->password);
        if (!$checkPassword) {
            return $this->failedLoginResponse();
        }

        $token = TokenRepository::store($admin);

        return response()->json([
            'admin' => new AdminResource($admin),
            'secret_string' => $token->secret_string,
            'message' => __('messages.success.welcome', ['first_name' => $admin->first_name])
        ]);
    }

    public function forgotPassword(LoginRequest $request): JsonResponse
    {
        $admin = AdminRepository::fetchAdminByEmail($request->input('email'));

        if (!$admin) {
            return $this->forgotPasswordResponse($request);
        }

        $randomString = $this->getRandomStringByLimitedTime($admin);

        $admin->notify(new ForgotPasswordNotification($randomString));

        return response()->json([
            'message' => __(
                'messages.success.forgot_password',
                ['email' => $request->input('email')]
            )
        ],Response::HTTP_OK);
    }

    public function resetPassword(string $random_string, int $id): JsonResponse
    {
        $admin = Admin::findOrFail($id);
        $randomString = $this->getRandomStringByLimitedTime($admin);

        if ($randomString !== $random_string) {
            return response()->json(
                ['message' => __('messages.errors.reset_password_random_string_invalid')],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $newPassword = Str::random(6);
        $admin = AdminRepository::updatePassword($newPassword, $admin);
        $admin->notify(new ResetPasswordNotification($newPassword));

        return response()->json(
            ['message' => __('messages.success.reset_password')],
            Response::HTTP_OK
        );
    }

    public function logout(Request $request): JsonResponse
    {
        TokenRepository::deleteBySecretString($request->secret_string);

        return response()->json(
            ['message' => __('messages.success.logout')],
            Response::HTTP_OK
        );
    }

    private function failedLoginResponse(): JsonResponse
    {
        return response()->json(
            ['message' => __('messages.errors.failed_login')],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    private function getRandomStringByLimitedTime(Admin $admin): string
    {
        $timeLimitMinutes = 10;
        $timeLimit = intval(time() / ($timeLimitMinutes * 60));

        return sha1("{$admin->email}-{$timeLimit}");
    }
}
