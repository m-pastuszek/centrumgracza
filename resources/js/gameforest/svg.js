/**
 * ---------------------------------------------------------------------------------------
 * Gameforest Bootstrap Gaming Theme: svg.js
 * Copyright (c) 2019 yakuthemes.com (https://yakuthemes.com)
 *
 * @link      https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730
 * @version   5.0.3
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPLv3 License
 * ---------------------------------------------------------------------------------------
 */

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

const DATA                   = 'ya-svg'
const DATA_KEY               = `[${DATA}]`
const VERSION                = '1.0.0'

/**
 * ------------------------------------------------------------------------
 * Class Definition
 * ------------------------------------------------------------------------
 */

class Svg {
    constructor(element) {
        this._element       = element
        this._attr          = element.getAttribute(DATA)
    }

    static get VERSION() {
        return VERSION
    }

    _get() {
        const svg = {
            twitch              : '<svg id="Layer_1" data-name="Layer 1" height="48" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 134"><defs><style>.cls-1{fill:#6441a4;fill-rule:evenodd;}</style></defs><title>Glitch</title><path class="cls-1" d="M89,77l-9,23v94h32v17h18l17-17h26l35-35V77H89Zm107,76-20,20H144l-17,17V173H100V89h96v64Zm-20-41v35H164V112h12Zm-32,0v35H132V112h12Z" transform="translate(-80 -77)"/></svg>',
            youtube             : '<svg enable-background="new 0 0 32 32" height="48" id="Layer_1" version="1.0" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M31.67,9.179c0,0-0.312-2.353-1.271-3.389c-1.217-1.358-2.58-1.366-3.205-1.443C22.717,4,16.002,4,16.002,4   h-0.015c0,0-6.715,0-11.191,0.347C4.171,4.424,2.809,4.432,1.591,5.79C0.633,6.826,0.32,9.179,0.32,9.179S0,11.94,0,14.701v2.588   c0,2.763,0.32,5.523,0.32,5.523s0.312,2.352,1.271,3.386c1.218,1.358,2.815,1.317,3.527,1.459C7.677,27.919,15.995,28,15.995,28   s6.722-0.012,11.199-0.355c0.625-0.08,1.988-0.088,3.205-1.446c0.958-1.034,1.271-3.386,1.271-3.386s0.32-2.761,0.32-5.523v-2.588   C31.99,11.94,31.67,9.179,31.67,9.179z" fill="#E02F2F"/><polygon fill="#FFFFFF" points="12,10 12,22 22,16  "/></g><g/><g/><g/><g/><g/><g/></svg>',
            mixer               : '<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 457.3 133.3" height="48"><style>.st0,.st1{fill-rule:evenodd;clip-rule:evenodd;fill:#1d2550}.st1{fill:#34bae8}</style><path class="st0" d="M21.4 127.9c-2.7 1.9-17.6 3-19.9 1.4-1.6-1.1-1.4-2.7-1.4-4.3 0-27.5 0-55-.1-82.5 0-3.8 1.8-4.3 4.8-3.9 8 1 13.2 5.6 16.6 13.5 6.1-7 12.7-12.2 21.9-13.3 11.8-1.3 22 .9 28.7 11.9 1.9 3.1 3.3 2 5.2-.3 9-11 20.8-13.7 34.2-11.2 10.4 1.9 16.7 8.4 19.7 18.3 1.5 5.2 2.2 10.5 2.2 15.8 0 16.8-.1 33.7.1 50.5.1 4.7-1.6 6.1-6.2 6.1-15.7 0-15.7.2-15.7-15.5 0-11.7.1-23.4-.1-35 0-3.7-.5-7.5-1.2-11.2-1.1-5.9-4.3-10-10.6-11.3-6.6-1.4-12.1.3-16.4 5.6-4.2 5.2-5.6 11.3-5.6 17.7-.1 14.5-.2 28.9 0 43.4.1 4.5-1.3 6.3-6.1 6.3-15.7.1-15.7.2-15.7-15.4 0-13.5.2-26.9-.2-40.4-.4-12.4-8.2-19.6-18.8-17.5-9.1 1.8-12.7 8.6-14.1 16.9-1.2 2.6-.9 5.4-.9 8.1-.2 15.6-.3 31-.4 46.3z"/><path class="st1" d="M356.2 93c-7.5 0-15 .1-22.6 0-4.7-.1-5.1 1.9-3.9 5.9 2.5 8.6 9 11.8 16.7 13.7 6.5 1.6 13.1.9 19.5-.8 4.4-1.2 6.3 2.4 8.6 5 6 7 4.3 12.6-4.7 13.8-8.4 1.1-16.6 3.2-25.3 2.7-22.8-1.2-37.2-15.9-39.2-38.2-1.1-12.9-1-25.7 6.1-37.1 9.8-15.7 23.7-21.8 42.9-20.1 14.5 1.3 23.9 9.3 30 21.5 4 8 4.9 17.1 3.6 26-.7 4.4-4.1 7.5-9.2 7.5-7.4 0-14.9 0-22.5.1 0-.1 0-.1 0 0zm-9.4-17.9c4.9 0 9.9-.1 14.8 0 3.1 0 4-1.1 3.4-4.3-1.5-8.9-7.5-14.3-16.7-14.3-8.5 0-18 7.5-19 15.1-.3 2.6.7 3.6 3.3 3.6 4.7-.2 9.4-.1 14.2-.1zM426.2 83.8c-.2 12.2-1.7 24.3-.2 36.6 1 8-1.2 10.8-9.8 10.6-14.6-.4-14.4 0-14.3-14.9.2-23.1 0-46.3.1-69.4 0-2.9-1.7-7.7 2-8.3 4.3-.7 9.3-.7 13.5 2.4 3.2 2.3 3.1 8.6 7.4 8.3 3-.3 5.2-4.6 8.3-6.8 6.4-4.4 13.5-1.6 20.2-3 1.5-.3 3.2 1.7 3.3 3 .5 5.3 1.5 10.7-.5 15.8-1.5 3.7-4.6 4.4-8.4 3.1-7.1-2.5-14.4.7-18.7 6.9-3.6 4.9-2.7 10.3-2.9 15.7zM284.1 133.3c-5.7-.2-8.4-4.5-11.3-8.4-8.4-11.3-16.2-23.1-25.2-33.8-3.9-4.7-3.5-8.1-.3-11.6 10-10.7 17.3-23.3 25.8-35 3.2-4.4 7.4-8.9 13.7-7.5 5.4 1.2 9.4 4.8 9.9 10.9.4 4.5-1.6 8.1-4.1 11.5-5.4 7.3-10.8 14.5-16.5 21.5-2.5 3.1-2.2 5.2.2 8.3 6.5 8.4 12.4 17.2 18.8 25.6 3.1 4 3.2 7.6.8 11.9-2.6 4.7-6.7 6.2-11.8 6.6z"/><path class="st0" d="M200.9 132.2c-4.3-.1-7.8-1.7-9.8-5.6-2.3-4.5-1.5-8.9 1.4-12.8 6.1-8.3 12.2-16.5 18.5-24.6 2.3-2.9 2.4-5.2 0-8.2-6.5-8.2-12.6-16.7-18.8-25.2-3.1-4.3-3.3-8.9-.2-13.3 2.7-3.8 6.6-4.8 11-4.1 3.2.5 5.3 2.6 7.1 5 9.4 12.5 18.6 25 28.1 37.5 2.3 3 2.3 5.2 0 8.3-9.5 12.4-18.7 25-28 37.5-2.3 3.2-5.3 5.2-9.3 5.5zM172.4 87.8c0 12.1-.1 24.2.1 36.2.1 4.2-1.1 6-5.7 6-16.2.2-16.2.3-16.2-15.7V50.7c0-8.2 5.4-13.3 12.4-12.3 5.7.8 9.2 5.2 9.3 11.9.2 12.5.1 25 .1 37.5zM161.8 0c6.5.1 11.5 5.3 11.3 11.8-.2 6.2-5.3 11.3-11.4 11.3-6.7.1-12.1-5.3-12-12 .2-6.3 5.4-11.2 12.1-11.1z"/><path class="st1" d="M21.4 127.9l.3-46.1c0-2.7-.3-5.5.9-8.1 0 16.3 0 32.6-.1 48.9 0 1.8 1.1 4-1.1 5.3z"/></svg>',
            rss                 : '<svg xmlns="http://www.w3.org/2000/svg" id="RSSicon" viewBox="0 0 8 8" height="48"><title>RSS feed icon</title><style type="text/css">.button {stroke: none; fill: orange;} .symbol {stroke: none; fill: white;}</style><rect   class="button" width="8" height="8" rx="1.5" /><circle class="symbol" cx="2" cy="6" r="1" /><path class="symbol" d="m 1,4 a 3,3 0 0 1 3,3 h 1 a 4,4 0 0 0 -4,-4 z" /><path class="symbol" d="m 1,2 a 5,5 0 0 1 5,5 h 1 a 6,6 0 0 0 -6,-6 z" /></svg>',

            divider   : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none"><path  d="M0,6V0h1000v100L0,6z"></path></svg>',
            chat      : '<svg viewBox="0 0 48 48" width="48" height="48"><g><path d="M45,3H3A2,2,0,0,0,1,5V35a2,2,0,0,0,2,2h8v9a1,1,0,0,0,1,1,.988.988,0,0,0,.581-.187L26.32,37H45a2,2,0,0,0,2-2V5A2,2,0,0,0,45,3Z" fill="#ea9860"></path> <path d="M21,29H8a1,1,0,0,1,0-2H21a1,1,0,0,1,0,2Z" fill="#fff"></path> <path d="M40,29H27a1,1,0,0,1,0-2H40a1,1,0,0,1,0,2Z" fill="#fff"></path> <path d="M30,23H8a1,1,0,0,1,0-2H30a1,1,0,0,1,0,2Z" fill="#fff"></path> <path d="M40,23H36a1,1,0,0,1,0-2h4a1,1,0,0,1,0,2Z" fill="#fff"></path></g></svg>',
            article   : '<svg viewBox="0 0 48 48" width="48" height="48"><g><path fill="#444444" d="M45,45H3c-1.105,0-2-0.895-2-2V5c0-1.105,0.895-2,2-2h42c1.105,0,2,0.895,2,2v38C47,44.105,46.105,45,45,45z "></path> <rect x="3" y="10" fill="#FFFFFF" width="42" height="33"></rect> <circle fill="#E86C60" cx="4.5" cy="6.5" r="1.5"></circle> <circle fill="#EFD358" cx="9.5" cy="6.5" r="1.5"></circle> <circle fill="#72C472" cx="14.5" cy="6.5" r="1.5"></circle> <path fill="#43A6DD" d="M20,28H8c-0.552,0-1-0.447-1-1V15c0-0.553,0.448-1,1-1h12c0.552,0,1,0.447,1,1v12C21,27.553,20.552,28,20,28 z"></path> <path fill="#B3B3B3" d="M40,16H26c-0.552,0-1-0.447-1-1s0.448-1,1-1h14c0.552,0,1,0.447,1,1S40.552,16,40,16z"></path> <path fill="#B3B3B3" d="M40,22H26c-0.552,0-1-0.447-1-1s0.448-1,1-1h14c0.552,0,1,0.447,1,1S40.552,22,40,22z"></path> <path fill="#B3B3B3" d="M40,33H8c-0.552,0-1-0.447-1-1s0.448-1,1-1h32c0.552,0,1,0.447,1,1S40.552,33,40,33z"></path> <path fill="#B3B3B3" d="M32,39H8c-0.552,0-1-0.447-1-1s0.448-1,1-1h24c0.552,0,1,0.447,1,1S32.552,39,32,39z"></path> <path fill="#B3B3B3" d="M35,28h-9c-0.552,0-1-0.447-1-1s0.448-1,1-1h9c0.552,0,1,0.447,1,1S35.552,28,35,28z"></path></g></svg>',
            monkey    : '<svg viewBox="0 0 48 48" width="48" height="48"><g><circle cx="8" cy="20" r="7" fill="#ead8c5"></circle> <path d="M8,28a8,8,0,1,1,8-8A8.009,8.009,0,0,1,8,28ZM8,14a6,6,0,1,0,6,6A6.006,6.006,0,0,0,8,14Z" fill="#87613e"></path> <circle cx="40" cy="20" r="7" fill="#ead8c5"></circle> <path d="M40,28a8,8,0,1,1,8-8A8.009,8.009,0,0,1,40,28Zm0-14a6,6,0,1,0,6,6A6.006,6.006,0,0,0,40,14Z" fill="#87613e"></path> <path d="M24,44A20,20,0,1,1,44,24,20.023,20.023,0,0,1,24,44Z" fill="#87613e"></path> <path d="M24,41A12,12,0,1,1,36,29,12.013,12.013,0,0,1,24,41Z" fill="#ead8c5"></path> <path d="M17,28a8,8,0,1,1,8-8A8.009,8.009,0,0,1,17,28Z" fill="#ead8c5"></path> <path d="M31,28a8,8,0,1,1,8-8A8.009,8.009,0,0,1,31,28Z" fill="#ead8c5"></path> <path d="M17,23a3,3,0,1,1,3-3A3,3,0,0,1,17,23Z" fill="#444"></path> <path d="M31,23a3,3,0,1,1,3-3A3,3,0,0,1,31,23Z" fill="#444"></path> <path d="M21,7a8.277,8.277,0,0,1,8-7c-2,1-1,6-1,6Z" fill="#87613e"></path> <circle cx="22" cy="25" r="1" fill="#c6a279"></circle> <circle cx="26" cy="25" r="1" fill="#c6a279"></circle> <path d="M36,47a4.975,4.975,0,0,1-2.476-.66l-7-4a5,5,0,1,1,4.96-8.682l7,4A5,5,0,0,1,36,47Z" fill="#a67c52"></path> <path d="M12.005,47A5,5,0,0,1,9.52,37.659l7-4a5,5,0,0,1,4.96,8.682l-7,4A4.974,4.974,0,0,1,12.005,47Z" fill="#a67c52"></path> <path d="M26.479,36.451l4.952-1.829a1.44,1.44,0,0,0-1-2.7L25.481,33.75a.959.959,0,1,1-.665-1.8l4.051-1.5a1.44,1.44,0,0,0-1-2.7L19.78,30.741l1.193-2.591a1.92,1.92,0,1,0-3.487-1.606s-3.754,8.183-4.018,8.762a5.986,5.986,0,0,0-.327,3.663,6.246,6.246,0,0,0,8.249,4.479l10.8-3.992a1.44,1.44,0,0,0-1-2.7l-4.052,1.5a.96.96,0,0,1-.665-1.8Z" fill="#e5a57a"></path> <path d="M21.521,36.451l-4.952-1.829a1.44,1.44,0,0,1,1-2.7l4.952,1.829a.959.959,0,1,0,.665-1.8l-4.051-1.5a1.44,1.44,0,0,1,1-2.7l8.089,2.989L27.027,28.15a1.92,1.92,0,1,1,3.487-1.606s3.754,8.183,4.018,8.762a5.986,5.986,0,0,1,.327,3.663,6.246,6.246,0,0,1-8.249,4.479l-10.8-3.992a1.44,1.44,0,0,1,1-2.7l4.052,1.5a.96.96,0,1,0,.665-1.8Z" fill="#eebc99"></path></g></svg>',
            awesome   : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48" height="48"><g><path d="M24,46A22,22,0,1,1,46,24,22.025,22.025,0,0,1,24,46Z" fill="#ffd764"/> <path d="M12,25a1,1,0,0,1-.707-1.707l6-6a1,1,0,0,1,1.414,1.414l-6,6A1,1,0,0,1,12,25Z" fill="#444"/><path d="M18,25a1,1,0,0,1-.707-.293l-6-6a1,1,0,0,1,1.414-1.414l6,6A1,1,0,0,1,18,25Z" fill="#444"/> <path d="M36,25a1,1,0,0,0,.707-1.707l-6-6a1,1,0,0,0-1.414,1.414l6,6A1,1,0,0,0,36,25Z" fill="#444"/><path d="M30,25a1,1,0,0,0,.707-.293l6-6a1,1,0,0,0-1.414-1.414l-6,6A1,1,0,0,0,30,25Z" fill="#444"/> <path d="M24,39a5,5,0,1,1,5-5A5.006,5.006,0,0,1,24,39Z" fill="#ae453e"/><ellipse cx="24" cy="37" rx="3.974" ry="2" fill="#fa645a"/></g></svg>',
            like      : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48" height="48"><g><path d="M24,46A22,22,0,1,1,46,24,22.025,22.025,0,0,1,24,46Z" fill="#ffd764"/> <circle cx="38" cy="28" r="3" fill="#e86c60" opacity="0.5"/> <circle cx="10" cy="28" r="3" fill="#e86c60" opacity="0.5"/> <path d="M19,24a1,1,0,0,1-1-1,2,2,0,0,0-4,0,1,1,0,0,1-2,0,4,4,0,0,1,8,0A1,1,0,0,1,19,24Z" fill="#444"/> <path d="M35,24a1,1,0,0,1-1-1,2,2,0,0,0-4,0,1,1,0,0,1-2,0,4,4,0,0,1,8,0A1,1,0,0,1,35,24Z" fill="#444"/> <path d="M24.059,39a9.025,9.025,0,0,1-7.81-4.537,1,1,0,0,1,1.736-.994,6.989,6.989,0,0,0,12.147,0,1,1,0,0,1,1.736.994A9.024,9.024,0,0,1,24.059,39Z" fill="#444"/></g></svg>',
            sick      : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48" height="48"><g><path d="M24,46A22,22,0,1,1,46,24,22.025,22.025,0,0,1,24,46Z" fill="#ffd764"/> <path d="M12,25a1,1,0,0,1-.448-1.895L15.764,21,11.553,18.9a1,1,0,0,1,.894-1.79l6,3a1,1,0,0,1,0,1.79l-6,3A1,1,0,0,1,12,25Z" fill="#444"/> <path d="M36,25a1,1,0,0,1-.446-.105l-6-3a1,1,0,0,1,0-1.79l6-3a1,1,0,1,1,.894,1.79L32.236,21l4.211,2.105A1,1,0,0,1,36,25Z" fill="#444"/> <path d="M40,42a3.97,3.97,0,0,0-2.666,1.04,6.978,6.978,0,0,0-11.551-1.691,5.97,5.97,0,0,0-7.283-.213,5.978,5.978,0,0,0-8.433,1.457A3.954,3.954,0,0,0,8,42a4,4,0,0,0-4,4H44A4,4,0,0,0,40,42Z" fill="#72c472"/> <circle cx="38" cy="36" r="2" fill="#72c472"/> <circle cx="11.5" cy="37.5" r="1.5" fill="#72c472"/> <path d="M14.134,30H33.866c-1.76-1.809-5.421-3-9.866-3S15.894,28.191,14.134,30Z" fill="#fff"/> <path d="M14.134,30A3.579,3.579,0,0,0,13,32.5c0,3.136,4.729,5.5,11,5.5s11-2.364,11-5.5A3.579,3.579,0,0,0,33.866,30Z" fill="#ae453e"/> <path d="M18,30V43a1,1,0,0,0,1,1H29a1,1,0,0,0,1-1V30Z" fill="#72c472"/></g></svg>',
            angry     : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48" height="48"><g><path d="M24,46A22,22,0,1,1,46,24,22.025,22.025,0,0,1,24,46Z" fill="#e86c60"/> <circle cx="33" cy="25" r="3" fill="#444"/> <circle cx="15" cy="25" r="3" fill="#444"/> <path d="M17.292,37a1,1,0,0,1-.745-1.667,10,10,0,0,1,14.906,0,1,1,0,1,1-1.49,1.334,8,8,0,0,0-11.926,0A1,1,0,0,1,17.292,37Z" fill="#444"/> <path d="M30,21a1,1,0,0,1-.516-1.857l5-3a1,1,0,0,1,1.03,1.714l-5,3A.994.994,0,0,1,30,21Z" fill="#444"/> <path d="M18,21a.994.994,0,0,1-.514-.143l-5-3a1,1,0,0,1,1.03-1.714l5,3A1,1,0,0,1,18,21Z" fill="#444"/></g></svg>'
        }

        if (this._attr) {
            this._element.innerHTML = svg[this._attr]
        }

        return true
    }

    // static
    static _init() {
        const data = new Svg(this)
        data._get()
    }
}

/**
 * ------------------------------------------------------------------------
 * Load Event
 * ------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll(DATA_KEY).forEach(el => {
        Svg._init.call(el)
    })
})

export default Svg
