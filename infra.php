<?php
use infrajs\event\Event;
Event::handler('Layer.ischeck', function ($layer) {
	if(!isset($layer['deep'])) return;
	$deep = (int) $layer['deep'];
	if (!$deep) return;
	$state = &$layer['crumb'];
	while ($deep && $state->child) {
		$deep--;
		$state = &$state->child;
	}
	if ($deep) {
		$layer['is_save_branch'] = false;
		return false;
	}
}, 'deep:div');