<?php
namespace infrajs\crumb;
use infrajs\controller\Controller;
use infrajs\each\Each;
use infrajs\controller\Run;
use infrajs\controller\Layer;
use infrajs\path\Path;
use infrajs\event\Event;
use infrajs\sequence\Sequence;
use infrajs\template\Template;
use infrajs\controller\External;
use infrajs\config\Config;

Event::handler('layer.ischeck', function ($layer) {
	$deep = (int) $layer['deep'];
	if (!$deep) return;
	$state = &$layer['crumb'];
	while ($deep && $state->child) {
		$deep--;
		$state = &$state->child;
	}
	if ($deep) {
		return false;
	}
});