'use strict';

/* Filters */

angular.module('mainFilters', []).filter('checkmark', function() {
  return function(input) {
    return input=='true' ? "right" : '';
  };
}).filter('current',function(){
	return function(input,input1) {
	    return input==input1 ? "current" : '';
	  };
}).filter('check_result',function(){
	return function (number,choose,right_choose){
		if(number == right_choose){
			return 'right';
		}else if(number == choose && choose == right_choose){
			return 'right';
		}else if(number == choose && choose != right_choose){
			return 'error';
		}
	}
});

