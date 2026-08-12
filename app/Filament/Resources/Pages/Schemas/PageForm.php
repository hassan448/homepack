<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات الصفحة')
                    ->schema([
                        TextInput::make('name')
                            ->label('اسم الصفحة (في الدashboard)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('المعرّف (slug)')
                            ->disabled()
                            ->dehydrated(),
                        TextInput::make('title')
                            ->label('عنوان الصفحة (title)')
                            ->maxLength(255),
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label('الترتيب')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('نشطة')
                            ->default(true)
                            ->disabled(fn (?Page $record): bool => $record?->slug === 'home')
                            ->dehydrated(fn (?Page $record): bool => $record?->slug !== 'home')
                            ->helperText(fn (?Page $record): ?string => $record?->slug === 'home'
                                ? 'لا يمكن تعطيل الصفحة الرئيسية'
                                : 'عند التعطيل: الصفحة تختفي من الموقع والقائمة'),
                    ])
                    ->columns(2),
            ]);
    }
}
