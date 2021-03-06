/**
 * ImageCrop 2.0
 * Michael Martin & Stephen Zuniga
 * MIT License
 */
 (function () {
    'use strict';

    /**
     * Class for cropping images using canvas
     *
     * @class ImageCrop        - Manages image cropping and saving
     * @param {object} options - Options for this instance
     */
    function ImageCrop (options) {
        if (!(this instanceof ImageCrop)) { return new ImageCrop(options); }

        this.set(options);
        this.init();
        this.initSelection();
        this.initEvents();
    }

    // Shortcuts
    var proto = ImageCrop.prototype;

    /**
     * Default options for every ImageCrop instance
     */
    proto._defaultOptions = {
        image:         document.querySelector('img.imagecrop'),
        initialFill:   'rgba(0, 0, 0, 0.1)',
        activeFill:    'rgba(0, 0, 0, 0.6)',
        outputWidth:   false,
        outputHeight:  false,
        ratio:         false,
        handleSize:    10,
        handleFill:    'rgba(0, 0, 0, 0.65)',
        keyboard:      true,
        keyboardStep:  5,
        imageType:     'image/png',
        imageQuality:  1.0,
        dragThreshold: 1
    };

    /**
     * Coordinates used when cropping the image
     */
    proto.cropCoords = {
        x: 0,
        y: 0,
        width: 0,
        height: 0
    };

    /**
     * Return the object containing options
     * If one doesn't exist, set them to the default
     *
     * @return {object} - Options currently available for this instance
     */
    proto.getOptions = function () {
        return this._options;
    };

    /**
     * Create a canvas to replace the original image
     * Create another canvas that will represent the selection
     * Set globals so the canvases can be accessed
     */
    proto.init = function () {
        var options = this.getOptions(),
            self = this;

        // Set the image variable globally
        this.image = options.image;

        // Set the ratio to the output width/height if it's set
        options.ratio = options.ratio ? options.ratio : options.outputWidth / options.outputHeight;

        // Set up and position the base layer canvas
        var baseCanvas = this.createLayer({ name: 'base' });

        baseCanvas.draw = function (layer) {
            // Clear everything on the canvas
            layer.ctx.clearRect(0, 0, layer.ctx.canvas.width, layer.ctx.canvas.height);

            // Draw the image on the canvas
            layer.ctx.drawImage(self.image, 0, 0);

            // Draw a light backdrop on the image
            layer.ctx.fillStyle = options.initialFill;
            layer.ctx.fillRect(0, 0, layer.ctx.canvas.width, layer.ctx.canvas.height);
        };

        // Draw the image on the canvas
        this.draw();

        // Hide the original image
        this.image.style.visibility = 'hidden';
    };

    /**
     * Create a canvas to signify the selection
     * Handle collisions and ratios
     */
    proto.initSelection = function () {
        var options = this.getOptions(),
            self = this;

        // Set up and position the selection layer canvas
        var selectionCanvas = this.createLayer({ name:'selection' });

        // If we're allowing keyboard controls, the canvas needs to be targetable
        if (options.keyboard) {
            selectionCanvas.canvas.setAttribute('tabindex', '1');
            selectionCanvas.canvas.style.outline = 'none';
        }

        selectionCanvas.draw = function (layer, drawParameters) {
            var ratio = options.ratio || drawParameters.ratio;

            // If the selection is larger than the threshold, draw the selection
            if (Math.min(Math.abs(self.cropCoords.width), Math.abs(self.cropCoords.height)) > options.dragThreshold) {

                // Make sure x and y are within the canvas
                if (self.cropCoords.x < 0) { self.cropCoords.x = 0; }
                if (self.cropCoords.y < 0) { self.cropCoords.y = 0; }
                if (self.cropCoords.x > layer.ctx.canvas.width) { self.cropCoords.x = layer.ctx.canvas.width; }
                if (self.cropCoords.y > layer.ctx.canvas.height) { self.cropCoords.y = layer.ctx.canvas.height; }

                // Make sure the width and height are maxed out
                if (Math.abs(self.cropCoords.width) > layer.ctx.canvas.width) {
                    self.cropCoords.width = layer.ctx.canvas.width * (self.cropCoords.width < 0 ? -1 : 1);
                }
                if (Math.abs(self.cropCoords.height) > layer.ctx.canvas.height) {
                    self.cropCoords.height = layer.ctx.canvas.height * (self.cropCoords.height < 0 ? -1 : 1);
                }
                if (self.cropCoords.width < 0 && self.cropCoords.width * -1 > self.cropCoords.x) {
                    self.cropCoords.width = self.cropCoords.x * -1;
                }
                if (self.cropCoords.height < 0 && self.cropCoords.height * -1 > self.cropCoords.y) {
                    self.cropCoords.height = self.cropCoords.y * -1;
                }
                if (self.cropCoords.x + self.cropCoords.width > layer.ctx.canvas.width) {
                    self.cropCoords.x = layer.ctx.canvas.width - self.cropCoords.width;
                }
                if (self.cropCoords.y + self.cropCoords.height > layer.ctx.canvas.height) {
                    self.cropCoords.y = layer.ctx.canvas.height - self.cropCoords.height;
                }

                if (ratio) {
                    var sideLength = Math.min(Math.abs(self.cropCoords.width) / ratio, Math.abs(self.cropCoords.height));

                    self.cropCoords.width = sideLength * (self.cropCoords.width < 0 ? -1 : 1) * ratio;
                    self.cropCoords.height = sideLength * (self.cropCoords.height < 0 ? -1 : 1);
                }

                // Clear everything on the canvas
                layer.ctx.clearRect(0, 0, layer.ctx.canvas.width, layer.ctx.canvas.height);

                // Draw a dark backdrop
                layer.ctx.fillStyle = options.activeFill;
                layer.ctx.fillRect(0, 0, layer.ctx.canvas.width, layer.ctx.canvas.height);

                // Draw the image on the canvas
                layer.ctx.drawImage(
                    self.image, self.cropCoords.x, self.cropCoords.y,
                    self.cropCoords.width, self.cropCoords.height,
                    self.cropCoords.x, self.cropCoords.y,
                    self.cropCoords.width, self.cropCoords.height
                );

                // Draw corner resize handles
                layer.ctx.fillStyle = options.handleFill;
                layer.ctx.fillRect(self.cropCoords.x - (options.handleSize / 2),
                                   self.cropCoords.y - (options.handleSize / 2),
                                   options.handleSize, options.handleSize);
                layer.ctx.fillRect(self.cropCoords.x + self.cropCoords.width - (options.handleSize / 2),
                                   self.cropCoords.y - (options.handleSize / 2),
                                   options.handleSize, options.handleSize);
                layer.ctx.fillRect(self.cropCoords.x - (options.handleSize / 2),
                                   self.cropCoords.y + self.cropCoords.height - (options.handleSize / 2),
                                   options.handleSize, options.handleSize);
                layer.ctx.fillRect(self.cropCoords.x + self.cropCoords.width - (options.handleSize / 2),
                                   self.cropCoords.y + self.cropCoords.height - (options.handleSize / 2),
                                   options.handleSize, options.handleSize);

                // Draw side resize handles if we're not fixing a ratio
                if (!ratio) {
                    layer.ctx.fillRect(self.cropCoords.x + (self.cropCoords.width / 2) - (options.handleSize / 2),
                                       self.cropCoords.y - (options.handleSize / 2),
                                       options.handleSize, options.handleSize);
                    layer.ctx.fillRect(self.cropCoords.x + self.cropCoords.width - (options.handleSize / 2),
                                       self.cropCoords.y + (self.cropCoords.height / 2) - (options.handleSize / 2),
                                       options.handleSize, options.handleSize);
                    layer.ctx.fillRect(self.cropCoords.x + (self.cropCoords.width / 2) - (options.handleSize / 2),
                                       self.cropCoords.y + self.cropCoords.height - (options.handleSize / 2),
                                       options.handleSize, options.handleSize);
                    layer.ctx.fillRect(self.cropCoords.x - (options.handleSize / 2),
                                       self.cropCoords.y + (self.cropCoords.height / 2) - (options.handleSize / 2),
                                       options.handleSize, options.handleSize);
                }
            }

            // If the selection is too small, clear the selection
            else {
                layer.ctx.clearRect(0, 0, layer.ctx.canvas.width, layer.ctx.canvas.height);
            }
        };

        // Finally draw the selection layer
        this.draw('selection');
    };

    /**
     * Initialize mouse and keyboard events
     */
    proto.initEvents = function () {
        var options = this.getOptions(),
            self = this,
            canvas = this.canvas.selection.canvas,
            canvasBox = canvas.getBoundingClientRect(),
            dragCoords = {},
            drawParameters = {},
            currentMouseState, mouseLocation;

        // Allow changing selection position with keyboard
        if (options.keyboard) {
            canvas.addEventListener('keydown', function (e) {
                var stepValue = options.keyboardStep,
                    horizontal = 0,
                    vertical = 0;

                if (e.keyCode >= 37 && e.keyCode <= 40) {

                    // Allow faster movement if shift key is down
                    if (e.shiftKey) {
                        stepValue *= 10;
                    }

                    // Left
                    if (e.keyCode === 37) {
                        horizontal = stepValue * -1;
                    }

                    // Up
                    else if (e.keyCode === 38) {
                        vertical = stepValue * -1;
                    }

                    // Right
                    else if (e.keyCode === 39) {
                        horizontal = stepValue;
                    }

                    // Down
                    else if (e.keyCode === 40) {
                        vertical = stepValue;
                    }

                    self.cropCoords.x += horizontal;
                    self.cropCoords.y += vertical;

                    e.preventDefault();
                    e.stopPropagation();
                }

                // Clear the selection when hitting the Esc key
                else if (e.keyCode === 27) {
                    self.cropCoords.x = 0;
                    self.cropCoords.y = 0;
                    self.cropCoords.width = 0;
                    self.cropCoords.height = 0;

                    e.preventDefault();
                    e.stopPropagation();
                }

                self.draw('selection');
            }, false);
        }

        // handle moving when the mouse is down
        canvas.addEventListener('mousemove', function (e) {
            var canvasX = e.pageX - canvasBox.left,
                canvasY = e.pageY - canvasBox.top;

            if (currentMouseState === 'resizing') {
                self.cropCoords.x = dragCoords.x;
                self.cropCoords.y = dragCoords.y;
            }

            if (currentMouseState === 'resizing' || currentMouseState === 'drawing') {

                if (mouseLocation === 'n-resize' || mouseLocation === 's-resize') {
                    self.cropCoords.height = canvasY - self.cropCoords.y;
                } else if (mouseLocation === 'w-resize' || mouseLocation === 'e-resize') {
                    self.cropCoords.width = canvasX - self.cropCoords.x;
                } else {
                    self.cropCoords.width = canvasX - self.cropCoords.x;
                    self.cropCoords.height = canvasY - self.cropCoords.y;
                }

                // If shift key is held, keep a ratio
                if (e.shiftKey && !drawParameters.ratio) {
                    drawParameters.ratio = Math.abs((canvasX - self.cropCoords.x) / (canvasY - self.cropCoords.y));
                } else if (!e.shiftKey) {
                    drawParameters.ratio = false;
                }
            } else if (currentMouseState === 'dragging') {
                self.cropCoords.x = canvasX - dragCoords.mouseX;
                self.cropCoords.y = canvasY - dragCoords.mouseY;
            }

            if (currentMouseState) {
                // draw the selection box
                self.draw('selection', drawParameters);
            } else {
                // determine where the mouse is in the canvas selection
                if (canvasX > self.cropCoords.x - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + (options.handleSize / 2)) {
                        mouseLocation = 'nw-resize';
                        canvas.style.cursor = 'nwse-resize';
                } else if (canvasX > self.cropCoords.x + self.cropCoords.width - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + self.cropCoords.width + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + (options.handleSize / 2)) {
                        mouseLocation = 'ne-resize';
                        canvas.style.cursor = 'nesw-resize';
                } else if (canvasX > self.cropCoords.x + self.cropCoords.width - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + self.cropCoords.width + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y + self.cropCoords.height - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + self.cropCoords.height + (options.handleSize / 2)) {
                        mouseLocation = 'se-resize';
                        canvas.style.cursor = 'nwse-resize';
                } else if (canvasX > self.cropCoords.x - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y + self.cropCoords.height - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + self.cropCoords.height + (options.handleSize / 2)) {
                        mouseLocation = 'sw-resize';
                        canvas.style.cursor = 'nesw-resize';
                } else if (!options.ratio &&
                    canvasX > self.cropCoords.x + (self.cropCoords.width / 2) - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + (self.cropCoords.width / 2) + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + (options.handleSize / 2)) {
                        mouseLocation = 'n-resize';
                        canvas.style.cursor = 'ns-resize';
                } else if (!options.ratio &&
                    canvasX > self.cropCoords.x + self.cropCoords.width - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + self.cropCoords.width + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y + (self.cropCoords.height / 2) - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + (self.cropCoords.height / 2) + (options.handleSize / 2)) {
                        mouseLocation = 'e-resize';
                        canvas.style.cursor = 'ew-resize';
                } else if (!options.ratio &&
                    canvasX > self.cropCoords.x + (self.cropCoords.width / 2) - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + (self.cropCoords.width / 2) + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y + self.cropCoords.height - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + self.cropCoords.height + (options.handleSize / 2)) {
                        mouseLocation = 's-resize';
                        canvas.style.cursor = 'ns-resize';
                } else if (!options.ratio &&
                    canvasX > self.cropCoords.x - (options.handleSize / 2) &&
                    canvasX < self.cropCoords.x + (options.handleSize / 2) &&
                    canvasY > self.cropCoords.y + (self.cropCoords.height / 2) - (options.handleSize / 2) &&
                    canvasY < self.cropCoords.y + (self.cropCoords.height / 2) + (options.handleSize / 2)) {
                        mouseLocation = 'w-resize';
                        canvas.style.cursor = 'ew-resize';
                } else if (canvasX > self.cropCoords.x &&
                    canvasX < self.cropCoords.x + self.cropCoords.width &&
                    canvasY > self.cropCoords.y &&
                    canvasY < self.cropCoords.y + self.cropCoords.height) {
                        mouseLocation = 'selection';
                        canvas.style.cursor = 'move';
                } else {
                    mouseLocation = '';
                    canvas.style.cursor = 'crosshair';
                }
            }
        }, false);

        // set up event listeners on the canvas
        canvas.addEventListener('mousedown', function (e) {
            var canvasX = e.pageX - canvasBox.left,
                canvasY = e.pageY - canvasBox.top;

            // Check to see if we're resizing
            if (mouseLocation.indexOf('resize') > -1) {
                dragCoords.x = self.cropCoords.x;
                dragCoords.y = self.cropCoords.y;
                dragCoords.height = self.cropCoords.height;
                dragCoords.width = self.cropCoords.width;

                if (mouseLocation === 'nw-resize') {
                    dragCoords.x = self.cropCoords.x + self.cropCoords.width;
                    dragCoords.y = self.cropCoords.y + self.cropCoords.height;
                    dragCoords.height = self.cropCoords.height * -1;
                    dragCoords.width = self.cropCoords.width * -1;
                } else if (mouseLocation === 'ne-resize') {
                    dragCoords.y = self.cropCoords.y + self.cropCoords.height;
                    dragCoords.height = self.cropCoords.height * -1;
                } else if (mouseLocation === 'sw-resize') {
                    dragCoords.x = self.cropCoords.x + self.cropCoords.width;
                    dragCoords.width = self.cropCoords.width * -1;
                } else if (mouseLocation === 'n-resize') {
                    dragCoords.y = self.cropCoords.y + self.cropCoords.height;
                    dragCoords.height = self.cropCoords.height * -1;
                } else if (mouseLocation === 'w-resize') {
                    dragCoords.x = self.cropCoords.x + self.cropCoords.width;
                    dragCoords.width = self.cropCoords.width * -1;
                }

                currentMouseState = 'resizing';
            } else if (mouseLocation === 'selection') {
                // set the starting point for our drag
                dragCoords.x = self.cropCoords.x;
                dragCoords.y = self.cropCoords.y;
                dragCoords.mouseX = canvasX - self.cropCoords.x;
                dragCoords.mouseY = canvasY - self.cropCoords.y;

                currentMouseState = 'dragging';
            } else {
                // set initial top and left coordinates
                self.cropCoords.x = canvasX;
                self.cropCoords.y = canvasY;

                currentMouseState = 'drawing';
            }
        }, false);

        // Handle mouse up / mouse out
        function endMouseMove () {
            // Handle dragging from not the top left
            if (self.cropCoords.width < 0) {
                self.cropCoords.width = Math.abs(self.cropCoords.width);
                self.cropCoords.x -= self.cropCoords.width;
            }
            if (self.cropCoords.height < 0) {
                self.cropCoords.height = Math.abs(self.cropCoords.height);
                self.cropCoords.y -= self.cropCoords.height;
            }
            currentMouseState = false;
        }
        canvas.addEventListener('mouseup', endMouseMove, false);
        canvas.addEventListener('mouseout', endMouseMove, false);
    };

    /**
     * Create the canvas elements and assign them to globals
     *
     * @param {(object|object[])} layer         - Layer name as a string, or an array of strings
     * @param {boolean}           [append=true] - Whether to append the layer to the document
     * @return {object|object[]}                - Object containing the canvas and the context or array of objects
     */
    proto.createLayer = function (layer, append) {

        // Set the canvas object if it isn't set
        if (!this.canvas) {
            this.canvas = {};
        }

        // Set the layer object if it isn't set
        if (!this.canvas[layer.name]) {
            this.canvas[layer.name] = {};
        }

        // Set the default value for append
        if (typeof append === 'undefined') {
            append = true;
        }

        // If layer is an array, then loop through and create all layers
        if (layer instanceof Array) {
            var layers = {};

            for (var i = 0; i < layer.length; i++) {
                layers[layer] = this.createLayer(layer[i]);
            }

            return layers;
        }

        // Set the canvas up for the named layer
        else {
            var imageBox = this.image.getBoundingClientRect();

            // Create the canvas element
            this.canvas[layer.name].canvas = document.createElement('canvas');
            this.canvas[layer.name].ctx    = this.canvas[layer.name].canvas.getContext('2d');

            // Set the canvas to sit in place of the original image
            this.canvas[layer.name].canvas.id             = 'imagecrop-' + layer.name;
            this.canvas[layer.name].canvas.className      = 'imagecrop';
            this.canvas[layer.name].canvas.width          = layer.width || imageBox.width;
            this.canvas[layer.name].canvas.height         = layer.height || imageBox.height;
            this.canvas[layer.name].canvas.style.position = 'absolute';
            this.canvas[layer.name].canvas.style.top      = layer.top || imageBox.top + 'px';
            this.canvas[layer.name].canvas.style.left     = layer.left || imageBox.left + 'px';

            // Function that the draw method will call, make sure to override
            this.canvas[layer.name].draw = function (layer, drawParameters) {};

            // Add the canvas to the body
            if (append) {
                document.body.appendChild(this.canvas[layer.name].canvas);
            }

            return this.canvas[layer.name];
        }
    };

    /**
     * Draw the canvases, if a layer is specified, only draw that layer
     *
     * @param {(string|string[])} [layer] - Layer name as a string, or an array of layers
     * @param {object} [drawParameters]   - Parameters used for drawing
     */
    proto.draw = function (layer, drawParameters) {
        drawParameters = drawParameters || {};

        // If layer is an array, then loop through and draw all layers
        if (layer instanceof Array) {
            for (var i = 0; i < layer.length; i++) {
                this.draw(layer[i], drawParameters);
            }
        }

        // If no layer is specified, draw all layers
        else if (!layer) {
            for (layer in this.canvas) {
                this.draw(layer, drawParameters);
            }
        }

        // Draw the canvas for the named layer
        else {
            this.canvas[layer].draw(this.canvas[layer], drawParameters);
        }
    };

    /**
     * Update the options with the passed parameter(s)
     * If the options global is not set, set it to the default options
     * If the first parameter is an object, pass any new parameters to the options global
     * If the first parameter is a string, update the option using the first parameter as a key
     *
     * @param {(object|string)} prop - Object of options, or string of an option key
     * @param {*} [value]            - Value to set if the first parameter is a string
     */
    proto.set = function (prop, value) {

        // Set the options to the defaults if they aren't currently set
        if (!this._options) {
            this._options = this.helpers.extend({}, this._defaultOptions);
        }

        // if an object is passed as the first parameter, extend the options object with it
        if (typeof prop === 'object') {
            this.helpers.extend(this._options, prop);
        }

        // otherwise assume we were given a property/value and update it
        else if (prop) {
            this._options[prop] = value;
        }
    };

    /**
     * Save the currently visible selection on the canvas
     * If there isn't a selection, save the entire image
     * Ensure that if the output width/height does not coincide with the ratio, that the ratio wins out
     *
     * @return {string} - DataURL of the image in the selection
     */
    proto.save = function () {
        var options = this.getOptions();

        // if width and height aren't set, save the whole image
        if (Math.min(Math.abs(this.cropCoords.height), Math.abs(this.cropCoords.width)) <= options.dragThreshold) {
            return this.canvas.base.canvas.toDataURL(options.imageType, options.imageQuality);
        }

        // If a ratio is set after init, ratio wins over output width/height
        if (options.ratio && options.outputWidth / options.outputHeight !== options.ratio) {
            options.outputWidth = options.outputHeight = false;
        }

        // Create a new temporary canvas, real quick like
        var tmpCanvas = this.createLayer({
            name: 'temp',
            width: options.outputWidth || this.cropCoords.width,
            height: options.outputHeight || this.cropCoords.height,
        }, false);

        // Draw the image
        tmpCanvas.ctx.drawImage(
            this.image, this.cropCoords.x, this.cropCoords.y,
            this.cropCoords.width, this.cropCoords.height,
            0, 0, tmpCanvas.ctx.canvas.width, tmpCanvas.ctx.canvas.height
        );

        return tmpCanvas.canvas.toDataURL(options.imageType, options.imageQuality);
    };

    proto.helpers = {

        // Stolen from underscore, extend an object's properties into another
        extend: function () {
            var source, prop;

            for (var i = 0, length = arguments.length; i < length; i++) {
                source = arguments[i];

                for (prop in source) {
                    if (hasOwnProperty.call(source, prop)) {
                        this[prop] = source[prop];
                    }
                }
            }

            return this;
        },
    };

    // Expose the class via the global object
    this.ImageCrop = ImageCrop;
}.call(this));