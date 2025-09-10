<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // General settings
            $table->string('logo')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('tagline')->nullable();
            $table->string('admin_email')->nullable();

            $table->foreignId('default_currency')->nullable()->constrained('currencies');

            // MPGS (test)
            $table->boolean('mpgs_enable')->nullable();
            $table->string('mpgs_merchant_id')->nullable();
            $table->string('mpgs_username')->nullable();
            $table->string('mpgs_password')->nullable();
            $table->string('mpgs_api_url')->nullable();
            $table->string('mpgs_version')->nullable();
            $table->string('mpgs_dashboard_link')->nullable();

            // MPGS (live)
            $table->boolean('live_mpgs_enable')->nullable();
            $table->string('live_mpgs_merchant_id')->nullable();
            $table->string('live_mpgs_username')->nullable();
            $table->string('live_mpgs_password')->nullable();
            $table->string('live_mpgs_api_url')->nullable();
            $table->string('live_mpgs_version')->nullable();

            // Paymob
            $table->boolean('paymob_enable')->nullable();
            $table->string('paymob_public_key')->nullable();
            $table->string('paymob_secret_key')->nullable();
            $table->string('paymob_hmac')->nullable();
            $table->string('paymob_mobile_wallet_integration_id')->nullable();
            $table->string('paymob_valu_integration_id')->nullable();

            // SMTP
            $table->boolean('smtp_enable')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_encryption')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_mail_from')->nullable();

            // CreateSend
            $table->boolean('create_send_enable')->nullable();
            $table->string('create_send_api_key')->nullable();
            $table->string('create_send_list_id')->nullable();
            $table->string('create_send_template_id')->nullable();
            $table->string('create_send_client_id')->nullable();
            $table->string('create_send_from_email')->nullable();
            $table->string('create_send_replay_to')->nullable();

            // SendGrid
            $table->boolean('send_grid_enable')->nullable();
            $table->string('send_grid_host')->nullable();
            $table->string('send_grid_port')->nullable();
            $table->string('send_grid_username')->nullable();
            $table->string('send_grid_password')->nullable();
            $table->string('send_grid_mail_from')->nullable();
            $table->string('send_grid_encryption')->nullable();

            // Emails & templates
            $table->json('emails')->nullable();
            $table->longText('template')->nullable();

            // WhatsApp
            $table->boolean('whatsapp_is_enabled')->nullable();
            $table->string('whatsapp_from_number')->nullable();

            // Tax
            $table->boolean('apply_tax')->nullable();
            $table->decimal('tax_rate', 10, 2)->nullable();

            // Trello
            $table->boolean('is_trello_active')->nullable();
            $table->string('trello_board_id')->nullable();
            $table->json('trello_lists')->nullable();

            // Email theming
            $table->string('email_primary_color')->nullable();
            $table->string('email_secondary_color')->nullable();
            $table->string('email_background_color')->nullable();
            $table->string('email_text_color')->nullable();
            $table->string('email_button_color')->nullable();
            $table->string('email_button_text_color')->nullable();
            $table->string('email_logo')->nullable();

            // Trello list mapping
            $table->string('processing_order_list_id')->nullable();
            $table->string('shipped_order_list_id')->nullable();
            $table->string('completed_order_list_id')->nullable();
            $table->string('cancelled_order_list_id')->nullable();
            $table->string('subscription_list_id')->nullable();
            $table->string('contact_us_list_id')->nullable();

            // Working hours
            $table->string('working_hour_start')->nullable();
            $table->string('working_hour_end')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
