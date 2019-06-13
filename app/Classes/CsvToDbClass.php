<?php namespace App\Classes;

use App\User;

class CsvToDbClass
{
    private $filename;
    private $linesToInsert;

    public function setFileName($filename)
    {
        $this->filename = $filename;
    }

    public function setLinesToInsert($linesToInsert = 0)
    {
        $this->linesToInsert = $linesToInsert;

        if (!$this->linesToInsert) {
            $this->linesToInsert = 100000;
        }
    }

    public function proceed()
    {
        $res                            = fopen(storage_path('app') . '/' . $this->filename, 'r');
        $count                          = 0;
        $recordsUpdated                 = 0;
        $recordsCreated                 = 0;
        $defaultStatus                  = 2;
        $invalidRecords                 = 0;
        $defaultLastJobsFetchAttempt    = now()->subDay();

        while ($data = fgetcsv($res, 1000, ',')) {
            $csvEmail       = strtolower($data[0]);
            $csvKeyword     = strtolower($data[4]);
            $csvLocation    = strtolower($data[3]);
            $csvName        = strtolower($data[1]);

            if ($count <= $this->linesToInsert) {
                $user = User::where('email', $csvEmail)->first();

                if (!$user) {
                    if (!filter_var($csvEmail, FILTER_VALIDATE_EMAIL)) {
                        $invalidRecords++;
                        echo $csvEmail . " is an invalid email" . PHP_EOL;
                    } else {
                        $recordsCreated++;

                        echo 'Creating new record: ' . $csvEmail . ' ' . $csvLocation . ' ' . $csvKeyword . PHP_EOL;

                        User::create([
                            'email' => $csvEmail,
                            'subscribed' => 1,
                            'location' => $csvLocation,
                            'keyword' => $csvKeyword,
                            'name' => $csvName,
                            'status' => $defaultStatus,
                            'direct_login_token' => md5(uniqid($csvEmail, true)),
                            'last_jobs_fetch_attempt' => $defaultLastJobsFetchAttempt,
                            'signup_type' => 'lead',
                        ]);
                    }

                } elseif ($user and ($user->keyword != $csvKeyword or $user->location != $csvLocation)) {
                    $recordsUpdated++;

                    $userModel = User::find($user->id);
                    $userModel->location = $csvLocation;
                    $userModel->keyword = $csvKeyword;
                    $userModel->name = $csvName;
                    $userModel->save();

                    echo 'Updated record: ' . $csvEmail . ' ' . $csvLocation . ' ' . $csvKeyword . PHP_EOL;
                }
            } else {
                break;
            }

            $count++;
        }


        echo ' Created: ' . $recordsCreated . ' Updated: ' . $recordsUpdated . ' Invalid: ' . $invalidRecords . PHP_EOL;
    }
}