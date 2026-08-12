<?php

namespace App\Filament\Resources\PageSections;

use App\Filament\Concerns\AuthorizesByRole;
use App\Filament\Resources\PageSections\Pages\CreatePageSection;
use App\Filament\Resources\PageSections\Pages\EditPageSection;
use App\Filament\Resources\PageSections\Pages\ListPageSections;
use App\Filament\Resources\PageSections\Schemas\PageSectionForm;
use App\Filament\Resources\PageSections\Tables\PageSectionsTable;
use App\Models\PageSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PageSectionResource extends Resource
{
    use AuthorizesByRole;

    protected static function permissionKey(): string
    {
        return 'page_sections';
    }

    protected static ?string $model = PageSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?string $navigationLabel = 'أقسام الصفحات';

    protected static ?string $modelLabel = 'قسم';

    protected static ?string $pluralModelLabel = 'أقسام الصفحات';

    protected static string | \UnitEnum | null $navigationGroup = 'إدارة الموقع';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return PageSectionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PageSectionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageSections::route('/'),
            'create' => CreatePageSection::route('/create'),
            'edit' => EditPageSection::route('/{record}/edit'),
        ];
    }
}
