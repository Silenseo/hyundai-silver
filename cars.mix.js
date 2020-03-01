exports.modules = function (mix, path) {
	mix.js('resources/js/pages/cars/santaFe/santa-fe.js', 'public/' + path + 'js/santaFe')

	mix.js('resources/js/pages/cars/elantra/elantra.js', 'public/' + path + 'js/cars/elantra')

	mix.js('resources/js/pages/cars/tucson/tucson.js', 'public/' + path + 'js/cars/tucson')

	mix.js('resources/js/pages/cars/i30n/i30n_2019.js', 'public/' + path + 'js/cars/i30n_2019')

	mix.js('resources/js/pages/cars/solaris/solaris.js', 'public/' + path + 'js/solaris')

	mix.js('resources/js/pages/cars/sonata/sonata.js', 'public/' + path + 'js/sonata')

	mix.js('resources/js/pages/cars/new-sonata/new-sonata.js', 'public/' + path + 'js/cars/new-sonata')

	mix.js('resources/js/pages/cars/creta/creta.js', 'public/' + path + 'js/creta')

	mix.js('resources/js/pages/cars/h1/h1.js', 'public/' + path + 'js/h1')
}