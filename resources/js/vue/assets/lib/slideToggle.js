// js helper for slide toggle css transition
// for the example, see modifications + complectations summary tables

export default (target) => {
  const transitionEndVendor = (() => {
    const el = document.createElement('div')
    const transEndEventNames = {
      transition: 'transitionend',
      MozTransition: 'transitionend',
      WebkitTransition: 'webkitTransitionEnd',
      OTransition: 'oTransitionEnd otransitionend'
    }
    for (let name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return transEndEventNames[name]
      }
    }
    return false
  })()

  function transitionCallback () {
    if (parseInt(this.style.maxHeight) !== 0) {
      this.removeAttribute('style')
    }
  }

  let timer = 0

  try {
    let targetHeight = target.firstChild.scrollHeight

    clearTimeout(timer)
    target.removeEventListener(transitionEndVendor, transitionCallback)
    target.addEventListener(transitionEndVendor, transitionCallback)

    if (target.clientHeight > 0) {
      target.style.maxHeight = targetHeight + 'px'
      timer = setTimeout(() => {
        target.style.maxHeight = 0
      }, 40)
    } else {
      target.style.maxHeight = targetHeight + 'px'
    }
  } catch (err) {
    console.log('Slide toggle error: ', err)
  }
}
