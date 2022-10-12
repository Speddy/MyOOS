/// <reference types="webxr" />
import { ReactiveElement } from 'lit';
import * as three from 'three';
import { Group, TextureFilter, Wrapping, Object3D, Material as Material$4, Texture as Texture$4, Vector3 as Vector3$1, WebGLRenderer, Scene as Scene$1, PerspectiveCamera as PerspectiveCamera$1, Camera as Camera$2, Event, Box3, Sphere, Mesh as Mesh$1, Vector2, Raycaster, EventDispatcher, MeshStandardMaterial } from 'three';
import { CSS2DObject, CSS2DRenderer } from 'three/examples/jsm/renderers/CSS2DRenderer.js';
import * as three_examples_jsm_loaders_GLTFLoader_js from 'three/examples/jsm/loaders/GLTFLoader.js';
import { GLTF as GLTF$2, GLTFReference, GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';

declare type Constructor<T = object, U = object> = {
    new (...args: any[]): T;
    prototype: T;
} & U;

declare const $prepared: unique symbol;
interface PreparedGLTF extends GLTF$2 {
    [$prepared]?: boolean;
}
declare const $prepare: unique symbol;
declare const $preparedGLTF: unique symbol;
declare const $clone: unique symbol;
/**
 * Represents the preparation and enhancement of the output of a Three.js
 * GLTFLoader (a Three.js-flavor "GLTF"), to make it suitable for optimal,
 * correct viewing in a given presentation context and also make the cloning
 * process more explicit and legible.
 *
 * A GLTFInstance is API-compatible with a Three.js-flavor "GLTF", so it should
 * be considered to be interchangeable with the loaded result of a GLTFLoader.
 *
 * This basic implementation only implements trivial preparation and enhancement
 * of a GLTF. These operations are intended to be enhanced by inheriting
 * classes.
 */
declare class GLTFInstance implements GLTF$2 {
    /**
     * Prepares a given GLTF for presentation and future cloning. A GLTF that is
     * prepared can safely have this method invoked on it multiple times; it will
     * only be prepared once, including after being cloned.
     */
    static prepare(source: GLTF$2): PreparedGLTF;
    /**
     * Override in an inheriting class to apply specialty one-time preparations
     * for a given input GLTF.
     */
    protected static [$prepare](source: GLTF$2): GLTF$2;
    protected [$preparedGLTF]: PreparedGLTF;
    get parser(): three_examples_jsm_loaders_GLTFLoader_js.GLTFParser;
    get animations(): three.AnimationClip[];
    get scene(): Group;
    get scenes(): Group[];
    get cameras(): three.Camera[];
    get asset(): {
        copyright?: string | undefined;
        generator?: string | undefined;
        version?: string | undefined;
        minVersion?: string | undefined;
        extensions?: any;
        extras?: any;
    };
    get userData(): any;
    constructor(preparedGLTF: PreparedGLTF);
    /**
     * Creates and returns a copy of this instance.
     */
    clone<T extends GLTFInstance>(): T;
    /**
     * Cleans up any retained memory that might not otherwise be released when
     * this instance is done being used.
     */
    dispose(): void;
    /**
     * Override in an inheriting class to implement specialized cloning strategies
     */
    protected [$clone](): PreparedGLTF;
}
declare type GLTFInstanceConstructor = Constructor<GLTFInstance, {
    prepare: typeof GLTFInstance['prepare'];
}>;

declare type RGB$1 = [number, number, number];
declare type RGBA$1 = [number, number, number, number];
declare type Quaternion = [number, number, number, number];
declare type Vector3 = [number, number, number];
declare type Matrix4 = [
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number,
    number
];
declare type Extras = any;
interface ExtensionDictionary {
    [index: string]: any;
}
interface PerspectiveCameraIntrinsics {
    aspectRatio?: number;
    yfov: number;
    zfar: number;
    znear: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface PerspectiveCamera {
    name?: string;
    type: 'perspective';
    perspective?: PerspectiveCameraIntrinsics;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface OrthographicCamera {
    name?: string;
    type: 'orthographic';
    orthographic?: OrthographicCamera;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type Camera$1 = PerspectiveCamera | OrthographicCamera;
declare enum Filter {
    Nearest = 9728,
    Linear = 9729,
    NearestMipmapNearest = 9984,
    LinearMipmapNearest = 9985,
    NearestMipmapLinear = 9986,
    LinearMipmapLinear = 9987
}
declare type NearestFilter = Filter.Nearest;
declare type LinearFilter = Filter.Linear;
declare type NearestMipmapNearestFilter = Filter.NearestMipmapNearest;
declare type LinearMipmapNearestFilter = Filter.LinearMipmapNearest;
declare type NearestMipmapLinearFilter = Filter.NearestMipmapLinear;
declare type LinearMipmapLinearFilter = Filter.LinearMipmapLinear;
declare type MagFilter = NearestFilter | LinearFilter | TextureFilter;
declare type MinFilter = NearestFilter | LinearFilter | NearestMipmapNearestFilter | LinearMipmapNearestFilter | NearestMipmapLinearFilter | LinearMipmapLinearFilter | TextureFilter;
declare enum Wrap {
    ClampToEdge = 33071,
    MirroredRepeat = 33648,
    Repeat = 10497
}
declare type ClampToEdgeWrap = Wrap.ClampToEdge;
declare type MirroredRepeatWrap = Wrap.MirroredRepeat;
declare type RepeatWrap = Wrap.Repeat;
declare type WrapMode = RepeatWrap | ClampToEdgeWrap | MirroredRepeatWrap | Wrapping;
interface Sampler$3 {
    name?: string;
    magFilter?: MagFilter;
    minFilter?: MinFilter;
    wrapS?: WrapMode;
    wrapT?: WrapMode;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Texture$3 {
    name?: string;
    sampler?: number;
    source?: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface TextureInfo$3 {
    index: number;
    texCoord?: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface OcclusionTextureInfo$1 extends TextureInfo$3 {
    strength?: number;
}
interface NormalTextureInfo$1 extends TextureInfo$3 {
    scale?: number;
}
interface PBRMetallicRoughness$3 {
    baseColorFactor?: RGBA$1;
    baseColorTexture?: TextureInfo$3;
    metallicRoughnessTexture?: TextureInfo$3;
    metallicFactor?: number;
    roughnessFactor?: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type AlphaMode = 'OPAQUE' | 'MASK' | 'BLEND';
interface Material$3 {
    name?: string;
    doubleSided?: boolean;
    alphaMode?: AlphaMode;
    alphaCutoff?: number;
    emissiveFactor?: RGB$1;
    pbrMetallicRoughness?: PBRMetallicRoughness$3;
    normalTexture?: NormalTextureInfo$1;
    occlusionTexture?: OcclusionTextureInfo$1;
    emissiveTexture?: TextureInfo$3;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type AttributeDictionary = {
    [index: string]: number;
};
interface Primitive {
    attributes: AttributeDictionary;
    indices?: number;
    material?: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Mesh {
    name?: string;
    primitives: Primitive[];
    weights: number[];
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Node$1 {
    name?: string;
    mesh?: number;
    matrix?: Matrix4;
    rotation?: Quaternion;
    scale?: Vector3;
    translation?: Vector3;
    weights?: number[];
    children?: number[];
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Image$3 {
    name?: string;
    uri?: string;
    bufferView?: number;
    mimeType?: string;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Scene {
    name?: string;
    nodes: number[];
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type AccessorType = 'SCALAR' | 'VEC2' | 'VEC3' | 'VEC4' | 'MAT2' | 'MAT3' | 'MAT4';
interface Accessor {
    name?: string;
    bufferView?: number;
    byteOffset?: number;
    componentType: number;
    normalized?: boolean;
    count: number;
    type: AccessorType;
    max?: number;
    min?: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
    sparse?: any;
}
declare type ChannelTargetPath = 'rotation' | 'scale' | 'translation' | 'weights';
interface ChannelTarget {
    node: number;
    path: ChannelTargetPath;
}
interface Channel {
    sampler: number;
    target: ChannelTarget;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type AnimationInterpolation = 'LINEAR' | 'STEP' | 'CUBICSPLINE';
interface AnimationSampler {
    input: number;
    interpolation: AnimationInterpolation;
    output: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Animation$1 {
    name?: string;
    channels: Channel[];
    samplers: AnimationSampler[];
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Skin$1 {
    inverseBindMatrices?: number;
    skeleton?: number;
    joints: number[];
    name?: string;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type GLTFElement$1 = Scene | Node$1 | Mesh | Material$3 | Image$3 | Texture$3 | TextureInfo$3 | Sampler$3 | PBRMetallicRoughness$3 | Accessor | Camera$1 | Animation$1 | AnimationSampler | Skin$1;
interface Asset {
    version: '2.0';
    copyright?: string;
    generator?: string;
    minVersion?: string;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface GLTF$1 {
    asset: Asset;
    scene?: number;
    scenes?: Scene[];
    nodes?: Node$1[];
    materials?: Material$3[];
    accessors?: Accessor[];
    samplers?: Sampler$3[];
    images?: Image$3[];
    textures?: Texture$3[];
    meshes?: Mesh[];
    cameras?: Camera$1[];
    animations?: Animation$1[];
    skins?: Skin$1[];
}

declare type ThreeSceneObject = Object3D | Material$4 | Texture$4;
declare type ThreeObjectSet = Set<ThreeSceneObject>;
declare type GLTFElementToThreeObjectMap = Map<GLTFElement$1, ThreeObjectSet>;
declare type ThreeObjectToGLTFElementHandleMap = Map<ThreeSceneObject, GLTFReference>;
declare const $threeGLTF: unique symbol;
declare const $gltf: unique symbol;
declare const $gltfElementMap: unique symbol;
declare const $threeObjectMap: unique symbol;
declare const $parallelTraverseThreeScene: unique symbol;
declare const $correlateOriginalThreeGLTF: unique symbol;
declare const $correlateCloneThreeGLTF: unique symbol;
/**
 * The Three.js GLTFLoader provides us with an in-memory representation
 * of a glTF in terms of Three.js constructs. It also provides us with a copy
 * of the deserialized glTF without any Three.js decoration, and a mapping of
 * glTF elements to their corresponding Three.js constructs.
 *
 * A CorrelatedSceneGraph exposes a synchronously available mapping of glTF
 * element references to their corresponding Three.js constructs.
 */
declare class CorrelatedSceneGraph {
    /**
     * Produce a CorrelatedSceneGraph from a naturally generated Three.js GLTF.
     * Such GLTFs are produced by Three.js' GLTFLoader, and contain cached
     * details that expedite the correlation step.
     *
     * If a CorrelatedSceneGraph is provided as the second argument, re-correlates
     * a cloned Three.js GLTF with a clone of the glTF hierarchy used to produce
     * the upstream Three.js GLTF that the clone was created from. The result
     * CorrelatedSceneGraph is representative of the cloned hierarchy.
     */
    static from(threeGLTF: GLTF$2, upstreamCorrelatedSceneGraph?: CorrelatedSceneGraph): CorrelatedSceneGraph;
    private static [$correlateOriginalThreeGLTF];
    /**
     * Transfers the association between a raw glTF and a Three.js scene graph
     * to a clone of the Three.js scene graph, resolved as a new
     * CorrelatedSceneGraph instance.
     */
    private static [$correlateCloneThreeGLTF];
    /**
     * Traverses two presumably identical Three.js scenes, and invokes a
     * callback for each Object3D or Material encountered, including the initial
     * scene. Adapted from
     * https://github.com/mrdoob/three.js/blob/7c1424c5819ab622a346dd630ee4e6431388021e/examples/jsm/utils/SkeletonUtils.js#L586-L596
     */
    private static [$parallelTraverseThreeScene];
    private [$threeGLTF];
    private [$gltf];
    private [$gltfElementMap];
    private [$threeObjectMap];
    /**
     * The source Three.js GLTF result given to us by a Three.js GLTFLoader.
     */
    get threeGLTF(): GLTF$2;
    /**
     * The in-memory deserialized source glTF.
     */
    get gltf(): GLTF$1;
    /**
     * A Map of glTF element references to arrays of corresponding Three.js
     * object references. Three.js objects are kept in arrays to account for
     * cases where more than one Three.js object corresponds to a single glTF
     * element.
     */
    get gltfElementMap(): GLTFElementToThreeObjectMap;
    /**
     * A map of individual Three.js objects to corresponding elements in the
     * source glTF.
     */
    get threeObjectMap(): ThreeObjectToGLTFElementHandleMap;
    constructor(threeGLTF: GLTF$2, gltf: GLTF$1, threeObjectMap: ThreeObjectToGLTFElementHandleMap, gltfElementMap: GLTFElementToThreeObjectMap);
}

declare const $correlatedSceneGraph$1: unique symbol;
interface PreparedModelViewerGLTF extends PreparedGLTF {
    [$correlatedSceneGraph$1]?: CorrelatedSceneGraph;
}
/**
 * This specialization of GLTFInstance collects all of the processing needed
 * to prepare a model and to clone it making special considerations for
 * <model-viewer> use cases.
 */
declare class ModelViewerGLTFInstance extends GLTFInstance {
    /**
     * @override
     */
    protected static [$prepare](source: GLTF$2): PreparedModelViewerGLTF;
    get correlatedSceneGraph(): CorrelatedSceneGraph;
    /**
     * @override
     */
    [$clone](): PreparedGLTF;
}

/**
 * Hotspots are configured by slot name, and this name must begin with "hotspot"
 * to be recognized. The position and normal strings are in the form of the
 * camera-target attribute and default to "0m 0m 0m" and "0m 1m 0m",
 * respectively.
 */
interface HotspotConfiguration {
    name: string;
    position?: string;
    normal?: string;
}
/**
 * The Hotspot object is a reference-counted slot. If decrement() returns true,
 * it should be removed from the tree so it can be garbage-collected.
 */
declare class Hotspot extends CSS2DObject {
    normal: Vector3$1;
    private initialized;
    private referenceCount;
    private pivot;
    private slot;
    constructor(config: HotspotConfiguration);
    get facingCamera(): boolean;
    /**
     * Sets the hotspot to be in the highly visible foreground state.
     */
    show(): void;
    /**
     * Sets the hotspot to be in the diminished background state.
     */
    hide(): void;
    /**
     * Call this when adding elements to the same slot to keep track.
     */
    increment(): void;
    /**
     * Call this when removing elements from the slot; returns true when the slot
     * is unused.
     */
    decrement(): boolean;
    /**
     * Change the position of the hotspot to the input string, in the same format
     * as the data-position attribute.
     */
    updatePosition(position?: string): void;
    /**
     * Change the hotspot's normal to the input string, in the same format as the
     * data-normal attribute.
     */
    updateNormal(normal?: string): void;
    orient(radians: number): void;
    updateVisibility(show: boolean): void;
}

declare type Side = 'back' | 'bottom';
/**
 * The Shadow class creates a shadow that fits a given scene and follows a
 * target. This shadow will follow the scene without any updates needed so long
 * as the shadow and scene are both parented to the same object (call it the
 * scene) and this scene is passed as the target parameter to the shadow's
 * constructor. We also must constrain the scene to motion within the horizontal
 * plane and call the setRotation() method whenever the scene's Y-axis rotation
 * changes. For motion outside of the horizontal plane, this.needsUpdate must be
 * set to true.
 *
 * The softness of the shadow is controlled by changing its resolution, making
 * softer shadows faster, but less precise.
 */
declare class Shadow extends Object3D {
    private camera;
    private renderTarget;
    private renderTargetBlur;
    private depthMaterial;
    private horizontalBlurMaterial;
    private verticalBlurMaterial;
    private intensity;
    private softness;
    private floor;
    private blurPlane;
    private boundingBox;
    private size;
    private maxDimension;
    private isAnimated;
    needsUpdate: boolean;
    constructor(scene: ModelScene, softness: number, side: Side);
    /**
     * Update the shadow's size and position for a new scene. Softness is also
     * needed, as this controls the shadow's resolution.
     */
    setScene(scene: ModelScene, softness: number, side: Side): void;
    /**
     * Update the shadow's resolution based on softness (between 0 and 1). Should
     * not be called frequently, as this results in reallocation.
     */
    setSoftness(softness: number): void;
    /**
     * Lower-level version of the above function.
     */
    setMapSize(maxMapSize: number): void;
    /**
     * Set the shadow's intensity (0 to 1), which is just its opacity. Turns off
     * shadow rendering if zero.
     */
    setIntensity(intensity: number): void;
    getIntensity(): number;
    /**
     * An offset can be specified to move the
     * shadow vertically relative to the bottom of the scene. Positive is up, so
     * values are generally negative. A small offset keeps our shadow from
     * z-fighting with any baked-in shadow plane.
     */
    setOffset(offset: number): void;
    render(renderer: WebGLRenderer, scene: Scene$1): void;
    blurShadow(renderer: WebGLRenderer): void;
}

interface ModelSceneConfig {
    element: ModelViewerElementBase;
    canvas: HTMLCanvasElement;
    width: number;
    height: number;
}
/**
 * A THREE.Scene object that takes a Model and CanvasHTMLElement and
 * constructs a framed scene based off of the canvas dimensions.
 * Provides lights and cameras to be used in a renderer.
 */
declare class ModelScene extends Scene$1 {
    element: ModelViewerElement;
    canvas: HTMLCanvasElement;
    context: CanvasRenderingContext2D | ImageBitmapRenderingContext | null;
    annotationRenderer: CSS2DRenderer;
    schemaElement: HTMLScriptElement;
    width: number;
    height: number;
    aspect: number;
    scaleStep: number;
    renderCount: number;
    externalRenderer: RendererInterface | null;
    camera: PerspectiveCamera$1;
    xrCamera: Camera$2 | null;
    url: string | null;
    target: Object3D<Event>;
    animationNames: Array<string>;
    boundingBox: Box3;
    boundingSphere: Sphere;
    size: Vector3$1;
    idealAspect: number;
    framedFoVDeg: number;
    shadow: Shadow | null;
    shadowIntensity: number;
    shadowSoftness: number;
    bakedShadows: Set<Mesh$1<three.BufferGeometry, Material$4 | Material$4[]>>;
    exposure: number;
    canScale: boolean;
    private isDirty;
    private goalTarget;
    private targetDamperX;
    private targetDamperY;
    private targetDamperZ;
    private _currentGLTF;
    private _model;
    private mixer;
    private cancelPendingSourceChange;
    private animationsByName;
    private currentAnimationAction;
    constructor({ canvas, element, width, height }: ModelSceneConfig);
    /**
     * Function to create the context lazily, as when there is only one
     * <model-viewer> element, the renderer's 3D context can be displayed
     * directly. This extra context is necessary to copy the renderings into when
     * there are more than one.
     */
    createContext(): void;
    getCamera(): Camera$2;
    queueRender(): void;
    shouldRender(): boolean;
    hasRendered(): void;
    forceRescale(): void;
    /**
     * Pass in a THREE.Object3D to be controlled
     * by this model.
     */
    setObject(model: Object3D): Promise<void>;
    /**
     * Sets the model via URL.
     */
    setSource(url: string | null, progressCallback?: (progress: number) => void): Promise<void>;
    private setupScene;
    reset(): void;
    get currentGLTF(): ModelViewerGLTFInstance | null;
    /**
     * Updates the ModelScene for a new container size in CSS pixels.
     */
    setSize(width: number, height: number): void;
    markBakedShadow(mesh: Mesh$1): void;
    unmarkBakedShadow(mesh: Mesh$1): void;
    findBakedShadows(group: Object3D): void;
    checkBakedShadows(): void;
    applyTransform(): void;
    updateBoundingBox(): void;
    /**
     * Calculates the boundingSphere and idealAspect that allows the 3D
     * object to be framed tightly in a 2D window of any aspect ratio without
     * clipping at any camera orbit. The camera's center target point can be
     * optionally specified. If no center is specified, it defaults to the center
     * of the bounding box, which means asymmetric models will tend to be tight on
     * one side instead of both. Proper choice of center can correct this.
     */
    updateFraming(): Promise<void>;
    setBakedShadowVisibility(visible?: boolean): void;
    idealCameraDistance(): number;
    /**
     * Set's the framedFieldOfView based on the aspect ratio of the window in
     * order to keep the model fully visible at any camera orientation.
     */
    adjustedFoV(fovDeg: number): number;
    getNDC(clientX: number, clientY: number): Vector2;
    /**
     * Returns the size of the corresponding canvas element.
     */
    getSize(): {
        width: number;
        height: number;
    };
    setEnvironmentAndSkybox(environment: Texture$4 | null, skybox: Texture$4 | null): void;
    /**
     * Sets the point in model coordinates the model should orbit/pivot around.
     */
    setTarget(modelX: number, modelY: number, modelZ: number): void;
    /**
     * Set the decay time of, affects the speed of target transitions.
     */
    setTargetDamperDecayTime(decayMilliseconds: number): void;
    /**
     * Gets the point in model coordinates the model should orbit/pivot around.
     */
    getTarget(): Vector3$1;
    /**
     * Shifts the model to the target point immediately instead of easing in.
     */
    jumpToGoal(): void;
    /**
     * This should be called every frame with the frame delta to cause the target
     * to transition to its set point.
     */
    updateTarget(delta: number): boolean;
    /**
     * Yaw the +z (front) of the model toward the indicated world coordinates.
     */
    pointTowards(worldX: number, worldZ: number): void;
    get model(): Object3D<Event> | null;
    /**
     * Yaw is the scene's orientation about the y-axis, around the rotation
     * center.
     */
    set yaw(radiansY: number);
    get yaw(): number;
    set animationTime(value: number);
    get animationTime(): number;
    set animationTimeScale(value: number);
    get animationTimeScale(): number;
    get duration(): number;
    get hasActiveAnimation(): boolean;
    /**
     * Plays an animation if there are any associated with the current model.
     * Accepts an optional string name of an animation to play. If no name is
     * provided, or if no animation is found by the given name, always falls back
     * to playing the first animation.
     */
    playAnimation(name?: string | null, crossfadeTime?: number, loopMode?: number, repetitionCount?: number): void;
    stopAnimation(): void;
    updateAnimation(step: number): void;
    subscribeMixerEvent(event: string, callback: (...args: any[]) => void): void;
    /**
     * Call if the object has been changed in such a way that the shadow's shape
     * has changed (not a rotation about the Y axis).
     */
    updateShadow(): void;
    renderShadow(renderer: WebGLRenderer): void;
    private queueShadowRender;
    /**
     * Sets the shadow's intensity, lazily creating the shadow as necessary.
     */
    setShadowIntensity(shadowIntensity: number): void;
    /**
     * Sets the shadow's softness by mapping a [0, 1] softness parameter to the
     * shadow's resolution. This involves reallocation, so it should not be
     * changed frequently. Softer shadows are cheaper to render.
     */
    setShadowSoftness(softness: number): void;
    /**
     * Shift the floor vertically from the bottom of the model's bounding box by
     * offset (should generally be negative).
     */
    setShadowOffset(offset: number): void;
    get raycaster(): Raycaster;
    /**
     * This method returns the world position, model-space normal and texture
     * coordinate of the point on the mesh corresponding to the input pixel
     * coordinates given relative to the model-viewer element. If the mesh
     * is not hit, the result is null.
     */
    positionAndNormalFromPoint(ndcPosition: Vector2, object?: Object3D): {
        position: Vector3$1;
        normal: Vector3$1;
        uv: Vector2 | null;
    } | null;
    /**
     * The following methods are for operating on the set of Hotspot objects
     * attached to the scene. These come from DOM elements, provided to slots by
     * the Annotation Mixin.
     */
    addHotspot(hotspot: Hotspot): void;
    removeHotspot(hotspot: Hotspot): void;
    /**
     * Helper method to apply a function to all hotspots.
     */
    forHotspots(func: (hotspot: Hotspot) => void): void;
    /**
     * Update the CSS visibility of the hotspots based on whether their normals
     * point toward the camera.
     */
    updateHotspots(viewerPosition: Vector3$1): void;
    /**
     * Rotate all hotspots to an absolute orientation given by the input number of
     * radians. Zero returns them to upright.
     */
    orientHotspots(radians: number): void;
    /**
     * Set the rendering visibility of all hotspots. This is used to hide them
     * during transitions and such.
     */
    setHotspotsVisibility(visible: boolean): void;
    updateSchema(src: string | null): void;
}

declare class ARRenderer extends EventDispatcher {
    private renderer;
    threeRenderer: WebGLRenderer;
    currentSession: XRSession | null;
    placeOnWall: boolean;
    private placementBox;
    private lastTick;
    private turntableRotation;
    private oldShadowIntensity;
    private frame;
    private initialHitSource;
    private transientHitTestSource;
    private inputSource;
    private _presentedScene;
    private resolveCleanup;
    private exitWebXRButtonContainer;
    private overlay;
    private xrLight;
    private tracking;
    private frames;
    private initialized;
    private oldTarget;
    private placementComplete;
    private isTranslating;
    private isRotating;
    private isTwoFingering;
    private lastDragPosition;
    private firstRatio;
    private lastAngle;
    private goalPosition;
    private goalYaw;
    private goalScale;
    private xDamper;
    private yDamper;
    private zDamper;
    private yawDamper;
    private scaleDamper;
    private onExitWebXRButtonContainerClick;
    constructor(renderer: Renderer);
    resolveARSession(): Promise<XRSession>;
    /**
     * The currently presented scene, if any
     */
    get presentedScene(): ModelScene | null;
    /**
     * Resolves to true if the renderer has detected all the necessary qualities
     * to support presentation in AR.
     */
    supportsPresentation(): Promise<boolean>;
    /**
     * Present a scene in AR
     */
    present(scene: ModelScene, environmentEstimation?: boolean): Promise<void>;
    /**
     * If currently presenting a scene in AR, stops presentation and exits AR.
     */
    stopPresenting(): Promise<void>;
    /**
     * True if a scene is currently in the process of being presented in AR
     */
    get isPresenting(): boolean;
    get target(): Vector3$1;
    updateTarget(): void;
    onUpdateScene: () => void;
    private postSessionCleanup;
    private updateView;
    private placeInitially;
    private getTouchLocation;
    private getHitPoint;
    moveToFloor(frame: XRFrame): void;
    private onSelectStart;
    private onSelectEnd;
    private fingerPolar;
    private processInput;
    private moveScene;
    /**
     * Only public to make it testable.
     */
    onWebXRFrame(time: number, frame: XRFrame): void;
}

/**
 * A mutable cache is any object that has that allows cache
 * items to be deleted imperatively given their key
 */
interface MutableCache<T> {
    delete(key: T): void;
}
declare const $retainerCount: unique symbol;
declare const $recentlyUsed: unique symbol;
declare const $evict: unique symbol;
declare const $evictionThreshold: unique symbol;
declare const $cache: unique symbol;
/**
 * The CacheEvictionPolicy manages the lifecycle for items in a cache,
 * evicting any items outside some threshold bounds in "recently used" order,
 * if they are evictable.
 *
 * Items are considered cached as they are retained. When all retainers
 * of an item release it, that item is considered evictable.
 */
declare class CacheEvictionPolicy<T = string> {
    private [$retainerCount];
    private [$recentlyUsed];
    private [$evictionThreshold];
    private [$cache];
    constructor(cache: MutableCache<T>, evictionThreshold?: number);
    /**
     * The eviction threshold is the maximum number of items to hold
     * in cache indefinitely. Items within the threshold (in recently
     * used order) will continue to be cached even if they have zero
     * retainers.
     */
    set evictionThreshold(value: number);
    get evictionThreshold(): number;
    /**
     * A reference to the cache that operates under this policy
     */
    get cache(): MutableCache<T>;
    /**
     * Given an item key, returns the number of retainers of that item
     */
    retainerCount(key: T): number;
    /**
     * Resets the internal tracking of cache item retainers. Use only in cases
     * where it is certain that all retained cache items have been accounted for!
     */
    reset(): void;
    /**
     * Mark a given cache item as retained, where the item is represented
     * by its key. An item can have any number of retainers.
     */
    retain(key: T): void;
    /**
     * Mark a given cache item as released by one of its retainers, where the item
     * is represented by its key. When all retainers of an item have released it,
     * the item is considered evictable.
     */
    release(key: T): void;
    [$evict](): void;
}

declare type ProgressCallback = (progress: number) => void;
declare global {
    const MeshoptDecoder: MeshoptDecoder;
}
declare const $loader: unique symbol;
declare const $evictionPolicy: unique symbol;
declare const $GLTFInstance: unique symbol;
declare class CachingGLTFLoader<T extends GLTFInstanceConstructor = GLTFInstanceConstructor> extends EventDispatcher {
    static withCredentials: boolean;
    static setDRACODecoderLocation(url: string): void;
    static getDRACODecoderLocation(): string;
    static setKTX2TranscoderLocation(url: string): void;
    static getKTX2TranscoderLocation(): string;
    static setMeshoptDecoderLocation(url: string): void;
    static getMeshoptDecoderLocation(): string;
    static initializeKTX2Loader(renderer: WebGLRenderer): void;
    static [$evictionPolicy]: CacheEvictionPolicy;
    static get cache(): Map<string, Promise<GLTFInstance>>;
    /** @nocollapse */
    static clearCache(): void;
    static has(url: string): boolean;
    /** @nocollapse */
    static delete(url: string): Promise<void>;
    /**
     * Returns true if the model that corresponds to the specified url is
     * available in our local cache.
     */
    static hasFinishedLoading(url: string): boolean;
    constructor(GLTFInstance: T);
    protected [$loader]: GLTFLoader;
    protected [$GLTFInstance]: T;
    protected get [$evictionPolicy](): CacheEvictionPolicy;
    /**
     * Preloads a glTF, populating the cache. Returns a promise that resolves
     * when the cache is populated.
     */
    preload(url: string, element: ModelViewerElementBase, progressCallback?: ProgressCallback): Promise<void>;
    /**
     * Loads a glTF from the specified url and resolves a unique clone of the
     * glTF. If the glTF has already been loaded, makes a clone of the cached
     * copy.
     */
    load(url: string, element: ModelViewerElementBase, progressCallback?: ProgressCallback): Promise<InstanceType<T>>;
}

/**
 * This Debugger exposes internal details of the <model-viewer> rendering
 * substructure so that external tools can more easily inspect and operate on
 * them.
 *
 * It also activates shader debugging on the associated GL context. Shader
 * debugging trades performance for useful error information, so it is not
 * recommended to activate this unless needed.
 */
declare class Debugger {
    constructor(renderer: Renderer);
    addScene(scene: ModelScene): void;
    removeScene(scene: ModelScene): void;
}

interface EnvironmentMapAndSkybox {
    environmentMap: Texture$4;
    skybox: Texture$4 | null;
}
declare class TextureUtils extends EventDispatcher {
    private threeRenderer;
    private generatedEnvironmentMap;
    private generatedEnvironmentMapAlt;
    private skyboxCache;
    private blurMaterial;
    private blurScene;
    constructor(threeRenderer: WebGLRenderer);
    load(url: string, progressCallback?: (progress: number) => void): Promise<Texture$4>;
    /**
     * Returns a { skybox, environmentMap } object with the targets/textures
     * accordingly. `skybox` is a WebGLRenderCubeTarget, and `environmentMap`
     * is a Texture from a WebGLRenderCubeTarget.
     */
    generateEnvironmentMapAndSkybox(skyboxUrl?: string | null, environmentMapUrl?: string | null, progressCallback?: (progress: number) => void): Promise<EnvironmentMapAndSkybox>;
    /**
     * Loads an equirect Texture from a given URL, for use as a skybox.
     */
    private loadEquirectFromUrl;
    private GenerateEnvironmentMap;
    /**
     * Loads a dynamically generated environment map.
     */
    private loadGeneratedEnvironmentMap;
    /**
     * Loads a dynamically generated environment map, designed to be neutral and
     * color-preserving. Shows less contrast around the different sides of the
     * object.
     */
    private loadGeneratedEnvironmentMapAlt;
    private blurCubemap;
    private halfblur;
    private getBlurShader;
    dispose(): Promise<void>;
}

interface RendererOptions {
    powerPreference: string;
    debug?: boolean;
}
interface ContextLostEvent extends Event {
    type: 'contextlost';
    sourceEvent: WebGLContextEvent;
}
/**
 * Registers canvases with Canvas2DRenderingContexts and renders them
 * all in the same WebGLRenderingContext, spitting out textures to apply
 * to the canvases. Creates a fullscreen WebGL canvas that is not added
 * to the DOM, and on each frame, renders each registered canvas on a portion
 * of the WebGL canvas, and applies the texture on the registered canvas.
 *
 * In the future, can use ImageBitmapRenderingContext instead of
 * Canvas2DRenderingContext if supported for cheaper transferring of
 * the texture.
 */
declare class Renderer extends EventDispatcher {
    private static _singleton;
    static get singleton(): Renderer;
    static resetSingleton(): void;
    threeRenderer: WebGLRenderer;
    canvas3D: HTMLCanvasElement;
    textureUtils: TextureUtils | null;
    arRenderer: ARRenderer;
    loader: CachingGLTFLoader<typeof ModelViewerGLTFInstance>;
    width: number;
    height: number;
    dpr: number;
    protected debugger: Debugger | null;
    private scenes;
    private multipleScenesVisible;
    private lastTick;
    private renderedLastFrame;
    private scaleStep;
    private lastStep;
    private avgFrameDuration;
    get canRender(): boolean;
    get scaleFactor(): number;
    set minScale(scale: number);
    constructor(options: RendererOptions);
    registerScene(scene: ModelScene): void;
    unregisterScene(scene: ModelScene): void;
    displayCanvas(scene: ModelScene): HTMLCanvasElement;
    /**
     * The function enables an optimization, where when there is only a single
     * <model-viewer> element, we can use the renderer's 3D canvas directly for
     * display. Otherwise we need to use the element's 2D canvas and copy the
     * renderer's result into it.
     */
    private countVisibleScenes;
    /**
     * Updates the renderer's size based on the largest scene and any changes to
     * device pixel ratio.
     */
    private updateRendererSize;
    private updateRendererScale;
    private shouldRender;
    private rescaleCanvas;
    private sceneSize;
    private copyPixels;
    /**
     * Returns an array version of this.scenes where the non-visible ones are
     * first. This allows eager scenes to be rendered before they are visible,
     * without needing the multi-canvas render path.
     */
    private orderedScenes;
    get isPresenting(): boolean;
    /**
     * This method takes care of updating the element and renderer state based on
     * the time that has passed since the last rendered frame.
     */
    preRender(scene: ModelScene, t: number, delta: number): void;
    render(t: number, frame?: XRFrame): void;
    dispose(): Array<ModelViewerElementBase>;
    onWebGLContextLost: (event: Event) => void;
    onWebGLContextRestored: () => void;
}

/**
 * An Activity is represented by a callback that accepts values from 0 to 1,
 * where 1 represents the completion of the activity. The callback returns the
 * actual progress as it is stored by the ProgressTracker (which may be clamped,
 * and can never be lower than its previous value).
 */
declare type Activity = (progress: number) => number;
/**
 * ProgressTracker is an event emitter that helps to track the ongoing progress
 * of many simultaneous actions.
 *
 * ProgressTracker reports progress activity in the form of a progress event.
 * The event.detail.totalProgress value indicates the elapsed progress of all
 * activities being tracked by the ProgressTracker.
 *
 * The value of totalProgress is a number that progresses from 0 to 1. The
 * ProgressTracker allows for the lazy accumulation of tracked actions, so the
 * total progress represents a abstract, non-absolute progress towards the
 * completion of all currently tracked events.
 *
 * When all currently tracked activities are finished, the ProgressTracker
 * emits one final progress event and then resets the list of its currently
 * tracked activities. This means that from an observer's perspective,
 * ongoing activities will accumulate and collectively contribute to the notion
 * of total progress until all currently tracked ongoing activities have
 * completed.
 */
declare class ProgressTracker extends EventTarget {
    private ongoingActivities;
    private totalProgress;
    /**
     * The total number of activities currently being tracked.
     */
    get ongoingActivityCount(): number;
    /**
     * Registers a new activity to be tracked by the progress tracker. The method
     * returns a special callback that should be invoked whenever new progress is
     * ready to be reported. The progress should be reported as a value between 0
     * and 1, where 0 would represent the beginning of the action and 1 would
     * represent its completion.
     *
     * There is no built-in notion of a time-out for ongoing activities, so once
     * an ongoing activity is begun, it is up to the consumer of this API to
     * update the progress until that activity is no longer ongoing.
     *
     * Progress is only allowed to move forward for any given activity. If a lower
     * progress is reported than the previously reported progress, it will be
     * ignored.
     */
    beginActivity(): Activity;
    private announceTotalProgress;
}

declare const $fallbackResizeHandler: unique symbol;
declare const $defaultAriaLabel: unique symbol;
declare const $resizeObserver: unique symbol;
declare const $clearModelTimeout: unique symbol;
declare const $onContextLost: unique symbol;
declare const $loaded: unique symbol;
declare const $status: unique symbol;
declare const $onFocus: unique symbol;
declare const $onBlur: unique symbol;
declare const $updateSize: unique symbol;
declare const $intersectionObserver: unique symbol;
declare const $isElementInViewport: unique symbol;
declare const $announceModelVisibility: unique symbol;
declare const $ariaLabel: unique symbol;
declare const $altDefaulted: unique symbol;
declare const $statusElement: unique symbol;
declare const $updateStatus: unique symbol;
declare const $loadedTime: unique symbol;
declare const $updateSource: unique symbol;
declare const $markLoaded: unique symbol;
declare const $container: unique symbol;
declare const $userInputElement: unique symbol;
declare const $canvas: unique symbol;
declare const $scene: unique symbol;
declare const $needsRender: unique symbol;
declare const $tick: unique symbol;
declare const $onModelLoad: unique symbol;
declare const $onResize: unique symbol;
declare const $renderer: unique symbol;
declare const $progressTracker: unique symbol;
declare const $getLoaded: unique symbol;
declare const $getModelIsVisible: unique symbol;
declare const $shouldAttemptPreload: unique symbol;
interface Vector3D {
    x: number;
    y: number;
    z: number;
    toString(): string;
}
interface Vector2D {
    u: number;
    v: number;
    toString(): string;
}
interface ToBlobOptions {
    mimeType?: string;
    qualityArgument?: number;
    idealAspect?: boolean;
}
interface FramingInfo {
    framedRadius: number;
    fieldOfViewAspect: number;
}
interface Camera {
    viewMatrix: Array<number>;
    projectionMatrix: Array<number>;
}
interface RendererInterface {
    load(progressCallback: (progress: number) => void): Promise<FramingInfo>;
    render(camera: Camera): void;
    resize(width: number, height: number): void;
}
/**
 * Definition for a basic <model-viewer> element.
 */
declare class ModelViewerElementBase extends ReactiveElement {
    static get is(): string;
    /** @export */
    static set modelCacheSize(value: number);
    /** @export */
    static get modelCacheSize(): number;
    /** @export */
    static set minimumRenderScale(value: number);
    /** @export */
    static get minimumRenderScale(): number;
    alt: string | null;
    src: string | null;
    withCredentials: boolean;
    /**
     * Generates a 3D model schema https://schema.org/3DModel associated with
     * the loaded src and inserts it into the header of the page for search
     * engines to crawl.
     */
    generateSchema: boolean;
    protected [$isElementInViewport]: boolean;
    protected [$loaded]: boolean;
    protected [$loadedTime]: number;
    protected [$scene]: ModelScene;
    protected [$container]: HTMLDivElement;
    protected [$userInputElement]: HTMLDivElement;
    protected [$canvas]: HTMLCanvasElement;
    protected [$statusElement]: HTMLSpanElement;
    protected [$status]: string;
    protected [$defaultAriaLabel]: string;
    protected [$clearModelTimeout]: number | null;
    protected [$fallbackResizeHandler]: (...args: any[]) => void;
    protected [$announceModelVisibility]: (...args: any[]) => void;
    protected [$resizeObserver]: ResizeObserver | null;
    protected [$intersectionObserver]: IntersectionObserver | null;
    protected [$progressTracker]: ProgressTracker;
    /** @export */
    get loaded(): boolean;
    get [$renderer](): Renderer;
    /** @export */
    get modelIsVisible(): boolean;
    /**
     * Creates a new ModelViewerElement.
     */
    constructor();
    connectedCallback(): void;
    disconnectedCallback(): void;
    updated(changedProperties: Map<string | number | symbol, any>): void;
    /** @export */
    toDataURL(type?: string, encoderOptions?: number): string;
    /** @export */
    toBlob(options?: ToBlobOptions): Promise<Blob>;
    registerRenderer(renderer: RendererInterface): void;
    unregisterRenderer(): void;
    get [$ariaLabel](): string;
    get [$altDefaulted](): string;
    [$getLoaded](): boolean;
    [$getModelIsVisible](): boolean;
    [$shouldAttemptPreload](): boolean;
    /**
     * Called on initialization and when the resize observer fires.
     */
    [$updateSize]({ width, height }: {
        width: any;
        height: any;
    }): void;
    [$tick](_time: number, _delta: number): void;
    [$markLoaded](): void;
    [$needsRender](): void;
    [$onModelLoad](): void;
    [$updateStatus](status: string): void;
    [$onFocus]: () => void;
    [$onBlur]: () => void;
    [$onResize](e: {
        width: number;
        height: number;
    }): void;
    [$onContextLost]: (event: ContextLostEvent) => void;
    /**
     * Parses the element for an appropriate source URL and
     * sets the views to use the new model based.
     */
    [$updateSource](): Promise<void>;
}

interface PlayAnimationOptions {
    repetitions: number;
    pingpong: boolean;
}
declare interface AnimationInterface {
    autoplay: boolean;
    animationName: string | void;
    animationCrossfadeDuration: number;
    readonly availableAnimations: Array<string>;
    readonly paused: boolean;
    readonly duration: number;
    currentTime: number;
    timeScale: number;
    pause(): void;
    play(options?: PlayAnimationOptions): void;
}

declare type RevealAttributeValue = 'auto' | 'manual';
declare type LoadingAttributeValue = 'auto' | 'lazy' | 'eager';
declare interface LoadingInterface {
    poster: string | null;
    reveal: RevealAttributeValue;
    loading: LoadingAttributeValue;
    readonly loaded: boolean;
    readonly modelIsVisible: boolean;
    dismissPoster(): void;
    showPoster(): void;
    getDimensions(): Vector3D;
    getBoundingBoxCenter(): Vector3D;
}
declare interface LoadingStaticInterface {
    dracoDecoderLocation: string;
    ktx2TranscoderLocation: string;
    meshoptDecoderLocation: string;
    mapURLs(callback: (url: string) => string): void;
}

declare interface ARInterface {
    ar: boolean;
    arModes: string;
    arScale: string;
    arPlacement: string;
    iosSrc: string | null;
    xrEnvironment: boolean;
    readonly canActivateAR: boolean;
    activateAR(): Promise<void>;
}

/**
 * A TimingFunction accepts a value from 0-1 and returns a corresponding
 * interpolated value
 */
declare type TimingFunction = (time: number) => number;
/**
 * A Frame groups a target value, the number of frames to interpolate towards
 * that value and an optional easing function to use for interpolation.
 */
interface Frame {
    value: number;
    frames: number;
    ease?: TimingFunction;
}
interface Path {
    initialValue: number;
    keyframes: Frame[];
}

interface SphericalPosition {
    theta: number;
    phi: number;
    radius: number;
    toString(): string;
}
interface Finger {
    x: Path;
    y: Path;
}
declare type InteractionPromptStrategy = 'auto' | 'none';
declare const InteractionPromptStrategy: {
    [index: string]: InteractionPromptStrategy;
};
declare type TouchAction = 'pan-y' | 'pan-x' | 'none';
declare const TouchAction: {
    [index: string]: TouchAction;
};
declare interface ControlsInterface {
    cameraControls: boolean;
    cameraOrbit: string;
    cameraTarget: string;
    fieldOfView: string;
    minCameraOrbit: string;
    maxCameraOrbit: string;
    minFieldOfView: string;
    maxFieldOfView: string;
    interactionPrompt: InteractionPromptStrategy;
    interactionPromptThreshold: number;
    orbitSensitivity: number;
    touchAction: TouchAction;
    interpolationDecay: number;
    disableZoom: boolean;
    disablePan: boolean;
    disableTap: boolean;
    getCameraOrbit(): SphericalPosition;
    getCameraTarget(): Vector3D;
    getFieldOfView(): number;
    getMinimumFieldOfView(): number;
    getMaximumFieldOfView(): number;
    getIdealAspect(): number;
    jumpCameraToGoal(): void;
    updateFraming(): Promise<void>;
    resetInteractionPrompt(): void;
    zoom(keyPresses: number): void;
    interact(duration: number, finger0: Finger, finger1?: Finger): void;
    inputSensitivity: number;
}

declare interface EnvironmentInterface {
    environmentImage: string | null;
    skyboxImage: string | null;
    shadowIntensity: number;
    shadowSoftness: number;
    exposure: number;
    hasBakedShadow(): boolean;
}

declare interface StagingInterface {
    autoRotate: boolean;
    autoRotateDelay: number;
    readonly turntableRotation: number;
    resetTurntableRotation(theta?: number): void;
}

interface Sampler$2 {
    name?: string;
    magFilter: MagFilter;
    minFilter: MinFilter;
    wrapS: WrapMode;
    wrapT: WrapMode;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Texture$2 {
    name?: string;
    sampler: number;
    source: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface TextureInfo$2 {
    index: number;
    texCoord?: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface OcclusionTextureInfo extends TextureInfo$2 {
    strength?: number;
}
interface NormalTextureInfo extends TextureInfo$2 {
    scale?: number;
}
interface PBRMetallicRoughness$2 {
    baseColorFactor: RGBA$1;
    baseColorTexture?: TextureInfo$2;
    metallicRoughnessTexture?: TextureInfo$2;
    metallicFactor: number;
    roughnessFactor: number;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Material$2 {
    name?: string;
    doubleSided: boolean;
    alphaMode: AlphaMode;
    alphaCutoff: number;
    emissiveFactor: RGB$1;
    pbrMetallicRoughness: PBRMetallicRoughness$2;
    normalTexture?: NormalTextureInfo;
    occlusionTexture?: OcclusionTextureInfo;
    emissiveTexture?: TextureInfo$2;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Image$2 {
    name?: string;
    uri?: string;
    bufferView?: number;
    mimeType?: string;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
interface Skin {
    inverseBindMatrices?: number;
    skeleton?: number;
    joints: number[];
    name?: string;
    extensions?: ExtensionDictionary;
    extras?: Extras;
}
declare type GLTFElement = Scene | Node | Mesh | Material$2 | Image$2 | Texture$2 | TextureInfo$2 | Sampler$2 | PBRMetallicRoughness$2 | Accessor | Camera$1 | Animation | AnimationSampler | Skin;
interface GLTF {
    asset: Asset;
    scene: number;
    scenes: Scene[];
    nodes?: Node[];
    materials: Material$2[];
    accessors?: Accessor[];
    samplers?: Sampler$2[];
    images?: Image$2[];
    textures?: Texture$2[];
    meshes?: Mesh[];
    cameras?: Camera$1[];
    animations?: Animation[];
    skins?: Skin[];
}

/**
 * A Model is the root element of a 3DOM scene graph. It gives scripts access
 * to the sub-elements found without the graph.
 */
declare interface Model$1 {
    /**
     * An ordered set of unique Materials found in this model. The Materials
     * correspond to the listing of materials in the glTF, with the possible
     * addition of a default material at the end.
     */
    readonly materials: Readonly<Material$1[]>;
    /**
     * Gets a material(s) by name.
     * @param name the name of the material to return.
     * @returns the first material to whose name matches `name`
     */
    getMaterialByName(name: string): Material$1 | null;
    /**
     * Creates a new material variant from an existing material.
     * @param originalMaterialIndex index of the material to clone the variant
     *     from.
     * @param materialName the name of the new material
     * @param variantName the name of the variant
     * @param activateVariant activates this material variant, i.e. the variant
     *     material is rendered, not the existing material.
     * @returns returns a clone of the original material, returns `null` if the
     *     material instance for this variant already exists.
     */
    createMaterialInstanceForVariant(originalMaterialIndex: number, newMaterialName: string, variantName: string, activateVariant: boolean): Material$1 | null;
    /**
     * Adds a variant name to the model.
     * @param variantName
     */
    createVariant(variantName: string): void;
    /**
     * Adds an existing material to a variant name.
     * @param materialIndex
     * @param targetVariantName
     */
    setMaterialToVariant(materialIndex: number, targetVariantName: string): void;
    /**
     * Removes the variant name from the model.
     * @param variantName the variant to remove.
     */
    deleteVariant(variantName: string): void;
}
/**
 * A Material gives the script access to modify a single, unique material found
 * in a model's scene graph.
 *
 * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#reference-material
 */
declare interface Material$1 {
    /**
     * The name of the material, if any.
     */
    name: string;
    readonly normalTexture: TextureInfo$1 | null;
    readonly occlusionTexture: TextureInfo$1 | null;
    readonly emissiveTexture: TextureInfo$1 | null;
    readonly emissiveFactor: Readonly<RGB>;
    setEmissiveFactor(rgb: RGB): void;
    setAlphaCutoff(cutoff: number): void;
    getAlphaCutoff(): number;
    setDoubleSided(doubleSided: boolean): void;
    getDoubleSided(): boolean;
    setAlphaMode(alphaMode: AlphaMode): void;
    getAlphaMode(): AlphaMode;
    /**
     * The PBRMetallicRoughness configuration of the material.
     */
    readonly pbrMetallicRoughness: PBRMetallicRoughness$1;
    /**
     * Asynchronously loads the underlying material resource if it's currently
     * unloaded, otherwise the method is a noop.
     */
    ensureLoaded(): void;
    /**
     * Returns true if the material participates in the variant.
     * @param name the variant name.
     */
    hasVariant(name: string): boolean;
    /**
     * Returns true if the material is loaded.
     */
    readonly isLoaded: boolean;
    /**
     * Returns true if the material is participating in scene renders.
     */
    readonly isActive: boolean;
    /**
     * Returns the glTF index of this material.
     */
    readonly index: number;
}
/**
 * The PBRMetallicRoughness encodes the PBR properties of a material
 *
 * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#reference-pbrmetallicroughness
 */
declare interface PBRMetallicRoughness$1 {
    /**
     * The base color factor of the material, represented as RGBA values
     */
    readonly baseColorFactor: Readonly<RGBA>;
    /**
     * Metalness factor of the material, represented as number between 0 and 1
     */
    readonly metallicFactor: number;
    /**
     * Roughness factor of the material, represented as number between 0 and 1
     */
    readonly roughnessFactor: number;
    /**
     * A texture reference, associating an image with color information and
     * a sampler for describing base color factor for a UV coordinate space.
     */
    readonly baseColorTexture: TextureInfo$1 | null;
    /**
     * A texture reference, associating an image with color information and
     * a sampler for describing metalness (B channel) and roughness (G channel)
     * for a UV coordinate space.
     */
    readonly metallicRoughnessTexture: TextureInfo$1 | null;
    /**
     * Changes the base color factor of the material to the given value.
     */
    setBaseColorFactor(rgba: RGBA): void;
    /**
     * Changes the metalness factor of the material to the given value.
     */
    setMetallicFactor(value: number): void;
    /**
     * Changes the roughness factor of the material to the given value.
     */
    setRoughnessFactor(value: number): void;
}
/**
 * A TextureInfo is a pointer to a specific Texture in use on a Material
 *
 * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#reference-textureinfo
 */
declare interface TextureInfo$1 {
    /**
     * The Texture being referenced by this TextureInfo
     */
    readonly texture: Texture$1 | null;
    /**
     * Sets the texture, or removes it if argument is null. Note you cannot build
     * your own Texture object, but must either use one from another TextureInfo,
     * or create one with the createTexture method.
     */
    setTexture(texture: Texture$1 | null): void;
}
/**
 * A Texture pairs an Image and a Sampler for use in a Material
 *
 * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#reference-texture
 */
declare interface Texture$1 {
    /**
     * The name of the texture, if any.
     */
    readonly name: string;
    /**
     * The Sampler for this Texture
     */
    readonly sampler: Sampler$1;
    /**
     * The source Image for this Texture
     */
    readonly source: Image$1;
}
/**
 * A Sampler describes how to filter and wrap textures
 *
 * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#reference-sampler
 */
declare interface Sampler$1 {
    /**
     * The name of the sampler, if any.
     */
    readonly name: string;
    /**
     * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#samplerminfilter
     */
    readonly minFilter: MinFilter;
    /**
     * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#samplermagfilter
     */
    readonly magFilter: MagFilter;
    /**
     * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#samplerwraps
     */
    readonly wrapS: WrapMode;
    /**
     * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#samplerwrapt
     */
    readonly wrapT: WrapMode;
    /**
     * Configure the minFilter value of the Sampler.
     */
    setMinFilter(filter: MinFilter): void;
    /**
     * Configure the magFilter value of the Sampler.
     */
    setMagFilter(filter: MagFilter): void;
    /**
     * Configure the S (U) wrap mode of the Sampler.
     */
    setWrapS(mode: WrapMode): void;
    /**
     * Configure the T (V) wrap mode of the Sampler.
     */
    setWrapT(mode: WrapMode): void;
}
/**
 * An Image represents an embedded or external image used to provide texture
 * color data.
 *
 * @see https://github.com/KhronosGroup/glTF/tree/master/specification/2.0#reference-image
 */
declare interface Image$1 {
    /**
     * The name of the image, if any.
     */
    readonly name: string;
    /**
     * The type is 'external' if the image has a configured URI. Otherwise, it is
     * considered to be 'embedded'. Note: this distinction is only implied by the
     * glTF spec, and is made explicit here for convenience.
     */
    readonly type: 'embedded' | 'external';
    /**
     * The URI of the image, if it is external.
     */
    readonly uri?: string;
    /**
     * The bufferView of the image, if it is embedded.
     */
    readonly bufferView?: number;
    /**
     * A method to create an object URL of this image at the desired
     * resolution. Especially useful for KTX2 textures which are GPU compressed,
     * and so are unreadable on the CPU without a method like this.
     */
    createThumbnail(width: number, height: number): Promise<string>;
}
/**
 * An RGBA-encoded color, with channels represented as floating point values
 * from [0,1].
 */
declare type RGBA = [number, number, number, number];
declare type RGB = [number, number, number];

declare const $materials$1: unique symbol;
declare const $hierarchy: unique symbol;
declare const $roots: unique symbol;
declare const $primitivesList: unique symbol;
declare const $correlatedSceneGraph: unique symbol;
declare const $prepareVariantsForExport: unique symbol;
declare const $switchVariant: unique symbol;
declare const $threeScene: unique symbol;
declare const $materialsFromPoint: unique symbol;
declare const $materialFromPoint: unique symbol;
declare const $variantData: unique symbol;
declare const $availableVariants: unique symbol;
declare const $modelOnUpdate: unique symbol;
declare const $cloneMaterial: unique symbol;
declare class LazyLoader {
    gltf: GLTF$1;
    gltfElementMap: GLTFElementToThreeObjectMap;
    mapKey: GLTFElement$1;
    doLazyLoad: () => Promise<{
        set: ThreeObjectSet;
        material: Material$4;
    }>;
    constructor(gltf: GLTF$1, gltfElementMap: GLTFElementToThreeObjectMap, mapKey: GLTFElement$1, doLazyLoad: () => Promise<{
        set: ThreeObjectSet;
        material: Material$4;
    }>);
}
/**
 * Facades variant mapping data.
 */
interface VariantData {
    name: string;
    index: number;
}
/**
 * A Model facades the top-level GLTF object returned by Three.js' GLTFLoader.
 * Currently, the model only bothers itself with the materials in the Three.js
 * scene graph.
 */
declare class Model implements Model$1 {
    private [$materials$1];
    private [$hierarchy];
    private [$roots];
    private [$primitivesList];
    private [$threeScene];
    private [$modelOnUpdate];
    private [$correlatedSceneGraph];
    private [$variantData];
    constructor(correlatedSceneGraph: CorrelatedSceneGraph, onUpdate?: () => void);
    /**
     * Materials are listed in the order of the GLTF materials array, plus a
     * default material at the end if one is used.
     *
     * TODO(#1003): How do we handle non-active scenes?
     */
    get materials(): Material[];
    [$availableVariants](): string[];
    getMaterialByName(name: string): Material | null;
    /**
     * Intersects a ray with the Model and returns a list of materials whose
     * objects were intersected.
     */
    [$materialsFromPoint](raycaster: Raycaster): Material[];
    /**
     * Intersects a ray with the Model and returns the first material whose
     * object was intersected.
     */
    [$materialFromPoint](raycaster: Raycaster): Material | null;
    /**
     * Switches model variant to the variant name provided, or switches to
     * default/initial materials if 'null' is provided.
     */
    [$switchVariant](variantName: string | null): Promise<void>;
    [$prepareVariantsForExport](): Promise<void>;
    [$cloneMaterial](index: number, newMaterialName: string): Material;
    createMaterialInstanceForVariant(originalMaterialIndex: number, newMaterialName: string, variantName: string, activateVariant?: boolean): Material | null;
    createVariant(variantName: string): void;
    hasVariant(variantName: string): boolean;
    setMaterialToVariant(materialIndex: number, targetVariantName: string): void;
    updateVariantName(currentName: string, newName: string): void;
    deleteVariant(variantName: string): void;
}

declare const $correlatedObjects: unique symbol;
declare const $sourceObject: unique symbol;
declare const $onUpdate: unique symbol;
declare type CorrelatedObjects = Set<Object3D> | Set<Material$4> | Set<Texture$4>;
/**
 * A SerializableThreeDOMElement is the common primitive of all scene graph
 * elements that have been facaded in the host execution context. It adds
 * a common interface to these elements in support of convenient
 * serializability.
 */
declare class ThreeDOMElement {
    readonly [$onUpdate]: () => void;
    readonly [$sourceObject]: GLTFElement;
    [$correlatedObjects]: CorrelatedObjects | null;
    constructor(onUpdate: () => void, element: GLTFElement, correlatedObjects?: CorrelatedObjects | null);
}

declare const $threeTexture: unique symbol;
/**
 * Image facade implementation for Three.js textures
 */
declare class Image extends ThreeDOMElement implements Image$1 {
    get [$threeTexture](): Texture$4;
    constructor(onUpdate: () => void, texture: Texture$4 | null, gltfImage: Image$3 | null);
    get name(): string;
    get uri(): string | undefined;
    get bufferView(): number | undefined;
    get type(): 'embedded' | 'external';
    set name(name: string);
    createThumbnail(width: number, height: number): Promise<string>;
}

declare const $threeTextures: unique symbol;
declare const $setProperty: unique symbol;
declare const $sourceSampler: unique symbol;
/**
 * Sampler facade implementation for Three.js textures
 */
declare class Sampler extends ThreeDOMElement implements Sampler$1 {
    private get [$threeTextures]();
    private get [$sourceSampler]();
    constructor(onUpdate: () => void, texture: Texture$4 | null, gltfSampler: Sampler$3 | null);
    get name(): string;
    get minFilter(): MinFilter;
    get magFilter(): MagFilter;
    get wrapS(): WrapMode;
    get wrapT(): WrapMode;
    setMinFilter(filter: MinFilter): void;
    setMagFilter(filter: MagFilter): void;
    setWrapS(mode: WrapMode): void;
    setWrapT(mode: WrapMode): void;
    private [$setProperty];
}

declare const $image: unique symbol;
declare const $sampler: unique symbol;
/**
 * Material facade implementation for Three.js materials
 */
declare class Texture extends ThreeDOMElement implements Texture$1 {
    private [$image];
    private [$sampler];
    constructor(onUpdate: () => void, threeTexture: Texture$4 | null, gltfTexture?: Texture$3 | null, gltfSampler?: Sampler$3 | null, gltfImage?: Image$3 | null);
    get name(): string;
    set name(name: string);
    get sampler(): Sampler;
    get source(): Image;
}

declare const $texture: unique symbol;
declare const $transform: unique symbol;
declare const $materials: unique symbol;
declare const $usage: unique symbol;
declare enum TextureUsage {
    Base = 0,
    MetallicRoughness = 1,
    Normal = 2,
    Occlusion = 3,
    Emissive = 4
}
/**
 * TextureInfo facade implementation for Three.js materials
 */
declare class TextureInfo implements TextureInfo$1 {
    private [$texture];
    private [$transform];
    [$materials]: Set<MeshStandardMaterial> | null;
    [$usage]: TextureUsage;
    onUpdate: () => void;
    constructor(onUpdate: () => void, usage: TextureUsage, threeTexture: Texture$4 | null, material: Set<MeshStandardMaterial>, gltf: GLTF$1, gltfTextureInfo: TextureInfo$3 | null);
    get texture(): Texture | null;
    setTexture(texture: Texture | null): void;
}

declare const $threeMaterials: unique symbol;
declare const $baseColorTexture: unique symbol;
declare const $metallicRoughnessTexture: unique symbol;
/**
 * PBR material properties facade implementation for Three.js materials
 */
declare class PBRMetallicRoughness extends ThreeDOMElement implements PBRMetallicRoughness$1 {
    private [$baseColorTexture];
    private [$metallicRoughnessTexture];
    private get [$threeMaterials]();
    constructor(onUpdate: () => void, gltf: GLTF$1, pbrMetallicRoughness: PBRMetallicRoughness$3, correlatedMaterials: Set<MeshStandardMaterial>);
    get baseColorFactor(): RGBA;
    get metallicFactor(): number;
    get roughnessFactor(): number;
    get baseColorTexture(): TextureInfo;
    get metallicRoughnessTexture(): TextureInfo;
    setBaseColorFactor(rgba: RGBA): void;
    setMetallicFactor(value: number): void;
    setRoughnessFactor(value: number): void;
}

declare const $pbrMetallicRoughness: unique symbol;
declare const $normalTexture: unique symbol;
declare const $occlusionTexture: unique symbol;
declare const $emissiveTexture: unique symbol;
declare const $backingThreeMaterial: unique symbol;
declare const $applyAlphaCutoff: unique symbol;
declare const $lazyLoadGLTFInfo: unique symbol;
declare const $initialize: unique symbol;
declare const $getLoadedMaterial: unique symbol;
declare const $ensureMaterialIsLoaded: unique symbol;
declare const $gltfIndex: unique symbol;
declare const $setActive: unique symbol;
declare const $variantIndices: unique symbol;
declare const $isActive: unique symbol;
declare const $variantSet: unique symbol;
declare const $modelVariants: unique symbol;
/**
 * Material facade implementation for Three.js materials
 */
declare class Material extends ThreeDOMElement implements Material$1 {
    private [$pbrMetallicRoughness];
    private [$normalTexture];
    private [$occlusionTexture];
    private [$emissiveTexture];
    private [$lazyLoadGLTFInfo]?;
    private [$gltfIndex];
    private [$isActive];
    private [$variantSet];
    readonly [$modelVariants]: Map<string, VariantData>;
    get [$backingThreeMaterial](): MeshStandardMaterial;
    constructor(onUpdate: () => void, gltf: GLTF$1, gltfMaterial: Material$3, gltfIndex: number, isActive: boolean, modelVariants: Map<string, VariantData>, correlatedMaterials: Set<MeshStandardMaterial>, lazyLoadInfo?: LazyLoader | undefined);
    private [$initialize];
    [$getLoadedMaterial](): Promise<MeshStandardMaterial>;
    [$ensureMaterialIsLoaded](): void;
    ensureLoaded(): Promise<void>;
    get isLoaded(): boolean;
    get isActive(): boolean;
    [$setActive](isActive: boolean): void;
    get name(): string;
    set name(name: string);
    get pbrMetallicRoughness(): PBRMetallicRoughness;
    get normalTexture(): TextureInfo;
    get occlusionTexture(): TextureInfo;
    get emissiveTexture(): TextureInfo;
    get emissiveFactor(): RGB$1;
    get index(): number;
    [$variantIndices](): Set<number>;
    hasVariant(name: string): boolean;
    setEmissiveFactor(rgb: RGB$1): void;
    [$applyAlphaCutoff](): void;
    setAlphaCutoff(cutoff: number): void;
    getAlphaCutoff(): number;
    setDoubleSided(doubleSided: boolean): void;
    getDoubleSided(): boolean;
    setAlphaMode(alphaMode: AlphaMode): void;
    getAlphaMode(): AlphaMode;
}

interface SceneExportOptions {
    binary?: boolean;
    trs?: boolean;
    onlyVisible?: boolean;
    maxTextureSize?: number;
    includeCustomExtensions?: boolean;
    forceIndices?: boolean;
}
interface SceneGraphInterface {
    readonly model?: Model;
    variantName: string | null;
    readonly availableVariants: string[];
    orientation: string;
    scale: string;
    readonly originalGltfJson: GLTF | null;
    exportScene(options?: SceneExportOptions): Promise<Blob>;
    createTexture(uri: string, type?: string): Promise<Texture | null>;
    /**
     * Intersects a ray with the scene and returns a list of materials who's
     * objects were intersected.
     * @param pixelX X coordinate of the mouse.
     * @param pixelY Y coordinate of the mouse.
     * @returns a material, if no intersection is made then null is returned.
     */
    materialFromPoint(pixelX: number, pixelY: number): Material | null;
}

declare type HotspotData = {
    readonly position: Vector3D;
    readonly normal: Vector3D;
    readonly screenPosition: Vector3D;
    readonly facingCamera: boolean;
};
declare interface AnnotationInterface {
    updateHotspot(config: HotspotConfiguration): void;
    queryHotspot(name: string): HotspotData | null;
    positionAndNormalFromPoint(pixelX: number, pixelY: number): {
        position: Vector3D;
        normal: Vector3D;
        uv: Vector2D | null;
    } | null;
}

declare const ModelViewerElement: {
    new (...args: any[]): AnnotationInterface;
    prototype: AnnotationInterface;
} & object & {
    new (...args: any[]): SceneGraphInterface;
    prototype: SceneGraphInterface;
} & {
    new (...args: any[]): StagingInterface;
    prototype: StagingInterface;
} & {
    new (...args: any[]): EnvironmentInterface;
    prototype: EnvironmentInterface;
} & {
    new (...args: any[]): ControlsInterface;
    prototype: ControlsInterface;
} & {
    new (...args: any[]): ARInterface;
    prototype: ARInterface;
} & {
    new (...args: any[]): LoadingInterface;
    prototype: LoadingInterface;
} & LoadingStaticInterface & {
    new (...args: any[]): AnimationInterface;
    prototype: AnimationInterface;
} & typeof ModelViewerElementBase;
declare type ModelViewerElement = InstanceType<typeof ModelViewerElement>;

declare global {
    interface HTMLElementTagNameMap {
        'model-viewer': ModelViewerElement;
    }
}

export { ModelViewerElement, RGB$1 as RGB, RGBA$1 as RGBA };
