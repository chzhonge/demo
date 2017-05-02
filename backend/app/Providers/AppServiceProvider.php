<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers;
use Zhong\GameConfig;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('from_number_zero_int', function ($attribute, $value, $parameters, $validator) {
            for ($s=0; $s < strlen($value); $s++) {
                if (!is_numeric($value[$s])) {
                    return false;
                }
            }
            return true;
        });

        Validator::extend('answer_length', function ($attribute, $value, $parameters, $validator) {
            if (strlen($value) != GameConfig::$ANSWER_LENGTH) {
                return false;
            }
            return true;
        });

        Validator::extend('answer_not_repeat', function ($attribute, $value, $parameters, $validator) {
            for ($nowTarget = strlen($value)-1; 0 < $nowTarget; $nowTarget--) {
                for ($beforeTarget = $nowTarget-1; 0 <= $beforeTarget; $beforeTarget--) {
                    if ($value[$nowTarget] == $value[$beforeTarget]) {
                        return false;
                    }
                }
            }
            return true;
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Wn\Generators\CommandsServiceProvider');
    }
}
