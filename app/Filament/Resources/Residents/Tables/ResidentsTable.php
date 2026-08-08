<?php

namespace App\Filament\Resources\Residents\Tables;

use App\Models\Rt;
use App\Models\Rw;
use App\Models\Resident;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ResidentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('full_name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('household.no_kk')
                    ->label('No. KK')
                    ->searchable(),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->searchable(),
                TextColumn::make('birth_place')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('birth_date')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('age')
                    ->label('Usia')
                    ->formatStateUsing(fn ($state) => $state !== null ? $state . ' tahun' : '-')
                    ->toggleable(),
                TextColumn::make('age_breakdown')
                    ->label('Usia (Detail)')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('blood_type')
                    ->label('Golongan Darah')
                    ->toggleable(),
                TextColumn::make('religion')
                    ->label('Agama')
                    ->toggleable(),
                TextColumn::make('education')
                    ->label('Pendidikan')
                    ->toggleable(),
                TextColumn::make('occupation')
                    ->label('Pekerjaan')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('marital_status')
                    ->label('Status Kawin')
                    ->searchable(),
                TextColumn::make('relationship_to_head')
                    ->label('Status Keluarga')
                    ->searchable(),
                TextColumn::make('father_name')
                    ->label('Nama Ayah')
                    ->toggleable(),
                TextColumn::make('mother_name')
                    ->label('Nama Ibu')
                    ->toggleable(),
                TextColumn::make('birth_cert_number')
                    ->label('No. Akta Lahir')
                    ->toggleable(),
                TextColumn::make('birth_cert_issuer')
                    ->label('Penerbit Akta')
                    ->toggleable(),
                IconColumn::make('has_ktp')
                    ->label('KTP')
                    ->boolean()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Pindah' => 'warning',
                        'Meninggal' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('status_date')
                    ->label('Tanggal Pindah/Meninggal')
                    ->date('d M Y')
                    ->toggleable(),
                TextColumn::make('status_note')
                    ->label('Keterangan')
                    ->limit(20)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->striped()
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->orderBy('household_id')
                ->orderByRaw("relationship_to_head = 'Kepala Keluarga' DESC"))
            ->paginated([10, 25, 50, 'all'])
            ->defaultPaginationPageOption(25)
            ->filters([
                SelectFilter::make('rw')
                    ->label('RW')
                    ->options(fn () => Rw::pluck('number', 'id'))
                    ->query(function (Builder $query, array $data): Builder {
                        if (blank($data['value'] ?? null)) {
                            return $query;
                        }

                        return $query->whereHas(
                            'household.rt',
                            fn (Builder $q) => $q->where('rw_id', $data['value'])
                        );
                    }),

                SelectFilter::make('rt')
                    ->label('RT')
                    ->options(fn () => Rt::with('rw')->get()->mapWithKeys(
                        fn (Rt $rt) => [$rt->id => "RT {$rt->number} / RW {$rt->rw->number}"]
                    ))
                    ->query(function (Builder $query, array $data): Builder {
                        if (blank($data['value'] ?? null)) {
                            return $query;
                        }

                        return $query->whereHas(
                            'household',
                            fn (Builder $q) => $q->where('rt_id', $data['value'])
                        );
                    }),

                SelectFilter::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),

                SelectFilter::make('religion')
                    ->label('Agama')
                    ->options([
                        'Islam' => 'Islam',
                        'Kristen' => 'Kristen',
                        'Katolik' => 'Katolik',
                        'Hindu' => 'Hindu',
                        'Buddha' => 'Buddha',
                        'Konghucu' => 'Konghucu',
                    ]),

                SelectFilter::make('education')
                    ->label('Pendidikan')
                    ->options([
                        'Tidak/Belum Sekolah' => 'Tidak/Belum Sekolah',
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                        'D3' => 'D3',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ]),

                SelectFilter::make('marital_status')
                    ->label('Status Kawin')
                    ->options([
                        'Belum Kawin' => 'Belum Kawin',
                        'Kawin' => 'Kawin',
                        'Cerai Hidup' => 'Cerai Hidup',
                        'Cerai Mati' => 'Cerai Mati',
                    ]),

                SelectFilter::make('relationship_to_head')
                    ->label('Status dalam Keluarga')
                    ->options([
                        'Kepala Keluarga' => 'Kepala Keluarga',
                        'Suami' => 'Suami',
                        'Istri' => 'Istri',
                        'Anak' => 'Anak',
                        'Menantu' => 'Menantu',
                        'Cucu' => 'Cucu',
                        'Orang Tua' => 'Orang Tua',
                        'Famili Lain' => 'Famili Lain',
                        'Lainnya' => 'Lainnya',
                    ]),

                SelectFilter::make('status')
                    ->label('Status Kependudukan')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Pindah' => 'Pindah',
                        'Meninggal' => 'Meninggal',
                    ]),

                Filter::make('age_range')
                    ->label('Rentang Usia')
                    ->schema([
                        TextInput::make('age_from')
                            ->label('Usia dari (tahun)')
                            ->numeric()
                            ->minValue(0),
                        TextInput::make('age_to')
                            ->label('Usia sampai (tahun)')
                            ->numeric()
                            ->minValue(0),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['age_from'] ?? null,
                                fn (Builder $q, $age) => $q->whereDate('birth_date', '<=', now()->subYears($age)->format('Y-m-d'))
                            )
                            ->when(
                                $data['age_to'] ?? null,
                                fn (Builder $q, $age) => $q->whereDate('birth_date', '>=', now()->subYears((int) $age + 1)->addDay()->format('Y-m-d'))
                            );
                    }),
                SelectFilter::make('birth_year')
                    ->label('Tahun Lahir')
                    ->options(fn () => Resident::selectRaw('YEAR(birth_date) as year')
                        ->distinct()
                        ->orderByDesc('year')
                        ->pluck('year', 'year'))
                    ->query(function (Builder $query, array $data): Builder {
                        if (blank($data['value'] ?? null)) {
                            return $query;
                        }

                        return $query->whereYear('birth_date', $data['value']);
                    }),

                Filter::make('age_days_range')
                    ->label('Usia dalam Hari (Balita)')
                    ->schema([
                        TextInput::make('age_days_from')
                            ->label('Usia dari (hari)')
                            ->numeric()
                            ->minValue(0),
                        TextInput::make('age_days_to')
                            ->label('Usia sampai (hari)')
                            ->numeric()
                            ->minValue(0),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['age_days_from'] ?? null,
                                fn (Builder $q, $days) => $q->whereDate('birth_date', '<=', now()->subDays($days)->format('Y-m-d'))
                            )
                            ->when(
                                $data['age_days_to'] ?? null,
                                fn (Builder $q, $days) => $q->whereDate('birth_date', '>=', now()->subDays($days)->format('Y-m-d'))
                            );
                    }),
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