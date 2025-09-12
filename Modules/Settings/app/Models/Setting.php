<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'brand_name',
        'tagline',
        'admin_email',
        'default_area_id',
        'default_district_id',
        'default_currency',
        'mpgs_enable',
        'mpgs_merchant_id',
        'mpgs_username',
        'mpgs_password',
        'mpgs_api_url',
        'mpgs_version',
        'mpgs_dashboard_link',
        'live_mpgs_enable',
        'live_mpgs_merchant_id',
        'live_mpgs_username',
        'live_mpgs_password',
        'live_mpgs_api_url',
        'live_mpgs_version',

        'paymob_enable',
        'paymob_public_key',
        'paymob_secret_key',
        'paymob_hmac',
        'paymob_mobile_wallet_integration_id',
        'paymob_valu_integration_id',
        'smtp_enable',
        'smtp_host',
        'smtp_port',
        'smtp_encryption',
        'smtp_username',
        'smtp_password',
        'smtp_mail_from',

        'create_send_enable',
        'create_send_api_key',
        'create_send_list_id',
        'create_send_template_id',
        'create_send_client_id',
        'create_send_from_email',
        'create_send_replay_to',

        'send_grid_enable',
        'send_grid_host',
        'send_grid_port',
        'send_grid_username',
        'send_grid_password',
        'send_grid_mail_from',
        'send_grid_encryption',

        'emails',
        'template',
        'whatsapp_is_enabled',
        'whatsapp_from_number',

        'apply_tax',
        'tax_rate',

        'is_trello_active',
        'trello_board_id',
        'trello_lists',

        'email_primary_color',
        'email_secondary_color',
        'email_background_color',
        'email_text_color',
        'email_button_color',
        'email_button_text_color',
        'email_logo',

        'processing_order_list_id',
        'shipped_order_list_id',
        'completed_order_list_id',
        'cancelled_order_list_id',
        'subscription_list_id',
        'contact_us_list_id',

        'working_hour_start',
        'working_hour_end',
    ];

    protected $casts = [
        "emails" => "json",
        "trello_lists" => "array",
    ];
}
