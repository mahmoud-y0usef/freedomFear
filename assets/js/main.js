jQuery(document).ready(function ($) {





    $('.js-select').niceSelect();
    $(document).on('click', '.menu-btn', function () {
        $(this).toggleClass('is-active');
        $('.sidebar').toggleClass('is-show');
    });

    const mediaHeader = window.matchMedia('(max-width: 959px)');

    function handleHeader(e) {
        if (e.matches) {
            $('.menu-btn').removeClass('is-active');
            $('.sidebar').removeClass('is-show');
            $(document).on('click', '.menu-btn', function () {
                $('body').toggleClass('no-scroll');
            });
        } else {
            $('.menu-btn').addClass('is-active');
            $('.sidebar').addClass('is-show');
            $('body').removeClass('no-scroll');
        }
    }





    $(".sidebar-hider .icon-arrow-left").click(function () {
        $(".sidebar").removeClass("is-show");
        $(".sidebar").addClass("is-hide");
        $(document).on('click', '.menu-btn', function () {
            $('body').toggleClass('no-scroll');
        });
    });


    $(".sidebar-hider .icon-arrow-right").click(function () {
        $(".sidebar").removeClass("is-hide");
        $(".sidebar").addClass("is-show");
    });



    /////////////////////////////////////////////////////////////////
    // Preloader
    /////////////////////////////////////////////////////////////////

    var $preloader = $('#page-preloader'),
        $spinner = $preloader.find('.spinner-loader');
    $spinner.fadeOut();
    $preloader.delay(250).fadeOut('slow');



    mediaHeader.addListener(handleHeader);
    handleHeader(mediaHeader);
    const recommendSlider = new Swiper('.js-recommend .swiper', {
        slidesPerView: 1,
        spaceBetween: 40,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        autoplay: {
            delay: 5000
        },
        navigation: {
            nextEl: '.js-recommend .swiper-button-next',
            prevEl: '.js-recommend .swiper-button-prev'
        },
        pagination: {
            el: '.js-recommend .swiper-pagination',
            type: 'bullets',
            // 'bullets', 'fraction', 'progressbar'
            clickable: true
        }
    });
    const trendingSlider = new Swiper('.js-trending .swiper', {
        slidesPerView: 1,
        spaceBetween: 40,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        autoplay: {
            delay: 5000
        },
        navigation: {
            nextEl: '.js-trending .swiper-button-next',
            prevEl: '.js-trending .swiper-button-prev'
        },
        pagination: {
            el: '.js-trending .swiper-pagination',
            type: 'bullets',
            // 'bullets', 'fraction', 'progressbar'
            clickable: true
        }
    });



    const popularStore = new Swiper('.js-store .swiper', {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        autoplay: {
            delay: 5000
        },
        navigation: {
            nextEl: '.js-store .swiper-button-next',
            prevEl: '.js-store .swiper-button-prev'
        },
        pagination: {
            el: '.js-store .swiper-pagination',
            type: 'bullets',
            // 'bullets', 'fraction', 'progressbar'
            clickable: true
        },
        breakpoints: {
            575: {
                slidesPerView: 1,
                spaceBetween: 25
            },
            1199: {
                slidesPerView: 4,
                spaceBetween: 25
            },
            1599: {
                slidesPerView: 5,
                spaceBetween: 25
            }
        }
    });






    const popularSlider = new Swiper('.js-popular .swiper', {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        autoplay: {
            delay: 5000
        },
        navigation: {
            nextEl: '.js-popular .swiper-button-next',
            prevEl: '.js-popular .swiper-button-prev'
        },
        pagination: {
            el: '.js-popular .swiper-pagination',
            type: 'bullets',
            // 'bullets', 'fraction', 'progressbar'
            clickable: true
        },
        breakpoints: {
            575: {
                slidesPerView: 1,
                spaceBetween: 25
            },
            1199: {
                slidesPerView: 2,
                spaceBetween: 25
            },
            1599: {
                slidesPerView: 4,
                spaceBetween: 25
            }
        }
    });



    const popularSlider2 = new Swiper('.js-popular2 .swiper', {
        slidesPerView: 1,
        spaceBetween: 25,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        autoplay: {
            delay: 5000
        },
        navigation: {
            nextEl: '.js-popular2 .swiper-button-next',
            prevEl: '.js-popular2 .swiper-button-prev'
        },
        pagination: {
            el: '.js-popular2 .swiper-pagination',
            type: 'bullets',
            // 'bullets', 'fraction', 'progressbar'
            clickable: true
        },
        breakpoints: {
            575: {
                slidesPerView: 1,
                spaceBetween: 25
            },
            1199: {
                slidesPerView: 2,
                spaceBetween: 25
            },
            1599: {
                slidesPerView: 3,
                spaceBetween: 25
            }
        }
    });




    const gallerySmall = new Swiper('.js-gallery-small .swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        pagination: {
            el: '.js-gallery-small .swiper-pagination',
            type: 'bullets',
            // 'bullets', 'fraction', 'progressbar'
            clickable: true
        },
        breakpoints: {
            575: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            767: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1599: {
                slidesPerView: 4,
                spaceBetween: 20
            }
        }
    });
    const galleryBig = new Swiper('.js-gallery-big .swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        watchOverflow: true,
        observeParents: true,
        observeSlideChildren: true,
        observer: true,
        speed: 800,
        thumbs: {
            swiper: gallerySmall
        }
    });
});


