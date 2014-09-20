<?php namespace Cysha\Modules\QdbServer\Models;

use Cysha\Modules\Core\Models\BaseModel as CoreBaseModel;

class Channel extends CoreBaseModel
{
    public $timestamps = false;

    public $table = 'quote_channels';

    public $fillable = ['channel'];

    public function quote()
    {
        return $this->hasMany(__NAMESPACE__.'\Quote');
    }

    public function transform()
    {
        return [
            'channel_id'  => $this->id,
            'channel'     => $this->channel,
            'quote_count' => $this->quote_count,
        ];
    }
}
