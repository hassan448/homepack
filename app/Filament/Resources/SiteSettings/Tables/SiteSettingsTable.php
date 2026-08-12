<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')
                    ->label('المجموعة')
                    ->formatStateUsing(fn (string $state): string => \App\Models\SiteSetting::groupLabels()[$state] ?? $state)
                    ->badge()
                    ->sortable(),
                TextColumn::make('label')
                    ->label('الإعداد')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('القيمة')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('type')
                    ->label('النوع')
                    ->badge()
                    ->color('gray'),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('group')
                    ->label('المجموعة')
                    ->options(\App\Models\SiteSetting::groupLabels()),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
