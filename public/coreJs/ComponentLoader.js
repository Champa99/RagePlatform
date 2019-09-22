
/**
 * @component ComponentLoader
 * @author Champa
 */

'use strict';

var ComponentLoader = {};

ComponentLoader.load = function(path) {

    var s = document.createElement('script');
	s.type = 'text/javascript';
	s.async = true;
	s.src = path + '.js';
	var x = document.getElementsByTagName('head')[0];
	x.appendChild(s);
	
	console.log('Extension loaded: ' + path);
};