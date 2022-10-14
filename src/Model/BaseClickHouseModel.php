<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PrageethPeiris\LaravelQueryBuilderToClickhouse\CustomEloquentBuilders\CustomEloquentBuilder;

class BaseClickHouseModel extends Model
{

    protected  $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
    protected  $connection = 'clickhouse_custom';




    // overides the base eloqent builder
    public function newEloquentBuilder($query) : Builder
    {
        return new CustomEloquentBuilder($query);
    }



    public static function getJoinColumn() : string{

        $class_name =  static::class;

        if(!property_exists($class_name,'tableJoinKey')){
            throw new \Exception("You have not defined tableJoinKey in the model {$class_name}");

        }

        $table_name = (new static())->table;
        $joinKey = (new static())->tableJoinKey;

        return  "{$table_name}.{$joinKey}";


    }





}