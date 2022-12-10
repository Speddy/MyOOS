!function(e){var t={};function a(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)a.d(n,o,function(t){return e[t]}.bind(null,o));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=72)}({1:function(e,t){e.exports=React},11:function(e,t){e.exports=window.wp.primitives},15:function(e,t){e.exports=window.wp.blocks},3:function(e,t){e.exports=window.wp.components},37:function(e,t,a){"use strict";var n=a(6),o=a(11);const l=Object(n.createElement)(o.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(n.createElement)(o.Path,{d:"M4 9v1.5h16V9H4zm12 5.5h4V13h-4v1.5zm-6 0h4V13h-4v1.5zm-6 0h4V13H4v1.5z"}));t.a=l},5:function(e,t){e.exports=window.wp.blockEditor},59:function(e){e.exports=JSON.parse('{"name":"three-object-viewer/three-video-block","title":"3D Video","description":"A video block for your environment","attributes":{"videoUrl":{"type":"string","default":null},"autoPlay":{"type":"bool","default":true},"scaleX":{"type":"int","default":1},"scaleY":{"type":"int","default":1},"scaleZ":{"type":"int","default":1},"positionX":{"type":"int","default":0},"positionY":{"type":"int","default":0},"positionZ":{"type":"int","default":0},"rotationX":{"type":"int","default":0},"rotationY":{"type":"int","default":0},"rotationZ":{"type":"int","default":0},"aspectHeight":{"type":"int","default":0},"aspectWidth":{"type":"int","default":0}},"category":"design","parent":["three-object-viewer/environment"],"apiVersion":2,"supports":{"html":false,"multiple":true},"editorScript":"file:../../build/block-three-video-block.js","editorStyle":"file:../../build/block-three-video-block.css","style":"file:../../build/block-three-video-block.css"}')},6:function(e,t){e.exports=window.wp.element},72:function(e,t,a){"use strict";a.r(t);var n=a(15),o=a(8),l=a(1),r=a.n(l),c=a(5),i=a(3),s=a(37);function m(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function u(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?m(Object(a),!0).forEach((function(t){p(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):m(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function p(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var b=React.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},React.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),d=a(59);Object(n.registerBlockType)(d.name,u(u({},d),{},{icon:b,apiVersion:2,edit:function(e){var t=e.attributes,a=e.setAttributes,n=e.isSelected,l=function(e){a({videoUrl:null}),a({videoUrl:e.url,aspectHeight:e.height,aspectWidth:e.width})},m=(wp.editor.mediaUpload,["video"]);return r.a.createElement("div",Object(c.useBlockProps)(),r.a.createElement(c.InspectorControls,{key:"setting"},r.a.createElement(i.Panel,{header:"Settings"},r.a.createElement(i.PanelBody,{title:"Image Object",icon:s.a,initialOpen:!0},r.a.createElement(i.PanelRow,null,r.a.createElement("span",null,"Select an image to render in your environment:")),r.a.createElement(i.PanelRow,null,r.a.createElement(c.MediaUpload,{onSelect:function(e){return l(e)},type:"image",label:"Image File",allowedTypes:m,value:t.videoUrl,render:function(e){var a=e.open;return r.a.createElement("button",{onClick:a},t.videoUrl?"Replace Image":"Select Image")}})),r.a.createElement(i.PanelRow,null,r.a.createElement(i.ToggleControl,{label:"AutoPlay",help:t.autoPlay?"Item will autoplay.":"Item will not autoplay.",checked:t.autoPlay,onChange:function(e){a({autoPlay:e})}})),r.a.createElement(i.PanelRow,null,r.a.createElement(i.TextControl,{className:"position-inputs",label:"X",value:t.positionX,onChange:function(e){a({positionX:e})}}),r.a.createElement(i.TextControl,{className:"position-inputs",label:"Y",value:t.positionY,onChange:function(e){a({positionY:e})}}),r.a.createElement(i.TextControl,{className:"position-inputs",label:"Z",value:t.positionZ,onChange:function(e){a({positionZ:e})}})),r.a.createElement(i.PanelRow,null,r.a.createElement("legend",{className:"blocks-base-control__label"},Object(o.__)("Rotation","three-object-viewer"))),r.a.createElement(i.PanelRow,null,r.a.createElement(i.TextControl,{className:"position-inputs",label:"X",value:t.rotationX,onChange:function(e){a({rotationX:e})}}),r.a.createElement(i.TextControl,{className:"position-inputs",label:"Y",value:t.rotationY,onChange:function(e){a({rotationY:e})}}),r.a.createElement(i.TextControl,{className:"position-inputs",label:"Z",value:t.rotationZ,onChange:function(e){a({rotationZ:e})}})),r.a.createElement(i.PanelRow,null,r.a.createElement("legend",{className:"blocks-base-control__label"},Object(o.__)("Scale","three-object-viewer"))),r.a.createElement(i.PanelRow,null,r.a.createElement(i.TextControl,{className:"position-inputs",label:"X",value:t.scaleX,onChange:function(e){a({scaleX:e})}}),r.a.createElement(i.TextControl,{className:"position-inputs",label:"Y",value:t.scaleY,onChange:function(e){a({scaleY:e})}}),r.a.createElement(i.TextControl,{className:"position-inputs",label:"Z",value:t.scaleZ,onChange:function(e){a({scaleZ:e})}}))))),n?r.a.createElement(r.a.Fragment,null,t.videoUrl?r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement("p",null,r.a.createElement("b",null,"Video block")))):r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement(c.MediaUpload,{onSelect:function(e){return l(e)},type:"video",allowedTypes:m,value:t.videoUrl,render:function(e){var a=e.open;return r.a.createElement("button",{className:"three-object-viewer-button",onClick:a},t.videoUrl?"Replace Object":"Select Video")}})))):r.a.createElement(r.a.Fragment,null,t.videoUrl?r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement("p",null,r.a.createElement("b",null,"Video block")))):r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement(c.MediaUpload,{onSelect:function(e){return l(e)},type:"image",allowedTypes:m,value:t.videoUrl,render:function(e){var t=e.open;return r.a.createElement("button",{className:"three-object-viewer-button",onClick:t},"Select Video")}})))))},save:function(e){var t=e.attributes;return React.createElement("div",c.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app-video-block"},React.createElement("div",{className:"video-block-url"},t.videoUrl),React.createElement("p",{className:"video-block-scaleX"},t.scaleX),React.createElement("p",{className:"video-block-scaleY"},t.scaleY),React.createElement("p",{className:"video-block-scaleZ"},t.scaleZ),React.createElement("p",{className:"video-block-positionX"},t.positionX),React.createElement("p",{className:"video-block-positionY"},t.positionY),React.createElement("p",{className:"video-block-positionZ"},t.positionZ),React.createElement("p",{className:"video-block-rotationX"},t.rotationX),React.createElement("p",{className:"video-block-rotationY"},t.rotationY),React.createElement("p",{className:"video-block-rotationZ"},t.rotationZ),React.createElement("p",{className:"video-block-aspect-height"},t.aspectHeight),React.createElement("p",{className:"video-block-aspect-width"},t.aspectWidth),React.createElement("p",{className:"video-block-autoplay"},t.autoPlay?1:0))))},deprecated:[{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"}},save:function(e){return React.createElement("div",c.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale))))}},{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"},animations:{type:"string",default:""}},save:function(e){return React.createElement("div",c.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-animations"},e.attributes.animations))))}}]}))},8:function(e,t){e.exports=window.wp.i18n}});