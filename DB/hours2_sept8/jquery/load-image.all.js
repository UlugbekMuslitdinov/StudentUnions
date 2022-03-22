(function($) {
    "use strict";
    var urlAPI = $.URL || $.webkitURL;
    function createObjectURL(blob) {
        return urlAPI ? urlAPI.createObjectURL(blob) : false;
    }
    function revokeObjectURL(url) {
        return urlAPI ? urlAPI.revokeObjectURL(url) : false;
    }
    function revokeHelper(url, options) {
        if (url && url.slice(0, 5) === "blob:" && !(options && options.noRevoke)) {
            revokeObjectURL(url);
        }
    }
    function readFile(file, onload, onerror, method) {
        if (!$.FileReader) return false;
        var reader = new FileReader;
        reader.onload = function() {
            onload.call(reader, this.result);
        };
        if (onerror) {
            reader.onabort = reader.onerror = function() {
                onerror.call(reader, this.error);
            };
        }
        var readerMethod = reader[method || "readAsDataURL"];
        if (readerMethod) {
            readerMethod.call(reader, file);
            return reader;
        }
    }
    function isInstanceOf(type, obj) {
        return Object.prototype.toString.call(obj) === "[object " + type + "]";
    }
    function loadImage(file, callback, options) {
        function executor(resolve, reject) {
            var img = document.createElement("img");
            var url;
            function resolveWrapper(img, data) {
                if (resolve === reject) {
                    if (resolve) resolve(img, data);
                    return;
                } else if (img instanceof Error) {
                    reject(img);
                    return;
                }
                data = data || {};
                data.image = img;
                resolve(data);
            }
            function fetchBlobCallback(blob, err) {
                if (err && $.console) console.log(err);
                if (blob && isInstanceOf("Blob", blob)) {
                    file = blob;
                    url = createObjectURL(file);
                } else {
                    url = file;
                    if (options && options.crossOrigin) {
                        img.crossOrigin = options.crossOrigin;
                    }
                }
                img.src = url;
            }
            img.onerror = function(event) {
                revokeHelper(url, options);
                if (reject) reject.call(img, event);
            };
            img.onload = function() {
                revokeHelper(url, options);
                var data = {
                    originalWidth: img.naturalWidth || img.width,
                    originalHeight: img.naturalHeight || img.height
                };
                try {
                    loadImage.transform(img, options, resolveWrapper, file, data);
                } catch (error) {
                    if (reject) reject(error);
                }
            };
            if (typeof file === "string") {
                if (loadImage.requiresMetaData(options)) {
                    loadImage.fetchBlob(file, fetchBlobCallback, options);
                } else {
                    fetchBlobCallback();
                }
                return img;
            } else if (isInstanceOf("Blob", file) || isInstanceOf("File", file)) {
                url = createObjectURL(file);
                if (url) {
                    img.src = url;
                    return img;
                }
                return readFile(file, (function(url) {
                    img.src = url;
                }), reject);
            }
        }
        if ($.Promise && typeof callback !== "function") {
            options = callback;
            return new Promise(executor);
        }
        return executor(callback, callback);
    }
    loadImage.requiresMetaData = function(options) {
        return options && options.meta;
    };
    loadImage.fetchBlob = function(url, callback) {
        callback();
    };
    loadImage.transform = function(img, options, callback, file, data) {
        callback(img, data);
    };
    loadImage.global = $;
    loadImage.readFile = readFile;
    loadImage.isInstanceOf = isInstanceOf;
    loadImage.createObjectURL = createObjectURL;
    loadImage.revokeObjectURL = revokeObjectURL;
    if (typeof define === "function" && define.amd) {
        define((function() {
            return loadImage;
        }));
    } else if (typeof module === "object" && module.exports) {
        module.exports = loadImage;
    } else {
        $.loadImage = loadImage;
    }
})(typeof window !== "undefined" && window || this);

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    var originalTransform = loadImage.transform;
    loadImage.createCanvas = function(width, height, offscreen) {
        if (offscreen && loadImage.global.OffscreenCanvas) {
            return new OffscreenCanvas(width, height);
        }
        var canvas = document.createElement("canvas");
        canvas.width = width;
        canvas.height = height;
        return canvas;
    };
    loadImage.transform = function(img, options, callback, file, data) {
        originalTransform.call(loadImage, loadImage.scale(img, options, data), options, callback, file, data);
    };
    loadImage.transformCoordinates = function() {};
    loadImage.getTransformedOptions = function(img, options) {
        var aspectRatio = options.aspectRatio;
        var newOptions;
        var i;
        var width;
        var height;
        if (!aspectRatio) {
            return options;
        }
        newOptions = {};
        for (i in options) {
            if (Object.prototype.hasOwnProperty.call(options, i)) {
                newOptions[i] = options[i];
            }
        }
        newOptions.crop = true;
        width = img.naturalWidth || img.width;
        height = img.naturalHeight || img.height;
        if (width / height > aspectRatio) {
            newOptions.maxWidth = height * aspectRatio;
            newOptions.maxHeight = height;
        } else {
            newOptions.maxWidth = width;
            newOptions.maxHeight = width / aspectRatio;
        }
        return newOptions;
    };
    loadImage.drawImage = function(img, canvas, sourceX, sourceY, sourceWidth, sourceHeight, destWidth, destHeight, options) {
        var ctx = canvas.getContext("2d");
        if (options.imageSmoothingEnabled === false) {
            ctx.msImageSmoothingEnabled = false;
            ctx.imageSmoothingEnabled = false;
        } else if (options.imageSmoothingQuality) {
            ctx.imageSmoothingQuality = options.imageSmoothingQuality;
        }
        ctx.drawImage(img, sourceX, sourceY, sourceWidth, sourceHeight, 0, 0, destWidth, destHeight);
        return ctx;
    };
    loadImage.requiresCanvas = function(options) {
        return options.canvas || options.crop || !!options.aspectRatio;
    };
    loadImage.scale = function(img, options, data) {
        options = options || {};
        data = data || {};
        var useCanvas = img.getContext || loadImage.requiresCanvas(options) && !!loadImage.global.HTMLCanvasElement;
        var width = img.naturalWidth || img.width;
        var height = img.naturalHeight || img.height;
        var destWidth = width;
        var destHeight = height;
        var maxWidth;
        var maxHeight;
        var minWidth;
        var minHeight;
        var sourceWidth;
        var sourceHeight;
        var sourceX;
        var sourceY;
        var pixelRatio;
        var downsamplingRatio;
        var tmp;
        var canvas;
        function scaleUp() {
            var scale = Math.max((minWidth || destWidth) / destWidth, (minHeight || destHeight) / destHeight);
            if (scale > 1) {
                destWidth *= scale;
                destHeight *= scale;
            }
        }
        function scaleDown() {
            var scale = Math.min((maxWidth || destWidth) / destWidth, (maxHeight || destHeight) / destHeight);
            if (scale < 1) {
                destWidth *= scale;
                destHeight *= scale;
            }
        }
        if (useCanvas) {
            options = loadImage.getTransformedOptions(img, options, data);
            sourceX = options.left || 0;
            sourceY = options.top || 0;
            if (options.sourceWidth) {
                sourceWidth = options.sourceWidth;
                if (options.right !== undefined && options.left === undefined) {
                    sourceX = width - sourceWidth - options.right;
                }
            } else {
                sourceWidth = width - sourceX - (options.right || 0);
            }
            if (options.sourceHeight) {
                sourceHeight = options.sourceHeight;
                if (options.bottom !== undefined && options.top === undefined) {
                    sourceY = height - sourceHeight - options.bottom;
                }
            } else {
                sourceHeight = height - sourceY - (options.bottom || 0);
            }
            destWidth = sourceWidth;
            destHeight = sourceHeight;
        }
        maxWidth = options.maxWidth;
        maxHeight = options.maxHeight;
        minWidth = options.minWidth;
        minHeight = options.minHeight;
        if (useCanvas && maxWidth && maxHeight && options.crop) {
            destWidth = maxWidth;
            destHeight = maxHeight;
            tmp = sourceWidth / sourceHeight - maxWidth / maxHeight;
            if (tmp < 0) {
                sourceHeight = maxHeight * sourceWidth / maxWidth;
                if (options.top === undefined && options.bottom === undefined) {
                    sourceY = (height - sourceHeight) / 2;
                }
            } else if (tmp > 0) {
                sourceWidth = maxWidth * sourceHeight / maxHeight;
                if (options.left === undefined && options.right === undefined) {
                    sourceX = (width - sourceWidth) / 2;
                }
            }
        } else {
            if (options.contain || options.cover) {
                minWidth = maxWidth = maxWidth || minWidth;
                minHeight = maxHeight = maxHeight || minHeight;
            }
            if (options.cover) {
                scaleDown();
                scaleUp();
            } else {
                scaleUp();
                scaleDown();
            }
        }
        if (useCanvas) {
            pixelRatio = options.pixelRatio;
            if (pixelRatio > 1 && !(img.style.width && Math.floor(parseFloat(img.style.width, 10)) === Math.floor(width / pixelRatio))) {
                destWidth *= pixelRatio;
                destHeight *= pixelRatio;
            }
            if (loadImage.orientationCropBug && !img.getContext && (sourceX || sourceY || sourceWidth !== width || sourceHeight !== height)) {
                tmp = img;
                img = loadImage.createCanvas(width, height, true);
                loadImage.drawImage(tmp, img, 0, 0, width, height, width, height, options);
            }
            downsamplingRatio = options.downsamplingRatio;
            if (downsamplingRatio > 0 && downsamplingRatio < 1 && destWidth < sourceWidth && destHeight < sourceHeight) {
                while (sourceWidth * downsamplingRatio > destWidth) {
                    canvas = loadImage.createCanvas(sourceWidth * downsamplingRatio, sourceHeight * downsamplingRatio, true);
                    loadImage.drawImage(img, canvas, sourceX, sourceY, sourceWidth, sourceHeight, canvas.width, canvas.height, options);
                    sourceX = 0;
                    sourceY = 0;
                    sourceWidth = canvas.width;
                    sourceHeight = canvas.height;
                    img = canvas;
                }
            }
            canvas = loadImage.createCanvas(destWidth, destHeight);
            loadImage.transformCoordinates(canvas, options, data);
            if (pixelRatio > 1) {
                canvas.style.width = canvas.width / pixelRatio + "px";
            }
            loadImage.drawImage(img, canvas, sourceX, sourceY, sourceWidth, sourceHeight, destWidth, destHeight, options).setTransform(1, 0, 0, 1, 0, 0);
            return canvas;
        }
        img.width = destWidth;
        img.height = destHeight;
        return img;
    };
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    var global = loadImage.global;
    var originalTransform = loadImage.transform;
    var blobSlice = global.Blob && (Blob.prototype.slice || Blob.prototype.webkitSlice || Blob.prototype.mozSlice);
    var bufferSlice = global.ArrayBuffer && ArrayBuffer.prototype.slice || function(begin, end) {
        end = end || this.byteLength - begin;
        var arr1 = new Uint8Array(this, begin, end);
        var arr2 = new Uint8Array(end);
        arr2.set(arr1);
        return arr2.buffer;
    };
    var metaDataParsers = {
        jpeg: {
            65505: [],
            65517: []
        }
    };
    function parseMetaData(file, callback, options, data) {
        var that = this;
        function executor(resolve, reject) {
            if (!(global.DataView && blobSlice && file && file.size >= 12 && file.type === "image/jpeg")) {
                return resolve(data);
            }
            var maxMetaDataSize = options.maxMetaDataSize || 262144;
            if (!loadImage.readFile(blobSlice.call(file, 0, maxMetaDataSize), (function(buffer) {
                var dataView = new DataView(buffer);
                if (dataView.getUint16(0) !== 65496) {
                    return reject(new Error("Invalid JPEG file: Missing JPEG marker."));
                }
                var offset = 2;
                var maxOffset = dataView.byteLength - 4;
                var headLength = offset;
                var markerBytes;
                var markerLength;
                var parsers;
                var i;
                while (offset < maxOffset) {
                    markerBytes = dataView.getUint16(offset);
                    if (markerBytes >= 65504 && markerBytes <= 65519 || markerBytes === 65534) {
                        markerLength = dataView.getUint16(offset + 2) + 2;
                        if (offset + markerLength > dataView.byteLength) {
                            console.log("Invalid JPEG metadata: Invalid segment size.");
                            break;
                        }
                        parsers = metaDataParsers.jpeg[markerBytes];
                        if (parsers && !options.disableMetaDataParsers) {
                            for (i = 0; i < parsers.length; i += 1) {
                                parsers[i].call(that, dataView, offset, markerLength, data, options);
                            }
                        }
                        offset += markerLength;
                        headLength = offset;
                    } else {
                        break;
                    }
                }
                if (!options.disableImageHead && headLength > 6) {
                    data.imageHead = bufferSlice.call(buffer, 0, headLength);
                }
                resolve(data);
            }), reject, "readAsArrayBuffer")) {
                resolve(data);
            }
        }
        options = options || {};
        if (global.Promise && typeof callback !== "function") {
            options = callback || {};
            data = options;
            return new Promise(executor);
        }
        data = data || {};
        return executor(callback, callback);
    }
    function replaceJPEGHead(blob, oldHead, newHead) {
        if (!blob || !oldHead || !newHead) return null;
        return new Blob([ newHead, blobSlice.call(blob, oldHead.byteLength) ], {
            type: "image/jpeg"
        });
    }
    function replaceHead(blob, head, callback) {
        var options = {
            maxMetaDataSize: 256,
            disableMetaDataParsers: true
        };
        if (!callback && global.Promise) {
            return parseMetaData(blob, options).then((function(data) {
                return replaceJPEGHead(blob, data.imageHead, head);
            }));
        }
        parseMetaData(blob, (function(data) {
            callback(replaceJPEGHead(blob, data.imageHead, head));
        }), options);
    }
    loadImage.transform = function(img, options, callback, file, data) {
        if (loadImage.requiresMetaData(options)) {
            data = data || {};
            parseMetaData(file, (function(result) {
                if (result !== data) {
                    if (global.console) console.log(result);
                    result = data;
                }
                originalTransform.call(loadImage, img, options, callback, file, result);
            }), options, data);
        } else {
            originalTransform.apply(loadImage, arguments);
        }
    };
    loadImage.blobSlice = blobSlice;
    loadImage.bufferSlice = bufferSlice;
    loadImage.replaceHead = replaceHead;
    loadImage.parseMetaData = parseMetaData;
    loadImage.metaDataParsers = metaDataParsers;
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    var global = loadImage.global;
    if (global.fetch && global.Request && global.Response && global.Response.prototype.blob) {
        loadImage.fetchBlob = function(url, callback, options) {
            function responseHandler(response) {
                return response.blob();
            }
            if (global.Promise && typeof callback !== "function") {
                return fetch(new Request(url, callback)).then(responseHandler);
            }
            fetch(new Request(url, options)).then(responseHandler).then(callback)["catch"]((function(err) {
                callback(null, err);
            }));
        };
    } else if (global.XMLHttpRequest && (new XMLHttpRequest).responseType === "") {
        loadImage.fetchBlob = function(url, callback, options) {
            function executor(resolve, reject) {
                options = options || {};
                var req = new XMLHttpRequest;
                req.open(options.method || "GET", url);
                if (options.headers) {
                    Object.keys(options.headers).forEach((function(key) {
                        req.setRequestHeader(key, options.headers[key]);
                    }));
                }
                req.withCredentials = options.credentials === "include";
                req.responseType = "blob";
                req.onload = function() {
                    resolve(req.response);
                };
                req.onerror = req.onabort = req.ontimeout = function(err) {
                    if (resolve === reject) {
                        reject(null, err);
                    } else {
                        reject(err);
                    }
                };
                req.send(options.body);
            }
            if (global.Promise && typeof callback !== "function") {
                options = callback;
                return new Promise(executor);
            }
            return executor(callback, callback);
        };
    }
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image", "./load-image-scale", "./load-image-meta" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"), require("./load-image-scale"), require("./load-image-meta"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    var originalTransform = loadImage.transform;
    var originalRequiresCanvas = loadImage.requiresCanvas;
    var originalRequiresMetaData = loadImage.requiresMetaData;
    var originalTransformCoordinates = loadImage.transformCoordinates;
    var originalGetTransformedOptions = loadImage.getTransformedOptions;
    (function($) {
        if (!$.global.document) return;
        var testImageURL = "data:image/jpeg;base64,/9j/4QAiRXhpZgAATU0AKgAAAAgAAQESAAMAAAABAAYAAAA" + "AAAD/2wCEAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBA" + "QEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQE" + "BAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/AABEIAAIAAwMBEQACEQEDEQH/x" + "ABRAAEAAAAAAAAAAAAAAAAAAAAKEAEBAQADAQEAAAAAAAAAAAAGBQQDCAkCBwEBAAAAAAA" + "AAAAAAAAAAAAAABEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AG8T9NfSMEVMhQ" + "voP3fFiRZ+MTHDifa/95OFSZU5OzRzxkyejv8ciEfhSceSXGjS8eSdLnZc2HDm4M3BxcXw" + "H/9k=";
        var img = document.createElement("img");
        img.onload = function() {
            $.orientation = img.width === 2 && img.height === 3;
            if ($.orientation) {
                var canvas = $.createCanvas(1, 1, true);
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 1, 1, 1, 1, 0, 0, 1, 1);
                $.orientationCropBug = ctx.getImageData(0, 0, 1, 1).data.toString() !== "255,255,255,255";
            }
        };
        img.src = testImageURL;
    })(loadImage);
    function requiresCanvasOrientation(options, withMetaData) {
        var orientation = options && options.orientation;
        return orientation === true && !loadImage.orientation || orientation === 1 && loadImage.orientation || (!withMetaData || loadImage.orientation) && orientation > 1 && orientation < 9;
    }
    function requiresOrientationChange(orientation, autoOrientation) {
        return orientation !== autoOrientation && (orientation === 1 && autoOrientation > 1 && autoOrientation < 9 || orientation > 1 && orientation < 9);
    }
    function requiresRot180(orientation, autoOrientation) {
        if (autoOrientation > 1 && autoOrientation < 9) {
            switch (orientation) {
              case 2:
              case 4:
                return autoOrientation > 4;

              case 5:
              case 7:
                return autoOrientation % 2 === 0;

              case 6:
              case 8:
                return autoOrientation === 2 || autoOrientation === 4 || autoOrientation === 5 || autoOrientation === 7;
            }
        }
        return false;
    }
    loadImage.requiresCanvas = function(options) {
        return requiresCanvasOrientation(options) || originalRequiresCanvas.call(loadImage, options);
    };
    loadImage.requiresMetaData = function(options) {
        return requiresCanvasOrientation(options, true) || originalRequiresMetaData.call(loadImage, options);
    };
    loadImage.transform = function(img, options, callback, file, data) {
        originalTransform.call(loadImage, img, options, (function(img, data) {
            if (data) {
                var autoOrientation = loadImage.orientation && data.exif && data.exif.get("Orientation");
                if (autoOrientation > 4 && autoOrientation < 9) {
                    var originalWidth = data.originalWidth;
                    var originalHeight = data.originalHeight;
                    data.originalWidth = originalHeight;
                    data.originalHeight = originalWidth;
                }
            }
            callback(img, data);
        }), file, data);
    };
    loadImage.getTransformedOptions = function(img, opts, data) {
        var options = originalGetTransformedOptions.call(loadImage, img, opts);
        var exifOrientation = data.exif && data.exif.get("Orientation");
        var orientation = options.orientation;
        var autoOrientation = loadImage.orientation && exifOrientation;
        if (orientation === true) orientation = exifOrientation;
        if (!requiresOrientationChange(orientation, autoOrientation)) {
            return options;
        }
        var top = options.top;
        var right = options.right;
        var bottom = options.bottom;
        var left = options.left;
        var newOptions = {};
        for (var i in options) {
            if (Object.prototype.hasOwnProperty.call(options, i)) {
                newOptions[i] = options[i];
            }
        }
        newOptions.orientation = orientation;
        if (orientation > 4 && !(autoOrientation > 4) || orientation < 5 && autoOrientation > 4) {
            newOptions.maxWidth = options.maxHeight;
            newOptions.maxHeight = options.maxWidth;
            newOptions.minWidth = options.minHeight;
            newOptions.minHeight = options.minWidth;
            newOptions.sourceWidth = options.sourceHeight;
            newOptions.sourceHeight = options.sourceWidth;
        }
        if (autoOrientation > 1) {
            switch (autoOrientation) {
              case 2:
                right = options.left;
                left = options.right;
                break;

              case 3:
                top = options.bottom;
                right = options.left;
                bottom = options.top;
                left = options.right;
                break;

              case 4:
                top = options.bottom;
                bottom = options.top;
                break;

              case 5:
                top = options.left;
                right = options.bottom;
                bottom = options.right;
                left = options.top;
                break;

              case 6:
                top = options.left;
                right = options.top;
                bottom = options.right;
                left = options.bottom;
                break;

              case 7:
                top = options.right;
                right = options.top;
                bottom = options.left;
                left = options.bottom;
                break;

              case 8:
                top = options.right;
                right = options.bottom;
                bottom = options.left;
                left = options.top;
                break;
            }
            if (requiresRot180(orientation, autoOrientation)) {
                var tmpTop = top;
                var tmpRight = right;
                top = bottom;
                right = left;
                bottom = tmpTop;
                left = tmpRight;
            }
        }
        newOptions.top = top;
        newOptions.right = right;
        newOptions.bottom = bottom;
        newOptions.left = left;
        switch (orientation) {
          case 2:
            newOptions.right = left;
            newOptions.left = right;
            break;

          case 3:
            newOptions.top = bottom;
            newOptions.right = left;
            newOptions.bottom = top;
            newOptions.left = right;
            break;

          case 4:
            newOptions.top = bottom;
            newOptions.bottom = top;
            break;

          case 5:
            newOptions.top = left;
            newOptions.right = bottom;
            newOptions.bottom = right;
            newOptions.left = top;
            break;

          case 6:
            newOptions.top = right;
            newOptions.right = bottom;
            newOptions.bottom = left;
            newOptions.left = top;
            break;

          case 7:
            newOptions.top = right;
            newOptions.right = top;
            newOptions.bottom = left;
            newOptions.left = bottom;
            break;

          case 8:
            newOptions.top = left;
            newOptions.right = top;
            newOptions.bottom = right;
            newOptions.left = bottom;
            break;
        }
        return newOptions;
    };
    loadImage.transformCoordinates = function(canvas, options, data) {
        originalTransformCoordinates.call(loadImage, canvas, options, data);
        var orientation = options.orientation;
        var autoOrientation = loadImage.orientation && data.exif && data.exif.get("Orientation");
        if (!requiresOrientationChange(orientation, autoOrientation)) {
            return;
        }
        var ctx = canvas.getContext("2d");
        var width = canvas.width;
        var height = canvas.height;
        var sourceWidth = width;
        var sourceHeight = height;
        if (orientation > 4 && !(autoOrientation > 4) || orientation < 5 && autoOrientation > 4) {
            canvas.width = height;
            canvas.height = width;
        }
        if (orientation > 4) {
            sourceWidth = height;
            sourceHeight = width;
        }
        switch (autoOrientation) {
          case 2:
            ctx.translate(sourceWidth, 0);
            ctx.scale(-1, 1);
            break;

          case 3:
            ctx.translate(sourceWidth, sourceHeight);
            ctx.rotate(Math.PI);
            break;

          case 4:
            ctx.translate(0, sourceHeight);
            ctx.scale(1, -1);
            break;

          case 5:
            ctx.rotate(-.5 * Math.PI);
            ctx.scale(-1, 1);
            break;

          case 6:
            ctx.rotate(-.5 * Math.PI);
            ctx.translate(-sourceWidth, 0);
            break;

          case 7:
            ctx.rotate(-.5 * Math.PI);
            ctx.translate(-sourceWidth, sourceHeight);
            ctx.scale(1, -1);
            break;

          case 8:
            ctx.rotate(.5 * Math.PI);
            ctx.translate(0, -sourceHeight);
            break;
        }
        if (requiresRot180(orientation, autoOrientation)) {
            ctx.translate(sourceWidth, sourceHeight);
            ctx.rotate(Math.PI);
        }
        switch (orientation) {
          case 2:
            ctx.translate(width, 0);
            ctx.scale(-1, 1);
            break;

          case 3:
            ctx.translate(width, height);
            ctx.rotate(Math.PI);
            break;

          case 4:
            ctx.translate(0, height);
            ctx.scale(1, -1);
            break;

          case 5:
            ctx.rotate(.5 * Math.PI);
            ctx.scale(1, -1);
            break;

          case 6:
            ctx.rotate(.5 * Math.PI);
            ctx.translate(0, -height);
            break;

          case 7:
            ctx.rotate(.5 * Math.PI);
            ctx.translate(width, -height);
            ctx.scale(-1, 1);
            break;

          case 8:
            ctx.rotate(-.5 * Math.PI);
            ctx.translate(-width, 0);
            break;
        }
    };
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image", "./load-image-meta" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"), require("./load-image-meta"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    function ExifMap(tagCode) {
        if (tagCode) {
            Object.defineProperty(this, "map", {
                value: this.ifds[tagCode].map
            });
            Object.defineProperty(this, "tags", {
                value: this.tags && this.tags[tagCode] || {}
            });
        }
    }
    ExifMap.prototype.map = {
        Orientation: 274,
        Thumbnail: "ifd1",
        Blob: 513,
        Exif: 34665,
        GPSInfo: 34853,
        Interoperability: 40965
    };
    ExifMap.prototype.ifds = {
        ifd1: {
            name: "Thumbnail",
            map: ExifMap.prototype.map
        },
        34665: {
            name: "Exif",
            map: {}
        },
        34853: {
            name: "GPSInfo",
            map: {}
        },
        40965: {
            name: "Interoperability",
            map: {}
        }
    };
    ExifMap.prototype.get = function(id) {
        return this[id] || this[this.map[id]];
    };
    function getExifThumbnail(dataView, offset, length) {
        if (!length) return;
        if (offset + length > dataView.byteLength) {
            console.log("Invalid Exif data: Invalid thumbnail data.");
            return;
        }
        return new Blob([ loadImage.bufferSlice.call(dataView.buffer, offset, offset + length) ], {
            type: "image/jpeg"
        });
    }
    var ExifTagTypes = {
        1: {
            getValue: function(dataView, dataOffset) {
                return dataView.getUint8(dataOffset);
            },
            size: 1
        },
        2: {
            getValue: function(dataView, dataOffset) {
                return String.fromCharCode(dataView.getUint8(dataOffset));
            },
            size: 1,
            ascii: true
        },
        3: {
            getValue: function(dataView, dataOffset, littleEndian) {
                return dataView.getUint16(dataOffset, littleEndian);
            },
            size: 2
        },
        4: {
            getValue: function(dataView, dataOffset, littleEndian) {
                return dataView.getUint32(dataOffset, littleEndian);
            },
            size: 4
        },
        5: {
            getValue: function(dataView, dataOffset, littleEndian) {
                return dataView.getUint32(dataOffset, littleEndian) / dataView.getUint32(dataOffset + 4, littleEndian);
            },
            size: 8
        },
        9: {
            getValue: function(dataView, dataOffset, littleEndian) {
                return dataView.getInt32(dataOffset, littleEndian);
            },
            size: 4
        },
        10: {
            getValue: function(dataView, dataOffset, littleEndian) {
                return dataView.getInt32(dataOffset, littleEndian) / dataView.getInt32(dataOffset + 4, littleEndian);
            },
            size: 8
        }
    };
    ExifTagTypes[7] = ExifTagTypes[1];
    function getExifValue(dataView, tiffOffset, offset, type, length, littleEndian) {
        var tagType = ExifTagTypes[type];
        var tagSize;
        var dataOffset;
        var values;
        var i;
        var str;
        var c;
        if (!tagType) {
            console.log("Invalid Exif data: Invalid tag type.");
            return;
        }
        tagSize = tagType.size * length;
        dataOffset = tagSize > 4 ? tiffOffset + dataView.getUint32(offset + 8, littleEndian) : offset + 8;
        if (dataOffset + tagSize > dataView.byteLength) {
            console.log("Invalid Exif data: Invalid data offset.");
            return;
        }
        if (length === 1) {
            return tagType.getValue(dataView, dataOffset, littleEndian);
        }
        values = [];
        for (i = 0; i < length; i += 1) {
            values[i] = tagType.getValue(dataView, dataOffset + i * tagType.size, littleEndian);
        }
        if (tagType.ascii) {
            str = "";
            for (i = 0; i < values.length; i += 1) {
                c = values[i];
                if (c === "\0") {
                    break;
                }
                str += c;
            }
            return str;
        }
        return values;
    }
    function shouldIncludeTag(includeTags, excludeTags, tagCode) {
        return (!includeTags || includeTags[tagCode]) && (!excludeTags || excludeTags[tagCode] !== true);
    }
    function parseExifTags(dataView, tiffOffset, dirOffset, littleEndian, tags, tagOffsets, includeTags, excludeTags) {
        var tagsNumber, dirEndOffset, i, tagOffset, tagNumber, tagValue;
        if (dirOffset + 6 > dataView.byteLength) {
            console.log("Invalid Exif data: Invalid directory offset.");
            return;
        }
        tagsNumber = dataView.getUint16(dirOffset, littleEndian);
        dirEndOffset = dirOffset + 2 + 12 * tagsNumber;
        if (dirEndOffset + 4 > dataView.byteLength) {
            console.log("Invalid Exif data: Invalid directory size.");
            return;
        }
        for (i = 0; i < tagsNumber; i += 1) {
            tagOffset = dirOffset + 2 + 12 * i;
            tagNumber = dataView.getUint16(tagOffset, littleEndian);
            if (!shouldIncludeTag(includeTags, excludeTags, tagNumber)) continue;
            tagValue = getExifValue(dataView, tiffOffset, tagOffset, dataView.getUint16(tagOffset + 2, littleEndian), dataView.getUint32(tagOffset + 4, littleEndian), littleEndian);
            tags[tagNumber] = tagValue;
            if (tagOffsets) {
                tagOffsets[tagNumber] = tagOffset;
            }
        }
        return dataView.getUint32(dirEndOffset, littleEndian);
    }
    function parseExifIFD(data, tagCode, dataView, tiffOffset, littleEndian, includeTags, excludeTags) {
        var dirOffset = data.exif[tagCode];
        if (dirOffset) {
            data.exif[tagCode] = new ExifMap(tagCode);
            if (data.exifOffsets) {
                data.exifOffsets[tagCode] = new ExifMap(tagCode);
            }
            parseExifTags(dataView, tiffOffset, tiffOffset + dirOffset, littleEndian, data.exif[tagCode], data.exifOffsets && data.exifOffsets[tagCode], includeTags && includeTags[tagCode], excludeTags && excludeTags[tagCode]);
        }
    }
    loadImage.parseExifData = function(dataView, offset, length, data, options) {
        if (options.disableExif) {
            return;
        }
        var includeTags = options.includeExifTags;
        var excludeTags = options.excludeExifTags || {
            34665: {
                37500: true
            }
        };
        var tiffOffset = offset + 10;
        var littleEndian;
        var dirOffset;
        var thumbnailIFD;
        if (dataView.getUint32(offset + 4) !== 1165519206) {
            return;
        }
        if (tiffOffset + 8 > dataView.byteLength) {
            console.log("Invalid Exif data: Invalid segment size.");
            return;
        }
        if (dataView.getUint16(offset + 8) !== 0) {
            console.log("Invalid Exif data: Missing byte alignment offset.");
            return;
        }
        switch (dataView.getUint16(tiffOffset)) {
          case 18761:
            littleEndian = true;
            break;

          case 19789:
            littleEndian = false;
            break;

          default:
            console.log("Invalid Exif data: Invalid byte alignment marker.");
            return;
        }
        if (dataView.getUint16(tiffOffset + 2, littleEndian) !== 42) {
            console.log("Invalid Exif data: Missing TIFF marker.");
            return;
        }
        dirOffset = dataView.getUint32(tiffOffset + 4, littleEndian);
        data.exif = new ExifMap;
        if (!options.disableExifOffsets) {
            data.exifOffsets = new ExifMap;
            data.exifTiffOffset = tiffOffset;
            data.exifLittleEndian = littleEndian;
        }
        dirOffset = parseExifTags(dataView, tiffOffset, tiffOffset + dirOffset, littleEndian, data.exif, data.exifOffsets, includeTags, excludeTags);
        if (dirOffset && shouldIncludeTag(includeTags, excludeTags, "ifd1")) {
            data.exif.ifd1 = dirOffset;
            if (data.exifOffsets) {
                data.exifOffsets.ifd1 = tiffOffset + dirOffset;
            }
        }
        Object.keys(data.exif.ifds).forEach((function(tagCode) {
            parseExifIFD(data, tagCode, dataView, tiffOffset, littleEndian, includeTags, excludeTags);
        }));
        thumbnailIFD = data.exif.ifd1;
        if (thumbnailIFD && thumbnailIFD[513]) {
            thumbnailIFD[513] = getExifThumbnail(dataView, tiffOffset + thumbnailIFD[513], thumbnailIFD[514]);
        }
    };
    loadImage.metaDataParsers.jpeg[65505].push(loadImage.parseExifData);
    loadImage.exifWriters = {
        274: function(buffer, data, value) {
            var orientationOffset = data.exifOffsets[274];
            if (!orientationOffset) return buffer;
            var view = new DataView(buffer, orientationOffset + 8, 2);
            view.setUint16(0, value, data.exifLittleEndian);
            return buffer;
        }
    };
    loadImage.writeExifData = function(buffer, data, id, value) {
        return loadImage.exifWriters[data.exif.map[id]](buffer, data, value);
    };
    loadImage.ExifMap = ExifMap;
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image", "./load-image-exif" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"), require("./load-image-exif"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    var ExifMapProto = loadImage.ExifMap.prototype;
    ExifMapProto.tags = {
        256: "ImageWidth",
        257: "ImageHeight",
        258: "BitsPerSample",
        259: "Compression",
        262: "PhotometricInterpretation",
        274: "Orientation",
        277: "SamplesPerPixel",
        284: "PlanarConfiguration",
        530: "YCbCrSubSampling",
        531: "YCbCrPositioning",
        282: "XResolution",
        283: "YResolution",
        296: "ResolutionUnit",
        273: "StripOffsets",
        278: "RowsPerStrip",
        279: "StripByteCounts",
        513: "JPEGInterchangeFormat",
        514: "JPEGInterchangeFormatLength",
        301: "TransferFunction",
        318: "WhitePoint",
        319: "PrimaryChromaticities",
        529: "YCbCrCoefficients",
        532: "ReferenceBlackWhite",
        306: "DateTime",
        270: "ImageDescription",
        271: "Make",
        272: "Model",
        305: "Software",
        315: "Artist",
        33432: "Copyright",
        34665: {
            36864: "ExifVersion",
            40960: "FlashpixVersion",
            40961: "ColorSpace",
            40962: "PixelXDimension",
            40963: "PixelYDimension",
            42240: "Gamma",
            37121: "ComponentsConfiguration",
            37122: "CompressedBitsPerPixel",
            37500: "MakerNote",
            37510: "UserComment",
            40964: "RelatedSoundFile",
            36867: "DateTimeOriginal",
            36868: "DateTimeDigitized",
            36880: "OffsetTime",
            36881: "OffsetTimeOriginal",
            36882: "OffsetTimeDigitized",
            37520: "SubSecTime",
            37521: "SubSecTimeOriginal",
            37522: "SubSecTimeDigitized",
            33434: "ExposureTime",
            33437: "FNumber",
            34850: "ExposureProgram",
            34852: "SpectralSensitivity",
            34855: "PhotographicSensitivity",
            34856: "OECF",
            34864: "SensitivityType",
            34865: "StandardOutputSensitivity",
            34866: "RecommendedExposureIndex",
            34867: "ISOSpeed",
            34868: "ISOSpeedLatitudeyyy",
            34869: "ISOSpeedLatitudezzz",
            37377: "ShutterSpeedValue",
            37378: "ApertureValue",
            37379: "BrightnessValue",
            37380: "ExposureBias",
            37381: "MaxApertureValue",
            37382: "SubjectDistance",
            37383: "MeteringMode",
            37384: "LightSource",
            37385: "Flash",
            37396: "SubjectArea",
            37386: "FocalLength",
            41483: "FlashEnergy",
            41484: "SpatialFrequencyResponse",
            41486: "FocalPlaneXResolution",
            41487: "FocalPlaneYResolution",
            41488: "FocalPlaneResolutionUnit",
            41492: "SubjectLocation",
            41493: "ExposureIndex",
            41495: "SensingMethod",
            41728: "FileSource",
            41729: "SceneType",
            41730: "CFAPattern",
            41985: "CustomRendered",
            41986: "ExposureMode",
            41987: "WhiteBalance",
            41988: "DigitalZoomRatio",
            41989: "FocalLengthIn35mmFilm",
            41990: "SceneCaptureType",
            41991: "GainControl",
            41992: "Contrast",
            41993: "Saturation",
            41994: "Sharpness",
            41995: "DeviceSettingDescription",
            41996: "SubjectDistanceRange",
            42016: "ImageUniqueID",
            42032: "CameraOwnerName",
            42033: "BodySerialNumber",
            42034: "LensSpecification",
            42035: "LensMake",
            42036: "LensModel",
            42037: "LensSerialNumber"
        },
        34853: {
            0: "GPSVersionID",
            1: "GPSLatitudeRef",
            2: "GPSLatitude",
            3: "GPSLongitudeRef",
            4: "GPSLongitude",
            5: "GPSAltitudeRef",
            6: "GPSAltitude",
            7: "GPSTimeStamp",
            8: "GPSSatellites",
            9: "GPSStatus",
            10: "GPSMeasureMode",
            11: "GPSDOP",
            12: "GPSSpeedRef",
            13: "GPSSpeed",
            14: "GPSTrackRef",
            15: "GPSTrack",
            16: "GPSImgDirectionRef",
            17: "GPSImgDirection",
            18: "GPSMapDatum",
            19: "GPSDestLatitudeRef",
            20: "GPSDestLatitude",
            21: "GPSDestLongitudeRef",
            22: "GPSDestLongitude",
            23: "GPSDestBearingRef",
            24: "GPSDestBearing",
            25: "GPSDestDistanceRef",
            26: "GPSDestDistance",
            27: "GPSProcessingMethod",
            28: "GPSAreaInformation",
            29: "GPSDateStamp",
            30: "GPSDifferential",
            31: "GPSHPositioningError"
        },
        40965: {
            1: "InteroperabilityIndex"
        }
    };
    ExifMapProto.tags.ifd1 = ExifMapProto.tags;
    ExifMapProto.stringValues = {
        ExposureProgram: {
            0: "Undefined",
            1: "Manual",
            2: "Normal program",
            3: "Aperture priority",
            4: "Shutter priority",
            5: "Creative program",
            6: "Action program",
            7: "Portrait mode",
            8: "Landscape mode"
        },
        MeteringMode: {
            0: "Unknown",
            1: "Average",
            2: "CenterWeightedAverage",
            3: "Spot",
            4: "MultiSpot",
            5: "Pattern",
            6: "Partial",
            255: "Other"
        },
        LightSource: {
            0: "Unknown",
            1: "Daylight",
            2: "Fluorescent",
            3: "Tungsten (incandescent light)",
            4: "Flash",
            9: "Fine weather",
            10: "Cloudy weather",
            11: "Shade",
            12: "Daylight fluorescent (D 5700 - 7100K)",
            13: "Day white fluorescent (N 4600 - 5400K)",
            14: "Cool white fluorescent (W 3900 - 4500K)",
            15: "White fluorescent (WW 3200 - 3700K)",
            17: "Standard light A",
            18: "Standard light B",
            19: "Standard light C",
            20: "D55",
            21: "D65",
            22: "D75",
            23: "D50",
            24: "ISO studio tungsten",
            255: "Other"
        },
        Flash: {
            0: "Flash did not fire",
            1: "Flash fired",
            5: "Strobe return light not detected",
            7: "Strobe return light detected",
            9: "Flash fired, compulsory flash mode",
            13: "Flash fired, compulsory flash mode, return light not detected",
            15: "Flash fired, compulsory flash mode, return light detected",
            16: "Flash did not fire, compulsory flash mode",
            24: "Flash did not fire, auto mode",
            25: "Flash fired, auto mode",
            29: "Flash fired, auto mode, return light not detected",
            31: "Flash fired, auto mode, return light detected",
            32: "No flash function",
            65: "Flash fired, red-eye reduction mode",
            69: "Flash fired, red-eye reduction mode, return light not detected",
            71: "Flash fired, red-eye reduction mode, return light detected",
            73: "Flash fired, compulsory flash mode, red-eye reduction mode",
            77: "Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected",
            79: "Flash fired, compulsory flash mode, red-eye reduction mode, return light detected",
            89: "Flash fired, auto mode, red-eye reduction mode",
            93: "Flash fired, auto mode, return light not detected, red-eye reduction mode",
            95: "Flash fired, auto mode, return light detected, red-eye reduction mode"
        },
        SensingMethod: {
            1: "Undefined",
            2: "One-chip color area sensor",
            3: "Two-chip color area sensor",
            4: "Three-chip color area sensor",
            5: "Color sequential area sensor",
            7: "Trilinear sensor",
            8: "Color sequential linear sensor"
        },
        SceneCaptureType: {
            0: "Standard",
            1: "Landscape",
            2: "Portrait",
            3: "Night scene"
        },
        SceneType: {
            1: "Directly photographed"
        },
        CustomRendered: {
            0: "Normal process",
            1: "Custom process"
        },
        WhiteBalance: {
            0: "Auto white balance",
            1: "Manual white balance"
        },
        GainControl: {
            0: "None",
            1: "Low gain up",
            2: "High gain up",
            3: "Low gain down",
            4: "High gain down"
        },
        Contrast: {
            0: "Normal",
            1: "Soft",
            2: "Hard"
        },
        Saturation: {
            0: "Normal",
            1: "Low saturation",
            2: "High saturation"
        },
        Sharpness: {
            0: "Normal",
            1: "Soft",
            2: "Hard"
        },
        SubjectDistanceRange: {
            0: "Unknown",
            1: "Macro",
            2: "Close view",
            3: "Distant view"
        },
        FileSource: {
            3: "DSC"
        },
        ComponentsConfiguration: {
            0: "",
            1: "Y",
            2: "Cb",
            3: "Cr",
            4: "R",
            5: "G",
            6: "B"
        },
        Orientation: {
            1: "Original",
            2: "Horizontal flip",
            3: "Rotate 180° CCW",
            4: "Vertical flip",
            5: "Vertical flip + Rotate 90° CW",
            6: "Rotate 90° CW",
            7: "Horizontal flip + Rotate 90° CW",
            8: "Rotate 90° CCW"
        }
    };
    ExifMapProto.getText = function(name) {
        var value = this.get(name);
        switch (name) {
          case "LightSource":
          case "Flash":
          case "MeteringMode":
          case "ExposureProgram":
          case "SensingMethod":
          case "SceneCaptureType":
          case "SceneType":
          case "CustomRendered":
          case "WhiteBalance":
          case "GainControl":
          case "Contrast":
          case "Saturation":
          case "Sharpness":
          case "SubjectDistanceRange":
          case "FileSource":
          case "Orientation":
            return this.stringValues[name][value];

          case "ExifVersion":
          case "FlashpixVersion":
            if (!value) return;
            return String.fromCharCode(value[0], value[1], value[2], value[3]);

          case "ComponentsConfiguration":
            if (!value) return;
            return this.stringValues[name][value[0]] + this.stringValues[name][value[1]] + this.stringValues[name][value[2]] + this.stringValues[name][value[3]];

          case "GPSVersionID":
            if (!value) return;
            return value[0] + "." + value[1] + "." + value[2] + "." + value[3];
        }
        return String(value);
    };
    ExifMapProto.getAll = function() {
        var map = {};
        var prop;
        var obj;
        var name;
        for (prop in this) {
            if (Object.prototype.hasOwnProperty.call(this, prop)) {
                obj = this[prop];
                if (obj && obj.getAll) {
                    map[this.ifds[prop].name] = obj.getAll();
                } else {
                    name = this.tags[prop];
                    if (name) map[name] = this.getText(name);
                }
            }
        }
        return map;
    };
    ExifMapProto.getName = function(tagCode) {
        var name = this.tags[tagCode];
        if (typeof name === "object") return this.ifds[tagCode].name;
        return name;
    };
    (function() {
        var tags = ExifMapProto.tags;
        var prop;
        var ifd;
        var subTags;
        for (prop in tags) {
            if (Object.prototype.hasOwnProperty.call(tags, prop)) {
                ifd = ExifMapProto.ifds[prop];
                if (ifd) {
                    subTags = tags[prop];
                    for (prop in subTags) {
                        if (Object.prototype.hasOwnProperty.call(subTags, prop)) {
                            ifd.map[subTags[prop]] = Number(prop);
                        }
                    }
                } else {
                    ExifMapProto.map[tags[prop]] = Number(prop);
                }
            }
        }
    })();
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image", "./load-image-meta" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"), require("./load-image-meta"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    function IptcMap() {}
    IptcMap.prototype.map = {
        ObjectName: 5
    };
    IptcMap.prototype.types = {
        0: "Uint16",
        200: "Uint16",
        201: "Uint16",
        202: "binary"
    };
    IptcMap.prototype.get = function(id) {
        return this[id] || this[this.map[id]];
    };
    function getStringValue(dataView, offset, length) {
        var outstr = "";
        var end = offset + length;
        for (var n = offset; n < end; n += 1) {
            outstr += String.fromCharCode(dataView.getUint8(n));
        }
        return outstr;
    }
    function getTagValue(tagCode, map, dataView, offset, length) {
        if (map.types[tagCode] === "binary") {
            return new Blob([ dataView.buffer.slice(offset, offset + length) ]);
        }
        if (map.types[tagCode] === "Uint16") {
            return dataView.getUint16(offset);
        }
        return getStringValue(dataView, offset, length);
    }
    function combineTagValues(value, newValue) {
        if (value === undefined) return newValue;
        if (value instanceof Array) {
            value.push(newValue);
            return value;
        }
        return [ value, newValue ];
    }
    function parseIptcTags(dataView, segmentOffset, segmentLength, data, includeTags, excludeTags) {
        var value, tagSize, tagCode;
        var segmentEnd = segmentOffset + segmentLength;
        var offset = segmentOffset;
        while (offset < segmentEnd) {
            if (dataView.getUint8(offset) === 28 && dataView.getUint8(offset + 1) === 2) {
                tagCode = dataView.getUint8(offset + 2);
                if ((!includeTags || includeTags[tagCode]) && (!excludeTags || !excludeTags[tagCode])) {
                    tagSize = dataView.getInt16(offset + 3);
                    value = getTagValue(tagCode, data.iptc, dataView, offset + 5, tagSize);
                    data.iptc[tagCode] = combineTagValues(data.iptc[tagCode], value);
                    if (data.iptcOffsets) {
                        data.iptcOffsets[tagCode] = offset;
                    }
                }
            }
            offset += 1;
        }
    }
    function isSegmentStart(dataView, offset) {
        return dataView.getUint32(offset) === 943868237 && dataView.getUint16(offset + 4) === 1028;
    }
    function getHeaderLength(dataView, offset) {
        var length = dataView.getUint8(offset + 7);
        if (length % 2 !== 0) length += 1;
        if (length === 0) {
            length = 4;
        }
        return length;
    }
    loadImage.parseIptcData = function(dataView, offset, length, data, options) {
        if (options.disableIptc) {
            return;
        }
        var markerLength = offset + length;
        while (offset + 8 < markerLength) {
            if (isSegmentStart(dataView, offset)) {
                var headerLength = getHeaderLength(dataView, offset);
                var segmentOffset = offset + 8 + headerLength;
                if (segmentOffset > markerLength) {
                    console.log("Invalid IPTC data: Invalid segment offset.");
                    break;
                }
                var segmentLength = dataView.getUint16(offset + 6 + headerLength);
                if (offset + segmentLength > markerLength) {
                    console.log("Invalid IPTC data: Invalid segment size.");
                    break;
                }
                data.iptc = new IptcMap;
                if (!options.disableIptcOffsets) {
                    data.iptcOffsets = new IptcMap;
                }
                parseIptcTags(dataView, segmentOffset, segmentLength, data, options.includeIptcTags, options.excludeIptcTags || {
                    202: true
                });
                return;
            }
            offset += 1;
        }
    };
    loadImage.metaDataParsers.jpeg[65517].push(loadImage.parseIptcData);
    loadImage.IptcMap = IptcMap;
}));

