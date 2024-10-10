/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.{html,js,php}", 
    "!./node_modules/**/*"
  ],  
  theme: {
    extend: {
      fontSize: {
        '50px' : '50px'
      },
      scale: {
        '102' : '1.02', // 102% de escala
      },
      width: {
        '98' : '400px'
      }
    },
  },
  plugins: [],
}
