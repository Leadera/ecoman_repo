/*
 * --------------------------------------------------------------------
 * jQuery plugin
 * Author: Sandro Maggi, sandro.maggi@fhnw.ch
 *
 * based on visualize.jQuery.js by: Scott Jehl, scott@filamentgroup.com
 * --------------------------------------------------------------------
*/
(function ($) {
	$.fn.graph = function (options, container) {
		return $(this).each(function () {
			var o = $.extend({
				type: 'ecopot',
				width: $(this).width(),
				height: $(this).height(),
				rowFilter: ' ',
				colFilter: ' ',
				colors: ['#be1e2d', '#666699', '#92d5ea', '#ee8310', '#8d10ee', '#5a3b16', '#26a4ed', '#f45a90', '#e9e744'],
				xAxisInterval: 50000000, //playing around
				yAxisInterval: 20000, //playing around
				roundTo: 0,
				xUnit: '',
				yUnit: '',
				rotateX: true,
				xName: '',
				yName: ''
			}, options);

			//reset width, height to numbers
			o.width = parseFloat(o.width);
			o.height = parseFloat(o.height);

			var self = $(this);

			//function to scrape data from html table
			function scrapeTable() {
				var tableData = {
					dataGroups: function () {
						var dataGroups = [];
						self.find('tr:gt(0)').filter(o.rowFilter).not('.ignore').each(function (i) {
							dataGroups[i] = {};
							dataGroups[i].coords = [];

							$(this).find('td').filter(o.colFilter).each(function (j) {
								var f = parseFloat($(this).text());
								if (o.type == 'mckinsey' && f < 0 && j == 0) {
									f = 0;
								}

								var rt = Math.pow(10, o.roundTo);
								f = (Math.round(f * rt) / rt);

								dataGroups[i].coords.push(f);
							});
						});
						return dataGroups;
					},
					topXValue: function () {
						var topValue = 0;
						$(dataGroups).each(function () {
							var f = this.coords[0];

							topValue = f > topValue ? f : topValue;
						});

						return topValue;
					},
					bottomXValue: function () {
						var bottomValue = Number.MAX_VALUE;
						$(dataGroups).each(function () {
							var f = this.coords[0];

							bottomValue = f < bottomValue ? f : bottomValue;
						});

						return bottomValue;
					},
					topYValue: function () {
						var topValue = 0;
						$(dataGroups).each(function () {
							var f = this.coords[1];

							topValue = f > topValue ? f : topValue;
						});

						return topValue;
					},
					bottomYValue: function () {
						var bottomValue = Number.MAX_VALUE;
						$(dataGroups).each(function () {
							var f = this.coords[1];

							bottomValue = f < bottomValue ? f : bottomValue;
						});

						if (bottomValue < 0 && Math.abs(bottomValue % o.yAxisInterval) > 0.001) {
							bottomValue = bottomValue - (o.yAxisInterval - Math.abs(bottomValue % o.yAxisInterval));
						}

						return bottomValue;
					},
					labels: function () {
						var labels = [];

						self.find('tr:eq(0) th:gt(0)').filter(o.colFilter).each(function () {
							labels.push($(this).html());
						});

						return labels;
					},
					keys: function () {
						var keys = [];

						self.find('tr:gt(0) th').filter(o.rowFilter).not('.ignore').each(function (i) {
							keys.push($(this).html());
						});

						return keys;
					},
					xAxis: function () {
						var xAxis = [];
						var topXValue = this.topXValue();
						var rt = Math.pow(10, o.roundTo);

						xAxis.push(0);

						if (o.type == 'mckinsey') {
							topXValue = 0;

							$(dataGroups).each(function () {
								topXValue += parseFloat(this.coords[0]);
							});
						}

						var i = 0;
						while (xAxis[xAxis.length - 1] < topXValue && i++ < 100) {
							var f = xAxis[xAxis.length - 1] + o.xAxisInterval;
							f = (Math.round(f * rt) / rt);

							xAxis.push(f);
						}

						return xAxis;
					},
					yAxis: function () {
						var yAxis = [];
						var topYValue = this.topYValue();
						var rt = Math.pow(10, o.roundTo);

						yAxis.push(Math.min(0, this.bottomYValue()));

						var i = 0;
						while (yAxis[yAxis.length - 1] < topYValue && i++ < 100) {
							var f = yAxis[yAxis.length - 1] + o.yAxisInterval;
							f = (Math.round(f * rt) / rt);

							yAxis.push(f);
						}

						return yAxis;
					}
				};

				return tableData;
			};

			//function to create a chart
			var createChart = {
				ecopot: function () {
					canvasContain.addClass('visualize-ecopot');

					var label;

					// xAxis
					var xScale = canvas.width() / xAxis[xAxis.length - 1];
					var xAxisUL = $('<ul class="visualize-labels-x"></ul>')
					.width(canvas.width())
					.height(canvas.height())
					.insertBefore(canvas);

					$.each(xAxis, function (i) {
						var thisLi = $('<li><span>' + this + '</span></li>')
						.prepend('<span class="line" />')
						.css('left', xScale * this)
						.appendTo(xAxisUL);
						var label = thisLi.find('span:not(.line)');
						var leftOffset = label.width() / -2;
						label
						.css('margin-left', leftOffset)
						.addClass('label');
						if (o.rotateX) label.addClass('rotate');
					});
					if (o.xUnit != '') {
						var xUnitLi = $('<li><span>[' + o.xUnit + ']</span></li>')
							.prepend('<span class="line" />')
							.css('left', xScale * xAxis[xAxis.length - 1] + 30)
							.appendTo(xAxisUL);
						label = xUnitLi.find('span:not(.line)');
						var leftOffset = label.width() / -2;
						label.css('margin-left', leftOffset).addClass('label');
						if (o.rotateX) label.addClass('rotate');
					}

					$('<span class="visualize-label-x">' + o.xName + '</span>').insertBefore(canvas);

					// yAxis
					var yScale = canvas.height() / yAxis[yAxis.length - 1];
					var yAxisUL = $('<ul class="visualize-labels-y"></ul>')
					.width(canvas.width())
					.height(canvas.height())
					.insertBefore(canvas);

					$.each(yAxis, function (i) {
						var thisLi = $('<li><span>' + this + '</span></li>')
						.prepend('<span class="line"  />')
						.css('bottom', yScale * this)
						.prependTo(yAxisUL);
						var label = thisLi.find('span:not(.line)');
						var topOffset = label.height() / -2;
						label
						.css('margin-top', topOffset)
						.addClass('label');
					});
					if (o.yUnit != '') {
						var yUnitLi = $('<li><span>[' + o.yUnit + ']</span></li>')
							.prepend('<span />')
							.css('bottom', yScale * yAxis[yAxis.length - 1] + 25)
							.prependTo(yAxisUL);
						label = yUnitLi.find('span:not(.line)');
						var topOffset = label.height() / -2;
						label.css('margin-top', topOffset).addClass('label');
					}

					$('<span class="visualize-label-y rotate">' + o.yName + '</span>').insertBefore(canvas);

					// set points
					var zeroY = o.height * (yAxis[yAxis.length - 1] / (yAxis[yAxis.length - 1] - yAxis[0]));

					$(dataGroups).each(function (i) {
						ctx.fillStyle = o.colors[i];
						ctx.beginPath();
						ctx.arc(this.coords[0] * xScale, zeroY - this.coords[1] * yScale, 10, 0, Math.PI * 2, true);
						ctx.closePath();
						ctx.fill();
					});

					$(dataGroups).each(function (i) {
						ctx.fillStyle = '#000000';
						ctx.fillText(i+1, this.coords[0] * xScale - 3, zeroY - this.coords[1] * yScale + 3);
					});
				},

				mckinsey: function () {
					canvasContain.addClass('visualize-mckinsey');

					// sort
					var n = dataGroups.length;
					for (var j = n; j > 1; j--) {
						for (var i = 0; i < j - 1; i++) {
							if (dataGroups[i].coords[1] > dataGroups[i + 1].coords[1]) {
								var tmp = dataGroups[i];
								dataGroups[i] = dataGroups[i + 1];
								dataGroups[i + 1] = tmp;

								var tk = keys[i];
								keys[i] = keys[i + 1];
								keys[i + 1] = tk;
							}
						}
					}

					// xAxis
					xAxis = tableData.xAxis();
					var xScale = canvas.width() / xAxis[xAxis.length - 1];
					var xAxisUL = $('<ul class="visualize-labels-x"></ul>')
					.width(canvas.width())
					.height(canvas.height())
					.insertBefore(canvas);

					$.each(xAxis, function (i) {
						var thisLi = $('<li><span>' + this + '</span></li>')
						.prepend('<span class="line" />')
						.css('left', xScale * this)
						.appendTo(xAxisUL);
						var label = thisLi.find('span:not(.line)');
						var leftOffset = label.width() / -2;
						label
						.css('margin-left', leftOffset)
						.addClass('label rotate');
					});
					if (o.xUnit != '') {
						var xUnitLi = $('<li><span>[' + o.xUnit + ']</span></li>')
							.prepend('<span class="line" />')
							.css('left', xScale * xAxis[xAxis.length - 1] + 30)
							.appendTo(xAxisUL);
						label = xUnitLi.find('span:not(.line)');
						var leftOffset = label.width() / -2;
						label.css('margin-left', leftOffset).addClass('label');
						if (o.rotateX) label.addClass('rotate');
					}

					$('<span class="visualize-label-x">' + o.xName + '</span>').insertBefore(canvas);

					// yAxis
					var yMin = Math.min(0, tableData.bottomYValue());
					var yScale = canvas.height() / (yAxis[yAxis.length - 1] - yMin);
					var yAxisUL = $('<ul class="visualize-labels-y"></ul>')
					.width(canvas.width())
					.height(canvas.height())
					.insertBefore(canvas);

					$.each(yAxis, function (i) {
						var thisLi = $('<li><span>' + this + '</span></li>')
						.prepend('<span class="line"  />')
						.css('bottom', yScale * (this - yMin))
						.prependTo(yAxisUL);
						var label = thisLi.find('span:not(.line)');
						var topOffset = label.height() / -2;
						label
						.css('margin-top', topOffset)
						.addClass('label');
					});
					if (o.yUnit != '') {
						var yUnitLi = $('<li><span>[' + o.yUnit + ']</span></li>')
							.prepend('<span />')
							.css('bottom', yScale * yAxis[yAxis.length - 1] + 25)
							.prependTo(yAxisUL);
						label = yUnitLi.find('span:not(.line)');
						var topOffset = label.height() / -2;
						label.css('margin-top', topOffset).addClass('label');
					}

					$('<span class="visualize-label-y rotate">' + o.yName + '</span>').insertBefore(canvas);

					// draw boxes
					var zeroY = o.height * (yAxis[yAxis.length - 1] / (yAxis[yAxis.length - 1] - yAxis[0]));
					var lastX = 0;

					$(dataGroups).each(function (i) {
						var width = this.coords[0] * xScale;

						ctx.fillStyle = o.colors[i];
						ctx.fillRect(lastX, zeroY, width, -this.coords[1] * yScale);

						lastX += width;
					});
				}
			};

			//create new canvas, set w&h attrs (not inline styles)
			var canvasNode = document.createElement("canvas");
			canvasNode.setAttribute('height', o.height);
			canvasNode.setAttribute('width', o.width);
			var canvas = $(canvasNode);

			//create canvas wrapper div, set inline w&h, append
			var canvasContain = (container || $('<div class="visualize" role="img" />'))
			.height(o.height)
			.width(o.width)
			.append(canvas);

			//scrape table (this should be cleaned up into an obj)
			var tableData = scrapeTable();
			var dataGroups = tableData.dataGroups();
			var keys = tableData.keys();
			var labels = tableData.labels();
			var xRange = [tableData.bottomXValue(), tableData.topXValue()];
			var yRange = [tableData.bottomYValue(), tableData.topYValue()];
			var xAxis = tableData.xAxis();
			var yAxis = tableData.yAxis();

			//title/key container
			var infoContain = $('<div class="visualize-info"></div>')
			.appendTo(canvasContain);

			//append new canvas to page
			if (!container) { canvasContain.insertAfter(this); }
			if (typeof (G_vmlCanvasManager) != 'undefined') { G_vmlCanvasManager.init(); G_vmlCanvasManager.initElement(canvas[0]); }

			var ctx;
			try { // for IE8
				//set up the drawing board	
				ctx = canvas[0].getContext('2d');

				//create chart
				createChart[o.type]();
			} catch (e) {
				throw (e); //for debugging
			}
			canvas.html("If this text appears, please upgrade your browser <br /> to the newest version.");

			//append key
			var newKey = $('<ul class="visualize-key"></ul>');

			for (var i = 0; i < keys.length; i++) {
				//var $key = $('<li><span class="visualize-key-color" style="background: ' + o.colors[i] + '"></span><div class="visualize-key-label">' + keys[i] + '</div></li>');
				var svg = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="visualize-key-color"><rect width="10" height="10" style="fill:' + o.colors[i] + ';"/></svg>';
				var $key = $('<li>' + svg + '<div class="visualize-key-label">' + keys[i] + '</div></li>');

				$key.appendTo(newKey);
			}
			newKey.appendTo(infoContain);

			//clean up some doubled lines that sit on top of canvas borders (done via JS due to IE)
			$('.visualize-line li:last-child span.line, .visualize-area li:last-child span.line, .visualize-bar .visualize-labels-y li:last-child span.line').css('border', 'none');
			if (!container) {
				//add event for updating
				canvasContain.bind('graphRefresh', function () {
					self.graph(o, $(this).empty());
				});
			}
		}).next(); //returns canvas(es)
	};
})(jQuery);