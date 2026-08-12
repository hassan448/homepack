<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Content = 'content';
    case Orders = 'orders';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'مدير النظام',
            self::Content => 'مدير المحتوى',
            self::Orders => 'مدير الطلبات',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Admin => 'صلاحية كاملة + إدارة المستخدمين',
            self::Content => 'المنتجات، الفئات، الصفحات، والإعدادات',
            self::Orders => 'إدارة الطلبات فقط',
        };
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $role) => [$role->value => $role->label()])
            ->all();
    }
}
