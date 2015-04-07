<?php namespace Cysha\Modules\Qdb\Controllers\Module;

use Cysha\Modules\Qdb\Repositories\Quote\RepositoryInterface as QuoteRepository;
use Cysha\Modules\Qdb\Repositories\Channel\RepositoryInterface as ChannelRepository;

class ViewQuoteController extends BaseModuleController
{
    public function __construct(QuoteRepository $quote, ChannelRepository $channel)
    {
        parent::__construct();

        $this->objTheme->set('mode', 'basic');

        $this->quote = $quote;
        $this->channel = $channel;

    }

    public function getIndex()
    {
        $quotes = $this->quote->getRandom(6);
        if ($quotes === false) {
            $this->setTitle('Quote Not Found');
            return $this->setView('errors.quote');
        }

        return $this->setView('quotes.home', [
            'quotes' => $quotes,
        ]);
    }

    public function getByChannel($_channel)
    {
        $channel = $this->channel->getChannel($_channel);
        if (empty($channel)) {
            return $this->setView('errors.channel');
        }

        $quotes = $this->quote->getRandomByChannel($channel, 5);
        if ($quotes === false) {
            $this->setTitle('Quote Not Found');
            return $this->setView('errors.quote');
        }

        return $this->setView('quotes.channel', [
            'channel' => $channel->transform(),
            'quotes' => $quotes,
        ]);
    }

    public function getByChannelInOrder($_channel)
    {
        $channel = $this->channel->getChannel($_channel);
        if (empty($channel)) {
            return $this->setView('errors.channel');
        }

        $quotes = $this->quote->getQuotes($channel);
        if ($quotes === false) {
            $this->setTitle('Quote Not Found');
            return $this->setView('errors.quote');
        }

        return $this->setView('quotes.channel', [
            'channel' => $channel->transform(),
            'quotes' => $quotes,
        ]);
    }

    public function getQuoteById($_channel, $_quote_id)
    {

        $channel = $this->channel->getChannel($_channel);
        if (empty($channel)) {
            return $this->setView('errors.channel');
        }

        $quote = $this->quote->getByQuoteId($channel, $_quote_id);
        if ($quote === false) {
            $this->setTitle('Quote Not Found');
            return $this->setView('errors.quote');
        }

        $data = ['data' => ['quote' => $quote]];

        $this->setTitle(sprintf('Quote#%d | %s', $_quote_id, $_channel));
        return $this->setView('quotes.single', [
            'channel' => $channel->transform(),
            'quotes' => [$data]
        ]);
    }
}
