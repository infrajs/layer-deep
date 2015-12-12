<?php
namespace infrajs\crumb;
use infrajs\controller\Controller;
use infrajs\infra\Each;
use infrajs\controller\Run;
use infrajs\controller\Layer;
use infrajs\path\Path;
use infrajs\event\Event;
use infrajs\sequence\Sequence;
use infrajs\template\Template;
use infrajs\controller\External;
use infrajs\infra\Infra;

Infra::req('controller');

Event::handler('layer.ischeck', function ($layer) {
	$deep = (int) $layer['deep'];
	if (!$deep) {
		return;
	}
	$state = &$layer['crumb'];
	while ($deep && $state->child) {
		--$deep;
		$state = &$state->child;
	}
	if (is_null($state->obj) || $deep) {
		return false;
	}
});