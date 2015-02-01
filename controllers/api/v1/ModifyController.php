<?php namespace Cysha\Modules\Qdb\Controllers\Api\V1;

use Cysha\Modules\Qdb\Repositories\Quote\RepositoryInterface as QuoteRepository;
use Cysha\Modules\Qdb\Repositories\Channel\RepositoryInterface as ChannelRepository;
use Input;

class ModifyController extends BaseController
{
    public function __construct(QuoteRepository $quote, ChannelRepository $channel)
    {
        parent::__construct();
        $this->quote = $quote;
        $this->channel = $channel;
    }

    public function postCreateQuote()
    {
        $channel = Input::get('channel', false);
        if ($channel === false) {
            return $this->sendError('Missing Post Variable (channel)');
        }

        $author = Input::get('author', false);
        if ($author === false) {
            return $this->sendError('Missing Post Variable (author)');
        }

        $quote = Input::get('quote', false);
        if ($quote === false) {
            return $this->sendError('Missing Post Variable (quote)');
        }

        $channel = $this->channel->getOrCreate($channel);
        if (empty($channel)) {
            return $this->sendError('Channel cant be found.');
        }

        $quote = $this->quote->create($channel, [
            'content'   => $quote,
            'author_id' => $author,
        ]);
        if ($quote === false) {
            return $this->sendError($quote);
        }

        return $this->sendResponse('ok', 200, ['quote' => $quote->transform()]);
    }

    //public function postVoteDown() {
    //
    //}
}
