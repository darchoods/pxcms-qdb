<?php namespace Cysha\Modules\Qdb\Repositories\Channel;

use Cysha\Modules\Core\Repositories\BaseDbRepository;
use Cysha\Modules\Qdb;

class DbRepository extends BaseDbRepository implements RepositoryInterface
{
    public function __construct(Qdb\Models\Channel $repo)
    {
        $this->model = $repo;
    }

    public function getChannels()
    {
        return $this->model->orderBy('quote_count', 'desc')->get();
    }

    public function getChannel($channelName)
    {
        return $this->model->where('channel', $channelName)->first();
    }

    public function getOrCreate($channelName)
    {
        return $this->model->firstOrCreate([
            'channel' => $channelName
        ]);
    }

}
