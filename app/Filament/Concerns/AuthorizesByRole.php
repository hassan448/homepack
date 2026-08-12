<?php

namespace App\Filament\Concerns;

use App\Support\DashboardPermissions;
use Illuminate\Database\Eloquent\Model;

trait AuthorizesByRole
{
    abstract protected static function permissionKey(): string;

    public static function canViewAny(): bool
    {
        return DashboardPermissions::can(auth()->user(), static::permissionKey());
    }

    public static function canCreate(): bool
    {
        return static::canViewAny();
    }

    public static function canEdit(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canDelete(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }
}
