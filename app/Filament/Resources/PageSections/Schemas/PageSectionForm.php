<?php

namespace App\Filament\Resources\PageSections\Schemas;

use App\Filament\Resources\Pages\Schemas\SectionForm;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('الصفحة')
                    ->schema([
                        Select::make('page_id')
                            ->label('الصفحة')
                            ->relationship('page', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ]),
                ...SectionForm::fields(),
            ]);
    }
}
