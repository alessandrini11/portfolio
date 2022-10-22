
    // to up button 
    const upButton = document.getElementById("up-button")
    upButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' })
    })
    // type js on hero 
    var typed = new Typed('#element2', {
        /**
         * @property {array} strings strings to be typed
         * @property {string} stringsElement ID of element containing string children
         */
        strings: [
            'Web Developper',
            'Freelancer',
            'App Designer',
            'FullStack Developper'
        ],
        stringsElement: null,

        /**
         * @property {number} typeSpeed type speed in milliseconds
         */
        typeSpeed: 100,

        /**
         * @property {number} backSpeed backspacing speed in milliseconds
         */
        backSpeed: 50,

        /**
         * @property {number} backDelay time before backspacing in milliseconds
         */
        backDelay: 700,

        /**
         * @property {boolean} loop loop strings
         * @property {number} loopCount amount of loops
         */
        loop: true,
        loopCount: Infinity,
    });
    var typed = new Typed('#element', {
        /**
         * @property {array} strings strings to be typed
         * @property {string} stringsElement ID of element containing string children
         */
        strings: [
            'Web Developper',
            'Freelancer',
            'App Designer',
            'FullStack Developper'
        ],
        stringsElement: null,

        /**
         * @property {number} typeSpeed type speed in milliseconds
         */
        typeSpeed: 100,

        /**
         * @property {number} backSpeed backspacing speed in milliseconds
         */
        backSpeed: 50,

        /**
         * @property {number} backDelay time before backspacing in milliseconds
         */
        backDelay: 700,

        /**
         * @property {boolean} loop loop strings
         * @property {number} loopCount amount of loops
         */
        loop: true,
        loopCount: Infinity,
    });
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
