/* Quick guide to BackstopJS commands
 
  backstop reference --configPath=backstop.js --pathFile=paths --env=local --refHost=http://site.dev
  backstop test --configPath=backstop.js --pathFile=paths --env=local --testHost=http://site.dev
 
*/
 
var args = require('minimist')(process.argv.slice(2)); // grabs the process arguments
var dotenv = require('dotenv').config(); // handles basic auth
var defaultPaths = ['/']; // default path just checks the homepage as a quick smoke test
var scenarios = []; // The array that'll have the URL paths to check
 
// env argument will capture the environment URL
// if you use one of the options below to pass in, e.g. --env=dev
var environments = {
  'dev': 'http://hyundai',
  'staging': 'http://new-hyundai.familyagency.ru',
  'prod': 'https://hyundai.ru'
};
var default_environment = 'dev';
 
// Environments that are being compared
if (!args.env) {
  args.env = default_environment;
}
// if you pass in a bogus environment, it’ll still use the default environment
else if (!environments.hasOwnProperty(args.env)) {
  args.env = default_environment;
}
 
// Site for reference screenshots
if (!args.refHost) {
  args.refHost = environments[args.env];
}
 
// Site for test screenshots
if (!args.testHost) {
  args.testHost = environments[args.env];
}
 
// Directories to save screenshots
var saveDirectories = {
  "bitmaps_reference": "./backstop_data/"+args.env+"_reference",
  "bitmaps_test": "./backstop_data/"+args.env+"_test",
  "html_report": "./backstop_data/"+args.env+"_html_report",
  "ci_report": "./backstop_data/"+args.env+"_ci_report"
};
 
// Work out which paths to use: an array from a file, a supplied array, or defaults
// We'll be using the array from paths.js
if (args.pathFile) {
  var pathConfig = require('./'+args.pathFile+'.js'); // use paths.js file
  var paths = pathConfig.array;
} else if (args.paths) {
  pathString = args.paths; // pass in a comma-separated list of paths in terminal
  var paths = pathString.split(',');
} else {
  var paths = defaultPaths; // keep with the default of just the homepage
}

//List of pages for tests
if (args.pages) {
	var arrPages = args.pages.split(', ');

	if (Array.isArray(arrPages)) {
		var pages = arrPages;
	}
}
 
// Scenarios are a default part of config for BackstopJS
// Explanations for the sections below are at https://www.npmjs.com/package/backstopjs

console.log(args.pages)
for (var k = 0; k < paths.length; k++) {
	if (pages) {
		if (pages.some(page=>page === paths[k].name)) {
			setScenarios(paths[k])
		}
	} else {
		setScenarios(paths[k])
	}
}

function setScenarios(path) {
	if (path.scenarios.length > 0) {
		var scenatiosArr = path.scenarios.map(function(scenario) {
			scenario.label = scenario.label + path.path;
			scenario.url = args.testHost + path.path;
			scenario.referenceUrl = args.refHost + path.path;
	
			if (scenario.removeSelectors.length === 0) {
				scenario.removeSelectors = [".cookie"]
			} else {
				scenario.removeSelectors.push(".cookie")
			}

			return scenario;
		})

		scenarios = scenarios.concat(scenatiosArr);
	} else {
		scenarios.push (
			{
			  "label": path.path,
			  "referenceUrl": args.refHost + path.path,
			  "url": args.testHost + path.path,
			  "hideSelectors": [],
			  "removeSelectors": [".cookie"],
			  "selectors": ["document"], // "document" will snapshot the entire page
			  "delay": 2500,
			  "misMatchThreshold" : 0.1
			}
		);
	}
}

// BackstopJS configuration
module.exports =
{
  "id": "project_"+args.env+"_config",
  "viewports": [
    {
        "label": "desctop",
        "width": 1920,
        "height": 1080
      },
      {
        "label": "small desctop",
        "width": 1280,
        "height": 800
      },
      {
        "label": "iPad landscape",
        "width": 1024,
        "height": 768
      },
      {
        "label": "iPad portrait",
        "width": 768,
        "height": 1024
      },
      {
        "label": "iphone SE",
        "width": 320,
        "height": 568
      }
  ],
  "onBeforeScript": "puppet/onBefore.js",
  "onReadyScript": "puppet/onReady.js",
  "scenarios":
    scenarios,
  "paths":
    saveDirectories,
	"report": ["browser"],
	"engine": "puppeteer",
	"engineOptions": {
		"args": ["--no-sandbox"]
	},
	"asyncCaptureLimit": 2,
	"asyncCompareLimit": 5,
	"debug": false,
	"debugWindow": false
};