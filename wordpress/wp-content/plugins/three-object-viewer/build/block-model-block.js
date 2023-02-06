!function(e){var t={};function a(n){if(t[n])return t[n].exports;var l=t[n]={i:n,l:!1,exports:{}};return e[n].call(l.exports,l,l.exports,a),l.l=!0,l.exports}a.m=e,a.c=t,a.d=function(e,t,n){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)a.d(n,l,function(t){return e[t]}.bind(null,l));return n},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=96)}({1:function(e,t){e.exports=React},13:function(e,t){e.exports=window.wp.blocks},3:function(e,t){e.exports=window.wp.components},33:function(e,t,a){"use strict";var n=a(6),l=a(9);const o=Object(n.createElement)(l.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(n.createElement)(l.Path,{d:"M4 9v1.5h16V9H4zm12 5.5h4V13h-4v1.5zm-6 0h4V13h-4v1.5zm-6 0h4V13H4v1.5z"}));t.a=o},5:function(e,t){e.exports=window.wp.blockEditor},50:function(e,t){e.exports=window.wp.data},6:function(e,t){e.exports=window.wp.element},66:function(e){e.exports=JSON.parse('{"name":"three-object-viewer/model-block","title":"3D Model","description":"A 3D model for your environment","attributes":{"scaleX":{"type":"int","default":1},"name":{"type":"string"},"scaleY":{"type":"int","default":1},"scaleZ":{"type":"int","default":1},"positionX":{"type":"int","default":0},"positionY":{"type":"int","default":0},"positionZ":{"type":"int","default":0},"rotationX":{"type":"int","default":0},"rotationY":{"type":"int","default":0},"rotationZ":{"type":"int","default":0},"threeObjectUrl":{"type":"string","default":null},"animations":{"type":"string","default":""},"alt":{"type":"string","default":""},"collidable":{"type":"boolean","default":false}},"category":"design","parent":["three-object-viewer/environment"],"apiVersion":2,"supports":{"html":false,"multiple":true},"editorScript":"file:../../build/block-model-block.js","editorStyle":"file:../../build/block-model-block.css","style":"file:../../build/block-model-block.css"}')},7:function(e,t){e.exports=window.wp.i18n},9:function(e,t){e.exports=window.wp.primitives},96:function(e,t,a){"use strict";a.r(t);var n=a(13),l=a(7),o=a(1),r=a.n(o),c=a(3),i=(a(50),a(5)),s=a(33);function m(e,t){(null==t||t>e.length)&&(t=e.length);for(var a=0,n=new Array(t);a<t;a++)n[a]=e[a];return n}function u(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function p(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?u(Object(a),!0).forEach((function(t){b(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):u(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function b(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var d=React.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},React.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),f=a(66);Object(n.registerBlockType)(f.name,p(p({},f),{},{icon:d,apiVersion:2,edit:function(e){var t=e.attributes,a=e.setAttributes,n=e.isSelected,u=e.clientId,p=wp.data,b=(p.select,p.dispatch),d=wp.blocks;d.onSelectionChange,d.getSelectedBlock,Object(o.useEffect)((function(){n&&b("three-object-environment-events").setFocusEvent(u)}),[n]);var f,h,v=function(e){a({threeObjectUrl:null}),a({threeObjectUrl:e.url})},E=(f=Object(o.useState)(""),h=2,function(e){if(Array.isArray(e))return e}(f)||function(e,t){var a=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=a){var n,l,o=[],_n=!0,r=!1;try{for(a=a.call(e);!(_n=(n=a.next()).done)&&(o.push(n.value),!t||o.length!==t);_n=!0);}catch(e){r=!0,l=e}finally{try{_n||null==a.return||a.return()}finally{if(r)throw l}}return o}}(f,h)||function(e,t){if(e){if("string"==typeof e)return m(e,t);var a=Object.prototype.toString.call(e).slice(8,-1);return"Object"===a&&e.constructor&&(a=e.constructor.name),"Map"===a||"Set"===a?Array.from(e):"Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)?m(e,t):void 0}}(f,h)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()),g=(E[0],E[1],wp.editor.mediaUpload,["model/gltf-binary","application/octet-stream"]);return r.a.createElement("div",Object(i.useBlockProps)(),r.a.createElement(i.InspectorControls,{key:"setting"},r.a.createElement(c.Panel,{header:"Settings"},r.a.createElement(c.PanelBody,{title:"GLB Object",icon:s.a,initialOpen:!0},r.a.createElement(c.PanelRow,null,r.a.createElement(c.TextControl,{label:"Name",help:"Give your object a name.",value:t.name,onChange:function(e){a({name:e})}})),r.a.createElement(c.PanelRow,null,r.a.createElement("span",null,"select a glb file from your media library to render an object in the canvas:")),r.a.createElement(c.PanelRow,null,r.a.createElement(i.MediaUpload,{onSelect:function(e){return v(e)},type:"image",label:"GLB File",allowedTypes:g,value:t.threeObjectUrl,render:function(e){var a=e.open;return r.a.createElement("button",{onClick:a},t.threeObjectUrl?"Replace Object":"Select Object")}}))),r.a.createElement(c.PanelBody,{title:"Model Attributes",icon:s.a,initialOpen:!0},r.a.createElement(c.PanelRow,null,r.a.createElement(c.ToggleControl,{label:"Collidable",help:t.collidable?"Item is currently collidable.":"Item is not collidable. Users will walk through it.",checked:t.collidable,onChange:function(e){a({collidable:e})}})),r.a.createElement(c.PanelRow,null,r.a.createElement(c.TextControl,{label:"Loop Animations",help:"Separate each animation name you wish to loop with a comma",value:t.animations,onChange:function(e){a({animations:e})}})),r.a.createElement(c.PanelRow,null,r.a.createElement(c.TextareaControl,{label:"Model Alt Text",help:"Describe your model to provide context for screen readers.",value:t.alt,onChange:function(e){a({alt:e})}})),r.a.createElement(c.PanelRow,null,r.a.createElement("legend",{className:"blocks-base-control__label"},Object(l.__)("Position","three-object-viewer"))),r.a.createElement(c.PanelRow,null,r.a.createElement(c.TextControl,{className:"position-inputs",label:"X",value:t.positionX,onChange:function(e){a({positionX:e})}}),r.a.createElement(c.TextControl,{className:"position-inputs",label:"Y",value:t.positionY,onChange:function(e){a({positionY:e})}}),r.a.createElement(c.TextControl,{className:"position-inputs",label:"Z",value:t.positionZ,onChange:function(e){a({positionZ:e})}})),r.a.createElement(c.PanelRow,null,r.a.createElement("legend",{className:"blocks-base-control__label"},Object(l.__)("Rotation","three-object-viewer"))),r.a.createElement(c.PanelRow,null,r.a.createElement(c.TextControl,{className:"position-inputs",label:"X",value:t.rotationX,onChange:function(e){a({rotationX:e})}}),r.a.createElement(c.TextControl,{className:"position-inputs",label:"Y",value:t.rotationY,onChange:function(e){a({rotationY:e})}}),r.a.createElement(c.TextControl,{className:"position-inputs",label:"Z",value:t.rotationZ,onChange:function(e){a({rotationZ:e})}})),r.a.createElement(c.PanelRow,null,r.a.createElement("legend",{className:"blocks-base-control__label"},Object(l.__)("Scale","three-object-viewer"))),r.a.createElement(c.PanelRow,null,r.a.createElement(c.TextControl,{className:"position-inputs",label:"X",value:t.scaleX,onChange:function(e){a({scaleX:e})}}),r.a.createElement(c.TextControl,{className:"position-inputs",label:"Y",value:t.scaleY,onChange:function(e){a({scaleY:e})}}),r.a.createElement(c.TextControl,{className:"position-inputs",label:"Z",value:t.scaleZ,onChange:function(e){a({scaleZ:e})}}))))),n?r.a.createElement(r.a.Fragment,null,t.threeObjectUrl?r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement("p",null,r.a.createElement("b",null,"Model block")))):r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement(i.MediaUpload,{onSelect:function(e){return v(e)},type:"image",allowedTypes:g,value:t.threeObjectUrl,render:function(e){var a=e.open;return r.a.createElement("button",{className:"three-object-viewer-button",onClick:a},t.threeObjectUrl?"Replace Model":"Select Model")}})))):r.a.createElement(r.a.Fragment,null,t.threeObjectUrl?r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement("p",null,r.a.createElement("b",null,"Model block")))):r.a.createElement("div",{className:"three-object-viewer-inner"},r.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},r.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},r.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},r.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),r.a.createElement(i.MediaUpload,{onSelect:function(e){return v(e)},type:"image",allowedTypes:g,value:t.threeObjectUrl,render:function(e){var a=e.open;return r.a.createElement("button",{className:"three-object-viewer-button",onClick:a},t.threeObjectUrl?"Replace Model":"Select Model")}})))))},save:function(e){var t=e.attributes;return React.createElement("div",i.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app-model-block"},React.createElement("p",{className:"model-block-url"},t.threeObjectUrl),React.createElement("p",{className:"model-block-scale-x"},t.scaleX),React.createElement("p",{className:"model-block-scale-y"},t.scaleY),React.createElement("p",{className:"model-block-scale-z"},t.scaleZ),React.createElement("p",{className:"model-block-position-x"},t.positionX),React.createElement("p",{className:"model-block-position-y"},t.positionY),React.createElement("p",{className:"model-block-position-z"},t.positionZ),React.createElement("p",{className:"model-block-rotation-x"},t.rotationX),React.createElement("p",{className:"model-block-rotation-y"},t.rotationY),React.createElement("p",{className:"model-block-rotation-z"},t.rotationZ),React.createElement("p",{className:"model-block-animations"},t.animations),React.createElement("p",{className:"model-block-collidable"},t.collidable?1:0),React.createElement("p",{className:"model-block-alt"},t.alt))))},deprecated:[{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"}},save:function(e){return React.createElement("div",i.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale))))}},{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"},animations:{type:"string",default:""}},save:function(e){return React.createElement("div",i.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-animations"},e.attributes.animations))))}}]}))}});