<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a demo user
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name'     => 'Demo User',
                'password' => bcrypt('password'),
            ]
        );

        // Demo tasks matching the screenshot
        $tasks = [
            [
                'title'       => 'Submit tax filing',
                'description' => 'Complete and submit annual tax returns.',
                'deadline'    => now()->subDay()->toDateString(),  // overdue
                'status'      => 'pending',
                'created_at'  => now()->subDays(30),
            ],
            [
                'title'       => 'Client presentation',
                'description' => 'Prepare deck for Q3 client review.',
                'deadline'    => now()->addDay()->toDateString(),
                'status'      => 'pending',
                'created_at'  => now()->subDays(12),
            ],
            [
                'title'       => 'Server migration',
                'description' => 'Migrate prod servers to new infrastructure.',
                'deadline'    => now()->addDays(2)->toDateString(),
                'status'      => 'pending',
                'created_at'  => now()->subDays(10),
            ],
            [
                'title'       => 'Refactor billing module',
                'description' => 'Clean up legacy billing code.',
                'deadline'    => now()->addDays(3)->toDateString(),
                'status'      => 'pending',
                'created_at'  => now()->subDays(4),
            ],
            [
                'title'       => 'Write Q3 report',
                'description' => 'Draft and review Q3 performance report.',
                'deadline'    => now()->addDays(4)->toDateString(),
                'status'      => 'pending',
                'created_at'  => now()->subDays(5),
            ],
            [
                'title'       => 'Plan team offsite',
                'description' => 'Book venue and plan agenda for team offsite.',
                'deadline'    => now()->addDays(12)->toDateString(),
                'status'      => 'pending',
                'created_at'  => now()->subDays(2),
            ],
            [
                'title'       => 'Update API docs',
                'description' => 'Add new endpoint documentation.',
                'deadline'    => now()->subDays(3)->toDateString(),
                'status'      => 'completed',
                'created_at'  => now()->subDays(14),
            ],
        ];

        foreach ($tasks as $data) {
            Task::firstOrCreate(
                ['user_id' => $user->id, 'title' => $data['title']],
                array_merge($data, ['user_id' => $user->id])
            );
        }
    }
}
