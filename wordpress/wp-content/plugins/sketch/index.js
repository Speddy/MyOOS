!function(e){var t={};function r(n){if(t[n])return t[n].exports;var o=t[n]={i:n,l:!1,exports:{}};return e[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=e,r.c=t,r.d=function(e,t,n){r.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.t=function(e,t){if(1&t&&(e=r(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)r.d(n,o,function(t){return e[t]}.bind(null,o));return n},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,"a",t),t},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.p="",r(r.s=18)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.i18n},function(e,t,r){var n=r(15),o=r(16),i=r(9),c=r(17);e.exports=function(e,t){return n(e)||o(e,t)||i(e,t)||c()},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=window.wp.blockEditor},function(e,t,r){var n=r(12),o=r(13),i=r(9),c=r(14);e.exports=function(e){return n(e)||o(e)||i(e)||c()},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t,r){return t in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=window.wp.primitives},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,r){var n=r(8);e.exports=function(e,t){if(e){if("string"==typeof e)return n(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?n(e,t):void 0}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e){e.exports=JSON.parse('{"attributes":{"strokes":[{"stroke":[[27.482510480169168,269.2003520059833],[27.811075383697677,252.62326943956776],[31.080371494015886,227.3132596630533],[37.295496307526236,196.14562127965496],[46.36859655542409,161.2577201240715],[57.77517240525262,126.1183354835261],[70.86213301432315,94.43405266954574],[83.87765643562746,68.68380571970928],[95.00414909425274,50.162807264328386],[103.36069718845093,38.83564535906072],[113.16469089813955,30.33880521910722],[114.80509822090353,29.787735946126837],[116.4561260143661,30.306118771281106],[117.48713777779531,31.69594907454529],[117.50432206036216,33.42635891866704],[118.00121777590826,39.14041246589355],[117.6110745868549,56.17705323201762],[113.9792842595852,77.56791883546319],[109.77568789832425,101.2815054616511],[106.1787175258647,123.93597409112598],[103.8258569249021,143.7488269897935],[102.55888519855968,160.31684931879],[102.08527515251409,172.17672192770883],[101.26189611484746,178.42391856341513],[103.1530945641885,175.5777665599411],[111.3495440108561,163.95984459256618],[120.40971737765034,150.08916438340054],[130.23500124909796,135.38177854509578],[139.38660580090695,123.22963797505226],[147.43621761284805,115.61277778124884],[154.4101284483585,112.77304678464483],[160.48967509300073,115.59328705834821],[163.50842225064653,124.16452002868009],[164.60544015473246,135.67065711382133],[165.5495102607029,146.5118158465516],[167.8986938716579,154.9252637455598],[175.15136764486354,157.00661551514688],[186.35394540159172,151.62742567449033],[196.72646656160268,144.58863660581187],[207.44049290347877,137.18220833711305],[217.40753446509254,130.94747987360358],[225.85774696809756,127.34141007370778],[233.7543040216643,126.6536494931764],[241.7995321270776,129.24438651864313],[248.1130277673329,133.03422026554998],[256.36642731473967,131.25231804959895],[270.08230409300563,117.89968537440078],[272.82589368447833,116.57314244738527],[275.8252266586026,117.11258817587262],[277.93465976284125,119.31197262666663],[278.34846124836935,122.33120569389202],[279.81909480872537,126.11214492858664],[286.22039750758796,134.73582934628854],[296.3139019853286,139.09094063207345],[309.8799496583604,139.11308386318004],[313.195930442018,141.32219135385486],[313.35780954118025,145.30335696460216],[310.23212905180657,147.77439033978973],[306.39579216257994,146.69809868075797],[305.01158815932763,142.96180857688182],[307.2206956500025,139.64582779322419],[311.20186126074975,139.48394869406195],[313.6728946359373,142.60962918343563],[312.59660297690556,146.44596607266226],[308.86031287302944,147.83017007591454],[293.7719717966829,147.8778863696637],[283.1674451064291,144.8069734891689],[275.4469258910661,138.77350685777046],[271.2585764431361,129.44450293829942],[271.837348534186,119.90253357417292],[272.8258936844784,116.57314244738527],[275.8252266586026,117.11258817587262],[277.93465976284125,119.31197262666663],[278.34846124836935,122.33120569389202],[276.9085730123103,125.01704296582625],[271.09766941647365,130.37662827821973],[264.8630791920111,136.33937034592464],[256.7608589712613,142.3514474312006],[248.82507550325954,144.02330004448982],[241.7098324523355,140.77014956278578],[236.11278280121985,135.3477694652123],[229.2160507203762,134.11178364958923],[220.91133479175065,136.82008288484934],[211.40982511476966,142.69795901876137],[201.04104815372648,150.50847634318654],[190.60942717261938,158.63154218950544],[179.9322886167563,165.12902943096165],[170.04260282580074,166.57911075346885],[163.15905897175116,163.3647453825724],[159.5340073028416,156.53506699226435],[158.00827785349242,147.22114286708367],[156.96532814978838,136.36723278920607],[155.39358669877592,122.81394963464497],[151.08388241912016,119.77962515551144],[143.79111355110732,126.65236343400774],[134.9055836896068,138.47022521239754],[125.38184245889569,153.09951230324836],[117.01128221993326,167.87662657183094],[106.63920388631331,180.55441927308937],[98.51111508872103,180.3216251381348],[96.4900496643839,171.9693155824358],[96.97531431316833,159.90591737492895],[98.26534177303924,143.09521752679024],[100.64781233531221,123.06481128643078],[104.26172506481416,100.30392221183364],[108.45381697545054,76.65988829382947],[111.79386203990705,55.930432446096155],[112.82029302517655,41.475570385076104],[114.05582745474565,32.52657490353667],[114.80509822090353,29.787735946126833],[116.4561260143661,30.306118771281103],[117.48713777779531,31.69594907454529],[117.50432206036216,33.42635891866705],[116.5011150501984,34.83639055765927],[107.80581880223335,42.226456288808265],[99.77322688090533,53.08613046332224],[88.86201283146072,71.23002822069239],[76.02698503124532,96.5861711715254],[63.095809049596625,127.85226142599691],[51.78735399084056,162.66387163465652],[42.78703848251283,197.22862341028645],[36.639721279421614,227.93472617679046],[34.02583867880232,252.62135946668224],[33.66592701983083,267.7019917440167],[35.09170826983083,275.2508198690167],[34.94160156424523,277.2111610675837],[33.66790304247781,278.70887990418436],[31.757122248423222,279.1718986888281],[29.939112500359812,278.4233599832108],[28.908291730169168,276.7491801309833]],"color":"#000"}]}}')},function(e,t){e.exports=window.wp.blocks},function(e,t,r){var n=r(8);e.exports=function(e){if(Array.isArray(e))return n(e)},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e){if(Array.isArray(e))return e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){var r=e&&("undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"]);if(null!=r){var n,o,i=[],_n=!0,c=!1;try{for(r=r.call(e);!(_n=(n=r.next()).done)&&(i.push(n.value),!t||i.length!==t);_n=!0);}catch(e){c=!0,o=e}finally{try{_n||null==r.return||r.return()}finally{if(c)throw o}}return i}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,r){"use strict";r.r(t);var n=r(5),o=r.n(n),i=r(6),c=r.n(i),u=r(3),s=r.n(u),a=r(0);function l(e,t){return[e[0]+t[0],e[1]+t[1]]}function p(e,t){return[e[0]-t[0],e[1]-t[1]]}function f(e,t){return[t[0]-e[0],t[1]-e[1]]}function h(e,t){return[e[0]*t,e[1]*t]}function v(e){return[e[1],-e[0]]}function b(e,t){return e[0]*t[0]+e[1]*t[1]}function d(e,t){return function(e){return e[0]*e[0]+e[1]*e[1]}(p(e,t))}function m(e){return function(e,t){return[e[0]/t,e[1]/t]}(e,function(e){return Math.hypot(e[0],e[1])}(e))}function g(e,t){return Math.hypot(e[1]-t[1],e[0]-t[0])}function O(e,t,r){var n=Math.sin(r),o=Math.cos(r),i=e[0]-t[0],c=e[1]-t[1],u=i*n+c*o;return[i*o-c*n+t[0],u+t[1]]}function y(e,t,r){return l(e,h(f(e,t),r))}function j(e,t){return e[0]===t[0]&&e[1]===t[1]}function x(e,t,r){return e*(1-r)+t*r}function w(e,t,r){return Math.max(t,Math.min(r,e))}function k(e,t,r,n){return void 0===n&&(n=.5),t?(n=w(r(n),0,1),(t<0?x(e,e+e*w(t,-.95,-.05),n):x(e-e*w(t,.05,.95),e,n))/2):e/2}var P=Math.min,E=Math.PI;var _=function(e,t){return void 0===t&&(t={}),function(e,t){void 0===t&&(t={});var r=t,n=r.size,o=void 0===n?8:n,i=r.thinning,c=void 0===i?.5:i,u=r.smoothing,s=void 0===u?.5:u,a=r.simulatePressure,x=void 0===a||a,w=r.easing,_=void 0===w?function(e){return e}:w,C=r.start,S=void 0===C?{}:C,M=r.end,A=void 0===M?{}:M,B=r.last,D=void 0!==B&&B,I=t.streamline,z=void 0===I?.5:I;z/=2;var L=S.taper,R=void 0===L?0:L,T=S.easing,V=void 0===T?function(e){return e*(2-e)}:T,G=A.taper,H=void 0===G?0:G,N=A.easing,U=void 0===N?function(e){return--e*e*e+1}:N,X=e.length;if(0===X)return[];for(var Y=e[X-1].runningLength,Z=[],q=[],J=e.slice(0,5).reduce((function(e,t){return(e+t.pressure)/2}),e[0].pressure),K=k(o,c,_,e[X-1].pressure),Q=e[0].vector,W=e[0].point,$=W,F=W,ee=$,te=1;te<X-1;te++){var re=e[te],ne=re.point,oe=re.pressure,ie=re.vector,ce=re.distance,ue=re.runningLength;if(c){if(x){var se=P(1,1-ce/o),ae=P(1,ce/o);oe=P(1,J+ae/2*(se-J))}K=k(o,c,_,oe)}else K=o/2;var le=ue<R?V(ue/R):1,pe=Y-ue<H?U((Y-ue)/H):1;K*=Math.min(le,pe);var fe=e[te+1].vector,he=b(ie,fe);if(he<0){for(var ve=h(v(Q),K),be=0;be<1;be+=.2)ee=O(l(ne,ve),ne,E*-be),F=O(p(ne,ve),ne,E*be),q.push(ee),Z.push(F);W=F,$=ee}else{var de=h(v(y(fe,ie,he)),K);F=p(ne,de),ee=l(ne,de);var me=1===te||he<.25,ge=Math.pow((ue>o?o:o/2)*s,2);(me||d(W,F)>ge)&&(Z.push(y(W,F,z)),W=F),(me||d($,ee)>ge)&&(q.push(y($,ee,z)),$=ee),J=oe,Q=ie}}var Oe=e[0],ye=e[X-1],je=q.length<2||Z.length<2;if(je&&(!R&&!H||D)){for(var xe=0,we=0;we<X;we++){var ke=e[we],Pe=ke.pressure;if(ke.runningLength>o){xe=k(o,c,_,Pe);break}}for(var Ee=p(Oe.point,h(v(m(f(ye.point,Oe.point))),xe||K)),_e=[],Ce=0;Ce<=1;Ce+=.1)_e.push(O(Ee,Oe.point,2*E*Ce));return _e}var Se=[];if(!(R||H&&je)){ee=q[1];for(var Me=1;Me<Z.length;Me++)if(!j(ee,Z[Me])){F=Z[Me];break}if(!j(ee,F)){for(var Ae=p(Oe.point,h(m(f(ee,F)),g(ee,F)/2)),Be=0;Be<=1;Be+=.2)Se.push(O(Ae,Oe.point,E*Be));Z.shift(),q.shift()}}var De=[];if(H||R&&je)De.push(ye.point);else for(var Ie=p(ye.point,h(v(ye.vector),K)),ze=0;ze<=1;ze+=.1)De.push(O(Ie,ye.point,3*E*ze));return Z.concat(De,q.reverse(),Se)}(function(e,t){void 0===t&&(t={});var r=t,n=r.simulatePressure,o=void 0===n||n,i=r.streamline,c=void 0===i?.5:i,u=r.size,s=void 0===u?8:u;c/=2,o||(c/=2);var a=function(e){return Array.isArray(e[0])?e.map((function(e){var t=e[0],r=e[1],n=e[2];return[t,r,void 0===n?.5:n]})):e.map((function(e){var t=e.x,r=e.y,n=e.pressure;return[t,r,void 0===n?.5:n]}))}(e),p=a.length;if(0===p)return[];1===p&&a.push(l(a[0],[1,0]));for(var h=[{point:[a[0][0],a[0][1]],pressure:a[0][2],vector:[0,0],distance:0,runningLength:0}],v=1,d=0,O=a[v],x=h[d];v<p;O=a[++v],x=h[d]){var w=y(x.point,O,1-c);if(!j(x.point,w)){var k=O[2],P=m(f(w,x.point)),E=g(w,x.point),_=x.runningLength+E;h.push({point:w,pressure:k,vector:P,distance:E,runningLength:_}),d+=1}}for(var C=h[(p=h.length)-1].runningLength,S=p-2;S>1;S--){var M=h[S],A=M.runningLength,B=M.vector,D=b(h[S-1].vector,h[S].vector);if(C-A>s/2||D<.8){for(var I=S;I<p;I++)h[I].vector=B;break}}return h}(e,t),t)},C=[{size:3,thinning:.3,smoothing:.83,streamline:.45},{size:14,thinning:.6,smoothing:.5,streamline:.75},{size:25,thinning:.5,smoothing:.5,streamline:.6}];function S(e){if(0===e.length)return"";var t=e.reduce((function(e,t,r,n){var o=s()(t,2),i=o[0],c=o[1],u=s()(n[(r+1)%n.length],2),a=u[0],l=u[1];return e.push(i,c,(i+a)/2,(c+l)/2),e}),["M"].concat(o()(e[0]),["Q"]));return t.push("Z"),t.join(" ")}function M(e,t){return e.length<3?_([].concat(o()(e),[[e[0][0],e[0][1]+1,e[0][2]]]),t):_(e,t)}var A=r(1),B=function(e){var t=e.color;return Object(a.createElement)(A.SVG,{width:"24",height:"24",viewBox:"0 0 16 16",fill:"none"},Object(a.createElement)(A.Circle,{cx:"8",cy:"8",r:"6",style:{fill:t,filter:"brightness(0.8)"}}),Object(a.createElement)(A.Circle,{cx:"8",cy:"8",r:"5.5",style:{fill:t}}))},D=function(){return Object(a.createElement)(A.SVG,{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none"},Object(a.createElement)(A.Rect,{x:"9",y:"5",width:"6",height:"2",rx:"1"}),Object(a.createElement)(A.Rect,{x:"7",y:"10",width:"10",height:"3",rx:"1.5"}),Object(a.createElement)(A.Rect,{x:"5",y:"16",width:"14",height:"4",rx:"2"}))},I=function(e){var t=e.radius,r=void 0===t?8:t;return Object(a.createElement)(A.SVG,{width:"24",height:"24",viewBox:"0 0 16 16",fill:"none"},Object(a.createElement)(A.Circle,{cx:"8",cy:"8",r:r}))},z=r(4),L=r(2),R=r(7),T=Object(a.createElement)(R.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},Object(a.createElement)(R.Path,{d:"M20 5h-5.7c0-1.3-1-2.3-2.3-2.3S9.7 3.7 9.7 5H4v2h1.5v.3l1.7 11.1c.1 1 1 1.7 2 1.7h5.7c1 0 1.8-.7 2-1.7l1.7-11.1V7H20V5zm-3.2 2l-1.7 11.1c0 .1-.1.2-.3.2H9.1c-.1 0-.3-.1-.3-.2L7.2 7h9.6z"}));function V(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function G(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?V(Object(r),!0).forEach((function(t){c()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):V(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var H=[{value:0,icon:Object(a.createElement)(A.Icon,{icon:Object(a.createElement)(I,{radius:"2"}),type:"svg"})},{value:1,icon:Object(a.createElement)(A.Icon,{icon:Object(a.createElement)(I,{radius:"4"}),type:"svg"})},{value:2,icon:Object(a.createElement)(A.Icon,{icon:Object(a.createElement)(I,{radius:"7"}),type:"svg"})}],N=function(e){var t=e.clear,r=e.color,n=e.setColor,o=e.preset,i=e.setPreset,c=e.isEmpty,u=Object(z.useSetting)("color.palette")||[];return Object(a.createElement)(z.BlockControls,{group:"block"},Object(a.createElement)(A.ToolbarDropdownMenu,{isCollapsed:!0,popoverProps:{className:"wp-block-a8c-sketch__brush-style-popover",isAlternate:!0},icon:Object(a.createElement)(A.Icon,{icon:D}),label:Object(L.__)("Brush","sketch"),controls:H.map((function(e){return G(G({},e),{},{isActive:e.value===o,onClick:function(){e.value!==o&&i(e.value)}})}))}),Object(a.createElement)(A.ToolbarDropdownMenu,{isCollapsed:!0,popoverProps:{isAlternate:!0},icon:Object(a.createElement)(A.Icon,{icon:Object(a.createElement)(B,{color:r})}),label:Object(L.__)("Color","sketch")},(function(){return Object(a.createElement)(A.ColorPalette,{clearable:!1,colors:u,color:r,disableCustomColors:!0,onChange:n})})),Object(a.createElement)(A.ToolbarButton,{icon:T,onClick:t,label:Object(L.__)("Clear canvas","sketch"),disabled:c}))};function U(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function X(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?U(Object(r),!0).forEach((function(t){c()(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):U(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}var Y=function(e){var t=e.currentStroke,r=e.strokes,n=e.handlePointerDown,o=e.handlePointerMove,i=e.handlePointerUp;return Object(a.createElement)("svg",{onPointerDown:n,onPointerMove:o,onPointerUp:i,style:{touchAction:"none"}},r.map((function(e,t){return Object(a.createElement)(Z,{key:t,stroke:e})})),t&&Object(a.createElement)(Z,{stroke:t}))},Z=function(e){var t,r=e.stroke,n=null!==(t=r.color)&&void 0!==t?t:"#f00";return Object(a.createElement)("path",{fill:n,d:S(r.stroke)})},q=r(10),J=r(11),K={apiVersion:2,icon:function(){return Object(a.createElement)(A.SVG,{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"none"},Object(a.createElement)(A.Path,{d:"M20.497 10.7067C20.4631 9.68723 20.1568 8.71859 19.6833 7.80626C19.2732 7.02257 18.7279 6.30373 18.0796 5.70093C17.4411 5.10396 16.7082 4.61763 15.91 4.25942C15.4973 4.07545 15.0734 3.92555 14.6315 3.82288C14.2873 3.74208 13.9391 3.67871 13.5905 3.63355C12.6822 3.52154 11.7485 3.57221 10.8548 3.77094C10.0878 3.94316 9.34771 4.2239 8.6621 4.6047C7.97649 4.98549 7.34533 5.46634 6.79847 6.0283C6.1934 6.65408 5.68502 7.37108 5.31791 8.15999C5.02315 8.78942 4.80037 9.45694 4.68294 10.1444C4.5667 10.8102 4.52017 11.4916 4.57748 12.1669C4.61314 12.5959 4.67554 13.0198 4.77862 13.4419C4.87978 13.8562 5.01543 14.2636 5.18017 14.6556C5.51041 15.4361 5.9624 16.1633 6.52146 16.8046C7.09135 17.4631 7.77413 18.026 8.52493 18.4651C9.30824 18.9225 10.1759 19.2487 11.0681 19.4157C11.9388 19.5815 12.9653 19.6591 13.8434 19.5301C14.9633 19.3655 16.2722 18.2885 14.4177 18.7277C13.9781 18.8318 13.233 18.8269 12.489 18.7142C9.66796 18.287 8.0557 16.9947 6.8022 14.3656C5.73816 11.1547 6.86245 7.72506 9.63649 6.2899C11.6443 5.25114 13.6007 5.41855 15.3336 6.83164C17.0666 8.24474 17.0046 10.6168 18.1781 11.8151C18.579 12.3125 19.7478 12.4218 20.239 11.7645C20.4733 11.451 20.5089 11.0681 20.497 10.7067Z",strokeWidth:".5"}))},attributes:{strokes:{type:"array",default:[]},height:{type:"number",default:450}},supports:{align:!0},title:Object(L.__)("Sketch","a8c-sketch"),category:"widgets",description:Object(L._x)("“Not a day without a line drawn.” — Apelles of Kos","Block description, based on a quote","a8c-sketch"),keywords:[Object(L.__)("Draw","a8c-sketch")],edit:function(e){var t=e.attributes,r=e.isSelected,n=e.setAttributes,i=t.strokes,c=t.height,u=Object(a.useState)(),l=s()(u,2),p=l[0],f=l[1],h=Object(a.useState)(1),v=s()(h,2),b=v[0],d=v[1],m=Object(a.useState)(!1),g=s()(m,2),O=g[0],y=g[1],j=Object(a.useState)("#000"),x=s()(j,2),w=x[0],k=x[1],P=Object(a.useRef)(null),E=Object(z.useBlockProps)({className:"wp-block-a8c-sketch",ref:P}),_=p&&{stroke:M(p.points,X(X({},C[b]),{},{simulatePressure:"pen"!==p.type})),color:w};return Object(a.createElement)(A.ResizableBox,{size:{height:c},minHeight:200,enable:{top:!1,right:!1,bottom:!0,left:!1,topRight:!1,bottomRight:!1,bottomLeft:!1,topLeft:!1},onResizeStart:function(){y(!0)},onResizeStop:function(e,t,r,o){var i=Math.min(parseInt(c+o.height,10),1e3);n({height:i}),y(!1)},showHandle:r,__experimentalShowTooltip:!0,__experimentalTooltipProps:{axis:"y",position:"bottom",isVisible:O}},Object(a.createElement)(N,{clear:function(){return n({strokes:[],height:450})},color:w,setColor:k,preset:b,setPreset:d,isEmpty:!i.length}),Object(a.createElement)("figure",E,Object(a.createElement)(Y,{handlePointerDown:function(e){var t=P.current.getBoundingClientRect(),n=t.left,o=t.top;r&&f({type:e.pointerType,points:[[e.clientX-n,e.clientY-o,e.pressure]]})},handlePointerMove:function(e){var t=P.current.getBoundingClientRect(),n=t.left,i=t.top;r&&p&&1===e.buttons&&f(X(X({},p),{},{points:[].concat(o()(p.points),[[e.clientX-n,e.clientY-i,e.pressure]])}))},handlePointerUp:function(){r&&p&&(n({strokes:[].concat(o()(i),[{stroke:M(p.points,X(X({},C[b]),{},{simulatePressure:"pen"!==p.type})),color:w}])}),f(void 0))},strokes:i,currentStroke:_})))},save:function(){var e=z.useBlockProps.save();return Object(a.createElement)("figure",e)},example:q};Object(J.registerBlockType)("a8c/sketch",K)}]);