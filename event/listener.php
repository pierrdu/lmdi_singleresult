<?php
/**
 *
 * @package phpBB Extension - LMDI Single Result
 * @copyright (c) 2022 LMDI - Pierre Duhem
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace lmdi\singleresult\event;

/**
 * @ignore
 */

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{

	/* @var \phpbb\template\template */
	protected $template;

	public function __construct(\phpbb\template\template $template)
	{
		$this->template = $template;
	}


	static public function getSubscribedEvents()
	{
	return array(
		'core.search_backend_search_after' => 'singleres',
	);
	}


	public function singleres($event)
	{
		$total_match_count = $event['total_match_count'];
		if ($total_match_count == 1)
		{
			$sql_where = $event['sql_where'];
			$topic_id = (int) substr ($sql_where, 12);
			$url = 'viewtopic.php?t=' . $topic_id;
			header ("location: $url");
		}
	}


}
