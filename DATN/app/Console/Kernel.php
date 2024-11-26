<?
namespace App\Console;

use App\Console\Commands\ManageContactSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Thực hiện command này mỗi ngày vào lúc 2 AM (có thể thay đổi theo nhu cầu)
        $schedule->command(ManageContactSchedule::class)->dailyAt('02:00');

        // Bạn cũng có thể lập lịch theo nhu cầu khác như:
        // $schedule->command(ManageContactSchedule::class)->hourly();
        // $schedule->command(ManageContactSchedule::class)->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
