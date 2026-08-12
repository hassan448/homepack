<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات المستخدم')
                    ->schema([
                        TextInput::make('name')
                            ->label('الاسم')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TextInput::make('password')
                            ->label('كلمة المرور')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->maxLength(255)
                            ->helperText(fn (string $operation): ?string => $operation === 'edit'
                                ? 'اتركه فارغاً إذا لم ترد تغيير كلمة المرور'
                                : null),
                        Select::make('role')
                            ->label('الدور')
                            ->options(UserRole::options())
                            ->required()
                            ->native(false)
                            ->disabled(fn (?User $record): bool => $record?->isAdmin() === true
                                && User::query()->where('role', UserRole::Admin)->count() <= 1)
                            ->helperText(fn ($get): ?string => UserRole::tryFrom($get('role'))?->description()),
                    ])
                    ->columns(2),
            ]);
    }
}
