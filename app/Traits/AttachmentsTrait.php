<?php


namespace App\Traits;

use App\Attachment;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

trait AttachmentsTrait
{
    private string $attachable_resource;

    public $attachments_rules = [
        'file' => 'required|mimes:jpg,jpeg,img,png,pdf,xlsx,docx,doc,csv,rar,svg,tar,txt,xls,zip'
    ];

    public $images_rules = array(
        'file' => 'required|mimes:jpg,jpeg,img,png,svg'
    );


    public function getAttachableResource(): string
    {
        return $this->attachable_resource;
    }

    public function setAttachableResource($resource)
    {
        $this->attachable_resource = $resource;
    }

    public function storeAttachments($attachments, $model_id)
    {
        foreach ($attachments as $attachment) {
            $item = new Attachment();
            $item->attachable_id = $model_id;
            $item->attachable_type = $this->getAttachableResource();
            $item->attachment = $attachment["attachment"];
            $item->save();
        }
    }


    public function optimizeImages($pathToImage)
    {
        ImageOptimizer::optimize($pathToImage);
        $this->convert($pathToImage, $pathToImage);
    }

    private function convert($from, $to)
    {
        $command = 'convert '
            . $from
            . ' '
            . '-sampling-factor 4:2:0 -strip -quality 65'
            . ' '
            . $to;
        return `$command`;
    }
}
