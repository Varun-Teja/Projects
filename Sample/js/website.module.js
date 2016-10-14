(function(){

	'use strict';

  	angular.module('website', ['ngRoute']).config(moduleConfig);

  	function moduleConfig($routeProvider) {
	$routeProvider

		.when("/",{
			templateUrl : "views/root.html"
	})
		.when("/about",{
			templateUrl : "views/aboutme.html"
	})
		.when("/skills",{
			templateUrl : "views/skills.html"
	})
		.when("/projects",{
			templateUrl : "views/projects.html"
	})
		.when("/work",{
			templateUrl : "views/work.html"
	})
		.when("/accom",{
			templateUrl : "views/accom.html"
	})
		.when("/contact",{
			templateUrl : "views/contact.html"
	})
		.when("/favorites",{
			templateUrl : "views/fav.html"
	})
		.otherwise({
        	redirectTo : "/"
    });
};

})();







