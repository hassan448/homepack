<?php

namespace App\Filament\Resources\PageSections\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page.name')
                    ->label('الصفحة')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('admin_label')
                    ->label('القسم')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('key')
                    ->label('Key')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('title')
                    ->label('العنوان')
                    ->limit(35)
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('page_id')
                    ->label('الصفحة')
                    ->relationship('page', 'name'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
