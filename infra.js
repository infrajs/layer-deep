//deep:(number),//Для crumb определяет на каком уровне от текущего будет тру... пропускает родителей. Только когда что-то будет на нужном уровне от указанного crumb
import { Event } from '/vendor/infrajs/event/Event.js'
Event.handler('Layer.ischeck', function (layer) {
	var deep = layer.deep || 0;
	var crumb = layer.crumb;
	while (deep && crumb.child) {
		deep--;
		crumb = crumb.child;
	}
	if (deep) {
		layer.is_save_branch = false;
		return false;
	}
}, 'deep:div');
