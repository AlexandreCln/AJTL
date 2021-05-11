<template>
  <svg
    width="0"
    height="0"
    style="display: none;"
    v-html="$options.svgSprite"
  />
</template>

<script>
// Icons is an alias for SVG icons folder configured to use `svg-inline-loader` 
const svgContext = require.context('Icons', true, /\w+\.svg$/i)

const symbols = svgContext.keys().map(path => {
  // get SVG file content
  const content = svgContext(path)
  // extract icon id from filename
  const id = path.replace(/^\.\/(.*)\.\w+$/, '$1')
  // replace svg tags with symbol tags and id attribute
  return content.replace('<svg', `<symbol id="${id}"`).replace('svg>', 'symbol>')
})

export default {
  name: 'SvgSprite',
  svgSprite: symbols.join('\n'), // concatenate all symbols into $options.svgSprite
}
</script>