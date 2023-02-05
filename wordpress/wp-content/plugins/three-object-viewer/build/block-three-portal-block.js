!function(e){var t={};function a(l){if(t[l])return t[l].exports;var n=t[l]={i:l,l:!1,exports:{}};return e[l].call(n.exports,n,n.exports,a),n.l=!0,n.exports}a.m=e,a.c=t,a.d=function(e,t,l){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(a.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var n in e)a.d(l,n,function(t){return e[t]}.bind(null,n));return l},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="",a(a.s=102)}({1:function(e,t){e.exports=React},10:function(e,t){e.exports=window.wp.primitives},102:function(e,t,a){"use strict";a.r(t);var l=a(13),n=a(7),r=a(1),o=a.n(r),c=a(3),i=a(5),s=a(33);function u(e,t){(null==t||t>e.length)&&(t=e.length);for(var a=0,l=new Array(t);a<t;a++)l[a]=e[a];return l}function m(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);t&&(l=l.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,l)}return a}function p(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?m(Object(a),!0).forEach((function(t){b(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):m(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function b(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var f=React.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},React.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},React.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),d=a(72);Object(l.registerBlockType)(d.name,p(p({},d),{},{icon:f,apiVersion:2,edit:function(e){var t=e.attributes,a=e.setAttributes,l=e.isSelected,m=e.clientId,p=wp.data,b=(p.select,p.dispatch),f=wp.blocks;f.onSelectionChange,f.getSelectedBlock,Object(r.useEffect)((function(){l&&b("three-object-environment-events").setFocusEvent(m)}),[l]);var d,h,E=function(e){a({threeObjectUrl:null}),a({threeObjectUrl:e.url})},v=(d=Object(r.useState)(""),h=2,function(e){if(Array.isArray(e))return e}(d)||function(e,t){var a=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=a){var l,n,r=[],_n=!0,o=!1;try{for(a=a.call(e);!(_n=(l=a.next()).done)&&(r.push(l.value),!t||r.length!==t);_n=!0);}catch(e){o=!0,n=e}finally{try{_n||null==a.return||a.return()}finally{if(o)throw n}}return r}}(d,h)||function(e,t){if(e){if("string"==typeof e)return u(e,t);var a=Object.prototype.toString.call(e).slice(8,-1);return"Object"===a&&e.constructor&&(a=e.constructor.name),"Map"===a||"Set"===a?Array.from(e):"Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a)?u(e,t):void 0}}(d,h)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()),g=(v[0],v[1],wp.editor.mediaUpload,["model/gltf-binary","application/octet-stream"]);return o.a.createElement("div",Object(i.useBlockProps)(),o.a.createElement(i.InspectorControls,{key:"setting"},o.a.createElement(c.Panel,{header:"Settings"},o.a.createElement(c.PanelBody,{title:"GLB Object",icon:s.a,initialOpen:!0},o.a.createElement(c.PanelRow,null,o.a.createElement("span",null,"select a glb file from your media library to render an object in the canvas:")),o.a.createElement(c.PanelRow,null,o.a.createElement(i.MediaUpload,{onSelect:function(e){return E(e)},type:"image",label:"GLB File",allowedTypes:g,value:t.threeObjectUrl,render:function(e){var a=e.open;return o.a.createElement("button",{onClick:a},t.threeObjectUrl?"Replace Object":"Select Object")}}))),o.a.createElement(c.PanelBody,{title:"Model Attributes",icon:s.a,initialOpen:!0},o.a.createElement(c.PanelRow,null,o.a.createElement(c.ToggleControl,{label:"Collidable",help:t.collidable?"Item is currently collidable.":"Item is not collidable. Users will walk through it.",checked:t.collidable,onChange:function(e){a({collidable:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{label:"Loop Animations",help:"Separate each animation name you wish to loop with a comma",value:t.animations,onChange:function(e){a({animations:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{label:"Destination URL",help:"Define a url.",value:t.destinationUrl,onChange:function(e){a({destinationUrl:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{label:"Link Label",help:"This text will describe where the link goes. If blank, will use the url as the label.",value:t.label,onChange:function(e){a({label:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement(i.ColorPalette,{value:t.labelTextColor,label:"Text Color",onChange:function(e){a({labelTextColor:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement("legend",{className:"blocks-base-control__label"},Object(n.__)("Label Offset","three-object-viewer"))),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{className:"position-inputs",label:"X Offset",value:t.labelOffsetX,onChange:function(e){a({labelOffsetX:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Y Offset",value:t.labelOffsetY,onChange:function(e){a({labelOffsetY:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Z Offset",value:t.labelOffsetZ,onChange:function(e){a({labelOffsetZ:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{className:"position-inputs",label:"X",value:t.positionX,onChange:function(e){a({positionX:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Y",value:t.positionY,onChange:function(e){a({positionY:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Z",value:t.positionZ,onChange:function(e){a({positionZ:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement("legend",{className:"blocks-base-control__label"},Object(n.__)("Rotation","three-object-viewer"))),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{className:"position-inputs",label:"X",value:t.rotationX,onChange:function(e){a({rotationX:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Y",value:t.rotationY,onChange:function(e){a({rotationY:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Z",value:t.rotationZ,onChange:function(e){a({rotationZ:e})}})),o.a.createElement(c.PanelRow,null,o.a.createElement("legend",{className:"blocks-base-control__label"},Object(n.__)("Scale","three-object-viewer"))),o.a.createElement(c.PanelRow,null,o.a.createElement(c.TextControl,{className:"position-inputs",label:"X",value:t.scaleX,onChange:function(e){a({scaleX:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Y",value:t.scaleY,onChange:function(e){a({scaleY:e})}}),o.a.createElement(c.TextControl,{className:"position-inputs",label:"Z",value:t.scaleZ,onChange:function(e){a({scaleZ:e})}}))))),l?o.a.createElement(o.a.Fragment,null,t.threeObjectUrl?o.a.createElement("div",{className:"three-object-viewer-inner"},o.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},o.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},o.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},o.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),o.a.createElement("p",null,o.a.createElement("b",null,"Portal block")))):o.a.createElement("div",{className:"three-object-viewer-inner"},o.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},o.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},o.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},o.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),o.a.createElement(i.MediaUpload,{onSelect:function(e){return E(e)},type:"image",allowedTypes:g,value:t.threeObjectUrl,render:function(e){var a=e.open;return o.a.createElement("button",{className:"three-object-viewer-button",onClick:a},t.threeObjectUrl?"Replace Object":"Select Portal")}})))):o.a.createElement(o.a.Fragment,null,t.threeObjectUrl?o.a.createElement("div",{className:"three-object-viewer-inner"},o.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},o.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},o.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},o.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),o.a.createElement("p",null,o.a.createElement("b",null,"Portal block")))):o.a.createElement("div",{className:"three-object-viewer-inner"},o.a.createElement("div",{className:"three-object-viewer-inner-edit-container"},o.a.createElement("svg",{className:"custom-icon custom-icon-cube",viewBox:"0 0 40 40",version:"1.1",xmlns:"http://www.w3.org/2000/svg"},o.a.createElement("g",{transform:"matrix(1,0,0,1,-1.1686,0.622128)"},o.a.createElement("path",{d:"M37.485,28.953L21.699,38.067L21.699,19.797L37.485,10.683L37.485,28.953ZM21.218,19.821L21.218,38.065L5.435,28.953L5.435,10.709L21.218,19.821ZM37.207,10.288L21.438,19.392L5.691,10.301L21.46,1.197L37.207,10.288Z"}))),o.a.createElement(i.MediaUpload,{onSelect:function(e){return E(e)},type:"image",allowedTypes:g,value:t.threeObjectUrl,render:function(e){var t=e.open;return o.a.createElement("button",{className:"three-object-viewer-button",onClick:t},"Select Portal")}})))))},save:function(e){var t=e.attributes;return React.createElement("div",i.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app-three-portal-block"},React.createElement("p",{className:"three-portal-block-url"},t.threeObjectUrl),React.createElement("p",{className:"three-portal-block-destination-url"},t.destinationUrl),React.createElement("p",{className:"three-portal-block-scale-x"},t.scaleX),React.createElement("p",{className:"three-portal-block-scale-y"},t.scaleY),React.createElement("p",{className:"three-portal-block-scale-z"},t.scaleZ),React.createElement("p",{className:"three-portal-block-position-x"},t.positionX),React.createElement("p",{className:"three-portal-block-position-y"},t.positionY),React.createElement("p",{className:"three-portal-block-position-z"},t.positionZ),React.createElement("p",{className:"three-portal-block-rotation-x"},t.rotationX),React.createElement("p",{className:"three-portal-block-rotation-y"},t.rotationY),React.createElement("p",{className:"three-portal-block-rotation-z"},t.rotationZ),React.createElement("p",{className:"three-portal-block-animations"},t.animations),React.createElement("p",{className:"three-portal-block-label"},t.label),React.createElement("p",{className:"three-portal-block-label-offset-x"},t.labelOffsetX),React.createElement("p",{className:"three-portal-block-label-offset-y"},t.labelOffsetY),React.createElement("p",{className:"three-portal-block-label-offset-z"},t.labelOffsetZ),React.createElement("p",{className:"three-portal-block-label-text-color"},t.labelTextColor))))},deprecated:[{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"}},save:function(e){return React.createElement("div",i.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale))))}},{attributes:{bg_color:{type:"string",default:"#FFFFFF"},zoom:{type:"integer",default:90},scale:{type:"integer",default:1},positionX:{type:"integer",default:0},positionY:{type:"integer",default:0},rotationY:{type:"integer",default:0},threeObjectUrl:{type:"string",default:null},hasZoom:{type:"bool",default:!1},hasTip:{type:"bool",default:!0},deviceTarget:{type:"string",default:"2d"},animations:{type:"string",default:""}},save:function(e){return React.createElement("div",i.useBlockProps.save(),React.createElement(React.Fragment,null,React.createElement("div",{className:"three-object-three-app"},React.createElement("p",{className:"three-object-block-device-target"},e.attributes.deviceTarget),React.createElement("p",{className:"three-object-block-url"},e.attributes.threeObjectUrl),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-background-color"},e.attributes.bg_color),React.createElement("p",{className:"three-object-zoom"},e.attributes.zoom),React.createElement("p",{className:"three-object-has-zoom"},e.attributes.hasZoom?1:0),React.createElement("p",{className:"three-object-has-tip"},e.attributes.hasTip?1:0),React.createElement("p",{className:"three-object-position-y"},e.attributes.positionY),React.createElement("p",{className:"three-object-rotation-y"},e.attributes.rotationY),React.createElement("p",{className:"three-object-scale"},e.attributes.scale),React.createElement("p",{className:"three-object-animations"},e.attributes.animations))))}}]}))},13:function(e,t){e.exports=window.wp.blocks},3:function(e,t){e.exports=window.wp.components},33:function(e,t,a){"use strict";var l=a(6),n=a(10);const r=Object(l.createElement)(n.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},Object(l.createElement)(n.Path,{d:"M4 9v1.5h16V9H4zm12 5.5h4V13h-4v1.5zm-6 0h4V13h-4v1.5zm-6 0h4V13H4v1.5z"}));t.a=r},5:function(e,t){e.exports=window.wp.blockEditor},6:function(e,t){e.exports=window.wp.element},7:function(e,t){e.exports=window.wp.i18n},72:function(e){e.exports=JSON.parse('{"name":"three-object-viewer/three-portal-block","title":"3D Portal","description":"A 3D portal","attributes":{"scaleX":{"type":"int","default":1},"scaleY":{"type":"int","default":1},"scaleZ":{"type":"int","default":1},"positionX":{"type":"int","default":0},"positionY":{"type":"int","default":0},"positionZ":{"type":"int","default":0},"rotationX":{"type":"int","default":0},"rotationY":{"type":"int","default":0},"rotationZ":{"type":"int","default":0},"threeObjectUrl":{"type":"string","default":null},"destinationUrl":{"type":"string","default":null},"label":{"type":"string","default":null},"labelTextColor":{"type":"string","default":"0x000000"},"labelOffsetX":{"type":"int","default":0},"labelOffsetY":{"type":"int","default":0},"labelOffsetZ":{"type":"int","default":0},"animations":{"type":"string","default":""},"collidable":{"type":"boolean","default":false}},"category":"design","parent":["three-object-viewer/environment"],"apiVersion":2,"supports":{"html":false,"multiple":true},"editorScript":"file:../../build/block-three-portal-block.js","editorStyle":"file:../../build/block-three-portal-block.css","style":"file:../../build/block-three-portal-block.css"}')}});