!function(e){var t={};function n(r){if(t[r])return t[r].exports;var l=t[r]={i:r,l:!1,exports:{}};return e[r].call(l.exports,l,l.exports,n),l.l=!0,l.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)n.d(r,l,function(t){return e[t]}.bind(null,l));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=32)}({1:function(e,t){e.exports=React},2:function(e,t){e.exports=window.wp.element},20:function(e,t){e.exports=window.wp.apiFetch},32:function(e,t,n){"use strict";n.r(t);var r=n(2);function l(e){let{getSettings:t,updateSettings:n}=e;const[l,a]=Object(r.useState)({}),[c,i]=Object(r.useState)(!0);return Object(r.useEffect)(()=>{t().then(e=>{a(e),i(!1)})},[t,a]),c?Object(r.createElement)("div",{className:"spinner",style:{visibility:"visible"}}):Object(r.createElement)("div",null,Object(r.createElement)("div",null,l.enabled?"Enabled":"Not enabled"),Object(r.createElement)("div",null,Object(r.createElement)("label",{htmlFor:"enabled"},"Enable"),Object(r.createElement)("input",{id:"enabled",type:"checkbox",name:"enabled",value:l.enabled,onChange:()=>{a({...l,enabled:!l.enabled})}})),Object(r.createElement)("div",null,Object(r.createElement)("label",{htmlFor:"save"},"Save"),Object(r.createElement)("input",{id:"save",type:"submit",name:"enabled",onClick:()=>{n(l).then(e=>{a(e)})}})))}n(1);var a=n(20),c=n.n(a);window.addEventListener("load",(async function(){const e="/three-object-viewer/v1/three-model-viewer-settings/";Object(r.render)(Object(r.createElement)(l,{getSettings:async()=>await c()({path:e,method:"GET"}),updateSettings:async t=>c()({path:e,data:t,method:"POST"})}),document.getElementById("three-model-viewer-settings"))}))}});