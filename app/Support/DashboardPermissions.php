<?php

namespace App\Support;

use App\Enums\UserRole;
use App\Models\User;

class DashboardPermissions
{
    /** @var list<string> */
    public const CONTENT_RESOURCES = [
        'products',
        'categories',
        'pages',
        'page_sections',
        'site_settings',
    ];

    public static function can(?User $user, string $resource): bool
    {
        if (! $user) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        if ($resource === 'users') {
            return false;
        }

        $role = $user->role;

        if (! $role) {
            return false;
        }

        return match ($role) {
            UserRole::Content => in_array($resource, self::CONTENT_RESOURCES, true),
            UserRole::Orders => $resource === 'orders',
            default => false,
        };
    }

    public static function canManageUsers(?User $user): bool
    {
        return $user?->isAdmin() ?? false;
    }
}
