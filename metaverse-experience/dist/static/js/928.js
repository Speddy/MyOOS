(self.webpackChunkmetaverse_experience=self.webpackChunkmetaverse_experience||[]).push([[928],{7928:(t,e,s)=>{if("undefined"==typeof AFRAME)throw new Error("Component attempted to register before AFRAME was available.");s(2040),s(2585),s(6832),s(4336),s(1708),s(711),s(9514),s(4921),AFRAME.registerComponent("super-hands",{schema:{colliderEvent:{default:"hit"},colliderEventProperty:{default:"el"},colliderEndEvent:{default:"hitend"},colliderEndEventProperty:{default:"el"},grabStartButtons:{default:["gripdown","trackpaddown","triggerdown","gripclose","abuttondown","bbuttondown","xbuttondown","ybuttondown","pointup","thumbup","pointingstart","pistolstart","thumbstickdown","mousedown","touchstart"]},grabEndButtons:{default:["gripup","trackpadup","triggerup","gripopen","abuttonup","bbuttonup","xbuttonup","ybuttonup","pointdown","thumbdown","pointingend","pistolend","thumbstickup","mouseup","touchend"]},stretchStartButtons:{default:["gripdown","trackpaddown","triggerdown","gripclose","abuttondown","bbuttondown","xbuttondown","ybuttondown","pointup","thumbup","pointingstart","pistolstart","thumbstickdown","mousedown","touchstart"]},stretchEndButtons:{default:["gripup","trackpadup","triggerup","gripopen","abuttonup","bbuttonup","xbuttonup","ybuttonup","pointdown","thumbdown","pointingend","pistolend","thumbstickup","mouseup","touchend"]},dragDropStartButtons:{default:["gripdown","trackpaddown","triggerdown","gripclose","abuttondown","bbuttondown","xbuttondown","ybuttondown","pointup","thumbup","pointingstart","pistolstart","thumbstickdown","mousedown","touchstart"]},dragDropEndButtons:{default:["gripup","trackpadup","triggerup","gripopen","abuttonup","bbuttonup","xbuttonup","ybuttonup","pointdown","thumbdown","pointingend","pistolend","thumbstickup","mouseup","touchend"]},interval:{default:0}},multiple:!1,init:function(){this.HOVER_EVENT="hover-start",this.UNHOVER_EVENT="hover-end",this.GRAB_EVENT="grab-start",this.UNGRAB_EVENT="grab-end",this.STRETCH_EVENT="stretch-start",this.UNSTRETCH_EVENT="stretch-end",this.DRAG_EVENT="drag-start",this.UNDRAG_EVENT="drag-end",this.DRAGOVER_EVENT="dragover-start",this.UNDRAGOVER_EVENT="dragover-end",this.DRAGDROP_EVENT="drag-drop",this.otherSuperHand=null,this.gehDragged=new Set,this.gehClicking=new Set,this.hoverEls=[],this.hoverElsIntersections=[],this.prevCheckTime=null,this.state=new Map,this.dragging=!1,this.unHover=this.unHover.bind(this),this.unWatch=this.unWatch.bind(this),this.onHit=this.onHit.bind(this),this.onGrabStartButton=this.onGrabStartButton.bind(this),this.onGrabEndButton=this.onGrabEndButton.bind(this),this.onStretchStartButton=this.onStretchStartButton.bind(this),this.onStretchEndButton=this.onStretchEndButton.bind(this),this.onDragDropStartButton=this.onDragDropStartButton.bind(this),this.onDragDropEndButton=this.onDragDropEndButton.bind(this),this.system.registerMe(this)},update:function(t){this.unRegisterListeners(t),this.registerListeners()},remove:function(){this.system.unregisterMe(this),this.unRegisterListeners(),this.hoverEls.length=0,this.state.get(this.HOVER_EVENT)&&this._unHover(this.state.get(this.HOVER_EVENT)),this.onGrabEndButton(),this.onStretchEndButton(),this.onDragDropEndButton()},tick:function(){function t(t,e){const s=null==t.distance?-1:t.distance,i=null==e.distance?-1:e.distance;return s<i?1:i<s?-1:0}return function(e){const s=this.data,i=this.prevCheckTime;if(i&&e-i<s.interval)return;this.prevCheckTime=e;let n=!1;this.hoverElsIntersections.sort(t);for(let t=0;t<this.hoverElsIntersections.length;t++)this.hoverEls[t]!==this.hoverElsIntersections[t].object.el&&(n=!0,this.hoverEls[t]=this.hoverElsIntersections[t].object.el);n&&this.hover()}}(),onGrabStartButton:function(t){let e=this.state.get(this.GRAB_EVENT);this.dispatchMouseEventAll("mousedown",this.el),this.gehClicking=new Set(this.hoverEls),e||(e=this.findTarget(this.GRAB_EVENT,{hand:this.el,buttonEvent:t}),e&&(this.state.set(this.GRAB_EVENT,e),this._unHover(e)))},onGrabEndButton:function(t){const e=this.hoverEls.filter((t=>this.gehClicking.has(t))),s=this.state.get(this.GRAB_EVENT),i={hand:this.el,buttonEvent:t};this.dispatchMouseEventAll("mouseup",this.el);for(let t=0;t<e.length;t++)this.dispatchMouseEvent(e[t],"click",this.el);this.gehClicking.clear(),s&&!this.emitCancelable(s,this.UNGRAB_EVENT,i)&&(this.promoteHoveredEl(this.state.get(this.GRAB_EVENT)),this.state.delete(this.GRAB_EVENT),this.hover())},onStretchStartButton:function(t){let e=this.state.get(this.STRETCH_EVENT);e||(e=this.findTarget(this.STRETCH_EVENT,{hand:this.el,buttonEvent:t}),e&&(this.state.set(this.STRETCH_EVENT,e),this._unHover(e)))},onStretchEndButton:function(t){const e=this.state.get(this.STRETCH_EVENT),s={hand:this.el,buttonEvent:t};e&&!this.emitCancelable(e,this.UNSTRETCH_EVENT,s)&&(this.promoteHoveredEl(e),this.state.delete(this.STRETCH_EVENT),this.hover())},onDragDropStartButton:function(t){let e=this.state.get(this.DRAG_EVENT);this.dragging=!0,this.hoverEls.length&&(this.gehDragged=new Set(this.hoverEls),this.dispatchMouseEventAll("dragstart",this.el)),e||(e=this.state.get(this.GRAB_EVENT)&&!this.emitCancelable(this.state.get(this.GRAB_EVENT),this.DRAG_EVENT,{hand:this.el,buttonEvent:t})?this.state.get(this.GRAB_EVENT):this.findTarget(this.DRAG_EVENT,{hand:this.el,buttonEvent:t}),e&&(this.state.set(this.DRAG_EVENT,e),this._unHover(e)))},onDragDropEndButton:function(t){const e=this.state.get(this.DRAG_EVENT);if(this.dragging=!1,this.gehDragged.forEach((t=>{this.dispatchMouseEvent(t,"dragend",this.el),this.dispatchMouseEventAll("drop",t,!0,!0),this.dispatchMouseEventAll("dragleave",t,!0,!0)})),this.gehDragged.clear(),e){const s={hand:this.el,dropped:e,on:null,buttonEvent:t},i={hand:this.el,buttonEvent:t},n=this.findTarget(this.DRAGDROP_EVENT,s,!0);n&&(s.on=n,this.emitCancelable(e,this.DRAGDROP_EVENT,s),this._unHover(n)),this.emitCancelable(e,this.UNDRAG_EVENT,i)||(this.promoteHoveredEl(e),this.state.delete(this.DRAG_EVENT),this.hover())}},processHitEl:function(t,e){const s=e&&e.distance,i=this.hoverElsIntersections,n=this.hoverEls;let h=!1;if(-1===this.hoverEls.indexOf(t)){if(h=!0,null!=s){let h=0;for(;h<i.length&&s<i[h].distance;)h++;n.splice(h,0,t),i.splice(h,0,e)}else n.push(t),i.push({object:{el:t}});this.dispatchMouseEvent(t,"mouseover",this.el),this.dragging&&this.gehDragged.size&&this.gehDragged.forEach((t=>{this.dispatchMouseEventAll("dragenter",t,!0,!0)}))}return h},onHit:function(t){const e=t.detail[this.data.colliderEventProperty];let s=0;if(e){if(Array.isArray(e))for(let i,n=0;n<e.length;n++)i=t.detail.intersections&&t.detail.intersections[n],s+=this.processHitEl(e[n],i);else s+=this.processHitEl(e,null);s&&this.hover()}},hover:function(){let t,e;this.state.has(this.HOVER_EVENT)&&this._unHover(this.state.get(this.HOVER_EVENT),!0),this.state.has(this.DRAGOVER_EVENT)&&this._unHover(this.state.get(this.DRAGOVER_EVENT),!0),this.dragging&&this.state.get(this.DRAG_EVENT)&&(t={hand:this.el,hovered:e,carried:this.state.get(this.DRAG_EVENT)},e=this.findTarget(this.DRAGOVER_EVENT,t,!0),e&&(this.emitCancelable(this.state.get(this.DRAG_EVENT),this.DRAGOVER_EVENT,t),this.state.set(this.DRAGOVER_EVENT,e))),this.state.has(this.DRAGOVER_EVENT)||(e=this.findTarget(this.HOVER_EVENT,{hand:this.el},!0),e&&this.state.set(this.HOVER_EVENT,e))},unHover:function(t){const e=t.detail[this.data.colliderEndEventProperty];e&&(Array.isArray(e)?e.forEach((t=>this._unHover(t))):this._unHover(e))},_unHover:function(t,e){let s,i=!1;t===this.state.get(this.DRAGOVER_EVENT)&&(this.state.delete(this.DRAGOVER_EVENT),i=!0,s={hand:this.el,hovered:t,carried:this.state.get(this.DRAG_EVENT)},this.emitCancelable(t,this.UNDRAGOVER_EVENT,s),this.state.has(this.DRAG_EVENT)&&this.emitCancelable(this.state.get(this.DRAG_EVENT),this.UNDRAGOVER_EVENT,s)),t===this.state.get(this.HOVER_EVENT)&&(this.state.delete(this.HOVER_EVENT),i=!0,this.emitCancelable(t,this.UNHOVER_EVENT,{hand:this.el})),i&&!e&&this.hover()},unWatch:function(t){const e=t.detail[this.data.colliderEndEventProperty];e&&(Array.isArray(e)?e.forEach((t=>this._unWatch(t))):this._unWatch(e))},_unWatch:function(t){const e=this.hoverEls.indexOf(t);-1!==e&&(this.hoverEls.splice(e,1),this.hoverElsIntersections.splice(e,1)),this.gehDragged.forEach((e=>{this.dispatchMouseEvent(t,"dragleave",e),this.dispatchMouseEvent(e,"dragleave",t)})),this.dispatchMouseEvent(t,"mouseout",this.el)},registerListeners:function(){this.el.addEventListener(this.data.colliderEvent,this.onHit),this.el.addEventListener(this.data.colliderEndEvent,this.unWatch),this.el.addEventListener(this.data.colliderEndEvent,this.unHover),this.data.grabStartButtons.forEach((t=>{this.el.addEventListener(t,this.onGrabStartButton)})),this.data.stretchStartButtons.forEach((t=>{this.el.addEventListener(t,this.onStretchStartButton)})),this.data.dragDropStartButtons.forEach((t=>{this.el.addEventListener(t,this.onDragDropStartButton)})),this.data.dragDropEndButtons.forEach((t=>{this.el.addEventListener(t,this.onDragDropEndButton)})),this.data.stretchEndButtons.forEach((t=>{this.el.addEventListener(t,this.onStretchEndButton)})),this.data.grabEndButtons.forEach((t=>{this.el.addEventListener(t,this.onGrabEndButton)}))},unRegisterListeners:function(t){t=t||this.data,0!==Object.keys(t).length&&(this.el.removeEventListener(t.colliderEvent,this.onHit),this.el.removeEventListener(t.colliderEndEvent,this.unHover),this.el.removeEventListener(t.colliderEndEvent,this.unWatch),t.grabStartButtons.forEach((t=>{this.el.removeEventListener(t,this.onGrabStartButton)})),t.grabEndButtons.forEach((t=>{this.el.removeEventListener(t,this.onGrabEndButton)})),t.stretchStartButtons.forEach((t=>{this.el.removeEventListener(t,this.onStretchStartButton)})),t.stretchEndButtons.forEach((t=>{this.el.removeEventListener(t,this.onStretchEndButton)})),t.dragDropStartButtons.forEach((t=>{this.el.removeEventListener(t,this.onDragDropStartButton)})),t.dragDropEndButtons.forEach((t=>{this.el.removeEventListener(t,this.onDragDropEndButton)})))},emitCancelable:function(t,e,s){const i={bubbles:!0,cancelable:!0,detail:s=s||{}};i.detail.target=i.detail.target||t;const n=new window.CustomEvent(e,i);return t.dispatchEvent(n)},dispatchMouseEvent:function(t,e,s){const i=new window.MouseEvent(e,{relatedTarget:s});t.dispatchEvent(i)},dispatchMouseEventAll:function(t,e,s,i){let n=this.hoverEls;if(s&&(n=n.filter((t=>t!==this.state.get(this.GRAB_EVENT)&&t!==this.state.get(this.DRAG_EVENT)&&t!==this.state.get(this.STRETCH_EVENT)&&!this.gehDragged.has(t)))),i)for(let s=0;s<n.length;s++)this.dispatchMouseEvent(n[s],t,e),this.dispatchMouseEvent(e,t,n[s]);else for(let s=0;s<n.length;s++)this.dispatchMouseEvent(n[s],t,e)},findTarget:function(t,e,s){let i,n=this.hoverEls;for(s&&(n=n.filter((t=>t!==this.state.get(this.GRAB_EVENT)&&t!==this.state.get(this.DRAG_EVENT)&&t!==this.state.get(this.STRETCH_EVENT)))),i=n.length-1;i>=0;i--)if(!this.emitCancelable(n[i],t,e))return n[i];return null},promoteHoveredEl:function(t){const e=this.hoverEls.indexOf(t);if(-1!==e&&null==this.hoverElsIntersections[e].distance){this.hoverEls.splice(e,1);const s=this.hoverElsIntersections.splice(e,1);this.hoverEls.push(t),this.hoverElsIntersections.push(s[0])}}})},4921:(t,e,s)=>{const i=s(1416);AFRAME.registerComponent("clickable",AFRAME.utils.extendDeep({},i,{schema:{onclick:{type:"string"}},init:function(){this.CLICKED_STATE="clicked",this.CLICK_EVENT="grab-start",this.UNCLICK_EVENT="grab-end",this.clickers=[],this.start=this.start.bind(this),this.end=this.end.bind(this),this.el.addEventListener(this.CLICK_EVENT,this.start),this.el.addEventListener(this.UNCLICK_EVENT,this.end)},remove:function(){this.el.removeEventListener(this.CLICK_EVENT,this.start),this.el.removeEventListener(this.UNCLICK_EVENT,this.end)},start:function(t){!t.defaultPrevented&&this.startButtonOk(t)&&(this.el.addState(this.CLICKED_STATE),-1===this.clickers.indexOf(t.detail.hand)&&(this.clickers.push(t.detail.hand),t.preventDefault&&t.preventDefault()))},end:function(t){const e=this.clickers.indexOf(t.detail.hand);!t.defaultPrevented&&this.endButtonOk(t)&&(-1!==e&&this.clickers.splice(e,1),this.clickers.length<1&&this.el.removeState(this.CLICKED_STATE),t.preventDefault&&t.preventDefault())}}))},1708:(t,e,s)=>{const i=AFRAME.utils.extendDeep,n=s(1416);AFRAME.registerComponent("drag-droppable",i({},n,{init:function(){console.warn("Warning: drag-droppable is deprecated. Use draggable and droppable components instead"),this.HOVERED_STATE="dragover",this.DRAGGED_STATE="dragged",this.HOVER_EVENT="dragover-start",this.UNHOVER_EVENT="dragover-end",this.DRAG_EVENT="drag-start",this.UNDRAG_EVENT="drag-end",this.DRAGDROP_EVENT="drag-drop",this.hoverStart=this.hoverStart.bind(this),this.dragStart=this.dragStart.bind(this),this.hoverEnd=this.hoverEnd.bind(this),this.dragEnd=this.dragEnd.bind(this),this.dragDrop=this.dragDrop.bind(this),this.el.addEventListener(this.HOVER_EVENT,this.hoverStart),this.el.addEventListener(this.DRAG_EVENT,this.dragStart),this.el.addEventListener(this.UNHOVER_EVENT,this.hoverEnd),this.el.addEventListener(this.UNDRAG_EVENT,this.dragEnd),this.el.addEventListener(this.DRAGDROP_EVENT,this.dragDrop)},remove:function(){this.el.removeEventListener(this.HOVER_EVENT,this.hoverStart),this.el.removeEventListener(this.DRAG_EVENT,this.dragStart),this.el.removeEventListener(this.UNHOVER_EVENT,this.hoverEnd),this.el.removeEventListener(this.UNDRAG_EVENT,this.dragEnd),this.el.removeEventListener(this.DRAGDROP_EVENT,this.dragDrop)},hoverStart:function(t){this.el.addState(this.HOVERED_STATE),t.preventDefault&&t.preventDefault()},dragStart:function(t){this.startButtonOk(t)&&(this.el.addState(this.DRAGGED_STATE),t.preventDefault&&t.preventDefault())},hoverEnd:function(t){this.el.removeState(this.HOVERED_STATE)},dragEnd:function(t){this.endButtonOk(t)&&(this.el.removeState(this.DRAGGED_STATE),t.preventDefault&&t.preventDefault())},dragDrop:function(t){this.endButtonOk(t)&&t.preventDefault&&t.preventDefault()}}))},711:(t,e,s)=>{const i=AFRAME.utils.extendDeep,n=s(1416);AFRAME.registerComponent("draggable",i({},n,{init:function(){this.DRAGGED_STATE="dragged",this.DRAG_EVENT="drag-start",this.UNDRAG_EVENT="drag-end",this.dragStartBound=this.dragStart.bind(this),this.dragEndBound=this.dragEnd.bind(this),this.el.addEventListener(this.DRAG_EVENT,this.dragStartBound),this.el.addEventListener(this.UNDRAG_EVENT,this.dragEndBound)},remove:function(){this.el.removeEventListener(this.DRAG_EVENT,this.dragStart),this.el.removeEventListener(this.UNDRAG_EVENT,this.dragEnd)},dragStart:function(t){!t.defaultPrevented&&this.startButtonOk(t)&&(this.el.addState(this.DRAGGED_STATE),t.preventDefault&&t.preventDefault())},dragEnd:function(t){!t.defaultPrevented&&this.endButtonOk(t)&&(this.el.removeState(this.DRAGGED_STATE),t.preventDefault&&t.preventDefault())}}))},9514:()=>{AFRAME.registerComponent("droppable",{schema:{accepts:{default:""},autoUpdate:{default:!0},acceptEvent:{default:""},rejectEvent:{default:""}},multiple:!0,init:function(){this.HOVERED_STATE="dragover",this.HOVER_EVENT="dragover-start",this.UNHOVER_EVENT="dragover-end",this.DRAGDROP_EVENT="drag-drop",this.hoverStartBound=this.hoverStart.bind(this),this.hoverEndBound=this.hoverEnd.bind(this),this.dragDropBound=this.dragDrop.bind(this),this.mutateAcceptsBound=this.mutateAccepts.bind(this),this.acceptableEntities=[],this.observer=new window.MutationObserver(this.mutateAcceptsBound),this.observerOpts={childList:!0,subtree:!0},this.el.addEventListener(this.HOVER_EVENT,this.hoverStartBound),this.el.addEventListener(this.UNHOVER_EVENT,this.hoverEndBound),this.el.addEventListener(this.DRAGDROP_EVENT,this.dragDropBound)},update:function(){this.data.accepts.length?this.acceptableEntities=Array.prototype.slice.call(this.el.sceneEl.querySelectorAll(this.data.accepts)):this.acceptableEntities=null,this.data.autoUpdate&&null!=this.acceptableEntities?this.observer.observe(this.el.sceneEl,this.observerOpts):this.observer.disconnect()},remove:function(){this.el.removeEventListener(this.HOVER_EVENT,this.hoverStartBound),this.el.removeEventListener(this.UNHOVER_EVENT,this.hoverEndBound),this.el.removeEventListener(this.DRAGDROP_EVENT,this.dragDropBound),this.observer.disconnect()},mutateAccepts:function(t){const e=this.data.accepts;t.forEach((t=>{t.addedNodes.forEach((t=>{var s,i;i=e,((s=t).matches?s.matches(i):s.msMatchesSelector?s.msMatchesSelector(i):s.webkitMatchesSelector?s.webkitMatchesSelector(i):void 0)&&this.acceptableEntities.push(t)}))}))},entityAcceptable:function(t){const e=this.acceptableEntities;if(null==e)return!0;for(const s of e)if(s===t)return!0;return!1},hoverStart:function(t){!t.defaultPrevented&&this.entityAcceptable(t.detail.carried)&&(this.el.addState(this.HOVERED_STATE),t.preventDefault&&t.preventDefault())},hoverEnd:function(t){t.defaultPrevented||this.el.removeState(this.HOVERED_STATE)},dragDrop:function(t){if(t.defaultPrevented)return;const e=t.detail.dropped;this.entityAcceptable(e)?(this.data.acceptEvent.length&&this.el.emit(this.data.acceptEvent,{el:e}),t.preventDefault&&t.preventDefault()):this.data.rejectEvent.length&&this.el.emit(this.data.rejectEvent,{el:e})}})},6832:(t,e,s)=>{const i=AFRAME.utils.extendDeep,n=i({},s(2945),s(1416));AFRAME.registerComponent("grabbable",i(n,{schema:{maxGrabbers:{type:"int",default:NaN},invert:{default:!1},suppressY:{default:!1}},init:function(){this.GRABBED_STATE="grabbed",this.GRAB_EVENT="grab-start",this.UNGRAB_EVENT="grab-end",this.grabbed=!1,this.grabbers=[],this.constraints=new Map,this.deltaPositionIsValid=!1,this.grabDistance=void 0,this.grabDirection={x:0,y:0,z:-1},this.grabOffset={x:0,y:0,z:0},this.destPosition={x:0,y:0,z:0},this.deltaPosition=new THREE.Vector3,this.targetPosition=new THREE.Vector3,this.physicsInit(),this.el.addEventListener(this.GRAB_EVENT,(t=>this.start(t))),this.el.addEventListener(this.UNGRAB_EVENT,(t=>this.end(t))),this.el.addEventListener("mouseout",(t=>this.lostGrabber(t)))},update:function(){this.physicsUpdate(),this.xFactor=this.data.invert?-1:1,this.zFactor=this.data.invert?-1:1,this.yFactor=(this.data.invert?-1:1)*!this.data.suppressY},tick:function(){const t=new THREE.Quaternion,e=new THREE.Vector3;return function(){let s;this.grabber&&(this.targetPosition.copy(this.grabDirection),this.targetPosition.applyQuaternion(this.grabber.object3D.getWorldQuaternion(t)).setLength(this.grabDistance).add(this.grabber.object3D.getWorldPosition(e)).add(this.grabOffset),this.deltaPositionIsValid?(this.deltaPosition.sub(this.targetPosition),s=this.el.getAttribute("position"),this.destPosition.x=s.x-this.deltaPosition.x*this.xFactor,this.destPosition.y=s.y-this.deltaPosition.y*this.yFactor,this.destPosition.z=s.z-this.deltaPosition.z*this.zFactor,this.el.setAttribute("position",this.destPosition)):this.deltaPositionIsValid=!0,this.deltaPosition.copy(this.targetPosition))}}(),remove:function(){this.el.removeEventListener(this.GRAB_EVENT,this.start),this.el.removeEventListener(this.UNGRAB_EVENT,this.end),this.physicsRemove()},start:function(t){if(t.defaultPrevented||!this.startButtonOk(t))return;const e=!Number.isFinite(this.data.maxGrabbers)||this.grabbers.length<this.data.maxGrabbers;if(-1===this.grabbers.indexOf(t.detail.hand)&&e){if(!t.detail.hand.object3D)return void console.warn("grabbable entities must have an object3D");this.grabbers.push(t.detail.hand),this.physicsStart(t)||this.grabber||(this.grabber=t.detail.hand,this.resetGrabber()),t.preventDefault&&t.preventDefault(),this.grabbed=!0,this.el.addState(this.GRABBED_STATE)}},end:function(t){const e=this.grabbers.indexOf(t.detail.hand);!t.defaultPrevented&&this.endButtonOk(t)&&(-1!==e&&(this.grabbers.splice(e,1),this.grabber=this.grabbers[0]),this.physicsEnd(t),this.resetGrabber()||(this.grabbed=!1,this.el.removeState(this.GRABBED_STATE)),t.preventDefault&&t.preventDefault())},resetGrabber:function(){const t=new THREE.Vector3,e=new THREE.Vector3;return function(){if(!this.grabber)return!1;const s=this.grabber.getAttribute("raycaster");return this.deltaPositionIsValid=!1,this.grabDistance=this.el.object3D.getWorldPosition(t).distanceTo(this.grabber.object3D.getWorldPosition(e)),s&&(this.grabDirection=s.direction,this.grabOffset=s.origin),!0}}(),lostGrabber:function(t){const e=this.grabbers.indexOf(t.relatedTarget);-1===e||t.relatedTarget===this.grabber||this.physicsIsConstrained(t.relatedTarget)||this.grabbers.splice(e,1)}}))},2585:()=>{AFRAME.registerComponent("hoverable",{init:function(){this.HOVERED_STATE="hovered",this.HOVER_EVENT="hover-start",this.UNHOVER_EVENT="hover-end",this.hoverers=[],this.start=this.start.bind(this),this.end=this.end.bind(this),this.el.addEventListener(this.HOVER_EVENT,this.start),this.el.addEventListener(this.UNHOVER_EVENT,this.end)},remove:function(){this.el.removeEventListener(this.HOVER_EVENT,this.start),this.el.removeEventListener(this.UNHOVER_EVENT,this.end)},start:function(t){t.defaultPrevented||(this.el.addState(this.HOVERED_STATE),-1===this.hoverers.indexOf(t.detail.hand)&&this.hoverers.push(t.detail.hand),t.preventDefault&&t.preventDefault())},end:function(t){if(t.defaultPrevented)return;const e=this.hoverers.indexOf(t.detail.hand);-1!==e&&this.hoverers.splice(e,1),this.hoverers.length<1&&this.el.removeState(this.HOVERED_STATE)}})}}]);