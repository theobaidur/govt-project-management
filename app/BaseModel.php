<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Spatie\MediaLibrary\Models\Media;

class BaseModel extends Model implements HasMedia
{
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    protected $has_file = false;
    protected $file_field;
    protected $max_file;
    public function registerMediaCollections() {
        if($this->has_file && !empty($this->file_field)){
            $tmp = $this->addMediaCollection($this->file_field);
            if(!empty($this->max_file)){
                $tmp->maxNumberOfFiles($this->max_file);
            }
        }
    }
    public function toString(){
        return $this->name;
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
    }
}
