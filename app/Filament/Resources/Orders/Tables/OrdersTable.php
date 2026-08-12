<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function statusColor(string $status): string
    {
        return match ($status) {
            'new' => 'warning',
            'review' => 'info',
            'quoted' => 'primary',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            default => 'gray',
        };
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')
                    ->label('العميل')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('email')
                    ->label('البريد')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->toggleable(),
                TextColumn::make('quantity')
                    ->label('الكمية')
                    ->sortable()
                    ->placeholder('—'),
                TextColumn::make('cardboard_type')
                    ->label('الكرتون')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => Order::statusLabel($state))
                    ->color(fn (string $state): string => self::statusColor($state))
                    ->sortable(),
                TextColumn::make('tracking_code')
                    ->label('رمز التتبع')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('تم نسخ رمز التتبع')
                    ->url(fn (Order $record): ?string => $record->tracking_code ? route('track.show', $record->tracking_code) : null)
                    ->openUrlInNewTab()
                    ->placeholder('—'),
                TextColumn::make('created_at')
                    ->label('تاريخ الطلب')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('الحالة')
                    ->options([
                        'new' => Order::statusLabel('new'),
                        'review' => Order::statusLabel('review'),
                        'quoted' => Order::statusLabel('quoted'),
                        'confirmed' => Order::statusLabel('confirmed'),
                        'cancelled' => Order::statusLabel('cancelled'),
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
