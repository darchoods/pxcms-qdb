<?php namespace Cysha\Modules\QdbServer\Repositories\Channel;

use Cysha\Modules\Core\Repositories\BaseDbRepository;
use Cysha\Modules\QdbServer as QdbServer;

class DbRepository extends BaseDbRepository implements RepositoryInterface
{
    public function __construct(QdbServer\Models\Channel $repo)
    {
        $this->model = $repo;
    }

    public function getChannel($channelName)
    {
        return $this->model->firstOrCreate([
            'channel' => $channelName
        ]);
    }

}
