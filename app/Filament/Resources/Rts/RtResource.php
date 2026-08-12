<?php

namespace App\Filament\Resources\Rts;

use App\Filament\Resources\Rts\Pages\CreateRt;
use App\Filament\Resources\Rts\Pages\EditRt;
use App\Filament\Resources\Rts\Pages\ListRts;
use App\Filament\Resources\Rts\Schemas\RtForm;
use App\Filament\Resources\Rts\Tables\RtsTable;
use App\Models\Rt;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RtResource extends Resource
{
    protected static ?string $model = Rt::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static ?string $recordTitleAttribute = 'number';

    protected static ?string $modelLabel = 'RT';
    protected static ?string $pluralModelLabel = 'RT';
    protected static ?string $navigationLabel = 'RT';

    protected static string|\UnitEnum|null $navigationGroup = 'Data Kependudukan';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return RtForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RtsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Rt::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRts::route('/'),
            'create' => CreateRt::route('/create'),
            'edit' => EditRt::route('/{record}/edit'),
        ];
    }
}
