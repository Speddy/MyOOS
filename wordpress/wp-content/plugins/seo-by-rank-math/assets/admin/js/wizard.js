!function(t){var e={};function n(a){if(e[a])return e[a].exports;var r=e[a]={i:a,l:!1,exports:{}};return t[a].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,a){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(a,r,function(e){return t[e]}.bind(null,r));return a},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=257)}({257:function(t,e,n){"use strict";var a;(a=jQuery)(function(){window.rankMathSetupWizard={init:function(){rankMath.currentStep in this&&this[rankMath.currentStep](),a(document).on("cmb_init",function(){a(".cmb-multicheck-toggle",".multicheck-checked").trigger("click")})},compatibility:function(){a(".wizard-deactivate-plugin").on("click",function(t){t.preventDefault();var e=a(this);if(!e.hasClass("disabled")){var n=e.closest("tr");a.ajax({url:rankMath.ajaxurl,type:"POST",data:{action:"rank_math_deactivate_plugins",security:rankMath.security,plugin:e.data("plugin")}}).always(function(t){"1"===t?(n.find(".dashicons-warning").removeClass("dashicons-warning").addClass("dashicons-yes"),e.addClass("disabled").text(rankMath.deactivated)):console.log("Deactivation error")})}})},import:function(){var t=a("#import-progress"),e=a("#import-progress-bar"),n=0,r=0,i=function(t,e){var n=new Date,a=e.val()+"["+(10>n.getHours()?"0":"")+n.getHours()+":"+(10>n.getMinutes()?"0":"")+n.getMinutes()+":"+(10>n.getSeconds()?"0":"")+n.getSeconds()+"] "+t+"\n";e.text(a).scrollTop(e[0].scrollHeight-e.height()-20)},o=function(t){t>100&&(t=100),e.find(".number").html(t),e.find("#importBar").css("width",t+"%")};a(".button-import",".form-footer").on("click",function(n){if(n.preventDefault(),rankMath.isConfigured&&!window.confirm(rankMath.confirm))return!1;var s=a(this),u=a(".import-data:checkbox:checked"),l={},p=[];if(!u.length)return alert("Please select plugin to import data."),!1;a.each(u,function(t){var e=a(this).val(),n=a(this).parents(".cmb-group-description").next().find(":checkbox:checked"),i=n.data("active"),o=a(this).data("plugin");p.push(o);var c=a.map(n,function(t){return t.value});c.length>0&&i&&c.push("deactivate"),r+=c.length,l[e]={plugin:o,actions:c}}),s.prop("disabled",!0),t.show(),e.show(),e.find(".plugin-from").html(p.join()),i("Import started...",t),c(l,t,function(){o(100),s.prop("disabled",!1),a(".button",".form-footer").hide(),a(".button-continue").show()})});var c=function e(c,s,u){var l=Object.keys(c),p=l.length,h=c[l[0]],d=Object.keys(c)[0];if(delete c[d],0===p)return i("Import finished. Click on the button below to continue the Setup Wizard.",s),void u();!function t(e,c,s,u,l,p){if(0!==c.length){var h=c.shift(),d="deactivate"===h?"Deactivating "+p:"Importing "+h+" from "+p,g=Math.floor(100/r);u=u||1,i(d,s),a.ajax({url:rankMath.ajaxurl,type:"POST",data:{perform:h,pluginSlug:e,paged:u,action:"rank_math_import_plugin",security:rankMath.security}}).success(function(a){var r=1;a&&a.page&&a.total_pages>a.page&&(r=a.page+1,c.unshift(h)),a&&a.total_pages&&(g=Math.ceil(g/a.total_pages)),o(n+=g),i(a.success?a.message:a.error,s),t(e,c,s,r,l,p)}).error(function(n){i(n.statusText,s),t(e,c,s,null,l,p)})}else l()}(d,h.actions,t,null,function(){e(c,s,u)},h.plugin)};a(".import-data").on("change",function(){for(var t=this.checked,e=a(this).parents(".cmb-group-description").next().find(".cmb2-option"),n=0;e.length>n;n++)"checkbox"==e[n].type&&(e[n].checked=t);t&&("yoast"===a(this).val()?(a('.import-data[value="aioseo"]').prop("checked",!1).trigger("change"),a('.import-data[value="seopress"]').prop("checked",!1).trigger("change")):"aioseo"===a(this).val()?(a('.import-data[value="yoast"]').prop("checked",!1).trigger("change"),a('.import-data[value="seopress"]').prop("checked",!1).trigger("change")):"seopress"===a(this).val()&&(a('.import-data[value="yoast"]').prop("checked",!1).trigger("change"),a('.import-data[value="aioseo"]').prop("checked",!1).trigger("change")))}),a(".cmb-type-group .cmb2-checkbox-list .cmb2-option").on("click",function(){var t=a(this),e=t.attr("name"),n=t.parents("ul").find('input[name="'+e+'"]:checkbox:checked'),r=t.parents("ul").find('input[name="'+e+'"]');n.length===r.length&&t.parents(".cmb-type-group").find(".import-data").prop("checked",!0).trigger("change")}),a(".button-deactivate-plugins").on("click",function(t){var e=a(this);e.parents("form").find("input[data-active]").length&&(t.preventDefault(),e.text(e.data("deactivate-message")),a.ajax({url:rankMath.ajaxurl,type:"POST",data:{action:"rank_math_deactivate_plugins",security:rankMath.security,plugin:"all"}}).success(function(t){e.parents("form").trigger("submit")}).error(function(t){alert("Something went wrong! Please try again later.")}))})},yoursite:function(){a("#rank-math-search-input").on("input keypress",function(t){var e=a(this),n=e.next();if(13===t.keyCode||13===t.which){if("createEvent"in document){var r=this.ownerDocument,i=r.createEvent("MouseEvents");i.initMouseEvent("click",!0,!0,r.defaultView,1,0,0,0,0,!1,!1,!1,!1,0,null),n[0].dispatchEvent(i)}return!1}n.attr("href",n.data("href")+encodeURIComponent(e.val()))});var t=a("#business_type");0!==parseInt(t.data("default"))&&a("#site_type").on("change",function(){var e=a(this).val();"news"!==e&&"webshop"!==e&&"otherbusiness"!==e||t.val("Organization").trigger("change"),"business"===e&&t.val("LocalBusiness").trigger("change")})},searchconsole:function(){a("#console_authorization_code").on("paste",function(){var t=a(this).next(".button");setTimeout(function(){t.trigger("click")},100)})},ready:function(){a("#show-seo-score").on("change",function(t){a.ajax({url:rankMath.api.root+"rankmath/v1/enableScore",method:"POST",beforeSend:function(t){t.setRequestHeader("X-WP-Nonce",rankMath.api.nonce)},data:{enable:a(this).is(":checked")}}).done(function(t){console.log(t)})})}},window.rankMathSetupWizard.init()})}});