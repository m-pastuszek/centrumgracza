/**
 * ---------------------------------------------------------------------------------------
 * Gameforest Bootstrap Gaming Theme: notify.js
 * Copyright (c) 2019 yakuthemes.com (https://yakuthemes.com)
 *
 * @link      https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730
 * @version   5.0.3
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPLv3 License
 * ---------------------------------------------------------------------------------------
 */

import Helpers from './helpers'

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

const DATA                   = 'ya-notify'
const DATA_KEY               = `[${DATA}]`
const DATA_TITLE             = 'ya-title'
const VERSION                = '1.0.0'

/**
 * ------------------------------------------------------------------------
 * Class Definition
 * ------------------------------------------------------------------------
 */

class Notify extends Helpers {
    constructor(element) {
        super()
        this._element       = element
        this._attr          = element.getAttribute(DATA)
        this._title         = element.getAttribute(DATA_TITLE)
    }

    static get VERSION() {
        return VERSION
    }

    _remove(notify) {
        const time = {
            hide      : 3000,
            remove    : 4000
        }

        setTimeout(() => {
            notify.classList.remove('fadeInDown')
            notify.classList.add('fadeOutUp')
        }, time.hide)

        setTimeout(() => {
            document.body.removeChild(notify)
        }, time.remove)
    }

    _option() {
        if (this._attr) {
            this.loopArray(this._attr, this.options)
        }

        return this.options
    }

    _set(notify, alert) {
        this._option()

        if (this.options.align) {
            notify.classList.add(`notify-${this.options.align}`)
        }

        if (this.options.alert) {
            alert.classList.remove('alert-darken-primary')
            alert.classList.add(`alert-darken-${this.options.alert}`)
        }
    }

    _add() {
        // constants
        const notify = document.createElement('div')
        const alert = document.createElement('div')
        const text = document.createTextNode(this._title)

        notify.classList.add('notify', 'animated', 'fadeInDown', 'fast')
        alert.classList.add('alert', 'alert-darken-primary')

        document.body.appendChild(notify)
        notify.appendChild(alert)
        alert.appendChild(text)

        // set notify options
        this._set(notify, alert)

        // remove notify
        this._remove(notify)
    }

    _get() {
        this._element.addEventListener('click', e => {
            e.preventDefault()

            this._add(this._element)
        }, false)
    }

    // static
    static _init() {
        const data = new Notify(this)
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
        Notify._init.call(el)
    })
})

export default Notify
