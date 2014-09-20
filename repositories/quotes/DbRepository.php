<?php namespace Cysha\Modules\QdbServer\Repositories\Quote;

use Cysha\Modules\Core\Repositories\BaseDbRepository;
use Cysha\Modules\QdbServer as QdbServer;
use Config;
use DB;

class DbRepository extends BaseDbRepository implements RepositoryInterface
{
    public function __construct(QdbServer\Models\Quote $repo)
    {
        $this->model = $repo;
    }

    public function create(QdbServer\Models\Channel $channel, array $quote = [])
    {
        // increment the quote count by 1 and save
        $channel->quote_count++;
        $channel->save();

        if (($quote_id = array_get($quote, 'quote_id', false)) === false) {
            $quote_id = $channel->quote_count;
        }

        // save the quote
        return $channel->quote()->create([
            'quote_id'  => $quote_id,
            'author_id' => $quote['author_id'],
            'content'   => $quote['content'],
        ]);
    }

    public function getRandom(QdbServer\Models\Channel $channel)
    {
        $quote = $channel->quote()->take(1)->orderBy(DB::Raw('RAND()'))->get()->first();
        if ($quote === null) {
            return false;
        }

        return $quote->transform();
    }

    public function getByQuoteId(QdbServer\Models\Channel $channel, $quote_id)
    {
        $quote = $channel->quote()->where('quote_id', $quote_id)->take(1)->get()->first();
        if ($quote === null) {
            return false;
        }

        return $quote->transform();
    }
}
