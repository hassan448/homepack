<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use App\Filament\Resources\Pages\Schemas\SectionForm;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = 'أقسام الصفحة';

    protected static ?string $modelLabel = 'قسم';

    protected static ?string $pluralModelLabel = 'أقسام الصفحة';

    public function form(Schema $schema): Schema
    {
        return SectionForm::configure($schema);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->limit(40)
                    ->toggleable(),
                IconColumn::make('is_active')
                    ->label('نشط')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('الترتيب')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
