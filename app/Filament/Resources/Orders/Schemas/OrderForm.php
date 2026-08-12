<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Order;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function statusOptions(): array
    {
        return [
            'new' => Order::statusLabel('new'),
            'review' => Order::statusLabel('review'),
            'quoted' => Order::statusLabel('quoted'),
            'confirmed' => Order::statusLabel('confirmed'),
            'cancelled' => Order::statusLabel('cancelled'),
        ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات العميل')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('اسم العميل')
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('الهاتف')
                            ->tel()
                            ->maxLength(50),
                    ])
                    ->columns(3),
                Section::make('تفاصيل الطلب')
                    ->schema([
                        TextInput::make('dimensions')
                            ->label('الأبعاد')
                            ->maxLength(100),
                        TextInput::make('quantity')
                            ->label('الكمية')
                            ->numeric()
                            ->minValue(1),
                        Select::make('cardboard_type')
                            ->label('نوع الكرتون')
                            ->options([
                                'single' => 'طبقة واحدة',
                                'double' => 'طبقتان (BC Flute)',
                                'triple' => 'ثلاث طبقات',
                            ]),
                        Select::make('printing_type')
                            ->label('نوع الطباعة')
                            ->options([
                                'none' => 'بدون طباعة',
                                'flexo' => 'فليكسو',
                                'offset' => 'أوفست',
                                'digital' => 'رقمية',
                            ]),
                        Textarea::make('notes')
                            ->label('ملاحظات')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('الحالة والتتبع')
                    ->schema([
                        Select::make('status')
                            ->label('حالة الطلب')
                            ->options(self::statusOptions())
                            ->required()
                            ->default('new'),
                        TextInput::make('tracking_code')
                            ->label('رمز التتبع')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->helperText('يُنشأ تلقائياً عند استلام الطلب'),
                    ])
                    ->columns(2),
            ]);
    }
}
