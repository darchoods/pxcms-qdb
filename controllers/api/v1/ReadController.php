<?php namespace Cysha\Modules\QdbServer\Controllers\Api\V1;

use Cysha\Modules\QdbServer\Repositories\Quote\RepositoryInterface as QuoteRepository;
use Cysha\Modules\QdbServer\Repositories\Channel\RepositoryInterface as ChannelRepository;
use Input;

class ReadController extends BaseController
{
    public function __construct(QuoteRepository $quote, ChannelRepository $channel)
    {
        parent::__construct();
        $this->quote = $quote;
        $this->channel = $channel;
    }

    public function postFindRandom()
    {
        $channel = Input::get('channel', false);
        if ($channel === false) {
            return $this->sendError('Missing Post Variable (channel)');
        }

        $channel = $this->channel->getChannel($channel);
        if (empty($channel)) {
            return $this->sendError('Channel cant be found.');
        }

        $quote = $this->quote->getRandom($channel);
        if ($quote === false) {
            $this->sendResponse('No Quotes found.');
        }
        $data['quote'] = $quote;

        return $this->sendResponse('ok', 200, $data);
    }

    public function postFindById()
    {
        $channel = Input::get('channel', false);
        if ($channel === false) {
            return $this->sendError('Missing Post Variable (channel)');
        }
        $quote_id = Input::get('quote_id', false);
        if (!ctype_digit($quote_id) || $quote_id === false) {
            return $this->sendError('Missing Post Variable (channel)');
        }

        $channel = $this->channel->getChannel($channel);
        if (empty($channel)) {
            return $this->sendError('Channel cant be found.');
        }

        $quote = $this->quote->getByQuoteId($channel, $quote_id);
        if ($quote === false) {
            $this->sendResponse('Quote ID not found.');
        }
        $data['quote'] = $quote;

        return $this->sendResponse('ok', 200, $data);
    }


}
