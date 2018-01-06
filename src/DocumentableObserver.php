<?php

namespace Baraear\Documentable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DocumentableObserver
{

    /**
     * Listen to the saving event.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function saving(Model $model)
    {
        if (is_array($model->documentable())) {
            $attributes = $model->documentable();
            if (isset($attributes['prefix'])) {
                $prefix = $attributes['prefix'];
                if (isset($attributes['length'])) {
                    if ($attributes['length'] > 0) {
                        $length = $attributes['length'];
                    } else {
                        throw new \UnexpectedValueException('Documentable "method" for ' . get_class($model) . ' must have "length" more than zero.');
                    }
                } else {
                    $length = 4;
                }
                $current_date = substr(date('Y'), -2) . date('m') . date('d');
                $current_running = $model->query()->whereDate('created_at', '=', DB::raw('CURDATE()'))->count();
//                $next_running = substr(function () use ($current_running, $length) {
//                    $total = '';
//                    for ($i = 0; $i < $length; $i++) {
//                        $total .= '0';
//                    }
//                    return $total . (($current_running) + 1);
//                }, (-1 * abs($length)));
                $next_running = str_pad(($current_running + 1), $length, '0', STR_PAD_LEFT);
                $documentable_id =  $prefix . $current_date . $next_running;
                $model->documentable = $documentable_id;
            } else {
                throw new \UnexpectedValueException('Documentable "method" for ' . get_class($model) . ' must set "prefix" in an array.');
            }
        } else {
            throw new \UnexpectedValueException('Documentable "method" for ' . get_class($model) . ' must return an array.');
        }
    }

}