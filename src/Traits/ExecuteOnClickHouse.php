<?php

namespace PrageethPeiris\LaravelQueryBuilderToClickhouse\Traits;

use Bavix\LaravelClickHouse\Database\Connection;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Tinderbox\ClickhouseBuilder\Query\Grammar;
use Illuminate\Support\Facades\Cache;

trait   ExecuteOnClickHouse
{


    public function get($columns = ['*']){

        return   $this->executeClickHouse($this->toSql(),$this->getBindings());

    }

    private function executeClickHouse($toSql,$bindings):Collection{


        $raw = $this->getRawSql($toSql,$bindings);

        $sanitized_raw = $this->sanitizeSqlQuery($raw);

        $cache_key = md5($sanitized_raw);

        //cache results by query for 24 hours
        $result  = Cache::remember($cache_key, 86400, function () use ($sanitized_raw){
            return $this->getClickHouseConnection()->select($sanitized_raw);
        });


        return collect($result);


    }

    private function getClickHouseConnection() : Connection{
        return (new Connection(config('database.connections.bavix::clickhouse')));
    }


    private function sanitizeSqlQuery(string $query):string {
        return Str::of($query)->replace('"','')->replace('@@@@@','?');
    }


    private function ReplaceBindingsQuestionMarkWithCustomCharacter(array $bindings) : array {

        return array_map(fn($item) =>  Str::replace('?','@@@@@',$item) ,$bindings);

    }



    private function getRawSql($builderSql,$builderBindings){
        $sql = $builderSql;

        $removedSpecialCharFromBindings = $this->ReplaceBindingsQuestionMarkWithCustomCharacter($builderBindings);

        foreach($removedSpecialCharFromBindings as $binding)
        {
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;


    }

    public function insert(array $values): bool
    {
        if (empty($values)) {
            return false;
        }

        if (!is_array(reset($values))) {
            $values = [$values];
        }


        $clickhouse_connection = (new Connection(config('database.connections.bavix::clickhouse')));
        $clickhouse_grammar = new Grammar();
        $current_table_name =  str_replace("'","",$clickhouse_grammar->wrap($this->from));


        $clickhouse_builder = (new \Bavix\LaravelClickHouse\Database\Query\Builder($clickhouse_connection,$clickhouse_grammar))->from($current_table_name);

        return  $clickhouse_connection->insert(
            $clickhouse_grammar->compileInsert($clickhouse_builder, $values),
            Arr::flatten($values)
        );
    }



}