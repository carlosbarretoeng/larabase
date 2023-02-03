<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait SoftDeleteTrait
{
    public array $softDelete;
    public function setSoftDelete(array $softDelete = []): void
    {
        $this->softDelete = $softDelete;
    }
//    public static function boot()
//    {
//        parent::boot();
//
//        self::deleting(function (Model $model) {
//            self::cascadeSoftDelete($model);
//        });
//    }

    static function softDelete(): void {
        dd(self::getAttribute());
    }

    static function cascadeSoftDelete(Model $model): void {
        $relationTypes = array_keys($model->softDelete);

        $model_primary_field = Str::snake(class_basename($model)) . '_' . $model->getKeyName();
        $model_primary_value = $model->getAttribute($model->getKeyName());

        foreach ($relationTypes as $relationType){
            switch ($relationType){
                case 'hasMany':
                    $models = $model->softDelete[$relationType];
                    foreach ($models as $model_){
                        $toDelete = $model_::query()->where($model_primary_field, $model_primary_value)->get();
                        foreach ($toDelete as $item) {
                            $item->delete();
                        }
                    }
                    break;
                default:
                    $models = $model->softDelete[$relationType];
                    foreach ($models as $model_) {
                        $referencedField = $model->getTable() . '.' . Str::snake(class_basename($model_)) . '_' . (new $model_())->getKeyName();
                        $childrenOfParent = $model_::query()
                            ->join($model->getTable(), (new $model_())->getQualifiedKeyName(), '=', $referencedField)
                            ->where((new $model_())->getQualifiedKeyName(), $model->getAttribute(Str::snake(class_basename($model_)) . '_' . (new $model_())->getKeyName()))
                            ->where($model->getQualifiedKeyName(), '!=', $model->getAttribute($model->getKeyName()))
                            ->count();
                        if ($childrenOfParent < 1) {
                            $toDelete = $model_::where((new $model_())->getKeyName(), $model->getAttribute(Str::snake(class_basename($model_)) . '_' . (new $model_())->getKeyName()))->get();
                            foreach ($toDelete as $item) {
                                $item->delete();
                            }
                        }
                    }
            }
        }
    }
}
