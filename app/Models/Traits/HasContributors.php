<?php
namespace App\Models\Traits;

use App\Models\Auth\User;
use DB;
use App\Models\Attachments\Attachment;

trait HasContributors
{
    public static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            if (\Schema::hasColumn(with(new static )->getTable(), 'updated_by')) {
                static::saving(function ($table) {
                    $table->updated_by = auth()->user()->id;
                });
            }

            if (\Schema::hasColumn(with(new static )->getTable(), 'created_by')) {
                static::creating(function ($table) {
                    $table->updated_by = auth()->user()->id;
                    $table->created_by = auth()->user()->id;
                });
            }
        }

        // if($log_table = (new static)->log_table){
        //     static::saved(function ($table) {
        //         $log = $table->attributes;
        //         $log[$table->log_table_fk] = $log['id'];
        //         unset($log['id']);

        //         DB::table($table->log_table)->insert($log);
        //     });

        //     static::deleting(function ($table) {
        //         $log = $table->attributes;
        //         $log[$table->log_table_fk] = $log['id'];
        //         unset($log['id']);

        //         DB::table($table->log_table)->insert($log);
        //     });
        // }
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function createdBy()
    {
        return isset($this->creator) ? $this->creator->name : '[System]';
    }

    public function updatedBy()
    {
        return isset($this->updater) ? $this->updater->name : '[System]';
    }

    public static function saveData($request, $identifier = 'id')
    {
        $record = static::prepare($request, $identifier);
        // dd($request->all());
        $record->fill($request->all());
        $record->save();

        if($request->attachment)
        {
              $record->uploadAttachWithoutDelete($request->attachment);
        }

        return $record;
    }

    public static function prepare($request, $identifier = 'id')
    {
        $record = new static;

        if ($request->has($identifier) && $request->get($identifier) != null && $request->get($identifier) != 0) {
            $record = static::find($request->get($identifier));
        }

        return $record;
    }

    public function uploadAttachWithoutDelete($pictures, $taken = null, $exist = null)
    {
        if(count($pictures) > 0)
        {
            foreach($pictures as $key => $pict)
            {
                if($pict != null)
                {

                  $data['filename'] = $pict->getClientOriginalName();
                  $data['url'] = $pict->storeAs($this->filesMorphClass(), md5($pict->getClientOriginalName()).''.strtotime('now').'.'.$pict->getClientOriginalExtension(), 'public');
                  $data['target_type'] = $this->filesMorphClass();
                  $data['target_id'] = $this->id;

                  if($taken != null){
                      if(count($taken) > 0)
                      {
                        $data['taken_at'] = $taken[$key];
                      }
                  }

                  $save = new Attachment;
                  $save->fill($data);
                  $save->save();
                }
            }
        }
    }
}
