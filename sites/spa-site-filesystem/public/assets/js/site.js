/**
 * @link      https://bitbucket.org/generator-xdd/generator-xdd for the canonical source repository
 * @copyright Copyright (c) 2018 Secalith Ltd
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * Limits input text
 * @param element
 */
function limitTxt(element)
{
    var maxChars = document.getElementById("count-" + element.getAttribute('name')).getAttribute('data-limit');
    if(element.value.length > maxChars) {
        element.value = element.value.substr(0, maxChars);
    }
}

function countChar(element,elTarget)
{
    var currLen = element.value.length;
    var targetNode = document.getElementById(elTarget);
    var charsRemain = (currLen - parseInt(targetNode.getAttribute('data-limit')))*(-1);
    var nodeCount = document.createTextNode(charsRemain);
    while (targetNode.firstChild) {
        targetNode.removeChild(targetNode.firstChild);
    }
    targetNode.appendChild(nodeCount);
}

var coreJS = {
    isDefined: function(input) {
        if(typeof(input) != 'undefined' && input != null) {
            return true;
        } else {
            return false;
        }
    },
    has: function (object, key) {
        return object ? hasOwnProperty.call(object, key) : false;
    },
};
var ajax = {
    callAjax: function(url,callback,targetId) {
        var xmlhttp;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if( typeof(callback) != 'undefined' && callback != null ) {
                    callback(xmlhttp.responseText,targetId);
                } else {
                    return xmlhttp.responseText;
                }
            } else if(xmlhttp.status == 404) {
                console.log(404);
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    },
    callAjaxImage: function(url,callback,targetId) {
        var xmlhttp;
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if( typeof(callback) != 'undefined' && callback != null ) {
                    callback(xmlhttp.responseText,targetId);
                } else {
                    return xmlhttp.responseText;
                }
            } else if(xmlhttp.status == 404) {
                callback(xmlhttp.responseText,targetId,xmlhttp.status);
                console.log('again');
                return xmlhttp.status;
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }
};

var formAjax = {
    host: null,
    formPath: '/form/',
    ajax: ajax,
    setHost: function() {
        var hostUrl = this.host;
        if( hostUrl===null ) {
            hostUrlElement = document.getElementById('ajax-server');
            if( typeof(hostUrlElement) != 'undefined' && hostUrlElement != null ) {
                hostUrl = hostUrlElement.getAttribute('data-host-url');
                this.host = hostUrl;
            }
        }
    },
    getForm: function(requestedFormId,callback,targetId) {
        var url = this.formPath + requestedFormId;
        return this.ajax.callAjax(url,callback,targetId);
    }
};
var imageAjax = {
    host: null,
    imagePath: '/i/',
    ajax: ajax,
    setHost: function() {
        var hostUrl = this.host;
        if( hostUrl===null ) {
            hostUrlElement = document.getElementById('ajax-server');
            if( typeof(hostUrlElement) != 'undefined' && hostUrlElement != null ) {
                hostUrl = hostUrlElement.getAttribute('data-host-url');
                this.host = hostUrl;
            }
        }
    },
    getHost: function() {
        if( typeof(this.host) == 'undefined' || this.host == null ) {
            hostUrlElement = document.getElementById('ajax-server');
            if( typeof(hostUrlElement) != 'undefined' && hostUrlElement != null ) {
                hostUrl = hostUrlElement.getAttribute('data-host-url');
                this.host = hostUrl;
            }
        } else {
            return this.host;
        }
    },
    getImage: function(requestedImageId,callback,targetId) {
        var url = this.imagePath + requestedImageId;
        this.ajax.callAjaxImage(url,callback,targetId);
    }
};
var htmlDom = {
    changeAttrinuteInChildren: function(parentNode,inputType) {

    },
    replaceClassAttrString(target,reg) {
        if( typeof(target.className) != 'undefined' && target.className != null ) {
            target.className = target.className.replace(reg,'');
        }
    },
    emptyNode: function(node) {
        if( typeof(node) != 'undefined' && node != null ) {
            while (node.hasChildNodes()) {
                node.removeChild(node.lastChild);
            }
        }
    }
};
/**
 * dependency htmlDom, DOMParser, RegExp
 *
 * @type {{parseHTML: (function(*): Node), stringToEl: (function(*=): Node), removeClass: html.removeClass}}
 */
var html = {
    parseHTML: function(i) {
        var t = document.createElement('template');
        t.innerHTML = i;
        return t.content.cloneNode(true);
    },
    stringToEl: function(string) {
        var parser = new DOMParser(),
            content = 'text/html',
            DOM = parser.parseFromString(string, content);
        // return element
        return DOM.body.childNodes[0];
    },
    removeClass: function (target,className) {
        var reg = new RegExp('(\\s|^)'+className+'(\\s|$)');
        if(target instanceof HTMLCollection) {
            for (var ele in target) {
                htmlDom.replaceClassAttrString(target[ele],reg);
            }
        } else {
            htmlDom.replaceClassAttrString(target,reg);
        }

    },
    hasClass: function( target, className ) {
        return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
    },
    addClass: function ( target, className ) {
        if( typeof(target) != 'undefined' && target != null ) {
            var arr = target.className.split(" ");
            if (arr.indexOf(className) == -1) {
                target.className += " " + className;
            }
        }
    }

}

