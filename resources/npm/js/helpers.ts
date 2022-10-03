export function sleep(ms: number) {
    return new Promise((resolve) => {
        setTimeout(resolve, ms);
    });
}

/**
 * Gets the URL without query or anchor
 */
export function getUrl() {
    return `${document.location.protocol}//${document.location.host}${document.location.pathname}`;
}