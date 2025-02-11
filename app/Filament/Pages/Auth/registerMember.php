<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register;
use Filament\Pages\Page;

class registerMember extends Register
{

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent()
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('departement')
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->autofocus()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('user_name')
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->autofocus()
                            ->required()
                            ->maxLength(255),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
}
