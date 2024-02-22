<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('notes')
                    ->translateLabel()
                    ->maxLength(65535)
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('price')
                    ->translateLabel()
                    ->numeric()
                    ->prefix('CAD')
                    ->maxValue(9999)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('description')->translateLabel(),
                Tables\Columns\TextColumn::make('price')->translateLabel()
                    ->money('CAD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')->translateLabel()
                    ->dateTime('Y-m-d H:i:s')
            ])
            ->filters([
                //
            ])
            ->heading(__('Treatments'))
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
