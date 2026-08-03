<?php

namespace App\Filament\Resources\Rws;

use App\Filament\Resources\Rws\Pages\CreateRw;
use App\Filament\Resources\Rws\Pages\EditRw;
use App\Filament\Resources\Rws\Pages\ListRws;
use App\Filament\Resources\Rws\Schemas\RwForm;
use App\Filament\Resources\Rws\Tables\RwsTable;
use App\Models\Rw;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RwResource extends Resource
{
    protected static ?string $model = Rw::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $modelLabel = 'RW';
    protected static ?string $pluralModelLabel = 'RW';
    protected static ?string $navigationLabel = 'RW';

    protected static string|\UnitEnum|null $navigationGroup = 'Data Kependudukan';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return RwForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RwsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRws::route('/'),
            'create' => CreateRw::route('/create'),
            'edit' => EditRw::route('/{record}/edit'),
        ];
    }
}
