<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoAnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'iwakura@brgyscholarship.net')->first();

        $announcements = [
            [
                'title' => 'New Scholarship Now Open',
                'body' => 'The Barangay Academic Excellence Grant is now accepting applications until August 31.',
            ],
            [
                'title' => 'Office Closed for Holiday',
                'body' => 'The Barangay office will be closed on June 29 in observance of the local holiday.',
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::firstOrCreate(
                ['title' => $announcement['title']],
                array_merge($announcement, ['created_by' => $admin->id])
            );
        }
    }
}
