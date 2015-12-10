<?php

//deep:(number),//Для crumb определяет на каком уровне от текущего будет тру... пропускает родителей. Только когда что-то будет на нужном уровне от указанного crumb
namespace infrajs\controller\ext;
use infrajs\event\Event;
class deep
{
	public function init()
	{
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
	}
}
