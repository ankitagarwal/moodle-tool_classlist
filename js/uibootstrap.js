angular.module("ui.bootstrap",["ui.bootstrap.modal"]),angular.module("ui.bootstrap.modal",[]).factory("$$stackedMap",function(){return{createNew:function(){var a=[];return{add:function(b,c){a.push({key:b,value:c})},get:function(b){for(var c=0;c<a.length;c++)if(b==a[c].key)return a[c]},keys:function(){for(var b=[],c=0;c<a.length;c++)b.push(a[c].key);return b},top:function(){return a[a.length-1]},remove:function(b){for(var c=-1,d=0;d<a.length;d++)if(b==a[d].key){c=d;break}return a.splice(c,1)[0]},removeTop:function(){return a.splice(a.length-1,1)[0]},length:function(){return a.length}}}}}).directive("modalBackdrop",["$modalStack","$timeout",function(a,b){return{restrict:"EA",replace:!0,templateUrl:"template/modal/backdrop.html",link:function(c){b(function(){c.animate=!0}),c.close=function(b){var c=a.getTop();c&&c.value.backdrop&&"static"!=c.value.backdrop&&(b.preventDefault(),b.stopPropagation(),a.dismiss(c.key,"backdrop click"))}}}}]).directive("modalWindow",["$timeout",function(a){return{restrict:"EA",scope:{index:"@"},replace:!0,transclude:!0,templateUrl:"template/modal/window.html",link:function(b,c,d){b.windowClass=d.windowClass||"",a(function(){b.animate=!0})}}}]).factory("$modalStack",["$document","$compile","$rootScope","$$stackedMap",function(a,b,c,d){function e(){for(var a=-1,b=k.keys(),c=0;c<b.length;c++)k.get(b[c]).value.backdrop&&(a=c);return a}function f(a){var b=k.get(a).value;k.remove(a),b.modalDomEl.remove(),-1==e()&&(h.remove(),h=void 0),b.modalScope.$destroy()}var g,h,i=c.$new(!0),j=a.find("body").eq(0),k=d.createNew(),l={};return c.$watch(e,function(a){i.index=a}),a.bind("keydown",function(a){var b;27===a.which&&(b=k.top(),b&&b.value.keyboard&&c.$apply(function(){l.dismiss(b.key)}))}),l.open=function(a,c){k.add(a,{deferred:c.deferred,modalScope:c.scope,backdrop:c.backdrop,keyboard:c.keyboard});var d=angular.element("<div modal-window></div>");d.attr("window-class",c.windowClass),d.attr("index",k.length()-1),d.html(c.content);var f=b(d)(c.scope);k.top().value.modalDomEl=f,j.append(f),e()>=0&&!h&&(g=angular.element("<div modal-backdrop></div>"),h=b(g)(i),j.append(h))},l.close=function(a,b){var c=k.get(a);c&&(c.value.deferred.resolve(b),f(a))},l.dismiss=function(a,b){var c=k.get(a).value;c&&(c.deferred.reject(b),f(a))},l.getTop=function(){return k.top()},l}]).provider("$modal",function(){var a={options:{backdrop:!0,keyboard:!0},$get:["$injector","$rootScope","$q","$http","$templateCache","$controller","$modalStack",function(b,c,d,e,f,g,h){function i(a){return a.template?d.when(a.template):e.get(a.templateUrl,{cache:f}).then(function(a){return a.data})}function j(a){var c=[];return angular.forEach(a,function(a){(angular.isFunction(a)||angular.isArray(a))&&c.push(d.when(b.invoke(a)))}),c}var k={};return k.open=function(b){var e=d.defer(),f=d.defer(),k={result:e.promise,opened:f.promise,close:function(a){h.close(k,a)},dismiss:function(a){h.dismiss(k,a)}};if(b=angular.extend({},a.options,b),b.resolve=b.resolve||{},!b.template&&!b.templateUrl)throw new Error("One of template or templateUrl options is required.");var l=d.all([i(b)].concat(j(b.resolve)));return l.then(function(a){var d=(b.scope||c).$new();d.$close=k.close,d.$dismiss=k.dismiss;var f,i={},j=1;b.controller&&(i.$scope=d,i.$modalInstance=k,angular.forEach(b.resolve,function(b,c){i[c]=a[j++]}),f=g(b.controller,i)),h.open(k,{scope:d,deferred:e,content:a[0],backdrop:b.backdrop,keyboard:b.keyboard,windowClass:b.windowClass})},function(a){e.reject(a)}),l.then(function(){f.resolve(!0)},function(){f.reject(!1)}),k},k}]};return a});