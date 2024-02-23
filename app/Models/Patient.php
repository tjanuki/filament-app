<?php

namespace App\Models;

use App\Enums\PatientType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->translateLabel()
                ->required()
                ->maxLength(255),
            Select::make('type')
                ->translateLabel()
                ->options(PatientType::class),
            DatePicker::make('date_of_birth')
                ->translateLabel()
                ->required()
                ->maxDate(now()),
            Select::make('owner_id')
                ->translateLabel()
                ->relationship('owner', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->label('Phone number')
                        ->tel()
                        ->required()
                ])
                ->required()
        ];
    }

}
