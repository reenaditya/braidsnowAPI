<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Arr;
use Str;

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
        Builder::macro('search', function ($attributes,$searchTerm = "") {
            if (empty($searchTerm)) {
               return $this;
            }
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        Str::contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                                $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
        Builder::macro('filter', function (array $request) {

            $this->where(function (Builder $query) use ($request) {
                foreach ($request as $key => $data) {
                
                    $query->search($key,$data);     
                }
               
            });

            return $this;
        });
        Builder::macro('pagination', function (Request $request) {
           
            if ($request->has('pagination') && !empty($request->pagination)) {
                return $this->paginate($request->pagination);
            }else{
                return $this->paginate(10);
            }
               
        });
    }
}
