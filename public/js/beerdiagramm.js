/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/beerdiagramm.js":
/*!**************************************!*\
  !*** ./resources/js/beerdiagramm.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//var style = getComputedStyle(document.body);
var theme = {}; //theme.primary = style.getPropertyValue('--primary');
//theme.secondary = style.getPropertyValue('--secondary');
//theme.success = style.getPropertyValue('--success');

theme.primary = '#375a7f';
theme.success = '#00bc8c';
var ctx = document.getElementById('myChart');
var inputdata = JSON.parse($("#data1").val());
var thisuserid = $("#data2").val();
inputdata.sort(function (a, b) {
  return b['beers_count'] - a['beers_count'];
});
var backgroundColors = inputdata.map(function (x) {
  return x['id'] == thisuserid ? theme.success : theme.primary;
});
var borderColors = inputdata.map(function (x) {
  return x['id'] == thisuserid ? theme.success : theme.primary;
});
/*
[
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			]
			
console.log(colors);

			*/

var myChart = new Chart(ctx, {
  plugins: [ChartDataLabels],
  type: 'bar',
  data: {
    labels: inputdata.map(function (x) {
      return x['nickname'];
    }),
    datasets: [{
      label: '# of beers',
      data: inputdata.map(function (x) {
        return x['beers_count'];
      }),
      backgroundColor: backgroundColors,
      borderColor: borderColors,
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          fontColor: '#fff'
        }
      }],
      xAxes: [{
        ticks: {
          fontColor: '#fff'
        }
      }]
    },
    legend: {
      display: false,
      labels: {
        fontColor: '#fff'
      }
    },
    plugins: {
      // Change options for ALL labels of THIS CHART
      datalabels: {
        color: '#fff',
        formatter: function formatter(value, context) {
          //var i = context.dataIndex;
          //var prev = context.dataset.data[i - 1];
          //var diff = prev !== undefined ? prev - value : 0;
          //var glyph = diff < 0 ? '\u25B2' : diff > 0 ? '\u25BC' : '\u25C6';
          var glyph = "\u2764"; //'\uF0FC';
          //return String.fromCharCode(parseInt('f0fc', 16));

          return Math.round(value) + ' ' + glyph;
        },
        font: {
          size: 20
        }
      }
    }
  }
});

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/js/beerdiagramm.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! c:\xampp\htdocs\beer\beerblog\resources\js\beerdiagramm.js */"./resources/js/beerdiagramm.js");


/***/ })

/******/ });