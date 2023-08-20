<?php

namespace App\Console\Commands;

use App\Models\Location;
use App\Models\Server;
use Illuminate\Console\Command;

class DataBuilderCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:data-builder-command';

    /**
     * @var string
     */
    protected $description = 'Data builder command';

    public function handle(): void
    {
        $data = [
            ['name' => 'Окрестности Любеча - Гурман'],
            ['name' => 'Вокзал - Вокзал'],
            ['name' => 'Тунгуска - Радиус'],
            ['name' => 'Везувий - Радиовышка'],
            ['name' => 'Черный лес - Усов'],
        ];

        foreach ($data as $item) {
            $location       = new Location();
            $location->name = $item['name'];
            $location->save();
        }

        $data = [
            ['name' => 'RU1 - EKB'],
            ['name' => 'RU2 - SPB'],
            ['name' => 'RU3 - MSK'],
            ['name' => 'EU'],
            ['name' => 'US'],
        ];

        foreach ($data as $item) {
            $server       = new Server();
            $server->name = $item['name'];
            $server->save();
        }
    }
}
