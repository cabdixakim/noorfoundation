<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Receipt extends Model
{
    //
    protected $guarded = [];

    public function registerMediaCollections(): void
        {
            $this->addMediaCollection('receipts')
            ->singleFile();
                //add options
            
                
        }

        public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(150)
              ->height(120)
              ->sharpen(10)
              ->performOnCollections('receipts')
              ->pdfPageNumber(1);
    }

    public function payment()
    {
      return  $this->belongsTo(Payment::class);
    }
}