(function(factory) {
    "use strict";
    if (typeof define === "function" && define.amd) {
        define([ "./load-image", "./load-image-iptc" ], factory);
    } else if (typeof module === "object" && module.exports) {
        factory(require("./load-image"), require("./load-image-iptc"));
    } else {
        factory(window.loadImage);
    }
})((function(loadImage) {
    "use strict";
    var IptcMapProto = loadImage.IptcMap.prototype;
    IptcMapProto.tags = {
        0: "ApplicationRecordVersion",
        3: "ObjectTypeReference",
        4: "ObjectAttributeReference",
        5: "ObjectName",
        7: "EditStatus",
        8: "EditorialUpdate",
        10: "Urgency",
        12: "SubjectReference",
        15: "Category",
        20: "SupplementalCategories",
        22: "FixtureIdentifier",
        25: "Keywords",
        26: "ContentLocationCode",
        27: "ContentLocationName",
        30: "ReleaseDate",
        35: "ReleaseTime",
        37: "ExpirationDate",
        38: "ExpirationTime",
        40: "SpecialInstructions",
        42: "ActionAdvised",
        45: "ReferenceService",
        47: "ReferenceDate",
        50: "ReferenceNumber",
        55: "DateCreated",
        60: "TimeCreated",
        62: "DigitalCreationDate",
        63: "DigitalCreationTime",
        65: "OriginatingProgram",
        70: "ProgramVersion",
        75: "ObjectCycle",
        80: "Byline",
        85: "BylineTitle",
        90: "City",
        92: "Sublocation",
        95: "State",
        100: "CountryCode",
        101: "Country",
        103: "OriginalTransmissionReference",
        105: "Headline",
        110: "Credit",
        115: "Source",
        116: "CopyrightNotice",
        118: "Contact",
        120: "Caption",
        121: "LocalCaption",
        122: "Writer",
        125: "RasterizedCaption",
        130: "ImageType",
        131: "ImageOrientation",
        135: "LanguageIdentifier",
        150: "AudioType",
        151: "AudioSamplingRate",
        152: "AudioSamplingResolution",
        153: "AudioDuration",
        154: "AudioOutcue",
        184: "JobID",
        185: "MasterDocumentID",
        186: "ShortDocumentID",
        187: "UniqueDocumentID",
        188: "OwnerID",
        200: "ObjectPreviewFileFormat",
        201: "ObjectPreviewFileVersion",
        202: "ObjectPreviewData",
        221: "Prefs",
        225: "ClassifyState",
        228: "SimilarityIndex",
        230: "DocumentNotes",
        231: "DocumentHistory",
        232: "ExifCameraInfo",
        255: "CatalogSets"
    };
    IptcMapProto.stringValues = {
        10: {
            0: "0 (reserved)",
            1: "1 (most urgent)",
            2: "2",
            3: "3",
            4: "4",
            5: "5 (normal urgency)",
            6: "6",
            7: "7",
            8: "8 (least urgent)",
            9: "9 (user-defined priority)"
        },
        75: {
            a: "Morning",
            b: "Both Morning and Evening",
            p: "Evening"
        },
        131: {
            L: "Landscape",
            P: "Portrait",
            S: "Square"
        }
    };
    IptcMapProto.getText = function(id) {
        var value = this.get(id);
        var tagCode = this.map[id];
        var stringValue = this.stringValues[tagCode];
        if (stringValue) return stringValue[value];
        return String(value);
    };
    IptcMapProto.getAll = function() {
        var map = {};
        var prop;
        var name;
        for (prop in this) {
            if (Object.prototype.hasOwnProperty.call(this, prop)) {
                name = this.tags[prop];
                if (name) map[name] = this.getText(name);
            }
        }
        return map;
    };
    IptcMapProto.getName = function(tagCode) {
        return this.tags[tagCode];
    };
    (function() {
        var tags = IptcMapProto.tags;
        var map = IptcMapProto.map || {};
        var prop;
        for (prop in tags) {
            if (Object.prototype.hasOwnProperty.call(tags, prop)) {
                map[tags[prop]] = Number(prop);
            }
        }
    })();
}));