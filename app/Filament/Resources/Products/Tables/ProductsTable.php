<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('الصورة')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('المنتج')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('الفئة')
                    ->sortable(),
                TextColumn::make('spec_label')
                    ->label('المواصفة')
                    ->toggleable(),
                IconColumn::make('is_featured')
                    ->label('مميز')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('الفئة')
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_featured')
                    ->label('منتج مميز'),
                TernaryFilter::make('is_active')
                    ->label('نشط'),
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
