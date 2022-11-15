!function(e){var t={};function a(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(n,o,function(t){return e[t]}.bind(null,o));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=75)}({1:function(e,t){e.exports=React},11:function(e,t){e.exports=window.wp.primitives},15:function(e,t){e.exports=window.wp.blocks},3:function(e,t){e.exports=window.wp.components},38:function(e,t,a){"use strict";var n=a(6),o=a(11);const r=Object(n.createElement)(o.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(n.createElement)(o.Path,{d:"M4 9v1.5h16V9H4zm12 5.5h4V13h-4v1.5zm-6 0h4V13h-4v1.5zm-6 0h4V13H4v1.5z"}));t.a=r},5:function(e,t){e.exports=window.wp.blockEditor},6:function(e,t){e.exports=window.wp.element},62:function(e){e.exports=JSON.parse('{"name":"three-object-viewer/spawn-point-block","title":"Spawn Point","description":"A spawn point for your users","attributes":{"positionX":{"type":"int","default":0},"positionY":{"type":"int","default":0},"positionZ":{"type":"int","default":0},"rotationX":{"type":"int","default":0},"rotationY":{"type":"int","default":0},"rotationZ":{"type":"int","default":0}},"category":"design","parent":["three-object-viewer/environment"],"apiVersion":2,"supports":{"html":false,"multiple":false},"editorScript":"file:../../build/block-spawn-point-block.js","editorStyle":"file:../../build/block-spawn-point-block.css","style":"file:../../build/block-spawn-point-block.css"}')},7:function(e,t){e.exports=window.wp.i18n},75:function(e,t,a){"use strict";a.r(t);var n=a(15),o=a(7),r=a(1),c=a.n(r),i=a(3),l=a(5),s=a(38);function p(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function u(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?p(Object(a),!0).forEach((function(t){m(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):p(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function m(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var b=React.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},React.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),f=a(62);Object(n.registerBlockType)(f.name,u(u({},f),{},{icon:b,apiVersion:2,edit:function(e){var t=e.attributes,a=e.setAttributes;return e.isSelected,c.a.createElement("div",Object(l.useBlockProps)(),c.a.createElement(l.InspectorControls,{key:"setting"},c.a.createElement(i.Panel,{header:"Settings"},c.a.createElement(i.PanelBody,{title:"Spawn Point",icon:s.a,initialOpen:!0},c.a.createElement(i.PanelRow,null,c.a.createElement(i.TextControl,{className:"position-inputs",label:"X",value:t.positionX,onChange:function(e){a({positionX:e})}}),c.a.createElement(i.TextControl,{className:"position-inputs",label:"Y",value:t.positionY,onChange:function(e){a({positionY:e})}}),c.a.createElement(i.TextControl,{className:"position-inputs",label:"Z",value:t.positionZ,onChange:function(e){a({positionZ:e})}})),c.a.createElement(i.PanelRow,null,c.a.createElement("legend",{className:"blocks-base-control__label"},Object(o.__)("Rotation","three-object-viewer"))),c.a.createElement(i.PanelRow,null,c.a.createElement(i.TextControl,{className:"position-inputs",label:"X",value:t.rotationX,onChange:function(e){a({rotationX:e})}}),c.a.createElement(i.TextControl,{className:"position-inputs",label:"Y",value:t.rotationY,onChange:function(e){a({rotationY:e})}}),c.a.createElement(i.TextControl,{className:"position-inputs",label:"Z",value:t.rotationZ,onChange:function(e){a({rotationZ:e})}}))))),c.a.createElement(c.a.Fragment,null,c.a.createElement("div",{className:"three-object-viewer-inner"},c.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},c.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},c.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},c.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),c.a.createElement("p",null,c.a.createElement("b",null,"Spawn Point"))))))},save:function(e){var t=e.attributes;return React.createElement("div",l.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app-spawn-point-block"},React.createElement("p",{className:"spawn-point-block-positionX"},t.positionX),React.createElement("p",{className:"spawn-point-block-positionY"},t.positionY),React.createElement("p",{className:"spawn-point-block-positionZ"},t.positionZ),React.createElement("p",{className:"spawn-point-block-rotationX"},t.rotationX),React.createElement("p",{className:"spawn-point-block-rotationY"},t.rotationY),React.createElement("p",{className:"spawn-point-block-rotationZ"},t.rotationZ))))},deprecated:[{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"}},save:function(e){return React.createElement("div",l.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale))))}},{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"},animations:{type:"string",default:""}},save:function(e){return React.createElement("div",l.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-animations"},e.attributes.animations))))}}]}))}});