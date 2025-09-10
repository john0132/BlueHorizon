<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->schema([
                                TextInput::make('logo'),
                                TextInput::make('brand_name'),
                                TextInput::make('tagline'),
                                TextInput::make('admin_email')
                                    ->email(),
                                TextInput::make('default_currency')
                                    ->numeric(),
                                Toggle::make('apply_tax'),
                                TextInput::make('tax_rate')
                                    ->numeric(),
                            ]),
                        Tabs\Tab::make('MPGS')
                            ->schema([
                                Toggle::make('mpgs_enable'),
                                TextInput::make('mpgs_merchant_id'),
                                TextInput::make('mpgs_username'),
                                TextInput::make('mpgs_password')
                                    ->password(),
                                TextInput::make('mpgs_api_url')
                                    ->url(),
                                TextInput::make('mpgs_version'),
                                TextInput::make('mpgs_dashboard_link'),
                                Toggle::make('live_mpgs_enable'),
                                TextInput::make('live_mpgs_merchant_id'),
                                TextInput::make('live_mpgs_username'),
                                TextInput::make('live_mpgs_password')
                                    ->password(),
                                TextInput::make('live_mpgs_api_url')
                                    ->url(),
                                TextInput::make('live_mpgs_version'),
                            ]),
                        Tabs\Tab::make('Paymob')
                            ->schema([
                                Toggle::make('paymob_enable'),
                                TextInput::make('paymob_public_key'),
                                TextInput::make('paymob_secret_key'),
                                TextInput::make('paymob_hmac'),
                                TextInput::make('paymob_mobile_wallet_integration_id'),
                                TextInput::make('paymob_valu_integration_id'),
                            ]),
                        Tabs\Tab::make('SMTP')
                            ->schema([
                                Toggle::make('smtp_enable'),
                                TextInput::make('smtp_host'),
                                TextInput::make('smtp_port'),
                                TextInput::make('smtp_encryption'),
                                TextInput::make('smtp_username'),
                                TextInput::make('smtp_password')
                                    ->password(),
                                TextInput::make('smtp_mail_from'),
                            ]),
                        Tabs\Tab::make('Create Send')
                            ->schema([
                                Toggle::make('create_send_enable'),
                                TextInput::make('create_send_api_key'),
                                TextInput::make('create_send_list_id'),
                                TextInput::make('create_send_template_id'),
                                TextInput::make('create_send_client_id'),
                                TextInput::make('create_send_from_email')
                                    ->email(),
                                TextInput::make('create_send_replay_to'),
                            ]),
                        Tabs\Tab::make('Send Grid')
                            ->schema([
                                Toggle::make('send_grid_enable'),
                                TextInput::make('send_grid_host'),
                                TextInput::make('send_grid_port'),
                                TextInput::make('send_grid_username'),
                                TextInput::make('send_grid_password')
                                    ->password(),
                                TextInput::make('send_grid_mail_from'),
                                TextInput::make('send_grid_encryption'),
                                TextInput::make('emails')
                                    ->email(),
                                Textarea::make('template')
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Whatsapp')
                            ->schema([
                                Toggle::make('whatsapp_is_enabled'),
                                TextInput::make('whatsapp_from_number'),
                            ]),
                        Tabs\Tab::make('Trello')
                            ->schema([
                                Toggle::make('is_trello_active'),
                                TextInput::make('trello_board_id'),
                                TextInput::make('trello_lists'),
                            ]),
                        Tabs\Tab::make('Other')
                            ->schema([
                                TextInput::make('email_primary_color')
                                    ->email(),
                                TextInput::make('email_secondary_color')
                                    ->email(),
                                TextInput::make('email_background_color')
                                    ->email(),
                                TextInput::make('email_text_color')
                                    ->email(),
                                TextInput::make('email_button_color')
                                    ->email(),
                                TextInput::make('email_button_text_color')
                                    ->email(),
                                TextInput::make('email_logo')
                                    ->email(),
                                TextInput::make('processing_order_list_id'),
                                TextInput::make('shipped_order_list_id'),
                                TextInput::make('completed_order_list_id'),
                                TextInput::make('cancelled_order_list_id'),
                                TextInput::make('subscription_list_id'),
                                TextInput::make('contact_us_list_id'),
                                TextInput::make('working_hour_start'),
                                TextInput::make('working_hour_end'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
