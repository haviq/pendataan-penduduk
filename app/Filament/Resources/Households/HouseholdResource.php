<?php

namespace App\Filament\Resources\Households;

use App\Filament\Resources\Households\Pages\CreateHousehold;
use App\Filament\Resources\Households\Pages\EditHousehold;
use App\Filament\Resources\Households\Pages\ListHouseholds;
use App\Filament\Resources\Households\Schemas\HouseholdForm;
use App\Filament\Resources\Households\Tables\HouseholdsTable;
use App\Models\Household;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HouseholdResource extends Resource
{
    protected static ?string $model = Household::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'no_kk';

    protected static ?string $modelLabel = 'Kartu Keluarga';
    protected static ?string $pluralModelLabel = 'Kartu Keluarga';
    protected static ?string $navigationLabel = 'Kartu Keluarga';

    protected static string|\UnitEnum|null $navigationGroup = 'Data Kependudukan';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return HouseholdForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HouseholdsTable::configure($table);
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
            'index' => ListHouseholds::route('/'),
            'create' => CreateHousehold::route('/create'),
            'edit' => EditHousehold::route('/{record}/edit'),
        ];
    }
}
