{{--
    Large Landing Component - Black Background with Interactive Particles

    - Replaces the background glow effect with a dynamic particle animation.
    - Features a solid black background for high contrast.
    - Particles are interactive and respond to the user's cursor movements.
    - Call-to-action buttons are styled to be clear and consistent with the site's theme.
--}}

<div class="relative isolate bg-black overflow-hidden">

    <div id="particles-js" class="absolute inset-0 z-0"></div>

    <div class="relative z-10 mx-auto max-w-2xl px-6 py-32 sm:py-48 lg:py-56">
        <div class="text-center">
            <h1 class="text-balance text-5xl font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-b from-white to-gray-400 sm:text-7xl">
                Win with Data.
            </h1>
            <p class="mt-8 text-pretty text-lg font-normal text-gray-400 sm:text-xl/8">
                Our platform offers the stats, predictive tools, and insights you need to dominate your Fantasy Premier League season.
            </p>

            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="#" class="rounded-md bg-teal-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-teal-500/10 hover:bg-teal-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-500 transition-colors duration-300">
                    Get Started
                </a>
                <a href="#" class="text-sm font-semibold leading-6 text-white hover:text-gray-300 transition-colors">
                    Learn more <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('particles-js')) {
            particlesJS('particles-js', {
                "particles": {
                    "number": {
                        "value": 100,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#0d9488" // Teal color for particles
                    },
                    "shape": {
                        "type": "circle",
                    },
                    "opacity": {
                        "value": 0.5,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 0.2,
                            "opacity_min": 0.1,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 2,
                        "random": true,
                    },
                    "line_linked": {
                        "enable": true,
                        "distance": 150,
                        "color": "#ffffff",
                        "opacity": 0.1, // Faint lines connecting particles
                        "width": 1
                    },
                    "move": {
                        "enable": true,
                        "speed": 0.5, // Slow, drifting movement
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "out",
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": true,
                            "mode": "repulse" // Pushes particles away from the cursor
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "push" // Adds a few particles on click
                        },
                        "resize": true
                    },
                    "modes": {
                        "repulse": {
                            "distance": 100, // How far the cursor affects particles
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                    }
                },
                "retina_detect": true
            });
        }
    });
</script>