var btCarousel = {
    indicatorGroupId: null,
    setIndicatorAsActive: function(triggerElement) {

        // determine the direction
        var direction = triggerElement.getAttribute('data-slide');
        var currentIndicatorPosition, newIndicatorPosition;



        if( direction==='prev' || direction==='next' ) {
            console.log(this.indicatorGroupId);
            var indicatorWrapperList = document.getElementById(this.indicatorGroupId);
            var indicatorWrappers = indicatorWrapperList.getElementsByTagName('li');
            var indicatorElLength = indicatorWrapperList.childElementCount;

            for(var i=0; i<indicatorElLength; i++) {
                // remove the 'active' class from the current indicator
                if(applicationForm.html.hasClass(indicatorWrappers[i],'active')) {
                    applicationForm.html.removeClass(indicatorWrappers[i],'active');
                    currentIndicatorPosition = i;
                }
            }

            if(direction=='prev') {
                if(currentIndicatorPosition===0) {
                    // mark the last item
                    applicationForm.html.addClass(indicatorWrappers[indicatorElLength-1],'active');
                    applicationForm.htmlInput.selectRadioByLabel(indicatorWrappers[indicatorElLength-1].getElementsByTagName('label')[0],document.getElementById('formTemplateId').getAttribute('value'));
                } else {
                    // mark the previous item
                    applicationForm.html.addClass(indicatorWrappers[currentIndicatorPosition-1],'active');
                    applicationForm.htmlInput.selectRadioByLabel(indicatorWrappers[currentIndicatorPosition-1].getElementsByTagName('label')[0],document.getElementById('formTemplateId').getAttribute('value'));
                }
            } else {
                if(currentIndicatorPosition===0) {
                    // mark the last item
                    applicationForm.html.addClass(indicatorWrappers[indicatorElLength-1],'active');
                    applicationForm.htmlInput.selectRadioByLabel(indicatorWrappers[indicatorElLength-1].getElementsByTagName('label')[0],document.getElementById('formTemplateId').getAttribute('value'));
                } else if(currentIndicatorPosition===(indicatorElLength-1)) {
                    // mark the first item
                    applicationForm.html.addClass(indicatorWrappers[0],'active');
                    applicationForm.htmlInput.selectRadioByLabel(indicatorWrappers[0].getElementsByTagName('label')[0],document.getElementById('formTemplateId').getAttribute('value'));
                } else {
                    // mark the next item
                    applicationForm.html.addClass(indicatorWrappers[currentIndicatorPosition+1],'active');
                    applicationForm.htmlInput.selectRadioByLabel(indicatorWrappers[currentIndicatorPosition-1].getElementsByTagName('label')[0],document.getElementById('formTemplateId').getAttribute('value'));
                }
            }


        }
    }
};

/**
 * depencedcy: applicationForm
 *
 * @type {{selectRadioByLabel: htmlInput.selectRadioByLabel}}
 */
var htmlInput = {

    selectRadioByLabel: function(elementLabel,inputContainerId) {
// console.log(inputContainerId);
        var inputContainer = document.getElementById(inputContainerId);
        var labelForAttribute = elementLabel.getAttribute('for');
        var selectedRadio = document.getElementById(elementLabel.getAttribute('for'));

        if(labelForAttribute.length>0) {
            // get all radios in parent container
            var radios = inputContainer.getElementsByTagName('input');
            // uncheck all radios in parent
            for (var radioEl in radios) {
                if(radios[radioEl].checked !== false) {
                    radios[radioEl].checked = false;
                }

                // remove class from the label wrapper
                var listElWrapper = inputContainer.getElementsByTagName('li');
                applicationForm.html.removeClass(listElWrapper,'active');
            }
        }

        // remove class in list element
        selectedRadio.parentElement.setAttribute('class','active');

        // set selected radio to 'checked'
        selectedRadio.checked = true;
    }
};

var dynamicImage = {
   calculateCoordinates: function() {
       var imgWrapper = document.getElementById('version-experimental-input-group').getElementsByTagName('li');
       for (var i = 0, len = imgWrapper.length; i < len; i++) {
           if(applicationForm.html.hasClass(imgWrapper[i],'active')) {
               console.log(imgWrapper[i].getElementsByTagName('img')[0].getAttribute('data-dimensions'));
               var dimensions = JSON.parse(imgWrapper[i].getElementsByTagName('img')[0].getAttribute('data-dimensions'));
               console.log(dimensions);
               console.log(dimensions.height);
                console.log(i);
                console.log(imgWrapper[i]);
           }
       }
   }
};