const displacementSlider = function(opts) {

    let vertex = `
        varying vec2 vUv;
        void main() {
          vUv = uv;
          gl_Position = projectionMatrix * modelViewMatrix * vec4( position, 1.0 );
        }
    `;

    let fragment = `
        
        varying vec2 vUv;

        uniform sampler2D currentImage;
        uniform sampler2D nextImage;

        uniform float dispFactor;

        void main() {

            vec2 uv = vUv;
            vec4 _currentImage;
            vec4 _nextImage;
            float intensity = 0.3;

            vec4 orig1 = texture2D(currentImage, uv);
            vec4 orig2 = texture2D(nextImage, uv);
            
            _currentImage = texture2D(currentImage, vec2(uv.x, uv.y + dispFactor * (orig2 * intensity)));

            _nextImage = texture2D(nextImage, vec2(uv.x, uv.y + (1.0 - dispFactor) * (orig1 * intensity)));

            vec4 finalTexture = mix(_currentImage, _nextImage, dispFactor);

            gl_FragColor = finalTexture;

        }
    `;

    let images = opts.images, image, sliderImages = [];;
    let canvasWidth = images[0].clientWidth;
    let canvasHeight = images[0].clientHeight;
    let parent = opts.parent;
    let renderWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    let renderHeight = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

    let renderW, renderH;

    if( renderWidth > canvasWidth ) {
        renderW = renderWidth;
    } else {
        renderW = canvasWidth;
    }

    renderH = canvasHeight;

    let renderer = new THREE.WebGLRenderer({
        antialias: false,
    });

    renderer.setPixelRatio( window.devicePixelRatio );
    renderer.setClearColor( 0x23272A, 1.0 );
    renderer.setSize( renderW, renderH );
    parent.appendChild( renderer.domElement );

    let loader = new THREE.TextureLoader();
    loader.crossOrigin = "anonymous";

    images.forEach( ( img ) => {

        image = loader.load( img.getAttribute( 'src' ) + '?v=' + Date.now() );
        image.magFilter = image.minFilter = THREE.LinearFilter;
        image.anisotropy = renderer.capabilities.getMaxAnisotropy();
        sliderImages.push( image );

    });

    let scene = new THREE.Scene();
    scene.background = new THREE.Color( 0x23272A );
    let camera = new THREE.OrthographicCamera(
        renderWidth / -2,
        renderWidth / 2,
        renderHeight / 2,
        renderHeight / -2,
        1,
        1000
    );

    camera.position.z = 1;

    let mat = new THREE.ShaderMaterial({
        uniforms: {
            dispFactor: { type: "f", value: 0.0 },
            currentImage: { type: "t", value: sliderImages[0] },
            nextImage: { type: "t", value: sliderImages[1] },
        },
        vertexShader: vertex,
        fragmentShader: fragment,
        transparent: true,
        opacity: 1.0
    });

    let geometry = new THREE.PlaneBufferGeometry(
        parent.offsetWidth,
        parent.offsetHeight,
        1
    );
    let object = new THREE.Mesh(geometry, mat);
    object.position.set(0, 0, 0);
    scene.add(object);

    let addEvents = function(){

        let pagButtons = Array.from(document.getElementById('pagination').querySelectorAll('button'));
        let isAnimating = false;

        pagButtons.forEach( (el) => {

            el.addEventListener('click', function() {

                if( !isAnimating ) {

                    isAnimating = true;

                    document.getElementById('pagination').querySelectorAll('.active')[0].className = '';
                    this.className = 'active';

                    let slideId = parseInt( this.dataset.slide, 10 );

                    mat.uniforms.nextImage.value = sliderImages[slideId];
                    mat.uniforms.nextImage.needsUpdate = true;

                    TweenLite.to( mat.uniforms.dispFactor, 1, {
                        value: 1,
                        ease: 'Expo.easeInOut',
                        onComplete: function () {
                            mat.uniforms.currentImage.value = sliderImages[slideId];
                            mat.uniforms.currentImage.needsUpdate = true;
                            mat.uniforms.dispFactor.value = 0.0;
                            isAnimating = false;
                        }
                    });


                }

            });

        });

    };

    addEvents();

    window.addEventListener( 'resize' , function(e) {
        renderer.setSize(renderW, renderH);
    });

    let animate = function() {
        requestAnimationFrame(animate);

        renderer.render(scene, camera);
    };
    animate();
};

document.addEventListener('DOMContentLoaded', function() {
    imagesLoaded(document.querySelectorAll('.img_loaded'), () => {
        document.body.classList.remove('loading');

        const el = document.getElementById('slider');
        if (el) {
            const imgs = Array.from(el.querySelectorAll('.img_loaded'));
            new displacementSlider({
                parent: el,
                images: imgs
            });
        } else {
            console.warn('Element with ID "slider" not found.');
        }
    });
});
