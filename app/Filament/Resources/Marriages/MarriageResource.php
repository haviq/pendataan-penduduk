<?php

namespace App\Filament\Resources\Marriages;

use App\Filament\Resources\Marriages\Pages\CreateMarriage;
use App\Filament\Resources\Marriages\Pages\EditMarriage;
use App\Filament\Resources\Marriages\Pages\ListMarriages;
use App\Filament\Resources\Marriages\Schemas\MarriageForm;
use App\Filament\Resources\Marriages\Tables\MarriagesTable;
use App\Models\Marriage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MarriageResource extends Resource
{
    protected static ?string $model = Marriage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static ?string $recordTitleAttribute = 'marriage_certificate_number';

    protected static ?string $modelLabel = 'Pernikahan';
    protected static ?string $pluralModelLabel = 'Pernikahan';
    protected static ?string $navigationLabel = 'Pernikahan';

    protected static string|\UnitEnum|null $navigationGroup = 'Data Kependudukan';
    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return MarriageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MarriagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Marriage::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarriages::route('/'),
            'create' => CreateMarriage::route('/create'),
            'edit' => EditMarriage::route('/{record}/edit'),
        ];
    }
}