var applicationForm = {
    formAjax: formAjax,
    html: html,
    htmlDom: htmlDom,
    btCarousel: btCarousel,
    htmlInput: htmlInput,
    coreJS: coreJS,
    targetId: null,
    formDefault: null,
    preloadForm:true,
    dynamicImage:dynamicImage,
    init: function(config)
    {
        this.formAjax.setHost();

        if(this.coreJS.isDefined(config)) {
            this.configure(config);
        }

        if(this.preloadForm === true) {
            var hashString = window.location.hash.substr(1);
            if(this.coreJS.isDefined(hashString) && hashString.length>0) {
                // var listElWrapper = document.getElementById('myTab').getElementsByTagName('li');
                // this.html.removeClass(listElWrapper,'active');
                var splitModules = hashString.split("/");
                if(this.coreJS.isDefined(splitModules)) {
                    for(var urlModuleEntry in splitModules) {
                        var splitEntry = splitModules[urlModuleEntry].split(":");
                        if(splitEntry[0]==="form") {
                            // load the requested form
                            this.loadForm(
                                splitEntry[1],
                                document.getElementById(splitEntry[1]+"-tab")
                            );
                            // set tab as active
                            this.html.addClass(
                                document.getElementById(splitEntry[1]+"-tab"),
                                'active show'
                            )
                        }
                    }
                }
            } else {
                // form not seletced by user, use the default ine
                this.loadForm(
                    this.formDefault,
                    document.getElementById(this.formDefault+"-tab")
                );
                // set tab as active
                this.html.addClass(
                    document.getElementById(this.formDefault+"-tab"),
                    'active show'
                )
            }
        }



        //

    },
    configure: function (config) {
        for (var ele in config) {
            if(this.coreJS.has(this,ele)) {
                this[ele] = config[ele];
            } else if(ele.indexOf('.') !== -1) {
                var splitted = ele.split('.');
                if(this.coreJS.has(this[splitted[0]],splitted[1])) {
                    // btCarousel.indicatorGroupId = config[ele];
                    this[splitted[0]][splitted[1]] = config[ele];
                    console.log(this[splitted[0]][splitted[1]]);
                } else {
                    console.log('dupa');
                }
            }
        }
    },
    target: document.getElementById(this.targetId),
    loadForm: function(requestedFormId,triggerElement) {
        // empty content content-node
        this.htmlDom.emptyNode(document.getElementById(this.targetId));
        // load form into content-node
        formAjax.getForm(requestedFormId,this.appendForm,this.targetId);

    },
    appendForm: function(parsedForm,targetId) {

        var parsedForm = this.html.parseHTML(parsedForm);

        if(document.getElementById(targetId)!=null) {
            document.getElementById(targetId).appendChild(parsedForm);
        } else {
            console.log(targetId + " not found.");
        }

    }
};

var applicationImage = {
    imageAjax: imageAjax,
    coreJS: coreJS,
    targetId: null,
    itemDefault: null,
    preloadItem:true,
    initSingle: function(config) {
        this.imageAjax.setHost();

        if(this.coreJS.isDefined(config)) {
            this.configure(config);
        }

        this.loadImage(
            this.itemDefault,
            document.getElementById(this.formDefault+"-tab")
        );
    },
    configure: function (config) {
        for (var ele in config) {
            if(this.coreJS.has(this,ele)) {
                this[ele] = config[ele];
            } else if(ele.indexOf('.') !== -1) {
                var splitted = ele.split('.');
                if(this.coreJS.has(this[splitted[0]],splitted[1])) {
                    console.log();
                    btCarousel.indicatorGroupId = config[ele];
                    this[splitted[0]][splitted[1]] = config[ele];
                    console.log(this[splitted[0]][splitted[1]]);
                } else {
                    console.log('dupa');
                }
            }
        }
    },
    loadImage: function(requestedItemId,triggerElement) {
        // empty content content-node
        // this.htmlDom.emptyNode(document.getElementById(this.targetId));
        // load form into content-node
        this.imageAjax.getImage(requestedItemId,this.appendImage,this.targetId);

    },
    appendImage: function(imageData) {

        this.htmlDom.emptyNode(document.getElementById(this.targetId));

        var loaded  = false;

        var image = document.getElementById('mainImage');
        var downloadingImage = new Image();

        downloadingImage.onerror = function() {
            console.log('Image could not be loaded.');
        };
        downloadingImage.onload = function(){
            loaded = true;
            image.setAttribute('src',this.src);
        };

        downloadingImage.src = imageData;

    }
};

function move() {
    var elem = document.getElementById("myBar");
    var width = 0;
    var id = setInterval(frame, 100);
    function frame() {
        if (width == 100) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
}

