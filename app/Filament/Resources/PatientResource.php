<?php

namespace App\Filament\Resources;

use App\Enums\PatientType;
use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Patient::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->translateLabel()
                ,
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('owner.name')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner.email')
                    ->label(__('Email'))
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options(PatientType::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')->translateLabel(),
                TextEntry::make('type')->translateLabel()->badge(),
                TextEntry::make('date_of_birth')->translateLabel(),
                TextEntry::make('owner.name'),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\TreatmentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
            'view' => Pages\ViewPatient::route('/{record}'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('Patient');
    }
}
