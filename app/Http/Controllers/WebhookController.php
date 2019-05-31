<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller {
    public function mailgunProceed() {
        $mailgunWebhookKey = config('app.mailgun_webhook_key');

        $key = request()->get('key');
        $complainedStatus = 4;
        $permBounceStatus = 5;

        if ($key == $mailgunWebhookKey) {
            $eventData = request()->input('event-data');

            if ($eventData['event'] == 'complained') {
                User::where('email', $eventData['recipient'])->first()->update(['status' => $complainedStatus, 'subscribed' => 0]);
                User::where('email', $eventData['recipient'])->first()->jobs()->delete();

                return response()->json(['status' => 'success. complained'], 200);
            } elseif($eventData['severity'] == 'permanent' and $eventData['event'] == 'failed') {
                User::where('email', $eventData['recipient'])->first()->update(['status' => $permBounceStatus, 'subscribed' => 0]);
                User::where('email', $eventData['recipient'])->first()->jobs()->delete();

                return response()->json(['status' => 'success. permanent failuire.'], 200);
            } elseif($eventData['severity'] == 'temporary' and $eventData['event'] == 'failed') {
                User::where('email', $eventData['recipient'])->first()->jobs()->delete();

                return response()->json(['status' => 'success. temp failuire'], 200);
            }
        }

        Log::info('Server made request with wrong key: ' . $key);

        return response()->json(['status' => 'failed'], 403);
    }
}