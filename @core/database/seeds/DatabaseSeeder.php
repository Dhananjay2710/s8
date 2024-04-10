<?php
namespace Database\Seeders;
use App\Country;
use App\ServiceCity;
use Database\Factories\ServiceCityFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use function fake;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(StaticOptionsTableSeeder::class);
        
        update_static_option('site_script_version','1.5.0');

        // for ($i=0;$i<10000;$i++){
        //     ServiceCity::create([
        //         'service_city' => Str::random(30),
        //         'status' => 1,
        //         'country_id' => Country::inRandomOrder()->first()->id,
        //     ]);
        // }

         $permissions = [
//            'wallet-list',
//            'wallet-history',
         ];
         
       foreach ($permissions as $permission){
          \Spatie\Permission\Models\Permission::updateOrCreate(['name' => $permission],['name' => $permission,'guard_name' => 'admin']);
       }
    }

}
