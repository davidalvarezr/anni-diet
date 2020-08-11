/**
 * @param pathname the part which goes here: <host>:<port>/<pathname>
 * @param sameWindow
 */
export function goToUrl(pathname, sameWindow = true) {
    // replaces multiples '/' occurences by one
    const url = `${window.location.host}/${pathname}`.replace(/\/{2,}/g, '/')
    if (sameWindow) {
        window.location.href = `${window.location.protocol}//${url}`
    } else {
        window.open(`${window.location.protocol}//${url}`, '_blank')
    }
}
