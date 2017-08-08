Vue.filter('truncate', function (text, length, clamp) {
    if (! text) {
        return
    }

    clamp = clamp || '…'
    length = length || 30


    if (text.length <= length) {
        console.log('here');
        return text
    }

    let truncatedText = text.slice(0, length - clamp.length)

    return truncatedText + clamp
})
