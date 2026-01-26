namespace App\Services;

use App\Models\Notification;

class NotificationService 
{
    public static function send($userId, $type, array $data = [])
    {
        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'data' => $data,
        ]);
    }
}