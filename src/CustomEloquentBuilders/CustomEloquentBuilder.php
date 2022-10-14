<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\CustomEloquentBuilders;

use Illuminate\Database\Eloquent\Builder;

class CustomEloquentBuilder extends Builder
{


    public function autoLeftJoinSubQuery(string $left,Builder $right) : self{

        $right_table_name = $right->getModel()->getTable();

        $left_join_column =  $left::getJoinColumn();

        $right_join_column  = $right->getModel()::getJoinColumn();

        $this->leftJoinSub($right,$right_table_name,function($join) use ($left_join_column,$right_join_column){
            $join->on($left_join_column,'=',$right_join_column);
        });

        return $this;

    }









}