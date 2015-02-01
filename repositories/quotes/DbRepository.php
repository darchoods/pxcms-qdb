<?php namespace Cysha\Modules\Qdb\Repositories\Quote;

use Cysha\Modules\Core\Repositories\BaseDbRepository;
use Cysha\Modules\Qdb;
use Config;
use DB;

class DbRepository extends BaseDbRepository implements RepositoryInterface
{
    public function __construct(Qdb\Models\Quote $repo)
    {
        $this->model = $repo;
    }

    public function create(Qdb\Models\Channel $channel, array $quote = [])
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

    public function getRandom($number=5)
    {
        $quotes = $this->model->take($number)->orderBy(DB::Raw('RAND()'))->get();
        if ($quotes === null) {
            return false;
        }

        return $this->transformModel($quotes);
    }

    public function getRandomByChannel(Qdb\Models\Channel $channel, $number=5)
    {
        $quotes = $channel->quote()->take($number)->orderBy(DB::Raw('RAND()'))->get()->first();
        if ($quotes === null) {
            return false;
        }

        return $this->transformModel($quotes);
    }

    public function getByQuoteId(Qdb\Models\Channel $channel, $quote_id)
    {
        $quote = $channel->quote()->where('quote_id', $quote_id)->take(1)->get()->first();
        if ($quote === null) {
            return false;
        }

        return $quote->transform();
    }

    public function getQuotes(Qdb\Models\Channel $channel)
    {
        $quotes = $channel->quote()->orderBy(DB::Raw('RAND()'))->take(5)->get();
        if ($quotes === null) {
            return false;
        }

        return $this->transformModel($quotes);
    }

}
