<?php namespace Cysha\Modules\QdbServer\Models;

use Cysha\Modules\Core\Models\BaseModel as CoreBaseModel;

class Quote extends CoreBaseModel
{
    use \Illuminate\Database\Eloquent\SoftDeletingTrait;

    public $table = 'quote_content';
    public $fillable = ['channel_id', 'quote_id', 'author_id', 'content', 'view_count'];

    public function channel()
    {
        return $this->belongsTo(__NAMESPACE__.'\Channel');
    }

    public function author()
    {
        $model = \Config::get('auth.model');
        return $this->belongsTo($model);
    }

    public function transform()
    {
        return [
            'quote_id'   => (int) $this->quote_id,
            'content'    => (string) $this->content,
            'view_count' => (int) $this->view_count,
            'created'    => date_array($this->created_at),
            'updated'    => date_array($this->updated_at),

            'channel'    => $this->channel->transform(),
            'author'     => $this->author_id,
        ];
    }
}
