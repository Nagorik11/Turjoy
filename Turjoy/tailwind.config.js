/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
    colors: {
      custom_blue: '#0A74DA'
    }
  },
  plugins: [
    require('flowbite/plugin')
  ],
}