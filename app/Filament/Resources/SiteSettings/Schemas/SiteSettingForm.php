<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('الإعداد')
                    ->schema([
                        TextInput::make('label')
                            ->label('الاسم')
                            ->disabled()
                            ->dehydrated(),
                        TextInput::make('key')
                            ->label('Key')
                            ->disabled()
                            ->dehydrated(),
                        Select::make('group')
                            ->label('المجموعة')
                            ->options(SiteSetting::groupLabels())
                            ->disabled()
                            ->dehydrated(),
                        Select::make('type')
                            ->label('النوع')
                            ->options([
                                'text' => 'نص',
                                'textarea' => 'نص طويل',
                                'image' => 'صورة',
                            ])
                            ->disabled()
                            ->dehydrated()
                            ->live(),
                        Textarea::make('value')
                            ->label('القيمة')
                            ->rows(fn ($get) => $get('type') === 'textarea' ? 4 : 2)
                            ->visible(fn ($get) => in_array($get('type'), ['text', 'textarea'], true))
                            ->columnSpanFull(),
                        FileUpload::make('value')
                            ->label('الصورة')
                            ->image()
                            ->disk('public')
                            ->directory('settings')
                            ->visibility('public')
                            ->visible(fn ($get) => $get('type') === 'image')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
