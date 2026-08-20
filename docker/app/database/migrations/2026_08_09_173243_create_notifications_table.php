    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
    
        public function up(): void
        {
            Schema::create('notifications', function (Blueprint $notification) {
                $notification->id('notification_id');
                $notification->unsignedInteger('user_id');
                $notification->unsignedInteger('result_id')->nullable();
                $notification->enum('type', ['spin_result', 'remind_receive', 'system']);
                $notification->string('title', 300)->nullable();
                $notification->text('message')->nullable();
                $notification->dateTime('sent_at')->useCurrent();
                $notification->string('qr_code', 500);
            });
        }


        public function down(): void
        {
            Schema::dropIfExists('notifications');
        }
    };
