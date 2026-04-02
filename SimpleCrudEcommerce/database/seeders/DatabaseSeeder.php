<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            User::updateOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Admin User',
                    'password' => bcrypt('password'),
                    'role' => 'admin',
                ]
            );

            $users = User::factory()->count(2)->create();

            foreach ($users as $user) {
                Order::factory()->count(2)->create([
                    'user_id' => $user->id,
                ])->each(function (Order $order) {
                    $items = OrderItem::factory()
                        ->count(random_int(2, 4))
                        ->create([
                            'order_id' => $order->id,
                        ]);

                    $subtotal = $items->sum('line_total');

                    $order->update([
                        'subtotal' => $subtotal,
                        'total' => $subtotal,
                    ]);
                });
            }
        });
    }
}
