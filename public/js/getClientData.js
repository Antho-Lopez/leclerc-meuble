/**
 * This function returns true if the user agent is a mobile device
 * @returns The return value is a boolean value.
 */
 function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

/**
 * Check if the user is using Google Chrome
 * @returns a boolean value.
 */
function checkChrome() {
    return !(navigator.userAgent.indexOf("Edg") != -1) && navigator.userAgentData && (navigator.userAgentData.brands[2].brand === 'Google Chrome') || window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime)
}

/**
 * This function checks if the user is using a Safari browser on a Mac, iPhone, or iPad
 * @returns true if the user is using Safari on an iPhone, iPad, or Mac.
 */
function checkSafari() {
    return (navigator.userAgent.indexOf("iPhone") != -1) || (navigator.userAgent.indexOf("iPad") != -1) ||(navigator.userAgent.indexOf("Mac OS X") != -1) && (navigator.userAgent.indexOf("Windows") == -1) && (navigator.userAgent.indexOf("Linux") == -1) && (navigator.userAgent.indexOf("Firefox") == -1) && (navigator.userAgent.indexOf("Android") == -1)
}

/**
 * Check if the browser is Firefox
 * @returns a boolean value.
 */
function checkFirefox() {
    return (typeof InstallTrigger !== 'undefined') || (navigator.userAgent.indexOf("Firefox") != -1)
}

/**
 * Check if the browser is Microsoft Edge
 * @returns A boolean value.
 */
function checkEdge() {
    return !!window.StyleMedia || (navigator.userAgent.indexOf("Edg") != -1) && (navigator.userAgent.indexOf("Windows") != -1) || navigator.userAgentData && (navigator.userAgentData.brands[2].brand === 'Microsoft Edge')
}

/**
 * Check if the browser is Opera
 * @returns A boolean value.
 */
function checkOpera() {
    return (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf('OPR') >= 0
}

/**
 * The function checks if the user is using a Samsung device and returns true if they are
 * @returns a boolean value.
 */
function checkSamsung() {
    return (navigator.userAgent.indexOf('Android') != -1) && ((navigator.userAgent.indexOf('Samsung') != -1) || (navigator.userAgent.indexOf('SM-A') != -1) || (navigator.userAgent.indexOf('SM-G') != -1) || (navigator.userAgent.indexOf('SM-N') != -1) || (navigator.userAgent.indexOf('SM-X') != -1) || (navigator.userAgent.indexOf('SM-S') != -1))
}

/**
 * The function returns the browser name if the browser is one of the following:
 *
 * Chrome
 * Safari
 * Firefox
 * Samsung
 * Edge
 * Opera
 * Otherwise, it returns "Autre"
 * @returns The browser name
 */
function getBrowser() {
    if (checkChrome()) {
        return 'Chrome'
    } else if (checkSafari()) {
        return 'Safari'
    } else if (checkFirefox()) {
        return 'Firefox'
    } else if (checkSamsung()) {
        return 'Samsung'
    } else if (checkEdge()) {
        return 'Edge'
    } else if (checkOpera()) {
        return 'Opera'
    } else {
        return 'Autre'
    }
}

async function clientdata() {
    // On enovi le stat uniquement si on est pas sur l'url de demo /client, donc uniquement pour /qrcode et /other
    /* This is a way to get the url of the page without the query string. */
    let  url = window.location.href.split('/')
    url = url[5]
    url = url.split('?')
    url = url[0]
    await axios.post('/api/landingclients/landings/setLandingUserStats', {
        mobile: isMobile(),
        browser: getBrowser(),
        url: url
    }, {
        headers: {
            Authorization: 'ZEEGDZF53951FD4JB581SE222A4E4'
        }
    }).catch(function (errors) {
        errors = JSON.stringify(errors)
        axios.post('/api/landingclients/landings/landingStatsErrors', {errors: errors}, {
            headers: {
                Authorization: 'ZEEGDZF53951FD4JB581SE222A4E4'
            }
        })
    });

    // Recuperer l'UAD via la nouvel methode avec le ternaire on evite que la fonction plante pour les navigateur qui n'implémente pas encore uad
    let ua = navigator.userAgentData && (navigator.userAgentData.length > 0) ? navigator.userAgentData.brands[2].brand : null
    let loc = window.location.href ? window.location.href : null
    // Pour les navigateur non identifier on envoi le useragent pour recuperer les data du nav et improve le classement
    await axios.post('/api/landingclients/landings/setLandingUA', {
        mobile: isMobile(),
        useragent: `agent: ${navigator.userAgent} ua: ${ua} chrome: ${typeof window.chrome} url: ${loc}`
    }, {
        headers: {
            Authorization: 'ZEEGDZF53951FD4JB581SE222A4E4'
        }
    }).catch(function (errors) {
        errors = JSON.stringify(errors)
        axios.post('/api/landingclients/landings/landingStatsErrors', {errors: errors}, {
            headers: {
                Authorization: 'ZEEGDZF53951FD4JB581SE222A4E4'
            }
        })
    });
}
/* This is a way to make sure that the clientdata function is only called once per session. */
if(!sessionStorage.getItem('redirected')) {
    clientdata()
}
sessionStorage.removeItem('redirected')

