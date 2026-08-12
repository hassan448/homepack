<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات المنتج')
                    ->schema([
                        Select::make('category_id')
                            ->label('الفئة')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('name')
                            ->label('اسم المنتج')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('الرابط (slug)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label('الوصف')
                            ->rows(4)
                            ->columnSpanFull(),
                        TextInput::make('spec_label')
                            ->label('المواصفة (مثال: BC Flute)')
                            ->maxLength(255),
                        TextInput::make('badge_text')
                            ->label('شارة مخصصة (اختياري)')
                            ->maxLength(255)
                            ->helperText('اتركه فارغاً لاستخدام اسم الفئة'),
                        FileUpload::make('image')
                            ->label('صورة المنتج')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->visibility('public')
                            ->columnSpanFull(),
                        TextInput::make('icon')
                            ->label('أيقونة Material (بدون صورة)')
                            ->maxLength(100)
                            ->helperText('مثال: inventory_2 — تُستخدم إذا لم تُرفع صورة'),
                        TextInput::make('sort_order')
                            ->label('ترتيب العرض')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_featured')
                            ->label('منتج مميز')
                            ->default(false),
                        Toggle::make('is_active')
                            ->label('نشط')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
