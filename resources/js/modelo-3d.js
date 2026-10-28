import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { RoomEnvironment } from 'three/addons/environments/RoomEnvironment.js';

document
    .querySelectorAll('[data-viewer-3d]')
    .forEach((viewer) => {
        iniciarViewer(viewer);
    });

function iniciarViewer(viewer) {
    const canvasContainer = viewer.querySelector(
        '[data-viewer-canvas]'
    );

    const loading = viewer.querySelector(
        '[data-viewer-loading]'
    );

    const error = viewer.querySelector(
        '[data-viewer-error]'
    );

    const resetButton = viewer.querySelector(
        '[data-viewer-reset]'
    );

    const rotateButton = viewer.querySelector(
        '[data-viewer-rotate]'
    );

    const fullscreenButton = viewer.querySelector(
        '[data-viewer-fullscreen]'
    );

    const url = viewer.dataset.model;

    if (!canvasContainer || !url) {
        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Cena
    |--------------------------------------------------------------------------
    */

    const scene = new THREE.Scene();

    scene.background = new THREE.Color(
        0x0f172a
    );

    /*
    |--------------------------------------------------------------------------
    | Câmera
    |--------------------------------------------------------------------------
    */

    const camera = new THREE.PerspectiveCamera(
        45,
        canvasContainer.clientWidth /
            canvasContainer.clientHeight,
        0.01,
        1000
    );

    /*
    |--------------------------------------------------------------------------
    | Renderer
    |--------------------------------------------------------------------------
    */

    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        powerPreference: 'high-performance',
    });

    renderer.setPixelRatio(
        Math.min(
            window.devicePixelRatio,
            2.5
        )
    );

    renderer.setSize(
        canvasContainer.clientWidth,
        canvasContainer.clientHeight
    );

    renderer.outputColorSpace =
        THREE.SRGBColorSpace;

    renderer.toneMapping =
        THREE.ACESFilmicToneMapping;

    renderer.toneMappingExposure = 1.45;

    renderer.shadowMap.enabled = false;

    renderer.domElement.style.display =
        'block';

    renderer.domElement.style.width =
        '100%';

    renderer.domElement.style.height =
        '100%';

    canvasContainer.appendChild(
        renderer.domElement
    );

    /*
    |--------------------------------------------------------------------------
    | Ambiente
    |--------------------------------------------------------------------------
    */

    const pmremGenerator =
        new THREE.PMREMGenerator(
            renderer
        );

    const environment =
        pmremGenerator.fromScene(
            new RoomEnvironment(),
            0.04
        );

    scene.environment =
        environment.texture;

    pmremGenerator.dispose();

    /*
    |--------------------------------------------------------------------------
    | Controles
    |--------------------------------------------------------------------------
    */

    const controls = new OrbitControls(
        camera,
        renderer.domElement
    );

    controls.enableDamping = true;
    controls.dampingFactor = 0.05;

    controls.enableRotate = true;
    controls.enableZoom = true;
    controls.enablePan = true;

    controls.autoRotate = false;
    controls.autoRotateSpeed = 1;

    /*
    |--------------------------------------------------------------------------
    | Iluminação
    |--------------------------------------------------------------------------
    */

    const ambientLight =
        new THREE.AmbientLight(
            0xffffff,
            2
        );

    scene.add(
        ambientLight
    );

    const mainLight =
        new THREE.DirectionalLight(
            0xffffff,
            2.2
        );

    mainLight.position.set(
        4,
        6,
        6
    );

    scene.add(
        mainLight
    );

    const fillLight =
        new THREE.DirectionalLight(
            0xffffff,
            1.6
        );

    fillLight.position.set(
        -4,
        3,
        5
    );

    scene.add(
        fillLight
    );

    const bottomLight =
        new THREE.DirectionalLight(
            0xffffff,
            1
        );

    bottomLight.position.set(
        0,
        -5,
        3
    );

    scene.add(
        bottomLight
    );

    const backLight =
        new THREE.DirectionalLight(
            0xffffff,
            1.1
        );

    backLight.position.set(
        0,
        4,
        -5
    );

    scene.add(
        backLight
    );

    /*
    |--------------------------------------------------------------------------
    | Loader
    |--------------------------------------------------------------------------
    */

    const loader =
        new GLTFLoader();

    let modelo = null;

    loader.load(
        url,

        (gltf) => {
            modelo =
                gltf.scene;

            prepararModelo(
                modelo
            );

            scene.add(
                modelo
            );

            modelo.updateMatrixWorld(
                true
            );

            enquadrarModelo(
                modelo
            );

            loading?.classList.add(
                'hidden'
            );
        },

        undefined,

        (erroCarregamento) => {
            console.error(
                'Erro ao carregar modelo 3D:',
                erroCarregamento
            );

            loading?.classList.add(
                'hidden'
            );

            error?.classList.remove(
                'hidden'
            );

            error?.classList.add(
                'flex'
            );
        }
    );

    /*
    |--------------------------------------------------------------------------
    | Preparação do modelo
    |--------------------------------------------------------------------------
    */

    function prepararModelo(object) {
        const maxAnisotropy =
            renderer
                .capabilities
                .getMaxAnisotropy();

        object.traverse(
            (child) => {
                if (!child.isMesh) {
                    return;
                }

                const materiais =
                    Array.isArray(
                        child.material
                    )
                        ? child.material
                        : [
                            child.material
                        ];

                materiais.forEach(
                    (material) => {
                        if (!material) {
                            return;
                        }

                        prepararTexturas(
                            material,
                            maxAnisotropy
                        );

                        material.needsUpdate =
                            true;
                    }
                );
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Texturas
    |--------------------------------------------------------------------------
    */

    function prepararTexturas(
        material,
        maxAnisotropy
    ) {
        const textures = [
            material.map,
            material.normalMap,
            material.roughnessMap,
            material.metalnessMap,
            material.aoMap,
            material.emissiveMap,
            material.alphaMap,
        ];

        textures.forEach(
            (texture) => {
                if (!texture) {
                    return;
                }

                texture.anisotropy =
                    maxAnisotropy;

                texture.needsUpdate =
                    true;
            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Bounding box principal
    |--------------------------------------------------------------------------
    |
    | Evita que textos, legendas e linhas muito
    | pequenas do GLB afastem demais a câmera.
    |
    */

    function obterBoundingBoxPrincipal(
        object
    ) {
        const meshes = [];

        object.traverse(
            (child) => {
                if (
                    !child.isMesh ||
                    !child.geometry
                ) {
                    return;
                }

                const box =
                    new THREE.Box3()
                        .setFromObject(
                            child
                        );

                if (box.isEmpty()) {
                    return;
                }

                const size =
                    box.getSize(
                        new THREE.Vector3()
                    );

                const volume =
                    size.x *
                    size.y *
                    size.z;

                meshes.push({
                    box,
                    volume,
                });
            }
        );

        if (
            meshes.length === 0
        ) {
            return new THREE.Box3()
                .setFromObject(
                    object
                );
        }

        const maiorVolume =
            Math.max(
                ...meshes.map(
                    (item) =>
                        item.volume
                )
            );

        const limiteVolume =
            maiorVolume *
            0.002;

        const boxPrincipal =
            new THREE.Box3();

        let encontrouMesh =
            false;

        meshes.forEach(
            ({
                box,
                volume,
            }) => {
                if (
                    volume <
                    limiteVolume
                ) {
                    return;
                }

                boxPrincipal.union(
                    box
                );

                encontrouMesh =
                    true;
            }
        );

        if (
            !encontrouMesh
        ) {
            return new THREE.Box3()
                .setFromObject(
                    object
                );
        }

        return boxPrincipal;
    }

    /*
    |--------------------------------------------------------------------------
    | Enquadramento
    |--------------------------------------------------------------------------
    */

    function enquadrarModelo(
        object
    ) {
        const box =
            obterBoundingBoxPrincipal(
                object
            );

        if (box.isEmpty()) {
            return;
        }

        const size =
            box.getSize(
                new THREE.Vector3()
            );

        const center =
            box.getCenter(
                new THREE.Vector3()
            );

        const verticalFov =
            THREE.MathUtils.degToRad(
                camera.fov
            );

        const horizontalFov =
            2 *
            Math.atan(
                Math.tan(
                    verticalFov / 2
                ) *
                    camera.aspect
            );

        const distanceHeight =
            size.y /
            (
                2 *
                Math.tan(
                    verticalFov / 2
                )
            );

        const distanceWidth =
            size.x /
            (
                2 *
                Math.tan(
                    horizontalFov / 2
                )
            );

        let distance =
            Math.max(
                distanceHeight,
                distanceWidth
            );

        distance +=
            size.z * 0.45;

        /*
         * Margem do enquadramento.
         *
         * Menor = modelo maior.
         * Maior = mais espaço ao redor.
         */

        distance *= 1.05;

        camera.position.set(
            center.x,
            center.y,
            center.z +
                distance
        );

        camera.near =
            Math.max(
                distance / 100,
                0.001
            );

        camera.far =
            Math.max(
                distance * 100,
                100
            );

        camera
            .updateProjectionMatrix();

        controls.target.copy(
            center
        );

        controls.minDistance =
            Math.max(
                distance * 0.2,
                0.001
            );

        controls.maxDistance =
            distance * 6;

        controls.update();
    }

    /*
    |--------------------------------------------------------------------------
    | Reset
    |--------------------------------------------------------------------------
    */

    resetButton?.addEventListener(
        'click',
        () => {
            if (!modelo) {
                return;
            }

            controls.autoRotate =
                false;

            atualizarBotaoRotacao();

            enquadrarModelo(
                modelo
            );
        }
    );

    /*
    |--------------------------------------------------------------------------
    | Rotação automática
    |--------------------------------------------------------------------------
    */

    rotateButton?.addEventListener(
        'click',
        () => {
            controls.autoRotate =
                !controls.autoRotate;

            atualizarBotaoRotacao();
        }
    );

    function atualizarBotaoRotacao() {
        if (!rotateButton) {
            return;
        }

        rotateButton.classList.toggle(
            'bg-emerald-500/20',
            controls.autoRotate
        );

        rotateButton.classList.toggle(
            'text-emerald-400',
            controls.autoRotate
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Fullscreen
    |--------------------------------------------------------------------------
    */

    fullscreenButton?.addEventListener(
        'click',
        async () => {
            try {
                if (
                    !document
                        .fullscreenElement
                ) {
                    await viewer
                        .requestFullscreen();

                    return;
                }

                await document
                    .exitFullscreen();
            } catch (
                erroFullscreen
            ) {
                console.error(
                    'Erro ao alternar tela cheia:',
                    erroFullscreen
                );
            }
        }
    );

    document.addEventListener(
        'fullscreenchange',
        () => {
            atualizarIconeFullscreen();

            requestAnimationFrame(
                () => {
                    resize();

                    if (modelo) {
                        enquadrarModelo(
                            modelo
                        );
                    }
                }
            );
        }
    );

    function atualizarIconeFullscreen() {
        if (
            !fullscreenButton
        ) {
            return;
        }

        const icon =
            fullscreenButton
                .querySelector(
                    'i'
                );

        if (!icon) {
            return;
        }

        const fullscreenAtivo =
            document
                .fullscreenElement ===
            viewer;

        icon.classList.toggle(
            'fa-expand',
            !fullscreenAtivo
        );

        icon.classList.toggle(
            'fa-compress',
            fullscreenAtivo
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Resize
    |--------------------------------------------------------------------------
    */

    function resize() {
        const width =
            canvasContainer
                .clientWidth;

        const height =
            canvasContainer
                .clientHeight;

        if (
            !width ||
            !height
        ) {
            return;
        }

        camera.aspect =
            width / height;

        camera
            .updateProjectionMatrix();

        renderer.setPixelRatio(
            Math.min(
                window.devicePixelRatio,
                2.5
            )
        );

        renderer.setSize(
            width,
            height,
            false
        );
    }

    const resizeObserver =
        new ResizeObserver(
            () => {
                resize();
            }
        );

    resizeObserver.observe(
        canvasContainer
    );

    /*
    |--------------------------------------------------------------------------
    | Renderização
    |--------------------------------------------------------------------------
    */

    renderer.setAnimationLoop(
        () => {
            controls.update();

            renderer.render(
                scene,
                camera
            );
        }
    );
}
