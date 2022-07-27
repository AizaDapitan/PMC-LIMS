<?php

namespace App\Providers;

use App\Models\DeptuserTrans;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
        //
        view()->composer(
            'layouts.app',
            function ($view) {
                $forOffApproval = DeptuserTrans::where([['status', 'Pending'],['isdeleted',false],['isSaved',1]])->count();
                $forReceive = DeptuserTrans::where([['status', 'Approved'],['isReceived',false]])->count();
                $unsaved = DeptuserTrans::where([['isSaved', 0],['created_by',auth()->user()->username],['isdeleted',0]])->count();
                // dd($forReceive);
                $view->with(
                    compact(
                        'forOffApproval',
                        'forReceive',
                        'unsaved'
                    )
                );
            }
        );
    }
}
