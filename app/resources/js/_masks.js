
/**
 * This mask is to validate a url slug
 *
 * @param {string} text - the text to mask
 * @returns
 */
function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with dashes
        .replace(/[^\w\-]+/g, '') // Remove non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple dashes with a single dash
        .replace(/^-+/, '') // Remove leading dashes
    // .replace(/-+$/, ''); // Remove trailing dashes
}

window.slugify = slugify
