var supportsLocalStorage = function() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null
    } catch (e) {
        return false
    }
}

var trySaveLocalStorage = function(key, value) {
    if (supportsLocalStorage()) {
        localStorage[key] = value
    }
}

var tryGetLocalStorage = function(key) {
    if (!supportsLocalStorage()) {
        return null
    } else {
        return localStorage[key]
    }
}

var getScript = function(srcName, callback) {
    var localName = 'ghr.' + srcName.split('/').pop()
    var jqSrc = tryGetLocalStorage(localName)
    if (jqSrc !== null && typeof(jqSrc) === "string") {
        setTimeout(function() {
            eval(jqSrc)
            executeCallback(callback, jqSrc)
        }, 0)
    }
    else { 
        var req = new XMLHttpRequest()
        req.open("GET", srcName, true)
        req.send()
        req.onreadystatechange = function() {
            if (req.readyState==4 && req.status==200) {
                trySaveLocalStorage(localName, req.responseText)
                eval(req.responseText)
                executeCallback(callback, req.responseText)
            }
        }
    }
}

var executeCallback = function (callback, jqSrc) {
    if ( typeof callback === "function" ) {
        callback(jqSrc)
    }
}

var cachedScript = function ( url, options ) {
    // Allow user to set any option except for dataType, cache, and url
    options = jQuery.extend( options || {}, {
        dataType: "script",
        cache: true,
        url: url,
        // async: false,
    });
    // Use jQuery.ajax() since it is more flexible than jQuery.getScript
    // Return the jqXHR object so we can chain callbacks
    return jQuery.ajax( options );
}